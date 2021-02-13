<?php
include_once "connectDB.php";

$date1 = $_POST['date1'];
$time1 = $_POST['time1'];
$date2 = $_POST['date2'];
$time2 = $_POST['time2'];

$query = mysqli_query($connect, "SELECT * FROM `rf` WHERE (`date` BETWEEN '".$date1."' AND '".$date2."') AND (`time` BETWEEN '".$time1."' AND '".$time2."')");

if ($query->num_rows == 0) {
    die("No info");
}
var_dump($query);
$fetch = mysqli_fetch_all($query);
foreach ($fetch as $row) {
    echo "<tr style='cursor: pointer;' onclick='sendModal(".$row[1].", ".$row[2].", ".$row[3].")'>" . "<td id='codeTd'>" . $row[1] . "</td>". "<td id='pulseTd'>" . $row[2] . "</td>". "<td id='protocolTd'>" . $row[3] .
        "</td>". "<td>" . $row[4] . "</td>". "<td>" . $row[5] . "</td>" . "</tr>";
}
