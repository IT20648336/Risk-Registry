<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Mail_Template;
use App\Models\Email_Logs;
use App\Models\Users;

use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Message;


class EmailController extends Controller
{
    public function MailTemplates()
    {
        $data = Mail_Template::orderBy('Id', 'ASC')->get();
        return view('Email.MailTemplates', ['Mail' => $data]);
    }

    public function updateMailTemplate(Request $request)
    {
        $mailTemplate = Mail_Template::findOrFail($request->input('Id'));
        $mailTemplate->Subject = $request->input('Subject'.$request->input('Id'));
        $mailTemplate->Description = $request->input('Description'.$request->input('Id'));
        $mailTemplate->save();
        return redirect('/MailTemplates');
    }
    
    //SENT ITEM 
    
public function getEmailLogs()
  {
      $emailLogs = Email_Logs::all();
  
      return view('Email.SentItems', compact('emailLogs'));
  }
  
  
//sent email controller code
public function sendEmails(Request $request)
{
    $username = $request->session()->get('username');
    $receiverEmails = $request->input('receiverEmails');
    $selectedRiskIndices = $request->input('selectedRiskIndices');
    $body = $request->input('body');

    $salutation = 'Dear {receiverFirstName},';

    $body = $salutation . '<br><br>' . $body;

    $body .= '<br><br><a href="http://172.26.193.156:8000/MyRisks">Click here to login</a>';
    $body .= '<br><br>Thanks,<br> Risk Registry System';

    try {
        $data = DB::table('Risks')
            ->join('Treatment_Data', 'Risks.Id', '=', 'Treatment_Data.Risk_Id')
            ->join('Users', 'Treatment_Data.Action_Owner_Name', '=', 'Users.Name')
            ->select(
                'Risks.Id',
                'Risks.Owner_Name',
                'Treatment_Data.Action_Owner_Name',
                'Treatment_Data.Action_Due',
                'Users.Email',
                DB::raw("SUBSTRING_INDEX(Users.Name, ' ', 1) AS ReceiverFirstName")
            )
            ->whereIn('Users.Email', $receiverEmails)
            ->whereIn('Risks.Id', $selectedRiskIndices)
            ->get();

        $emailsSent = [];
        $actionOwners = [];
        foreach ($data as $row) {
            $receiverEmail = $row->Email;
            $receiverFirstName = $row->ReceiverFirstName;
            $actionOwner = $row->Action_Owner_Name;

            $uniqueRiskIndices = $data
                ->where('Email', $receiverEmail)
                ->where('Action_Owner_Name', $actionOwner)
                ->pluck('Id')
                ->unique();

            $riskIndices = $uniqueRiskIndices->implode(', ');

            if (!in_array($receiverEmail, $emailsSent) && !in_array($actionOwner, $actionOwners)) {
                $subject = 'Risk Indices: ' . $riskIndices;

                $modifiedBody = str_replace('{receiverFirstName}', $receiverFirstName, $body);
                $emailLog = new Email_Logs();
                $emailLog->Sender_Name = $username;
                $emailLog->Receiver_Name = $receiverFirstName;
                $emailLog->Subject = $subject;
                $emailLog->Description = $modifiedBody;
                $emailLog->save();

                Mail::html($modifiedBody, function ($message) use ($receiverEmail, $subject) {
                    $message->to($receiverEmail)
                        ->subject($subject);
                });

                $emailsSent[] = $receiverEmail;
                $actionOwners[] = $actionOwner;
            }
        }

        return response()->json(['message' => 'Emails sent successfully'], 200);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Failed to send emails'], 500);
    }
}

}