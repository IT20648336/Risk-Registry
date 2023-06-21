@include('layouts.header')
<title>USER'S</title>
<h2 style="color:#4A3B94;position:absolute;left:330px";top:5px;align="right">USERS</h2>
<form method="post" align="center" enctype="multipart/form-data" id="UserData">
<div align="right"> 
<input class="button" style="height: 25px;" type="button" value=" + Add New User " data-toggle="modal" data-target="#AddNewUser" onclick="GetDivisionDataUser('GetDivisionDataUser'); return false;"/>
</div>
<br>
<div class="trhover"> 
@csrf
<table id="example" class="table table-bordered site_data_datatable" style="padding: -30px; border-style: hidden; width: 98%;">
<thead style="border: 1px solid #E6E6E6;">
<tr>
    <th>
    <h5>USERNAME</h5>
    </th>
    <th>
    <h5>NAME</h5>
    </th>
    <th>
    <h5>DESIGNATION</h5>
    </th>
    <th>
    <h5>EMAIL</h5>
    </th>
    <th>
    <h5>MOBILE</h5>
    </th>
    <th>
    <h5>ROLE</h5>
    </th>
    <th>
    <h5>STATUS</h5>
    </th>
    <th>
    <h5>ACTION</h5>
    </th>
</tr>
</thead>
<tbody style="border-top-style:hidden; border-bottom-style:hidden;">
@foreach($UserData as $key => $data)

@php

if ($data->Status == 'Active'):
$Status_Color='#DFFFE2';
$Status_Font_Color='#009F0C';
elseif ($data->Status == 'Inactive'):
$Status_Color='#FFEEE6';
$Status_Font_Color='#903000';
else:
$Status_Color='#ECECEC';
$Status_Font_Color='#242424';
endif;


@endphp
<tr>
    <td>
    <h4>{{$data->User_Name}}</h4>
    </td>
    <td>
    <h4>{{$data->Name}}</h4>
    </td>
    <td>
    <h4>{{$data->Designation}}</h4>
    </td>
    <td>
    <h4>{{$data->Email}}</h4>
    </td>
    <td>
    <h4>{{$data->Mobile}}</h4>
    </td>
    <td>
    <h4>{{$data->Role}}</h4>
    </td>
    <td>
    <label class="switch">
    @if($data->Status  == 'Active')
    <input type="checkbox"  checked onchange="ChangeUserStatus('ChangeUserStatus?Id={{$data->Id}}&NextStatus=Inactive'); return false;" >
    @elseif($data->Status  == 'Inactive')
    <input type="checkbox"  onchange="ChangeUserStatus('ChangeUserStatus?Id={{$data->Id}}&NextStatus=Active'); return false;" >
    @endif       
    <span  class="slider"></span>
    </label>
    </td>  
    <td>    
    <input class="button" style="height: 20px; margin-top: 1px;" type="button" value="Edit" data-toggle="modal" data-target="#EditUser" onclick="GetUserData('GetUserData?Username={{$data->User_Name}}&Name={{$data->Name}}&Email={{$data->Email}}&Role={{$data->Role}}&RowId={{$data->Id}}'); return false;" />&nbsp;
    <input class="button" style="height: 20px; margin-top: 1px;" type="button" value="Assign" data-toggle="modal" data-target="#AssignUserDivision" onclick="GetAssignedUserDivision('GetAssignedUserDivision?Username={{$data->User_Name}}'); return false;" />
    </td>
</tr>
@endforeach
</tbody>
</table>
<!--
<script>
$(function() {
    $('#DataTableId thead tr')
        .clone(true)
        .addClass('filters')
        .appendTo('#DataTableId thead');

    var table = $('#DataTableId').DataTable({
        serverSide: true,
        ajax: {
            url: 'UserDataList',
            data: function (d) {
                $('.filters input').each(function() {
                    d.columns[$(this).parent().index()].search.value = this.value;
                });
            }
        },
        columns: [
            {data: 'USERNAME', name: 'User_Name',
            render: function (data){
            return '<h4>'+data+'</h4>'; 
            }
            },
            {data: 'NAME', name: 'Name',
            render: function (data){
            return '<h4>'+data+'</h4>'; 
            }
            },
            {data: 'DESIGNATION', name: 'Designation',
            render: function (data){
            return '<h4>'+data+'</h4>'; 
            }
            },
            {data: 'EMAIL', name: 'Email',
            render: function (data){
            return '<h4>'+data+'</h4>'; 
            }
            },
            {data: 'MOBILE', name: 'Mobile',
            render: function (data){
            return '<h4>'+data+'</h4>'; 
            }
            },
            {data: 'ROLE', name: 'Role',
            render: function (data){
            return '<h4>'+data+'</h4>'; 
            }
            },
            {data: 'STATUS', name: 'Status',
              render: function (data) {
              var Color;
              var ColorFont;
              switch (data) {
                  case 'Active':
                      Color = '#FFE3E3';
                      ColorFont = '#CB0000';
                      break;
                  case 'Inactive':
                      Color = '#E6E8FF';
                      ColorFont = '#000D91';
                      break;
                  default:
                      Color = '#EEEEEE';
                      ColorFont = '#000000';
              }
                return '<div style="background-color:'+ Color +'; font-weight: bold; border-radius: 4px; padding: 0px 0px 0px 0px; width:auto; display: inline-block; color:#FFFFFF;text-align: center;font-size:12px; color:'+ColorFont+';">&nbsp;'+ data +'&nbsp;</div';               
            }
            },
            {
            data: 'RowId', name: 'Id',
            render: function (RowId){
            return '<input class="button" data-toggle="modal" data-target="#Electricity_Consumption_Feedback_Form" style="width:auto; display: inline-block; height: 20px; padding: 0px 5px 5px 5px; border-radius: 5px; font-size: 12px; text-align: center; background-color: #015484;" type="button" value="Feedback" onclick=ElectricityConsumptionFeedback("ElectricityConsumptionFeedback?RowId='+RowId+'"); return false;" />';  
            }
            }
        ],
        order: [[0, 'asc']],
        initComplete: function () {
            var api = this.api();
            api.columns().eq(0).each(function (colIdx) {
                var cell = $('.filters th').eq(
                    $(api.column(colIdx).header()).index()
                );
                var title = $(cell).text();
                $(cell).html('<input style="height:20px; border-radius: 3px;" type="text" />');
                $('input', $('.filters th').eq($(api.column(colIdx).header()).index()))
                    .off('keyup change')
                    .on('keyup change', function (e) {
                        table.draw();
                    });
            });
        }
    });
});
</script>
-->
<br>
</div>
</form>
<div id="AddNewUser" class="modal fade" role="dialog" style="width:100%;">
<div class="modal-dialog" style="width:50%;">

<!-- Modal content-->
<div class="modal-content" style="width:100%;">
<div class="modal-body" align="center" style="width:100%;">
<form method="post" align="center" enctype="multipart/form-data" id="NewUser">
@csrf
<table style="width: 100%;height: auto;margin: 0px auto; border: hidden;">   
    <tr>
        <td>
            <h4 style="font-size: 18px;">ADD USER</h4>
        </td>
      </tr>
      <tr>
        <td style="border:hidden;text-align: left; width:auto;">
            <label for="Student"><b>USERNAME:</b></label><br>
            <input type="text" id="Username" name="Username" />
        </td>
        <td style="border:hidden;text-align: left; width:auto;">
            <label for="Student"><b>NAME:</b></label><br>
            <input type="text" id="Name" name="Name" />
        </td>
      </tr>
      <tr>
        <td style="border:hidden;text-align: left; width:auto;">
            <label for="Student"><b>EMAIL:</b></label><br>
            <input type="email" id="Email" name="Email" />
        </td>
        <td style="border:hidden;text-align: left; width:auto;">
          <label for="Student"><b>ROLE:</b></label><br>                      
            <select name="Role" id="Role" class="DropDown"> 
            <option value="000">-SELECT-</option>
            <option value="Admin">Admin</option>
            <option value="User">User</option>
            </select>                      
        </td>
      </tr>
  </table>
<br>
<input class="button" type="button" value="CREATE" onclick="CreateNewUser('CreateNewUser'); return false;" />
</form>
</div>
</div>
 </div>
</div>

<div id="EditUser" class="modal fade" role="dialog" style="width:100%;">
<div class="modal-dialog" style="width:50%;">

<!-- Modal content-->
<div class="modal-content" style="width:100%;">
<div class="modal-body" align="center" style="width:100%;">
<form method="post" align="center" enctype="multipart/form-data" id="EditUserData">
@csrf
<table style="width: 100%;height: auto;margin: 0px auto; border: hidden;">  
    <tr>
        <td>
            <h4 style="font-size: 18px;">EDIT USER</h4>
        </td>
      </tr>
      <tr>
        <td style="border:hidden;text-align: left; width:auto;">
            <label for="Student"><b>USERNAME:</b></label><br>
            <input type="text" id="Username_Edit" name="Username_Edit" />
        </td>
        <td style="border:hidden;text-align: left; width:auto;">
            <label for="Student"><b>NAME:</b></label><br>
            <input type="text" id="Name_Edit" name="Name_Edit" />
        </td>
      </tr>
      <tr>
        <td style="border:hidden;text-align: left; width:auto;">
            <label for="Student"><b>EMAIL:</b></label><br>
            <input type="email" id="Email_Edit" name="Email_Edit" />
        </td>
        <td style="border:hidden;text-align: left; width:auto;">
          <label for="Student"><b>ROLE:</b></label><br>                      
            <select name="Role_Edit" id="Role_Edit" class="DropDown"> 
            <option value="000">-SELECT-</option>
            <option value="Admin">Admin</option>
            <option value="User">User</option>
            </select>                      
        </td>
      </tr>
  </table>
<br>
<input class="button" type="button" value="Save" onclick="UpdateUser('UpdateUser'); return false;" />
<input type="hidden" id="RowIdEdit" name="RowIdEdit" />
</form>
</div>
</div>
 </div>
</div>

<div id="AssignUserDivision" class="modal fade" role="dialog" style="width:100%;">
<div class="modal-dialog" style="width:70%;">

<!-- Modal content-->
<div class="modal-content" style="width:100%;">
<div class="modal-body" align="center" style="width:100%;">
<form method="post" align="center" enctype="multipart/form-data" id="AssignUserDivisionData">
@csrf
<table  id="UserAssignedTable" class="UserAssignedTable" style="width: 100%;height: auto;margin: 0px auto; border: hidden;"> 
</table><br>
<input class="button" type="button" value="Assign" onclick="AssignUserDivision('AssignUserDivision'); return false;" />
<input type="hidden" id="AssignUsername" name="AssignUsername" />
</form>

</div>
</div>
 </div>
</div>



<script>
// JavaScript code to hide pop-up windows
document.addEventListener('DOMContentLoaded', function() {
  // Get the save and create buttons
  var saveButton = document.querySelector('#NewUser input[type="button"][value="CREATE"]');
  var createButton = document.querySelector('#EditUser input[type="button"][value="Save"]');

  // Add click event listeners to the buttons
  saveButton.addEventListener('click', hidePopUp);
  createButton.addEventListener('click', hidePopUp);
});

function hidePopUp() {
  // Get the modal pop-up windows
  var addNewUserModal = document.querySelector('#AddNewUser');
  var editUserModal = document.querySelector('#EditUser');

  // Hide the modal pop-up windows
  addNewUserModal.style.display = 'none';
  editUserModal.style.display = 'none';
}




</script>


