<title>PENDING RISKS</title>

@include('layouts.header')
  
<h2 style="color:#4A3B94;position:absolute;left:285px";align="right">PENDING APPROVALS</h2>

<br><br>
<form method="post" align="center" enctype="multipart/form-data" id="MyRisks" >
@csrf
<table id="example" class="table table-bordered site_data_datatable" style="padding: -30px; border-style: hidden; width: 98%;">
<thead style="border: 1px solid #E6E6E6;">
        <tr>
            <th>
    <h5>CREATED DATE</h5>
    </th>
    <th>
    <h5>ID</h5>
    </th>
     <th>
    <h5>TYPE</h5>
    </th>
    <th>
    <h5>TOPIC</h5>
    </th>
     <th>
    <h5>CATEGORY</h5>
    </th>
    <th>
    <h5>APPROVAL TYPE</h5>
    </th>
    <th>
    <h5>ACTION</h5>
    </th>
    </tr>
    </thead>
    <tbody style="border-top-style:hidden; border-bottom-style:hidden;">
    @foreach($Risk as $key => $data)
    @php
    if($data->Approval_Type == 'Re-Open'):
    $Color='#FFE4E4';
    $FontColor='#B00000';
    elseif( $data->Approval_Type == 'Close'):
    $Color='#E5FFE5';
    $FontColor='#008F02';
    else:
    $Color='#EBEBEB';
    $FontColor='#000000';
    endif;

    @endphp
    <tr>    
    <td>
    <h4>{{$data->Date_Time}}</h4>
    </td>
    <td>
    <h4>{{$data->Id}}</h4>
    </td>
    <td>
    <h4>{{$data->Type}}</h4>
    </td>
    <td>
    <h4>{{$data->Topic}}</h4>
    </td>
    <td>
    <h4>{{$data->Category}}</h4>
    </td>
    <td>
    <div style="background-color:{{$Color}}; border-radius: 5px;padding: 0px 0px; width:auto; display: inline-block; color:#FFFFFF;text-align: center;">
    <h4 style="font-size:12px; color:{{$FontColor}};">&nbsp;{{$data->Approval_Type}}&nbsp;</h4>
    </div>
    </td>
    <td>
    <input class="button" style="height: 20px; margin-top: 1px; background-color: #03A700;" type="button" value="APPROVE" onclick="ApproveRisk('ApproveRisk?RiskId={{$data->Id}}'); return false;" />&nbsp;
    <input class="button" style="height: 20px; margin-top: 1px; background-color: #B00000;" type="button" value="REJECT" onclick="RejectRisk('RejectRisk?RiskId={{$data->Id}}'); return false;" />&nbsp;
    <input class="button" style="height: 20px; margin-top: 1px;" type="button" value="VIEW" data-toggle="modal" data-target="#ViewRiskData"onclick="ViewRiskData('ViewRiskData?RiskId={{$data->Id}}'); return false;" />
    </td>
    </tr>
    @endforeach
    </tbody>
</table>
</form>
<div id="ViewRiskData" class="modal fade" role="dialog" style="width:100%;">
<div class="modal-dialog" style="width:100%;">

<!-- Modal content-->
<div class="modal-content" style="width:100%;">
<div class="modal-body" align="center" style="width:100%;">
<div id="ViewRiskData1">
</div>
</div>
 </div>
</div>
</div>