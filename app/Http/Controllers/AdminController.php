<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Risks;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Departments;
use App\Models\Companies;
use App\Models\Divisions;
use App\Models\User_Division;
use App\Models\Risk_Category;
use App\Models\Users;
use App\Models\Risk_Levels;
use App\Models\KRI_Data;
use App\Models\Treatment_Data;
use Illuminate\Support\Facades\Mail;
use App\Models\Email_Logs;
use Illuminate\Support\Facades\Session;
use Symfony\Component\Mime\Part\TextPart;
use Symfony\Component\Mime\Part\HtmlPart;

use Illuminate\Support\Arr;
use App\Mail\TestMail;
use Illuminate\Mail\Message;
class AdminController extends Controller
{
     public function showNewData()
    {
       
        
         $Data=Risks::select('*')->orderBy('Date_Time','DESC')
                      ->where('Request_Status', '!=', 'Completed')
                      ->where('Request_status', '!=', 'Draft')
                       ->get();
         
         
       return view('/AdminFunctions.NewRisks',['Risk'=>$Data]);
    } 
    
  /*public function filter(Request $request)
{
    $start_date = $request->input('start_date');
    $end_date = $request->input('end_date');

   $Data = Risks::whereBetween('Date_Time', [$start_date, $end_date])->get();
   
  

    return view('/AdminFunctions.NewRisks', ['Risk' => $Data]);
}*/

public function filter(Request $request)
{
      
    $start_date = $request->input('start_date');
    $end_date = $request->input('end_date');

   $Data = Risks::  where('Request_Status', '!=', 'Completed')
   
                  ->whereBetween('Date_Time', [$start_date, $end_date])->get();

    return view('/AdminFunctions.NewRisks', ['Risk' => $Data]);
}
    


    
public function showClosedData()
    {
       
        
         $Data=Risks::where('Request_Status', '=', 'Completed')->select('*')->orderBy('Date_Time','DESC')->get();
        return view('/AdminFunctions.ClosedRisks',['Risk'=>$Data]);
    }
    
public function extract(Request $request)
  {
      $start_date = $request->input('start_date');
      $end_date = $request->input('end_date');
  
     $Data = Risks::where('Request_Status', '=', 'Completed')
     
                          ->whereBetween('Date_Time', [$start_date, $end_date])->get();
  
      return view('/AdminFunctions.ClosedRisks', ['Risk' => $Data]);
  }


public function showNotAttendedData()
{
    $data = DB::table('Risks')
        ->join('Treatment_Data', 'Risks.Id', '=', 'Treatment_Data.Risk_Id')
        ->join('Users', 'Treatment_Data.Action_Owner_Name', '=', 'Users.Name')
        ->where('Risks.Request_status', '!=', 'Draft')
        ->where('Treatment_Data.Action_Due', '<', now()) // Check if the action due date is in the past
        ->where('Risks.Request_status', 'In-Progress') // Adjust the column name and value based on your schema
        ->select('Risks.Id', 'Risks.Owner_Name', 'Treatment_Data.Action_Owner_Name', 'Treatment_Data.Action_Due', 'Users.Email', 'Risks.Status')
        ->get();
    $statusValues = $data->pluck('Status')->unique();
    return view('AdminFunctions.NotAttendedRisks', ['data' => $data, 'statusValues' => $statusValues]);
}
        
public function extractNotAttended(Request $request)
{
    $start_date = $request->input('start_date_1');
    $end_date = $request->input('end_date_1');

    $data = DB::table('Risks')
        ->join('Treatment_Data', 'Risks.Id', '=', 'Treatment_Data.Risk_Id')
        ->join('Users', 'Treatment_Data.Action_Owner_Name', '=', 'Users.Name')
        ->where('Risks.Request_status', '!=', 'Draft')
        ->where('Treatment_Data.Action_Due', '<', now()) // Check if the action due date is in the past
        ->where('Risks.Request_status', 'In-Progress') // Adjust the column name and value based on your schema
        ->whereBetween('Treatment_Data.Action_Due', [$start_date, $end_date]) // Use the correct column name from the "Risks" table
        ->select('Risks.Id', 'Risks.Owner_Name', 'Treatment_Data.Action_Owner_Name', 'Treatment_Data.Action_Due', 'Users.Email')
        ->get();

    return view('AdminFunctions.NotAttendedRisks', ['data' => $data]);
}




//REMINDER FUNCTION
public function ReminderIndex()
  {
      $users = DB::table('Users')
          ->leftJoin('User_Division', 'Users.User_Name', '=', 'User_Division.Username')
          ->whereNotNull('User_Division.Username')
          ->whereNotNull('User_Division.Division_Name')
          ->select('Users.Name', 'Users.User_Name', 'User_Division.Division_Name', 'Users.Mobile', 'Users.Email')
          ->get();
  
      $divisions = Risks::select('Division_Name')->distinct()->get();
          
      return view('AdminFunctions.Reminders', compact('users', 'divisions'));
  }

//REMINDER SEND EMAIL FUNCTION FOR MULTIPLE USERS
public function sendEmails(Request $request)
    {
        $User = $request->session()->get('username');
        $users = $request->input('users');
        $uniqueUsers = collect($users)->unique('email')->values()->all();

        $subject = $request->input('subject');
        $body = $request->input('body');

        foreach ($uniqueUsers as $user) {
            $name = $user['name'];
            $division = $user['division'];
            $email = $user['email'];
            $mobile = $user['mobile'];

            $emailLog = new Email_Logs;
            $emailLog->Sender_Name = $User;
            $emailLog->Receiver_Name = $name;
            $emailLog->Subject = $subject;
            $emailLog->Description = $body;
            $emailLog->save();

            $this->sendEmail($email, $subject, $body);
        }

        return response('Emails sent successfully!');
    }

private function getUserByEmail($users, $email)
    {
        foreach ($users as $user) {
            if ($user['email'] === $email) {
                return $user;
            }
        }
        return null;
    }
private function sendEmail($toEmail, $subject, $body)
{
    $plainTextBody = strip_tags($body);

    \Illuminate\Support\Facades\Mail::send([], [], function ($message) use ($toEmail, $subject, $body) {
        $message->to($toEmail)
            ->subject($subject)
            ->html($body);
    });
}

//END REMINDER FUNCTION

//EXTRACT FOR ALLRISKS
public function AllRiskIndex(Request $request)
  { 
      $User = ucfirst($request->session()->get('username'));
      $Role = ucfirst($request->session()->get('Role'));
   
      if ($Role == 'Root') {
          $risks = DB::table('Risks')
              ->leftJoin('Divisions', 'Risks.Division_Name', '=', 'Divisions.Name')
              ->whereNotNull('Risks.Division_Name')
              ->whereNotNull('Divisions.Name')
              ->where('Risks.Request_status', '!=', 'Draft')
              ->select('Risks.Id', 'Risks.Topic','Risks.Type','Risks.Owner_Name', 'Risks.Status', 'Risks.Date_Time', 'Risks.Division_Name','Risks.Request_status')
              ->get();

          $Divisions = Divisions::select('Name','Department_Name')->distinct()->get();
               
          return view('/Risk.AllRisks', compact('risks', 'Divisions', 'Role'));
           
      } elseif ($Role == 'Admin') {
    $admin = Users::where('User_Name', $User)->first();

    if ($admin) {
        $departmentAdmin = Departments::where('Contact', $admin->Name)->first();

        if ($departmentAdmin) {
            $risks = Risks::join('Departments', 'Risks.Department_Name', '=', 'Departments.Name')
                ->select('Risks.Id', 'Risks.Topic', 'Risks.Type', 'Risks.Owner_Name', 'Risks.Status', 'Risks.Date_Time', 'Risks.Division_Name', 'Risks.Request_status')
                ->whereNotNull('Risks.Division_Name')
                ->where('Risks.Request_status', '!=', 'Draft')
                ->where('Departments.Contact', $admin->Name)
                ->orderBy('Risks.Id', 'DESC')
                ->get();

            $Divisions = Divisions::select('Name')->distinct()->get();

            return view('/Risk.AllRisks', compact('risks', 'Divisions', 'Role'));
        } else {
            $userDivision = User_Division::where('Username', $User)->first();

          if ($userDivision) {
              $risks = Risks::join('User_Division', function ($join) use ($userDivision) {
                  $join->on('Risks.Division_Name', '=', 'User_Division.Division_Name')
                      ->where('User_Division.Username', '=', $userDivision->Username);
              })
              ->select('Risks.Id', 'Risks.Topic', 'Risks.Type', 'Risks.Owner_Name', 'Risks.Status', 'Risks.Date_Time', 'Risks.Division_Name', 'Risks.Request_status')
              ->where('Risks.Request_status', '!=', 'Draft')
              ->get();
          
              $Divisions = Divisions::join('User_Division', 'Divisions.Name', '=', 'User_Division.Division_Name')
                  ->where('User_Division.Username', '=', $userDivision->Username)
                  ->select('Divisions.Name', 'Divisions.Department_Name')
                  ->distinct()
                  ->get();
          
              return view('/Risk.AllRisks', compact('risks', 'Divisions', 'Role'));
          }
        }
      }
    }
  }
//EXTRACT TO EXCELL
public function filterPortfolio(Request $request)
  {
      $action = $request->input('action');
  
      if ($action === 'extract') {
          $selectedRows = $request->input('selectedRows');
          $selectedDivision = $request->input('division');
          $columnMapping = [
              'Id' => 'CREATED DATE',
              'Type' => 'RISK ID',
              'Owner_Name' => 'TYPE',
              'Division_Name' => 'DIVISION',
              'Date_Time' => 'OWNER',
              'Status' => 'CATEGORY',
              'Request_status' => 'Status',
          ];
  
          $selectedColumns = array_keys($columnMapping);
          if ($selectedDivision === 'all') {
              $this->downloadAllRows($selectedRows, $columnMapping, $selectedColumns);
          } else {
              $this->downloadSelectedDivisionRows($selectedRows, $selectedDivision, $columnMapping, $selectedColumns);
          }
      }
  }

private function downloadAllRows($selectedRows, $columnMapping, $selectedColumns)
  {
      $csvContent = implode(',', array_values($columnMapping)) . "\n";
      $groupedRows = collect($selectedRows)->groupBy('Division_Name');
      
      foreach ($groupedRows as $division => $rows) {
          foreach ($rows as $row) {
              $rowData = collect($row)->only($selectedColumns)->values()->toArray();
              $csvContent .= implode(',', $rowData) . "\n";
          }
      }
      
      header("Content-type: text/csv");
      header("Content-Disposition: attachment; filename=extracted_data_" . date('YmdHis') . ".csv");
      header("Pragma: no-cache");
      header("Expires: 0");
  
      echo $csvContent;
      exit;
  }

private function downloadSelectedDivisionRows($selectedRows, $selectedDivision, $columnMapping, $selectedColumns)
  {
      $filteredRows = collect($selectedRows)->filter(function ($row) use ($selectedDivision) {
          return $row['Division_Name'] === $selectedDivision;
      });
  
      $csvContent = implode(',', array_values($columnMapping)) . "\n";
      foreach ($filteredRows as $row) {
          $rowData = collect($row)->only($selectedColumns)->values()->toArray();
          $csvContent .= implode(',', $rowData) . "\n";
      }
  
      header("Content-type: text/csv");
      header("Content-Disposition: attachment; filename=extracted_data_" . date('YmdHis') . ".csv");
      header("Pragma: no-cache");
      header("Expires: 0");
  
      echo $csvContent;
      exit;
  }
//END EXTRACT
}
