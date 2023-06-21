@include('layouts.header')
<title>My Risk's </title>

<table>
<tr>
    <th>
    <h5>CREATED DATE</h5>
    </th>
    <th>
    <h5>RISK ID</h5>
    </th>
     <th>
    <h5>RISK TYPE</h5>
    </th>
    <th>
    <h5>RISK TOPIC</h5>
    </th>
     <th>
    <h5>RISK CATEGORY</h5>
    </th>
    <th>
    <h5>CREATED PERSON</h5>
    </th>
    <th>
    <h5>RISK RESPONSE</h5>
    </th>
    <th>
    <h5>UPDATED DATE</h5>
    </th>
    <th>
    <h5>ACTION</h5>
    </th>
   
</tr>

@foreach($Risk as $key => $data)

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
    <h4>{{$data->Owner_Name}}</h4>
    </td>
    <td>
    <h4>{{$data->Request_Status}}</h4>
    </td>
    <td>
    <h4>{{$data->Last_Updated}}</h4>
    </td>
    <td>
    <input class="button" style="height: 20px; margin-top: 1px;" type="button" value="VIEW" data-toggle="modal"/>
    </td>
</tr>
@endforeach
</table>

