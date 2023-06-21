<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\Error_Logs;
use App\Models\Activity_Logs;
use App\Models\Risks;
use App\Models\Risk_Category;
use App\Models\Users;
use App\Charts\BarChart;
use Carbon\Carbon;
use App\Models\User_Division;
use App\Models\Notification;
use App\Models\Email_Logs;
use Symfony\Component\Mime\Part\HtmlPart;
use App\Models\Treatment_Data;



class ApprovalsController extends Controller
{
    public function Getapprovals(Request $request)
{


   $User = ucfirst($request->session()->get('username'));
   $Data=Risks::select('*')->orderBy('Date_Time','DESC')
                  ->where('Request_status', '!=', 'Draft')
                  ->where('Approval', '=', 'Pending')
                  ->where('Owner_Username', '=', $User)
                  ->get();
         
         
         
        return view('/Approvals.Pending',['Risk'=>$Data]);
}
public function Completedapprovals(Request $request)
{


   $User = ucfirst($request->session()->get('username'));
   $Data=Risks::select('*')->orderBy('Date_Time','DESC')
                  ->where('Request_status', '!=', 'Draft')
                  ->where('Approval', '=', 'Approved ||Rejected')
                  ->where('Owner_Username', '=', $User)
                  ->get();
         
         
         
        return view('/Approvals.Completed',['Risk'=>$Data]);
}
}
