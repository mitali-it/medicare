<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

ob_start();
session_start();

$conn = new mysqli("127.0.0.1", "root", "", "hospital");

if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}
?>

<!doctype html>
<html lang="en">

<head>

<meta charset="utf-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1">

<title>MediCare | Hospitals</title>

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

.hero
{
    background:linear-gradient(135deg,#eef6ff,#dbeeff);
    padding:45px 20px;
    text-align:center;
}

.hero h1
{
    font-size:42px;
    font-weight:700;
    color:#0B1F4D;
    margin-bottom:10px;
}

.hero p
{
    font-size:18px;
    color:#555;
}


/* ================= SEARCH ================= */

.search-box
{
    width:450px;
    max-width:90%;
    height:50px;
    border-radius:30px;
    border:1px solid #ddd;
    padding:10px 20px;
    font-size:16px;
    box-shadow:0 4px 15px rgba(0,0,0,0.10);
}

.search-box:focus
{
    outline:none;
    border-color:#0d6efd;
}


/* ================= HOSPITAL SECTION ================= */

.hospital-section
{
    padding:50px 7%;
}

.section-title
{
    font-size:38px;
    font-weight:700;
    color:#0B1F4D;
    margin-bottom:35px;
}


/* ================= CARD ================= */

.hospital-card
{
    border:none;
    border-radius:15px;
    overflow:hidden;
    background:white;
    box-shadow:0 4px 15px rgba(0,0,0,0.08);
    transition:0.3s;
    height:100%;
}

.hospital-card:hover
{
    transform:translateY(-7px);
    box-shadow:0 12px 30px rgba(0,0,0,0.15);
}

.hospital-img
{
    width:100%;
    height:200px;
    object-fit:cover;
}

.card-body
{
    padding:18px;
    min-height:190px;
}

.hospital-name
{
    font-size:22px;
    font-weight:700;
    color:#0B1F4D;
    margin-bottom:10px;
}

.location
{
    color:#666;
    font-size:15px;
}

.hospital-badge
{
    display:inline-block;
    background:#e7f1ff;
    color:#0d6efd;
    padding:6px 14px;
    border-radius:20px;
    font-size:13px;
    font-weight:600;
    margin-top:8px;
}

.rating
{
    color:#f4b400;
    font-size:17px;
    margin:12px 0;
}

.review
{
    color:#777;
    font-size:13px;
}

.details-btn
{
    display:block;
    width:100%;
    background:#0d6efd;
    color:white !important;
    padding:10px;
    text-align:center;
    border-radius:6px;
    text-decoration:none !important;
    margin-top:10px;
}

.details-btn:hover
{
    background:#0B1F4D;
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



</ul>








</div>

</nav>


<!-- ==================================================
                        SEARCH
================================================== -->

<div class="container mt-4 mb-4">

    <div class="d-flex justify-content-between align-items-center">

        <h2 class="section-title mb-0">
            🏥 All Hospitals
        </h2>

        <input
            type="text"
            id="hospitalSearch"
            class="search-box"
            placeholder="🔍 Search Hospital"
            onkeyup="searchHospital()">

    </div>

</div>



<!-- ==================================================
                   HOSPITALS
================================================== -->

<section class="hospital-section">

    <div class="row" id="hospitalList">


<?php

$sql = "SELECT * FROM add_hospital";

$res = $conn->query($sql);

if(!$res)
{
    die("Hospital Table Error: " . $conn->error);
}


if($res->num_rows > 0)
{

    while($rows = mysqli_fetch_array($res))
    {

?>

        <div class="col-lg-4 col-md-6 mb-4 hospital-item">

            <div class="hospital-card">

                <!-- IMAGE -->

                <img
                    src="img/<?php echo htmlspecialchars($rows[14]); ?>"
                    class="hospital-img"
                    alt="Hospital Image">


                <div class="card-body">

                    <!-- NAME -->

                    <h4 class="hospital-name">
                        <?php echo htmlspecialchars($rows[0]); ?>
                    </h4>


                    <p class="location">
                        📍 <?php echo htmlspecialchars($rows[1]); ?>
                    </p>


                    <span class="hospital-badge">
                        Multi-Speciality Hospital
                    </span>


                    <div class="rating">
                        ⭐ 4.8
                        <span class="review">
                            (220 Reviews)
                        </span>
                    </div>


                    <a href="details.php?id=<?php echo urlencode($rows[0]); ?>"
                       class="details-btn">
                        View Details →
                    </a>

                </div>

            </div>

        </div>


<?php

    }

}
else
{

?>

        <div class="col-12 text-center">

            <h4>
                No Hospitals Found
            </h4>

        </div>

<?php

}

?>


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



<!-- ==================================================
                  BOOTSTRAP JS
================================================== -->

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js">
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js">
</script>



<!-- ==================================================
                     AJAX SEARCH
================================================== -->

<script>

function searchHospital()
{
    var search = document.getElementById("hospitalSearch").value;

    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function()
    {
        if(this.readyState == 4 && this.status == 200)
        {
            document.getElementById("hospitalList").innerHTML =
                this.responseText;
        }
    };

    xhttp.open(
        "GET",
        "hospital_search.php?name=" + encodeURIComponent(search),
        true
    );

    xhttp.send();
}

</script>


</body>

</html>