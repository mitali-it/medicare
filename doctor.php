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


/* ================= BOOK APPOINTMENT ================= */

if(isset($_POST["z"]))
{
    $n  = $_POST["n"];
    $an = $_POST["an"];
    $m  = $_POST["m"];
    $e  = $_POST["e"];
    $hn = $_POST["hn"];
    $dn = $_POST["dn"];
    $ad = $_POST["ad"];
    $at = $_POST["at"];
    $s  = $_POST["s"];

    $sql = "INSERT INTO appointment
            (n,an,m,e,hn,dn,ad,at,s)
            VALUES
            ('$n','$an','$m','$e','$hn','$dn','$ad','$at','$s')";

    if($conn->query($sql))
    {
        echo "<script>
                alert('Appointment Booked Successfully!');
              </script>";
    }
    else
    {
        echo "<script>
                alert('Error: ".$conn->error."');
              </script>";
    }
}


/* ================= DOCTORS ================= */

$result = $conn->query("SELECT * FROM add_doctor");

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>MediCare+ | Doctors</title>


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

.navbar-brand span{
    color:#4da3ff;
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


/* ================= PAGE HEADING ================= */

.heading{
    text-align:center;
    padding:35px 20px 20px;
    color:#0B1F4D;
}

.heading h1{
    font-size:32px;
    font-weight:bold;
    margin-bottom:8px;
}

.heading p{
    color:#777;
    font-size:14px;
}


/* ================= DOCTOR CARDS ================= */

.doctor-container{
    display:flex;
    flex-wrap:wrap;
    justify-content:center;
    gap:25px;
    padding:20px 7% 45px;
}

.doctor-card{
    width:290px;
    background:white;
    border-radius:12px;
    padding:20px;
    text-align:center;
    box-shadow:0 4px 12px rgba(0,0,0,0.12);
    transition:.3s;
}

.doctor-card:hover{
    transform:translateY(-5px);
    box-shadow:0 7px 20px rgba(0,0,0,0.15);
}

.doctor-card img{
    width:150px;
    height:150px;
    object-fit:cover;
    border-radius:50%;
    margin-bottom:15px;
    border:4px solid #eef6ff;
}

.doctor-card h3{
    color:#0B1F4D;
    margin:8px;
    font-size:20px;
}

.doctor-card p{
    margin:7px;
    color:#555;
    font-size:14px;
}

.book-btn{
    width:100%;
    margin-top:12px;
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


/* HEADER */

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


/* BODY */

.profile-side-body{
    padding:20px;
}


/* MENU */

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


/* LOGOUT */

.logout{
    color:#dc3545 !important;
}


/* OVERLAY */

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
    margin-top:20px;
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

<a class="nav-link"
   href="hos.php">

    Hospitals

</a>

</li>


<li class="nav-item">

<a class="nav-link active"
   href="doctor.php">

    Doctors

</a>

</li>






</ul>




</div>

</nav>



<!-- ==================================================
                       PAGE HEADING
================================================== -->

<div class="heading">

    <h1>Our Doctors</h1>

    <p>
        Meet our experienced doctors and book your appointment
    </p>

</div>



<!-- ==================================================
                     DOCTOR CARDS
================================================== -->

<div class="doctor-container">


<?php

while($row = $result->fetch_assoc())
{

?>


<div class="doctor-card">


<!-- DOCTOR IMAGE -->

<img src="img/<?php echo htmlspecialchars($row['hp1']); ?>"
     alt="Doctor"
     class="doctor-img">

<!-- DOCTOR NAME -->

<h3>

<?php
echo htmlspecialchars($row['dn']);
?>

</h3>


<p>

<b>Specialization:</b>

<?php
echo htmlspecialchars($row['sp']);
?>

</p>


<p>

<b>Department:</b>

<?php
echo htmlspecialchars($row['dpn']);
?>

</p>


<p>

<b>Qualification:</b>

<?php
echo htmlspecialchars($row['q']);
?>

</p>


<p>

<b>Experience:</b>

<?php
echo htmlspecialchars($row['ex']);
?>

Years

</p>


<p>

<b>Hospital:</b>

<?php
echo htmlspecialchars($row['hn']);
?>

</p>



<!-- BOOK APPOINTMENT -->

<button type="button"
        class="btn btn-primary book-btn"
        data-toggle="modal"
        data-target="#appointmentModal"
        data-doctor="<?php echo htmlspecialchars($row['dn']); ?>"
        data-hospital="<?php echo htmlspecialchars($row['hn']); ?>"
        data-department="<?php echo htmlspecialchars($row['dpn']); ?>">

    📅 Book Appointment

</button>

</div>


<?php

}

?>


</div>



<!-- ==================================================
                  APPOINTMENT MODAL
================================================== -->

<div class="modal fade"
     id="appointmentModal"
     tabindex="-1"
     role="dialog">


<div class="modal-dialog modal-lg"
     role="document">


<div class="modal-content">


<div class="modal-header">

<h5 class="modal-title">

    📅 Book Appointment

</h5>


<button type="button"
        class="close"
        data-dismiss="modal">

    <span>&times;</span>

</button>

</div>



<div class="modal-body">


<form action="Doctor.php"
      method="post">


<div class="form-row">


<!-- PATIENT NAME -->

<div class="form-group col-md-6">

<label>
Patient Name
</label>

<input type="text"
       name="n"
       class="form-control"
       required>

</div>



<!-- AADHAR -->

<div class="form-group col-md-6">

<label>
Aadhar Number
</label>

<input type="text"
       name="an"
       class="form-control"
       required>

</div>



<!-- MOBILE -->

<div class="form-group col-md-6">

<label>
Mobile Number
</label>

<input type="text"
       name="m"
       class="form-control"
       required>

</div>



<!-- EMAIL -->

<div class="form-group col-md-6">

<label>
Email
</label>

<input type="email"
       name="e"
       class="form-control"
       required>

</div>



<!-- HOSPITAL -->

<div class="form-group col-md-6">

<label>
Hospital
</label>

<input type="text"
       name="hn"
       id="hospitalName"
       class="form-control"
       readonly
       required>

</div>



<!-- DOCTOR -->

<div class="form-group col-md-6">

<label>
Doctor
</label>

<input type="text"
       name="dn"
       id="doctorName"
       class="form-control"
       readonly
       required>

</div>


<!-- DEPARTMENT --><div class="form-group col-md-6"><label>
Department
</label><input type="text"
name="dpn"
id="departmentName"
class="form-control"
readonly
required>

</div>

<!-- DATE -->

<div class="form-group col-md-6">

<label>
Appointment Date
</label>

<input type="date"
       name="ad"
       class="form-control"
       required>

</div>



<!-- TIME -->

<div class="form-group col-md-6">

<label>
Appointment Time
</label>

<input type="time"
       name="at"
       class="form-control"
       required>

</div>



<!-- SYMPTOMS -->

<div class="form-group col-md-12">

<label>
Symptoms
</label>

<textarea name="s"
          class="form-control"
          rows="3"
          placeholder="Enter your symptoms"
          required></textarea>

</div>


</div>



<button type="submit"
        name="z"
        class="btn btn-primary btn-block">

    📅 Book Appointment

</button>


</form>


</div>

</div>

</div>

</div>







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

<!-- Bootstrap JS -->

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- ==================================================
                     JAVASCRIPT
================================================== --><script>

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


/* ================= DOCTOR + HOSPITAL + DEPARTMENT ================= */

$('#appointmentModal').on('show.bs.modal', function(event)
{

    var button = $(event.relatedTarget);

    var doctor = button.data('doctor');

    var hospital = button.data('hospital');

    var department = button.data('department');


    $('#doctorName').val(doctor);

    $('#hospitalName').val(hospital);

    $('#departmentName').val(department);

});

</script>


</body>

</html>