<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Message;

use App\Models\Error_Logs;
use App\Models\Activity_Logs;
use App\Models\Event_Logs;
use App\Models\Departments;
use App\Models\Companies;
use App\Models\Divisions;
use App\Models\User_Division;
use App\Models\Risks;
use App\Models\Risk_Category;
use App\Models\Users;
use App\Models\Risk_Levels;
use App\Models\KRI_Data;
use App\Models\Treatment_Data;
use App\Models\Mail_Template;
use DataTables;

class RiskController extends Controller
{
function MyRisks(Request $request){
    $User=ucfirst($request->session()->get('username'));
    $Role=ucfirst($request->session()->get('Role'));
    if($Role == 'Root'){
    $Data=Risks::orderBy('Id', 'DESC')->get();
    }
    if($Role == 'Admin'){
    $Data=User_Division::leftJoin('Risks','Risks.Risk_Division_Id','=','User_Division.Division_Id')
        ->where('User_Division.Username','=',$User)->orderBy('Risks.Id', 'DESC')->get();
    }
    if($Role == 'User'){
    $Data=Risks::Where('Created_Username',$User)->orderBy('Id', 'DESC')->get(); 
    }
    return view('/Risk.MyRisks',['Risk'=>$Data]);
}
private function AssignedRisks(Request $request){
    $User=ucfirst($request->session()->get('username'));
    //$Role=ucfirst($request->session()->get('Role'));
    
    $Data=DB::table('Risks')
    ->distinct()
    ->leftJoin('Treatment_Data', function($join) use ($User)
    {
        $join->on('Treatment_Data.Risk_Id', '=', 'Risks.Id');
        $join->on('Treatment_Data.Row_Status','=',DB::raw("'1'"));
    })
    ->orWhere('Treatment_Data.Action_Owner_Username','=',$User)
    ->orWhere('Risks.Owner_Username','=',$User)
    ->select('Risks.Date_Time','Risks.Id','Risks.Type','Risks.Topic','Risks.Category','Risks.Request_Status','Risks.Last_Updated','Risks.Owner_Username')
    ->orderBy('Risks.Id', 'DESC')->get();  
//return $Data;
    return view('/Risk.AssignedRisks',['Risk'=>$Data,'User'=>$User]);
}
private function ViewRiskData(Request $request){
    $Message=array('StatusCode'=>'00','RiskId'=>$request['RiskId']);
    return json_encode($Message);
}
private function ViewRiskHistory(Request $request){
    $Message=array('StatusCode'=>'00','RiskId'=>$request['RiskId']);
    return json_encode($Message);
}
private function ViewRiskId(Request $request){
    $CreatedUserId=ucfirst($request->session()->get('username'));
    $RiskId=$request['RiskId'];
    $RisksData=Risks::where('Id',$RiskId)->get(); 
    $KRIData=KRI_Data::where([['Risk_Id',$RiskId],['Status','1']])->get();
    $TreatmentData=Treatment_Data::where([['Risk_Id',$RiskId],['Row_Status','1']])->get();
    $CloseButton='1';
    for($i=0; $i<count($TreatmentData); $i++){
    if($TreatmentData[$i]['Status'] == 'Not started' || $TreatmentData[$i]['Status'] == 'Ongoing (ahead of time)'
    || $TreatmentData[$i]['Status'] == 'Ongoing (on time)' || $TreatmentData[$i]['Status'] == 'Ongoing (with delays)'){
    $CloseButton='0';    
    }
    }
     return view('Risk.ViewRisk',['RisksData'=>$RisksData,'KRIData'=>$KRIData,'TreatmentData'=>$TreatmentData,'CloseButton'=>$CloseButton,'Current_User'=>$CreatedUserId]);
}
private function ViewRiskHistoryId(Request $request){
    $RiskId=$request['RiskId']; 
    $RisksHistoryData=Event_Logs::where('Risk_Id',$RiskId)->orderBy('Date_Time', 'DESC')->get(); 
     return view('Risk.ViewRiskHistory',['RisksHistoryData'=>$RisksHistoryData]);
}
public function GetDivisionData(Request $request){
    $Divisions=Divisions::where('Id','=',$request['Division_Id'])->orderBy('Id', 'ASC')->get();
    $Message=array('StatusCode'=>'00','Divisions'=>$Divisions);
    return json_encode($Message);   
}
public function GetSubRiskCategory(Request $request){
     $Data=Risk_Category::where('Category',$request['RiskCategory'])->get();
     $Message=array('StatusCode'=>'00','SubRiskCategory'=>$Data,'Count'=>count($Data));
     return json_encode($Message);    
} 
public function GetRiskOwnerName(Request $request){
     $Data=Users::where('User_Name',$request['Owner_Id'])->get();
     $UserDivision=User_Division::where('Username',$request['Owner_Id'])->get();
     $UserDivisionCount=count($UserDivision);
     $Message=array('StatusCode'=>'00','UserData'=>$Data,'UserDivision'=>$UserDivision,'DivisionCount'=>$UserDivisionCount);
     return json_encode($Message);    
} 
public function GetActionOwners(Request $request){
     $Data=Users::orderBy('Name', 'ASC')->get();
     $Message=array('StatusCode'=>'00','DataCount'=>count($Data),'UserData'=>$Data);
     return json_encode($Message);    
} 
public function GetRiskDivisionName(Request $request){
     $Data=Divisions::where('Id',$request['Division_Id'])->get();
     $Message=array('StatusCode'=>'00','Data'=>$Data);
     return json_encode($Message);    
}
public function GetGrossRiskLevel(Request $request){
     $Data=Risk_Levels::where([['Likelihood_Level',$request['Analysis_Likelihood_Level']],
     ['Impact_Level',$request['Analysis_Impact_Level']]])->get();
     $Message=array('StatusCode'=>'00','Gross_Level'=>$Data['0']['Level']);
     return json_encode($Message);    
}
public function GetResidualRiskLevel(Request $request){
     $Data=Risk_Levels::where([['Likelihood_Level',$request['Evaluation_Likelihood_Level']],
     ['Impact_Level',$request['Evaluation_Impact_Level']]])->get();
     $Message=array('StatusCode'=>'00','Level'=>$Data['0']['Level']);
     return json_encode($Message);    
}
public function GetAvoidAcceptanceAttachment(Request $request){
    if($request['Avoid_Acceptance_Status'] == 'Accepted'){
    $Attachment='1';    
    }
    if($request['Avoid_Acceptance_Status'] == 'Pending'){
    $Attachment='0';    
    }
     $Message=array('StatusCode'=>'00','Attachment'=>$Attachment);
     return json_encode($Message);    
}
public function GetRiskStatusTypes(Request $request){
    if($request['Risk_Status'] == 'Avoid'){
    $Type='Avoid';    
    }
    if($request['Risk_Status'] == 'Change'){
    $Type='Change';     
    }
    if($request['Risk_Status'] == 'Share'){
    $Type='Share';     
    }
    if($request['Risk_Status'] == 'Retain'){
    $Type='Retain';     
    }
     $Message=array('StatusCode'=>'00','Type'=>$Type);
     return json_encode($Message);    
}
public function CreateRisk(Request $request){
    $UserId=$request->session()->get('username');
    $RiskId=$request['RiskId'];
    $RisksData=null; 
    $Data=User_Division::where([['Username',$UserId]])->orderBy('Division_Name', 'ASC')->get();
    if($RiskId > '0'){
    $RisksData=Risks::where('Id',$RiskId)->get();   
    }    
    $NextPage='2';
    return view('Risk.CreateRisk',['Divisions'=>$Data,'RiskId'=>$RiskId,'LastPage'=>'1','CurrentPage'=>'1','NextPage'=>$NextPage,'RisksData'=>$RisksData]);   
}
public function RiskCreation(Request $request){  
    $CreatedUserId=ucfirst($request->session()->get('username'));
    $CreatedUserName=ucfirst($request->session()->get('Name'));
    $RiskId=$request['RiskId'];
    $LastPage=$request['LastPage'];
    $CurrentPage=$request['Page'];
    $Action=$request['Action'];
    $RisksData=null; 
    if($CurrentPage == '2'){
    if($RiskId == '0'){
    $Risks = new Risks;
    $Risks->Company_Id=$request['Company_Id'];
    $Risks->Company_Name=$request['Company_Name'];
    $Risks->Department_Id=$request['Department_Id'];
    $Risks->Department_Name=$request['Department_Name'];
    $Risks->Division_Id=$request['Division_Id'];
    $Risks->Division_Name=$request['Division_Name'];
    $Risks->Type=$request['Type'];
    $Risks->Created_User_Name=$CreatedUserName;
    $Risks->Created_Username=$CreatedUserId;
    $Risks->Updated_By=$CreatedUserId;
    $Risks->save();
    $RiskId=$Risks->id;
    
    $EvenLog= new Event_Logs;
    $EvenLog->Risk_Id=$RiskId;
    $EvenLog->Username=$CreatedUserId;
    $EvenLog->Description='New risk creation started';
    $EvenLog->save();
    }
    if($RiskId > '0'){
    $LastRisksData=Risks::where('Id',$RiskId)->get();
    $LastDivisionName=$LastRisksData['0']['Division_Name'];
    $LastType=$LastRisksData['0']['Type'];
    if($LastDivisionName != $request['Division_Name'] && !empty($LastDivisionName)){
    $EvenLog= new Event_Logs;
    $EvenLog->Risk_Id=$RiskId;
    $EvenLog->Username=$CreatedUserId;
    $EvenLog->Description='Division changed';
    $EvenLog->Previous_Value=$LastDivisionName;
    $EvenLog->Current_Value=$request['Division_Name'];
    $EvenLog->save();    
    }
    if($LastType != $request['Type'] && !empty($LastType)){
    $EvenLog= new Event_Logs;
    $EvenLog->Risk_Id=$RiskId;
    $EvenLog->Username=$CreatedUserId;
    $EvenLog->Description='Risk type changed';
    $EvenLog->Previous_Value=$LastType;
    $EvenLog->Current_Value=$request['Type'];
    $EvenLog->save();    
    }
    
    Risks::where('Id',$RiskId)->update(['Company_Id'=>$request['Company_Id'],'Company_Name'=>$request['Company_Name'],
    'Department_Id'=>$request['Department_Id'],'Department_Name'=>$request['Department_Name'],'Division_Id'=>$request['Division_Id'],
    'Division_Name'=>$request['Division_Name'],'Type'=>$request['Type'],'Created_User_Name'=>$CreatedUserName,
    'Created_Username'=>$CreatedUserId,'Updated_By'=>$CreatedUserId]);    
    }
    $RisksData=Risks::where('Id',$RiskId)->get();    
    $Risk_Category=Risk_Category::orderBy('Category','ASC')->distinct()->get(['Category']);
    $Divisions=Divisions::orderBy('Department_Name','ASC')->get();
    $Users=Users::orderBy('Name','ASC')->get();
    $NextPage='3';
     return view('Risk.CreateRisk',['RiskId'=>$RiskId,'LastPage'=>($CurrentPage-1),'CurrentPage'=>$CurrentPage,'NextPage'=>$NextPage,
    'RisksData'=>$RisksData,'Category'=>$Risk_Category,'Users'=>$Users,'Divisions'=>$Divisions]); 
    }
    
    if($CurrentPage == '3'){
        
    $LastRisksData=Risks::where('Id',$RiskId)->get();

    if($LastRisksData['0']['Topic'] != $request['Topic'] && !empty($LastRisksData['0']['Topic'])){
    $EvenLog= new Event_Logs;
    $EvenLog->Risk_Id=$RiskId;
    $EvenLog->Username=$CreatedUserId;
    $EvenLog->Description='Topic changed';
    $EvenLog->Previous_Value=$LastRisksData['0']['Topic'];
    $EvenLog->Current_Value=$request['Topic'];
    $EvenLog->save();    
    }
    if($LastRisksData['0']['Description'] != $request['Description'] && !empty($LastRisksData['0']['Description'])){
    $EvenLog= new Event_Logs;
    $EvenLog->Risk_Id=$RiskId;
    $EvenLog->Username=$CreatedUserId;
    $EvenLog->Description='Description updated';
    $EvenLog->Previous_Value=$LastRisksData['0']['Description'];
    $EvenLog->Current_Value=$request['Description'];
    $EvenLog->save();   
    } 
    if($LastRisksData['0']['Objective'] != $request['Objective'] && !empty($LastRisksData['0']['Objective'])){
    $EvenLog= new Event_Logs;
    $EvenLog->Risk_Id=$RiskId;
    $EvenLog->Username=$CreatedUserId;
    $EvenLog->Description='Objective updated';
    $EvenLog->Previous_Value=$LastRisksData['0']['Objective'];
    $EvenLog->Current_Value=$request['Objective'];
    $EvenLog->save();    
    }
    if($LastRisksData['0']['Category'] != $request['RiskCategory'] && !empty($LastRisksData['0']['Category'])){
    $EvenLog= new Event_Logs;
    $EvenLog->Risk_Id=$RiskId;
    $EvenLog->Username=$CreatedUserId;
    $EvenLog->Description='Risk category changed';
    $EvenLog->Previous_Value=$LastRisksData['0']['Category'];
    $EvenLog->Current_Value=$request['RiskCategory'];
    $EvenLog->save();    
    }
    if($LastRisksData['0']['Sub_Category'] != $request['SubRiskCategory'] && !empty($LastRisksData['0']['Sub_Category'])){
    $EvenLog= new Event_Logs;
    $EvenLog->Risk_Id=$RiskId;
    $EvenLog->Username=$CreatedUserId;
    $EvenLog->Description='Sub category changed';
    $EvenLog->Previous_Value=$LastRisksData['0']['Sub_Category'];
    $EvenLog->Current_Value=$request['SubRiskCategory'];
    $EvenLog->save();    
    } 
    if($LastRisksData['0']['Owner_Name'] != $request['Owner_Name'] && !empty($LastRisksData['0']['Owner_Name'])){
    $EvenLog= new Event_Logs;
    $EvenLog->Risk_Id=$RiskId;
    $EvenLog->Username=$CreatedUserId;
    $EvenLog->Description='Risk owner changed';
    $EvenLog->Previous_Value=$LastRisksData['0']['Owner_Name'];
    $EvenLog->Current_Value=$request['Owner_Name'];
    $EvenLog->save();    
    }
    if($LastRisksData['0']['Risk_Division_Name'] != $request['Risk_Division_Name'] && !empty($LastRisksData['0']['Risk_Division_Name'])){
    $EvenLog= new Event_Logs;
    $EvenLog->Risk_Id=$RiskId;
    $EvenLog->Username=$CreatedUserId;
    $EvenLog->Description='Risk owner division changed';
    $EvenLog->Previous_Value=$LastRisksData['0']['Risk_Division_Name'];
    $EvenLog->Current_Value=$request['Risk_Division_Name'];
    $EvenLog->save();    
    }
    
    
    Risks::where('Id',$RiskId)->update(['Topic'=>$request['Topic'],'Description'=>$request['Description'],
    'Objective'=>$request['Objective'],'Category'=>$request['RiskCategory'],'Sub_Category'=>$request['SubRiskCategory'],
    'Owner_Username'=>$request['Owner_Id'],'Owner_Name'=>$request['Owner_Name'],'Risk_Division_Id'=>$request['Division_Id'],
    'Risk_Division_Name'=>$request['Risk_Division_Name']]);   
    $RisksData=Risks::where('Id',$RiskId)->get(); 
    $KRIData=KRI_Data::where([['Risk_Id',$RiskId],['Status','1']])->get();
    $NextPage='4';
     return view('Risk.CreateRisk',['RiskId'=>$RiskId,'LastPage'=>($CurrentPage-1),'CurrentPage'=>$CurrentPage,'NextPage'=>$NextPage,
    'RisksData'=>$RisksData,'KRIData'=>$KRIData]); 
    }
    
    if($CurrentPage == '4'){ 

    if(empty($request['KRI'])){
    $Data=array('title'=>'Oops!','text'=>'It looks like your trying to move ahead without providing the necessary KRI data','Type'=>'error','location'=>'0');
    return view('Error',['ErrorData'=>$Data]);
    }
    $KRIDataCount=count($request['KRI']);
    if($KRIDataCount > '0'){
    KRI_Data::where('Risk_Id',$RiskId)->update(['Status'=>'0']);
    for($i=0; $i<$KRIDataCount; $i++){ 
    $KRI_Data = new KRI_Data;
    $KRI_Data->Risk_Id=$RiskId;
    $KRI_Data->KRI=$request['KRI'][$i];
    $KRI_Data->Current_Status=$request['Current_Status'][$i];
    $KRI_Data->Risk_Tolerance=$request['Tolerance'][$i];
    $KRI_Data->Risk_Appetite=$request['Appetite'][$i];
    $KRI_Data->Risk_Threshold=$request['Threshold'][$i];
    $KRI_Data->save();    
    }
    }
    $LastRisksData=Risks::where('Id',$RiskId)->get();
    if($LastRisksData['0']['Root_Cause'] != $request['Root_Cause'] && !empty($LastRisksData['0']['Root_Cause'])){
    $EvenLog= new Event_Logs;
    $EvenLog->Risk_Id=$RiskId;
    $EvenLog->Username=$CreatedUserId;
    $EvenLog->Description='Root cause changed'; 
    $EvenLog->Previous_Value=$LastRisksData['0']['Root_Cause'];
    $EvenLog->Current_Value=$request['Root_Cause']; 
    $EvenLog->save();    
    }
    if($LastRisksData['0']['Impact'] != $request['Impact'] && !empty($LastRisksData['0']['Impact'])){
    $EvenLog= new Event_Logs;
    $EvenLog->Risk_Id=$RiskId;
    $EvenLog->Username=$CreatedUserId;
    $EvenLog->Description='Impact changed';
    $EvenLog->Previous_Value=$LastRisksData['0']['Impact'];
    $EvenLog->Current_Value=$request['Impact'];
    $EvenLog->save();    
    }
    if($LastRisksData['0']['Analysis_Likelihood_Level'] != $request['Analysis_Likelihood_Level'] && !empty($LastRisksData['0']['Analysis_Likelihood_Level'])){
    $EvenLog= new Event_Logs;
    $EvenLog->Risk_Id=$RiskId;
    $EvenLog->Username=$CreatedUserId;
    $EvenLog->Description='Analysis likelihood level lhanged';
    $EvenLog->Previous_Value=$LastRisksData['0']['Analysis_Likelihood_Level'];
    $EvenLog->Current_Value=$request['Analysis_Likelihood_Level'];
    $EvenLog->save();    
    }
    if($LastRisksData['0']['Analysis_Impact_Level'] != $request['Analysis_Impact_Level'] && !empty($LastRisksData['0']['Analysis_Impact_Level'])){
    $EvenLog= new Event_Logs;
    $EvenLog->Risk_Id=$RiskId;
    $EvenLog->Username=$CreatedUserId;
    $EvenLog->Description='Analysis impact level changed';
    $EvenLog->Previous_Value=$LastRisksData['0']['Analysis_Impact_Level'];
    $EvenLog->Current_Value=$request['Analysis_Impact_Level'];
    $EvenLog->save();    
    }
    if($LastRisksData['0']['Gross_Risk_Level'] != $request['Gross_Risk_Level'] && !empty($LastRisksData['0']['Gross_Risk_Level'])){
    $EvenLog= new Event_Logs;
    $EvenLog->Risk_Id=$RiskId;
    $EvenLog->Username=$CreatedUserId;
    $EvenLog->Description='Gross risk level changed';
    $EvenLog->Previous_Value=$LastRisksData['0']['Gross_Risk_Level'];
    $EvenLog->Current_Value=$request['Gross_Risk_Level'];
    $EvenLog->save();    
    }
    Risks::where('Id',$RiskId)->update(['Root_Cause'=>$request['Root_Cause'],'Impact'=>$request['Impact'],
    'Analysis_Likelihood_Level'=>$request['Analysis_Likelihood_Level'],
    'Analysis_Impact_Level'=>$request['Analysis_Impact_Level'],'Gross_Risk_Level'=>$request['Gross_Risk_Level']]);   
 
    $RisksData=Risks::where('Id',$RiskId)->get(); 
    $NextPage='5';
     return view('Risk.CreateRisk',['RiskId'=>$RiskId,'LastPage'=>($CurrentPage-1),'CurrentPage'=>$CurrentPage,'NextPage'=>$NextPage,
    'RisksData'=>$RisksData]); 
    }
    
    if($CurrentPage == '5'){ 
        
    $LastRisksData=Risks::where('Id',$RiskId)->get();
    if($LastRisksData['0']['Existing_Control'] != $request['Existing_Control'] && !empty($LastRisksData['0']['Existing_Control'])){
    $EvenLog= new Event_Logs;
    $EvenLog->Risk_Id=$RiskId;
    $EvenLog->Username=$CreatedUserId;
    $EvenLog->Description='Existing control changed';
    $EvenLog->Previous_Value=$LastRisksData['0']['Existing_Control'];
    $EvenLog->Current_Value=$request['Existing_Control'];
    $EvenLog->save();    
    }
    if($LastRisksData['0']['Control_Effectiveness'] != $request['Control_Effectiveness'] && !empty($LastRisksData['0']['Control_Effectiveness'])){
    $EvenLog= new Event_Logs;
    $EvenLog->Risk_Id=$RiskId;
    $EvenLog->Username=$CreatedUserId;
    $EvenLog->Description='Control effectiveness changed';
    $EvenLog->Previous_Value=$LastRisksData['0']['Control_Effectiveness'];
    $EvenLog->Current_Value=$request['Control_Effectiveness'];
    $EvenLog->save();    
    }
    if($LastRisksData['0']['Evaluation_Likelihood_Level'] != $request['Evaluation_Likelihood_Level'] && !empty($LastRisksData['0']['Evaluation_Likelihood_Level'])){
    $EvenLog= new Event_Logs;
    $EvenLog->Risk_Id=$RiskId;
    $EvenLog->Username=$CreatedUserId;
    $EvenLog->Description='Evaluation likelihood level changed';
    $EvenLog->Previous_Value=$LastRisksData['0']['Evaluation_Likelihood_Level'];
    $EvenLog->Current_Value=$request['Evaluation_Likelihood_Level'];
    $EvenLog->save();    
    }
    if($LastRisksData['0']['Evaluation_Impact_Level'] != $request['Evaluation_Impact_Level'] && !empty($LastRisksData['0']['Evaluation_Impact_Level'])){
    $EvenLog= new Event_Logs;
    $EvenLog->Risk_Id=$RiskId;
    $EvenLog->Username=$CreatedUserId;
    $EvenLog->Description='Evaluation impact level changed';
    $EvenLog->Previous_Value=$LastRisksData['0']['Evaluation_Impact_Level'];
    $EvenLog->Current_Value=$request['Evaluation_Impact_Level'];
    $EvenLog->save();    
    }
    if($LastRisksData['0']['Residual_Risk_Level'] != $request['Residual_Risk_Level'] && !empty($LastRisksData['0']['Residual_Risk_Level'])){
    $EvenLog= new Event_Logs;
    $EvenLog->Risk_Id=$RiskId;
    $EvenLog->Username=$CreatedUserId;
    $EvenLog->Description='Residual risk level changed';
    $EvenLog->Previous_Value=$LastRisksData['0']['Residual_Risk_Level'];
    $EvenLog->Current_Value=$request['Residual_Risk_Level'];
    $EvenLog->save();    
    }
    
    Risks::where('Id',$RiskId)->update(['Existing_Control'=>$request['Existing_Control'],
    'Control_Effectiveness'=>$request['Control_Effectiveness'],'Evaluation_Likelihood_Level'=>$request['Evaluation_Likelihood_Level'],
    'Evaluation_Impact_Level'=>$request['Evaluation_Impact_Level'],'Residual_Risk_Level'=>$request['Residual_Risk_Level']]);   
    
    $RisksData=Risks::where('Id',$RiskId)->get(); 
    $TreatmentData=Treatment_Data::where([['Risk_Id',$RiskId],['Row_Status','1']])->get();
    $NextPage='6';
    $Users=Users::orderBy('Name','ASC')->get();
     return view('Risk.CreateRisk',['RiskId'=>$RiskId,'LastPage'=>($CurrentPage-1),'CurrentPage'=>$CurrentPage,'NextPage'=>$NextPage,
    'RisksData'=>$RisksData,'TreatmentData'=>$TreatmentData,'Users'=>$Users]); 
    }
    
if ($CurrentPage == '6') {
    $Risk_Status = $request['Risk_Status'];
    if ($Risk_Status == 'Change' || $Risk_Status == 'Share') {
        $TreatmentDataCount = count($request['RiskTreatmentActivity']);
        if ($TreatmentDataCount > '0') {
            Treatment_Data::where('Risk_Id', $RiskId)->update(['Row_Status' => '0']);
            for ($i = 0; $i < $TreatmentDataCount; $i++) {
                $OwnerName = Users::where('User_Name', $request['RiskTreatmentOwner'][$i])->get();
                $Treatment_Data = new Treatment_Data;
                $Treatment_Data->Risk_Id = $RiskId;
                $Treatment_Data->Activity = $request['RiskTreatmentActivity'][$i];
                $Treatment_Data->Action_Owner_Username = $request['RiskTreatmentOwner'][$i];
                $Treatment_Data->Action_Owner_Name = $OwnerName['0']['Name'];
                $Treatment_Data->Action_Due = $request['RiskTreatmentActionDue'][$i];
                $Treatment_Data->Mitigation_Method = $request['RiskTreatmentMitigation'][$i];
                $Treatment_Data->Status = $request['RiskTreatmentStatus'][$i];
                $Treatment_Data->save();    
            }
        }
    }
    $pdf_filename='Unknown';
    $pdf_path = '';
    if ($request->hasFile('Acceptance_Attachment')) {

        $upload_dir=public_path('Files/');
        $pdf_filename=$request->file('Acceptance_Attachment')->getClientOriginalName();
        $FileType=$request->file('Acceptance_Attachment')->getClientOriginalExtension();
        $NewFileName=uniqid().".".$FileType;
        $pdf_path='Files/'.$NewFileName;
        $request->file('Acceptance_Attachment')->move($upload_dir, $NewFileName);
    }
    $LastRisksData=Risks::where('Id',$RiskId)->get();
    if($LastRisksData['0']['Status'] != $request['Risk_Status'] && !empty($LastRisksData['0']['Status'])){
    $EvenLog= new Event_Logs;
    $EvenLog->Risk_Id=$RiskId;
    $EvenLog->Username=$CreatedUserId;
    $EvenLog->Description='Risk status changed';
    $EvenLog->Previous_Value=$LastRisksData['0']['Status'];
    $EvenLog->Current_Value=$request['Risk_Status'];
    $EvenLog->save();    
    }
    if($LastRisksData['0']['Acceptance'] != $request['Avoid_Acceptance_Status'] && !empty($LastRisksData['0']['Acceptance'])){
    $EvenLog= new Event_Logs;
    $EvenLog->Risk_Id=$RiskId;
    $EvenLog->Username=$CreatedUserId;
    $EvenLog->Description='Acceptance changed';
    $EvenLog->Previous_Value=$LastRisksData['0']['Acceptance'];
    $EvenLog->Current_Value=$request['Avoid_Acceptance_Status'];
    $EvenLog->save();    
    }
    if($LastRisksData['0']['File_Name'] != $pdf_filename && !empty($LastRisksData['0']['File_Name'])){
    $EvenLog= new Event_Logs;
    $EvenLog->Risk_Id=$RiskId;
    $EvenLog->Username=$CreatedUserId;
    $EvenLog->Description='File changed';
    $EvenLog->Previous_Value=$LastRisksData['0']['File_Name'];
    $EvenLog->Current_Value=$pdf_filename;
    $EvenLog->save();    
    }
    Risks::where('Id', $RiskId)->update([
        'Status' => $request['Risk_Status'],
        'Acceptance' => $request['Avoid_Acceptance_Status'],
        'File_Path' => $pdf_path, // Save the PDF file path and name to the database
        'File_Name' => $pdf_filename
    ]);   
    
    $RisksData = Risks::where('Id', $RiskId)->get(); 
    $KRIData = KRI_Data::where([['Risk_Id', $RiskId], ['Status', '1']])->get();
    $TreatmentData = Treatment_Data::where([['Risk_Id', $RiskId], ['Row_Status', '1']])->get();
    $NextPage = '7';
    return view('Risk.CreateRisk', [
        'RiskId' => $RiskId,
        'LastPage' => ($CurrentPage - 1),
        'CurrentPage' => $CurrentPage,
        'NextPage' => $NextPage,
        'RisksData' => $RisksData,
        'KRIData' => $KRIData,
        'TreatmentData' => $TreatmentData
    ]); 
}

    if($CurrentPage == '7'){ 
              
        $RisksData=Risks::where('Id',$RiskId)->get();
        $CreatedUser=$RisksData['0']['Created_Username'];
        $ActionOwner=$RisksData['0']['Owner_Username'];
        $Division_Id=$RisksData['0']['Division_Id'];
        $LastRequestStatus=$RisksData['0']['Request_Status'];
        if($RisksData['0']['Status'] != 'Avoid'){
        $TreatmentData=Treatment_Data::leftJoin('Users','Users.User_Name','=','Treatment_Data.Action_Owner_Username')
        ->where('Treatment_Data.Risk_Id','=',$RiskId)
        ->where('Treatment_Data.Row_Status','=','1')->get();
        $TreatmentDataCount=count($TreatmentData);
        
        for($y=0; $y<$TreatmentDataCount; $y++){
        
        $ActionOwnerEmail=$TreatmentData[$y]['Email']; 
        $ActionOwnerSubject='Risk Registry: ['.$RiskId.']';
        $ActionOwnerBody="Dear ".strtok($TreatmentData[$y]['Name'], " ").",<br><br>
        ".strtok($RisksData['0']['Created_User_Name'], " ")." added new risk to the system and tagged you as the action owner. Please refer below for risk details. <br><br>
        RiskId: ".$RiskId."<br>
        Description: ".$RisksData['0']['Description']."<br>
        Impact: ".$RisksData['0']['Impact']."<br>
        Residual risk level: ".$RisksData['0']['Residual_Risk_Level']."<br>
        Risk Rationale: ".$RisksData['0']['Status']."<br>
        Action Owner: ".$RisksData['0']['Owner_Name']."<br><br>
        <a href='http://172.26.193.156:8000/MyRisks'>Click here to login</a><br><br>
        Thanks,<br>Risk Management Team.";
       // Mail::send([], [], function($message) use ($ActionOwnerEmail, $ActionOwnerSubject, $ActionOwnerBody) {
       // $message->to($ActionOwnerEmail)->subject($ActionOwnerSubject)->html($ActionOwnerBody);});
        }
        
        }
        $DepartmentAdmins=User_Division::leftJoin('Users','Users.User_Name','=','User_Division.Username')
        ->where('User_Division.Division_Id','=',$Division_Id)
        ->where('Users.Role','=','Admin')->get();
        $DepartmentAdminsCount=count($DepartmentAdmins);

        $Users=Users::orderBy('Name','ASC')->get();
        $UserDataCount=count($Users);
        
        for($i=0; $i<$UserDataCount; $i++){
        if($CreatedUser == $Users[$i]['User_Name']){
        $CreatedUserEmail=$Users[$i]['Email']; 
        $CreatedUserSubject='Risk Registry: ['.$RiskId.']';
        $CreatedUserBody="Dear ".strtok($RisksData['0']['Created_User_Name'], " ").",<br><br>
        ".strtok($RisksData['0']['Created_User_Name'], " ")." added new risk to the system and tagged you as the risk owner. Please refer below for risk details. <br><br>
        RiskId: ".$RiskId."<br>
        Description: ".$RisksData['0']['Description']."<br>
        Impact: ".$RisksData['0']['Impact']."<br>
        Residual risk level: ".$RisksData['0']['Residual_Risk_Level']."<br>
        Risk Rationale: ".$RisksData['0']['Status']."<br>
        Action Owner: ".$RisksData['0']['Owner_Name']."<br><br>
        <a href='http://172.26.193.156:8000/MyRisks'>Click here to login</a><br><br>
        Thanks,<br>Risk Management Team.";
        
       // Mail::send([], [], function($message) use ($CreatedUserEmail, $CreatedUserSubject, $CreatedUserBody) {
       // $message->to($CreatedUserEmail)->subject($CreatedUserSubject)->html($CreatedUserBody);});
        } 
        if($ActionOwner == $Users[$i]['User_Name']){
        $ActionOwnerEmail=$Users[$i]['Email']; 
        $ActionOwnerSubject='Risk Registry: ['.$RiskId.']';
        $ActionOwnerBody="Dear ".strtok($Users[$i]['Name'], " ").",<br><br>
        ".strtok($RisksData['0']['Created_User_Name'], " ")." added new risk to the system and tagged you as the action owner. Please refer below for risk details. <br><br>
        RiskId: ".$RiskId."<br>
        Description: ".$RisksData['0']['Description']."<br>
        Impact: ".$RisksData['0']['Impact']."<br>
        Residual risk level: ".$RisksData['0']['Residual_Risk_Level']."<br>
        Risk Rationale: ".$RisksData['0']['Status']."<br>
        Action Owner: ".$RisksData['0']['Owner_Name']."<br><br>
        <a href='http://172.26.193.156:8000/MyRisks'>Click here to login</a><br><br>
        Thanks,<br>Risk Management Team.";
        
       // Mail::send([], [], function($message) use ($ActionOwnerEmail, $ActionOwnerSubject, $ActionOwnerBody) {
       // $message->to($ActionOwnerEmail)->subject($ActionOwnerSubject)->html($ActionOwnerBody);});
        }       
        }
        for($x=0; $x<$DepartmentAdminsCount; $x++){
        
        $AdminEmail=$DepartmentAdmins[$x]['Email']; 
        $AdminSubject='Risk Registry: ['.$RiskId.']';
        $AdminBody="Dear ".strtok($DepartmentAdmins[$x]['Name'], " ").",<br><br>
        ".strtok($RisksData['0']['Created_User_Name'], " ")." added new risk to the system and risk details are as follows. <br><br>
        RiskId: ".$RiskId."<br>
        Description: ".$RisksData['0']['Description']."<br>
        Impact: ".$RisksData['0']['Impact']."<br>
        Residual risk level: ".$RisksData['0']['Residual_Risk_Level']."<br>
        Risk Rationale: ".$RisksData['0']['Status']."<br>
        Action Owner: ".$RisksData['0']['Owner_Name']."<br><br>
        <a href='http://172.26.193.156:8000/MyRisks'>Click here to login</a><br><br>
        Thanks,<br>Risk Management Team.";
       // Mail::send([], [], function($message) use ($AdminEmail, $AdminSubject, $AdminBody) {
       // $message->to($AdminEmail)->subject($AdminSubject)->html($AdminBody);});
        }
        
    Risks::where('Id',$RiskId)->update(['Request_Status'=>'In-Progress']);  
    if($LastRequestStatus == 'Draft'){
    $EvenLog= new Event_Logs;
    $EvenLog->Risk_Id=$RiskId;
    $EvenLog->Username=$CreatedUserId;
    $EvenLog->Description='New risk creation completed';
    $EvenLog->save();
    }
    $Data=array('title'=>'SAVED','text'=>'Risk data saved[Id: '.$RiskId.']!','Type'=>'success','location'=>'MyRisks');
    return view('Error',['ErrorData'=>$Data]); 
    }
     
}
public function RiskCreationBack(Request $request){  
    $CreatedUserId=$request->session()->get('username');
    $CreatedUserName=$request->session()->get('Name');
    $RiskId=$request['RiskId'];
    $CurrentPage=$request['Page'];  
    if($CurrentPage == '1'){
   // $Data=Divisions::orderBy('Id', 'ASC')->get();
    $Data=User_Division::where('Username',$CreatedUserId)->orderBy('Division_Name', 'ASC')->get();
    $RisksData=Risks::where('Id','=',$RiskId)->get();
    $NextPage='2';
    return view('Risk.CreateRisk',['Divisions'=>$Data,'RiskId'=>$RiskId,'LastPage'=>'0','CurrentPage'=>$CurrentPage,'NextPage'=>$NextPage,'RisksData'=>$RisksData]);   
    }
    if($CurrentPage == '2'){ 
    $RisksData=Risks::where('Id',$RiskId)->get();    
    $Risk_Category=Risk_Category::orderBy('Category','ASC')->distinct()->get(['Category']);
    $Divisions=Divisions::orderBy('Department_Name','ASC')->get();
    $Users=Users::orderBy('Name','ASC')->get();    
    $NextPage='3';
     return view('Risk.CreateRisk',['RiskId'=>$RiskId,'LastPage'=>($CurrentPage-1),'CurrentPage'=>$CurrentPage,'NextPage'=>$NextPage,
    'RisksData'=>$RisksData,'Category'=>$Risk_Category,'Users'=>$Users,'Divisions'=>$Divisions]); 
    }
    
    if($CurrentPage == '3'){
    $RisksData=Risks::where('Id',$RiskId)->get();
    $KRIData=KRI_Data::where([['Risk_Id',$RiskId],['Status','1']])->get();
    $NextPage='4';
     return view('Risk.CreateRisk',['RiskId'=>$RiskId,'LastPage'=>($CurrentPage-1),'CurrentPage'=>$CurrentPage,'NextPage'=>$NextPage,
    'RisksData'=>$RisksData,'KRIData'=>$KRIData]); 
    }
    
    if($CurrentPage == '4'){  
    $RisksData=Risks::where('Id',$RiskId)->get(); 
    $NextPage='5';
     return view('Risk.CreateRisk',['RiskId'=>$RiskId,'LastPage'=>($CurrentPage-1),'CurrentPage'=>$CurrentPage,'NextPage'=>$NextPage,
    'RisksData'=>$RisksData]); 
    }
    
    if($CurrentPage == '5'){ 
    $RisksData=Risks::where('Id',$RiskId)->get(); 
    $NextPage='6';
    $Users=Users::orderBy('Name','ASC')->get();
    $TreatmentData=Treatment_Data::where([['Risk_Id',$RiskId],['Row_Status','1']])->get();
     return view('Risk.CreateRisk',['RiskId'=>$RiskId,'LastPage'=>($CurrentPage-1),'CurrentPage'=>$CurrentPage,'NextPage'=>$NextPage,
    'RisksData'=>$RisksData,'TreatmentData'=>$TreatmentData,'Users'=>$Users,]); 
    }
    
    if($CurrentPage == '6'){ 
    $RisksData=Risks::where('Id',$RiskId)->get(); 
    $KRIData=KRI_Data::where('Risk_Id',$RiskId)->get(); 
    $NextPage='7';
     return view('Risk.CreateRisk',['RiskId'=>$RiskId,'LastPage'=>($CurrentPage-1),'CurrentPage'=>$CurrentPage,'NextPage'=>$NextPage,
    'RisksData'=>$RisksData,'KRIData'=>$KRIData]); 
    }
    if($CurrentPage == '7'){ 
    Risks::where('Id',$RiskId)->update(['Request_Status'=>'In-Progress']);   

    $Data=array('title'=>'CREATED','text'=>'Risk Created[Id: '.$RiskId.']!','Type'=>'success','location'=>'MyRisks');
    return view('Error',['ErrorData'=>$Data]); 
    }
     
}

function CloseRisk(Request $request){    
    $CreatedUserId=ucfirst($request->session()->get('username'));
    $CreatedUserName=ucfirst($request->session()->get('Name'));
    $RiskId=$request['RiskId']; 
    Risks::where('Id',$RiskId)->update(['Request_Status'=>'In-Progress','Approval'=>'Pending',
    'Approval_Type'=>'Closure','Approval_Requested_By'=>$CreatedUserId,'Approval_Requested_By_Name'=>$CreatedUserName]); 
    $EvenLog= new Event_Logs;
    $EvenLog->Risk_Id=$RiskId;
    $EvenLog->Username=$CreatedUserId;
    $EvenLog->Description='Risk closure approval request sent';
    $EvenLog->save();
    $RisksData=Risks::where('Id',$RiskId)->get(); 
    $Users=Users::where('User_Name',$RisksData['0']['Owner_Username'])->get();

    $RiskOwnerEmail=$Users['0']['Email']; 
    $RiskOwnerSubject='Risk Registry - Risk Closure: ['.$RiskId.']';
    $RiskOwnerBody="Dear ".strtok($Users['0']['Name'], " ").",<br><br>
    ".strtok($CreatedUserName, " ")." requested to close the risk with below comment. Kindly take action on the same. <br><br>
    RiskId: ".$RiskId."<br>
    Description: ".$RisksData['0']['Description']."<br>
    Impact: ".$RisksData['0']['Impact']."<br>
    Residual risk level: ".$RisksData['0']['Residual_Risk_Level']."<br>
    Risk Rationale: ".$RisksData['0']['Status']."<br>
    Action Owner: ".$RisksData['0']['Owner_Name']."<br><br>
    <a href='http://172.26.193.156:8000/MyRisks'>Click here to login</a><br><br>
    Thanks,<br>Risk Management Team.";

   // Mail::send([], [], function($message) use ($ActionOwnerEmail, $ActionOwnerSubject, $ActionOwnerBody) {
   // $message->to($ActionOwnerEmail)->subject($ActionOwnerSubject)->html($ActionOwnerBody);});
        
    $Message=array('StatusCode'=>'00','RiskId'=>$RiskId);
    return json_encode($Message);
}

function ReOpenRisk(Request $request){    
    $CreatedUserId=ucfirst($request->session()->get('username'));
    $CreatedUserName=ucfirst($request->session()->get('Name'));
    $RiskId=$request['RiskId']; 
    Risks::where('Id',$RiskId)->update(['Request_Status'=>'Completed','Approval'=>'Pending',
    'Approval_Type'=>'Re-Open','Approval_Requested_By'=>$CreatedUserId,'Approval_Requested_By_Name'=>$CreatedUserName]); 
    $EvenLog= new Event_Logs;
    $EvenLog->Risk_Id=$RiskId;
    $EvenLog->Username=$CreatedUserId;
    $EvenLog->Description='Risk closure approval request sent';
    $EvenLog->save();
    
    $RisksData=Risks::where('Id',$RiskId)->get(); 
    $Users=Users::where('User_Name',$RisksData['0']['Owner_Username'])->get();
    
    $RiskOwnerEmail=$Users['0']['Email']; 
    $RiskOwnerSubject='Risk Registry - Risk Closure: ['.$RiskId.']';
    $RiskOwnerBody="Dear ".strtok($Users['0']['Name'], " ").",<br><br>
    ".strtok($CreatedUserName, " ")." requested to re-open the risk with below comment. Kindly take action on the same. <br><br>
    RiskId: ".$RiskId."<br>
    Description: ".$RisksData['0']['Description']."<br>
    Impact: ".$RisksData['0']['Impact']."<br>
    Residual risk level: ".$RisksData['0']['Residual_Risk_Level']."<br>
    Risk Rationale: ".$RisksData['0']['Status']."<br>
    Action Owner: ".$RisksData['0']['Owner_Name']."<br><br>
    <a href='http://172.26.193.156:8000/MyRisks'>Click here to login</a><br><br>
    Thanks,<br>Risk Management Team.";

   // Mail::send([], [], function($message) use ($ActionOwnerEmail, $ActionOwnerSubject, $ActionOwnerBody) {
   // $message->to($ActionOwnerEmail)->subject($ActionOwnerSubject)->html($ActionOwnerBody);});
    
    $Message=array('StatusCode'=>'00','RiskId'=>$RiskId);
    return json_encode($Message);
}

function UpdateTreatmentData(Request $request){    
    $CreatedUserId=ucfirst($request->session()->get('username')); 
    $RiskId=$request['RiskId'];
    $Id=$request['Id']; 
    $TreatmentData=Treatment_Data::where('Id',$Id)->get();
    $RiskTreatmentMitigation='RiskTreatmentMitigation_'."$Id";
    $RiskTreatmentStatus='RiskTreatmentStatus_'."$Id";
    Treatment_Data::where('Id',$Id)->update(['Mitigation_Method'=>$request[$RiskTreatmentMitigation],'Status'=>$request[$RiskTreatmentStatus]]); 
    if($TreatmentData['0']['Mitigation_Method'] != $request[$RiskTreatmentMitigation]){
    $EvenLog= new Event_Logs;
    $EvenLog->Risk_Id=$RiskId;
    $EvenLog->Username=$CreatedUserId;
    $EvenLog->Description='Treatment data updated';
    $EvenLog->Previous_Value=$TreatmentData['0']['Mitigation_Method'];
    $EvenLog->Current_Value=$request[$RiskTreatmentMitigation];
    $EvenLog->save();
    }
    if($TreatmentData['0']['Status'] != $request[$RiskTreatmentStatus]){
    $EvenLog= new Event_Logs;
    $EvenLog->Risk_Id=$RiskId;
    $EvenLog->Username=$CreatedUserId;
    $EvenLog->Description='Treatment data updated';
    $EvenLog->Previous_Value=$TreatmentData['0']['Status'];
    $EvenLog->Current_Value=$request[$RiskTreatmentStatus];
    $EvenLog->save();
    }
    $Message=array('StatusCode'=>'00');
    return json_encode($Message);
}

function ApproveRisk(Request $request){    
    $CreatedUserId=ucfirst($request->session()->get('username'));
    $CreatedUserName=ucfirst($request->session()->get('Name'));
    $RiskId=$request['RiskId']; 
    $RisksData=Risks::where('Id',$RiskId)->get();
    if($RisksData['0']['Approval_Type'] == 'Closure'){
    $RequestStatus='Completed';
    }
    if($RisksData['0']['Approval_Type'] == 'Re-Open'){
    $RequestStatus='In-Progress';
    }
    Risks::where('Id',$RiskId)->update(['Request_Status'=>$RequestStatus,'Approval'=>'Approved']); 
    $EvenLog= new Event_Logs;
    $EvenLog->Risk_Id=$RiskId;
    $EvenLog->Username=$CreatedUserId;
    $EvenLog->Description='Risk approved by '.$CreatedUserName;
    $EvenLog->save();
    
    $CreatedUser=Users::where('User_Name',$RisksData['0']['Created_Username'])->get();
    $CreatedUserEmail=$CreatedUser['0']['Email']; 
    $CreatedUserSubject='Risk Registry - Risk Closure: ['.$RiskId.']';
    $CreatedUserBody="Dear ".strtok($CreatedUser['0']['Name'], " ").",<br><br>
    Risk ".$RiskId." closed by ".strtok($RisksData['0']['Approval_Requested_By_Name'], " ").". <br><br>
    Description: ".$RisksData['0']['Description']."<br>
    Impact: ".$RisksData['0']['Impact']."<br>
    Residual risk level: ".$RisksData['0']['Residual_Risk_Level']."<br>
    Risk Rationale: ".$RisksData['0']['Status']."<br>
    Action Owner: ".$RisksData['0']['Owner_Name']."<br><br>
    <a href='http://172.26.193.156:8000/MyRisks'>Click here to login</a><br><br>
    Thanks,<br>Risk Management Team.";

   // Mail::send([], [], function($message) use ($CreatedUserEmail, $CreatedUserSubject, $CreatedUserBody) {
   // $message->to($CreatedUserEmail)->subject($CreatedUserSubject)->html($CreatedUserBody);});
    
    $OwnerUser=Users::where('User_Name',$RisksData['0']['Owner_Username'])->get();
    $OwnerEmail=$OwnerUser['0']['Email']; 
    $OwnerSubject='Risk Registry - Risk Closure: ['.$RiskId.']';
    $OwnerBody="Dear ".strtok($OwnerUser['0']['Name'], " ").",<br><br>
    Risk ".$RiskId." closed by ".strtok($RisksData['0']['Approval_Requested_By_Name'], " ").". <br><br>
    Description: ".$RisksData['0']['Description']."<br>
    Impact: ".$RisksData['0']['Impact']."<br>
    Residual risk level: ".$RisksData['0']['Residual_Risk_Level']."<br>
    Risk Rationale: ".$RisksData['0']['Status']."<br>
    Action Owner: ".$RisksData['0']['Owner_Name']."<br><br>
    <a href='http://172.26.193.156:8000/MyRisks'>Click here to login</a><br><br>
    Thanks,<br>Risk Management Team.";

   // Mail::send([], [], function($message) use ($OwnerEmail, $OwnerSubject, $OwnerBody) {
   // $message->to($OwnerEmail)->subject($OwnerSubject)->html($OwnerBody);});
    
    $TreatmentData=Treatment_Data::leftJoin('Users','Users.User_Name','=','Treatment_Data.Action_Owner_Username')
    ->where('Treatment_Data.Risk_Id','=',$RiskId)
    ->where('Treatment_Data.Row_Status','=','1')->get();
    $TreatmentDataCount=count($TreatmentData);

    for($y=0; $y<$TreatmentDataCount; $y++){

    $ActionOwnerEmail=$TreatmentData[$y]['Email']; 
    $ActionOwnerSubject='Risk Registry - Risk Closure: ['.$RiskId.']';
    $ActionOwnerBody="Dear ".strtok($TreatmentData[$y]['Name'], " ").",<br><br>
    Risk ".$RiskId." closed by ".strtok($RisksData['0']['Approval_Requested_By_Name'], " ").". <br><br>
    Description: ".$RisksData['0']['Description']."<br>
    Impact: ".$RisksData['0']['Impact']."<br>
    Residual risk level: ".$RisksData['0']['Residual_Risk_Level']."<br>
    Risk Rationale: ".$RisksData['0']['Status']."<br>
    Action Owner: ".$RisksData['0']['Owner_Name']."<br><br>
    <a href='http://172.26.193.156:8000/MyRisks'>Click here to login</a><br><br>
    Thanks,<br>Risk Management Team.";
   // Mail::send([], [], function($message) use ($ActionOwnerEmail, $ActionOwnerSubject, $ActionOwnerBody) {
   // $message->to($ActionOwnerEmail)->subject($ActionOwnerSubject)->html($ActionOwnerBody);});
    }
    
    $Message=array('StatusCode'=>'00','RiskId'=>$RiskId);
    return json_encode($Message);
}

function RejectRisk(Request $request){    
    $CreatedUserId=ucfirst($request->session()->get('username'));
    $CreatedUserName=ucfirst($request->session()->get('Name'));
    $RiskId=$request['RiskId']; 
    $RisksData=Risks::where('Id',$RiskId)->get();
    Risks::where('Id',$RiskId)->update(['Approval'=>'Rejected']); 
    $EvenLog= new Event_Logs;
    $EvenLog->Risk_Id=$RiskId;
    $EvenLog->Username=$CreatedUserId;
    $EvenLog->Description='Risk rejected by '.$CreatedUserName;
    $EvenLog->save();
    
    $RequesterUser=Users::where('User_Name',$RisksData['0']['Approval_Requested_By'])->get();
    $RequesterEmail=$RequesterUser['0']['Email']; 
    $RequesterSubject='Risk Registry - Risk Closure: ['.$RiskId.']';
    $RequesterBody="Dear ".strtok($RequesterUser['0']['Name'], " ").",<br><br>
    Risk ".$RiskId." closure request rejected by ".strtok($CreatedUserName, " ").". <br><br>
    Description: ".$RisksData['0']['Description']."<br>
    Impact: ".$RisksData['0']['Impact']."<br>
    Residual risk level: ".$RisksData['0']['Residual_Risk_Level']."<br>
    Risk Rationale: ".$RisksData['0']['Status']."<br>
    Action Owner: ".$RisksData['0']['Owner_Name']."<br><br>
    <a href='http://172.26.193.156:8000/MyRisks'>Click here to login</a><br><br>
    Thanks,<br>Risk Management Team.";
    
    // Mail::send([], [], function($message) use ($RequesterEmail, $RequesterSubject, $RequesterBody) {
   // $message->to($RequesterEmail)->subject($RequesterSubject)->html($RequesterBody);});
  
    $Message=array('StatusCode'=>'00','RiskId'=>$RiskId);
    return json_encode($Message);
}

}
