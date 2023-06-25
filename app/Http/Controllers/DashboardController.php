<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Risks;
use App\Models\Treatment_Data;
use App\Models\Risk_Levels;
use App\Models\Quarterly_Changes;
use Illuminate\Support\Facades\DB;
use App\Models\User_Division;
use App\Models\Departments;
use App\Models\Risk_Category;
use Carbon\Carbon;

class DashboardController extends Controller
{

public function index(Request $request){

$User = ucfirst($request->session()->get('username'));
$UserRole = ucfirst($request->session()->get('Role'));

$risksQuery = Risks::where('Request_Status','!=','Draft')->orderBy('Id', 'ASC');

$risksData = [];
$CategoryData = [];
$RiskLevelsLH = [];
$RiskLevelsIL = [];
$categories = [];
$categoryDataWithNumber = [];
$categoryNumber = 1;

if ($UserRole === 'Root') {
    // Display all risks
    $risks = $risksQuery->get()->toArray();
        foreach ($risks as $risk) {
        $categoryName = $risk['Category'];
        $likelihoodLevel = $risk['Evaluation_Likelihood_Level'];
        $impactLevel = $risk['Evaluation_Impact_Level'];
        $lhIndex = Risk_Levels::where('Likelihood_Level', $likelihoodLevel)->value('Likelihood_Index');
        $ilIndex = Risk_Levels::where('Impact_Level', $impactLevel)->value('Impact_Index');
        $dateTime = $risk['Date_Time'];

        $risksData[] = [
            'Risk' => $risk,
            'LH_Avg' => $lhIndex,
            'IL_Avg' => $ilIndex,
        ];

        if (array_key_exists($categoryName, $CategoryData)) {
            $CategoryData[$categoryName]['Likelihood_Level'][] = $likelihoodLevel;
            $CategoryData[$categoryName]['Impact_Level'][] = $impactLevel;
            $CategoryData[$categoryName]['LH_Index'][] = $lhIndex;
            $CategoryData[$categoryName]['IL_Index'][] = $ilIndex;
            $CategoryData[$categoryName]['Date_Time'][] = $dateTime;
            $CategoryData[$categoryName]['Count']++;
        } else {
            $CategoryData[$categoryName]['Likelihood_Level'] = [$likelihoodLevel];
            $CategoryData[$categoryName]['Impact_Level'] = [$impactLevel];
            $CategoryData[$categoryName]['LH_Index'] = [$lhIndex];
            $CategoryData[$categoryName]['IL_Index'] = [$ilIndex];
            $CategoryData[$categoryName]['Date_Time'] = [$dateTime];
            $CategoryData[$categoryName]['Count'] = 1;
            $categories[] = $categoryName;
        }

        $RiskLevelsLH[] = ['Likelihood_Index' => $lhIndex];
        $RiskLevelsIL[] = ['Impact_Index' => $ilIndex];
    }

    $categoryNames = array_keys($CategoryData);
    $categoryAvgs = [];

foreach ($categoryNames as $categoryName) {
    if (!empty($categoryName)) {
        $categoryDataWithNumber[$categoryNumber] = [
            'Category' => $categoryName,
            'LH_Avg' => round(array_sum($CategoryData[$categoryName]['LH_Index']) / count($CategoryData[$categoryName]['LH_Index']), 0),
            'IL_Avg' => round(array_sum($CategoryData[$categoryName]['IL_Index']) / count($CategoryData[$categoryName]['IL_Index']), 0),
            'Date_Time' => $CategoryData[$categoryName]['Date_Time'],
            'Count' => $CategoryData[$categoryName]['Count']
        ];
        $categoryNumber++;
    }
}

    $LH_Avg = count($RiskLevelsLH) > 0 ? round(array_sum(array_column($RiskLevelsLH, 'Likelihood_Index')) / count($RiskLevelsLH), 0) : 0;
    $IL_Avg = count($RiskLevelsIL) > 0 ? round(array_sum(array_column($RiskLevelsIL, 'Impact_Index')) / count($RiskLevelsIL), 0) : 0;
}



if ($UserRole === 'Admin' || $UserRole === 'User') {
    $risks = $risksQuery
        ->join('User_Division', 'Risks.Risk_Division_Id', '=', 'User_Division.Division_Id')
        ->join('Risk_Category', 'Risks.Category', '=', 'Risk_Category.Category')
        ->where('User_Division.Username', $User)
        ->get(['Risks.*', 'Risk_Category.Category'])
        ->toArray();

    foreach ($risks as $risk) {
        $categoryName = $risk['Category'];
        $likelihoodLevel = $risk['Evaluation_Likelihood_Level'];
        $impactLevel = $risk['Evaluation_Impact_Level'];
        $lhIndex = Risk_Levels::where('Likelihood_Level', $likelihoodLevel)->value('Likelihood_Index');
        $ilIndex = Risk_Levels::where('Impact_Level', $impactLevel)->value('Impact_Index');
        $dateTime = $risk['Date_Time'];

        $risksData[] = [
            'Risk' => $risk,
            'LH_Avg' => $lhIndex,
            'IL_Avg' => $ilIndex,
        ];

        if (array_key_exists($categoryName, $CategoryData)) {
            $CategoryData[$categoryName]['Likelihood_Level'][] = $likelihoodLevel;
            $CategoryData[$categoryName]['Impact_Level'][] = $impactLevel;
            $CategoryData[$categoryName]['LH_Index'][] = $lhIndex;
            $CategoryData[$categoryName]['IL_Index'][] = $ilIndex;
            $CategoryData[$categoryName]['Date_Time'][] = $dateTime;
            $CategoryData[$categoryName]['Count']++;
        } else {
            $CategoryData[$categoryName]['Likelihood_Level'] = [$likelihoodLevel];
            $CategoryData[$categoryName]['Impact_Level'] = [$impactLevel];
            $CategoryData[$categoryName]['LH_Index'] = [$lhIndex];
            $CategoryData[$categoryName]['IL_Index'] = [$ilIndex];
            $CategoryData[$categoryName]['Date_Time'] = [$dateTime];
            $CategoryData[$categoryName]['Count'] = 1;
            $categories[] = $categoryName;
        }

        $RiskLevelsLH[] = ['Likelihood_Index' => $lhIndex];
        $RiskLevelsIL[] = ['Impact_Index' => $ilIndex];
    }

    $categoryNames = array_keys($CategoryData);
    $categoryAvgs = [];

foreach ($categoryNames as $categoryName) {
    if (!empty($categoryName)) {
        $categoryDataWithNumber[$categoryNumber] = [
            'Category' => $categoryName,
            'LH_Avg' => round(array_sum($CategoryData[$categoryName]['LH_Index']) / count($CategoryData[$categoryName]['LH_Index']), 0),
            'IL_Avg' => round(array_sum($CategoryData[$categoryName]['IL_Index']) / count($CategoryData[$categoryName]['IL_Index']), 0),
            'Date_Time' => $CategoryData[$categoryName]['Date_Time'],
            'Count' => $CategoryData[$categoryName]['Count']
        ];
        $categoryNumber++;
    }
}

    $LH_Avg = count($RiskLevelsLH) > 0 ? round(array_sum(array_column($RiskLevelsLH, 'Likelihood_Index')) / count($RiskLevelsLH), 0) : 0;
    $IL_Avg = count($RiskLevelsIL) > 0 ? round(array_sum(array_column($RiskLevelsIL, 'Impact_Index')) / count($RiskLevelsIL), 0) : 0;
}

  
 // Risk Mitigation
if($UserRole != 'Root'){
    $risksData = DB::table('Risks')
        ->join('Treatment_Data', 'Risks.Id', '=', 'Treatment_Data.Risk_Id')
        ->join('User_Division', 'Risks.Risk_Division_Id', '=', 'User_Division.Division_Id')
        ->where('User_Division.Username', $User)
        ->where('Treatment_Data.Action_Due', '<', Carbon::now())
        ->select(DB::raw('YEAR(Action_Due) as year'),
            DB::raw('QUARTER(Action_Due) as quarter'),
            DB::raw('SUM(CASE WHEN Request_Status = "Completed" THEN 1 ELSE 0 END) as completed'),
            DB::raw('COUNT(*) as total'))
        ->groupBy('year', 'quarter')
        ->orderBy('year')
        ->orderBy('quarter')
        ->get();
}
if($UserRole == 'Root'){
    $risksData = DB::table('Risks')
        ->join('Treatment_Data', 'Risks.Id', '=', 'Treatment_Data.Risk_Id')
        ->join('User_Division', 'Risks.Risk_Division_Id', '=', 'User_Division.Division_Id')
        ->where('Treatment_Data.Action_Due', '<', Carbon::now())
        ->select(DB::raw('YEAR(Action_Due) as year'),
            DB::raw('QUARTER(Action_Due) as quarter'),
            DB::raw('SUM(CASE WHEN Request_Status = "Completed" THEN 1 ELSE 0 END) as completed'),
            DB::raw('COUNT(*) as total'))
        ->groupBy('year', 'quarter')
        ->orderBy('year')
        ->orderBy('quarter')
        ->get();
}
    $labels1 = [];
    $completedValues = [];
    $totalValues = [];
    foreach ($risksData as $data) {
        $quarterLabel = sprintf('Q%d %d', $data->quarter, $data->year);
        $labels1[] = $quarterLabel;
        $completedValues[] = $data->completed;
        $totalValues[] = $data->total;
    }

    // Fetch the delayed risks by department from the database
if($UserRole != 'Root'){
    $data = DB::table('Risks')
        ->join('Treatment_Data', 'Risks.Id', '=', 'Treatment_Data.Risk_Id')
        ->join('User_Division', 'Risks.Risk_Division_Id', '=', 'User_Division.Division_Id')
        ->where('User_Division.Username', $User)
        ->where('Request_Status', 'In-Progress')
        ->where('Treatment_Data.Action_Due', '<', Carbon::now())
        ->select('Department_Name', DB::raw('count(*) as total'))
        ->groupBy('Department_Name')
        ->get();
}
if($UserRole == 'Root'){
    $data = DB::table('Risks')
        ->join('Treatment_Data', 'Risks.Id', '=', 'Treatment_Data.Risk_Id')
        ->join('User_Division', 'Risks.Risk_Division_Id', '=', 'User_Division.Division_Id')
        ->where('Request_Status', 'In-Progress')
        ->where('Treatment_Data.Action_Due', '<', Carbon::now())
        ->select('Department_Name', DB::raw('count(*) as total'))
        ->groupBy('Department_Name')
        ->get();
}
    // Create an empty array for labels and values
    $labels2 = [];
    $values = [];

    // Loop through the data and populate the labels and values arrays
    foreach ($data as $row) {
        $labels2[] = $row->Department_Name;
        $values[] = $row->total;
    }
$categoryNames = $categories;

    return view('Dashboard', [
        'risksData' => $risksData,
        'data' => $data,
        'categoryData' => $CategoryData,
        'categoryNames' => $categoryNames,
        'categoryAvgs' => $categoryAvgs,
        'LH_Avg' => $LH_Avg,
        'IL_Avg' => $IL_Avg,
        'completedValues' => $completedValues,
         'totalValues' => $totalValues,
         'labels1' =>  $labels1,
         'labels2' =>  $labels2,
         'values' =>  $values,
         'categoryDataWithNumber' => $categoryDataWithNumber,
        
    ]);
}  


public function GetCategory()
{
    $Data=Quarterly_Changes::select('*')->orderBy('Category_Number','ASC')->get();
       return view('Dashboard')->with('Quarterly_Changes', $Data);
}
  
}