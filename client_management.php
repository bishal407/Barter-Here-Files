<?php
include('../server.php');
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location:admin.php');
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: admin.php");
}
if (isset($_SESSION['username'])) {
    $searchquery = "SELECT * FROM `user`";
    $searchresults = mysqli_query($db, $searchquery);
}
if (isset($_POST['search-client'])) {
    $searchinput = $_POST['client-search-input'];
    //Search uer from input
    $searchquery = "SELECT * FROM `user` WHERE lower(`ClientFirstName`) LIKE '%$searchinput%' OR lower(`ClientLastName`) LIKE '%$searchinput%'";
    $searchresults = mysqli_query($db, $searchquery);
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
                                <a class="nav-link" href="client_management.php?logout='1'">Log Out</a>
                            </li>

                        </ul>


                    </div>
                </nav>

            </div>
            <div class="right col-10 py-3 overflow-auto">
                <div class="topbar d-flex justify-content-between mx-0 px-0">
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
                <hr>
                <div class="wrapper bg-light m-0 p-0">
                    <div class="d-flex flex-column col-lg-12  mx-auto py-5">
                        <h2 class="text-center">Client Management</h2>
                        <?php if (isset($_SESSION['message'])) : ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <h5 class="text-light">
                                    <?php
                                    echo $_SESSION['message'];
                                    unset($_SESSION['message']);
                                    ?>
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                                <?php endif ?>

                        <br><br>
                        <div class="row d-flex col-12 m-0 ">

                            <form action="" method="post">
                                <div class="search d-flex col-5 mx-auto mb-5">
                                    <input class="form-control " name="client-search-input" type="text" placeholder="Search..." aria-label="default input example">
                                    <button type="submit" name="search-client" class="btn btn-tranparent mx-3 text-light "><i class="fas fa-search fa-2x"></i></button>
                                </div>
                                <div class="table-responsive m-0">
                                    <table class="table table-light table-hover text-align-top">
                                        <thead>
                                            <tr class="align-top">
                                                <th>Client ID</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>DOB</th>
                                                <th>Username</th>
                                                <th>Password</th>
                                                <th>Email</th>
                                                <th>Mobile Number</th>
                                                <th colspan="2"> Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while ($row = mysqli_fetch_array($searchresults)) { ?>
                                                <tr>
                                                    <td><?php echo $row['ClientID']; ?></td>
                                                    <td> <?php echo $row['ClientFirstName']; ?></td>
                                                    <td><?php echo $row['ClientLastName']; ?> </td>
                                                    <td><?php echo $row['DOB']; ?> </td>
                                                    <td><?php echo $row['ClientUserName']; ?> </td>
                                                    <td><?php echo $row['ClientPassword']; ?> </td>
                                                    <td><?php echo $row['ClientEmail']; ?> </td>
                                                    <td><?php echo $row['MobileNumber']; ?> </td>
                                                    <td><a class="btn btn-primary" href="edit_clientprofile.php?editclientprofile=<?php echo $row['ClientID']; ?>" class="text-decoration-none text-light">Edit</a></td>
                                                    <td><a class="btn btn-danger" onclick="return confirm('Delete Profile');" href="client_management.php?deleteclientprofile=<?php echo $row['ClientID']; ?>" class="text-decoration-none text-light">Delete</a> </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>


                        </div>
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