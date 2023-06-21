<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//use DataTables;
use App\Models\Error_Logs;
use App\Models\Activity_Logs;
use App\Models\Departments;
use App\Models\Companies;
use App\Models\Divisions;
use App\Models\User_Division;

class Hierarchycontroller extends Controller
{
    public function Departments(Request $request){
        
         $User=ucfirst($request->session()->get('username'));
         $UserRole=ucfirst($request->session()->get('Role'));         
         $IPAddress=$request->ip();
         $URL=url()->full();
         if($UserRole != 'Root'){
         $Data=Departments::where('Updated_By',$User)->orderBy('Id', 'ASC')->get();
         }
         if($UserRole == 'Root'){
         $Data=Departments::orderBy('Id', 'ASC')->get();
         }
         return view('Hierarchy.Departments',['Departments'=>$Data]);
      
    }
public function DataList(Request $request)
  {
    //return "ok";
     $query=DB::table('Users');
    //return $query;
          return DataTables::of($query)            
          ->addColumn('USERNAME', function ($row) {
                return $row->User_Name;
            })
            
          ->addColumn('NAME', function ($row) {
                return $row->Name;
            })
            
          ->addColumn('DESIGNATION', function ($row) {
                return $row->Designation;
            })
            
          ->addColumn('EMAIL', function ($row) {
                return $row->Email;
            })
            
          ->addColumn('MOBILE', function ($row) {
                return $row->Mobile;
            })
            
          ->addColumn('ROLE', function ($row) {
                return $row->Role;
            })
            
          ->addColumn('STATUS', function ($row) {
                return $row->Status;
            })
          ->addColumn('RowId', function ($row) {
                return $row->Id;
            })
            
          ->filter(function ($query) use ($request) {
              if ($request->has('User_Name') && !empty($request->User_Name)) {
                  $query->where('User_Name', 'like', '%'.$request->User_Name.'%');
              }
              if ($request->has('Name') && !empty($request->Name)) {
                  $query->where('Name', 'like', '%'.$request->Name.'%');
              }
              // Add more individual column search filters as needed
          })
          ->toJson();
        
  }
  public function GetCompanyData(Request $request){ 
      
     $User=ucfirst($request->session()->get('username'));
     $Role=ucfirst($request->session()->get('Role'));
     $IPAddress=$request->ip();
     $URL=url()->full();
     if($Role != 'Root' && $Role != 'Admin'){
     $ErrorLogs = new Error_Logs;
     $ErrorLogs->Source=$User;
     $ErrorLogs->Type='ACCESS';
     $ErrorLogs->IP_Address=$IPAddress;
     $ErrorLogs->URL=$URL;
     $ErrorLogs->Module='Hierarchy_Creation';
     $ErrorLogs->Description='Access Denied [User: '.$User.', Role: '.$Role.']';
     $ErrorLogs->save(); 
     $Message=array('StatusCode'=>'02');
     }
     if($Role == 'Root' || $Role == 'Admin'){
     $Data=Companies::orderBy('Id', 'ASC')->get();
     $Company_Id=$Data[0]['Id'];
     if($Company_Id > '0'){
     $Message=array('StatusCode'=>'00','Company_Id'=>$Data[0]['Id'],'Company_Name'=>$Data[0]['Name']);
     }
     if($Company_Id == '0'){
     $Message=array('StatusCode'=>'01','Company_Id'=>null,'Company_Name'=>null);
     }
     }
     return json_encode($Message);
    }
    
 public function GetDepartmentName(Request $request){
     $Data=Departments::where('Id',$request['Department_Id'])->get();
     $Message=array('StatusCode'=>'00','Department_Name'=>$Data[0]['Name']);
     return json_encode($Message);    
    }
  public function GetDepartmentNameDivision(Request $request){
     $Data=Departments::where('Id',$request['Department_Id_Edit'])->get();
     $Message=array('StatusCode'=>'00','Department_Name'=>$Data[0]['Name']);
     return json_encode($Message);    
    }   
   public function CreateNewDepartment(Request $request){
      
    $User=$request->session()->get('username');
    $Role=ucfirst($request->session()->get('Role'));
    $IPAddress=$request->ip();
    $URL=url()->full();
    $DepartmentName=$request['DepartmentName'];
    $Spoc=$request['Spoc'];
    $Email=$request['Email'];
    $Mobile=$request['Mobile'];
    $Company_Id=$request['Company_Id'];
    $Company_Name=$request['Company_Name'];
    
    if($Role != 'Root' && $Role != 'Admin'){
     $ErrorLogs = new Error_Logs;
     $ErrorLogs->Source=$User;
     $ErrorLogs->Type='ACCESS';
     $ErrorLogs->IP_Address=$IPAddress;
     $ErrorLogs->URL=$URL;
     $ErrorLogs->Module='Department_Creation';
     $ErrorLogs->Description='Access Denied [User: '.$User.', Role: '.$Role.']';
     $ErrorLogs->save(); 
     $Message=array('StatusCode'=>'03');
     }
    if($Role == 'Root' || $Role == 'Admin'){
    $CheckDataCount=Departments::where('Name','=',$DepartmentName)->count();
    if($CheckDataCount > '0'){
    $ErrorLogs = new Error_Logs;
    $ErrorLogs->Source=$User;
    $ErrorLogs->Type='CREATE';
    $ErrorLogs->IP_Address=$IPAddress;
    $ErrorLogs->URL=$URL;
    $ErrorLogs->Module='Department_Creation';
    $ErrorLogs->Description='Department is Already Registered [Name: '.$DepartmentName.']';
    $ErrorLogs->save();
    $Message=array('StatusCode'=>'02');    
    }
    if($CheckDataCount == '0'){
    if(!empty($DepartmentName) && !empty($Spoc) && !empty($Email) && !empty($Mobile) && !empty($Company_Id) && !empty($Company_Name)){
    $Departments = new Departments;
    $Departments->Name=$request['DepartmentName'];
    $Departments->Contact=$request['Spoc'];
    $Departments->Email=$request['Email'];
    $Departments->Mobile=$request['Mobile'];
    $Departments->Company_Id=$request['Company_Id'];
    $Departments->Company_Name=$request['Company_Name'];
    $Departments->Updated_By=$User;
    $Departments->save();
    
    $ActivityLogs = new Activity_Logs;
    $ActivityLogs->Source=$User;
    $ActivityLogs->Type='CREATE';
    $ActivityLogs->IP_Address=$IPAddress;
    $ActivityLogs->URL=$URL;
    $ActivityLogs->Module='Department_Creation';
    $ActivityLogs->Description='New Department Created [Name: '.$DepartmentName.']';
    $ActivityLogs->save();
    
    $Message=array('StatusCode'=>'00');
    }
    if(empty($DepartmentName) || empty($Spoc) || empty($Email) || empty($Mobile) || empty($Company_Id) || empty($Company_Name)){
    $ErrorLogs = new Error_Logs;
    $ErrorLogs->Source=$User;
    $ErrorLogs->Type='CREATE';
    $ErrorLogs->IP_Address=$IPAddress;
    $ErrorLogs->URL=$URL;
    $ErrorLogs->Module='Department_Creation';
    $ErrorLogs->Description='Mandatory Fields Blank [Name: '.$DepartmentName.']';
    $ErrorLogs->save();
    $Message=array('StatusCode'=>'01');
    }
    }
    }
    return json_encode($Message);
      
    }
    
public function ChangeDepartmentStatus(Request $request){
     Departments::where('Id',$request['Id'])->update(['Status'=>$request['NextStatus']]);
     $Message=array('StatusCode'=>'00');
     return json_encode($Message);    
    }
public function GetDepartmentData(Request $request){
     $Message=array('StatusCode'=>'00','RowId'=>$request['RowId'],'Name'=>$request['Name'],
     'Contact'=>$request['Contact'],'Email'=>$request['Email'],'Mobile'=>$request['Mobile']);
     return json_encode($Message);   
    }
public function UpdateDepartment(Request $request){
    if(strlen($request['DepartmentNameEdit'])> '0'){
     Departments::where('Id',$request['RowIdEdit'])->update(['Name'=>$request['DepartmentNameEdit'],'Contact'=>$request['SpocEdit'],
     'Email'=>$request['EmailEdit'],'Mobile'=>$request['MobileEdit']]);
     $Message=array('StatusCode'=>'00');
    }
    if(strlen($request['DepartmentNameEdit'])== '0'){
     $Message=array('StatusCode'=>'01');
    }
     return json_encode($Message);    
    }
    
public function Divisions(Request $request){
        
         $User=ucfirst($request->session()->get('username'));
         $UserRole=ucfirst($request->session()->get('Role')); 
         if($UserRole != 'Root'){
         $DepartmentData=Departments::where('Updated_By',$User)->orderBy('Id', 'ASC')->get();
         $Data=DB::table('User_Division')
          ->leftJoin('Divisions','Divisions.Id','=','User_Division.Division_Id')
          ->where('User_Division.Username','=',$User)
          ->select('Divisions.Name','Divisions.Spoc','Divisions.Email','Divisions.Mobile',
         'Divisions.Department_Name','Divisions.Department_Id','Divisions.Company_Name',
         'Divisions.Company_Id','Divisions.Status','Divisions.Id')->get();
         }
         if($UserRole == 'Root'){
         $DepartmentData=Departments::orderBy('Id', 'ASC')->get();
         $Data=Divisions::orderBy('Id', 'ASC')->get();
         }
         return view('Hierarchy.Divisions',['Divisions'=>$Data,'Departments'=>$DepartmentData]);
      
    } 
    
public function CreateNewDivision(Request $request){
      
    $User=$request->session()->get('username');
    $Role=ucfirst($request->session()->get('Role'));
    $IPAddress=$request->ip();
    $URL=url()->full();

    $DivisionName=$request['DivisionName'];
    $Spoc=$request['Spoc'];
    $Email=$request['Email'];
    $Mobile=$request['Mobile'];
    $Company_Id=$request['Company_Id'];
    $Company_Name=$request['Company_Name'];
    $Department_Id=$request['Department_Id'];
    $Department_Name=$request['Department_Name'];
    
    if($Role != 'Root' && $Role != 'Admin'){
     $ErrorLogs = new Error_Logs;
     $ErrorLogs->Source=$User;
     $ErrorLogs->Type='ACCESS';
     $ErrorLogs->IP_Address=$IPAddress;
     $ErrorLogs->URL=$URL;
     $ErrorLogs->Module='Division_Creation';
     $ErrorLogs->Description='Access Denied [User: '.$User.', Role: '.$Role.']';
     $ErrorLogs->save(); 
     $Message=array('StatusCode'=>'03');
     }
    if($Role == 'Root' || $Role == 'Admin'){
    $CheckDataCount=Divisions::where('Name','=',$DivisionName)->count();
    if($CheckDataCount > '0'){
    $ErrorLogs = new Error_Logs;
    $ErrorLogs->Source=$User;
    $ErrorLogs->Type='CREATE';
    $ErrorLogs->IP_Address=$IPAddress;
    $ErrorLogs->URL=$URL;
    $ErrorLogs->Module='Division_Creation';
    $ErrorLogs->Description='Division is Already Registered [Name: '.$DivisionName.']';
    $ErrorLogs->save();
    $Message=array('StatusCode'=>'02');    
    }
    if(!empty($DivisionName) && !empty($Spoc) && !empty($Email) && !empty($Mobile) && !empty($Company_Id) 
    && !empty($Company_Name) && !empty($Department_Id) && !empty($Department_Name)){
    $Divisions = new Divisions;
    $Divisions->Name=$DivisionName;
    $Divisions->Spoc=$Spoc;
    $Divisions->Email=$Email;
    $Divisions->Mobile=$Mobile;
    $Divisions->Company_Id=$Company_Id;
    $Divisions->Company_Name=$Company_Name;
    $Divisions->Department_Id=$Department_Id;
    $Divisions->Department_Name=$Department_Name;
    $Divisions->Updated_By=$User;
    $Divisions->save();
    $DivisionId=$Divisions->id;
    
    $User_Division = new User_Division;
    $User_Division->Username=$User;
    $User_Division->Division_Id=$DivisionId;
    $User_Division->Division_Name=$DivisionName;
    $User_Division->Updated_By=$User;
    $User_Division->save();
    
    $ActivityLogs = new Activity_Logs;
    $ActivityLogs->Source=$User;
    $ActivityLogs->Type='CREATE';
    $ActivityLogs->IP_Address=$IPAddress;
    $ActivityLogs->URL=$URL;
    $ActivityLogs->Module='Division_Creation';
    $ActivityLogs->Description='New Division Created [Name: '.$DivisionName.']';
    $ActivityLogs->save();
    $Message=array('StatusCode'=>'00');
    }
    if(empty($DivisionName) || empty($Spoc) || empty($Email) || empty($Mobile) || empty($Company_Id) 
    || empty($Company_Name) || empty($Department_Id) || empty($Department_Name)){
    $ErrorLogs = new Error_Logs;
    $ErrorLogs->Source=$User;
    $ErrorLogs->Type='CREATE';
    $ErrorLogs->IP_Address=$IPAddress;
    $ErrorLogs->URL=$URL;
    $ErrorLogs->Module='Division_Creation';
    $ErrorLogs->Description='Mandatory Fields Blank [Name: '.$DivisionName.']';
    $ErrorLogs->save();
    $Message=array('StatusCode'=>'01');
    }
    }
    return json_encode($Message);
      
    }
    
public function ChangeDivisionStatus(Request $request){
     Divisions::where('Id',$request['Id'])->update(['Status'=>$request['NextStatus']]);
     $Message=array('StatusCode'=>'00');
     return json_encode($Message);    
    }
public function GetDivisionData(Request $request){
     $DepartmentData=Departments::where('Id','!=',$request['Department_Id'])->orderBy('Id', 'ASC')->get();
     $Message=array('StatusCode'=>'00','RowId'=>$request['RowId'],'Name'=>$request['Name'],
     'Contact'=>$request['Spoc'],'Email'=>$request['Email'],'Mobile'=>$request['Mobile'],
     'Department_Name'=>$request['Department_Name'],'Department_Id'=>$request['Department_Id'],'Departments_Count'=>count($DepartmentData),'Departments'=>array($DepartmentData));
     return json_encode($Message);   
    }
public function UpdateDivision(Request $request){
    //return $request;
    if(strlen($request['DivisionNameEdit'])> '0' && strlen($request['Department_Name_Edit'])> '0' && strlen($request['Department_Id_Edit'])> '0'){
     Divisions::where('Id',$request['RowIdEdit'])->update(['Name'=>$request['DivisionNameEdit'],'Spoc'=>$request['SpocEdit'],
     'Email'=>$request['EmailEdit'],'Mobile'=>$request['MobileEdit'],'Department_Id'=>$request['Department_Id_Edit'],'Department_Name'=>$request['Department_Name_Edit']]);
     $Message=array('StatusCode'=>'00');
    }
    if(strlen($request['DivisionNameEdit'])== '0' || strlen($request['Department_Name_Edit']) == '0' || strlen($request['Department_Id_Edit'])== '0'){
     $Message=array('StatusCode'=>'01');
    }
     return json_encode($Message);    
    }
public function GetDivisionDataUser(Request $request){
     $Data=Divisions::orderBy('Id', 'ASC')->get();
     $Message=array('StatusCode'=>'00','Count'=>count($Data),'Divisions'=>$Data);
     return json_encode($Message);    
    }
}
