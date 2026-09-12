<?php
$str=$_REQUEST["id"];
$conn=new mysqli("127.0.0.1","root","","hospital");
$str="select * from add_doctor where hn='$str'";
$res=$conn->query($str);

while(($rows=mysqli_fetch_array($res)))
{
?>
<option><?php echo$rows[0];?></option>
<?php
}

?>