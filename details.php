<?php
session_start();

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

if(!isset($_SESSION["Full Name"]))
{
    header("Location: index.php");
    exit();
}


/* ================= DATABASE ================= */

$conn = new mysqli("127.0.0.1","root","","hospital");

if($conn->connect_error)
{
    die("Database Connection Error: ".$conn->connect_error);
}


/* ================= HOSPITAL ================= */

$str = $_REQUEST["id"];

$res = $conn->query(
    "SELECT * FROM add_hospital WHERE hn='$str'"
);

$hospital = mysqli_fetch_row($res);

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>MediCare+ | Hospital Details</title>


<!-- Bootstrap -->

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">


<style>

/* ================= BODY ================= */

body{
    margin:0;
    font-family:Arial,sans-serif;
    background:#f6faff;
    color:#172033;
}


/* ================= NAVBAR ================= */

.navbar{
    background:#0B1F4D;
    padding:15px 25px;
    box-shadow:0 2px 10px rgba(0,0,0,0.1);
}

.navbar-brand{
    color:#fff !important;
    font-size:30px;
    font-weight:700;
}

.nav-link{
    color:#fff !important;
    font-size:17px;
    margin-left:15px;
    transition:.3s;
}

.nav-link:hover{
    color:#ffd700 !important;
}


/* ================= PROFILE ICON ================= */

.profile-icon{
    width:38px;
    height:38px;
    border-radius:50%;
    background:#e5f4ff;
    display:flex;
    align-items:center;
    justify-content:center;
    margin-left:15px;
    text-decoration:none;
    cursor:pointer;
}

.profile-icon:hover{
    text-decoration:none;
    background:white;
}


/* ================= HOSPITAL DETAILS ================= */

.hospital-details{
    padding:45px 7%;
}

.hospital-image{
    width:100%;
    height:430px;
    object-fit:cover;
    border-radius:12px;
    box-shadow:0 4px 12px rgba(0,0,0,.15);
}

.hospital-info{
    background:white;
    padding:25px;
    border-radius:12px;
    box-shadow:0 4px 12px rgba(0,0,0,.10);
    height:100%;
}

.hospital-info h1{
    color:#0B1F4D;
    font-size:30px;
    font-weight:bold;
}

.hospital-info p{
    color:#555;
    font-size:15px;
    line-height:1.6;
}


/* ================= SECTION HEADING ================= */

.section-title{
    text-align:center;
    color:#0B1F4D;
    font-size:28px;
    font-weight:bold;
    margin:45px 0 25px;
}


/* ================= DOCTOR CARDS ================= */

.doctor-card{
    background:white;
    border-radius:12px;
    padding:20px;
    text-align:center;
    box-shadow:0 4px 12px rgba(0,0,0,0.12);
    height:100%;
    transition:.3s;
}

.doctor-card:hover{
    transform:translateY(-5px);
    box-shadow:0 7px 20px rgba(0,0,0,0.15);
}

.doctor-card img{
    width:140px;
    height:140px;
    object-fit:cover;
    border-radius:50%;
    margin-bottom:15px;
    border:4px solid #eef6ff;
}

.doctor-card h4{
    color:#0B1F4D;
    font-size:20px;
}

.doctor-card p{
    margin:6px;
    color:#555;
    font-size:14px;
}



/* ==================================================
                  PROFILE SIDE BAR
================================================== */

.profile-side{
    position:fixed;
    top:0;
    right:-360px;
    width:350px;
    max-width:90%;
    height:100vh;
    background:white;
    z-index:9999;
    box-shadow:-5px 0 20px rgba(0,0,0,.20);
    transition:.3s ease;
}

.profile-side.active{
    right:0;
}

.profile-side-header{
    background:#0B1F4D;
    color:white;
    padding:20px;
    font-size:20px;
    font-weight:bold;
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.close-profile{
    cursor:pointer;
    font-size:22px;
}

.profile-side-body{
    padding:20px;
}

.profile-menu{
    display:block;
    padding:15px;
    margin-bottom:10px;
    border-radius:8px;
    color:#172033;
    font-size:17px;
    font-weight:600;
    text-decoration:none;
    transition:.2s;
}

.profile-menu:hover{
    background:#eef6ff;
    color:#126fc1;
    text-decoration:none;
}

.logout{
    color:#dc3545 !important;
}

.profile-overlay{
    display:none;
    position:fixed;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background:rgba(0,0,0,.4);
    z-index:9998;
}

.profile-overlay.active{
    display:block;
}


/* ================= FOOTER ================= */

footer{
    background:#0B1F4D;
    color:white;
    text-align:center;
    padding:20px;
    margin-top:50px;
}

</style>

</head>


<body>


<!-- ==================================================
                         NAVBAR
================================================== -->

<nav class="navbar navbar-expand-lg">

<a class="navbar-brand" href="profile1.php">

    ✚ <span style="color:white;">Medi</span><span style="color:#4da3ff;">Care+</span>

</a>


<button class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#mainNav">
</button>


<div class="collapse navbar-collapse"
     id="mainNav">


<ul class="navbar-nav mx-auto">


<li class="nav-item">

<a class="nav-link"
   href="profile1.php">

Home

</a>

</li>


<li class="nav-item">

<a class="nav-link active"
   href="hos.php">

Hospitals

</a>

</li>


<li class="nav-item">

<a class="nav-link"
   href="doctor.php">

Doctors

</a>

</li>



</ul>




</div>

</nav>




<!-- ==================================================
                  HOSPITAL DETAILS
================================================== -->

<?php
if($hospital)
{
?>


<div class="hospital-details">

<div class="row">


<!-- IMAGE -->

<div class="col-md-7">

<img src="img/<?php echo htmlspecialchars($hospital[14]); ?>"
     class="hospital-image"
     alt="Hospital">

</div>



<!-- HOSPITAL INFORMATION -->

<div class="col-md-5">

<div class="hospital-info">


<h1>

<?php
echo htmlspecialchars($hospital[0]);
?>

</h1>


<p>
📍
<?php echo htmlspecialchars($hospital[1]); ?>
</p>


<p>
<?php echo htmlspecialchars($hospital[4]); ?>,
<?php echo htmlspecialchars($hospital[5]); ?>,
<?php echo htmlspecialchars($hospital[6]); ?>
</p>


<p>
⭐ 4.8 (120 Reviews)
</p>


<hr>


<!-- ABOUT HOSPITAL -->

<h4 style="color:#0B1F4D;">
About Hospital
</h4>


<p>

<?php
echo htmlspecialchars($hospital[3]);
?>

</p>


<p>

<?php
echo htmlspecialchars($hospital[7]);
?>

</p>


</div>

</div>

</div>

</div>



<!-- ================= DEPARTMENTS ================= -->

<div class="container mt-5">

    <h3 class="mb-4">Departments</h3>

    <?php
    $deptResult = $conn->query("SELECT DISTINCT dpn FROM add_doctor WHERE hn='$str'");

    if($deptResult && $deptResult->num_rows > 0)
    {
        while($dept = mysqli_fetch_array($deptResult))
        {
    ?>
        <span class="badge badge-primary p-2 mr-2 mb-2">
            <?php echo htmlspecialchars($dept['dpn']); ?>
        </span>
    <?php
        }
    }
    else
    {
        echo "<p>No departments available.</p>";
    }
    ?>


<!-- ================= OUR DOCTORS ================= -->

<h3 class="mt-5 mb-4">Our Doctors</h3>

<div class="row">

<?php
$doctorResult = $conn->query(
    "SELECT * FROM add_doctor WHERE hn='$str'"
);

if($doctorResult && $doctorResult->num_rows > 0)
{
    while($doctor = mysqli_fetch_array($doctorResult))
    {
?>

    <div class="col-md-4 mb-4">

        <div class="card shadow h-100">

            <img src="img/<?php echo htmlspecialchars($doctor['hp1']); ?>"
                 class="card-img-top"
                 style="height:220px; object-fit:cover;"
                 alt="Doctor">

            <div class="card-body">

                <h5 class="card-title">
                    <?php echo htmlspecialchars($doctor['dn']); ?>
                </h5>

                <p class="mb-1">
                    <b>Department:</b>
                    <?php echo htmlspecialchars($doctor['dpn']); ?>
                </p>

                <p class="mb-1">
                    <b>Specialization:</b>
                    <?php echo htmlspecialchars($doctor['sp']); ?>
                </p>

                <p class="mb-1">
                    <b>Qualification:</b>
                    <?php echo htmlspecialchars($doctor['q']); ?>
                </p>

                <p class="mb-1">
                    <b>Experience:</b>
                    <?php echo htmlspecialchars($doctor['ex']); ?>
                </p>

            </div>

        </div>

    </div>

<?php
    }
}
else
{
?>

    <div class="col-12">
        <p>No doctors available for this hospital.</p>
    </div>

<?php
}
?>

</div>

</div>


<?php
}
else
{
?>

<div class="container text-center mt-5">

    <h3>
        Hospital not found.
    </h3>

</div>

<?php
}
?>
<!-- ==================================================
              MY APPOINTMENTS MODAL
================================================== -->

<div class="modal fade"
     id="myappointmentModal"
     tabindex="-1">


<div class="modal-dialog modal-lg">


<div class="modal-content">


<div class="modal-header">

<h5 class="modal-title">

    📅 My Appointments

</h5>


<button type="button"
        class="close"
        data-dismiss="modal">

    <span>&times;</span>

</button>

</div>



<div class="modal-body">


<?php

$conn = new mysqli("127.0.0.1","root","","hospital");

$name = $_SESSION["Full Name"];

$sql = "SELECT * FROM appointment
        WHERE n='$name'";

$res = $conn->query($sql);


if($res && mysqli_num_rows($res) > 0)
{

while($rows = mysqli_fetch_array($res))
{

?>


<div class="card mb-3">

<div class="card-body">


<h5>

🏥 <?php echo htmlspecialchars($rows[4]); ?>

</h5>


<p>

👨‍⚕️ <b>Doctor:</b>

<?php echo htmlspecialchars($rows[5]); ?>

</p>


<p>

📅 <b>Date:</b>

<?php echo htmlspecialchars($rows[6]); ?>

</p>


<p>

⏰ <b>Time:</b>

<?php echo htmlspecialchars($rows[7]); ?>

</p>


<p>

🩺 <b>Symptoms:</b>

<?php echo htmlspecialchars($rows[8]); ?>

</p>


</div>

</div>


<?php

}

}
else
{

echo "<p class='text-center'>
        No appointment booked yet.
      </p>";

}

?>


</div>



<div class="modal-footer">

<button type="button"
        class="btn btn-secondary"
        data-dismiss="modal">

    Close

</button>

</div>


</div>

</div>

</div>




<!-- ==================================================
                         FOOTER
================================================== -->

<footer>

<strong>
✚ MediCare+
</strong>

<p class="mb-0 mt-2">
Your Health, Our Priority
</p>

</footer>



<!-- ================= JAVASCRIPT ================= -->

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>


<script>

function openProfile()
{
    document.getElementById("profileSide")
            .classList.add("active");

    document.getElementById("profileOverlay")
            .classList.add("active");
}


function closeProfile()
{
    document.getElementById("profileSide")
            .classList.remove("active");

    document.getElementById("profileOverlay")
            .classList.remove("active");
}

</script>


</body>

</html>