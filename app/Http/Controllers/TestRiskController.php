<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//use DataTables;
//use Yajra\DataTables\DataTables;
use App\Models\Error_Logs;
use App\Models\Activity_Logs;
use App\Models\Risk_Category;


class TestRiskController extends Controller
{
    public function RiskData(Request $request){
         
        $User=$request->session()->get('username');
        $UserRole=ucfirst($request->session()->get('Role'));
        $IPAddress=$request->ip();
        $URL=url()->full();
        if($UserRole == 'Admin'){
        $Data=Users::where('Updated_By',$User)->orderBy('Id', 'ASC')->get();
        }
        if($UserRole == 'Root'){
        $Data=Users::orderBy('Id', 'ASC')->get();
        }
      return view('TestRisk',['RiskData'=>$Data]);
      
    }
public function RiskDataList(Request $request)
  {
    //return "ok";
     $query=DB::table('Risk_Category');
    //return $query;
          return DataTables::of($query)            
          ->addColumn('Category', function ($row) {
                return $row->User_Name;
            })
       
            
          ->addColumn('STATUS', function ($row) {
                return $row->Status;
            })
          ->addColumn('RowId', function ($row) {
                return $row->Id;
            })
            
          ->filter(function ($query) use ($request) {
              if ($request->has('Category') && !empty($request->Category)) {
                  $query->where('Category', 'like', '%'.$request->Category.'%');
              }
              
              // Add more individual column search filters as needed
          })
          ->toJson();
        
  }
public function CreateNewRisk(Request $request){
      
    $User=ucfirst($request->session()->get('username'));
    $UserRole=ucfirst($request->session()->get('Role'));
    $IPAddress=$request->ip();
    $URL=url()->full();  
    $Riskname=$request['Category'];
   
    
    if($UserRole != 'Root' && $UserRole != 'Admin' ){
     $ErrorLogs = new Error_Logs;
     $ErrorLogs->Source=$User;
     $ErrorLogs->Type='ACCESS';
     $ErrorLogs->IP_Address=$IPAddress;
     $ErrorLogs->URL=$URL;
     $ErrorLogs->Module='Risk_Creation';
     $ErrorLogs->Description='Access Denied [User: '.$User.', Role: '.$UserRole.']';
     $ErrorLogs->save(); 
     $Message=array('StatusCode'=>'03');
     }
    
    if($CheckUser > '0'){
    $ErrorLogs = new Error_Logs;
    $ErrorLogs->Source=$User;
    $ErrorLogs->Type='CREATE';
    $ErrorLogs->IP_Address=$IPAddress;
    $ErrorLogs->URL=$URL;
    $ErrorLogs->Module='Risk_Creation';
    $ErrorLogs->Description='User is Already Registered [Risk: '.$RiskName.']';
    $ErrorLogs->save();
    $Message=array('StatusCode'=>'02');    
    }
    if($CheckUser == '0'){
    if(!empty($Riskname) ){
        
    $ActivityLogs = new Activity_Logs;
    $ActivityLogs->Source=$User;
    $ActivityLogs->Type='CREATE';
    $ActivityLogs->IP_Address=$IPAddress;
    $ActivityLogs->URL=$URL;
    $ActivityLogs->Module='Risk_Creation';
    $ActivityLogs->Description='New User Created [Riskname: '.$Username.']';
    $ActivityLogs->save(); 
    
    $Users = new Users;
    $Users->User_Name=$Username;
  
    $Users->Updated_By=$User;
    $Users->save();
    $Message=array('StatusCode'=>'00');
    }
    if(empty($Username) || empty($Name) || empty($Email) || empty($Role)){
    $ErrorLogs = new Error_Logs;
    $ErrorLogs->Source=$User;
    $ErrorLogs->Type='CREATE';
    $ErrorLogs->IP_Address=$IPAddress;
    $ErrorLogs->URL=$URL;
    $ErrorLogs->Module='User_Creation';
    $ErrorLogs->Description='Mandatory Fields Blank [User: '.$Username.']';
    $ErrorLogs->save();
    $Message=array('StatusCode'=>'01');
    }
    }
    }
    return json_encode($Message);  
    }
public function ChangeUserStatus(Request $request){
     Users::where('Id',$request['Id'])->update(['Status'=>$request['NextStatus']]);
     $Message=array('StatusCode'=>'00');
     return json_encode($Message);    
    }
public function GetUserData(Request $request){
     $Message=array('StatusCode'=>'00','Username'=>$request['Username'],'Name'=>$request['Name'],'Email'=>$request['Email'],'Role'=>$request['Role'],'RowId'=>$request['RowId']);
     return json_encode($Message);    
    }
public function UpdateUser(Request $request){
    
    $User=ucfirst($request->session()->get('username'));
    $IPAddress=$request->ip();
    $URL=url()->full();  
    $Username=$request['Username_Edit'];
    $Name=$request['Name_Edit'];
    $Email=$request['Email_Edit'];
    $Role=$request['Role_Edit'];
    $RowId=$request['RowIdEdit'];
    $CheckUser=Users::where([['User_Name','=',$Username],['Id','!=',$RowId]])->count();
    
    if($CheckUser > '0'){
    $ErrorLogs = new Error_Logs;
    $ErrorLogs->Source=$User;
    $ErrorLogs->Type='UPDATE';
    $ErrorLogs->IP_Address=$IPAddress;
    $ErrorLogs->URL=$URL;
    $ErrorLogs->Module='User_Update';
    $ErrorLogs->Description='User is Already Registered in a Different Id [User: '.$Username.']';
    $ErrorLogs->save();
    $Message=array('StatusCode'=>'02');    
    }
    
    if($CheckUser == '0'){
    if(!empty($Username) && !empty($Name) && !empty($Email) && !empty($Role)){
        
    $ActivityLogs = new Activity_Logs;
    $ActivityLogs->Source=$User;
    $ActivityLogs->Type='UPDATE';
    $ActivityLogs->IP_Address=$IPAddress;
    $ActivityLogs->URL=$URL;
    $ActivityLogs->Module='User_Update';
    $ActivityLogs->Description='User Updated [Username: '.$Username.', Name: '.$Name.',Email: '.$Email.',Role: '.$Role.']';
    $ActivityLogs->save(); 
    
    Users::where('Id',$request['RowIdEdit'])->update(['User_Name'=>$Username,
    'Name'=>$Name,'Email'=>$Email,'Role'=>$Role,'Updated_By'=>$User]);
     
    $Message=array('StatusCode'=>'00');
    }
    if(empty($Username) || empty($Name) || empty($Email) || empty($Role)){
    $ErrorLogs = new Error_Logs;
    $ErrorLogs->Source=$User;
    $ErrorLogs->Type='UPDATE';
    $ErrorLogs->IP_Address=$IPAddress;
    $ErrorLogs->URL=$URL;
    $ErrorLogs->Module='User_Update';
    $ErrorLogs->Description='Mandatory Fields Blank [User: '.$Username.']';
    $ErrorLogs->save();
    $Message=array('StatusCode'=>'01');
    }
    }
     return json_encode($Message);    
    }
public function GetAssignedUserDivision(Request $request){
     $User=ucfirst($request->session()->get('username'));
     $UserRole=ucfirst($request->session()->get('Role')); 
     if($UserRole != 'Root'){
     $Data=DB::table('User_Division')
          ->leftJoin('Divisions','Divisions.Id','=','User_Division.Division_Id')
          ->where('User_Division.Username','=',$User)
          ->select('Divisions.Name','Divisions.Spoc','Divisions.Email','Divisions.Mobile',
         'Divisions.Department_Name','Divisions.Department_Id','Divisions.Company_Name',
         'Divisions.Company_Id','Divisions.Status','Divisions.Id')->get();
     $AssignData=User_Division::where('Username', $request['Username'])->get();
     $Message=array('StatusCode'=>'00','Username'=>$request['Username'],'Division_Count'=>count($Data),'Division'=>$Data,
     'Assign_Count'=>count($AssignData),'Assign_Division'=>$AssignData);
     }
     if($UserRole == 'Root'){
     $Data=Divisions::orderBy('Id', 'ASC')->get();   
     $AssignData=User_Division::where('Username', $request['Username'])->get();
     $Message=array('StatusCode'=>'00','Username'=>$request['Username'],'Division_Count'=>count($Data),'Division'=>$Data,
     'Assign_Count'=>count($AssignData),'Assign_Division'=>$AssignData);
     }
     return json_encode($Message);    
    }
public function AssignUserDivision(Request $request){
    
    $User=ucfirst($request->session()->get('username'));
    DB::table('User_Division')->where('Username', $request['AssignUsername'])->delete();
    $Count=count($request['DivisionId']);//return $request;
    for($i=0; $i<$Count; $i++){
    $Divisions=Divisions::where('Id',$request['DivisionId'][$i])->get();
    $User_Division = new User_Division;
    $User_Division->Username=$request['AssignUsername'];
    $User_Division->Division_Id=$request['DivisionId'][$i];
    $User_Division->Division_Name=$Divisions['0']['Name'];
    $User_Division->Updated_By=$User;
    $User_Division->save();
    }
     $Message=array('StatusCode'=>'00');
     return json_encode($Message);    
    }
}
