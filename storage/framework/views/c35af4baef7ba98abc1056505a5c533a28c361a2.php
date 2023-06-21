<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>




<h2 style=" position:absolute; left:500px; top:82px;">Q1 2023 Risk Map</h2>
<table id="dashboard-table" style="width:400px; height: 400px; position:absolute; left:365px; top:100px; border:0; ">
  <tr style ="border-style:hidden;">
    <td id="cell-1-1" style="background: #FBFF21;"> </td>
    <td id="cell-1-2" style="background: #FBFF21;">  </td>
    <td id="cell-1-3" style="background: #FFCD00;">  </td>
    <td id="cell-1-4" style="background: #B16BD1;">  </td>
    <td id="cell-1-5" style="background: #FF0000;"> </td>
  </tr>
   <tr style ="border-style:hidden;">
    <td id="cell-2-1" style="background: #FBFF21;">  </td>
    <td id="cell-2-2" style="background: #FBFF21;"> </td>
    <td id="cell-2-3" style="background: #FFCD00;"> </td>
    <td id="cell-2-4" style="background: #B16BD1;"> </td>
    <td id="cell-2-5" style="background: #B16BD1;"> </td>
  </tr>
    <tr style ="border-style:hidden;">
    <td id="cell-3-1" style="background: #80D157;"> </td>
    <td id="cell-3-2" style="background: #FBFF21;">  </td>
    <td id="cell-3-3" style="background: #FFCD00;">  </td>
    <td id="cell-3-4" style="background: #FFCD00;"> </td>
    <td id="cell-3-5" style="background: #B16BD1;"> </td>
  </tr>
  <tr style ="border-style:hidden;">
    <td id="cell-4-1" style="background: #80D157;">  </td>
    <td id="cell-4-2" style="background: #80D157;">  </td>
    <td id="cell-4-3" style="background: #FBFF21;">  </td>
    <td id="cell-4-4" style="background: #FFCD00;">  </td>
    <td id="cell-4-5" style="background: #FFCD00;">  </td>
  </tr>
   <tr style ="border-style:hidden;">
    <td id="cell-5-1" style="background: #80D157;">  </td>
    <td id="cell-5-2" style="background: #80D157;"> </td>
    <td id="cell-5-3" style="background: #FBFF21;">  </td>
    <td id="cell-5-4" style="background: #FBFF21;"> </td>
    <td id="cell-5-5" style="background: #FFCD00;">  </td>
  </tr>
</table>




<table style="width:400px; height: 400px; position:absolute; right:165px; top:70px;">
  <tr>
    <th></th>
    <th>Risk Category</th>
    <th>Q o Q Changes</th>
  </tr>
  <tr>
    <td><button type="button" class="btn btn-primary btn-circle btn-sm">1</button></td>
    <td>Strategic and Investment Risk</td>
    <td>pending</td>
  </tr>
  <tr>
    <td><button type="button" class="btn btn-primary btn-circle btn-sm">2</button><br></td>
    <td>Financial Risk</td>
    <td>pending</td>
  </tr>
  <tr>
    <td><button type="button" class="btn btn-primary btn-circle btn-sm">3</button><br></td>
    <td>Legal and Regulatory Risk</td>
    <td>pending</td>
  </tr>
  <tr>
    <td><button type="button" class="btn btn-primary btn-circle btn-sm">4</button><br></td>
    <td>Operational Risk</td>
    <td>pending</td>
  </tr>
  <tr>
    <td><button type="button" class="btn btn-primary btn-circle btn-sm">5</button><br></td>
    <td>Corruption and Bribery Risk</td>
    <td>pending</td>
  </tr>
  <tr>
    <td><button type="button" class="btn btn-primary btn-circle btn-sm">6</button><br></td>
    <td>Market and Reputation Risk</td>
    <td>pending</td>
  </tr>
   <tr>
    <td><button type="button" class="btn btn-primary btn-circle btn-sm">7</button><br></td>
    <td>Geopolitical Risk</td>
    <td>pending</td>
  </tr>
   <tr>
    <td><button type="button" class="btn btn-primary btn-circle btn-sm">8</button><br></td>
    <td>ESG Risk</td>
    <td>pending</td>
  </tr>
   <tr>
    <td><button type="button" class="btn btn-primary btn-circle btn-sm">9</button><br></td>
    <td>Technology Risk</td>
    <td>pending</td>
  </tr>
   <tr>
    <td><button type="button" class="btn btn-primary btn-circle btn-sm">10</button><br></td>
    <td>People Risk</td>
    <td>pending</td>
  </tr>
   <tr>
    <td><button type="button" class="btn btn-primary btn-circle btn-sm">11</button><br></td>
    <td>Cyber Risk</td>
    <td>pending</td>
  </tr>
</table>

<table>
<tr>
<td>

<h2 style="position:absolute;top:760px; background: #E8E6EE; width: 600px;height: 28px;left: 465px;">Risk Mitigation Action Movement</h2> 
<div class="Riskbar">
    <div class="row justify-content-center">
        <div class="col-md-8">
         
                    <canvas id="risksChart"></canvas>
                </div>
            </div>
        </div>
</td>  
<td>

<p>Hello World</td>
</td>

</tr>      
        
 </table>   

<!-- Load Chart.js library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>

<!-- Create the chart -->
<script>
    var ctx = document.getElementById('risksChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($labels); ?>,
            datasets: [{
                label: 'Risk Mitigation Target',
                data: <?php echo json_encode($totalValues); ?>,
                backgroundColor: 'rgba(255, 189, 0)',
                borderColor: 'rgba(255, 189, 0)',
                borderWidth: 1
                
            },
            {
                label: 'Risk Mitigated - Actual',
                data: <?php echo json_encode($completedValues); ?>,
                backgroundColor: 'rgba(0,179,89)',
                borderColor: 'rgba(0,179,89)', 
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                 elements: {
            rectangle: {
                borderSkipped: 'bottom',
                borderWidth: 2,
                borderDash: [10, 5],
                borderDashOffset: 0
            }
        },
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






<?php /**PATH /data/RiskRegistry/resources/views/Test.blade.php ENDPATH**/ ?>