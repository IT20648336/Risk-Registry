<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <h1>Average Risk Indices by Category</h1>
    
<?php $__currentLoopData = $averages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoryName => $averageData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php
        $i = $averageData['averageLikelihoodIndex'];
        $j = $averageData['averageImpactIndex'];
    ?>

    <h2><?php echo e($categoryName); ?></h2>
    <p>Average Likelihood Index: <?php echo e($i); ?></p>
    <p>Average Impact Index: <?php echo e($j); ?></p>

    <table style="width: 30%; height: 30%;">
        <?php
        $colorMatrix = [
            ['#FBFF21', '#FBFF21', '#80D157', '#80D157', '#80D157'],
            ['#FBFF21', '#FBFF21', '#FBFF21', '#80D157', '#80D157'],
            ['#FFCD00', '#FFCD00', '#FFCD00', '#FBFF21', '#FBFF21'],
            ['#B16BD1', '#B16BD1', '#FFCD00', '#FFCD00', '#FBFF21'],
            ['#FF0000', '#B16BD1', '#B16BD1', '#FFCD00', '#FFCD00']
        ];

        foreach ($colorMatrix as $rowIndex => $row) {
            echo "<tr>";
            foreach ($row as $colIndex => $color) {
                $cellContent = ($rowIndex === $i && $colIndex === $j) ? "X" : ""; // Display "X" at cutting point

                echo "<td style='background-color: $color;'>$cellContent</td>";
            }
            echo "</tr>";
        }
        ?>
    </table>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH /data/RiskRegistry/resources/views/TestDashboard.blade.php ENDPATH**/ ?>