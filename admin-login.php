<?php
session_start();

if(isset($_SESSION["admin"]))
{
    header("Location: admin1.php");
    exit();
}

$error = "";

if(isset($_POST["admin_login"]))
{
    $username = trim($_POST["username"] ?? "");
    $password = trim($_POST["password"] ?? "");

    /*
     * Admin Login Details
     */
    $admin_username = "admin";
    $admin_password = "admin123";

    if($username === $admin_username && $password === $admin_password)
    {
        $_SESSION["admin"] = true;
        $_SESSION["admin_username"] = $username;

        header("Location: admin1.php");
        exit();
    }
    else
    {
        $error = "Invalid Username or Password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>MediCare+ | Admin Login</title>

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

<style>

body
{
    margin:0;
    font-family:'Segoe UI',Arial,sans-serif;
    background:linear-gradient(135deg,#eef8ff,#dcefff);
    min-height:100vh;

    display:flex;
    align-items:center;
    justify-content:center;
}

.login-container
{
    width:100%;
    max-width:420px;
    padding:20px;
}

.login-box
{
    background:white;
    padding:40px 35px;
    border-radius:15px;
    box-shadow:0 8px 30px rgba(11,31,77,0.15);
}

.logo
{
    text-align:center;
    margin-bottom:10px;
}

.logo h2
{
    color:#0B1F4D;
    font-weight:bold;
    margin-bottom:5px;
}

.logo span
{
    color:#4da3ff;
}

.logo p
{
    color:#777;
    font-size:14px;
    margin-bottom:30px;
}

.login-title
{
    text-align:center;
    color:#0B1F4D;
    font-size:24px;
    font-weight:bold;
    margin-bottom:25px;
}

.form-group label
{
    color:#172033;
    font-weight:600;
}

.form-control
{
    height:45px;
    border-radius:8px;
    border:1px solid #d5e1ed;
}

.form-control:focus
{
    border-color:#126fc1;
    box-shadow:0 0 0 0.15rem rgba(18,111,193,0.15);
}

.login-btn
{
    width:100%;
    background:#126fc1;
    color:white;
    border:none;
    border-radius:8px;
    padding:11px;
    font-size:16px;
    font-weight:600;
    margin-top:10px;
}

.login-btn:hover
{
    background:#0B1F4D;
    color:white;
}

.admin-icon
{
    width:70px;
    height:70px;
    border-radius:50%;
    background:#eaf4ff;
    display:flex;
    align-items:center;
    justify-content:center;
    margin:0 auto 15px;
    font-size:32px;
}

.footer-text
{
    text-align:center;
    color:#888;
    font-size:12px;
    margin-top:25px;
    margin-bottom:0;
}

</style>

</head>

<body>

<div class="login-container">

    <div class="login-box">

        <div class="logo">

            <div class="admin-icon">
                👨‍💼
            </div>

            <h2>
                ✚ Medi<span>Care+</span>
            </h2>

            <p>
                Hospital Management System
            </p>

        </div>

        <div class="login-title">
            Admin Login
        </div>

        <?php if($error != "") { ?>

            <div class="alert alert-danger text-center">
                <?php echo htmlspecialchars($error); ?>
            </div>

        <?php } ?>

        <form method="POST"
              action="admin-login.php">

            <div class="form-group">

                <label>
                    Username
                </label>

                <input type="text"
                       name="username"
                       class="form-control"
                       placeholder="Enter admin username"
                       required>

            </div>

            <div class="form-group">

                <label>
                    Password
                </label>

                <input type="password"
                       name="password"
                       class="form-control"
                       placeholder="Enter admin password"
                       required>

            </div>

            <button type="submit"
                    name="admin_login"
                    class="login-btn">

                🔐 Login

            </button>

        </form>

        <p class="footer-text">
            © 2026 MediCare+ | Admin Panel
        </p>

    </div>

</div>

</body>

</html>