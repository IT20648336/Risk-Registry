function GetCompanyData(pg)
{	
$("#ajax").html('');
$.ajax({
type: "POST",
dataType: "json",
url: pg,
data: $("#Data").serialize(),  
success: function (data) {
if(data.StatusCode === '00') {        
$('[name="Company_Id"]').val(data.Company_Id);
$('[name="Company_Name"]').val(data.Company_Name);
}
if(data.StatusCode === '01') {       
swal({title: 'Oops...',text: 'Company data not found!'});
setTimeout(function(){location.reload();},2000);
}
if(data.StatusCode === '02') {       
swal({title: 'Oops!',text: 'It looks like you do not have permission to access this resource!'});
setTimeout(function(){location.reload();},2000);
}
}
});
}

function CreateNewDepartment(pg)
{	
$("#ajax").html('');
$.ajax({
type: "POST",
dataType: "json",
url: pg,
data: $("#AddNewDepartment").serialize(),      
success: function (data) {

if(data.StatusCode === '00') { 
swal({title: 'Created',text: 'New department created!',imageUrl: '../images/Success_Icon.png',imageSize: '70x70'});
setTimeout(function(){location.reload();},2000);
}
if(data.StatusCode === '01') {           
swal({title: 'Oops...',text: 'It looks like you have left some mandatory fields blank!',imageUrl: '../images/Info_Icon.png',imageSize: '70x70'});
setTimeout(function(){location.reload();},2000);
}
if(data.StatusCode === '02') {           
swal({title: 'Oops...',text: 'It looks like someone has already created a department with same name!',imageUrl: '../images/Info_Icon.png',imageSize: '70x70'});
setTimeout(function(){location.reload();},2000);
}
if(data.StatusCode === '03') {       
swal({title: 'Oops!',text: 'It looks like you do not have permission to access this resource!',imageUrl: '../images/Info_Icon.png',imageSize: '70x70'});
setTimeout(function(){location.reload();},2000);
}
}
});
}

function ChangeDepartmentStatus(pg)
{	
$("#ajax").html('');
$.ajax({
type: "POST",
dataType: "json",
url: pg,
data: $("#Data").serialize(),      
success: function (data) {

if(data.StatusCode === '00') { 
swal({title: 'Changed',text: 'Department status changed!',imageUrl: '../images/Success_Icon.png',imageSize: '70x70'});
setTimeout(function(){location.reload();},2000);
}
if(data.StatusCode === '01') {           
swal({title: 'Oops...',text: 'Department name cannot be empty!',imageUrl: '../images/Info_Icon.png',imageSize: '70x70'});
setTimeout(function(){location.reload();},2000);
}
}
});
}
function GetDepartmentData(pg)
{	
$("#ajax").html('');
$.ajax({
type: "POST",
dataType: "json",
url: pg,
data: $("#Data").serialize(),  
success: function (data) {
if(data.StatusCode === '00') {        
$('[name="DepartmentNameEdit"]').val(data.Name);
$('[name="SpocEdit"]').val(data.Contact);
$('[name="EmailEdit"]').val(data.Email);
$('[name="MobileEdit"]').val(data.Mobile);
$('[name="RowIdEdit"]').val(data.RowId);
}
}
});
}
function GetDepartmentName(pg)
{	
$("#ajax").html('');
$.ajax({
type: "POST",
dataType: "json",
url: pg,
data: $("#AddNewDivision").serialize(),  
success: function (data) {
if(data.StatusCode === '00') {        
$('[name="Department_Name"]').val(data.Department_Name);
}
}
});
}
function GetDepartmentNameDivision(pg)
{	
$("#ajax").html('');
$.ajax({
type: "POST",
dataType: "json",
url: pg,
data: $("#EditDivision").serialize(),  
success: function (data) {
if(data.StatusCode === '00') {        
$('[name="Department_Name_Edit"]').val(data.Department_Name);
}
}
});
}
function UpdateDepartment(pg)
{	
$("#ajax").html('');
$.ajax({
type: "POST",
dataType: "json",
url: pg,
data: $("#EditDepartment").serialize(),      
success: function (data) {

if(data.StatusCode === '00') { 
swal({title: 'Updated',text: 'Department updated!',imageUrl: '../images/Success_Icon.png',imageSize: '70x70'});
setTimeout(function(){location.reload();},2000);
}
if(data.StatusCode === '01') {           
swal({type: 'error',title: 'Oops...',text: 'Department name cannot be empty!',imageUrl: '../images/Info_Icon.png',imageSize: '70x70'});
setTimeout(function(){location.reload();},2000);
}
}
});
}

function CreateNewDivision(pg)
{	
$("#ajax").html('');
$.ajax({
type: "POST",
dataType: "json",
url: pg,
data: $("#AddNewDivision").serialize(),      
success: function (data) {

if(data.StatusCode === '00') { 
swal({title: 'Created',text: 'New division created!',imageUrl: '../images/Success_Icon.png',imageSize: '70x70'});
setTimeout(function(){location.reload();},2000);
}
if(data.StatusCode === '01') {           
swal({title: 'Oops...',text: 'It looks like you have left some mandatory fields blank!',imageUrl: '../images/Info_Icon.png',imageSize: '70x70'});
setTimeout(function(){location.reload();},2000);
}
if(data.StatusCode === '02') {           
swal({title: 'Oops...',text: 'It looks like someone has already created a department with same name!',imageUrl: '../images/Info_Icon.png',imageSize: '70x70'});
setTimeout(function(){location.reload();},2000);
}
if(data.StatusCode === '03') {       
swal({title: 'Oops!',text: 'It looks like you do not have permission to access this resource!',imageUrl: '../images/Info_Icon.png',imageSize: '70x70'});
setTimeout(function(){location.reload();},2000);
}
}
});
}

function ChangeDivisionStatus(pg)
{	
$("#ajax").html('');
$.ajax({
type: "POST",
dataType: "json",
url: pg,
data: $("#Data").serialize(),      
success: function (data) {

if(data.StatusCode === '00') { 
swal({type: 'success',title: 'Changed',text: 'Division status changed!',imageUrl: '../images/Success_Icon.png',imageSize: '70x70'});
setTimeout(function(){location.reload();},2000);
}
if(data.StatusCode === '01') {           
swal({type: 'error',title: 'Oops...',text: 'Division name cannot be empty!',imageUrl: '../images/Info_Icon.png',imageSize: '70x70'});
setTimeout(function(){location.reload();},2000);
}
}
});
}
function GetDivisionData(pg)
{	
$("#ajax").html('');
$.ajax({
type: "POST",
dataType: "json",
url: pg,
data: $("#Data").serialize(),  
success: function (data) {
if(data.StatusCode === '00') {        
$('[name="DivisionNameEdit"]').val(data.Name);
$('[name="SpocEdit"]').val(data.Contact);
$('[name="EmailEdit"]').val(data.Email);
$('[name="MobileEdit"]').val(data.Mobile);
$('[name="RowIdEdit"]').val(data.RowId);
$('[name="Department_Name_Edit"]').val(data.Department_Name);
$("#Department_Id_Edit").empty();
$("#Department_Id_Edit").append('<option value="'+data['Department_Id']+'">'+data['Department_Name']+'</option>');
var DepartmentLenth=data['Departments_Count'];
for (let i = 0; i < DepartmentLenth; i++) {
$("#Department_Id_Edit").append('<option value="'+data['Departments']['0'][i]['Id']+'">'+data['Departments']['0'][i]['Name']+'</option>');
}
}
}
});
}
function UpdateDivision(pg)
{	
$("#ajax").html('');
$.ajax({
type: "POST",
dataType: "json",
url: pg,
data: $("#EditDivision").serialize(),      
success: function (data) {

if(data.StatusCode === '00') { 
swal({type: 'success',title: 'Updated',text: 'Division updated!',imageUrl: '../images/Success_Icon.png',imageSize: '70x70'});
setTimeout(function(){location.reload();},2000);
}
if(data.StatusCode === '01') {           
swal({type: 'error',title: 'Oops...',text: 'Division name cannot be empty!',imageUrl: '../images/Info_Icon.png',imageSize: '70x70'});
setTimeout(function(){location.reload();},2000);
}
}
});
}

function GetDivisionDataUser(pg)
{	
$("#ajax").html('');
$.ajax({
type: "POST",
dataType: "json",
url: pg,
data: $("#UserData").serialize(),  
success: function (data) {
if(data.StatusCode === '00') {        
$("#Division").empty();
var Lenth=data['Count'];
for (let i = 0; i < Lenth; i++) {
$("#Division").append('<option value="'+data['Divisions'][i]['Id']+'">'+data['Divisions'][i]['Department_Name']+' | '+data['Divisions'][i]['Name']+' <label for="one"><input type="checkbox" id="one" />First checkbox</label></option>');
}
}
}
});
}

function CreateNewUser(pg)
{	
$("#ajax").html('');
$.ajax({
type: "POST",
dataType: "json",
url: pg,
data: $("#NewUser").serialize(),      
success: function (data) {

if(data.StatusCode === '00') { 
swal({type: 'success',title: 'Created',text: 'New user created!',imageUrl: '../images/Success_Icon.png',imageSize: '70x70'});
setTimeout(function(){location.reload();},2000);
}
if(data.StatusCode === '01') {           
swal({type: 'error',title: 'Oops!',text: 'It looks like you have left some mandatory fields blank!',imageUrl: '../images/Info_Icon.png',imageSize: '70x70'});
}
if(data.StatusCode === '02') {           
swal({type: 'error',title: 'Oops!',text: 'That user is already registered!',imageUrl: '../images/Info_Icon.png',imageSize: '70x70'});
setTimeout(function(){location.reload();},2000);
}
if(data.StatusCode === '03') {       
swal({type: 'error',title: 'Oops!',text: 'It looks like you do not have permission to access this resource!',imageUrl: '../images/Info_Icon.png',imageSize: '70x70'});
setTimeout(function(){location.reload();},2000);
}
}
});
}
function ChangeUserStatus(pg)
{	
$("#ajax").html('');
$.ajax({
type: "POST",
dataType: "json",
url: pg,
data: $("#UserData").serialize(),      
success: function (data) {

if(data.StatusCode === '00') { 
swal({title: 'Changed',text: 'User status changed!',imageUrl: '../images/Success_Icon.png',imageSize: '70x70'});
setTimeout(function(){location.reload();},2000);
}
if(data.StatusCode === '01') {           
swal({title: 'Oops...',text: 'Username cannot be empty!',imageUrl: '../images/Info_Icon.png',imageSize: '70x70'});
setTimeout(function(){location.reload();},2000);
}
}
});
}
function GetUserData(pg)
{	
$("#ajax").html('');
$.ajax({
type: "POST",
dataType: "json",
url: pg,
data: $("#UserData").serialize(),  
success: function (data) {
if(data.StatusCode === '00') {        
$('[name="Username_Edit"]').val(data.Username);
$('[name="Name_Edit"]').val(data.Name);
$('[name="Email_Edit"]').val(data.Email);
$('[name="RowIdEdit"]').val(data.RowId);
$("#Role_Edit").empty();
$("#Role_Edit").append('<option value="'+data['Role']+'">'+data['Role']+'</option>');
if(data['Role'] === 'Admin'){
$("#Role_Edit").append('<option value="User">User</option>');    
}
if(data['Role'] === 'User'){
$("#Role_Edit").append('<option value="Admin">Admin</option>');    
}
}
}
});
}
function UpdateUser(pg)
{	
$("#ajax").html('');
$.ajax({
type: "POST",
dataType: "json",
url: pg,
data: $("#EditUserData").serialize(),      
success: function (data) {

if(data.StatusCode === '00') { 
swal({type: 'success',title: 'Updated',text: 'User updated!',imageUrl: '../images/Success_Icon.png',imageSize: '70x70'});
setTimeout(function(){location.reload();},2000);
}
if(data.StatusCode === '01') {           
swal({type: 'error',title: 'Oops!',text: 'It looks like you have left some mandatory fields blank!',imageUrl: '../images/Info_Icon.png',imageSize: '70x70'});
}
if(data.StatusCode === '02') {           
swal({type: 'error',title: 'Oops!',text: 'That user is already registered!',imageUrl: '../images/Info_Icon.png',imageSize: '70x70'});
setTimeout(function(){location.reload();},2000);
}
}
});
}

function GetAssignedUserDivision(pg)
{	
$("#ajax").html('');
$.ajax({
type: "POST",
dataType: "json",
url: pg,
data: $("#UserData").serialize(),      
success: function (data) {

if(data.StatusCode === '00') { 
var Lenth=data['Division_Count'];
var AssignLenth=data['Assign_Count'];
var AssignId;
$('[name="AssignUsername"]').val(data.Username);
$("#UserAssignedTable").empty();
var newRow = jQuery('<tr><td><h4 style="font-size: 18px;">ASSIGN DIVISIONS</h4></td></tr>');
jQuery('table.UserAssignedTable').append(newRow);
var newRow = jQuery('<th style="border:hidden;text-align: left; width:auto;"><h5>USER</h5></th>\n\
<th style="border:hidden;text-align: left; width:auto;"><h5>COMPANY</h5></th>\n\
<th style="border:hidden;text-align: left; width:auto;"><h5>DEPARTMENT</h5></th>\n\
<th style="border:hidden;text-align: left; width:auto;"><h5>DIVISION</h5></th>\n\
<th style="border:hidden;text-align: left; width:auto;"><h5>ASSIGN</h5></th>');
jQuery('table.UserAssignedTable').append(newRow);
for (var i = 0; i < Lenth; i++){
var CheckedStatus=null;
for(var n=0; n<AssignLenth; n++){
if(data['Assign_Division'][n]['Division_Id'] === data['Division'][i]['Id']){
CheckedStatus='checked';  
}   
}
var newRow = jQuery('<tr><td><h4>'+data['Username']+'</h4></td>\n\
<td><h4>'+data['Division'][i]['Company_Name']+'</h4></td><td><h4>'+data['Division'][i]['Department_Name']+'</h4></td>\n\
<td><h4>'+data['Division'][i]['Name']+'</h4></td><td><h4><input type="checkbox" name="DivisionId[]" id="DivisionId[]" value="'+data['Division'][i]['Id']+'" '+CheckedStatus+'></h4></td></tr>');
jQuery('table.UserAssignedTable').append(newRow);
}
}
if(data.StatusCode === '01') {            
swal({type: 'error',title: 'Oops...',text: 'Username cannot be empty!',imageUrl: '../images/Info_Icon.png',imageSize: '70x70'});
setTimeout(function(){location.reload();},2000);
}
}
});
}

function AssignUserDivision(pg)
{	
$("#ajax").html('');
$.ajax({
type: "POST",
dataType: "json",
url: pg,
data: $("#AssignUserDivisionData").serialize(),      
success: function (data) {

if(data.StatusCode === '00') { 
swal({type: 'success',title: 'Updated',text: 'User updated!',imageUrl: '../images/Success_Icon.png',imageSize: '70x70'});
setTimeout(function(){location.reload();},2000);
}
if(data.StatusCode === '01') {           
swal({type: 'error',title: 'Oops...',text: 'Username cannot be empty!',imageUrl: '../images/Info_Icon.png',imageSize: '70x70'});
setTimeout(function(){location.reload();},2000);
}
}
});
}

function GetDivisionDataRC(pg)
{	
$("#ajax").html('');
$.ajax({
type: "POST",
dataType: "json",
url: pg,
data: $("#RiskDataStep_1").serialize(),  
success: function (data) {
if(data.StatusCode === '00') {        
$('[name="Company_Id"]').val(data.Divisions['0']['Company_Id']);
$('[name="Division_Name"]').val(data.Divisions['0']['Name']);
$('[name="Department_Id"]').val(data.Divisions['0']['Department_Id']);
$('[name="Company_Name"]').val(data.Divisions['0']['Company_Name']);
$('[name="Department_Name"]').val(data.Divisions['0']['Department_Name']);
}
}
});
}

function GetSubRiskCategory(pg)
{	
$("#ajax").html('');
$.ajax({
type: "POST",
dataType: "json",
url: pg,
data: $("#RiskDataStep_2").serialize(),  
success: function (data) {
if(data.StatusCode === '00') {  
$("#SubRiskCategory").empty();
var Lenth=data['Count']; 
for (let i = 0; i < Lenth; i++) {
$("#SubRiskCategory").append('<option value="'+data['SubRiskCategory'][i]['Sub_Category']+'">'+data['SubRiskCategory'][i]['Sub_Category']+'</option>');
}
}
}
});
}

function GetRiskOwnerName(pg)
{	
$("#ajax").html('');
$.ajax({
type: "POST",
dataType: "json",
url: pg,
data: $("#RiskDataStep_2").serialize(),  
success: function (data) {
if(data.StatusCode === '00') {  
$("#Division_Id").empty();
$('[name="Owner_Name"]').val(data.UserData['0']['Name']);
$("#Division_Id").append('<option value="'+data.UserDivision['0']['Division_Id']+'">'+data.UserDivision['0']['Division_Name']+'</option>');
$('[name="Risk_Division_Name"]').val(data.UserDivision['0']['Division_Name']);

var Lenth=data['DivisionCount']; 
for (let i = 1; i < Lenth; i++) {
$("#Division_Id").append('<option value="'+data.UserDivision[i]['Division_Id']+'">'+data.UserDivision[i]['Division_Name']+'</option>');
}
}
}
});
}
function GetRiskDivisionName(pg)
{	
$("#ajax").html('');
$.ajax({
type: "POST",
dataType: "json",
url: pg,
data: $("#RiskDataStep_2").serialize(),  
success: function (data) {
if(data.StatusCode === '00') {
$('[name="Risk_Division_Name"]').val(data.Data['0']['Name']);
}
}
});
}

function GetGrossRiskLevel(pg)
{	
$("#ajax").html('');
$.ajax({
type: "POST",
dataType: "json",
url: pg,
data: $("#RiskDataStep_3").serialize(),  
success: function (data) {
if(data.StatusCode === '00') {  
$('[name="Gross_Risk_Level"]').val(data.Gross_Level);
}
}
});
}
function GetResidualRiskLevel(pg)
{	
$("#ajax").html('');
$.ajax({
type: "POST",
dataType: "json",
url: pg,
data: $("#RiskDataStep_4").serialize(),  
success: function (data) {
if(data.StatusCode === '00') {  
$('[name="Residual_Risk_Level"]').val(data.Level);
}
}
});
}
//PDF Attachment 
function GetAvoidAcceptanceAttachment(pg)
{	
$("#ajax").html('');
$.ajax({
type: "POST",
dataType: "json",
url: pg,
data: $("#RiskDataStep_5").serialize(),  
success: function (data) {
if(data.StatusCode === '00') {
if(data.Attachment === '1'){ 
var newRow=jQuery('<tr><td><div style="display: flex;"><label for="Student" style="text-align: center;"><b>APPROVAL:&nbsp;</b></label>\n\
<input style="width:100%;" type="file" id="Acceptance_Attachment" name="Acceptance_Attachment"  accept=".pdf" reqruired /></div></td></tr>');
jQuery('table.TreatmentTableAvoid').append(newRow);
}
if(data.Attachment === '0'){ 
$('#TreatmentTableAvoid tr:last').remove();
}
}
}
});
}

function GetRiskStatusTypes(pg)
{	
$("#ajax").html('');
$.ajax({
type: "POST",
dataType: "json",
url: pg,
data: $("#RiskDataStep_5").serialize(),  
success: function (data) {
if(data.StatusCode === '00') {
if(data.Type === 'Avoid' || data.Type === 'Retain'){ 
document.getElementById('TreatmentDivAvoid').style.display = 'block';
document.getElementById('TreatmentDivChange').style.display = 'none';
}
if(data.Type === 'Change' || data.Type === 'Share'){ 
document.getElementById('TreatmentDivChange').style.display = 'block';
document.getElementById('TreatmentDivAvoid').style.display = 'none';
}
}
}
});
}

function ViewRiskData(pg)
{	
$("#ajax").html('');
$.ajax({
type: "POST",
dataType: "json",
url: pg,
data: $("#MyRisks").serialize(),  
success: function (data) {
if(data.StatusCode === '00') {
 var RiskId=data.RiskId;
 $("#ViewRiskData1").load("/ViewRiskId?RiskId="+RiskId);
}
}
});
}

function ViewRiskHistory(pg)
{	
$("#ajax").html('');
$.ajax({
type: "POST",
dataType: "json",
url: pg,
data: $("#MyRisks").serialize(),  
success: function (data) {
if(data.StatusCode === '00') {
 var RiskId=data.RiskId;
 $("#ViewRiskHistory1").load("/ViewRiskHistoryId?RiskId="+RiskId);
}
}
});
}

jQuery(function (){
    var counter = 1;
    jQuery('a.AddKRIData').click(function(event){
        event.preventDefault();

var newRow = jQuery('<tr><td style="border:hidden;text-align: left; width:auto;"><input style="border-top-style: hidden;border-right-style: hidden;border-left-style: hidden;border-radius: 0px;" type="text" name="KRI[]" id="KRI[]" /></td>\n\
<td style="border:hidden;text-align: left; width:auto;"><input style="border-top-style: hidden;border-right-style: hidden;border-left-style: hidden;border-radius: 0px;" type="text" name="Current_Status[]" id="Current_Status[]" /></td>\n\
<td style="border:hidden;text-align: left; width:auto;"><input style="border-top-style: hidden;border-right-style: hidden;border-left-style: hidden;border-radius: 0px;" type="text" name="Tolerance[]" id="Tolerance[]" /></td>\n\
<td style="border:hidden;text-align: left; width:auto;"><input style="border-top-style: hidden;border-right-style: hidden;border-left-style: hidden;border-radius: 0px;" type="text" name="Appetite[]" id="Appetite[]" /></td>\n\
<td style="border:hidden;text-align: left; width:auto;"><input style="border-top-style: hidden;border-right-style: hidden;border-left-style: hidden;border-radius: 0px;" type="text" name="Threshold[]" id="Threshold[]" /></td></tr>');
        jQuery('table.KRIDataTable').append(newRow);

    });
});

jQuery(function (){

    jQuery('a.RemoveKRIData').click(function(event){
        event.preventDefault();
        $('#KRIDataTable tr:last').remove();

    });
});

jQuery(function (){
    var counter = 1;
    jQuery('a.AddTreatmentData').click(function(event){
        event.preventDefault();

$("#ajax").html('');
$.ajax({
type: "POST",
dataType: "json",
url: 'GetActionOwners',
data: $("#RiskDataStep_5").serialize(),  
success: function (data) {
if(data.StatusCode === '00') {
var Lenth=data['DataCount'];
var newRow_2="";
var newRow_1 =('<tr><td style="border:hidden;text-align: left; width:auto;"><input style="border-top-style: hidden;border-right-style: hidden;border-left-style: hidden;border-radius: 0px;" type="text" name="RiskTreatmentActivity[]" id="RiskTreatmentActivity[]" placeholder="Fuel Tank" /></td>\n\
<td style="border:hidden;text-align: left; width:auto;"><select style="width:100%;" name="RiskTreatmentOwner[]" id="RiskTreatmentOwner[]" class="DropDown">\n\
<option value="0000">-SELECT-</option>');
for (let i = 0; i < Lenth; i++){
newRow_2 +=('<option value="'+data.UserData[i]['User_Name']+'">'+data.UserData[i]['Name']+'</option>');
}
var newRow_3 =('</td><td style="border:hidden;text-align: left; width:auto;"><input style="border-top-style: hidden;border-right-style: hidden;border-left-style: hidden;border-radius: 0px;" type="date" name="RiskTreatmentActionDue[]" id="RiskTreatmentActionDue[]" /></td>\n\
<td style="border:hidden;text-align: left; width:auto;"><select style="width:100%;" name="RiskTreatmentMitigation[]" id="RiskTreatmentMitigation[]" class="DropDown">\n\
<option value="000">-SELECT-</option><option value="Ineffective (<25%)">Ineffective (<25%)</option>\n\
<option value="Fairly Effective (25%<50%)">Fairly Effective (25%<50%)</option>\n\
<option value="Mostly Effective (50%<75%)">Mostly Effective (50%<75%)</option>\n\
<option value="Effective (>75%)">Effective (>75%)</option></td>\n\
<td style="border:hidden;text-align: left; width:auto;"><select style="width:100%;" name="RiskTreatmentStatus[]" id="RiskTreatmentStatus[]" class="DropDown">\n\
<option value="000">-SELECT-</option> \n\
<option value="Completed">Completed</option>\n\
<option value="Ongoing">Ongoing</option></option>\n\
<option value="To Start">To Start</option>\n\
<option value="Delay">Delay</option>\n\
<option value="Redirected">Redirected</option></select></td></tr>');
        
var newRow =jQuery(newRow_1+newRow_2+newRow_3);

        jQuery('table.RiskTreatmentChange').append(newRow);

}
}});

});
});

jQuery(function (){

    jQuery('a.RemoveTreatmentData').click(function(event){
        event.preventDefault();
        $('#RiskTreatmentChange tr:last').remove();

    });
});

$(function(){
    var dtToday = new Date();
 
    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
     day = '0' + day.toString();
    var maxDate = year + '-' + month + '-' + day;
    $('[name="RiskTreatmentActionDue[]"]').attr('min', maxDate);
});

function CloseRisk(pg)
{	
$("#ajax").html('');
$.ajax({
type: "POST",
dataType: "json",
url: pg,
data: $("#OpenRiskData").serialize(),      
success: function (data) {
if(data.StatusCode === '00') { 
swal({type: 'success',title: 'Sent',text: 'Request sent for the approval!',imageUrl: '../images/Success_Icon.png',imageSize: '70x70'});
setTimeout(function(){location.reload();},1000);
}
}
});
}
function ReOpenRisk(pg)
{	
$("#ajax").html('');
$.ajax({
type: "POST",
dataType: "json",
url: pg,
data: $("#OpenRiskData").serialize(),      
success: function (data) {
if(data.StatusCode === '00') { 
swal({type: 'success',title: 'Sent',text: 'Request sent for the approval!',imageUrl: '../images/Success_Icon.png',imageSize: '70x70'});
setTimeout(function(){location.reload();},1000);
}
}
});
}
function UpdateTreatmentData(pg)
{	
$("#ajax").html('');
$.ajax({
type: "POST",
dataType: "json",
url: pg,
data: $("#OpenRiskData").serialize(),      
success: function (data) {
if(data.StatusCode === '00') { 
swal({title: 'Saved',text: 'Treatment Data Updated!',imageUrl: '../images/Success_Icon.png',imageSize: '70x70'});
//setTimeout(function(){location.reload();},1000);
}
}
});
}

function ApproveRisk(pg)
{	
$("#ajax").html('');
$.ajax({
type: "POST",
dataType: "json",
url: pg,
data: $("#MyRisks").serialize(),      
success: function (data) {
if(data.StatusCode === '00') { 
swal({type: 'success',title: 'Approved',text: 'Request approved!',imageUrl: '../images/Success_Icon.png',imageSize: '70x70'});
setTimeout(function(){location.reload();},1000);
}
}
});
}
function RejectRisk(pg)
{	
$("#ajax").html('');
$.ajax({
type: "POST",
dataType: "json",
url: pg,
data: $("#MyRisks").serialize(),      
success: function (data) {
if(data.StatusCode === '00') { 
swal({type: 'success',title: 'Rejected',text: 'Request rejected!',imageUrl: '../images/Success_Icon.png',imageSize: '70x70'});
setTimeout(function(){location.reload();},1000);
}
}
});
}

$(document).ready(function () {
    // add new row to the table that will contain input fields for filtering each column
    $('#example thead tr')
        .clone(true)
        .addClass('filters')
        .appendTo('#example thead');
 
    var table = $('#example').DataTable({
        orderCellsTop: true,
        fixedHeader: false,
        destroy: false,
        paging: true,
        
        initComplete: function () {
            var api = this.api();
 
            // For each column
            api
                .columns()
                .eq(0)
                .each(function (colIdx) {
                    // Set the header cell to contain the input element
                    var cell = $('.filters th').eq(
                        $(api.column(colIdx).header()).index()
                    );
                    var title = $(cell).text();
                    $(cell).html('<input style="height:20px; border-radius: 3px;" type="text" />');
                    // On every keypress in this input
                    $(
                        'input',
                        $('.filters th').eq($(api.column(colIdx).header()).index())
                    )
                        .off('keyup change')
                        .on('change', function (e) {
                            // Get the search value
                            $(this).attr('title', $(this).val());
                            var regexr = '({search})'; //$(this).parents('th').find('select').val();
 
                            var cursorPosition = this.selectionStart;
                            // Search the column for that value
                            api
                                .column(colIdx)
                                .search(
                                    this.value != ''
                                        ? regexr.replace('{search}', '(((' + this.value + ')))')
                                        : '',
                                    this.value != '',
                                    this.value == ''
                                )
                                .draw();
                        })
                        .on('keyup', function (e) {
                            e.stopPropagation();
 
                            $(this).trigger('change');
                            $(this)
                                .focus()[0]
                                .setSelectionRange(cursorPosition, cursorPosition);
                        });
                });
        }
    });
});