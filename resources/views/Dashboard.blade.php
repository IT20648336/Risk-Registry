<title>DASHBOARD</title>

@include('layouts.header')

@php
$allData = [];
$numGreenRisks = 0; 
$numRisksInCategory = []; 
$colorRisks = [0, 0, 0, 0, 0];
$categoryCounts = []; 
$displayedCategories = [];
foreach ($categoryNames as $categoryName) {
    $averageLHIndex = round(collect($categoryData[$categoryName]['LH_Index'])->avg(), 0);
    $averageILIndex = round(collect($categoryData[$categoryName]['IL_Index'])->avg(), 0);
    $numRisks = count($categoryData[$categoryName]['LH_Index']);
    $allData[$categoryName] = [
        'averageLHIndex' => $averageLHIndex,
        'averageILIndex' => $averageILIndex,
    ];
    $numRisksInCategory[$categoryName] = $numRisks;
    $categoryCounts[] = $categoryName;
}
$categoryCounts = array_count_values($categoryCounts); 
$categoryCountsJson = json_encode($categoryCounts); 



$colorMatrix = [
    [ '#FBFF21', '#FBFF21', '#80D157', '#80D157', '#80D157' ],
    [ '#FBFF21', '#FBFF21', '#FBFF21', '#80D157', '#80D157' ],
    [ '#FFCD00', '#FFCD00', '#FFCD00', '#FBFF21', '#FBFF21' ],
    [ '#B16BD1', '#B16BD1', '#FFCD00', '#FFCD00', '#FBFF21' ],
    [ '#FF0000', '#B16BD1', '#B16BD1', '#FFCD00', '#FFCD00' ] 
];

$currentYear = date('Y');
$nextYear = $currentYear + 1;
$currentDate = date('Y-m-d');
$quarters = [
    $currentYear => [
        'Q1' => ['start' => $currentYear.'-01-01', 'end' => $currentYear.'-04-01'],
        'Q2' => ['start' => $currentYear.'-04-01', 'end' => $currentYear.'-06-30'],
        'Q3' => ['start' => $currentYear.'-07-01', 'end' => $currentYear.'-09-30'],
        'Q4' => ['start' => $currentYear.'-10-01', 'end' => $currentYear.'-12-31']
    ],
    $nextYear => [
        'Q1' => ['start' => $nextYear.'-01-01', 'end' => $nextYear.'-04-01'],
        'Q2' => ['start' => $nextYear.'-04-01', 'end' => $nextYear.'-06-30'],
        'Q3' => ['start' => $nextYear.'-07-01', 'end' => $nextYear.'-09-30'],
        'Q4' => ['start' => $nextYear.'-10-01', 'end' => $nextYear.'-12-31']
    ]
];

$currentQuarter = '';
foreach ($quarters[$currentYear] as $quarter => $dates) {
    $startDate = $dates['start'];
    $endDate = $dates['end'];

    if ($currentDate >= $startDate && $currentDate <= $endDate) {
        $currentQuarter = $quarter;
        break;
    }
}

$categoryCountsData = [];

foreach ($quarters as $year => $yearQuarters) {
    foreach ($yearQuarters as $quarter => $dates) {
        $quarterYear = $year;
        $startDate = $dates['start'];
        $endDate = $dates['end'];

        $data = DB::table('Risks')
            ->select('Category', 'Date_Time')
            ->whereBetween('Date_Time', [$startDate, $endDate])
            ->get();

        $categories = [];
        foreach ($data as $item) {
            $category = $item->Category;

            if (!array_key_exists($category, $categories)) {
                $categories[$category] = [
                    'count' => 1
                ];
            } else {
                $categories[$category]['count']++;
            }
        }

        $categoryCountsData[$quarterYear][$quarter] = $categories;
    }
}
@endphp

<table style = "display:none;">
    <thead>
        <tr>
            <th>#</th>
            <th>Category</th>
            <th>Average LH Index</th>
            <th>Average IL Index</th>
            <th>Color Code</th>
        </tr>
    </thead>
    <tbody>
        @foreach($categoryDataWithNumber as $number => $categoryData)
            @php
                $categoryName = $categoryData['Category'];
                $averageLHIndex = $categoryData['LH_Avg'];
                $averageILIndex = $categoryData['IL_Avg'];
                $categoryNumber = $number;
                $colorCode = $colorMatrix[$averageILIndex - 1][$averageLHIndex - 1];
            @endphp
            <tr>
                <td>{{ $categoryNumber }}</td>
                <td>{{ $categoryName }}</td>
                <td>{{ $averageLHIndex }}</td>
                <td>{{ $averageILIndex }}</td>
                <td style="background-color: {{ $colorCode }}; width: 20px;"></td>
            </tr>
        @endforeach
    </tbody>
</table>

<table style="width: 90%; height: auto; margin: 0px auto; margin-left:auto; border: hidden;">
  <tr>
    <td valign="top" align="left" style="text-align: left; width: 50%;">
      <table class="Dashboard_table">
        <thead>
          <tr style="background: #E8E6EE; border-radius: 6px 6px 0px 0px; width: 625px; height: 37.48px;">
            <th colspan="10" style="border: none; padding: 5px; text-align: center;background: #E8E6EE">Q1 2023 Risk Map</th>
          </tr>
        </thead>
        <tbody>
          @for ($i = 0; $i < 5; $i++)
          <tr style="border-style: hidden">
            @for ($j = 0; $j < 5; $j++)
            <td style="background-color: {{ $colorMatrix[$j][$i] }}; width: 50px; height: 78px">
              @foreach($categoryDataWithNumber as $categoryNumber => $categoryData)
              @php
              $averageLHIndex = $categoryData['LH_Avg'];
              $averageILIndex = $categoryData['IL_Avg'];
              @endphp
              @if ($j + 1 == $averageILIndex && $i + 1 == $averageLHIndex)
              <span class="circle circle-financial">{{ $categoryNumber }}</span>
              @endif
              @endforeach
            </td>
            @endfor
          </tr>
          @endfor
        </tbody>
      </table>
    </td>

    <td rowspan="2">
      <div class="scrollit-container">
        <div class="scrollit3">
          <table>
            <thead>
              <tr style="background: #E8E6EE; border-radius: 6px 6px 0px 0px; width: 625px; height: 37.48px;">
                <th style="border: none; padding: 5px; background: #E8E6EE;"></th>
                <th style="border: none; padding: 5px; background: #E8E6EE; color: gray;">Risk Category</th>
                <th style="border: none; padding: 5px; background: #E8E6EE; color: gray;">Q o Q Changes</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td style="text-align: center;">
                  @foreach($categoryCountsData as $year => $quarters)
                  @php
                  $prevQuarter = '';
                  @endphp
                  @foreach($quarters as $quarter => $categories)
                  @if ($quarter === $currentQuarter)
                  <tbody>
                    @php
                    $categoryNumber = 1;
                    @endphp
                    @foreach($categories as $category => $data)
                    @php
                    if (isset($allData[$category])) {
                    $averageLHIndex = $allData[$category]['averageLHIndex'];
                    $averageILIndex = $allData[$category]['averageILIndex'];
                    $colorCode = $colorMatrix[$averageILIndex - 1][$averageLHIndex - 1];
                    } else {
                    $averageLHIndex = '-';
                    $averageILIndex = '-';
                    $colorCode = '';
                    }

                    if ($colorCode === '#000000' || $data['count'] === 0 || $averageLHIndex === '-' || $averageILIndex === '-') {
                    continue;
                    }
                    @endphp
                    <tr>
                      <td style="position: relative; padding: 20px;">
                        <div style="position: absolute; bottom: -10px; left: 50%; transform: translateX(-50%); width: 25px; height: 25px;">
                          <div style="position: absolute; top: -23%; left: 50%; transform: translate(-50%, -50%); width: 35px; height: 30px; background-color: {{ $colorCode }};"></div>
                          <div style="position: absolute; top: -23%; left: 50%; transform: translate(-50%, -50%); width: 25px; height: 25px; background-color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                            {{ $categoryNumber }}
                          </div>
                        </div>
                      </td>
                      <td><h4>{{ $category }}</h4></td>
                      <td style="display:none;">{{ $data['count'] }}</td>
                      @php
                      $changeText = '-';
                      if ($prevQuarter != '') {
                      $prevQuarterCategories = $categoryCountsData[$year][$prevQuarter];
                      $prevCount = $prevQuarterCategories[$category]['count'] ?? 0;
                      $change = $data['count'] - $prevCount;
                      if (!array_key_exists($category, $prevQuarterCategories)) {
                      $changeText = '<span style="color:#FFCC00;font-size:20px;">&#9679;</span> <span style="color:#FFCC00;">No-Change</span>';
                      } else {
                      $changeText = $change > 0 ? 'Increase' : ($change < 0 ? 'Decrease' : '<span style="color:#FFCC00;">No-Change</span>');
                      }
                      }
                      @endphp

                      <td>{!! $changeText !!}</td>
                      <td style="display:none;">{{ $averageLHIndex }}</td>
                      <td style="display:none;">{{ $averageILIndex }}</td>
                      <td style="display:none; background-color: {{ $colorCode }}; width: 20px;"></td>
                    </tr>
                    @php
                    $categoryNumber++;
                    @endphp
                    @endforeach
                  </tbody>
                  </table>
                  @endif
                  @php
                  $prevQuarter = $quarter;
                  @endphp
                  @endforeach
                  @endforeach
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </td>
  </tr>

  <table>
    <tr>
      <td style="border:hidden;">
        <table style="width:35%; margin-left:24%; margin-top:-3%;">
          <tr>
            <td style="border: none; padding: 5px; text-align: center;background: #E8E6EE">
              <div class="foo icon1"></div>
            </td>
            <td style="border: none; padding: 5px; text-align: center;background: #E8E6EE">
              <h4>High</h4>
            </td>
            <td style="border: none; padding: 5px; text-align: center;background: #E8E6EE">
              <div class="foo icon2"></div>
            </td>
            <td style="border: none; padding: 5px; text-align: center;background: #E8E6EE">
              <h4>Moderate</h4>
            </td>
          </tr>
          <tr>
            <td style="border: none; padding: 5px; text-align: center;background: #E8E6EE">
              <div class="foo icon3"></div>
            </td>
            <td style="border: none; padding: 5px; text-align: center;background: #E8E6EE">
              <h4>Low</h4>
            </td>
            <td style="border: none; padding: 5px; text-align: center;background: #E8E6EE">
              <div class="foo icon4"></div>
            </td>
            <td style="border: none; padding: 5px; text-align: center;background: #E8E6EE">
              <h4>Extreme</h4>
            </td>
          </tr>
          <tr>
            <td style="border: none; padding: 5px; text-align: center;background: #E8E6EE">
              <div class="foo icon5"></div>
            </td>
            <td style="border: none; padding: 5px; text-align: center;background: #E8E6EE">
              <h4>Significant</h4>
            </td>
            <td style="border: none; padding: 5px; text-align: center;background: #E8E6EE">
            </td>
            <td style="border: none; padding: 5px; text-align: center;background: #E8E6EE">
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</table>
</div>

<h2 style="position: absolute; top: 105%; background: #E8E6EE; width: 70%; height: 28px; left: 60%; transform: translate(-50%, -50%);">Q o Q Movement of Risk Rating</h2>
<div class="Colorbar">
    <div class="row justify-content-center">
        <div class="col-md-8">
         
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>

 <script>
  var ctx = document.getElementById('myChart').getContext('2d');
  var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
          labels: ["Moderate", "High", "Significant", "Extreme", "Low"],
          datasets: [{
              label: 'Number of Risks',
              data: [yellow, orange, purple, red, green],
              backgroundColor: ['#FBFF21', '#FFCD00', '#B16BD1', '#FF0000', '#80D157'],
              borderColor: ['#FBFF21', '#FFCD00', '#B16BD1', '#FF0000', '#80D157'],
              borderWidth: 1
          }]
      },
      options: {
          scales: {
              yAxes: [{
                  ticks: {
                      beginAtZero: true
                  }
              }]
          }
      }
  });

</script>



<!-- Risk Mitigation Chart -->

<h2 style="position: absolute; top: 167%; background: #E8E6EE; width: 70%; height: 28px; left: 60%; transform: translate(-50%, -50%);">Risk Mitigation Action Movement</h2>
<div class="Riskbar">
    <div class="row justify-content-center">
        <div class="col-md-8">
         
                    <canvas id="risksChart"></canvas>
                </div>
            </div>
        </div>
 
 
 
 
 
 <!-- Create the chart Risk Mitigation Chart-->
<script>
    var ctx = document.getElementById('risksChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($labels1) !!},
            datasets: [{
                label: 'Risk Mitigation Target',
                data: {!! json_encode($totalValues) !!},
                backgroundColor: 'rgba(255, 189, 0)',
                borderColor: 'rgba(255, 189, 0)',
                borderWidth: 1                
            },
            {
                label: 'Risk Mitigated - Actual',
                data: {!! json_encode($completedValues) !!},
                backgroundColor: 'rgba(0, 179, 89)',
                borderColor: 'rgba(0, 179, 89)', 
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                xAxes: [{
                    barPercentage: 0.5, 
                    categoryPercentage: 0.2, 
                    categorySpacing: 10,
                }],
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            },
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        var quarterLabel = data.labels[tooltipItem.index];
                        var risksCount = data.datasets[0].data[tooltipItem.index];
                        var completedCount = data.datasets[1].data[tooltipItem.index];
                        return quarterLabel + ': ' + risksCount + ' Risks, ' + completedCount + ' Completed Risks';
                    }
                }
            }
        }
    });
</script>    

<!-- Risk Delayed chart -->



<h2 style="position: absolute; top: 233%; background: #E8E6EE; width: 70%; height: 28px; left: 60%; transform: translate(-50%, -50%);">Risk Mitigation Delayed</h2>
<div class="RiskDelaybar">
    <div class="row justify-content-center">
        <div class="col-md-8">
         
                    <canvas id="DelayedChart"></canvas>
                </div>
            </div>
        </div>
  <!-- Create the chart Risk Delayed Chart-->       
<script>
    var ctx = document.getElementById('DelayedChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'horizontalBar',
        data: {
          labels: {!! json_encode($labels2) !!},
            datasets: [{
                label: '',
                data: {!! json_encode($values) !!},
                backgroundColor:['#FFF1CC', '#B5D8EE', '#FFAE7F', '#CA8E00', '#B0ABAB'],
                borderColor: ['#FFF1CC', '#B5D8EE', '#FFAE7F', '#CA8E00', '#B0ABAB'],
                borderWidth: 1
            }]
        },
         options: {
    scales: {
      xAxes: [
        {
          ticks: {
            beginAtZero: true,
            precision: 0,
          },
        },
      ],
      yAxes: [
        {
                  barPercentage: 0.5, 
                    categoryPercentage: 0.2, 
                    categorySpacing: 10,
        },
      ],
    },
    width: 150,
  },
});

</script>

<!--   BAR GRAPHS -->
@php
use App\Models\Risks;
use App\Models\Risk_Levels;

$currentYear = date('Y');
$numberOfYears = 55; //

$quarters = [
    'Q1' => ['start' => '-01-01', 'end' => '-04-01'],
    'Q2' => ['start' => '-04-01', 'end' => '-07-01'],
    'Q3' => ['start' => '-07-01', 'end' => '-10-01'],
    'Q4' => ['start' => '-10-01', 'end' => '-01-01']
];

$categoryCountsData = [];

for ($i = 0; $i < $numberOfYears; $i++) {
    $year = $currentYear + $i;
    $quarterYear = strval($year);

    foreach ($quarters as $quarter => $dates) {
        $startDate = $quarterYear . $dates['start'];
        $endDate = $quarterYear . $dates['end'];

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
}
@endphp

<table id="quarter-table" style="position:absolute; top:1400px; width:100px; display:none;">
    <thead>
        <tr>
            <th>Quarter</th>
            <th>Category</th>
            <th>Count</th>
            <th>Average Likelihood</th>
            <th>Average Impact</th>
            <th>Color Code</th>
        </tr>
    </thead>
    <tbody>
       @foreach ($categoryCountsData as $year => $quarters)
          @foreach ($quarters as $quarter => $data)
              @foreach ($data['categories'] as $category => $categoryData)
                  @foreach ($allData as $categoryName => $cat)
                      @if (!empty($categoryName) && $categoryName === $category && $categoryData !== null && $categoryData['count'] !== null && $categoryData['likelihood'] !== null && $categoryData['impact'] !== null)
                          @php
                              $averageILIndex = $categoryData['likelihood'];
                              $averageLHIndex = $categoryData['impact'];
                              $color = $colorMatrix[$averageILIndex - 1][$averageLHIndex - 1];
                          @endphp
                          <tr>
                              <td>{{ $year }} - {{ $quarter }}</td>
                              <td>{{ $category }}</td>
                              <td>{{ $categoryData['count'] }}</td>
                              <td>{{ $categoryData['likelihood'] }}</td>
                              <td>{{ $categoryData['impact'] }}</td>
                              <td>{{ $color }}</td>
                          </tr>
                      @endif
                  @endforeach
              @endforeach
          @endforeach
      @endforeach
    </tbody>
</table>



<!-- Add canvas element for the bar graph -->
<div class="Quarterbar">
    <div class="row justify-content-center">
        <div class="col-md-8">
         <canvas id="color-chart" ></canvas>
                </div>
            </div>
        </div>

<script>
 var table = document.getElementById("quarter-table");
 var quarters = {};

for (var i = 1; i < table.rows.length; i++) {
  var quarter = table.rows[i].cells[0].innerHTML;
  var colorCode = table.rows[i].cells[5].innerHTML;
  var numRisks = parseInt(table.rows[i].cells[2].innerHTML);

  if (!(quarter in quarters)) {
    quarters[quarter] = {
      "#FBFF21": 0,
      "#FFCD00": 0,
      "#B16BD1": 0,
      "#FF0000": 0,
      "#80D157": 0,
    };
  }

  switch (colorCode) {
    case "#FBFF21":
      quarters[quarter]["#FBFF21"] += numRisks;
      break;
    case "#FFCD00":
      quarters[quarter]["#FFCD00"] += numRisks;
      break;
    case "#B16BD1":
      quarters[quarter]["#B16BD1"] += numRisks;
      break;
    case "#FF0000":
      quarters[quarter]["#FF0000"] += numRisks;
      break;
    case "#80D157":
      quarters[quarter]["#80D157"] += numRisks;
      break;
    default:
      break;
  }
}

var ctx = document.getElementById("color-chart").getContext("2d");
var colorChart = new Chart(ctx, {
  type: "bar",
  data: {
    labels: Object.keys(quarters),
    datasets: [
      {
        label: "Moderate",
        data: Object.values(quarters).map((q) => q["#FBFF21"]),
        backgroundColor: "#FBFF21",
      },
      {
        label: "High",
        data: Object.values(quarters).map((q) => q["#FFCD00"]),
        backgroundColor: "#FFCD00",
      },
      {
        label: "Significant",
        data: Object.values(quarters).map((q) => q["#B16BD1"]),
        backgroundColor: "#B16BD1",
      },
      {
        label: "Extreme",
        data: Object.values(quarters).map((q) => q["#FF0000"]),
        backgroundColor: "#FF0000",
      },
      {
        label: "Low",
        data: Object.values(quarters).map((q) => q["#80D157"]),
        backgroundColor: "#80D157",
      },
    ],
  },
  options: {
    scales: {
      yAxes: [
        {
          ticks: {
            beginAtZero: true,
            precision: 0,
          },
        },
      ],
      xAxes: [
        {
          barPercentage: 0.7,
          categoryPercentage: 0.4,
          categorySpacing: 20,
        },
      ],
    },
    width: 150,
  },
});

</script>