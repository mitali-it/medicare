<?php ob_start(); ?>
<?php session_start(); ?>
<style>
body
{
font-family:Arial;
}
.navbar
{
background: #0B1F4D;
padding:15px 40px;
}
.navbar-brand
{
color:white!important;
font-size:32px;
font-weight:bold;
}
.nav-link
{
color:white!important;
font-size:18px;
margin-left:15px;
}
.nav-link:hover
{
color:yellow!important;
}
.search-box
{
width:230px;
border-radius:30px;
padding:8px 25px;
margin-left:10px;
}
.btn1
{
padding:15px 35px;
border-radius:40px;
font-size:20px;
margin-right:15px;
}
.btn2
{
padding:15px 35px;
border-radius:40px;
font-size:20px;
background:white;
border:2px solid #0d6efd;
}

.
.btn1
{
padding:14px 35px;
border-radius:40px;
font-size:18px;
margin-right:15px;
}
.btn2
{
padding:14px 35px;
border-radius:40px;
font-size:18px;
background:#fff;
border:2px solid #0d6efd;
color:#0d6efd;
}
.btn2:hover
{
background:#0d6efd;
color:#fff;
}
.hero{
    height:100vh;
    background-image:url("img/in.png");
    background-size:cover;
    background-position:center;
    background-repeat:no-repeat;
    position:relative;
}
.hero h5{
    color:#0d6efd;
    font-size:28px;
    font-weight:600;
}

.hero h1{
    font-size:45px;
    font-weight:bold;
    color:black;
}

.hero h3{
    font-size:28px;
    color:#333;
    margin-top:15px;
}

.hero-content{
    position:absolute;
    top:50%;
    left:8%;
    transform:translateY(-50%);
    max-width:550px;
}
.hero p{
    font-size:18px;
    color:black;
    margin-top:20px;
}

.hero img{
    width:100%;
    height:550px;
    object-fit:cover;
    border-radius:20px;
    box-shadow:0 10px 25px rgba(0,0,0,.2);
}

.btn1{
    padding:12px 35px;
    border-radius:30px;
}

.btn2{
    padding:12px 35px;
    border-radius:30px;
}
.overlay{
    position:absolute;
    top:50%;
    left:80px;
    transform:translateY(-50%);
    z-index:2;
    color:white;
}
.overlay h1{
    font-size:75px;
    font-weight:bold;
}.overlay h4{
    font-size:35px;
}
.overlay p{
    font-size:22px;
}
</style>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  
  </head>
  <body>

<nav class="navbar navbar-expand-lg navbar-dark">

 <a class="navbar-brand" href="#">🏥MediCare </a>
  <button class="navbar-toggler" type="button"  data-toggle="collapse"  data-target="#menu">  
     <span class="navbar-text font-weight-bold">

  </span>

   </button>




</nav>

<section class="hero">
<div class="container">
<div class="row align-items-center">
<div class="col-md-6">
<br>
<h1>
Welcome to
<br>
<span style="color:darkblue;font-size:100px;">MediCare+</span>
Your Health, Our Priority
</h1>
<p class="mt-4">
Book appointments with the best hospitals
and experienced doctors.
</p>

<br>

<a href="#" class="btn btn-primary btn-lg btn1"
data-toggle="modal" 
     data-target="#loginModal">
Login 
</a>

<a href="#" class="btn btn-primary btn-lg btn1"
data-toggle="modal" 
     data-target="#registerModal">
Register
</a>

</div>

<div class ="col-md-6 text-center">
</div>
</div>
</div>

</section>



    </nav>


<div class="modal fade" id="registerModal" tabindex="-1" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"> Register</h5>
 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p><form>

  <div class="form-group">
    <label for="inputFullname">Full Name</label>
    <input type="text"name="f" class="form-control" id="inputFullname" placeholder="Fullname">
  </div>


  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Email</label>
      <input type="email" name="e" class="form-control" id="inputEmail4" placeholder="Email">
    </div>


   <div class="form-row">
    <div class="form-group col-md-12">
      <label for="inputMobileNo">Mobile Number</label>
      <input type="text" name="m" class="form-control" id="inputMbileNo">
    </div>
 </div>


<div class="form-group">
    <label>Gender</label><br>

    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="g" id="male" value="Male">
        <label class="form-check-label" for="male">Male</label>
    </div>

    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="g" id="female" value="Female">
        <label class="form-check-label" for="female">Female</label>
    </div>

    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="g" id="other" value="Other">
        <label class="form-check-label"  for="other">Other</label>
    </div>
</div>

<div class="form-group">
    <label for="dob">Date of Birth</label>
    <input type="date" class="form-control" id="dob" name="dob">
</div>

  <div class="form-group col-md-6">
      <label for="inputPassword4">Password</label>
      <input type="password" name="p" class="form-control" id="inputPassword4" placeholder="Password">
    </div>
  </div>

    <div class="form-group">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="gridCheck">
      <label class="form-check-label" for="gridCheck">
        Check me out
      </label>
    </div>
  </div>
  <input type="submit" class="btn btn-primary" value="Register" name="x">
</form></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="loginModal" tabindex="-1" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Login</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
  <form action="index.php">
  <div class="form-row">
    <div class="form-group col-md-10">
      <label for="inputEmail4">fullname</label>
      <input type="text" name="f" class="form-control" id="inputEmail4" placeholder="Fullname">
    </div>
    <div class="form-group col-md-10">
      <label for="inputPassword4">Password</label>
      <input type="password"  name="p" class="form-control" id="inputPassword4" placeholder="Password">
    </div>
  </div>
  <input type="submit"  name="y" class="btn btn-primary" value="Login">
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>





     








<?php
if(isset($_REQUEST["x"]))
{
$conn=new mysqli("localhost","root","","hospital");
$p1=$_REQUEST["e"];
$p2=$_REQUEST["p"];
$p3=$_REQUEST["f"];
$p4=$_REQUEST["m"];
$p5=$_REQUEST["dob"];
$p6=$_REQUEST["g"];



$str="insert into patient_info values('$p1','$p2','$p3','$p4','$p5','$p6')";
$conn->query($str);
?>
<script>alert("You are registered successfully !!!!")</script>

<?php
}
?>



<?php
if(isset($_REQUEST["y"]))
{
$conn=new mysqli("127.0.0.1","root","","hospital");
$p1=$_REQUEST["f"];
$p2=$_REQUEST["p"];
$res=$conn->query("select * from patient_info where fname='$p1' and pass='$p2'");
if(($rows=mysqli_fetch_array($res)))
{
$_SESSION["Full Name"]=$rows[2];
$_SESSION["Password"]=$rows[1];
header("location:profile1.php");
}
else
{
?>
<script>alert("Invalid Login Details!!!");</script>
<?php
}
}
?>


   
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


  </body>
</html>


