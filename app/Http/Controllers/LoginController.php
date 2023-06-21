<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Client\Response;
use App\Models\Users;
use App\Models\Activity_Logs;
use App\Models\Error_Logs;
use App\Models\User_Login_Registry;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Facades\Agent;

class LoginController extends Controller
{
  public function index(Request $request){

    return view('Login');
    
  }

  public function login(Request $request){
    
    $validated = $request->validate([
      'username' => 'required',
      'password' => 'required',
    ]); 

    $user=Users::where([['User_Name',$request->username],['Status','Active']])->first();
    
    if ($user){
    /*  
      try {
          $request->headers->set('Accept', 'application/json');
          
          $response = Http::post('http://127.0.0.1:5000/auth', [
            'uname' => $request->username, 
            'pswd'=> $request->password,
            ]);
            //return $response;
            
          
          }  
  
      catch(Exception $e) {
        // return $e;
        
        $Data=array('title'=>'FAILED','text'=>'Domain controllers are busy!','Type'=>'error','location'=>'');
        return view('/Error',['ErrorData'=>$Data]);
      }
      
     
       
       $user_info = $response->getBody()->getContents();
       $decoded = json_decode($user_info);
       //return $user_info
       $status = $decoded->status;
      // echo $response;
   */
       $status='11';
       if ($status==11){
        
          $request->session()->put('username', $user->User_Name);
          $request->session()->put('Name', $user->Name);
          $request->session()->put('Role', $user->Role);

          $loginId = $user->Id;
         
          date_default_timezone_set('Asia/Colombo');
          $SystemDateTime=date('Y-m-d H:i:s', time());
          $User=$request->username;
          $IPAddress=$request->ip();
          $URL=url()->full();
          $Email=$user->Email;
          $Name=strtok($user->Name, " ");
          //change this
          $Browser='1';
          $OS='1';
          $Version='1';
          //$Browser=Agent::browser();
          //$OS=Agent::platform();
          //$Version=Agent::version($Browser);
         // $Designation=$decoded->title;

        //  Users::where('Id',$loginId)->update(['Designation'=>$Designation]);
          
          $ActivityLogs = new Activity_Logs;
          $ActivityLogs->Source=$User;
          $ActivityLogs->Type='Login';
          $ActivityLogs->IP_Address=$IPAddress;
          $ActivityLogs->URL=$URL;
          $ActivityLogs->Module='Auth';
          $ActivityLogs->Description='Login Succeed';
          $ActivityLogs->save();
        
          
          $UserLoginRegistry=User_Login_Registry::where([['Username',$User],['IP_Address',$IPAddress],
          ['Platform',$OS],['Browser',$Browser],['Version',$Version]])->count();
          
          

         if($UserLoginRegistry == 0){
             
         $LoginRegistry = new User_Login_Registry;
         $LoginRegistry->Username=$User;
         $LoginRegistry->IP_Address=$IPAddress;
         $LoginRegistry->Platform=$OS;
         $LoginRegistry->Browser=$Browser;
         $LoginRegistry->Version=$Version;
         $LoginRegistry->save();
         
         $EmailBody="Hi $Name,<br><br>
                    We have noticed an unusual login from a new IP or browser you do not usually use!<br><br>
                    <b>Timestamp:</b> $SystemDateTime<br>
                    <b>Region     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b> Asia<br>
                    <b>Country    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b> Sri Lanka<br>
                    <b>TimeZone   &nbsp;&nbsp;:</b> Asia/Colombo<br>
                    <b>Platform   &nbsp;&nbsp;&nbsp;&nbsp;:</b> $OS<br>
                    <b>Browser    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b> $Browser [$Version]<br>
                    <b>IP Address &nbsp;:</b> $IPAddress<br>
                    <br>
                    If this was not you, your account has been compromised!!!";
        // $response = Http::post('http://10.56.48.110/TNP360/Microservices/SendMails', [
         //   'Sender' => $Email, 
         //   'Subject'=> "RMS - Unrecognized Login Found [$User]",
         //   'Body'=> $EmailBody,
          // ]);
         }
         //return redirect()->intended('/');
         return redirect('/Dashboard');
     
       }elseif($status==01){
        $Data=array('title'=>'FAILED','text'=>'Domain Controllers are Busy. Try Again!!','Type'=>'error','location'=>'');
        $Username=$request->username;
        $IPAddress=$request->ip();
        $URL=url()->full();
        $ErrorLogs = new Error_Logs;
         $ErrorLogs->Source=$Username;
         $ErrorLogs->Type='Login';
         $ErrorLogs->IP_Address=$IPAddress;
         $ErrorLogs->URL=$URL;
         $ErrorLogs->Module='Auth';
         $ErrorLogs->Description='Invalid Credentials [User: '.$Username.']';
         $ErrorLogs->save();
        return view('/Error',['ErrorData'=>$Data]);
       }
       
       
       else{
        $Data=array('title'=>'FAILED','text'=>'Your username or password is incorrect!','Type'=>'error','location'=>'');
        $Username=$request->username;
        $IPAddress=$request->ip();
        $URL=url()->full();
        $ErrorLogs = new Error_Logs;
         $ErrorLogs->Source=$Username;
         $ErrorLogs->Type='Login';
         $ErrorLogs->IP_Address=$IPAddress;
         $ErrorLogs->URL=$URL;
         $ErrorLogs->Module='Auth';
         $ErrorLogs->Description='Invalid Credentials [User: '.$Username.']';
         $ErrorLogs->save();
        return view('/Error',['ErrorData'=>$Data]);
       }
 
       
    } else { 
      $Data=array('title'=>'NOT REGISTERED','text'=>'User not registered!','Type'=>'error','location'=>'');
        $Username=$request->username;
        $IPAddress=$request->ip();
        $URL=url()->full();
        $ErrorLogs = new Error_Logs;
         $ErrorLogs->Source=$Username;
         $ErrorLogs->Type='Login';
         $ErrorLogs->IP_Address=$IPAddress;
         $ErrorLogs->URL=$URL;
         $ErrorLogs->Module='Auth';
         $ErrorLogs->Description='Not Registered  [User: '.$Username.']';
         $ErrorLogs->save();
      return view('/Error',['ErrorData'=>$Data]);
    }

  }
  
  
  public function authenticate(Request $request)
    {
         if (Auth::attempt(['username' => $request->username, 'password' => $request->password, 'id' => 1])) 
        {
            // Authentication passed...
            dd("correct");
        }
        else
        {
            dd("login data incorrect!");

        }
    }
  
  public function logout(Request $request){
 
    if ($request->session()->has('username')) {
    
      
      $User=ucfirst($request->session()->get('username'));
      $IPAddress=$request->ip();
      $URL=url()->full();
      $request->session()->forget('username');
      $request->session()->flush();
      /*
      $ActivityLogs = new ActivityLogs;
      $ActivityLogs->Source=$User;
      $ActivityLogs->Type='Logout';
      $ActivityLogs->IP_Address=$IPAddress;
      $ActivityLogs->URL=$URL;
      $ActivityLogs->Module='Auth';
      $ActivityLogs->Description='Logout Succeed';
      $ActivityLogs->save();*/
         
      return redirect('/');
          
    }
    
  }


}
