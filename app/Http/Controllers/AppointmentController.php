<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\Patient;
use App\Models\AppointmentCategory;
use App\Models\RecurringType;
use App\Models\Appointment;
use App\Models\AppointmentStatus;

use App\Enums\RecurringType as RecurringTypeEnum;

use App\Notifications\Appointment as AppointmentNotification;

use DataTables;

class AppointmentController extends Controller
{
    public function generalSetupIndex()
    {
        return view('general-setup/appointment'); 
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $currentBranch = session('branch');
        $branchId = $currentBranch ? $currentBranch->id : null;
        if ($request->ajax()) {
            $data = Appointment::active($branchId);
                
            return Datatables::of($data)
            ->filterColumn('guest', function($query, $keyword) {
                $query->whereRaw("concat(appointments.first_name, ' ', appointments.last_name) like ?", ["%{$keyword}%"]);
            })
            ->filterColumn('patient', function($query, $keyword) {
                $query->whereRaw("concat(p.first_name, ' ', p.last_name) like ?", ["%{$keyword}%"]);
            })
            ->filterColumn('category', function($query, $keyword) {
                $query->whereRaw("c.description like ?", ["%{$keyword}%"]);
            })
            ->filterColumn('status', function($query, $keyword) {
                $query->whereRaw("s.description like ?", ["%{$keyword}%"]);
            })
            ->filterColumn('recurring', function($query, $keyword) {
                $query->whereRaw("rt.description like ?", ["%{$keyword}%"]);
            })
            ->filterColumn('branch', function($query, $keyword) {
                $query->whereRaw("b.description like ?", ["%{$keyword}%"]);
            })
            ->make(true);
        }
        $patients = Patient::forDropdown()->get();
        $categories = AppointmentCategory::forDropdown($branchId)->get();
        $statuses = AppointmentStatus::forDropdown()->get();
        $recurringTypes = RecurringType::select('id', 'description')
                    ->get();
        return view('appointments', compact('patients', 'categories', 'statuses', 'recurringTypes', 'currentBranch'));
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

            $currentBranch = session('branch');
            \DB::beginTransaction();

            $a = new Appointment;
            $a->branch_id = $currentBranch->id;
            $a->created_by = \Auth::id();
            $a->updated_by = \Auth::id();
            $this->mapValues($a, $request);
            
            \DB::commit();
        } catch (\Throwable $th) {
            return response()->json(['errMsg'=> 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError'=> true]);
            \DB::rollBack();
        }

        return response()->json(['errMsg'=> '', 'isError'=> false, 'message' => 'New appointment has been created.']);
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
            $a = Appointment::with([
                'patient:id,code,first_name,last_name,mobile_number', 
                'appointmentCategory:id,description,hex_color'
                ])->find($id);
        } catch (\Throwable $th) {
            return response()->json(['errMsg'=> 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError'=> true]);
        }
        return response()->json(['appointment' => $a]);
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
            $currentBranch = session('branch');
            $a = Appointment::find($id);

            if (!$currentBranch) {
                $categories = AppointmentCategory::forDropdown($a->branch_id)->get();
                return response()->json(['appointment' => $a, 'categories' => $categories]);
            }

            return response()->json(['appointment' => $a]);
        } catch (\Throwable $th) {
            return response()->json(['errMsg'=> 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError'=> true]);
        }
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
            
            \DB::beginTransaction();

            $a = Appointment::find($id);
            $a->updated_by = \Auth::id();
            $this->mapValues($a, $request);

            $a->save();
            
            \DB::commit();
        } catch (\Throwable $th) {
            return response()->json(['errMsg'=> 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError'=> true]);
            \DB::rollBack();
        }

        return response()->json(['errMsg'=> '', 'isError'=> false, 'message' => 'Appointment has been updated.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $p = Appointment::find($id);
        $p->delete();
        return response()->json(['errMsg'=> '', 'isError'=> false]);
    }

    public function calendar(Request $request)
    {
        $currentBranch = session('branch');
        $branchId = $currentBranch ? $currentBranch->id : null;
        $appointments = Appointment::forCalendar($branchId, $request->start, $request->end, $request->status, $request->category)->get();
        if (!$request->ajax()) {
            $appointments = $appointments->map(function($appointment) {
                $event = [
                    'id' => $appointment->id,
                    'resourceId' => $appointment->appointment_category_id,
                    'title' => ($appointment->prefix ? $appointment->prefix . ' - ' : '') . ($appointment->patient_id ? $appointment->first_name . ' ' . $appointment->last_name : $appointment->guest_first_name . ' ' . $appointment->guest_last_name) ,
                    'start' => $appointment->start_date,
                    'end' => $appointment->end_date,
                    'borderColor' => '#' . $appointment->status_color,
                    'backgroundColor' => '#' . $appointment->category_color,
                    'url' => 'javascript:;',
                    'category' => $appointment->category,
                    'branch' => $appointment->branch,
                    'patient' => $appointment->first_name . ' ' . $appointment->last_name,
                    'patient_id' => $appointment->patient_id,
                    'guest' => $appointment->guest_first_name . ' ' . $appointment->guest_last_name,
                    'classNames' => ($appointment->new_patient ? 'new-patient' : ''),
                    'recurring' => $appointment->recurring
                ];

                if ($appointment->recurring) {
                    $durationMin = Carbon::parse($appointment->end_date)->diffInMinutes(Carbon::parse($appointment->start_date));
                    $durationHr = 0;

                    if ($durationMin >= 60) {
                        $durationHr = $durationMin / 60;
                        $durationMin = $durationMin - ($durationHr * 60);
                    }
                    $event['duration'] = sprintf('%02d', $durationHr) . ':' . sprintf('%02d', $durationMin);
                    $event['rrule'] = [
                        'freq' => $appointment->recurring,
                        'interval' => $appointment->recurring_interval,
                        'dtstart' => $appointment->start_date,
                        'until' => Carbon::parse($appointment->recurring_end_date)->addDay()->subMillisecond(1)->format('Y-m-d H:i'),
                        'byweekday' => $appointment->recurring_dow ? explode(',', $appointment->recurring_dow) : null
                    ];
                }
                return $event;
            });
            
        }
                        
        return response()->json($appointments);
    }

    public function updateStatus($id, $status)
    {
        try {
            
            \DB::beginTransaction();

            $a = Appointment::find($id);
            $a->updated_by = \Auth::id();
            $a->appointment_status_id = $status;

            $a->save();
            
            \DB::commit();
        } catch (\Throwable $th) {
            return response()->json(['errMsg'=> 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError'=> true]);
            \DB::rollBack();
        }

        return response()->json(['errMsg'=> '', 'isError'=> false, 'message' => 'Appointment status has been updated.']);
    }

    public function updateSchedule(Request $request, $id)
    {
        try {
            
            \DB::beginTransaction();

            $a = Appointment::find($id);
            $a->updated_by = \Auth::id();
            $a->start_date = Carbon::parse($request->startDate);
            $a->end_date = Carbon::parse($request->endDate);

            $a->save();
            
            \DB::commit();
        } catch (\Throwable $th) {
            return response()->json(['errMsg'=> 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError'=> true]);
            \DB::rollBack();
        }

        return response()->json(['errMsg'=> '', 'isError'=> false, 'message' => 'Schedule has been updated.']);
    }
    
    public function createPatient(Request $request, $id)
    {
        try {
            
            \DB::beginTransaction();

            $currentBranch = session('branch');
            $currentUserId = \Auth::id();

            $p = new Patient;
            $p->branch_id = $currentBranch->id;
            $p->first_name = $request->firstName;
            $p->last_name = $request->lastName;
            $p->mobile_number = $request->mobileNo;
            $p->created_by = $currentUserId;
            $p->updated_by = $currentUserId;

            $p->save();

            $p->code = 'PX-' . sprintf('%02d', $p->branch_id) . '-' . sprintf('%05d', $p->id);
            $p->save();


            $a = Appointment::find($id);
            $a->updated_by = $currentUserId;
            $a->patient_id = $p->id;

            $a->save();
            
            \DB::commit();
        } catch (\Throwable $th) {
            return response()->json(['errMsg'=> 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError'=> true]);
            \DB::rollBack();
        }

        return response()->json(['errMsg'=> '', 'isError'=> false, 'message' => 'Patient has been created.']);
    }

    private function mapValues($a, $request)
    {
        $a->patient_id = $request->patient;
        $a->prefix = $request->prefix;
        $a->details = $request->details;
        $a->start_date = Carbon::parse($request->startDate);
        $a->end_date = Carbon::parse($request->endDate);
        $a->appointment_category_id = $request->category;
        $a->appointment_status_id = $request->status;
        if ($a->patient_id) {
            $a->first_name = null;
            $a->last_name = null;
            $a->mobile_no = null;
        }
        else {
            $a->first_name = $request->firstName;
            $a->last_name = $request->lastName;
            $a->mobile_no = $request->mobileNo;
        }
        if ($request->recurring) {
            $a->recurring_type_id = $request->recurring;
            $a->recurring_interval = $request->interval;
            $a->recurring_end_date = Carbon::parse($request->recurringEndDate);
            $a->recurring_dow = RecurringTypeEnum::Weekly == $request->recurring ? $request->dow : null; 
        }
        else {
            $a->recurring_type_id = null;
            $a->recurring_interval = null;
            $a->recurring_end_date = null;
            $a->recurring_dow = null; 
        }

        $a->save();

        // if ($request->sendEmail == 1) {
        //     $p = Patient::find($request->patient);
        //     if ($p->email) {
        //         $p->notify(new AppointmentNotification());
        //     }
        // }

    }
}
