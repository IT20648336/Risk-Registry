<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\Error_Logs;
use App\Models\Activity_Logs;
use App\Models\Risks;
use App\Models\Risk_Category;
use App\Models\Users;
use App\Charts\BarChart;
use Carbon\Carbon;
use App\Models\User_Division;
use App\Models\Notification;
use Symfony\Component\Mime\Part\HtmlPart;

class TestNewController extends Controller
{
 
public function delayedRisksByDepartment()
{
    // Fetch the delayed risks by department from the database
    //$User=($request->session()->get('username'));
    $User='Shashika_07806';
    $User_Division=User_Division::where('Username','=',$User)->get();
    $UserDivisionCount=count($User_Division);

    for($i=0; $i<$UserDivisionCount; $i++){
    $data=DB::table('Risks')
            ->where('Request_Status', 'In-Progress')
            ->where('Division_Id', $User_Division[$i]['Division_Id'])
            ->where('Action_Due_Date', '<', Carbon::now())
            ->select('Department_Name', DB::raw('count(*) as total'))
            ->groupBy('Department_Name')
            ->get();
    
    if(count($data) > 0){
    //return $data[0]['Department_Name'];
   // $DataArray[]=array('Department_Name'=>$data['Department_Name'],'total'=>$data['total']);
    }
    }
   // return $DataArray;
    // Create an empty array for labels and values
    $labels = [];
    $values = [];

    // Loop through the data and populate the labels and values arrays
    foreach ($data as $row) {
        $labels[] = $row->Department_Name;
        $values[] = $row->total;
    }

    // Pass the labels and values arrays to the view
    return view('TestNew', compact('labels', 'values'));
}

//NOTIFICATION FUNCTION
public function GetNotification()
{
    $risks = DB::table('Risks')
        ->select('Risks.Id', 'Risks.Topic', 'Risks.Request_Type', 'Risks.Email_Status', 'Users.Email', 'Mail_Templates.Description', 'Mail_Templates.Subject')
        ->join('Users', 'Risks.Action_Owner', '=', 'Users.Name')
        ->join('Mail_Templates', function ($join) {
            $join->on('Risks.Request_Type', '=', 'Mail_Templates.Request_Type')
                 ->on('Risks.Email_Status', '=', 'Mail_Templates.Email_Status');
        })
        ->get();

    return view('Approvals.Pending', ['risks' => $risks]);
}
  


public function updateEmailStatus($riskId, $status)
{
    // Update the Email_Status column in the Risks table
    DB::table('Risks')->where('Id', $riskId)->update(['Email_Status' => $status]);

    // Retrieve the risk data with the corresponding user's email
    $risk = DB::table('Risks')
        ->join('Users', 'Risks.Action_Owner', '=', 'Users.Name')
        ->select('Risks.*', 'Users.Email')
        ->where('Risks.Id', $riskId)
        ->first();

    // Check if the risk and email properties exist
    if ($risk && property_exists($risk, 'Email')) {
        // Determine the request type
        $requestType = $risk->Request_Type;
        
        

    // Send the appropriate email based on the request type
    if ($requestType === 'Risk Re-open Approval') {
        if ($status === 'approved') {
            // Send approval email
            $subject = 'GT Risk Registry – Risk Re-open: ' . $riskId;
    
            Mail::send('Email.approval-mail', [
                'status' => $status,
                'risk' => $risk,
                'actionOwner' => $risk->Action_Owner,
            ], function ($mail) use ($risk, $subject) {
                $mail->to($risk->Email)->subject($subject);
            });
    
        } else {
            // Send rejection email
            $subject = 'GT Risk Registry – Risk Re-open: ' . $riskId;
    
            Mail::send('Email.rejection-mail', ['status' => $status, 'risk' => $risk], function ($mail) use ($risk, $subject) {
                $mail->to($risk->Email)->subject($subject);
            });
        }
    }
  }
    return response()->json(['message' => 'Email status updated successfully']);
}

public function SendNotification(){
  return view('Email.SendEmails');
}



//CATEGORIES
public function GetCategories()
{
    $categories = DB::table('Risk_Category')
        ->select('Category', 'Sub_Category', 'Category_Id', 'Id')
        ->orderBy('Category')
        ->get()
        ->groupBy('Category');

    return view('TestRisk', compact('categories'));
}

public function saveSubcategory(Request $request)
{
    $validatedData = $request->validate([
        'categoryType' => 'required|in:risk,sub',
        'category' => 'required_if:categoryType,sub',
        'subcategory' => 'required'
    ]);

    $subcategory = new Risk_Category();
    $subcategory->Category = $validatedData['categoryType'] === 'risk' ? 'Risk' : $validatedData['category'];
    $subcategory->Sub_Category = $validatedData['subcategory'];
    $subcategory->save();

    return response()->json(['message' => 'Subcategory saved successfully'], 200);
}

public function saveCategory(Request $request)
{
    $validatedData = $request->validate([
        'newCategory' => 'required'
    ], [
        'newCategory.required' => 'The Category field is required.'
    ]);
    $category = new Risk_Category();
    $category->Category = $validatedData['newCategory'];
    $category->save();

    return response()->json(['message' => 'Category saved successfully'], 200);
}

public function save_editsubcategory(Request $request)
{
    $categoryId = $request->input('category_id');
    $subcategory = $request->input('subcategory');

    $category = Risk_Category::findOrFail($categoryId);
    $category->Sub_Category = $subcategory;
    $category->save();

    return redirect()->back()->with('success', 'Subcategory updated successfully');
}

public function saveEditCategory(Request $request)
{
    $oldCategory = $request->input('old_category');
    $newCategoryValue = $request->input('new_category');

    $category = Risk_Category::where('Category', $oldCategory)->first();
    $category->Category = $newCategoryValue;
    $category->save();

    return redirect()->back()->with('success', 'Category updated successfully');
}

//
public function save(Request $request)
{
    $categoryType = $request->input('categoryType');

    if ($categoryType === 'risk') {
        $riskCategoryName = $request->input('riskCategoryName');
        $maxCategoryId = Risk_Category::max('Category_Id');
        $newCategoryId = $maxCategoryId + 1;

        $category = new Risk_Category();
        $category->Category_Id = $newCategoryId;
        $category->Category = $riskCategoryName;
        $category->save();

        return response()->json(['message' => 'Category saved successfully', 'categoryId' => $category->Category_Id]);
    } else {
        $subCategoryName = $request->input('subCategoryName');
        $categoryID = $request->input('categoryID');

        // Find the category based on the given category ID
        $category = Risk_Category::where('Category_Id', $categoryID)->first();

        if ($category) {
            if ($category->Sub_Category) {
                // Category already has subcategories, so create a new row for the new subcategory
                $newCategory = new Risk_Category();
                $newCategory->Category = $category->Category;
                $newCategory->Sub_Category = $subCategoryName;
                $newCategory->Category_Id = $category->Category_Id;
                $newCategory->save();
            } else {
                // Update the existing category's Sub_Category column
                $category->Sub_Category = $subCategoryName;
                $category->save();
            }

            return response()->json(['message' => 'Subcategory saved successfully']);
        } else {
            return response()->json(['message' => 'Invalid category ID'], 400);
        }
    }
}


public function update(Request $request)
  {
      $category = $request->input('category');
      $subcategory = $request->input('subcategory');
      $categoryId = $request->input('category_id');
      
      DB::table('Risk_Category')
          ->where('Category_Id', $categoryId)
          ->update(['Category' => $category]);
  
      return response()->json(['success' => true]);
  }
  
public function updateSubcategory(Request $request)
{
    $subcategory = Risk_Category::find($request->input('subcategory_id'));
    $subcategory->Sub_Category = $request->input('subcategory');
    $subcategory->save();

    return response()->json(['success' => true]);
}


//END CATEGORIES

/*  
//TEAT MAIL
public function testMail($toEmail, $subject, $body)
{
    Mail::send([], [], function($message) use ($toEmail, $subject, $body) {
        $message->to($toEmail)
                ->subject($subject)
                ->html($body);
    });

    return 'Email sent successfully!';
}
*/

 
}