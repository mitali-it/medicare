<?php
session_start();

if(!isset($_SESSION["admin"]))
{
    header("Location: admin-login.php");
    exit();
}
?>
<?php

$conn = new mysqli("localhost","root","","hospital");

if($conn->connect_error)
{
    die("Database Connection Failed : ".$conn->connect_error);
}


/* =========================
   DASHBOARD COUNTS
   ========================= */

$hospitalCount = 0;
$doctorCount = 0;
$appointmentCount = 0;
$userCount = 0;

$r = $conn->query("SELECT COUNT(*) AS total FROM add_hospital");
if($r)
{
    $row = $r->fetch_assoc();
    $hospitalCount = $row['total'];
}

$r = $conn->query("SELECT COUNT(*) AS total FROM add_doctor");
if($r)
{
    $row = $r->fetch_assoc();
    $doctorCount = $row['total'];
}

$r = $conn->query("SELECT COUNT(*) AS total FROM appointment");
if($r)
{
    $row = $r->fetch_assoc();
    $appointmentCount = $row['total'];
}

$r = $conn->query("SELECT COUNT(*) AS total FROM patient_info");
if($r)
{
    $row = $r->fetch_assoc();
    $userCount = $row['total'];
}


/* =========================
   ADD HOSPITAL
   ========================= */

if(isset($_REQUEST["x"]))
{
    $p1=$_REQUEST["hn"] ?? "";
    $p2=$_REQUEST["ht"] ?? "";
    $p3=$_REQUEST["ha"] ?? "";
    $p4=$_REQUEST["abt"] ?? "";
    $p5=$_REQUEST["hc"] ?? "";
    $p6=$_REQUEST["hs"] ?? "";
    $p7=$_REQUEST["hp"] ?? "";
    $p8=$_REQUEST["mb"] ?? "";
    $p9=$_REQUEST["e"] ?? "";
    $p10=$_REQUEST["w"] ?? "";
    $p11=$_REQUEST["emg"] ?? "";
    $p12=$_REQUEST["ot"] ?? "";
    $p13=$_REQUEST["ct"] ?? "";
    $p14=$_REQUEST["s"] ?? "";
    $p15=$_REQUEST["hp1"] ?? "";

    $str="insert into add_hospital
    values('$p1','$p2','$p3','$p4','$p5','$p6','$p7',
           '$p8','$p9','$p10','$p11','$p12','$p13','$p14','$p15')";

    if($conn->query($str))
    {
        echo '<script>alert("Hospital Added Successfully !!!");</script>';
    }
}


/* =========================
   ADD DOCTOR
   ========================= */

if(isset($_REQUEST["z"]))
{
    $p1=$_REQUEST["dn"] ?? "";
    $p2=$_REQUEST["hn"] ?? "";
    $p3=$_REQUEST["dpn"] ?? "";
    $p4=$_REQUEST["sp"] ?? "";
    $p5=$_REQUEST["q"] ?? "";
    $p6=$_REQUEST["mb"] ?? "";
    $p7=$_REQUEST["ex"] ?? "";
    $p8=$_REQUEST["s"] ?? "";
    $p9=$_REQUEST["hp1"] ?? "";

    $str="insert into add_doctor
    (dn,hn,dpn,sp,q,mb,ex,s,hp1)
    values('$p1','$p2','$p3','$p4','$p5','$p6','$p7','$p8','$p9')";

    if($conn->query($str))
    {
        echo '<script>alert("Doctor Added Successfully !!!");</script>';
    }
}


/* =========================
   ADD SERVICE
   ========================= */

if(isset($_REQUEST["w"]))
{
    $p1=$_REQUEST["sn"] ?? "";
    $p2=$_REQUEST["h"] ?? "";
    $p3=$_REQUEST["dp"] ?? "";
    $p4=$_REQUEST["d"] ?? "";
    $p5=$_REQUEST["a"] ?? "";
    $p6=$_REQUEST["s"] ?? "";
    $p7=$_REQUEST["hp1"] ?? "";

    $str="insert into add_service
    values('$p1','$p2','$p3','$p4','$p5','$p6','$p7')";

    if($conn->query($str))
    {
        echo '<script>alert("Service Added Successfully !!!");</script>';
    }
}


/* =========================
   APPOINTMENT YES
   ========================= */
if(isset($_POST["yes"]))
{
    $an = $conn->real_escape_string(trim($_POST["an"] ?? ""));
    $m  = $conn->real_escape_string(trim($_POST["m"] ?? ""));
    $e  = $conn->real_escape_string(trim($_POST["e"] ?? ""));
    $hn = $conn->real_escape_string(trim($_POST["hn"] ?? ""));
    $dn = $conn->real_escape_string(trim($_POST["dn"] ?? ""));
    $ad = $conn->real_escape_string(trim($_POST["ad"] ?? ""));
    $at = $conn->real_escape_string(trim($_POST["at"] ?? ""));

    $str = "UPDATE appointment
            SET status='Approved'
            WHERE an='$an'
            AND m='$m'
            AND e='$e'
            AND hn='$hn'
            AND dn='$dn'
            AND ad='$ad'
            AND at='$at'";

    if($conn->query($str))
    {
        echo '<script>alert("Appointment Accepted !!!");</script>';
    }
    else
    {
        echo '<script>alert("Database Error: '.addslashes($conn->error).'");</script>';
    }
}

/* =========================
   APPOINTMENT NO
   ========================= */

if(isset($_POST["no"]))
{
    $an = $conn->real_escape_string(trim($_POST["an"] ?? ""));
    $m  = $conn->real_escape_string(trim($_POST["m"] ?? ""));
    $e  = $conn->real_escape_string(trim($_POST["e"] ?? ""));
    $hn = $conn->real_escape_string(trim($_POST["hn"] ?? ""));
    $dn = $conn->real_escape_string(trim($_POST["dn"] ?? ""));
    $ad = $conn->real_escape_string(trim($_POST["ad"] ?? ""));
    $at = $conn->real_escape_string(trim($_POST["at"] ?? ""));

    $str = "UPDATE appointment
            SET status='Rejected'
            WHERE an='$an'
            AND m='$m'
            AND e='$e'
            AND hn='$hn'
            AND dn='$dn'
            AND ad='$ad'
            AND at='$at'";

    if($conn->query($str))
    {
        echo '<script>alert("Appointment Rejected !!!");</script>';
    }
    else
    {
        echo '<script>alert("Database Error: '.addslashes($conn->error).'");</script>';
    }
}
?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>MediCare+ Admin Panel</title>

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">


<style>

body
{
    margin:0;
    background:#f4f7fb;
    font-family:Arial,sans-serif;
    color:#172033;
}


/* NAVBAR */

.navbar
{
    background:#0B1F4D !important;
    padding:14px 30px;
    box-shadow:0 3px 12px rgba(0,0,0,.15);
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
    margin-left:10px;
    font-size:15px;
}

.nav-link:hover
{
    color:#4da3ff !important;
}


/* MAIN */

.dashboard
{
    padding:30px 5%;
}


/* WELCOME */

.welcome
{
    background:white;
    border-radius:16px;
    padding:25px 30px;
    margin-bottom:25px;
    box-shadow:0 4px 18px rgba(20,45,80,.08);
}

.welcome h1
{
    color:#0B1F4D;
    font-size:28px;
    font-weight:bold;
    margin:0;
}

.welcome p
{
    color:#718096;
    margin:6px 0 0;
}


/* APPOINTMENT */

.appointment-section
{
    background:white;
    border-radius:16px;
    padding:25px;
    margin-bottom:30px;
    box-shadow:0 4px 18px rgba(20,45,80,.08);
}

.appointment-heading
{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
}

.appointment-heading h2
{
    color:#0B1F4D;
    font-size:23px;
    font-weight:bold;
    margin:0;
}

.appointment-count
{
    background:#eef6ff;
    color:#126fc1;
    padding:8px 15px;
    border-radius:20px;
    font-weight:bold;
}

.appointment-table
{
    min-width:1100px;
}

.appointment-table thead th
{
    background:#0B1F4D;
    color:white;
    white-space:nowrap;
    border:0;
}

.appointment-table td
{
    vertical-align:middle;
    font-size:14px;
}

.appointment-table tbody tr:hover
{
    background:#f7fbff;
}

.status-form
{
    display:flex;
    gap:6px;
}


/* REPORTS */

.reports-section
{
    background:white;
    border-radius:16px;
    padding:25px;
    margin-top:30px;
    margin-bottom:30px;
    box-shadow:0 4px 18px rgba(20,45,80,.08);
}

.report-grid
{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:20px;
}

.report-card
{
    background:#f7fbff;
    border-radius:12px;
    padding:20px;
    text-align:center;
    border:1px solid #e5edf7;
}

.report-card .report-icon
{
    font-size:32px;
    margin-bottom:8px;
}

.report-card h3
{
    color:#0B1F4D;
    font-size:28px;
    font-weight:bold;
    margin:0;
}

.report-card p
{
    color:#718096;
    margin:5px 0 0;
}

@media(max-width:992px)
{
    .report-grid
    {
        grid-template-columns:repeat(2,1fr);
    }
}

@media(max-width:576px)
{
    .report-grid
    {
        grid-template-columns:1fr;
    }
}

/* STAT CARDS */

.stat-grid
{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:20px;
    margin-bottom:30px;
}

.stat-card
{
    background:white;
    border-radius:15px;
    padding:22px;
    box-shadow:0 4px 18px rgba(20,45,80,.08);
    transition:.2s;
}

.stat-card:hover
{
    transform:translateY(-3px);
}

.stat-icon
{
    width:50px;
    height:50px;
    background:#eef6ff;
    border-radius:12px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:25px;
    margin-bottom:12px;
}

.stat-card h2
{
    color:#0B1F4D;
    font-size:30px;
    margin:0;
    font-weight:bold;
}

.stat-card p
{
    color:#718096;
    margin:5px 0 0;
}


/* QUICK ACTIONS */

.section-title
{
    color:#0B1F4D;
    font-size:23px;
    font-weight:bold;
    margin-bottom:15px;
}

.quick-grid
{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:20px;
}

.quick-card
{
    background:white;
    padding:25px;
    text-align:center;
    border-radius:15px;
    box-shadow:0 4px 18px rgba(20,45,80,.08);
}

.quick-card .icon
{
    font-size:35px;
    margin-bottom:10px;
}

.quick-card h4
{
    color:#0B1F4D;
    font-size:18px;
    margin-bottom:15px;
}


/* MODAL */

.modal-content
{
    border:0;
    border-radius:14px;
    overflow:hidden;
}

.modal-header
{
    background:#0B1F4D;
    color:white;
}

.modal-header .close
{
    color:white;
    opacity:1;
}

.form-control
{
    border-radius:7px;
}

.btn-primary
{
    background:#126fc1;
    border-color:#126fc1;
}


/* RESPONSIVE */

@media(max-width:992px)
{
    .stat-grid
    {
        grid-template-columns:repeat(2,1fr);
    }

    .quick-grid
    {
        grid-template-columns:1fr;
    }
}

@media(max-width:576px)
{
    .stat-grid
    {
        grid-template-columns:1fr;
    }

    .dashboard
    {
        padding:20px 4%;
    }

    .appointment-section
    {
        padding:15px;
    }
}

#contactMessages{
    background:white;
    padding:25px;
    border-radius:15px;
    box-shadow:0 5px 20px rgba(0,0,0,0.08);
}

#contactMessages table{
    background:white;
}

#contactMessages th{
    vertical-align:middle;
}

#contactMessages td{
    vertical-align:middle;
}

</style>

</head>


<body>


<!-- =========================
     NAVBAR
     ========================= -->

<nav class="navbar navbar-expand-lg navbar-dark">

<a class="navbar-brand"
href="admin1.php">

✚ Medi<span>Care+</span>

</a>


<button class="navbar-toggler"
type="button"
data-toggle="collapse"
data-target="#mainNav">

<span style="color:white;">☰</span>

</button>


<div class="collapse navbar-collapse"
id="mainNav">


<ul class="navbar-nav mr-auto">


<li class="nav-item">

<a class="nav-link"
href="#dashboard">

Dashboard

</a>

</li>


<li class="nav-item">

<a class="nav-link"
href="#"
data-toggle="modal"
data-target="#hospitalModal">

Add Hospital

</a>

</li>


<li class="nav-item">

<a class="nav-link"
href="#"
data-toggle="modal"
data-target="#serviceModal">

Add Services

</a>

</li>


<li class="nav-item">

<a class="nav-link"
href="#"
data-toggle="modal"
data-target="#doctorModal">

Add Doctor

</a>

</li>


<li class="nav-item">

<a class="nav-link"
href="#manageAppointments">

Manage Appointments

</a>

</li>


<li class="nav-item">

<a class="nav-link"
href="manage_users.php">

Manage Users

</a>

</li>


<li class="nav-item">

<a class="nav-link"
href="#reports">

Reports

</a>

</li>

<li class="nav-item">
    <a class="nav-link" href="#contactMessages">
        Contact Messages
    </a>
</li>


<li class="nav-item">

<a class="nav-link"
href="admin-logout.php">

Logout

</a>

</li>


</ul>

</div>

</nav>



<!-- =========================
     MAIN DASHBOARD
     ========================= -->

<div class="dashboard"
id="dashboard">


<div class="welcome">

<h1>
✚ Medi<span style="color:#4da3ff;">Care+</span>
Admin Dashboard
</h1>

<p>
Manage hospitals, doctors and patient appointments
</p>

</div>



<!-- =========================
     APPOINTMENTS FIRST
     ========================= -->

<section
class="appointment-section"
id="manageAppointments">


<div class="appointment-heading">

<h2>
📅 Manage Appointments
</h2>

<span class="appointment-count">

<?php echo $appointmentCount; ?> Total

</span>

</div>


<div class="table-responsive">


<table class="table appointment-table">


<thead>

<tr>

<th>Patient Name</th>
<th>Mobile</th>
<th>Email</th>
<th>Hospital</th>
<th>Doctor</th>
<th>Date</th>
<th>Time</th>
<th>Symptoms</th>
<th>Status</th>
<th>Action</th>
</tr>

</thead>


<tbody>


<?php

$str="select * from appointment";

$res=$conn->query($str);


if($res && $res->num_rows > 0)
{

while(($rows=mysqli_fetch_array($res)))
{

?>

<tr>


<td>

<?php echo htmlspecialchars($rows[0]);?>

</td>


<td>

<?php echo htmlspecialchars($rows[2]);?>

</td>


<td>

<?php echo htmlspecialchars($rows[3]);?>

</td>


<td>

<?php echo htmlspecialchars($rows[4]);?>

</td>


<td>

<?php echo htmlspecialchars($rows[5]);?>

</td>


<td>

<?php echo htmlspecialchars($rows[7]);?>

</td>


<td>

<?php echo htmlspecialchars($rows[8]);?>

</td>


<td>

<?php echo htmlspecialchars($rows[9]);?>

</td>

<td>
    <?php
    $status = $rows[10] ?? "Pending";

    if($status == "Approved")
    {
        echo '<span class="badge badge-success">Approved</span>';
    }
    elseif($status == "Rejected")
    {
        echo '<span class="badge badge-danger">Rejected</span>';
    }
    else
    {
        echo '<span class="badge badge-warning">Pending</span>';
    }
    ?>
</td>
<td>

<form
method="post"
action="admin1.php"
class="status-form">


<input type="hidden"
       name="an"
       value="<?php echo htmlspecialchars(trim($rows[1]), ENT_QUOTES); ?>">

<input type="hidden"
       name="m"
       value="<?php echo htmlspecialchars(trim($rows[2]), ENT_QUOTES); ?>">

<input type="hidden"
       name="e"
       value="<?php echo htmlspecialchars(trim($rows[3]), ENT_QUOTES); ?>">

<input type="hidden"
       name="hn"
       value="<?php echo htmlspecialchars(trim($rows[4]), ENT_QUOTES); ?>">

<input type="hidden"
       name="dn"
       value="<?php echo htmlspecialchars(trim($rows[5]), ENT_QUOTES); ?>">

<input type="hidden"
       name="ad"
       value="<?php echo htmlspecialchars(trim($rows[7]), ENT_QUOTES); ?>">

<input type="hidden"
       name="at"
       value="<?php echo htmlspecialchars(trim($rows[8]), ENT_QUOTES); ?>">



<input
type="submit"
name="yes"
value="Yes"
class="btn btn-success btn-sm">


<input
type="submit"
name="no"
value="No"
class="btn btn-danger btn-sm">


</form>

</td>


</tr>


<?php

}

}
else
{

?>

<tr>

<td
colspan="10"
class="text-center">

No appointments booked yet.

</td>

</tr>

<?php

}

?>


</tbody>

</table>

</div>

</section>



<!-- =========================
     COUNT CARDS
     ========================= -->

<div class="stat-grid">


<div class="stat-card">

<div class="stat-icon">
🏥
</div>

<h2>
<?php echo $hospitalCount; ?>
</h2>

<p>
Total Hospitals
</p>

</div>


<div class="stat-card">

<div class="stat-icon">
👨‍⚕️
</div>

<h2>
<?php echo $doctorCount; ?>
</h2>

<p>
Total Doctors
</p>

</div>


<div class="stat-card">

<div class="stat-icon">
📅
</div>

<h2>
<?php echo $appointmentCount; ?>
</h2>

<p>
Total Appointments
</p>

</div>


<div class="stat-card">

<div class="stat-icon">
👤
</div>

<h2>
<?php echo $userCount; ?>
</h2>

<p>
Total Users
</p>

</div>


</div>



<!-- =========================
     QUICK ACTIONS
     ========================= -->

<div class="section-title">
Quick Actions
</div>


<div class="quick-grid">


<div class="quick-card">

<div class="icon">
🏥
</div>

<h4>
Add Hospital
</h4>

<a href="#"
data-toggle="modal"
data-target="#hospitalModal"
class="btn btn-primary">

Add Now

</a>

</div>


<div class="quick-card">

<div class="icon">
👨‍⚕️
</div>

<h4>
Add Doctor
</h4>

<a href="#"
data-toggle="modal"
data-target="#doctorModal"
class="btn btn-primary">

Add Now

</a>

</div>


<div class="quick-card">

<div class="icon">
🩺
</div>

<h4>
Add Service
</h4>

<a href="#"
data-toggle="modal"
data-target="#serviceModal"
class="btn btn-primary">

Add Now

</a>

</div>


</div>

</div>


<!-- =========================
     REPORTS
     ========================= -->

<?php
$yesCount = 0;
$noCount = 0;

$statusResult = $conn->query(
    "SELECT status, COUNT(*) AS total
     FROM appointment
     WHERE status IN ('Approved','Rejected')
     GROUP BY status"
);

if($statusResult)
{
    while($statusRow = $statusResult->fetch_assoc())
    {
        if($statusRow["status"] == "Approved")
        {
            $yesCount = $statusRow["total"];
        }

        if($statusRow["status"] == "Rejected")
        {
            $noCount = $statusRow["total"];
        }
    }
}

?>


<section
class="reports-section"
id="reports">


<h2 class="section-title">

📈 Reports

</h2>


<div class="report-grid">


<div class="report-card">

<div class="report-icon">
🏥
</div>

<h3>
<?php echo $hospitalCount; ?>
</h3>

<p>
Total Hospitals
</p>

</div>



<div class="report-card">

<div class="report-icon">
👨‍⚕️
</div>

<h3>
<?php echo $doctorCount; ?>
</h3>

<p>
Total Doctors
</p>

</div>



<div class="report-card">

<div class="report-icon">
👤
</div>

<h3>
<?php echo $userCount; ?>
</h3>

<p>
Total Users
</p>

</div>



<div class="report-card">

<div class="report-icon">
📅
</div>

<h3>
<?php echo $appointmentCount; ?>
</h3>

<p>
Total Appointments
</p>

</div>



<div class="report-card">

<div class="report-icon">
✅
</div>

<h3>
<?php echo $yesCount; ?>
</h3>

<p>
Accepted Appointments
</p>

</div>



<div class="report-card">

<div class="report-icon">
❌
</div>

<h3>
<?php echo $noCount; ?>
</h3>

<p>
Rejected Appointments
</p>

</div>


</div>

</section>












<!-- ================= CONTACT MESSAGES ================= -->

<div class="container mt-5 mb-5" id="contactMessages">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 style="color:#0B1F4D; font-weight:bold;">
                📩 Contact Messages
            </h2>

            <p style="color:#777;">
                Messages received from website users
            </p>
        </div>
    </div>


    <?php

    $contactResult = $conn->query(
        "SELECT * FROM contact_messages
         ORDER BY created_at DESC"
    );

    ?>


    <div class="table-responsive">

        <table class="table table-bordered table-hover">

            <thead style="background:#0B1F4D; color:white;">

                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Date</th>
                </tr>

            </thead>


            <tbody>

            <?php

            if($contactResult && $contactResult->num_rows > 0)
            {

                $i = 1;

                while($msg = $contactResult->fetch_assoc())
                {

            ?>

                <tr>

                    <td>
                        <?php echo $i++; ?>
                    </td>

                    <td>
                        <?php
                        echo htmlspecialchars($msg["name"]);
                        ?>
                    </td>

                    <td>
                        <?php
                        echo htmlspecialchars($msg["email"]);
                        ?>
                    </td>

                    <td>
                        <?php
                        echo htmlspecialchars($msg["subject"]);
                        ?>
                    </td>

                    <td style="min-width:250px;">

                        <?php
                        echo nl2br(
                            htmlspecialchars($msg["message"])
                        );
                        ?>

                    </td>

                    <td style="white-space:nowrap;">

                        <?php
                        echo date(
                            "d-m-Y h:i A",
                            strtotime($msg["created_at"])
                        );
                        ?>

                    </td>

                </tr>

            <?php

                }

            }
            else
            {

            ?>

                <tr>

                    <td colspan="6"
                        class="text-center"
                        style="padding:30px;">

                        📭 No messages received yet.

                    </td>

                </tr>

            <?php

            }

            ?>

            </tbody>

        </table>

    </div>

</div>
<!-- =========================
     ADD HOSPITAL MODAL
     ========================= -->

<div class="modal fade"
id="hospitalModal">

<div class="modal-dialog modal-lg">

<div class="modal-content">


<div class="modal-header">

<h5 class="modal-title">
🏥 Add Hospital
</h5>

<button
type="button"
class="close"
data-dismiss="modal">

&times;

</button>

</div>


<div class="modal-body">


<form
action="admin1.php"
method="post">


<div class="form-row">

<div class="form-group col-md-6">

<label>Hospital Name</label>

<input
type="text"
class="form-control"
name="hn"
required>

</div>


<div class="form-group col-md-6">

<label>Hospital Type</label>

<input
type="text"
class="form-control"
name="ht">

</div>

</div>


<div class="form-group">

<label>Address</label>

<input
type="text"
class="form-control"
name="ha">

</div>


<div class="form-group">

<label>About Hospital</label>

<textarea
class="form-control"
name="abt"></textarea>

</div>


<div class="form-row">

<div class="form-group col-md-6">

<label>Hospital Contact</label>

<input
type="text"
class="form-control"
name="hc">

</div>


<div class="form-group col-md-6">

<label>Hospital Status</label>

<input
type="text"
class="form-control"
name="hs">

</div>

</div>


<div class="form-row">

<div class="form-group col-md-6">

<label>Phone</label>

<input
type="text"
class="form-control"
name="hp">

</div>


<div class="form-group col-md-6">

<label>Mobile</label>

<input
type="text"
class="form-control"
name="mb">

</div>

</div>


<div class="form-row">

<div class="form-group col-md-6">

<label>Email</label>

<input
type="email"
class="form-control"
name="e">

</div>


<div class="form-group col-md-6">

<label>Website</label>

<input
type="text"
class="form-control"
name="w">

</div>

</div>


<div class="form-row">

<div class="form-group col-md-6">

<label>Emergency</label>

<input
type="text"
class="form-control"
name="emg">

</div>


<div class="form-group col-md-6">

<label>Opening Time</label>

<input
type="text"
class="form-control"
name="ot">

</div>

</div>


<div class="form-row">

<div class="form-group col-md-6">

<label>Closing Time</label>

<input
type="text"
class="form-control"
name="ct">

</div>


<div class="form-group col-md-6">

<label>Status</label>

<input
type="text"
class="form-control"
name="s">

</div>

</div>


<div class="form-group">

<label>Hospital Image</label>

<input type="file" name="hp1" class="form-control" accept="image/*">

</div>


<button
type="submit"
name="x"
value="Save"
class="btn btn-primary">

Save Hospital

</button>


</form>

</div>

</div>

</div>

</div>



<!-- =========================
     ADD DOCTOR MODAL
     ========================= -->

<div class="modal fade"
id="doctorModal">

<div class="modal-dialog modal-lg">

<div class="modal-content">


<div class="modal-header">

<h5 class="modal-title">
👨‍⚕️ Add Doctor
</h5>

<button
type="button"
class="close"
data-dismiss="modal">

&times;

</button>

</div>


<div class="modal-body">


<form
action="admin1.php"
method="post">


<div class="form-row">

<div class="form-group col-md-6">

<label>Doctor Name</label>

<input
type="text"
class="form-control"
name="dn"
required>

</div>


<div class="form-group col-md-6">

<label>Hospital</label>

<select
class="form-control"
name="hn"
required>

<option value="">
Select Hospital
</option>


<?php

$r=$conn->query("SELECT hn FROM add_hospital");

while($row=mysqli_fetch_array($r))
{

?>

<option>
<?php echo htmlspecialchars($row[0]); ?>
</option>

<?php

}

?>

</select>

</div>

</div>


<div class="form-group">

<label>Department</label>

<input
type="text"
class="form-control"
name="dpn">

</div>


<div class="form-row">

<div class="form-group col-md-6">

<label>Specialization</label>

<input
type="text"
class="form-control"
name="sp">

</div>


<div class="form-group col-md-6">

<label>Qualification</label>

<input
type="text"
class="form-control"
name="q">

</div>

</div>


<div class="form-row">

<div class="form-group col-md-6">

<label>Mobile</label>

<input
type="text"
class="form-control"
name="mb">

</div>


<div class="form-group col-md-6">

<label>Experience</label>

<input
type="text"
class="form-control"
name="ex">

</div>

</div>


<div class="form-row">

<div class="form-group col-md-6">

<label>Status</label>

<input
type="text"
class="form-control"
name="s">

</div>


<div class="form-group col-md-6">

<label>Doctor Image</label>

<input type="file" name="hp1" class="form-control" accept="image/*">

</div>

</div>


<button
type="submit"
name="z"
value="Save"
class="btn btn-primary">

Save Doctor

</button>


</form>

</div>

</div>

</div>

</div>



<!-- =========================
     ADD SERVICE MODAL
     ========================= -->

<div class="modal fade"
id="serviceModal">

<div class="modal-dialog">

<div class="modal-content">


<div class="modal-header">

<h5 class="modal-title">
🩺 Add Service
</h5>

<button
type="button"
class="close"
data-dismiss="modal">

&times;

</button>

</div>


<div class="modal-body">


<form
action="admin1.php"
method="post">


<div class="form-group">

<label>Service Name</label>

<input
type="text"
class="form-control"
name="sn"
required>

</div>


<div class="form-group">

<label>Hospital</label>

<input
type="text"
class="form-control"
name="h">

</div>


<div class="form-group">

<label>Department</label>

<input
type="text"
class="form-control"
name="dp">

</div>


<div class="form-group">

<label>Description</label>

<textarea
class="form-control"
name="d"
rows="3"></textarea>

</div>


<div class="form-group">

<label>Availability</label>

<input
type="text"
class="form-control"
name="a">

</div>


<div class="form-group">

<label>Status</label>

<input
type="text"
class="form-control"
name="s">

</div>


<div class="form-group">

<label>Service Image</label>

<input type="file" name="hp1" class="form-control" accept="image/*">
</div>


<button
type="submit"
name="w"
value="Save"
class="btn btn-primary">

Save Service

</button>


</form>

</div>

</div>

</div>

</div>



<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>