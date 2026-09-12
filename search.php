<?php

$str = $_REQUEST["id"];

$conn = new mysqli("127.0.0.1","root","","hospital");

$str = "select * from pstatus where patient_info='$str'";

$res = $conn->query($str);

while(($rows=mysqli_fetch_array($res)))
{
    echo $rows[1]."<br>";
    echo $rows[2]."<br>";
    echo $rows[0]."<br>";
    echo "<hr>";
}

?>