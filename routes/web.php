<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Authenticate;

Route::get('/', function () {
    return view('Login');
});

Route::get('/', [App\Http\Controllers\LoginController::class, 'index'])->name('login');    
Route::post('/Login', [App\Http\Controllers\LoginController::class, 'login']);
Route::get('/Logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('Logout');

Route::get('/Dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('Dashboard')->middleware('auth');
//Route::get('/Dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('Dashboard');

Route::get('/ActivityLogs', [App\Http\Controllers\LogsController::class, 'ActivityLogs'])->middleware('auth');
Route::get('/ErrorLogs', [App\Http\Controllers\LogsController::class, 'ErrorLogs'])->middleware('auth');

Route::get('/UserData', [App\Http\Controllers\UserDataController::class, 'UserData'])->middleware('auth');
Route::get('/UserDataList', [App\Http\Controllers\UserDataController::class, 'DataList'])->middleware('auth');
Route::post('/GetUserData', [App\Http\Controllers\UserDataController::class, 'GetUserData'])->middleware('auth');
Route::post('/CreateNewUser', [App\Http\Controllers\UserDataController::class, 'CreateNewUser'])->middleware('auth');
Route::post('/UpdateUser', [App\Http\Controllers\UserDataController::class, 'UpdateUser'])->middleware('auth');
Route::post('/ChangeUserStatus', [App\Http\Controllers\UserDataController::class, 'ChangeUserStatus'])->middleware('auth');
Route::post('/GetDivisionDataUser', [App\Http\Controllers\Hierarchycontroller::class, 'GetDivisionDataUser'])->middleware('auth');
Route::post('/GetAssignedUserDivision', [App\Http\Controllers\UserDataController::class, 'GetAssignedUserDivision'])->middleware('auth');
Route::post('/AssignUserDivision', [App\Http\Controllers\UserDataController::class, 'AssignUserDivision'])->middleware('auth');

Route::post('/GetCompanyData', [App\Http\Controllers\Hierarchycontroller::class, 'GetCompanyData'])->middleware('auth');
Route::post('/GetDepartmentName', [App\Http\Controllers\Hierarchycontroller::class, 'GetDepartmentName'])->middleware('auth');
Route::post('/GetDepartmentNameDivision', [App\Http\Controllers\Hierarchycontroller::class, 'GetDepartmentNameDivision'])->middleware('auth');
Route::get('/Departments', [App\Http\Controllers\Hierarchycontroller::class, 'Departments'])->middleware('auth');
Route::get('/DepartmentsList', [App\Http\Controllers\Hierarchycontroller::class, 'DataList'])->middleware('auth');
Route::post('/CreateNewDepartment', [App\Http\Controllers\Hierarchycontroller::class, 'CreateNewDepartment'])->middleware('auth');
Route::post('/ChangeDepartmentStatus', [App\Http\Controllers\Hierarchycontroller::class, 'ChangeDepartmentStatus'])->middleware('auth');
Route::post('/GetDepartmentData', [App\Http\Controllers\Hierarchycontroller::class, 'GetDepartmentData'])->middleware('auth');
Route::post('/UpdateDepartment', [App\Http\Controllers\Hierarchycontroller::class, 'UpdateDepartment'])->middleware('auth');

Route::get('/Divisions', [App\Http\Controllers\Hierarchycontroller::class, 'Divisions'])->middleware('auth');
Route::get('/DivisionList', [App\Http\Controllers\Hierarchycontroller::class, 'DivisionDataList'])->middleware('auth');
Route::post('/CreateNewDivision', [App\Http\Controllers\Hierarchycontroller::class, 'CreateNewDivision'])->middleware('auth');
Route::post('/ChangeDivisionStatus', [App\Http\Controllers\Hierarchycontroller::class, 'ChangeDivisionStatus'])->middleware('auth');
Route::post('/GetDivisionData', [App\Http\Controllers\Hierarchycontroller::class, 'GetDivisionData'])->middleware('auth');
Route::post('/UpdateDivision', [App\Http\Controllers\Hierarchycontroller::class, 'UpdateDivision'])->middleware('auth');
 
Route::get('/CreateRisk', [App\Http\Controllers\RiskController::class, 'CreateRisk'])->middleware('auth');
Route::post('/GetDivisionDataRC', [App\Http\Controllers\RiskController::class, 'GetDivisionData'])->middleware('auth');
Route::post('/RiskCreation', [App\Http\Controllers\RiskController::class, 'RiskCreation'])->middleware('auth'); 
Route::post('/GetSubRiskCategory', [App\Http\Controllers\RiskController::class, 'GetSubRiskCategory'])->middleware('auth'); 
Route::post('/GetRiskOwnerName', [App\Http\Controllers\RiskController::class, 'GetRiskOwnerName'])->middleware('auth'); 
Route::post('/GetRiskDivisionName', [App\Http\Controllers\RiskController::class, 'GetRiskDivisionName'])->middleware('auth'); 
Route::post('/GetGrossRiskLevel', [App\Http\Controllers\RiskController::class, 'GetGrossRiskLevel'])->middleware('auth'); 
Route::post('/GetResidualRiskLevel', [App\Http\Controllers\RiskController::class, 'GetResidualRiskLevel'])->middleware('auth'); 
Route::post('/GetAvoidAcceptanceAttachment', [App\Http\Controllers\RiskController::class, 'GetAvoidAcceptanceAttachment'])->middleware('auth');  
Route::post('/GetRiskStatusTypes', [App\Http\Controllers\RiskController::class, 'GetRiskStatusTypes'])->middleware('auth'); 
Route::post('/GetActionOwners', [App\Http\Controllers\RiskController::class, 'GetActionOwners'])->middleware('auth'); 
Route::get('/MyRisks', [App\Http\Controllers\RiskController::class, 'MyRisks'])->middleware('auth');
Route::get('/AssignedRisks', [App\Http\Controllers\RiskController::class, 'AssignedRisks'])->middleware('auth');
Route::get('/RiskCreationBack', [App\Http\Controllers\RiskController::class, 'RiskCreationBack'])->middleware('auth'); 
Route::post('/ViewRiskData', [App\Http\Controllers\RiskController::class, 'ViewRiskData'])->middleware('auth'); 
Route::get('/ViewRiskId', [App\Http\Controllers\RiskController::class, 'ViewRiskId'])->middleware('auth'); 
Route::post('/ViewRiskHistory', [App\Http\Controllers\RiskController::class, 'ViewRiskHistory'])->middleware('auth');
Route::get('/ViewRiskHistoryId', [App\Http\Controllers\RiskController::class, 'ViewRiskHistoryId'])->middleware('auth');
Route::post('/CloseRisk', [App\Http\Controllers\RiskController::class, 'CloseRisk'])->middleware('auth');
Route::post('/ReOpenRisk', [App\Http\Controllers\RiskController::class, 'ReOpenRisk'])->middleware('auth');
Route::post('/UpdateTreatmentData', [App\Http\Controllers\RiskController::class, 'UpdateTreatmentData'])->middleware('auth');
Route::post('/ApproveRisk', [App\Http\Controllers\RiskController::class, 'ApproveRisk'])->middleware('auth');
Route::post('/RejectRisk', [App\Http\Controllers\RiskController::class, 'RejectRisk'])->middleware('auth');

#Isuri /Sashini

//Route::get('/MyRisks1', [App\Http\Controllers\TestController::class, 'FetchRisk_Data'])->middleware('guest'); 
//Route::get('/Risk-Mitigation', [App\Http\Controllers\TestController::class, 'Risk_Mitigation'])->name('Dashboard')->middleware('guest');
//Route::get('/Dashboard', [App\Http\Controllers\DashboardController::class, 'getRiskMatrixData'])->name('Dashboard');

Route::get('/Test', [App\Http\Controllers\TestController::class, 'Risk_Mitigation'])->name('Test')->middleware('auth');
Route::get('/TestNew', [App\Http\Controllers\TestNewController::class, 'delayedRisksByDepartment'])->name('TestNew')->middleware('auth'); 
Route::get('/quarterly', [App\Http\Controllers\TestController::class, 'getRiskMatrixData'])->middleware('auth');

Route::get('/Risk-Mitigation', [App\Http\Controllers\DashboardController::class, 'Risk_Mitigation'])->name('Risk-Mitigation')->middleware('auth');
Route::get('/Risk-Delayed', [App\Http\Controllers\DashboardController::class, 'delayedRisksByDepartment'])->name('Risk-Delayed')->middleware('auth'); 
Route::get('/Risk-Count', [App\Http\Controllers\DashboardController::class, 'getRiskMatrixData'])->name('Dashboard')->middleware('auth');
Route::get('/GetCategory', [App\Http\Controllers\DashboardController::class, 'GetCategory'])->name('Dashboard')->middleware('auth');


Route::get('/NewRisks', [App\Http\Controllers\AdminController::class,'showNewData'])->name('NewRisks')->middleware('auth');
Route::get('/ClosedRisks', [App\Http\Controllers\AdminController::class,'showClosedData'])->name('ClosedRisks')->middleware('auth');
Route::get('/NotAttendedRisks', [App\Http\Controllers\AdminController::class,'showNotAttendedData'])->name('NotAttendedRisks')->middleware('auth');
Route::get('/AllRisks', [App\Http\Controllers\AdminController::class,'AllRiskIndex'])->middleware('guest')->middleware('auth'); 
 
//Reminders
Route::get('/Reminders', [App\Http\Controllers\AdminController::class,'ReminderIndex'])->middleware('guest')->middleware('auth'); 
Route::post('/send-emails', [App\Http\Controllers\AdminController::class, 'sendEmails'])->name('send.emails')->middleware('auth');

Route::get('/filter', [App\Http\Controllers\AdminController::class,'filter'])->name('filter')->middleware('auth');
Route::get('/extract', [App\Http\Controllers\AdminController::class,'extract'])->name('extract')->middleware('auth');
Route::get('/Status', [App\Http\Controllers\AdminController::class,'Status'])->name('Status')->middleware('auth');
Route::get('/extractNotAttended', [App\Http\Controllers\AdminController::class,'extractNotAttended'])->name('extractNotAttended')->middleware('auth');  
Route::post('/showSelectedRows', [App\Http\Controllers\AdminController::class,'showSelectedRows'])->name('showSelectedRows')->middleware('auth');
Route::post('/ViewRiskData1', [App\Http\Controllers\AdminController::class, 'ViewRiskData1'])->middleware('auth'); 
Route::get('/ViewRiskId1', [App\Http\Controllers\AdminController::class, 'ViewRiskId1'])->middleware('auth');


//EMAIL-Notification
Route::get('/Notification', [App\Http\Controllers\TestNewController::class,'GetNotification'])->middleware('auth'); 
Route::put('/update-email-status/{riskId}/{status}', [App\Http\Controllers\TestNewController::class, 'updateEmailStatus'])->middleware('auth');
Route::get('/test_mail', [App\Http\Controllers\TestNewController::class,'index'])->middleware('auth');
Route::post('/send-email', [App\Http\Controllers\TestController::class,'sendEmail'])->middleware('auth');
Route::get('/SendNotification', [App\Http\Controllers\TestNewController::class,'SendNotification'])->middleware('auth');
//END TEST

Route::get('/MailTemplates', [App\Http\Controllers\EmailController::class, 'MailTemplates'])->middleware('auth');
Route::post('/MailTemplates/update',[App\Http\Controllers\EmailController::class, 'updateMailTemplate'])->name('MailTemplates.update')->middleware('auth'); 

//Route::view('/SentItems', 'Email.SentItems');

Route::get('/RiskDataList', [App\Http\Controllers\TestController::class, 'RiskDataList'])->middleware('auth');
Route::post('/ChangeRiskStatus', [App\Http\Controllers\Testcontroller::class, 'changeRiskStatus'])->middleware('auth');
Route::get('/RiskData', [App\Http\Controllers\TestController::class, 'RiskData'])->middleware('auth');

Route::get('/risk-category', [App\Http\Controllers\TestController::class, 'GetRiskCategory'])->name('risk-category.GetRiskCategory')->middleware('auth');
Route::post('/risk-category', [App\Http\Controllers\TestController::class, 'store'])->name('risk-category.store')->middleware('auth');
 
Route::get('/risk-category/subcategories', [App\Http\Controllers\TestController::class, 'getSubcategories'])->name('risk-category.subcategories')->middleware('auth');

Route::post('/risk-category/{id}/change-status', 'TestController@changeStatus')->name('risk-category.change-status')->middleware('auth');


Route::post('/risk-category/update', [App\Http\Controllers\TestController::class, 'updateCategory'])->name('risk-category.update')->middleware('auth');

 
//CATEGORIES
Route::get('/categories', [App\Http\Controllers\TestNewController::class, 'GetCategories'])->name('categories.GetCategories')->middleware('auth');
Route::post('/save-subcategory',[App\Http\Controllers\TestNewController::class, 'saveSubcategory'])->name('save-subcategory')->middleware('auth');
//Route::post('/save-category', [App\Http\Controllers\TestNewController::class, 'saveCategory'])->name('save-category');
Route::post('/save_editsubcategory', [App\Http\Controllers\TestNewController::class, 'save_editsubcategory'])->name('save_editsubcategory')->middleware('auth');
Route::post('/save_editcategory', [App\Http\Controllers\TestNewController::class, 'saveEditCategory'])->name('save_editcategory')->middleware('auth');

//NEWCategory
Route::post('/categories/{id}', [App\Http\Controllers\TestNewController::class, 'update'])->name('categories.update')->middleware('auth');
Route::post('/saveCategory',[App\Http\Controllers\TestNewController::class, 'save'])->name('saveCategory')->middleware('auth');
Route::post('/update-category',[App\Http\Controllers\TestNewController::class,'update'])->name('update.category')->middleware('auth');
Route::post('/update-subcategory', [App\Http\Controllers\TestNewController::class, 'updateSubcategory'])->name('update.subcategory')->middleware('auth');
//EXTRACT 
Route::get('/FilterDates', [App\Http\Controllers\ExtractController::class,'filter'])->name('filter');
Route::post('/filter-portfolio', [App\Http\Controllers\AdminController::class, 'filterPortfolio'])->name('filter-portfolio');
Route::get('/FilterClosedRisk', [App\Http\Controllers\ExtractController::class, 'filterClosedRisk'])->name('filterClosedRisk');
Route::get('/FilterNotAttendedRisk', [App\Http\Controllers\ExtractController::class, 'FilterNotAttendedRisk'])->name('FilterNotAttendedRisk');
//SENT ITEMS
Route::get('/SentItems', [App\Http\Controllers\EmailController::class, 'getEmailLogs'])->name('SentItems')->middleware('auth');
//NOT ATTENDENT RISKS
Route::post('/not-attended-email', [App\Http\Controllers\EmailController::class,'sendEmails'])->name('not-attended-email')->middleware('auth');  

 

//Approvals

Route::get('/risk-indices', [App\Http\Controllers\TestController::class,'showRiskIndices'])->name('risk-indices');
Route::get('/Pending', [App\Http\Controllers\ApprovalsController::class,'GetApprovals'])->middleware('auth'); 
Route::get('/Completed', [App\Http\Controllers\ApprovalsController::class,'Completedapprovals'])->middleware('auth'); 