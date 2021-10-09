<?php
include ('server.php')
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/style.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Akronim&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Akronim&display=swap" rel="stylesheet">
	
	
    <title>Hello, world!</title>
  </head>
  <body>
  
  <img src = "images/logo.png" height= "350px" width="350px" class="center">
    
    <!-- navbar starts  -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand font-weight-bold" href="#"><h1>Barter Here  👌👌   Helping Locals Sell thier Stuff :)</h1></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="home.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="about.php">About Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="contact.php">Contact Us</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Dropdown
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="client_sign_up.php">Sign Up</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="login.php">Log Out</a>
            </li>
           
          </ul>
          
        </div>
      </div>
    </nav>
    <!-- navbar ends  -->
    <!-- carousel starts  -->
	<img src = "images/client.png" height= "200px" width="200px" class = "center" >
	<h1 align = "center">Client Dashboard</h1>
    
    <section>
      <div>
        

		<b>
		
		</br>
<div>	
<div>

<h1><p style = "font-family: 'Akronim', cursive;" align = "center" > Please Upload The Picture of the good you want to barter...</p></h1>
	   

<form action="upload.php" method="post" enctype="multipart/form-data">
    Select Image File to Upload:
    <input type="file" name="file">
    <input type="submit" name="submit" value="Upload">
</form>
</div>	

	
<?php
	
require('connect.php');
if(isset($_POST) & !empty($_POST)){
	$name = mysqli_real_escape_string($connection, $_POST['name']);
	$email = mysqli_real_escape_string($connection, $_POST['email']);
	$subject = mysqli_real_escape_string($connection, $_POST['subject']);
 
	$isql = "INSERT INTO comments (name, email, subject, status) VALUES ('$name', '$email', '$subject', 'draft')";
	$ires = mysqli_query($connection, $isql) or die(mysqli_error($connection));
	if($ires){
		$smsg = "Your Post has been submitted successfully 😊😊😊😊😊";
	}else{
		$fmsg = "Failed to Submit Your Comment";
	}
 
}
?>


<?php if(isset($smsg)){ ?><div class="alert alert-success" role="alert"> <?php echo $smsg; ?> </div><?php } ?>
<?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>

<?php if(isset($smsg)){ ?><div class="alert alert-success" role="alert"> <?php echo $smsg; ?> </div><?php } ?>
<?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>


<div>

<div class="panel panel-default">
<div class="panel-heading">Submit Your Post Here!!!</div>
  <div class="panel-body">
  	<form method="post">
  	  <div class="form-group">
	    <label for="exampleInputEmail1">Name</label>
	    <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Name">
	  </div>
	  <div class="form-group">
	    <label for="exampleInputEmail1">Email address</label>
	    <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
	  </div>
	  <div class="form-group">
	    <label for="exampleInputPassword1">Barter Description</label>
	    <textarea name="subject" class="form-control" rows="3"></textarea>
		<button type="submit" class="btn btn-primary">Submit</button>
	  </div>
	
	</form>
  </div>
</div>
</div>

<div class="panel panel-default">
<div class="panel-heading">Recent Barter Threads</div>
  <div class="panel-body">
  <?php 
  	$comsql = "SELECT * FROM comments";
  	$comres = mysqli_query($connection, $comsql);
  	while($comr = mysqli_fetch_assoc($comres)){
  		$hash = md5( strtolower( trim( $comr['email'] ) ) );
		$size = 150;
  		$grav_url = "https://www.gravatar.com/avatar/" . $hash . "?s=" . $size;
  ?>
  	<div class="row">
  		<div class="col-md-3">
  			<img src="<?php echo $grav_url; ?>">
  		</div>
  		<div class="col-md-9">
  			<p><strong><?php echo $comr['name']; ?></strong> </p>
  			<p><?php echo $comr['submittime'] ?></p>
  			<p><?php echo $comr['subject']; ?></p>
  		</div>
  	</div>
  	<br>
  	<?php } ?>
  </div>
</div>

  </div>

 <?php
// Include the database configuration file
include 'dbConfig.php';

// Get images from the database
$query = $db->query("SELECT * FROM images ORDER BY uploaded_on DESC");

if($query->num_rows > 0){
    while($row = $query->fetch_assoc()){
        $imageURL = 'uploads/'.$row["file_name"];
?>
    <img src="<?php echo $imageURL; ?>" height = "500px" width = "500px" alt="" />
<?php }
}else{ ?>
    <p>No image(s) found...</p>
<?php } ?>

 

</div>
  <script>
        function login() {
        window.open("login.php");
}
    </script>
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
  <section>
      <div class= "footer">
        <p>Copyright ©️ 2021 allright received  </p>
		<p> Designed by Team Techcognition </p>
		
      </div>
    </section>
</html>