<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\Title;
use App\Models\Gender;
use App\Models\Nationality;
use App\Models\MaritalStatus;
use App\Models\City;
use App\Models\State;
use App\Models\Patient;
use App\Models\CaseType;
use App\Models\CaseNoteTemplate;
use App\Models\PatientAvailableCredit;
use DataTables;

class PatientController extends Controller
{
    public function generalSetupIndex()
    {
        return view('general-setup/patient');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $currentBranch = session('branch');

            $data = Patient::active($request->branch, $currentBranch ? $currentBranch->id : null);

            return Datatables::of($data)
                ->filterColumn('name', function ($query, $keyword) {
                    $query->whereRaw("concat(patients.first_name, ' ', patients.last_name) like ?", ["%{$keyword}%"]);
                })
                ->filterColumn('birth_date', function ($query, $keyword) {
                    $query->whereRaw("DATE_FORMAT(birth_date, '%d/%m/%Y') like ?", ["%{$keyword}%"]);
                })
                ->filterColumn('city', function ($query, $keyword) {
                    $query->whereRaw("c.description like ?", ["%{$keyword}%"]);
                })
                ->filterColumn('branch', function ($query, $keyword) {
                    $query->whereRaw("b.description like ?", ["%{$keyword}%"]);
                })
                ->filterColumn('available_credits', function ($query, $keyword) {
                    $query->whereRaw("ac.amount like ?", ["%{$keyword}%"]);
                })
                ->make(true);
        }

        $titles = Title::orderBy('description')->get();
        $genders = Gender::orderBy('description')->get();
        $nationalities = Nationality::orderBy('description')->get();
        $maritalStatuses = MaritalStatus::orderBy('description')->get();
        $states = State::orderBy('description')->get();
        $cities = City::orderBy('description')->get();
        $yesNoUnknown = [
            [
                'id' => 1,
                'description' => 'Yes'
            ],
            [
                'id' => 2,
                'description' => 'No'
            ],
            [
                'id' => 0,
                'description' => 'Unknown'
            ],
        ];
        $caseTypes = CaseType::orderBy('description')->get();
        $caseNoteTemplates = CaseNoteTemplate::forDropdown()->get();

        return view('patients', compact(
            'titles',
            'genders',
            'nationalities',
            'maritalStatuses',
            'states',
            'cities',
            'yesNoUnknown',
            'caseTypes',
            'caseNoteTemplates'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            if ($request->email && Patient::where('email', $request->email)->whereNull("deleted_at")->exists()) {
                return response()->json(['errMsg' => 'Email already exists', 'isError' => true]);
            }
            if ($request->nric && Patient::where('nric', $request->nric)->whereNull("deleted_at")->exists()) {
                return response()->json(['errMsg' => 'NRIC already exists', 'isError' => true]);
            }

            $currentBranch = session('branch');
            $currentUserId = \Auth::id();
            \DB::beginTransaction();

            $p = new Patient;
            $p->branch_id = $currentBranch->id;
            $p->created_by = $currentUserId;
            $p->updated_by = $currentUserId;
            $this->mapValues($p, $request);

            if ($request->addPatientToTheQueue == 1) {
                $q = new \App\Models\Queue;
                $q->branch_id = $currentBranch->id;
                $q->queue_status_id = \App\Models\QueueStatus::forDropdown($currentBranch->id)->orderBy('seq_no')->select('queue_statuses.id')->first()->id;
                $q->created_by = $currentUserId;
                $q->updated_by = $currentUserId;
                $q->patient_id = $p->id;
                $q->time_in = Carbon::now();
                $q->save();

                if (empty($q->code)) {
                    $q->code = 'QU-' . sprintf('%02d', $q->branch_id) . '-' . sprintf('%05d', $q->id);
                    $q->save();
                }
            }

            \DB::commit();
        } catch (\Throwable $th) {
            return response()->json(['errMsg' => 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError' => true]);
            \DB::rollBack();
        }

        return response()->json(['errMsg' => '', 'isError' => false, 'message' => 'New patient has been created.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $currentBranch = session('branch');

            $p = Patient::with([
                'title:id,description',
                'gender:id,description',
                'nationality:id,description',
                'maritalStatus:id,description',
                'city:id,description,state_id',
                'city.state:id,description'
            ])->find($id);

            $credits = 0;
            if ($currentBranch) {
                $ac = PatientAvailableCredit::where([
                    ['patient_id', $id],
                    ['branch_id', $currentBranch->id],
                ])->first();

                if ($ac) {
                    $credits = $ac->amount;
                }
            }
        } catch (\Throwable $th) {
            return response()->json(['errMsg' => 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError' => true]);
        }
        return response()->json(['patient' => $p, 'credits' => $credits == 0 ? '0.00' : $credits]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $p = Patient::with('city:id,state_id')->find($id);
        } catch (\Throwable $th) {
            return response()->json(['errMsg' => 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError' => true]);
        }
        return response()->json(['patient' => $p]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            if ($request->email && Patient::where([
                ['email', $request->email],
                ['id', '<>', $id]
            ])->exists()) {
                return response()->json(['errMsg' => 'Email already exists', 'isError' => true]);
            }
            if ($request->nric && Patient::where([
                ['nric', $request->nric],
                ['id', '<>', $id]
            ])->exists()) {
                return response()->json(['errMsg' => 'NRIC already exists', 'isError' => true]);
            }

            \DB::beginTransaction();

            $p = Patient::find($id);
            $p->updated_by = \Auth::id();
            $this->mapValues($p, $request);

            $p->save();

            \DB::commit();
        } catch (\Throwable $th) {
            return response()->json(['errMsg' => 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError' => true]);
            \DB::rollBack();
        }

        return response()->json(['errMsg' => '', 'isError' => false, 'message' => 'Patient has been updated.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $p = Patient::find($id);

        if ($p->queues()->exists()) {
            return response()->json(['errMsg' => 'Unable to delete, this patient has already a transaction record.', 'isError' => true]);
        }

        if ($p->appointments()->exists()) {
            return response()->json(['errMsg' => 'Unable to delete, this patient has already an appointment record.', 'isError' => true]);
        }

        $p->delete();
        return response()->json(['errMsg' => '', 'isError' => false]);
    }

    public function label($id)
    {
        try {
            $p = Patient::find($id);
        } catch (\Throwable $th) {
            return response()->json(['errMsg' => 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError' => true]);
        }
        return response()->json([
            'code' => $p->code,
            'nric' => $p->nric,
            'name' => \Str::upper($p->full_name),
            'birthDate' => $p->birth_date,
            'createdDate' => $p->created_at,
            'age' => $p->age,
            'gender' => $p->gender_id ? substr($p->gender->description, 0, 1) : '',
            'mobile' => $p->mobile_number,
            'address' => $p->address,
            'city' => $p->city->description ?? '',
            'zipCode' => $p->zip_code,
            'allergy' => ($p->has_drug_allergies) ? 'YES' . ' (' . $p->drug_allergies . ')' : 'NO',
            'nationality' => $p->nationality->description ?? ''
        ]);
    }

    public function visits(Request $request, $patientId)
    {
        if ($request->ajax()) {
            $currentBranch = session('branch');
            $branchId = $currentBranch ? $currentBranch->id : null;
            $data = \App\Models\Queue::activeByPatient($branchId, $patientId);
            return Datatables::of($data)
                ->filterColumn('status', function ($query, $keyword) {
                    $query->whereRaw("s.description like ?", ["%{$keyword}%"]);
                })
                ->make(true);
        }
    }

    private function mapValues($p, $request)
    {
        $p->title_id = $request->title;
        $p->first_name = $request->firstName;
        $p->last_name = $request->lastName;
        $p->birth_date = Carbon::parse($request->birthDate);
        $p->birth_place = $request->birthPlace;
        $p->gender_id = $request->gender;
        $p->nationality_id = $request->nationality;
        $p->marital_status_id = $request->maritalStatus;
        $p->nric = $request->nric;
        $p->address = $request->address;
        $p->city_id = $request->city;
        $p->zip_code = $request->zipCode;
        $p->mobile_number = $request->mobileNo;
        $p->email = $request->email;
        $p->has_drug_allergies = $request->hasDrugAllergies == 0 ? null : ($request->hasDrugAllergies == 1);
        $p->drug_allergies = $request->drugAllergies;
        $p->has_food_allergies = $request->hasFoodAllergies == 0 ? null : ($request->hasFoodAllergies == 1);
        $p->food_allergies = $request->foodAllergies;
        $p->notes = $request->notes;


        $p->save();

        if (empty($p->code)) {
            $p->code = 'PX-' . sprintf('%02d', $p->branch_id) . '-' . sprintf('%05d', $p->id);
        }

        $p->photo_ext = $request->photoExt;
        if (!empty($request->photo)) {
            $image = base64_decode($request->photo);
            \Storage::disk('public')->put('profile/' . $p->id . '.' . $request->photoExt, $image);
        }

        $p->save();
    }
}
