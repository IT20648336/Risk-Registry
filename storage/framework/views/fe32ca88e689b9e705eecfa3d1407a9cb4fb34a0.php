<title>CLOSED RISKS</title>

<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<p style="position:absolute; top:50px; font-family:Open Sans; color: #4A3B94; font-size: 18px;  font-weight: 600;"> Closed Risks </p>
<button style="position:absolute; top:60px; left:60%; font-family:Open Sans; color: #4A3B94; font-size: 12px;  font-weight: 700; background-color: white; border: 1px solid #C4C4C4; border-radius: 10px; box-sizing: border-box; line-height: 19px;"> Extract 
</button>

<style>
table {
  border-collapse: collapse;
  width: 80%;
  position:absolute;
  top:130px;
  
}

th, td {
  text-align: left;
  padding: 1px;
  border-bottom: 1px solid #ddd;
}

tr:nth-child(even) {
  background-color: #f2f2f2;
}

th {
  background-color: #F6F4FC;
  color: black;
}

.view-btn {
  background-color: #FFFFFF;
  border: 1px solid #4A3B94;
  color: #4A3B94;
  padding: 6px 12px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 14px;
  margin: 4px 2px;
  cursor: pointer;
  border-radius: 3px;
}


</style>

<table>
  <tr>
    <th>Risk ID</th>
    <th>Risk Name</th>
    <th>Risk Owner</th>
    <th>Risk Response</th>
    <th>Closed Date</th>
    <th>ACTION</th>
  </tr>
  <tr>
    <td>00001</td>
    <td>Technology Risk</td>
    <td>Demo</td>
    <td>Demo</td>
    <td>2022-03-15</td>
    <td><button class="view-btn">View</button></td>
  </tr>
  <tr>
    <td>00001</td>
    <td>Technology Risk</td>
    <td>Demo</td>
    <td>Demo</td>
    <td>2022-04-01</td>
    <td><button class="view-btn">View</button></td>
  </tr>
  <tr>
    <td>00001</td>
    <td>Technology Risk</td>
    <td>Demo</td>
    <td>Demo</td>
    <td>2022-04-01</td>
    <td><button class="view-btn">View</button></td>
  </tr>
</table>

<?php /**PATH /data/RiskRegistry/resources/views/AdminFunctions/ClosedRisks.blade.php ENDPATH**/ ?>