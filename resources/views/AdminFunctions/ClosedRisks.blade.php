

<title>CLOSED RISKS</title>

@include('layouts.header')

<h2 style="color:#4A3B94;position:absolute;left:324px";align="right">CLOSED RISKS</h2>


<br><br>
<form method="post" align="center" enctype="multipart/form-data" id="ClosedRisks">
@csrf
<table>
<tr>
    <th>
    <h5>RISK ID</h5>
    </th>
    <th>
    <h5>RISK NAME</h5>
    </th>
     <th>
    <h5>RISK OWNER</h5>
    </th>
    <th>
    <h5>RISK RESPONSE</h5>
    </th>
     <th>
    <h5>CLOSED DATE</h5>
    </th>
     <th>
    <h5></h5>
    </th>
   
   
   
</tr>

@foreach($Risk as $key => $data)

<tr>
    <td>
    <h4>{{$data->Id}}</h4>
    </td>
    <td>
    <h4>{{$data->Topic}}</h4>
    </td>
    <td>
    <h4>{{$data->Owner_Name}}</h4>
    </td>
    <td>
    <h4>{{$data->Status}}</h4>
    </td>
    <td>
    <h4>{{$data->Last_Updated}}</h4>
    </td>
     <td>
    <h4><input class="button" style="height: 20px; margin-top: 1px;" type="button" value="VIEW" data-toggle="modal" data-target="#ViewRiskData"onclick="ViewRiskData('ViewRiskData?RiskId={{$data->Id}}'); return false;" /></button></h4>
    </td>
    
@endforeach
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


<!-- Extract Details By Dates -->
<form action="/FilterClosedRisk" method="GET">

  <label for="start_date" class="start-date-label">FROM:</label>
  <input type="date" id="start_date" name="start_date">

  <label for="end_date" class="end-date-label">TO:</label>
  <input type="date" id="end_date" name="end_date">
  <input type="hidden" name="action" value="extract">
       <button type="submit" id="extract-btn" class="btn btn-primary">EXTRACT</button>
  
</form>


