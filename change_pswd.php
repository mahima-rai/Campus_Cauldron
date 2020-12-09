<?php


$mykey2 = $_REQUEST['key'];
session_start();
include 'conn.php';
$result = mysqli_query($con, "SELECT * FROM users WHERE userid=$mykey2");
if (mysqli_num_rows($result) > 0) {
    @session_start();
    $row = mysqli_fetch_array($result);
    $_SESSION['uname']=$row['username'];
    $_SESSION['pasw']=$row['password'];


} else {
    echo "<script type='text/javascript'>alert('Your profile cannot be opened.'); window.location.href = 'index.php';</script>";
}

if (isset($_POST['submit'])) {
    $old_pswd = $_POST['old_pswd'];
    $new_pswd = $_POST['new_pswd'];
    $con_pswd = $_POST['con_pswd'];

    if (empty($old_pswd) || empty($new_pswd) || empty($con_pswd)) {
        echo " <div class='alert alert-danger'><strong>ERROR</strong> - Empty fields are not allowed !</div>";
    } else {
        if (($old_pswd == $_SESSION['pasw']) && ($new_pswd == $con_pswd)) {
            $ins = mysqli_query($con, "UPDATE users SET password='$new_pswd' where userid='$mykey1'");
            if ($ins == 1) {
                echo "<script type='text/javascript'>alert('Your password has been reset'); window.location.href = 'userprofile.php';</script>";
            } else {
                echo "error in database";
            }
        } else {
            echo "<script type='text/javascript'>alert('Enter correct password');</script>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body>

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-register-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4"><?php echo $row["username"] ?></h1>
                                    </div>
                                    <form class="user">
                                        <div class="form-group">
                                            <input name="old_pswd" type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Enter Current Password">
                                        </div>
                                        <div class="form-group">
                                            <input name="new_pswd" type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Enter new Password">
                                        </div>
                                        <div class="form-group">
                                            <input name="con_pswd" type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Confirm new Password">
                                        </div>

                                        <button class="btn btn-primary btn-user btn-block" name="submit" value="submit" type="submit">
                                            Submit
                                        </button>
                                        <hr>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="index.php">Back to home</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>