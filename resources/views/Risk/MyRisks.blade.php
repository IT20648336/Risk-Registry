@include('layouts.header')
<title>My Risk's </title>
<form method="post" align="center" enctype="multipart/form-data" id="MyRisks">
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
    <h5>STATUS</h5>
    </th>
    <th>
    <h5>UPDATED DATE</h5>
    </th>
    <th>
    <h5>ACTION</h5>
    </th> 
</tr>
</thead>
<tbody style="border-top-style:hidden; border-bottom-style:hidden;">
@foreach($Risk as $key => $data)

@php

if($data->Request_Status == 'Draft'):
$Color='#EBEBEB';
$FontColor='#000000';
elseif( $data->Request_Status == 'In-Progress'):
$Color='#ECEDFF';
$FontColor='#000C9F';
elseif( $data->Request_Status == 'Reject'):
$Color='#FFE4E4';
$FontColor='#FFE4E4';
elseif( $data->Request_Status == 'Completed'):
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
    <h4 style="font-size:12px; color:{{$FontColor}};">&nbsp;{{$data->Request_Status}}&nbsp;</h4>
    </div>
    </td>
    <td>
    <h4>{{$data->Last_Updated}}</h4>
    </td>
    <td>
    <input class="button" style="height: 20px; margin-top: 1px;" type="button" value="VIEW" data-toggle="modal" data-target="#ViewRiskData"onclick="ViewRiskData('ViewRiskData?RiskId={{$data->Id}}'); return false;" />&nbsp;
    <input class="button" style="height: 20px; margin-top: 1px; background-color: #007C76;" type="button" value="HISTORY" data-toggle="modal" data-target="#ViewRiskHistory" onclick="ViewRiskHistory('ViewRiskHistory?RiskId={{$data->Id}}'); return false;" />&nbsp;
    <input class="button" style="height: 20px; margin-top: 1px; background-color: #D3D3D3; color:#000000;" type="button" value="EDIT" onclick="window.open('CreateRisk?RiskId={{$data->Id}}&Page=1')"/>
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

<div id="ViewRiskHistory" class="modal fade" role="dialog" style="width:100%;">
<div class="modal-dialog" style="width:70%;">

<!-- Modal content-->
<div class="modal-content" style="width:100%;">
<div class="modal-body" align="center" style="width:100%;">
<div id="ViewRiskHistory1">
</div>
</div>
 </div>
</div>
</div>