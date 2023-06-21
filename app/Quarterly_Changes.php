<?php
$Connection=mysqli_connect("172.26.194.53:3306", "root", "Samsung@123") or die("Unable to connect");
mysqli_select_db($Connection,"RMS") or die("Database does not exists.");

date_default_timezone_set('Asia/Colombo');
$SystemDateTime=date('Y-m-d H:i:s', time());
$SystemDate=date('Y-m-d', time());
$SystemYear=date('Y', time());

function getQuarter($date) {
    $month = date('m', strtotime($date));
    switch ($month) {
        case '01':
        case '02':
        case '03':
            return '1';
        case '04':
        case '05':
        case '06':
            return '2';
        case '07':
        case '08':
        case '09':
            return '3';
        case '10':
        case '11':
        case '12':
            return '4';
    }
}
function GetCategoryNumber($Category) {
if($Category == 'Strategic and Investment Risk'){
return 1;    
} 
if($Category == 'Financial Risk'){
return 2;    
} 
if($Category == 'Legal and Regulatory Risk'){
return 3;    
} 
if($Category == 'Operational Risk'){
return 4;    
} 
if($Category == 'Corruption and Bribery Risk'){
return 5;    
} 
if($Category == 'Market and Reputation Risk'){
return 6;    
} 
if($Category == 'Geopolitical Risk'){
return 7;    
} 
if($Category == 'ESG Risk'){
return 8;    
} 
if($Category == 'Technology Risk'){
return 9;    
} 
if($Category == 'People Risk'){
return 10;    
} 
if($Category == 'Cyber Risk'){
return 11;    
} 

}
$ThisQuarter=getQuarter($SystemDate);
if($ThisQuarter == '1'){
$FromDate=$SystemYear."-01-01 00:00:00";
$ToDate=$SystemYear."-04-01 00:00:00";
}
if($ThisQuarter == '2'){
$FromDate=$SystemYear."-04-01 00:00:00";
$ToDate=$SystemYear."-07-01 00:00:00";
}
if($ThisQuarter == '3'){
$FromDate=$SystemYear."-07-01 00:00:00";
$ToDate=$SystemYear."-10-01 00:00:00";
}
if($ThisQuarter == '4'){
$FromDate=$SystemYear."-10-01 00:00:00";
$ToDate=$SystemYear."-12-31 00:00:00";
}
//$ThisQuarter='1';
//$FromDate="2023-01-01 00:00:00";
//$ToDate="2023-04-01 00:00:00";

$RiskData=mysqli_query($Connection,"SELECT Category,Count(Id) AS RiskCount FROM Risks WHERE Date_Time>='$FromDate' and Date_Time<='$ToDate' group by Category");
while($FetchData=mysqli_fetch_array($RiskData)){
$RiskCategory=$FetchData['Category'];
$RiskCount=$FetchData['RiskCount'];
$LastCount=0;
$Status='Unknown';
$Quarterly_Changes=mysqli_query($Connection,"SELECT * FROM Quarterly_Changes WHERE Category='$RiskCategory' AND Quarter!='$ThisQuarter' ORDER BY Id DESC LIMIT 1");
$LastDataCount=mysqli_num_rows($Quarterly_Changes);
if($LastDataCount > '0'){
$Fetch_Quarterly_Changes=mysqli_fetch_array($Quarterly_Changes);
$LastCount=$Fetch_Quarterly_Changes['Count'];
}
if($RiskCount > $LastCount && $LastCount!='0'){ 
$Status='Increase';   
}
if($RiskCount < $LastCount && $LastCount!='0'){
$Status='Decrease';   
}
if($RiskCount == $LastCount && $LastCount!='0'){
$Status='No-change';   
}
$CategoryNumber=GetCategoryNumber($RiskCategory);
$CheckData=mysqli_query($Connection,"SELECT * FROM Quarterly_Changes WHERE Category='$RiskCategory' AND Year='$SystemYear' AND Quarter='$ThisQuarter'");
$CheckDataCount=mysqli_num_rows($CheckData);
if($CheckDataCount == '0'){
mysqli_query($Connection,"INSERT INTO Quarterly_Changes (Year,Quarter,Category,Category_Number,Count,Status)
VALUES('$SystemYear','$ThisQuarter','$RiskCategory','$CategoryNumber','$RiskCount','$Status')");
}
if($CheckDataCount > '0'){
mysqli_query($Connection,"UPDATE Quarterly_Changes SET Count='$RiskCount', Status='$Status' WHERE Category='$RiskCategory' AND Year='$SystemYear' AND Quarter='$ThisQuarter'");
}
}
/*
die();
$servername = "172.26.194.53";
$username = "root";
$password = "Samsung@123";
$dbname = "RMS";

function getQuarter($date) {
    $month = date('m', strtotime($date));
    switch ($month) {
        case '01':
        case '02':
        case '03':
            return 'Q1';
        case '04':
        case '05':
        case '06':
            return 'Q2';
        case '07':
        case '08':
        case '09':
            return 'Q3';
        case '10':
        case '11':
        case '12':
            return 'Q4';
    }
}

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully<br>";

    $stmt = $conn->prepare("SELECT Category, Date_Time FROM Risks");
    $stmt->execute();

    $insertStmt = $conn->prepare("INSERT INTO Quarters (quarter, start_date, end_date, category_name, count, category_counts) VALUES (:quarter, :start_date, :end_date, :category_name, :count, :category_counts)");


    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $category = $row['Category'];
        $date = $row['Date_Time'];
        $quarter = getQuarter($date); 

        switch ($quarter) {
            case 'Q1':
                $start_date = date('Y-m-d', strtotime('January 1'));
                $end_date = date('Y-m-d', strtotime('April 1'));
                break;
            case 'Q2':
                $start_date = date('Y-m-d', strtotime('April 1'));
                $end_date = date('Y-m-d', strtotime('July 1'));
                break;
            case 'Q3':
                $start_date = date('Y-m-d', strtotime('July 1'));
                $end_date = date('Y-m-d', strtotime('October 1'));
                break;
            case 'Q4':
                $start_date = date('Y-m-d', strtotime('October 1'));
                $end_date = date('Y-m-d', strtotime('December 31'));
                break;
            default:
                $start_date = '';
                $end_date = '';
                break;
        }

        // Group the risks by category
        $risks = $conn->prepare("SELECT * FROM Risks WHERE Category = :category AND Date_Time BETWEEN :start_date AND :end_date");
        $risks->execute([
            ':category' => $category,
            ':start_date' => $start_date,
            ':end_date' => $end_date,
        ]);
        $risks = $risks->fetchAll(PDO::FETCH_ASSOC);

        $category_counts = array();
        $count = count($risks); // Count of risks for this category in this quarter
        foreach ($risks as $risk) {
            $severity = $risk['Severity'];
            if (isset($category_counts[$severity])) {
                $category_counts[$severity]++;
            } else {
                $category_counts[$severity] = 1;
            }
        }

        // Insert the data into the Quarters table
        $insertStmt->execute([
            ':quarter' => $quarter,
            ':start_date' => $start_date,
            ':end_date' => $end_date,
            ':category_counts' => json_encode($category_counts),
            ':category_name' => $category,
            ':count' => $count,
        ]);
    }

    echo "Data inserted successfully";
 } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
 */