@include('layouts.header')
<title>DEPARTMENT'S</title>
<form method="post" align="center" enctype="multipart/form-data" id="Data">
@csrf

<h2 style="color:#4A3B94;position:absolute;left:330px";align="right">DEPARTMENTS</h2>
<div align="right"> 
<input class="button" style="height: 25px;" type="button" value=" + Add " data-toggle="modal" data-target="#AddNew" onclick="GetCompanyData('GetCompanyData'); return false;"/>
</div>
<br>
<div class="trhover"> 
<table id="example" class="table table-bordered site_data_datatable" style="padding: -30px; border-style: hidden; width: 98%;">
<thead style="border: 1px solid #E6E6E6;">
<tr>
    <th>
    <h5>COMPANY</h5>
    </th>
    <th>
    <h5>NAME</h5>
    </th>
    <th>
    <h5>SPOC</h5>
    </th>
    <th>
    <h5>EMAIL</h5>
    </th>
    <th>
    <h5>MOBILE</h5>
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
@foreach($Departments as $key => $data)

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
    <h4>{{$data->Company_Name}}</h4>
    </td>
    <td>
    <h4>{{$data->Name}}</h4>
    </td>
    <td>
    <h4>{{$data->Contact}}</h4>
    </td>
    <td>
    <h4>{{$data->Email}}</h4>
    </td>
    <td>
    <h4>{{$data->Mobile}}</h4>
    </td>    
    <td>
    <label class="switch">
    @if($data->Status  == 'Active')
    <input type="checkbox"  checked onchange="ChangeDepartmentStatus('ChangeDepartmentStatus?Id={{$data->Id}}&NextStatus=Inactive'); return false;" >
    @elseif($data->Status  == 'Inactive')
    <input type="checkbox"  onchange="ChangeDepartmentStatus('ChangeDepartmentStatus?Id={{$data->Id}}&NextStatus=Active'); return false;" >
    @endif       
    <span  class="slider"></span>
    </label>
    </td>  
    <td>
    <input class="button" data-toggle="modal" data-target="#Edit" style="height: 20px; margin-top: 1px;" type="button" value="Edit" onclick="GetDepartmentData('GetDepartmentData?RowId={{$data->Id}}&Name={{$data->Name}}&Contact={{$data->Contact}}&Email={{$data->Email}}&Mobile={{$data->Mobile}}'); return false;" />
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

<div id="AddNew" class="modal fade" role="dialog" style="width:100%;">
<div class="modal-dialog" style="width:30%;">

<!-- Modal content-->
<div class="modal-content" style="width:100%;">
<div class="ContainerHeader">
<button type="button" class="close" data-dismiss="modal">×&nbsp;</button>
</div>
<div class="modal-body" align="center" style="width:100%;">
<form method="post" align="center" enctype="multipart/form-data" id="AddNewDepartment">
@csrf
<table style="width: 100%;height: auto;margin: 0px auto; border: hidden;">  
    <tr>
        <td>
            <h4 style="font-size: 18px;">ADD DEPARTMENT'S</h4>
        </td>
      </tr>
      <tr>
        <td style="border:hidden;text-align: left; width:auto;"><br>
            <label for="Student"><b>NAME:</b></label><br>
            <input type="text" id="DepartmentName" name="DepartmentName" Placeholder="Group Finance"/>
        </td>
        <td style="border:hidden;text-align: left; width:auto;"><br>
            <label for="Student"><b>SPOC:</b></label><br>
            <input type="text" id="Spoc" name="Spoc" Placeholder="Frank" />
        </td>
      </tr>
      <tr>
        <td style="border:hidden;text-align: left; width:auto;"><br>
            <label for="Student"><b>EMAIL:</b></label><br>
            <input type="email" id="Email" name="Email" Placeholder="frank@abc.com"/>
        </td>
        <td style="border:hidden;text-align: left; width:auto;"><br>
            <label for="Student"><b>MOBILE(+94):</b></label><br>
            <input type="text" id="Mobile" name="Mobile" placeholder="777XXXXXX" maxlength="10" oninput="validateInput(this)" />
        </td>
      </tr>
  </table>
<br>
<input class="button" type="button" value="Create" onclick="CreateNewDepartment('CreateNewDepartment'); return false;" style="height: 25px;" />
<input type="hidden" id="Company_Id" name="Company_Id"/>
<input type="hidden" id="Company_Name" name="Company_Name"/>
</form>
</div>
</div>
 </div>
</div>

<div id="Edit" class="modal fade" role="dialog" style="width:100%;">
<div class="modal-dialog" style="width:30%;">

<!-- Modal content-->
<div class="modal-content" style="width:100%;">
<div class="ContainerHeader">
<button type="button" class="close" data-dismiss="modal">×&nbsp;</button>
</div>
<div class="modal-body" align="center" style="width:100%;">
<form method="post" align="center" enctype="multipart/form-data" id="EditDepartment">
@csrf
<table style="width: 100%;height: auto;margin: 0px auto; border: hidden;">  
    <tr>
        <td>
            <h4 style="font-size: 18px;">EDIT DEPARTMENT</h4>
        </td>
      </tr>
      <tr>
        <td style="border:hidden;text-align: left; width:auto;"><br>
            <label for="Student"><b>NAME:</b></label><br>
            <input type="text" id="DepartmentNameEdit" name="DepartmentNameEdit" Placeholder="Group Finance"/>
        </td>
        <td style="border:hidden;text-align: left; width:auto;"><br>
            <label for="Student"><b>SPOC:</b></label><br>
            <input type="text" id="SpocEdit" name="SpocEdit" Placeholder="Frank" />
        </td>
      </tr>
      <tr>
        <td style="border:hidden;text-align: left; width:auto;"><br>
            <label for="Student"><b>EMAIL:</b></label><br>
            <input type="email" id="EmailEdit" name="EmailEdit" Placeholder="frank@abc.com"/>
        </td>
        <td style="border:hidden;text-align: left; width:auto;"><br>
            <label for="Student"><b>MOBILE(+94):</b></label><br>
            <input type="text" id="MobileEdit" name="MobileEdit" placeholder="777XXXXXX" maxlength="10" oninput="validateInput(this)" />
        </td>
      </tr>
  </table>
<br>
<input class="button" type="button" value="Save" onclick="UpdateDepartment('UpdateDepartment'); return false;" style="height: 25px;" />
<input type="hidden" id="RowIdEdit" name="RowIdEdit"/>
</form>
</div>
</div>
 </div>
</div>

<script>
function validateInput(input) {
  input.value = input.value.replace(/[^0-9]/g, '');
  if (input.value.length > 10) {
    input.value = input.value.slice(0, 10);
  }
}
</script>


<script>
document.addEventListener('DOMContentLoaded', function() {
  // Get the save and create buttons
  var createButton = document.querySelector('#AddNew input[type="button"][value="Create"]');
  var saveButton = document.querySelector('#Edit input[type="button"][value="Save"]');

  // Add click event listeners to the buttons
  saveButton.addEventListener('click', hidePopUp);
  createButton.addEventListener('click', hidePopUp);
});

function hidePopUp() {
  // Get the modal pop-up windows
  var addNewModal = document.querySelector('#AddNew');
  var editModal = document.querySelector('#Edit');

  // Hide the modal pop-up windows
  addNewModal.style.display = 'none';
  editModal.style.display = 'none';
}

</script>