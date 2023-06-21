@include('layouts.header')
<title>RISK</title>
@php
if($CurrentPage == '1'){
@endphp
<form method="post" Action="RiskCreation?RiskId={{$RiskId}}&Page={{$NextPage}}" align="center" enctype="multipart/form-data" id="RiskDataStep_1">
@csrf
<table style="width: 90%;height: auto;margin: 0px auto; margin-left:auto; border: hidden;">  
    <tr>
        <td>
            <h4 style="font-size: 18px;">DIVISION SELECTION</h4><br>
        </td>
      </tr>
@php
if(!empty($RisksData)){
@endphp
@foreach($RisksData as $key => $data)
      <tr>
      <td style="border:hidden;text-align: left; width:50%">
      <label for="Student"><b>DIVISION:</b></label><br>                      
      <select style="width:100%;" name="Division_Id" id="Division_Id" class="DropDown" onchange="GetDivisionDataRC('GetDivisionDataRC'); return false;" required> 
      <option value="{{$data->Division_Id}}">{{$data->Division_Name}}</option>
      @foreach($Divisions as $key => $DivisionData)
      <option value="{{$DivisionData->Division_Id}}">{{$DivisionData->Division_Name}}</option>
      @endforeach
      </select>                      
     </td>
     <td style="border:hidden;text-align: left;">
      <label for="Student"><b>TYPE:</b></label><br>                      
      <select style="width:100%;" name="Type" id="Type" class="DropDown" required> 
      <option value="{{$data->Type}}">{{$data->Type}}</option>
      <option value="Divisional">Divisional</option>
      <option value="ERM">ERM</option>
      </select>                      
     </td>
     </tr>
     <tr>
        <td style="border:hidden;text-align: left;">
            <label for="Student"><b>DEPARTMENT:</b></label><br>
            <input style="width:100%;" type="text" id="Department_Name" name="Department_Name" readonly value="{{$data->Department_Name}}" required/>
        </td>
        <td style="border:hidden;text-align: left;">
            <label for="Student"><b>COMPANY:</b></label><br>
            <input style="width:100%;" type="text" id="Company_Name" name="Company_Name" readonly value="{{$data->Company_Name}}" required />
        </td>
     </tr>
<input type="hidden" id="Company_Id" name="Company_Id" value="{{$data->Company_Id}}" />
<input type="hidden" id="Division_Name" name="Division_Name" value="{{$data->Division_Name}}" />
<input type="hidden" id="Department_Id" name="Department_Id" value="{{$data->Department_Id}}" />
@endforeach
@php
}
if(empty($RisksData)){
@endphp
<tr>
      <td style="border:hidden;text-align: left; width:50%">
      <label for="Student"><b>DIVISION:</b></label><br>                      
      <select style="width:100%;" name="Division_Id" id="Division_Id" class="DropDown" onchange="GetDivisionDataRC('GetDivisionDataRC'); return false;" required> 
      <option value="">-SELECT-</option>
      @foreach($Divisions as $key => $DivisionData)
      <option value="{{$DivisionData->Division_Id}}">{{$DivisionData->Division_Name}}</option>
      @endforeach
      </select>                      
     </td>
     <td style="border:hidden;text-align: left;">
      <label for="Student"><b>TYPE:</b></label><br>                      
      <select style="width:100%;" name="Type" id="Type" class="DropDown" required> 
      <option value="">-SELECT-</option>
      <option value="Divisional">Divisional</option>
      <option value="ERM">ERM</option>
      </select>                      
     </td>
     </tr>
     <tr>
        <td style="border:hidden;text-align: left;">
            <label for="Student"><b>DEPARTMENT:</b></label><br>
            <input style="width:100%;" type="text" id="Department_Name" name="Department_Name" readonly required />
        </td>
        <td style="border:hidden;text-align: left;">
            <label for="Student"><b>COMPANY:</b></label><br>
            <input style="width:100%;" type="text" id="Company_Name" name="Company_Name" readonly  required />
        </td>
     </tr>
<input type="hidden" id="Company_Id" name="Company_Id" />
<input type="hidden" id="Division_Name" name="Division_Name"  />
<input type="hidden" id="Department_Id" name="Department_Id" />
@php
}
@endphp
     <tr>
        <td style="border:hidden;text-align: left;"><br>
        </td>
        <td style="border:hidden;text-align: right;"><br>
        <input class="button" align="right" type="submit" value="NEXT" style="width:25%; height: 25px;" />
        </td>
     </tr>
</table>
<br>
</form>
@php
}
if($CurrentPage == '2'){
@endphp
@foreach($RisksData as $key => $data)
<form method="post" Action="RiskCreation?RiskId={{$RiskId}}&Page={{$NextPage}}" align="center" enctype="multipart/form-data" id="RiskDataStep_2">
@csrf
<table style="width: 90%;height: auto;margin: 0px auto; border: hidden;">  
    <tr>
     <td>
     <h4 style="font-size: 18px;">RISK IDENTIFICATION</h4><br>
     </td>
     </tr>
     <tr>
     <td colspan="2" style="border:hidden;text-align: left; width:auto;">
     <label for="Student"><b>TOPIC:</b></label><br>  
     <input style="width:100%;" type="text" id="Topic" name="Topic" value="{{$data->Topic}}" required />
     </td>
     </tr>
     <tr>
     <td colspan="2" style="border:hidden;text-align: left; width:auto;">
     <label for="Student"><b>DESCRIPTION:</b></label><br>
     <textarea style="width:100%;" id="Description" name="Description" rows="4" cols="100" required>{{$data->Description}}</textarea>
     </td>
     </tr>
     <tr>
     <td colspan="2" style="border:hidden;text-align: left; width:auto;">
     <label for="Student"><b>OBJECTIVE IMPACTED BY THE RISK:</b></label><br>
     <textarea style="width:100%;" id="Objective" name="Objective" rows="4" cols="100" required>{{$data->Objective}}</textarea>
     </td>
     </tr>
     <tr>
     <td style="border:hidden;text-align: left; width:50%;">
     <label for="Student"><b>CATEGORY:</b></label><br>
     <select style="width:100%;" name="RiskCategory" id="RiskCategory" class="DropDown" onchange="GetSubRiskCategory('GetSubRiskCategory'); return false;" required> 
      <option value="{{$data->Category}}">{{$data->Category}}</option>
      @foreach($Category as $key => $CategoryData)
      <option value="{{$CategoryData->Category}}">{{$CategoryData->Category}}</option>
      @endforeach
      </select> 
     </td>
     <td style="border:hidden;text-align: left; width:auto;">
     <label for="Student"><b>SUB CATEGORY:</b></label><br>
     <select style="width:100%;" name="SubRiskCategory" id="SubRiskCategory" class="DropDown" required > 
      <option value="{{$data->Sub_Category}}">{{$data->Sub_Category}}</option>
      </select>
     </td>
     </tr>
     <tr>
     <td style="border:hidden;text-align: left; width:50%;">
     <label for="Student"><b>OWNER:</b></label><br>
     <select style="width:100%;" name="Owner_Id" id="Owner_Id" class="DropDown" onchange="GetRiskOwnerName('GetRiskOwnerName'); return false;" required> 
      <option value="{{$data->Owner_Username}}">{{$data->Owner_Name}}</option>
      @foreach($Users as $key => $UsersData)
      <option value="{{$UsersData->User_Name}}">{{$UsersData->Name}}</option>
      @endforeach
      </select> 
     </td>
     <td style="border:hidden;text-align: left; width:auto;">
     <label for="Student"><b>DIVISION:</b></label><br>
     <select style="width:100%;" name="Division_Id" id="Division_Id" class="DropDown" onchange="GetRiskDivisionName('GetRiskDivisionName'); return false;" required > 
      <option value="{{$data->Risk_Division_Id}}">{{$data->Risk_Division_Name}}</option>
      @foreach($Divisions as $key => $DivisionData)
      <option value="{{$DivisionData->Id}}">{{$DivisionData->Name}}</option>
      @endforeach
     </select>
     </td>
     </tr>
     <tr>
        <td style="border:hidden;text-align: left;"><br>
        <input class="button" align="right" type="button" value="BACK" style="width:25%; height: 25px; background-color: #D3D3D3; color:#000000;" onclick="location.href='RiskCreationBack?RiskId={{$RiskId}}&Page=1'" />
        </td>
        <td style="border:hidden;text-align: right;"><br>
        <input class="button" align="right" type="submit" value="NEXT" style="width:25%; height: 25px;" />
        </td>
     </tr>
</table>
<br>
<input type="hidden" id="Risk_Division_Name" name="Risk_Division_Name" value="{{$data->Risk_Division_Name}}"/>
<input type="hidden" id="Owner_Name" name="Owner_Name" value="{{$data->Owner_Name}}" />
</form>
@endforeach
@php
}
if($CurrentPage == '3'){
@endphp
@foreach($RisksData as $key => $data)
<form method="post" Action="RiskCreation?RiskId={{$RiskId}}&Page={{$NextPage}}" align="center" enctype="multipart/form-data" id="RiskDataStep_3">
@csrf
<table style="width: 90%;height: auto;margin: 0px auto; border: hidden;">  
    <tr>
     <td>
     <h4 style="font-size: 18px;">RISK ANALYSIS</h4><br>
     </td>
     </tr>
     <tr>
     <td colspan="3" style="border:hidden;text-align: left; width:auto;">
     <label for="Student"><b>Key Risk Indicator(KRI)</b></label><br>
     </td>
     </tr>
     <tr>
     <td colspan="4" style="border:hidden;text-align: left; width:auto;">
    <table style="width: 100%;height: auto;margin: 0px auto; border: hidden;" id="KRIDataTable" class="KRIDataTable"> 
    <tr>
     <td colspan="5" style="border:hidden;text-align: left; width:auto;">
     <a style="font-family:Calibri; text-decoration: none;" href="#" title="" class="AddKRIData">
     <input class="button" align="right" type="button" value="Add(+)"/>
     </a>
     <a style="font-family:Calibri; text-decoration: none;" href="#" title="" class="RemoveKRIData">
     <input class="button" align="right" type="button" value="Remove(-)" style="background-color: #D3D3D3; color:#000000;"/>
     </a>
     </td>
     </tr>
    <tr>
    <th>
    <h5 style="color: #6B6B6B; font-size: 14px;">KRI</h5>
    </th>
    <th>
    <h5 style="color: #6B6B6B; font-size: 14px;">CURRENT STATUS</h5>
    </th>
    <th>
    <h5 style="color: #6B6B6B; font-size: 14px;">TOLERANCE</h5>
    </th>
    <th>
    <h5 style="color: #6B6B6B; font-size: 14px;">APPETITE</h5>
    </th>
    <th>
    <h5 style="color: #6B6B6B; font-size: 14px;">THRESHOLD</h5>
    </th>    
    </tr>
    @foreach($KRIData as $key => $KRIDataRow)
     <tr>
     <td style="border:hidden;text-align: left; width:auto;">
     <input style="border-top-style: hidden;border-right-style: hidden;border-left-style: hidden;border-radius: 0px;" type="text" name="KRI[]" id="KRI[]" value="{{$KRIDataRow->KRI}}" />
     </td>
     <td style="border:hidden;text-align: left; width:auto;">
     <input style="border-top-style: hidden;border-right-style: hidden;border-left-style: hidden;border-radius: 0px;" type="text" name="Current_Status[]" id="Current_Status[]" value="{{$KRIDataRow->Current_Status}}" />
     </td>
     <td style="border:hidden;text-align: left; width:auto;">
     <input style="border-top-style: hidden;border-right-style: hidden;border-left-style: hidden;border-radius: 0px;" type="text" name="Tolerance[]" id="Tolerance[]" value="{{$KRIDataRow->Risk_Tolerance}}" />
     </td>
     <td style="border:hidden;text-align: left; width:auto;">
     <input style="border-top-style: hidden;border-right-style: hidden;border-left-style: hidden;border-radius: 0px;" type="text" name="Appetite[]" id="Appetite[]" value="{{$KRIDataRow->Risk_Appetite}}" />
     </td>
     <td style="border:hidden;text-align: left; width:auto;">
     <input style="border-top-style: hidden;border-right-style: hidden;border-left-style: hidden;border-radius: 0px;" type="text" name="Threshold[]" id="Threshold[]" value="{{$KRIDataRow->Risk_Threshold}}" />
     </td>
     </tr>
     @endforeach       
     </table>
     </td>
     </tr>
     <tr>
     <td colspan="3" style="border:hidden;text-align: left; width:auto;">
     <label for="Root_Cause"><b>ROOT CAUSE:</b></label><br>
     <select style="width:100%;" id="Root_Cause" name="Root_Cause" class="DropDown" required>
     <option value="Select"}}>Select</option>
     <option value="People Origin" {{$data->Root_Cause == 'People Origin' ? 'selected' : ''}}>People Origin</option>
     <option value="Process Origin" {{$data->Root_Cause == 'Process Origin' ? 'selected' : ''}}>Process Origin</option>
     <option value="Systems Origin" {{$data->Root_Cause == 'Systems Origin' ? 'selected' : ''}}>Systems Origin</option>
     <option value="People, Process Origin" {{$data->Root_Cause == 'People, Process Origin' ? 'selected' : ''}}>People, Process Origin</option>
     <option value="People, Systems Origin" {{$data->Root_Cause == 'People, Systems Origin' ? 'selected' : ''}}>People, Systems Origin</option>
     <option value="Process, Systems Origin" {{$data->Root_Cause == 'Process, Systems Origin' ? 'selected' : ''}}>Process, Systems Origin</option>
     <option value="People, Process, Systems Origin" {{$data->Root_Cause == 'People, Process, Systems Origin' ? 'selected' : ''}}>People, Process, Systems Origin</option>
     <option value="Other Externality" {{$data->Root_Cause == 'Other Externality' ? 'selected' : ''}}>Other Externality</option>
     </select>
     </td>
     </tr>
     <tr>
     <td colspan="3" style="border:hidden;text-align: left; width:auto;">
     <label for="Impact"><b>IMPACT:</b></label><br>
     <select style="width:100%;" id="Impact" name="Impact" class="DropDown" required>
     <option value="Select"}}>Select</option>
     <option value="Financial Only" {{$data->Impact == 'Financial Only' ? 'selected' : ''}}>Financial Only</option>
     <option value="Operational Only" {{$data->Impact == 'Operational Only' ? 'selected' : ''}}>Operational Only</option>
     <option value="Regulatory Only" {{$data->Impact == 'Regulatory Only' ? 'selected' : ''}}>Regulatory Only</option>
     <option value="Compliance Only" {{$data->Impact == 'Compliance Only' ? 'selected' : ''}}>Compliance Only</option>
     <option value="Financial, Operational" {{$data->Impact == 'Financial, Operational' ? 'selected' : ''}}>Financial, Operational</option>
     <option value="Financial, Regulatory" {{$data->Impact == 'Financial, Regulatory' ? 'selected' : ''}}>Financial, Regulatory</option>
     <option value="Financial, Compliance" {{$data->Impact == 'Financial, Compliance' ? 'selected' : ''}}>Financial, Compliance</option>
     <option value="Operational, Regulatory" {{$data->Impact == 'Operational, Regulatory' ? 'selected' : ''}}>Operational, Regulatory</option>
     <option value="Operational, Compliance" {{$data->Impact == 'Operational, Compliance' ? 'selected' : ''}}>Operational, Compliance</option>
     <option value="Regulatory, Compliance" {{$data->Impact == 'Regulatory, Compliance' ? 'selected' : ''}}>Regulatory, Compliance</option>
     <option value="Operational, Regulatory, Compliance" {{$data->Impact == 'Operational, Regulatory, Compliance' ? 'selected' : ''}}>Operational, Regulatory, Compliance</option>
     <option value="Financial, Regulatory, Compliance" {{$data->Impact == 'Financial, Regulatory, Compliance' ? 'selected' : ''}}>Financial, Regulatory, Compliance</option>
     <option value="Financial, Operational, Compliance" {{$data->Impact == 'Financial, Operational, Compliance' ? 'selected' : ''}}>Financial, Operational, Compliance</option>
     <option value="Financial, Operational, Regulatory" {{$data->Impact == 'Financial, Operational, Regulatory' ? 'selected' : ''}}>Financial, Operational, Regulatory</option>
     <option value="Financial, Operational, Regulatory, Compliance" {{$data->Impact == 'Financial, Operational, Regulatory, Compliance' ? 'selected' : ''}}>Financial, Operational, Regulatory, Compliance</option>
     </select>
     </td>
     </tr>
     <tr>
     <td style="border:hidden;text-align: center; width:auto;">
     <label for="Student" style="text-align: center;"><b>LIKELIHOOD LEVEL</b></label><br>
     </td>
     <td style="border:hidden;text-align: center; width:auto;">
     <label for="Student" style="text-align: center;"><b>IMPACT LEVEL</b></label><br>
     </td>
     <td style="border:hidden;text-align: center; width:auto;">
     <label for="Student" style="text-align: center;"><b>GROSS RISK LEVEL</b></label><br>
     </td>
     </tr>
     <tr>
     <td style="border:hidden;text-align: left; width:auto;">
     <div style="display: flex;">
     <input type="radio" id="Analysis_Likelihood_Level" name="Analysis_Likelihood_Level" value="Rare" onclick="GetGrossRiskLevel('GetGrossRiskLevel');" <?php if($RisksData['0']['Analysis_Likelihood_Level'] == 'Rare'){?> checked="checked" <?php } ?> >&nbsp;
     <h5 style="color: #6B6B6B; font-size: 14px; margin-top: 2px;">Rare</h5></div>
     </td>
     <td style="border:hidden;text-align: left; width:auto;">
     <div style="display: flex;">
     <input type="radio" id="Analysis_Impact_Level" name="Analysis_Impact_Level" value="Insignificant" onclick="GetGrossRiskLevel('GetGrossRiskLevel');" <?php if($RisksData['0']['Analysis_Impact_Level'] == 'Insignificant'){?> checked="checked" <?php } ?> >&nbsp;
     <h5 style="color: #6B6B6B; font-size: 14px; margin-top: 2px;">Insignificant</h5>
     </div>
     </td>
     <td style="border:hidden;text-align: left; width:auto;">
     <input type="text" style="width:20%;" name="Gross_Risk_Level" id="Gross_Risk_Level" readonly value="{{$data->Gross_Risk_Level}}" required />
     </td>
     </tr> 
     <tr>
     <td style="border:hidden;text-align: left; width:auto;">
     <div style="display: flex;">
     <input type="radio" id="Analysis_Likelihood_Level" name="Analysis_Likelihood_Level" value="Unlikely" onclick="GetGrossRiskLevel('GetGrossRiskLevel');" <?php if($RisksData['0']['Analysis_Likelihood_Level'] == 'Unlikely'){?> checked="checked" <?php } ?> >&nbsp;
     <h5 style="color: #6B6B6B; font-size: 14px; margin-top: 2px;">Unlikely</h5></div>
     </td>
     <td style="border:hidden;text-align: left; width:auto;">
     <div style="display: flex;">
     <input type="radio" id="Analysis_Impact_Level" name="Analysis_Impact_Level" value="Minor" onclick="GetGrossRiskLevel('GetGrossRiskLevel');" <?php if($RisksData['0']['Analysis_Impact_Level'] == 'Minor'){?> checked="checked" <?php } ?> >&nbsp;
     <h5 style="color: #6B6B6B; font-size: 14px; margin-top: 2px;">Minor</h5>
     </div>
     </td>
     <td style="border:hidden;text-align: left; width:auto;">
     </td>
     </tr>
     <tr>
     <td style="border:hidden;text-align: left; width:auto;">
     <div style="display: flex;">
     <input type="radio" id="Analysis_Likelihood_Level" name="Analysis_Likelihood_Level" value="Moderate" onclick="GetGrossRiskLevel('GetGrossRiskLevel');" <?php if($RisksData['0']['Analysis_Likelihood_Level'] == 'Moderate'){?> checked="checked" <?php } ?> >&nbsp;
     <h5 style="color: #6B6B6B; font-size: 14px; margin-top: 2px;">Moderate</h5></div>
     </td>
     <td style="border:hidden;text-align: left; width:auto;">
     <div style="display: flex;">
     <input type="radio" id="Analysis_Impact_Level" name="Analysis_Impact_Level" value="Moderate" onclick="GetGrossRiskLevel('GetGrossRiskLevel');" <?php if($RisksData['0']['Analysis_Impact_Level'] == 'Moderate'){?> checked="checked" <?php } ?> >&nbsp;
     <h5 style="color: #6B6B6B; font-size: 14px; margin-top: 2px;">Moderate</h5>
     </div>
     </td>
     <td style="border:hidden;text-align: left; width:auto;">
     </td>
     </tr>
     <tr>
     <td style="border:hidden;text-align: left; width:auto;">
     <div style="display: flex;">
     <input type="radio" id="Analysis_Likelihood_Level" name="Analysis_Likelihood_Level" value="Likely" onclick="GetGrossRiskLevel('GetGrossRiskLevel');" <?php if($RisksData['0']['Analysis_Likelihood_Level'] == 'Likely'){?> checked="checked" <?php } ?> >&nbsp;
     <h5 style="color: #6B6B6B; font-size: 14px; margin-top: 2px;">Likely</h5></div>
     </td>
     <td style="border:hidden;text-align: left; width:auto;">
     <div style="display: flex;">
     <input type="radio" id="Analysis_Impact_Level" name="Analysis_Impact_Level" value="Major" onclick="GetGrossRiskLevel('GetGrossRiskLevel');" <?php if($RisksData['0']['Analysis_Impact_Level'] == 'Major'){?> checked="checked" <?php } ?> >&nbsp;
     <h5 style="color: #6B6B6B; font-size: 14px; margin-top: 2px;">Major</h5>
     </div>
     </td>
     <td style="border:hidden;text-align: left; width:auto;">
     </td>
     </tr>
     <tr>
     <td style="border:hidden;text-align: left; width:auto;">
     <div style="display: flex;">
     <input type="radio" id="Analysis_Likelihood_Level" name="Analysis_Likelihood_Level" value="Al.Certain" onclick="GetGrossRiskLevel('GetGrossRiskLevel');" <?php if($RisksData['0']['Analysis_Likelihood_Level'] == 'Al.Certain'){?> checked="checked" <?php } ?> >&nbsp;
     <h5 style="color: #6B6B6B; font-size: 14px; margin-top: 2px;">Al.Certain</h5></div>
     </td>
     <td style="border:hidden;text-align: left; width:auto;">
     <div style="display: flex;">
     <input type="radio" id="Analysis_Impact_Level" name="Analysis_Impact_Level" value="Catastrophic" onclick="GetGrossRiskLevel('GetGrossRiskLevel');" <?php if($RisksData['0']['Analysis_Impact_Level'] == 'Catastrophic'){?> checked="checked" <?php } ?> >&nbsp;
     <h5 style="color: #6B6B6B; font-size: 14px; margin-top: 2px;">Catastrophic</h5>
     </div>
     </td>
     <td style="border:hidden;text-align: left; width:auto;">
     </td>
     </tr>
</table>
<table style="width: 90%;height: auto;margin: 0px auto; border: hidden;"> 
    <tr>
        <td style="border:hidden;text-align: left; "><br>
        <input class="button" align="right" type="button" value="BACK" style="width:25%; height: 25px; background-color: #D3D3D3; color:#000000;" onclick="location.href='RiskCreationBack?RiskId={{$RiskId}}&Page=2'" />
        </td>
        <td style="border:hidden;text-align: right;"><br>
        <input class="button" align="right" type="submit" value="NEXT" style="width:25%; height: 25px;" />
        </td>
     </tr>
</table>
<br>
<input type="hidden" id="Division_Name" name="Division_Name"/>
<input type="hidden" id="Owner_Name" name="Owner_Name"/>
</form>
@endforeach
@php
}
if($CurrentPage == '4'){
@endphp
@foreach($RisksData as $key => $data)
<form method="post" Action="RiskCreation?RiskId={{$RiskId}}&Page={{$NextPage}}" align="center" enctype="multipart/form-data" id="RiskDataStep_4">
@csrf
<table style="width: 90%;height: auto;margin: 0px auto; border: hidden;">  
    <tr>
     <td>
     <h4 style="font-size: 18px;">RISK EVALUATION</h4><br>
     </td>
     </tr>
     <tr>
     <td colspan="3" style="border:hidden;text-align: left; width:auto;">
     <label for="Student"><b>EXISTING CONTROL:</b></label><br>  
     <input style="width:100%;" type="text" id="Existing_Control" name="Existing_Control" value="{{$data->Existing_Control}}" required/>
     </td>
     </tr>
     <tr>
     <td colspan="3" style="border:hidden;text-align: left; width:50%;">
     <label for="Student"><b>CONTROL EFFECTIVENESS:</b></label><br>
     <select style="width:100%;" name="Control_Effectiveness" id="Control_Effectiveness" class="DropDown" required> 
      <option value="{{$data->Control_Effectiveness}}">{{$data->Control_Effectiveness}}</option>
      <option value="Ineffective (<25%)">Ineffective (<25%)</option>
      <option value="Fairly Effective (25%<50%)">Fairly Effective (25%<50%)</option>
      <option value="Mostly Effective (50%<75%)">Mostly Effective (50%<75%)</option>
      <option value="Effective (>75%)">Effective (>75%)</option>
     </select><br><br>
     </td>
     </tr>
     <tr>
     <td style="border:hidden;text-align: center; width:auto;">
     <label for="Student" style="text-align: center;"><b>LIKELIHOOD LEVEL</b></label><br>
     </td>
     <td style="border:hidden;text-align: center; width:auto;">
     <label for="Student" style="text-align: center;"><b>IMPACT LEVEL</b></label><br>
     </td>
     <td style="border:hidden;text-align: center; width:auto;">
     <label for="Student" style="text-align: center;"><b>Residual Risk Level (After Control Effectiveness)</b></label><br>
     </td>
     </tr>
     <tr>
     <td style="border:hidden;text-align: left; width:auto;">
     <div style="display: flex;">
     <input type="radio" id="Evaluation_Likelihood_Level" name="Evaluation_Likelihood_Level" value="Rare" onclick="GetResidualRiskLevel('GetResidualRiskLevel');" <?php if($RisksData['0']['Evaluation_Likelihood_Level'] == 'Rare'){?> checked="checked" <?php } ?> >&nbsp;
     <h5 style="color: #6B6B6B; font-size: 14px; margin-top: 2px;">Rare</h5></div>
     </td>
     <td style="border:hidden;text-align: left; width:auto;">
     <div style="display: flex;">
     <input type="radio" id="Evaluation_Impact_Level" name="Evaluation_Impact_Level" value="Insignificant" onclick="GetResidualRiskLevel('GetResidualRiskLevel');" <?php if($RisksData['0']['Evaluation_Impact_Level'] == 'Insignificant'){?> checked="checked" <?php } ?> >&nbsp;
     <h5 style="color: #6B6B6B; font-size: 14px; margin-top: 2px;">Insignificant</h5>
     </div>
     </td>
     <td style="border:hidden;text-align: left; width:auto;">
     <input type="text" style="width:20%;" name="Residual_Risk_Level" id="Residual_Risk_Level" readonly value="{{$RisksData['0']['Residual_Risk_Level']}}" required />
     </td>
     </tr> 
     <tr>
     <td style="border:hidden;text-align: left; width:auto;">
     <div style="display: flex;">
     <input type="radio" id="Evaluation_Likelihood_Level" name="Evaluation_Likelihood_Level" value="Unlikely" onclick="GetResidualRiskLevel('GetResidualRiskLevel');" <?php if($RisksData['0']['Evaluation_Likelihood_Level'] == 'Unlikely'){?> checked="checked" <?php } ?> >&nbsp;
     <h5 style="color: #6B6B6B; font-size: 14px; margin-top: 2px;">Unlikely</h5></div>
     </td>
     <td style="border:hidden;text-align: left; width:auto;">
     <div style="display: flex;">
     <input type="radio" id="Evaluation_Impact_Level" name="Evaluation_Impact_Level" value="Minor" onclick="GetResidualRiskLevel('GetResidualRiskLevel');" <?php if($RisksData['0']['Evaluation_Impact_Level'] == 'Minor'){?> checked="checked" <?php } ?> >&nbsp;
     <h5 style="color: #6B6B6B; font-size: 14px; margin-top: 2px;">Minor</h5>
     </div>
     </td>
     <td style="border:hidden;text-align: left; width:auto;">
     </td>
     </tr>
     <tr>
     <td style="border:hidden;text-align: left; width:auto;">
     <div style="display: flex;">
     <input type="radio" id="Evaluation_Likelihood_Level" name="Evaluation_Likelihood_Level" value="Moderate" onclick="GetResidualRiskLevel('GetResidualRiskLevel');" <?php if($RisksData['0']['Evaluation_Likelihood_Level'] == 'Moderate'){?> checked="checked" <?php } ?> >&nbsp;
     <h5 style="color: #6B6B6B; font-size: 14px; margin-top: 2px;">Moderate</h5></div>
     </td>
     <td style="border:hidden;text-align: left; width:auto;">
     <div style="display: flex;">
     <input type="radio" id="Evaluation_Impact_Level" name="Evaluation_Impact_Level" value="Moderate" onclick="GetResidualRiskLevel('GetResidualRiskLevel');" <?php if($RisksData['0']['Evaluation_Impact_Level'] == 'Moderate'){?> checked="checked" <?php } ?> >&nbsp;
     <h5 style="color: #6B6B6B; font-size: 14px; margin-top: 2px;">Moderate</h5>
     </div>
     </td>
     <td style="border:hidden;text-align: left; width:auto;">
     </td>
     </tr>
     <tr>
     <td style="border:hidden;text-align: left; width:auto;">
     <div style="display: flex;">
     <input type="radio" id="Evaluation_Likelihood_Level" name="Evaluation_Likelihood_Level" value="Likely" onclick="GetResidualRiskLevel('GetResidualRiskLevel');" <?php if($RisksData['0']['Evaluation_Likelihood_Level'] == 'Likely'){?> checked="checked" <?php } ?> >&nbsp;
     <h5 style="color: #6B6B6B; font-size: 14px; margin-top: 2px;">Likely</h5></div>
     </td>
     <td style="border:hidden;text-align: left; width:auto;">
     <div style="display: flex;">
     <input type="radio" id="Evaluation_Impact_Level" name="Evaluation_Impact_Level" value="Major" onclick="GetResidualRiskLevel('GetResidualRiskLevel');" <?php if($RisksData['0']['Evaluation_Impact_Level'] == 'Major'){?> checked="checked" <?php } ?> >&nbsp;
     <h5 style="color: #6B6B6B; font-size: 14px; margin-top: 2px;">Major</h5>
     </div>
     </td>
     <td style="border:hidden;text-align: left; width:auto;">
     </td>
     </tr>
     <tr>
     <td style="border:hidden;text-align: left; width:auto;">
     <div style="display: flex;">
     <input type="radio" id="Evaluation_Likelihood_Level" name="Evaluation_Likelihood_Level" value="Al.Certain" onclick="GetResidualRiskLevel('GetResidualRiskLevel');" <?php if($RisksData['0']['Evaluation_Likelihood_Level'] == 'Al.Certain'){?> checked="checked" <?php } ?> >&nbsp;
     <h5 style="color: #6B6B6B; font-size: 14px; margin-top: 2px;">Almost Certain</h5></div>
     </td>
     <td style="border:hidden;text-align: left; width:auto;">
     <div style="display: flex;">
     <input type="radio" id="Evaluation_Impact_Level" name="Evaluation_Impact_Level" value="Catastrophic" onclick="GetResidualRiskLevel('GetResidualRiskLevel');" <?php if($RisksData['0']['Evaluation_Impact_Level'] == 'Catastrophic'){?> checked="checked" <?php } ?> >&nbsp;
     <h5 style="color: #6B6B6B; font-size: 14px; margin-top: 2px;">Catastrophic</h5>
     </div>
     </td>
     <td style="border:hidden;text-align: left; width:auto;">
     </td>
     </tr>
</table>
<table style="width: 90%;height: auto;margin: 0px auto; border: hidden;"> 
    <tr>
        <td style="border:hidden;text-align: left;"><br>
          <input class="button" align="right" type="button" value="BACK" style="width:25%; height: 25px; background-color: #D3D3D3; color:#000000;" onclick="location.href='RiskCreationBack?RiskId={{$RiskId}}&Page=3'" />
        </td>

        <td style="border:hidden;text-align: right;"><br>
        <input class="button" align="right" type="submit" value="NEXT" style="width:25%; height: 25px;" />
        </td>
     </tr>
</table>
<br>
<input type="hidden" id="Division_Name" name="Division_Name"/>
<input type="hidden" id="Owner_Name" name="Owner_Name"/>
</form>
@endforeach
@php
}
if($CurrentPage == '5'){
@endphp
@foreach($RisksData as $key => $data)
<form method="post" Action="RiskCreation?RiskId={{$RiskId}}&Page={{$NextPage}}" align="center" enctype="multipart/form-data" id="RiskDataStep_5">
@csrf
<table style="width: 90%;height: auto;margin: 0px auto; border: hidden;">  
    <tr>
     <td>
     <h4 style="font-size: 18px;">RISK MITIGATION</h4><br>
     </td>
     </tr>
     <tr>
     <td colspan="3" style="border:hidden;text-align: left; width:50%;">
     <label for="Student"><b>Risk Treatment Option:</b></label><br>
     <select style="width:100%;" name="Risk_Status" id="Risk_Status" class="DropDown" onchange="GetRiskStatusTypes('GetRiskStatusTypes');" required > 
      <option value="{{$data->Status}}">{{$data->Status}}</option>
      <option value="Avoid" data-bs-toggle="tooltip" data-bs-placement="right" title="By informed decision, avoid a risky situation. If doing an activity is a risk Not doing it. If stopping an activity is a risk- Not stopping it.">Avoid</option>
      <option value="Change" data-bs-toggle="tooltip" data-bs-placement="right" title="By informed decision, Risk Owners decide to retain or accept the risk and undertakes to manage both impact and likelihood of the risk">Change</option>
      <option value="Share" data-bs-toggle="tooltip" data-bs-placement="right" title="Eliminate the source of risk or reduce the likelihood of occurance (with preventive controls) and/ or minimise the impact (with corrcetive/ compensating controls)">Share</option>
      <option value="Retain" data-bs-toggle="tooltip" data-bs-placement="right" title="Transfer or share part of the risk (i.e., burden of loss) to a third party. This usually involves a cost to financially tranfer the risk (eg. Insurance, Outsourcing, etc.)">Retain</option>
     </select><br><br>
     </td>
     </tr>
</table>
<div style="<?php if($RisksData['0']['Status'] != 'Avoid'){?> display:none; <?php } ?>" id="TreatmentDivAvoid">
<table style="width: 90%;height: auto;margin: 0px auto; border: hidden;" id="TreatmentTableAvoid" class="TreatmentTableAvoid">  
     <tr>
     <td colspan="3" style="border:hidden;text-align: left; width:auto;">
     <div style="display: flex;">
      <label for="Student" style="text-align: center;"><b>ACCEPTANCE:</b></label>&nbsp;
     <input type="radio" id="Evaluation_Likelihood_Level" name="Avoid_Acceptance_Status" value="Accepted" onclick="GetAvoidAcceptanceAttachment('GetAvoidAcceptanceAttachment');" <?php if($RisksData['0']['Acceptance'] == 'Accepted'){?> checked <?php } ?> >&nbsp;
     <h5 style="color: #6B6B6B; font-size: 14px; margin-top: 2px;">Accepted</h5>&nbsp;&nbsp;&nbsp;
     <input type="radio" id="Evaluation_Impact_Level" name="Avoid_Acceptance_Status" value="Pending" onclick="GetAvoidAcceptanceAttachment('GetAvoidAcceptanceAttachment');" <?php if($RisksData['0']['Acceptance'] == 'Pending'){?> checked <?php } ?> >&nbsp;
     <h5 style="color: #6B6B6B; font-size: 14px; margin-top: 2px;">Pending</h5>
     </div>
     </td>
     </tr>
</table>
</div> 
<div style="<?php if($RisksData['0']['Status'] != 'Share' && $RisksData['0']['Status'] != 'Change' && $RisksData['0']['Status'] != 'Retain'){?> display:none; <?php } ?>" id="TreatmentDivChange">
<table style="width: 90%;height: auto;margin: 0px auto; border: hidden;" id="RiskTreatmentChange" class="RiskTreatmentChange"> 
    <tr>
     <td colspan="5" style="border:hidden;text-align: left; width:auto;">
     <a style="font-family:Calibri; text-decoration: none;" href="#" title="" class="AddTreatmentData">
     <input class="button" align="right" type="button" value="Add(+)"/>
     </a>
     <a style="font-family:Calibri; text-decoration: none;" href="#" title="" class="RemoveTreatmentData">
     <input class="button" align="right" type="button" value="Remove(-)" style="background-color: #D3D3D3; color:#000000;"/>
     </a>
     </td>
     </tr>
    <tr>
    <th>
    <h5 style="color: #6B6B6B; font-size: 14px;">RESPONSE ACTIVITY</h5>
    </th>
    <th>
    <h5 style="color: #6B6B6B; font-size: 14px;">ACTION OWNER</h5>
    </th>
    <th>
    <h5 style="color: #6B6B6B; font-size: 14px;">ACTION DUE</h5>
    </th>
    <th>
    <h5 style="color: #6B6B6B; font-size: 14px;">MITIGATION EFFECTIVENESS</h5>
    </th>
    <th>
    <h5 style="color: #6B6B6B; font-size: 14px;">STATUS</h5>
    </th>    
    </tr>
    @foreach($TreatmentData as $key => $TreatmentDataRow)
    <tr>
     <td style="border:hidden;text-align: left; width:auto;">
     <input style="border-top-style: hidden;border-right-style: hidden;border-left-style: hidden;border-radius: 0px;" type="text" name="RiskTreatmentActivity[]" id="RiskTreatmentActivity[]" value="{{$TreatmentDataRow->Activity}}" />
     </td>
     <td style="border:hidden;text-align: left; width:auto;">
     <select style="width:100%;" name="RiskTreatmentOwner[]" id="RiskTreatmentOwner[]" class="DropDown"> 
      <option value="{{$TreatmentDataRow->Action_Owner_Username}}">{{$TreatmentDataRow->Action_Owner_Name}}</option>
      @foreach($Users as $key => $UsersData)
      <option value="{{$UsersData->User_Name}}">{{$UsersData->Name}}</option>
      @endforeach
     </select>
     </td>
     <td style="border:hidden;text-align: left; width:auto;">
     <input style="border-top-style: hidden;border-right-style: hidden;border-left-style: hidden;border-radius: 0px;" type="date" name="RiskTreatmentActionDue[]" id="RiskTreatmentActionDue[]" value="{{$TreatmentDataRow->Action_Due}}" />
     </td>
     <td style="border:hidden;text-align: left; width:auto;">
     <select style="width:100%;" name="RiskTreatmentMitigation[]" id="RiskTreatmentMitigation[]" class="DropDown"> 
      <option value="{{$TreatmentDataRow->Mitigation_Method}}">{{$TreatmentDataRow->Mitigation_Method}}</option>
      <option value="Ineffective (<25%)">Ineffective (<25%)</option>
      <option value="Fairly Effective (25%<50%)">Fairly Effective (25%<50%)</option>
      <option value="Mostly Effective (50%<75%)">Mostly Effective (50%<75%)</option>
      <option value="Effective (>75%)">Effective (>75%)</option>
     </select>
     </td>
     <td style="border:hidden;text-align: left; width:auto;">
     <select style="width:100%;" name="RiskTreatmentStatus[]" id="RiskTreatmentStatus[]" class="DropDown"> 
      <option value="{{$TreatmentDataRow->Status}}">{{$TreatmentDataRow->Status}}</option>
      <option value="Completed">Completed</option>
      <option value="Ongoing">Ongoing</option>
      <option value="To Start">To Start</option> 
      <option value="Delay">Delay</option>
      <option value="Redirected">Redirected</option> 
     </select>
     </td>
     </tr>  
     @endforeach
     </table>
</div>
<table style="width: 90%;height: auto;margin: 0px auto; border: hidden;"> 
    <tr>
        <td style="border:hidden;text-align: left;"><br>
        <input class="button" align="right" type="button" value="BACK" style="width:25%; background-color: #D3D3D3; color:#000000;" onclick="location.href='RiskCreationBack?RiskId={{$RiskId}}&Page=4'" />
        </td>
        <td style="border:hidden;text-align: right;"><br>
        <input class="button" align="right" type="submit" value="NEXT" style="width:25%; height: 25px;" />
        </td>
     </tr>
</table>
<br>
<input type="hidden" id="Division_Name" name="Division_Name"/>
<input type="hidden" id="Owner_Name" name="Owner_Name"/>
</form>
@endforeach
@php
}
if($CurrentPage == '6'){
@endphp
@foreach($RisksData as $key => $data)
<form method="post" Action="RiskCreation?RiskId={{$RiskId}}&Page={{$NextPage}}" align="center" enctype="multipart/form-data" id="RiskDataStep_5">
@csrf
<table style="width: 90%;height: auto;margin: 0px auto; border: hidden;">  
    <tr>
     <td>
     <h4 style="font-size: 18px;">RISK REVIEW</h4><br>
     </td>
     </tr>
     <tr>
     <td style="border:hidden;text-align: left; width:50%;">
     <label for="Student"><b>COMPANY:</b></label><br>
     <h5>{{$data->Company_Name}}</h5>
     </td>
     </tr>
     <tr>
     <td style="border:hidden;text-align: left; width:50%;">
     <label for="Student"><b>DEPARTMENT:</b></label><br>
     <h5>{{$data->Department_Name}}</h5>
     </td>
     </tr>
     <tr>
     <td style="border:hidden;text-align: left; width:50%;">
     <label for="Student"><b>DIVISION:</b></label><br>
     <h5>{{$data->Division_Name}}</h5>
     </td>
     </tr>
     <tr>
     <td style="border:hidden;text-align: left; width:50%;">
     <label for="Student"><b>TYPE:</b></label><br>
     <h5>{{$data->Type}}</h5>
     </td>
     </tr>
     <tr>
     <td style="border:hidden;text-align: left; width:50%;">
     <label for="Student"><b>TOPIC:</b></label><br>
     <h5>{{$data->Topic}}</h5>
     </td>
     </tr>
     <tr>
     <td style="border:hidden;text-align: left; width:50%;">
     <label for="Student"><b>DESCRIPTION:</b></label><br>
     <h5>{{$data->Description}}</h5>
     </td>
     </tr>
     <tr>
     <td style="border:hidden;text-align: left; width:50%;">
     <label for="Student"><b>OBJECTIVE:</b></label><br>
     <h5>{{$data->Objective}}</h5>
     </td>
     </tr>
     <tr>
     <td style="border:hidden;text-align: left; width:50%;">
     <label for="Student"><b>CATEGORY:</b></label><br>
     <h5>{{$data->Objective}}</h5>
     </td>
     </tr>
     <tr>
     <td style="border:hidden;text-align: left; width:50%;">
     <label for="Student"><b>SUB CATEGORY:</b></label><br>
     <h5>{{$data->Sub_Category}}</h5>
     </td>
     </tr>
     <tr>
     <td style="border:hidden;text-align: left; width:50%;">
     <label for="Student"><b>OWNER:</b></label><br>
     <h5>{{$data->Owner_Name}}</h5>
     </td>
     </tr>
     <tr>
     <td style="border:hidden;text-align: left; width:50%;">
     <label for="Student"><b>OWNER DIVISION:</b></label><br>
     <h5>{{$data->Risk_Division_Name}}</h5>
     </td>
     </tr>
     <tr>
     <td style="border:hidden;text-align: left; width:50%;">
     <label for="Student"><b>KEY RISK INDICATORS:</b></label><br>
    <table style="width: 100%;height: auto;margin: 0px auto; border: hidden;"> 
    <tr>
    <th>
    <h5 style="color: #6B6B6B; font-size: 14px;">KRI</h5>
    </th>
    <th>
    <h5 style="color: #6B6B6B; font-size: 14px;">STATUS</h5>
    </th>
    <th>
    <h5 style="color: #6B6B6B; font-size: 14px;">TOLERANCE</h5>
    </th>
    <th>
    <h5 style="color: #6B6B6B; font-size: 14px;">APPETITE</h5>
    </th>
    <th>
    <h5 style="color: #6B6B6B; font-size: 14px;">THRESHOLD</h5>
    </th>    
    </tr>
    @foreach($KRIData as $key => $KRI)
     <tr>
     <td style="border:hidden;text-align: left; width:auto;">
     <h4>{{$KRI->KRI}}</h4>
     </td>
     <td style="border:hidden;text-align: left; width:auto;">
     <h4>{{$KRI->Current_Status}}</h4>
     </td>
     <td style="border:hidden;text-align: left; width:auto;">
     <h4>{{$KRI->Risk_Tolerance}}</h4>
     </td>
     <td style="border:hidden;text-align: left; width:auto;">
     <h4>{{$KRI->Risk_Appetite}}</h4>
     </td>
     <td style="border:hidden;text-align: left; width:auto;">
     <h4>{{$KRI->Risk_Threshold}}</h4>
     </td>
     </tr>
    @endforeach     
     </table>
     </td>
     </tr>
     <tr>
     <td style="border:hidden;text-align: left; width:50%;">
     <label for="Student"><b>ROOT CAUSE:</b></label><br>
     <h5>{{$data->Root_Cause}}</h5>
     </td>
     </tr>
     <tr>
     <td style="border:hidden;text-align: left; width:50%;">
     <label for="Student"><b>IMPACT:</b></label><br>
     <h5>{{$data->Impact}}</h5>
     </td>
     </tr>
     <tr>
     <td style="border:hidden;text-align: left; width:50%;">
     <label for="Student"><b>CONTROL EFFECTIVENESS:</b></label><br>
     <h5>{{$data->Control_Effectiveness}}</h5>
     </td>
     </tr>
     <tr>
     <td style="border:hidden;text-align: left; width:50%;">
     <label for="Student"><b>DIVISION:</b></label><br>
     <h5>{{$data->Division_Name}}</h5>
     </td>
     </tr>
     <tr>
     <td style="border:hidden;text-align: left; width:50%;">
     <label for="Student"><b>STATUS:</b></label><br>
     <h5>{{$data->Status}}</h5>
     </td>
     </tr>
    @php
    if($data->Status == 'Share' || $data->Status == 'Change' || $data->Status == 'Retain'){
    @endphp
     <tr>
    <td style="border:hidden;text-align: left; width:50%;">
    <table style="width: 100%;height: auto;margin: 0px auto; border: hidden;"> 
    <tr>
    <th>
    <h5 style="color: #6B6B6B; font-size: 14px;">RESPONSE ACTIVITY</h5>
    </th>
    <th>
    <h5 style="color: #6B6B6B; font-size: 14px;">ACTION OWNER</h5>
    </th>
    <th>
    <h5 style="color: #6B6B6B; font-size: 14px;">ACTION DUE</h5>
    </th>
    <th>
    <h5 style="color: #6B6B6B; font-size: 14px;">MITIGATION METHOD</h5>
    </th>
    <th>
    <h5 style="color: #6B6B6B; font-size: 14px;">STATUS</h5>
    </th>    
    </tr>
    @foreach($TreatmentData as $key => $TreatmentDataRow)
     <tr>
     <td style="border:hidden;text-align: left; width:auto;">
     <h4>{{$TreatmentDataRow->Activity}}</h4>
     </td>
     <td style="border:hidden;text-align: left; width:auto;">
     <h4>{{$TreatmentDataRow->Action_Owner_Name}}</h4>
     </td>
     <td style="border:hidden;text-align: left; width:auto;">
     <h4>{{$TreatmentDataRow->Action_Due}}</h4>
     </td>
     <td style="border:hidden;text-align: left; width:auto;">
     <h4>{{$TreatmentDataRow->Mitigation_Method}}</h4>
     </td>
     <td style="border:hidden;text-align: left; width:auto;">
     <h4>{{$TreatmentDataRow->Status}}</h4>
     </td>
     </tr>
    @endforeach     
     </table>
     </td>
     </tr>
     @php
     }
    @endphp
    @php
    if($data->Status == 'Avoid'){
    @endphp
    <tr>
    <td style="border:hidden;text-align: left; width:50%;">
    <a href="{{$data->File_Path}}" target="_blank">{{$data->File_Name}}</a>
     </td>
     </tr>
     @php
     }
    @endphp  
</table>
<table style="width: 90%;height: auto;margin: 0px auto; border: hidden;"> 
    <tr>
        <td style="border:hidden;text-align: left;"><br>
        <input class="button" align="right" type="button" value="BACK" style="width:25%; height: 25px; background-color: #D3D3D3; color:#000000;" onclick="location.href='RiskCreationBack?RiskId={{$RiskId}}&Page=5'" />
        </td>
        <td style="border:hidden;text-align: right;"><br>
        <input class="button" align="right" type="submit" value="FINISHED" style="width:25%; height: 25px;" />
        </td>
     </tr>
</table>
<br>
<input type="hidden" id="Division_Name" name="Division_Name"/>
<input type="hidden" id="Owner_Name" name="Owner_Name"/>
</form>
@endforeach
@php
}
@endphp
