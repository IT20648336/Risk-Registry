<title>Sent Items</title>

@include('layouts.header')

<h2 style="color:#4A3B94;position:absolute;left:328px";align="right">SENT ITEMS</h2>

<br><br>
<form method="post" align="center" enctype="multipart/form-data" id="SentItems" >
@csrf




 <table id="example" class="table table-bordered site_data_datatable" style="padding: -30px; border-style: hidden; width: 98%;">
<thead style="border: 1px solid #E6E6E6;">
    
        <tr>
            <th ><h5>SENDER'S NAME</h5></th>
            <th><h5>RECIEVER'S NAME</h5></th>
            <th ><h5>SUBJECT<h/h5></th>
            <th ><h5>DATE/TIME</h5></th>
        </tr>
    </thead>
    <tbody style="border-top-style:hidden; border-bottom-style:hidden;">
        @foreach ($emailLogs as $emailLog)
            <tr>
                <td><h4>{{ $emailLog->Sender_Name }}</h4></td>
                <td><h4>{{ $emailLog->Receiver_Name }}</h4></td>
                <td><h4>{{ $emailLog->Subject }}</h4></td>
                <td><h4>{{ $emailLog->Date_Time }}</h4></td>
            </tr>
        @endforeach
    </tbody>
</table>