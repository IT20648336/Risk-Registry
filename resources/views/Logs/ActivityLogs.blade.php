@include('layouts.header')
<title>LOGS</title>  
 <table style="width: 100%;height: auto;margin: 0px auto; margin-left:auto; border: hidden;">  
    <tr>
        <td>
            <h4 style="font-size: 18px;">ACTIVITY LOGS</h4><br>
        </td>
      </tr>
 </table>
<div class="trhover"> 	   
<table id="example" class="table table-bordered site_data_datatable" style="padding: -30px; border-style: hidden; width: 98%;">
<thead style="border: 1px solid #E6E6E6;">
<tr>
    <th>
    <h5>DATE TIME</h5>
    </th>
    <th>
    <h5>SOURCE</h5>
    </th>
    <th>
    <h5>TYPE</h5>
    </th> 
    <th>
    <h5>IP</h5>
    </th>
    <th>
    <h5>MODULE</h5>
    </th>
    <th>
    <h5>DESCRIPTION</h5>
    </th>
</tr>
</thead>
<tbody style="border-top-style:hidden; border-bottom-style:hidden;">
@foreach($LogsData as $key => $data)
<tr>
<td>
<h4>{{$data->Date_Time}}</h4>
</td> 
<td>
<h4>{{$data->Source}}</h4>
</td>
<td>
<h4>{{$data->Type}}</h4>
</td>
<td>
<h4>{{$data->IP_Address}}</h4>
</td>
<td>
<h4>{{$data->Module}}</h4>
</td>
<td>
<h4>{{$data->Description}}</h4>
</td>
</tr>
@endforeach
</tbody>
</table>
<br>
</div>


