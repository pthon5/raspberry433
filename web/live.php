<!--Developed by pthon-->
<!--Разработано pthon-->
<?php
include_once './connectDB.php';
$max = $_POST['max'];
$query = mysqli_query($connect,"SELECT * FROM rf ORDER BY id DESC LIMIT ".$max);
$fetch = mysqli_fetch_all($query);
foreach ($fetch as $row) {
    echo "<tr style='cursor: pointer;' onclick='sendModal(".$row[1].", ".$row[2].", ".$row[3].")'>" . "<td id='codeTd'>" . $row[1] . "</td>". "<td id='pulseTd'>" . $row[2] . "</td>". "<td id='protocolTd'>" . $row[3] .
        "</td>". "<td>" . $row[4] . "</td>". "<td>" . $row[5] . "</td>" . "</tr>";
}

