<title>ALL RISKS</title>

@include('layouts.header')

<head>
    <script src="{{ asset('tinymce/js/tinymce/tinymce.min.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('js/Category.js') }}"></script>
<style>
    .department-optgroup::before {
        content: '\25BC';
        display: inline-block;
        margin-right: 5px;
    }
</style>

</head>

<body>
    <h2 style="color:#4A3B94;position:absolute;left:285px";align="right">ALL RISKS</h2>

<select id="division_select" name="division" style="@if ($Role == 'Admin') display: none; @endif">
    <option value="all"><h4>All Risks</h4></option>
    @php
        $departments = [];
    @endphp
    @foreach ($Divisions as $division)
        @php
            $department = $division->Department_Name;
            if (!in_array($department, $departments)) {
                $departments[] = $department;
                echo '<optgroup class="department-optgroup" label="&#9660; ' . $department . '">';
            }
        @endphp
        <option class="division-option" value="{{ $division->Name }}" data-department="{{ $department }}">&#9658; {{ $division->Name }}</option>
    @endforeach
    </optgroup>
</select>

    <br><br>
<form action="/filter-portfolio" method="POST" enctype="multipart/form-data" id="MyRisks">
        @csrf
        <table id="example" class="table table-bordered site_data_datatable" style="padding: -30px; border-style: hidden; width: 98%;">
<thead style="border: 1px solid #E6E6E6;">
                <tr>
                    <th>
                        <h5>CREATED DATE</h5>
                    </th>
                    <th>
                        <h5>RISK ID</h5>
                    </th>
                    <th>
                        <h5>TYPE</h5>
                    </th>
                    <th>
                        <h5>DIVISION</h5>
                    </th>
                    <th>
                        <h5>OWNER</h5>
                    </th>
                    <th>
                        <h5>CATEGORY</h5>
                    </th>
                    <th>
                        <h5>STATUS</h5>
                    </th>                    
                    <th></th>
                </tr>
            </thead>
            <tbody style="border-top-style:hidden; border-bottom-style:hidden;">

                @foreach($risks as $key => $data)
                
                @php

                if($data->Request_status == 'Draft'):
                $Color='#EBEBEB';
                $FontColor='#000000';
                elseif( $data->Request_status == 'In-Progress'):
                $Color='#ECEDFF';
                $FontColor='#000C9F';
                elseif( $data->Request_status == 'Reject'):
                $Color='#FFE4E4';
                $FontColor='#FFE4E4';
                elseif( $data->Request_status == 'Completed'):
                $Color='#E5FFE5';
                $FontColor='#008F02';
                else:
                $Color='#EBEBEB';
                $FontColor='#000000';
                endif;

                @endphp

                <tr class="risk-row" data-division="{{ $data->Division_Name }}">
                    <td>
                        <h4>{{ $data->Date_Time }}</h4>
                        <input type="hidden" name="selectedRows[{{ $key }}][Date_Time]" value="{{ $data->Date_Time }}">
                    </td>
                    <td>
                        <h4>{{ $data->Id }}</h4>
                        <input type="hidden" name="selectedRows[{{ $key }}][Id]" value="{{ $data->Id }}">
                    </td>
                    <td>
                        <h4>{{ $data->Type }}</h4>
                        <input type="hidden" name="selectedRows[{{ $key }}][Type]" value="{{ $data->Type }}">
                    </td>
                    <td>
                        <h4>{{ $data->Division_Name }}</h4>
                        <input type="hidden" name="selectedRows[{{ $key }}][Division_Name]" value="{{ $data->Division_Name }}">
                    </td>
                    <td>
                        <h4>{{ $data->Owner_Name }}</h4>
                        <input type="hidden" name="selectedRows[{{ $key }}][Owner_Name]" value="{{ $data->Owner_Name }}">
                    </td>
                    <td>
                        <h4>{{ $data->Status }}</h4>
                        <input type="hidden" name="selectedRows[{{ $key }}][Status]" value="{{ $data->Status }}">
                    </td>
                    <td>
                    <div style="background-color:{{$Color}}; border-radius: 5px;padding: 0px 0px; width:auto; display: inline-block; color:#FFFFFF;text-align: center;">
                    <h4 style="font-size:12px; color:{{$FontColor}};">&nbsp;{{$data->Request_status}}&nbsp;</h4>
                    <input type="hidden" name="selectedRows[{{ $key }}][Request_status]" value="{{ $data->Request_status }}">
                    </div>
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

        <input type="hidden" name="action" value="extract">
        <input type="hidden" id="selectedDivisionInput" name="division" value="">
        <button type="submit" id="extract-btn" class="btn btn-primary">EXTRACT</button>
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
    <script>
      $(document).ready(function() {
          $('#division_select').on('change', function() {
              var selectedDivision = $(this).val();
              $('.risk-row').hide();
      
              if (selectedDivision === 'all') {
                  $('.risk-row').show();
                  selectedDivision = ''; 
              } else {
                  $('.risk-row[data-division="' + selectedDivision + '"]').show();
              }
      
              $('#selectedDivisionInput').val(selectedDivision); 
          });
      
          $('#extract-btn').on('click', function() {
              $('#selectedDivisionInput').val($('#division_select').val());
              $('#extract-form').submit();
          });
      });

    </script>
</body>
