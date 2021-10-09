<?php
include('../server.php');
if (!isset($_SESSION['username'])){
	
    $_SESSION['msg']="You must log in first";
    header('location:admin.php');
    }
    
if(isset($_GET['logout'])){
    session_destroy();
    unset($_SESSION['username']);
    header("location:admin.php");
    }
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/style.css">
    <title>Admin Dashboard</title>
    <style>
        .main_div nav .nav_items a {
            color: white;
        }

        .main_div nav .nav_items .navbar-brand {
            font-size: 50px;
            color: white;
        }

        .main_div .container table tr {
            padding: 0 10px;
        }
    </style>
</head>

<body>
    <div class="container-fluid main_div">
        <div class="row">
            <div class="left col-2 bg-secondary" style="height: 100vh;">
                <div class="brand d-flex flex-column justify-content-center align-items-center mt-3">
                    <i class="fas fa-user-circle fa-5x text-light mb-3"></i>
                    <h4 class="text-warning"><strong><?php echo $_SESSION['username']; ?></strong></h4>
                </div>
                <hr class="bg-light">
                <nav class="navbar d-flex flex-column  ">
                    <div class="container-fluid text-light nav_items">
                        <ul class="navbar-nav  mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="admin_welcome.php">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="admin_profile.php">Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="staff_management.php">Staff Management</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="client_management.php">Client Managment</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="admin_profile.php">Settings</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="edit_clientprofile.php?logout='1'">Log Out</a>
                            </li>

                        </ul>


                    </div>
                </nav>

            </div>
            <div class="right col-10  overflow-auto " style="height: 100vh;">
                <div class="topbar d-flex justify-content-between sticky-top z-index-2 bg-secondary shadow-lg p-3 mt-0">
                    <form action="" class="d-flex col-6 align-items-center">
                        <input class="form-control " type="text" placeholder="Search..." aria-label="default input example">
                        <a href="#" class="mx-3 text-secondary"><i class="fas fa-search fa-2x"></i></a>
                    </form>
                    <div class="link d-flex col-2 align-items-center justify-content-end mx-2 justify-content-around">
                        <a href=""><i class="far fa-bell"></i></a>
                        <a href="http://"><i class="far fa-envelope"></i></a>
                        <a href="admin_profile.php"><i class="fas fa-user-circle fa-2x"></i></a>

                    </div>
                </div>


                <div class="d-flex flex-column col-12 mx-auto ">

                    <?php if (isset($_SESSION['message'])) : ?>
                        <div class="alert alert-success" role="alert">
                        <?php
                        echo $_SESSION['message'];
                        unset($_SESSION['message']);
                        ?>
                        </div>
                        
                    <?php endif ?>

                    <div class="main_div d-flex  flex-column col-5 mx-auto mb-5 py-5">
                        <h1>Edit Client's Profile</h1>
                        <form name="frmClientSignUp"  method="POST" action="edit_clientprofile.php">
                            <!-- <?php include('errors.php') ?> -->
                            <div class="mb-3">
                                <label for="username" class="form-label">
                                    <h4>Username: <?php echo $displayClientUsername; ?></h4>
                                </label>
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Client ID</label>
                                <input type="text" class="form-control" id="username" name="clientID" value="<?php echo $displayClientID; ?>" name="clientID" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="fname" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="fname" name="clientFirstName" value="<?php echo $displayClientFName; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="lname" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lname" name="clientLastName" value="<?php echo $displayClientLName; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="dob" class="form-label">DOB</label>
                                <input type="text" class="form-control" id="dob" name="clientDOB" value="<?php echo $displayClientdob; ?>">
                            </div>
                            <div class="mb-3">
                                <label id="clientemail" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="clientemail" name="clientEmail" value="<?php echo $displayClientEmail; ?>" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="mobile_number" class="form-label">Mobile Number</label>
                                <input type="text" class="form-control" id="mobile_number" name="clientMobileNumber" value="<?php echo $displayClientmobile; ?>">
                            </div>

                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                                <label class="form-check-label" for="exampleCheck1">Check me out</label>
                            </div>
                            <a href="client_management.php" class="btn btn-danger">Cancel</a>
                            <button type="submit" class="btn btn-success" name="edit_clientprofile">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



    </div>

    <!-- carousel ends  -->

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
    -->
</body>

</html>