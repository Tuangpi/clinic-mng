<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QueueStatus;

class QueueStatusController extends Controller
{

    public function index(Request $request)
    {
        $currentBranch = session('branch');
        $statuses = QueueStatus::select('id', 'description', 'hex_color')->orderBy('seq_no');
        
        if ($request->branch) {
            $statuses = $statuses->where('branch_id', $request->branch);
        }

        $statuses = $statuses->get();
        return response()->json($statuses);
    }
}
