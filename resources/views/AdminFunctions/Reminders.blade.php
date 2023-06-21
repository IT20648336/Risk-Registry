@include('layouts.header')
<!DOCTYPE html>
<html>
<title>REMINDERS</title>

<head>
    <script src="{{ asset('tinymce/js/tinymce/tinymce.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('js/Category.js') }}"></script>
</head>

<body>
    <h2 style="color:#4A3B94;position:absolute;left:285px;font-size:15px;" align="right">Reminders</h2>
    <select id="division_select">
        <option value="">Select Division</option>
        @foreach ($divisions as $division)
            <option value="{{ $division->Division_Name }}">{{ $division->Division_Name }}</option>
        @endforeach 
    </select>

    <div class="scrollit1">
        <table id="user_table" style="font-weight: bold; margin-top:10px;">
            <thead>
                <tr>
                    <th></th>
                    <th><h4>Name</h4></th>
                    <th><h4>Division Name</h4></th>
                    <th><h4>Email</h4></th>
                    <th><h4>Mobile</h4></th>
                </tr>
            </thead>
            <tbody class="tbody-wrapper">
                @foreach($users as $user)
                <tr class="user_row" data-division="{{ $user->Division_Name }}">
                    <td>
                        <input type="checkbox" name="user[]" value="{{ $user->User_Name }}"
                            data-division="{{ $user->Division_Name }}" data-name="{{ $user->Name }}">
                    </td>
                    <td><h4>{{ $user->Name }}</h4></td>
                    <td><h4>{{ $user->Division_Name }}</h4></td>
                    <td><h4>{{ $user->Email }}</h4></td>
                    <td><h4>{{ $user->Mobile }}</h4></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="scrollit2">
          <table id="selected_table">
                     <thead>
                              <tr>
                                  <th><h4>Name</h4></th>
                                  <th><h4>Division Name</h4></th>
                                  <th><h4>Email</h4></th>
                                  <th><h4>Mobile</h4></th>
                                  <th><h4>Remove</h4></th>
                              </tr>
                       </thead>
                  <tbody class="tbody-wrapper1">
              </tbody>
          </table>
    </div>
    
    <table style="width:100%; margin: 0px;"> 
        <tr>
            <td>
                <img src="{{ asset('images/EmailReminder.png') }}" style="width: 30px; height: 30px;">
                 <h2 id="email">E-Mail Details</h2>
            </td>
        </tr>
        
        <tr>
            <td style="border:hidden;text-align: left; width:auto;">
                <label style="position:absolute; top:685px;">Subject</label>
                <input id="emailSubject" type="text" style="position:absolute; top:720px; width:75%;" required>
            </td>
        </tr>
        
        <tr>
            <td style="border:hidden;text-align: left; width:auto;">
                <label style="position:absolute; top:770px;">Description</label>
            </td>
        </tr>
        
        <tr>
            <td style="border:hidden;text-align: left; width:auto;">
               <div id="parentContainer" style="position: relative;">
                 <div id="editorContainer" style="position: absolute; top: 100px; width:96%;">
                    <textarea id="emailBody"></textarea>
                    <button id="emailbtn">SEND</button>
                 </div>
               </div>
            </td>
        </tr>
    </table>
    
    
    <div id="selected_info">
          Selected Users: <span id="selected_users_count">{{ count($selected_users ?? []) }}</span> | Selected Divisions:                                  <span id="selected_divisions_count">{{ count($selected_divisions ?? []) }}</span>
    </div>
</body>
</html>