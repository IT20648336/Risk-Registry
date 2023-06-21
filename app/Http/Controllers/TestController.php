<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Error_Logs;
use App\Models\Activity_Logs;
use App\Models\Risks;
use App\Models\Risk_Levels;
use App\Models\Risk_Category;
use App\Models\Users;
use Illuminate\Support\Facades\DB;
use App\Charts\BarChart;


use Illuminate\Support\Facades\Mail;

class TestController extends Controller
{
    public function Risk_Mitigation()
   


{  
$risksData = DB::table('Risks')
    ->select(DB::raw('YEAR(Action_Due_Date) as year'),
             DB::raw('QUARTER(Action_Due_Date) as quarter'),
             DB::raw('SUM(CASE WHEN Request_Status = "Completed" THEN 1 ELSE 0 END) as completed'),
             DB::raw('COUNT(*) as total'))
    ->groupBy('year', 'quarter')
    ->orderBy('year')
    ->orderBy('quarter')
    ->get();

$labels = [];
$completedValues = [];
$totalValues = [];
foreach ($risksData as $data) {
    $quarterLabel = sprintf('Q%d %d', $data->quarter, $data->year);
    $labels[] = $quarterLabel;
    $completedValues[] = $data->completed;
    $totalValues[] = $data->total;
}



return view('Test', compact('labels', 'completedValues', 'totalValues'));
}









    
    
    
    public function index(Request $request)
  {
      $risks = Risks::orderBy('Id', 'ASC')->get()->toArray();
      $risksData = [];
      $CategoryData = [];
  
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
          }
  
          $RiskLevelsLH[] = ['Likelihood_Index' => $lhIndex];
          $RiskLevelsIL[] = ['Impact_Index' => $ilIndex];
      }
  
      $categoryNames = array_keys($CategoryData);
      $categoryAvgs = [];
  
      foreach ($categoryNames as $categoryName) {
          $categoryAvgs[$categoryName] = [
              'LH_Avg' => round(array_sum($CategoryData[$categoryName]['LH_Index']) / count($CategoryData[$categoryName]['LH_Index']), 0),
              'IL_Avg' => round(array_sum($CategoryData[$categoryName]['IL_Index']) / count($CategoryData[$categoryName]['IL_Index']), 0),
              'Date_Time' => $CategoryData[$categoryName]['Date_Time'],
              'Count' => $CategoryData[$categoryName]['Count']
          ];
      }
  
      $LH_Avg = round(array_sum(array_column($RiskLevelsLH, 'Likelihood_Index')) / count($RiskLevelsLH), 0);
      $IL_Avg = round(array_sum(array_column($RiskLevelsIL, 'Impact_Index')) / count($RiskLevelsIL), 0);
    
      return view('TestDashboard', [
          'risksData' => $risksData,
          'categoryData' => $CategoryData,
          'categoryNames' => $categoryNames,
          'categoryAvgs' => $categoryAvgs,
          'LH_Avg' => $LH_Avg,
          'IL_Avg' => $IL_Avg,
      ]);
  }  
  
  
  
  
  
  
  
  
  
  
public function getRiskMatrixData()
{
    $quarters = [
        'Q1' => ['start' => '2023-01-01', 'end' => '2023-04-01'],
        'Q2' => ['start' => '2023-04-01', 'end' => '2023-07-01'],
        'Q3' => ['start' => '2023-07-01', 'end' => '2023-10-01'],
        'Q4' => ['start' => '2023-10-01', 'end' => '2024-01-01']
    ];

    $categoryCountsData = [];

    foreach ($quarters as $quarter => $dates) {
        $quarterYear = '2023';
        $startDate = $dates['start'];
        $endDate = $dates['end'];

        $risks = Risks::whereBetween('Date_Time', [$startDate, $endDate])->get();

        $categories = [];
        $totalLikelihood = 0;
        $totalImpact = 0;

        foreach ($risks as $risk) {
            $categoryName = $risk->Category;
            $likelihoodLevel = $risk->Evaluation_Likelihood_Level;
            $impactLevel = $risk->Evaluation_Impact_Level;
            $lhIndex = Risk_Levels::where('Likelihood_Level', $likelihoodLevel)->value('Likelihood_Index');
            $ilIndex = Risk_Levels::where('Impact_Level', $impactLevel)->value('Impact_Index');

            if (!isset($categories[$categoryName])) {
                $categories[$categoryName] = [
                    'count' => 1,
                    'likelihood' => $lhIndex,
                    'impact' => $ilIndex,
                ];
            } else {
                $categories[$categoryName]['count']++;
                $categories[$categoryName]['likelihood'] += $lhIndex;
                $categories[$categoryName]['impact'] += $ilIndex;
            }

            $totalLikelihood += $lhIndex;
            $totalImpact += $ilIndex;
        }

        $categoryAverages = [];
        foreach ($categories as $category => $data) {
            $categoryAverages[$category] = [
                'count' => $data['count'],
                'likelihood' => round($data['likelihood'] / $data['count']),
                'impact' => round($data['impact'] / $data['count']),
            ];
        }

        $numberOfRisks = count($risks);
        if ($numberOfRisks > 0) {
            $categoryCountsData[$quarterYear][$quarter] = [
                'categories' => $categoryAverages,
                'averageLikelihood' => round($totalLikelihood / $numberOfRisks),
                'averageImpact' => round($totalImpact / $numberOfRisks),
                'startDate' => $startDate,
                'endDate' => $endDate,
            ];
        } else {
            $categoryCountsData[$quarterYear][$quarter] = [
                'categories' => $categoryAverages,
                'averageLikelihood' => 0,
                'averageImpact' => 0,
                'startDate' => $startDate,
                'endDate' => $endDate,
            ];
        }
    }

    return view('TestDashboard', ['categoryCountsData' => $categoryCountsData]);
}

   public function sendEmail(Request $request)
    {
        $email = $request->input('email');
        $subject = $request->input('subject');
        $description = $request->input('description');

        // Send the email using Laravel's Mail class
        Mail::raw($description, function ($message) use ($email, $subject) {
            $message->to($email);
            $message->subject($subject);
        });

        return response()->json(['message' => 'Email sent successfully']);
    }

public function RiskData(Request $request){
         
       
        $IPAddress=$request->ip();
        $URL=url()->full(); 
        
      return view('RiskCategory.RiskCategory', ['Category' => $data]);
      
    }
public function GetRiskCategory()
{
    $data = Risk_Category::select('Category')->distinct()->orderBy('Category', 'ASC')->get();
    return view('RiskCategory.RiskCategory', ['Category' => $data]);
}


  
  public function RiskDataList(Request $request)
  {
    //return "ok";
     $query=DB::table('Risk_Category');
    //return $query;
          return DataTables::of($query)            
          ->addColumn('RISK CATEGORY', function ($row) {
                return $row->Category;
            })
            
          
            
          ->addColumn('STATUS', function ($row) {
                return $row->Status;
            })
          ->addColumn('RowId', function ($row) {
                return $row->Id;
            })
            
         
              
         
          ->toJson();
        
  }
  
public function changeRiskStatus(Request $request){
     Risk_Category::where('Id',$request['Id'])->update(['Status'=>$request['NextStatus']]);
     $Message=array('StatusCode'=>'00');
     return json_encode($Message);    
    }


public function store(Request $request)
{
    $category = new Risk_Category();
    $category->Category = $request->input('category');
    $category->save();

    return redirect()->route('risk-category.GetRiskCategory')->with('success', 'Risk category added successfully.');
}
public function updateCategory(Request $request)
{
    $key = $request->input('key');
    $category = $request->input('category');

    // Update the category in the database using the $key and $category values

    // Example code:
    $data = Risk_Category::find($key);
    if ($data) {
        $data->Category = $category;
        $data->save();
        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false]);
}



public function getSubcategories(Request $request)
{
    $category = $request->query('category');

    // Query the database to retrieve subcategories based on the category
    $subcategories = DB::table('Risk_Category')
        ->select('Sub_Category')
        ->where('Category', $category)
        ->distinct()
        ->orderBy('Sub_Category', 'ASC')
        ->pluck('Sub_Category');

    return response()->json($subcategories);
}


//DASHBOARD CONTROLLER

public function showRiskIndices()
{
    $risks = DB::table('Risks')
        ->select('Category', 'Evaluation_Likelihood_Level', 'Evaluation_Impact_Level')
        ->get();

    $averages = $this->calculateAverages($risks);

    return view('TestDashboard', ['averages' => $averages]);
}

private function calculateAverages($risks)
{
    $categoryAverages = [];

    foreach ($risks as $risk) {
        $categoryName = $risk->Category;
        $likelihoodLevel = $risk->Evaluation_Likelihood_Level;
        $impactLevel = $risk->Evaluation_Impact_Level;
        $lhIndex = DB::table('Risk_Levels')
            ->where('Likelihood_Level', $likelihoodLevel)
            ->value('Likelihood_Index');

        $ilIndex = DB::table('Risk_Levels')
            ->where('Impact_Level', $impactLevel)
            ->value('Impact_Index');

        if (!isset($categoryAverages[$categoryName])) {
            $categoryAverages[$categoryName] = [
                'totalLikelihoodIndex' => 0,
                'totalImpactIndex' => 0,
                'count' => 0,
            ];
        }

        $categoryAverages[$categoryName]['totalLikelihoodIndex'] += $lhIndex;
        $categoryAverages[$categoryName]['totalImpactIndex'] += $ilIndex;
        $categoryAverages[$categoryName]['count']++;
    }

    $averages = [];

    foreach ($categoryAverages as $categoryName => $categoryData) {
        $averageLikelihoodIndex = $categoryData['count'] > 0 ? round($categoryData['totalLikelihoodIndex'] / $categoryData['count'], 0) : 0;
        $averageImpactIndex = $categoryData['count'] > 0 ? round($categoryData['totalImpactIndex'] / $categoryData['count'], 0) : 0;

        $averages[$categoryName] = [
            'averageLikelihoodIndex' => $averageLikelihoodIndex,
            'averageImpactIndex' => $averageImpactIndex,
        ];
    }

    return $averages;
}


}

