@include('layouts.header')

    <h1>Average Risk Indices by Category</h1>
    
        <table style= "width:30%; height:30%; ">
        <?php
        $colorMatrix = [
            [ '#FBFF21', '#FBFF21', '#80D157', '#80D157', '#80D157' ],
            [ '#FBFF21', '#FBFF21', '#FBFF21', '#80D157', '#80D157' ],
            [ '#FFCD00', '#FFCD00', '#FFCD00', '#FBFF21', '#FBFF21' ],
            [ '#B16BD1', '#B16BD1', '#FFCD00', '#FFCD00', '#FBFF21' ],
            [ '#FF0000', '#B16BD1', '#B16BD1', '#FFCD00', '#FFCD00' ] 
        ];

        foreach ($colorMatrix as $row) {
            echo "<tr>";
            foreach ($row as $color) {
                echo "<td style='background-color: $color;'></td>";
            }
            echo "</tr>";
        }
        ?>
    </table>
    
    @foreach ($averages as $categoryName => $averageData)
        <h2>{{ $categoryName }}</h2>
        <p>Average Likelihood Index: {{ $averageData['averageLikelihoodIndex'] }}</p>
        <p>Average Impact Index: {{ $averageData['averageImpactIndex'] }}</p>
    @endforeach
    
