@include('layouts.header')

<h2 style="position:absolute;top:160px; background: #E8E6EE; width: 800px;height: 28px;left: 500px;">Risk Mitigation Delayed</h2> 
<div class="RiskDelaybar">
    <div class="row justify-content-center">
        <div class="col-md-8">
         
                    <canvas id="DelayedChart"></canvas>
                </div>
            </div>
        </div>




<script>
    var ctx = document.getElementById('DelayedChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'horizontalBar',
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: [{
                label: 'Delayed Risks',
                data: {!! json_encode($values) !!},
                backgroundColor: '#FFAE7F',
                borderColor: '#FFAE7F',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                xAxes: [{
                    ticks: {
                        beginAtZero: true,
                        precision: 0
                       
                         
                    }
                }]
            }
            
        }
    });
</script>

