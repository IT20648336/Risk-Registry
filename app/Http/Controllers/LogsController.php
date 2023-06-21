<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity_Logs;
use App\Models\Error_Logs;
use DataTables;

class LogsController extends Controller
{
    public function ActivityLogs(Request $request){
        
     $Data=Activity_Logs::orderBy('Date_Time', 'DESC')->LIMIT(1000)->get();

     return view('/Logs.ActivityLogs',['LogsData'=>$Data]);
      
    }
    public function ErrorLogs(Request $request){
        
     $Data=Error_Logs::orderBy('Date_Time', 'DESC')->LIMIT(1000)->get();

     return view('/Logs.ErrorLogs',['LogsData'=>$Data]);
      
    }
}
