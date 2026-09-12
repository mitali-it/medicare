<?php

$conn = new mysqli("localhost","root","","hospital");

if($conn->connect_error)
{
    die("Database Connection Failed");
}

?>

<!DOCTYPE html>
<html>
<head>

<title>MediCare+ - Manage Users</title>

<meta name="viewport"
content="width=device-width, initial-scale=1">

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

<style>

body
{
    background:#f4f7fb;
    font-family:Arial;
}

.navbar
{
    background:#0B1F4D;
}

.navbar-brand
{
    color:white !important;
    font-size:28px;
    font-weight:bold;
}

.navbar-brand span
{
    color:#4da3ff;
}

.nav-link
{
    color:white !important;
}

.container
{
    margin-top:35px;
}

.card
{
    border:0;
    border-radius:15px;
    box-shadow:0 4px 18px rgba(20,45,80,.08);
}

.table thead th
{
    background:#0B1F4D;
    color:white;
}

h2
{
    color:#0B1F4D;
    font-weight:bold;
}

</style>

</head>

<body>


<nav class="navbar navbar-expand-lg">

<a class="navbar-brand"
href="admin1.php">

✚ Medi<span>Care+</span>

</a>

<div class="ml-auto">

<a class="nav-link d-inline-block"
href="admin1.php">

Dashboard

</a>

<a class="nav-link d-inline-block"
href="logout.php">

Logout

</a>

</div>

</nav>


<div class="container">

<div class="card p-4">

<h2>👤 Manage Users</h2>

<p class="text-muted">
Registered users of MediCare+
</p>


<div class="table-responsive">

<table class="table table-bordered table-hover">

<thead>

<tr>

<th>Email</th>
<th>Full Name</th>
<th>Mobile</th>
<th>Date of Birth</th>
<th>Gender</th>

</tr>

</thead>


<tbody>

<?php

$str="SELECT * FROM patient_info";

$res=$conn->query($str);

if($res && $res->num_rows>0)
{

while($rows=mysqli_fetch_array($res))
{

?>

<tr>

<td>
<?php echo htmlspecialchars($rows[0]); ?>
</td>

<td>
<?php echo htmlspecialchars($rows[2]); ?>
</td>

<td>
<?php echo htmlspecialchars($rows[3]); ?>
</td>

<td>
<?php echo htmlspecialchars($rows[4]); ?>
</td>

<td>
<?php echo htmlspecialchars($rows[5]); ?>
</td>

</tr>

<?php

}

}
else
{

?>

<tr>

<td colspan="5"
class="text-center">

No users registered yet.

</td>

</tr>

<?php

}

?>

</tbody>

</table>

</div>

</div>

</div>

</body>
</html>