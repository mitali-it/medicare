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

/* ================= CONTACT MESSAGE ================= */
if(isset($_POST["send_message"]))
{
    $conn = new mysqli("localhost","root","","hospital");

    if($conn->connect_error)
    {
        die("Database Connection Failed: " . $conn->connect_error);
    }

    $name = $conn->real_escape_string($_POST["name"]);
    $email = $conn->real_escape_string($_POST["email"]);
    $subject = $conn->real_escape_string($_POST["subject"]);
    $message = $conn->real_escape_string($_POST["message"]);

    $sql = "INSERT INTO contact_messages
            (name,email,subject,message)
            VALUES
            ('$name','$email','$subject','$message')";

    if($conn->query($sql))
    {
        echo "<script>
                alert('Message Sent Successfully!');
              </script>";
    }
    else
    {
        echo "<script>
                alert('Message could not be sent!');
              </script>";
    }

    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>MediCare+ | Home</title>

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

<style>
/* ================= BODY ================= */

body
{
    font-family:'Segoe UI',Arial,sans-serif;
    background:#f8f9fc;
    margin:0;
}

.contact-section {
    padding: 50px 20px;
    background: #f8fbff;
}

.contact-section .section-title {
    text-align: center;
    color: #0B1F4D;
    font-size: 30px;
    font-weight: bold;
    margin-bottom: 30px;
}

.contact-box {
    background: white;
    padding: 30px;
    border-radius: 15px;
    height: 100%;
    box-shadow: 0 5px 18px rgba(11, 31, 77, 0.08);
    border: 1px solid #e4edf7;
}

.contact-box h3 {
    color: #0B1F4D;
    font-weight: bold;
    margin-bottom: 22px;
}

.contact-info {
    margin-bottom: 22px;
}

.contact-info h5 {
    color: #126fc1;
    font-weight: bold;
    margin-bottom: 7px;
}

.contact-info p {
    color: #666;
    margin-bottom: 4px;
}

.contact-box .form-control {
    border-radius: 8px;
    padding: 10px 14px;
}

.contact-box .btn-primary {
    background: #126fc1;
    border: none;
    border-radius: 8px;
    padding: 10px 25px;
}

.contact-box .btn-primary:hover {
    background: #0B1F4D;
}
/* ================= NAVBAR ================= */

.navbar
{
    background:#0B1F4D;
    padding:15px 30px;
    box-shadow:0 2px 10px rgba(0,0,0,0.15);
}

.navbar-brand
{
    color:#fff !important;
    font-size:30px;
    font-weight:700;
}

.navbar-brand span
{
    color:#4da3ff;
}

.nav-link
{
    color:white !important;
    font-size:16px;
    margin-left:12px;
}

.nav-link:hover
{
    color:#ffd700 !important;
}

.navbar-toggler
{
    border:1px solid white;
}

.welcome
{
    color:white;
    font-size:15px;
    margin-left:20px;
}


/* ================= HERO ================= */

.hero{
    min-height:310px;
    background:linear-gradient(100deg,#eef8ff,#dcefff);
    display:flex;
    align-items:center;
    padding:35px 8%;
    position:relative;
    overflow:hidden;
}

.hero-content{
    width:52%;
    z-index:2;
}

.hero h1{
    font-size:38px;
    font-weight:bold;
    color:#101b32;
    margin-bottom:15px;
}

.hero p{
    font-size:15px;
    color:#4d5968;
    margin-bottom:22px;
}

/* ================= ABOUT SECTION ================= */

.about-section{
    padding:45px 7%;
    background:#f6faff;
}

.about-box{
    background:white;
    padding:35px;
    border-radius:12px;
    box-shadow:0 5px 18px rgba(0,0,0,0.07);
}

.about-box h2{
    color:#0B1F4D;
    font-size:28px;
    font-weight:bold;
    margin-bottom:18px;
}

.about-box p{
    color:#666;
    font-size:15px;
    line-height:1.8;
    margin-bottom:12px;
}

.about-card{
    background:white;
    padding:25px;
    text-align:center;
    border-radius:12px;
    box-shadow:0 5px 18px rgba(0,0,0,0.07);
    height:100%;
    transition:.3s;
}

.about-card:hover{
    transform:translateY(-5px);
    box-shadow:0 8px 22px rgba(0,0,0,0.12);
}

.about-icon{
    font-size:42px;
    margin-bottom:12px;
}

.about-card h4{
    color:#0B1F4D;
    font-size:19px;
    font-weight:bold;
    margin-bottom:12px;
}

.about-card p{
    color:#666;
    font-size:14px;
    line-height:1.6;
    margin-bottom:0;
}
/* ================= SEARCH ================= */

.search-box{
    background:white;
    padding:7px;
    border-radius:8px;
    display:flex;
    max-width:550px;
    box-shadow:0 4px 15px rgba(0,0,0,0.08);
}

.search-box input{
    border:none;
    outline:none;
    flex:1;
    padding:10px 14px;
    font-size:14px;
}

.search-btn{
    background:#126fc1;
    color:white;
    border:none;
    border-radius:7px;
    padding:0 28px;
}

/* ================= HERO IMAGE ================= */

.hero-image{
    position:absolute;
    right:6%;
    bottom:0;
    width:330px;
}

/* ================= STATISTICS ================= */

.stats{
    background:white;
    margin:0 7%;
    margin-top:20px;
    border-radius:10px;
    box-shadow:0 3px 15px rgba(0,0,0,0.07);
    padding:18px 10px;
}

.stat-box{
    text-align:center;
    border-right:1px solid #e5e5e5;
}

.stat-box:last-child{
    border-right:none;
}

.stat-icon{
    font-size:25px;
    color:#1689d7;
}

.stat-number{
    font-size:20px;
    font-weight:bold;
    color:#172033;
}

.stat-text{
    font-size:12px;
    color:#777;
}

/* ================= SECTION ================= */

.section{
    padding:35px 7%;
}

.section-title{
    font-size:22px;
    font-weight:bold;
    color:#172033;
}

.view-all{
    float:right;
    color:#126fc1;
    font-size:13px;
}
/* ================= SERVICES SECTION ================= */

.services-section {
    padding: 45px 20px;
    background: #f8fbff;
}

.services-section .section-title {
    text-align: center;
    color: #0B1F4D;
    font-size: 30px;
    font-weight: bold;
    margin-bottom: 30px;
}

.services-section .row {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
}

.service-card {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    margin-bottom: 25px;
    border: 1px solid #e2eaf3;
    box-shadow: 0 5px 18px rgba(11, 31, 77, 0.08);
    transition: 0.3s;
    height: 100%;
}

.service-card:hover {
    transform: translateY(-7px);
    box-shadow: 0 10px 25px rgba(11, 31, 77, 0.15);
}

.service-image {
    width: 100%;
    height: 170px;
    object-fit: cover;
    display: block;
}

.service-icon {
    height: 170px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #eaf4ff;
    font-size: 65px;
}

.service-card .card-body {
    padding: 20px;
    text-align: center;
}

.service-card h5 {
    color: #0B1F4D;
    font-size: 21px;
    font-weight: bold;
    margin-bottom: 12px;
}

.service-card p {
    color: #666;
    font-size: 14px;
    line-height: 1.6;
    margin-bottom: 8px;
}

.service-card strong {
    color: #0B1F4D;
}/* ================= HOSPITAL CARDS ================= */

.hospital-card{
    background:white;
    border:1px solid #e4eaf0;
    border-radius:9px;
    overflow:hidden;
    box-shadow:0 3px 12px rgba(0,0,0,0.06);
    transition:0.3s;
}

.hospital-card:hover{
    transform:translateY(-4px);
    box-shadow:0 7px 20px rgba(0,0,0,0.10);
}

.hospital-card img{
    width:100%;
    height:145px;
    object-fit:cover;
}

.hospital-body{
    padding:13px;
}

.hospital-body h5{
    font-size:15px;
    font-weight:bold;
    margin-bottom:5px;
}

.location{
    color:#777;
    font-size:12px;
}

.rating{
    color:#e7a900;
    font-size:12px;
    margin:7px 0;
}

.details-btn{
    width:100%;
    border:1px solid #1976c9;
    color:#126fc1;
    background:white;
    border-radius:5px;
    padding:7px;
    font-size:12px;
}

.details-btn:hover{
    background:#126fc1;
    color:white;
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

/* SIDEBAR HEADER */

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

/* SIDEBAR BODY */

.profile-side-body{
    padding:20px;
}

/* MENU ITEMS */

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

/* ================= FOOTER ================= */

footer
{
    background:#0B1F4D;
    color:white;
    text-align:center;
    padding:15px;
    margin-top:20px;
}


/* ================= MOBILE ================= */

@media(max-width:991px)
{
    .navbar-nav
    {
        text-align:center;
    }

    .welcome
    {
        display:block;
        text-align:center;
        margin:10px 0;
    }
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
<a class="nav-link active"
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
<a class="nav-link"
   href="doctor.php">
    Doctors
</a>
</li>


<li class="nav-item">
<a class="nav-link" href="#services">
    Services
</a></li>

<li class="nav-item">
<a class="nav-link"
   href="#about">
    About
</a>
</li>

<li class="nav-item">
<a class="nav-link" href="#contact">Contact</a></li>

</ul>



    <?php

if(isset($_SESSION["Full Name"]))
{
?>

            <li class="nav-item">
                <span class="welcome">
                    Welcome:
                    <?php echo htmlspecialchars($_SESSION["Full Name"]); ?>
                </span>
            </li>

<?php
}
?>



<!-- RIGHT SIDE -->

<div class="d-flex align-items-center">

    <span style="color:white;">
        🔔
    </span>

    <a href="#"
       class="profile-icon"
       onclick="openProfile(); return false;">
        👤
    </a>

</div>

</div>

</nav>

<!-- ==================================================
                     PROFILE SIDEBAR
================================================== -->

<div class="profile-overlay"
     id="profileOverlay"
     onclick="closeProfile()">
</div>

<div class="profile-side"
     id="profileSide">

    <!-- HEADER -->

    <div class="profile-side-header">

        <span>
            👤 My Profile
        </span>

        <span class="close-profile"
              onclick="closeProfile()">
            ✕
        </span>

    </div>

    <!-- BODY -->

    <div class="profile-side-body">

<a href="#" class="profile-menu"
   data-toggle="modal"
   data-target="#exampleModal">
    👤 Profile
</a>

<a href="#" class="profile-menu"
   data-toggle="modal"
   data-target="#exampleModal123">
    ✏️ Edit Profile
</a>

<a href="#" class="profile-menu"
   data-toggle="modal"
   data-target="#myappointmentModal">
    📅 My Appointments
</a>

<a href="profile1.php#contact" class="profile-menu">
    📞 Contact
</a>

<hr>

<a href="logout.php" class="profile-menu logout">
    🚪 Logout
</a>

    </div>

</div>

<!-- ==================================================
                         HERO
================================================== -->

<section class="hero">

<div class="hero-content">

<h1>
Find the Best Hospital
<br>
Near You
</h1>

<p>
Book appointments with expert doctors
<br>
and get the best treatment.
</p>

<div class="search-box">
    <input type="text"
           id="searchInput"
           placeholder="Search hospital...">

    <button type="button"
            class="search-btn"
            onclick="searchData()">
        🔍 Search
    </button>
</div>
</div>

<img src="img/h11.jpeg"
     class="hero-image"
     alt="Doctor">

</section>

<!-- ==================================================
                       STATISTICS
================================================== -->

<div class="stats">

<div class="row">

<div class="col-md-3 stat-box">

<div class="stat-icon">
🏥
</div>

<div class="stat-number">
100+
</div>

<div class="stat-text">
Hospitals
</div>

</div>

<div class="col-md-3 stat-box">

<div class="stat-icon">
👨‍⚕️
</div>

<div class="stat-number">
500+
</div>

<div class="stat-text">
Doctors
</div>

</div>

<div class="col-md-3 stat-box">

<div class="stat-icon">
⚕️
</div>

<div class="stat-number">
50+
</div>

<div class="stat-text">
Departments
</div>

</div>

<div class="col-md-3 stat-box">

<div class="stat-icon">
👥
</div>

<div class="stat-number">
10K+
</div>

<div class="stat-text">
Happy Patients
</div>

</div>

</div>

</div>

<!-- ==================================================
                     TOP HOSPITALS
================================================== -->

<section class="section">

<div class="mb-4">

<span class="section-title">
Top Hospitals
</span>

<a href="hos.php"
   class="view-all">
    View All →
</a>

</div>

<div class="row">



<!-- ================= HOSPITAL 1 ================= -->

<div class="col-lg-4 col-md-6 mb-4">

<div class="hospital-card">

<img src="img/md1.jpg">

<div class="hospital-body">

<h5>
Medanta Hospital, Ranchi
</h5>

<div class="location">
📍 Ranchi
</div>

<div class="rating">
⭐ 4.7
<span style="color:#777;">
(320 reviews)
</span>
</div>

<a href="hos.php">
    <button type="button" class="details-btn">
        View Details
    </button>
</a>
</div>

</div>

</div>

<!-- ================= HOSPITAL 2 ================= -->

<div class="col-lg-4 col-md-6 mb-4">

<div class="hospital-card">

<img src="img/o1.jpeg">

<div class="hospital-body">

<h5>
Orchid Medical Centre
</h5>

<div class="location">
📍 Ranchi
</div>

<div class="rating">
⭐ 4.6
<span style="color:#777;">
(260 reviews)
</span>
</div>

<a href="details.php">
    <button type="button" class="details-btn">
        View Details
    </button>
</a>
</div>

</div>

</div>

<!-- ================= HOSPITAL 3 ================= -->

<div class="col-lg-4 col-md-6 mb-4">

<div class="hospital-card">

<img src="img/r1.webp">

<div class="hospital-body">

<h5>
Raj Hospital
</h5>

<div class="location">
📍 Ranchi
</div>

<div class="rating">
⭐ 4.5
<span style="color:#777;">
(210 reviews)
</span>
</div>
<a href="details.php">
    <button type="button" class="details-btn">
        View Details
    </button>
</a>
</div>

</div>

</div>

</div>

</section>
<!-- ================= ABOUT MEDICARE+ ================= -->

<section class="about-section" id="about">
    <div class="container">

        <div class="about-box">

            <h2>About MediCare+</h2>

            <p>
                MediCare+ is a simple and user-friendly healthcare
                platform designed to make healthcare services easier
                and more convenient for everyone.
            </p>

            <p>
                Through our platform, users can explore hospitals,
                find doctors, view healthcare services and book
                appointments easily.
            </p>

            <p>
                Our goal is to connect patients with reliable
                healthcare services and make the process of finding
                medical care simple and convenient.
            </p>

        </div>

        <div class="row mt-4">

            <div class="col-md-4 mb-4">
                <div class="about-card">

                    <div class="about-icon">🏥</div>

                    <h4>Trusted Hospitals</h4>

                    <p>
                        Find information about hospitals and
                        healthcare facilities easily.
                    </p>

                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="about-card">

                    <div class="about-icon">👨‍⚕️</div>

                    <h4>Expert Doctors</h4>

                    <p>
                        Explore doctors and choose the right
                        healthcare professional for your needs.
                    </p>

                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="about-card">

                    <div class="about-icon">📅</div>

                    <h4>Easy Appointment</h4>

                    <p>
                        Book your doctor appointment quickly
                        and conveniently.
                    </p>

                </div>
            </div>

        </div>

    </div>

</section>


<!-- ================= SERVICES SECTION ================= -->

<section class="services-section" id="services">

    <div class="section-title">

        <h2>Our Healthcare Services</h2>

      
    </div>

    <div class="container">

        <div class="row">

            <?php

            $serviceConn = new mysqli(
                "localhost",
                "root",
                "",
                "hospital"
            );

            if ($serviceConn->connect_error) {
                die("Database Connection Failed");
            }

            $serviceResult = $serviceConn->query(
                "SELECT * FROM add_service ORDER BY sn ASC"
            );

            $shownServices = array();

            if ($serviceResult && mysqli_num_rows($serviceResult) > 0) {

                while ($serviceRow = mysqli_fetch_assoc($serviceResult)) {

                    $serviceName = strtolower(
                        trim($serviceRow['sn'])
                    );

                    if (in_array($serviceName, $shownServices)) {
                        continue;
                    }

                    $shownServices[] = $serviceName;

            ?>

            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="service-card">

                    <?php if (!empty($serviceRow['hp1'])) { ?>

                        <img
                            src="img/<?php echo htmlspecialchars(
                                $serviceRow['hp1'],
                                ENT_QUOTES
                            ); ?>"
                            alt="<?php echo htmlspecialchars(
                                $serviceRow['sn'],
                                ENT_QUOTES
                            ); ?>"
                            class="service-image"
                            onerror="this.style.display='none';"
                        >

                    <?php } else { ?>

                        <div class="service-icon">
                            🩺
                        </div>

                    <?php } ?>

                    <h4>
                        <?php echo htmlspecialchars(
                            $serviceRow['sn']
                        ); ?>
                    </h4>

                    <?php if (!empty($serviceRow['d'])) { ?>

                        <p>
                            <?php echo htmlspecialchars(
                                $serviceRow['d']
                            ); ?>
                        </p>

                    <?php } ?>

                    <?php if (!empty($serviceRow['h'])) { ?>

                                           <?php } ?>

                    <?php if (!empty($serviceRow['dp'])) { ?>

                    <?php } ?>

                    <?php if (!empty($serviceRow['a'])) { ?>

                    <?php } ?>

                    <?php if (!empty($serviceRow['s'])) { ?>

                    
                    <?php } ?>

                </div>

            </div>

            <?php

                }

            } else {

            ?>

                <div class="col-12">

                    <div class="alert alert-info text-center">
                        No services available currently.
                    </div>

                </div>

            <?php } ?>

        </div>

    </div>

</section>
<!-- ================= CONTACT SECTION ================= -->

<section id="contact" class="contact-section">


<div class="container">


<div class="row">


<!-- ================= CONTACT INFO ================= -->

<div class="col-md-5">


<div class="contact-box">


<h3>
    Get In Touch
</h3>


<div class="contact-info">

<h5>
    📍 Address
</h5>

<p>
    Ranchi, Jharkhand, India
</p>

</div>


<div class="contact-info">

<h5>
    📞 Phone
</h5>

<p>
    +91 98765 43210
</p>

</div>


<div class="contact-info">

<h5>
    📧 Email
</h5>

<p>
    medicare@example.com
</p>

</div>


<div class="contact-info">

<h5>
    🕐 Working Hours
</h5>

<p>
    Monday - Saturday
</p>

<p>
    9:00 AM - 6:00 PM
</p>

</div>


</div>

</div>



<!-- ================= CONTACT FORM ================= -->

<div class="col-md-7">


<div class="contact-box">


<h3>
    Send Us a Message
</h3>


<form method="POST"
      action="profile1.php">


<div class="form-group">

<label>
    Full Name
</label>

<input type="text"
       name="name"
       class="form-control"
       placeholder="Enter your name"
       required>

</div>


<div class="form-group">

<label>
    Email
</label>

<input type="email"
       name="email"
       class="form-control"
       placeholder="Enter your email"
       required>

</div>


<div class="form-group">

<label>
    Subject
</label>

<input type="text"
       name="subject"
       class="form-control"
       placeholder="Enter subject"
       required>

</div>


<div class="form-group">

<label>
    Message
</label>

<textarea name="message"
          class="form-control"
          rows="5"
          placeholder="Write your message"
          required></textarea>

</div>


<button type="submit"
        name="send_message"
        class="btn btn-primary">

    Send Message

</button>


</form>


</div>

</div>


</div>

</div>

</section>
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

<!-- ================= PROFILE MODAL ================= -->

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Profile</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">

<?php
$conn=new mysqli("127.0.0.1","root","","hospital");
$u1=$_SESSION["Full Name"];
$p1=$_SESSION["Password"];
$str="select * from patient_info where fname='$u1' and pass='$p1'";
$res=$conn->query($str);

if(($rows=mysqli_fetch_array($res)))
{
?>

<div class="card" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">FullName:<?php echo$rows[2]; ?></h5>
    <h6 class="card-subtitle mb-2 text-muted">Email:<?php echo$rows[0]; ?></h6>
    <p class="card-text">Password:<?php echo$rows[1]; ?></p>
    <p class="card-text">Date of Birth:<?php echo$rows[4]; ?></p>
    <p class="card-text">Mobile No:<?php echo$rows[3]; ?></p>
    <p class="card-text">Gender:<?php echo$rows[5]; ?></p>
  </div>
</div>

<?php
}
?>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
            Close
        </button>
      </div>

    </div>
  </div>
</div>

<!-- ================= EDIT PROFILE MODAL ================= -->

<div class="modal fade" id="exampleModal123" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title" id="exampleModalLabel">
            Edit
        </h5>

        <button type="button"
                class="close"
                data-dismiss="modal"
                aria-label="Close">

          <span aria-hidden="true">&times;</span>

        </button>

      </div>

      <div class="modal-body">

        <form action="profile1.php">

<?php
$conn=new mysqli("127.0.0.1","root","","hospital");
$u1=$_SESSION["Full Name"];
$p1=$_SESSION["Password"];
$str="select * from patient_info where fname='$u1' and pass='$p1'";
$res=$conn->query($str);

if(($rows=mysqli_fetch_array($res)))
{
?>

  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email"
           name="e"
           value=<?php echo$rows[0]; ?>
           class="form-control"
           id="exampleInputEmail1"
           aria-describedby="emailHelp">
    <small id="emailHelp" class="form-text text-muted">
        We'll never share your email with anyone else.
    </small>
  </div>

  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="text"
           name="p"
           value=<?php echo$rows[1]; ?>
           class="form-control"
           id="exampleInputPassword1">
  </div>

  <div class="form-group">
    <label for="exampleInputPassword1">Full Name</label>
    <input type="text"
           name="fn"
           value=<?php echo$rows[2]; ?>
           class="form-control"
           id="exampleInputPassword1">
  </div>

  <div class="form-group">
    <label for="exampleInputPassword1">Mobile No</label>
    <input type="text"
           name="mb"
           value=<?php echo$rows[3]; ?>
           class="form-control"
           id="exampleInputPassword1">
  </div>

  <div class="form-group">
    <label for="exampleInputPassword1">Date of birth</label>
    <input type="text"
           name="dob"
           value=<?php echo$rows[4]; ?>
           class="form-control"
           id="exampleInputPassword1">
  </div>

  <div class="form-group">
    <label for="exampleInputPassword1">Gender</label>
    <input type="text"
           name="g"
           value=<?php echo$rows[5]; ?>
           class="form-control"
           id="exampleInputPassword1">
  </div>

  <div class="form-group form-check">
    <input type="checkbox"
           class="form-check-input"
           id="exampleCheck1">

    <label class="form-check-label"
           for="exampleCheck1">
        Check me out
    </label>
  </div>

  <input type="submit"
         class="btn btn-primary"
         value="Edit"
         name="ep">

</form>

<?php
}
?>

      </div>

      <div class="modal-footer">

        <button type="button"
                class="btn btn-secondary"
                data-dismiss="modal">
            Close
        </button>

        <button type="button"
                class="btn btn-primary">
            Save changes
        </button>

      </div>

    </div>

  </div>

</div>

<?php
if(isset($_REQUEST["ep"]))
{
    $conn=new mysqli("127.0.0.1","root","","hospital");

    $pp=$_SESSION["Password"];
    $p1=$_REQUEST["e"];
    $p2=$_REQUEST["p"];
    $p3=$_REQUEST["fn"];
    $p4=$_REQUEST["mb"];
    $p5=$_REQUEST["dob"];
    $p6=$_REQUEST["g"];

    $str="update patient_info set email='$p1', pass='$p2',fname='$p3',mobile='$p4',dob='$p5',g='$p6' where pass='$pp'";
    $res=$conn->query($str);
?>

<script>
alert("Profile Updated !!!")
</script>

<?php
}
?>

<!-- ================= MY APPOINTMENTS MODAL ================= -->

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
$password = $_SESSION["Password"];

$userResult = $conn->query(
    "SELECT mobile FROM patient_info
     WHERE fname='$name' AND pass='$password'"
);

$userRow = mysqli_fetch_assoc($userResult);

$mobile = $userRow['mobile'] ?? "";

$sql = "SELECT * FROM appointment
        WHERE m='$mobile'";

$res = $conn->query($sql);

if($res && mysqli_num_rows($res) > 0)
{

    while($rows = mysqli_fetch_array($res))
    {

?>

<div class="card mb-3">

    <div class="card-body">

        <h5>
            🏥 <?php echo $rows[4]; ?>
        </h5>

        <p>
            👨‍⚕️ <b>Doctor:</b>
            <?php echo $rows[5]; ?>
        </p>

        <p>
            📅 <b>Date:</b>
            <?php echo $rows[7]; ?>
        </p>

        <p>
            ⏰ <b>Time:</b>
            <?php echo $rows[8]; ?>
        </p>

        <p>
            🩺 <b>Symptoms:</b>
            <?php echo $rows[9]; ?>
        </p>
<p>
    📌 <b>Status:</b>

    <?php
    $status = $rows[10] ?? "Pending";

if($status == "Approved")
{
    echo '<span class="text-success font-weight-bold">Approved</span>';
}
elseif($status == "Rejected")
{
    echo '<span class="text-danger font-weight-bold">Rejected</span>';
}
else
{
    echo '<span class="text-warning font-weight-bold">Pending</span>';
}
    ?>
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
                       JAVASCRIPT
================================================== -->

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

<script>
function searchData() {

    let input = document.getElementById("searchInput")
                       .value
                       .trim()
                       .toLowerCase();

    let cards = document.querySelectorAll(".hospital-card");

    let found = false;

    cards.forEach(function(card) {

        let cardText = card.innerText.toLowerCase();

        if (input === "" || cardText.includes(input)) {
            card.parentElement.style.display = "";
            found = true;
        } else {
            card.parentElement.style.display = "none";
        }

    });

    let oldMessage = document.getElementById("noResultMessage");

    if (oldMessage) {
        oldMessage.remove();
    }

    if (!found && input !== "") {

        let message = document.createElement("div");

        message.id = "noResultMessage";
        message.className = "col-12 text-center mt-3";

        message.innerHTML = `
            <div class="alert alert-warning">
                No hospital found for "<b>${input}</b>"
            </div>
        `;

        document.querySelector(".section .row").appendChild(message);
    }
}

document.getElementById("searchInput").addEventListener("keyup", function(event) {

    if (event.key === "Enter") {
        searchData();
    }

    if (this.value.trim() === "") {
        searchData();
    }

});
</script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>



