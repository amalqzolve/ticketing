<?php

namespace App\Http\Controllers\RequestAndApproval;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\RequestAndApproval\RequestModel;
use App\RequestAndApproval\RequestApprovalModel;
use Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $currentUser = Auth::user()->id; //current user Id
        $totalRequest = RequestModel::where('creted_by', $currentUser)->count();
        $draftRequest = RequestModel::where('creted_by', $currentUser)->whereIn('status', [1, 5])->count();
        $approvalPendingRequest = RequestModel::where('creted_by', $currentUser)->whereIn('status', [2, 5])->count();;
        $approvedRequest = RequestModel::where('creted_by', $currentUser)->where('status', 6)->count();;
        $rejectedRequest = RequestModel::where('creted_by', $currentUser)->where('status', 4)->count();;
        $approvalPendingOnMySideRequest = RequestApprovalModel::where('user', '=', $currentUser)->where('request_approval.status', 1)->count();
        $decisionTaken = RequestApprovalModel::where('user', '=', $currentUser)->where('request_approval.status', '!=', 1)->where('request_approval.status', '!=', 0)->count();
        return view('request_and_approval.dashboard.index', compact('totalRequest', 'draftRequest', 'approvalPendingRequest', 'approvedRequest', 'rejectedRequest', 'approvalPendingOnMySideRequest','decisionTaken'));
    }
}
