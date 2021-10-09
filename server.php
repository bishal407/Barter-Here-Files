<?php 
				//Track logged in users
				session_start();
				
				//** Errors and session variables **
				$errors = array();
				
				//**Connection to the database****
				//Variables to connect to the database****
				$dbhost ="localhost";
				$dbuser ="root";
				$dbpass ="";
				//ensurer that the $db value corresponds to your database name
				$dbname = "socialapp";
				
				$db =mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die("Connection failed: %s\n". $conn -> error);
				
				//*****Client Sign Up*****
				//Create and initialise the variables that will hold the values entered in the sign up form 
				$clientFirstName="";
				$clientLastName="";
				$clientdob="";
				$clientUsername="";
				$clientPassword="";
				$clientEmail="";
				$clientmobile="";
			
				
		// 		//** Staff variables**
		// 		// receive all input value from thr form
		// 		$staffFirstName="";
		// 		$staffLastName="";
		// 		$staffdob="";
		// 		$staffUsername="";
		// 		$staffPassword="";
		// 		$staffEmail="";
		// 		$staffmobile="";
				
				// 'client-signup' is the name assigned to the button input on the form
				if ( isset($_POST['signup'])) {
				
				// receive all input value from thr form
				$clientFirstName=mysqli_real_escape_string($db, $_POST['clientFirstName']);
				$clientLastName=mysqli_real_escape_string($db, $_POST['clientLastName']);
				$clientdob=mysqli_real_escape_string($db, $_POST['clientDOB']);
				$clientUsername=mysqli_real_escape_string($db, $_POST['clientUsername']);
				$clientPassword=mysqli_real_escape_string($db, $_POST['clientpsw']);
				$clientEmail=mysqli_real_escape_string($db, $_POST['clientEmail']);
				$clientmobile=mysqli_real_escape_string($db, $_POST['clientMobileNumber']);
				
				//1. Check if username and e-mail already exits in the database
				$user_check_query = "SELECT * FROM `user` WHERE `ClientUserName` = '$clientUsername' OR `ClientEmail`='$clientEmail' LIMIT 1";
				$result =mysqli_query($db, $user_check_query);
				$user =mysqli_fetch_assoc($result);
				
				
				if ($user) { //if user exists
					//ensure that 'ClisntUserName' matches your databse column
					if ($user['ClientUserName']===$clientUsername){
					array_push($errors, "Username already exists");
					
					}
					//ensure that 'ClientEmail' matches your databse column
					if ($user['ClientEmail']===$clientEmail){
					array_push($errors, "Email already exists");
					}
				
				}
			
			// 2. Sign up user if there are no errors in the form
			if (count($errors) == 0){
				$encclientpassword = md5($clientPassword);//encrypt the password before saving in the database
				$query ="INSERT INTO `user` (`ClientFirstName`, `ClientLastName`,`DOB`, `ClientUserName`, `ClientPassword`, `ClientEmail`,`MobileNumber`)
					VALUES('$clientFirstName', '$clientLastName','$clientdob', '$clientUsername', '$encclientpassword', '$clientEmail','$clientmobile')";
				mysqli_query($db, $query);
				header('location: login.php');
			}
		}
		//***** End of Client Sign Up *****
		// //****Client Login*******
		// //* signin' is the name assigned to the butoon on the login form
		if (isset ($_POST['login'])){
			//received all input values from the form
			$clientUsername = mysqli_real_escape_string($db, $_POST['username']);
			$clientPassword = mysqli_real_escape_string($db, $_POST['password']);
			//checks if the credentials match a record from the databse and logs them in if it does.
			if (count($errors) == 0){
				$encclientPassword = md5($clientPassword);
				$query = "SELECT * FROM `user` WHERE `ClientUserName`='$clientUsername' AND `ClientPassword`='$encclientPassword' ";
				$results = mysqli_query($db, $query);
				if (mysqli_num_rows($results) == 1){
					$_SESSION['username'] = $clientUsername;
					$_SESSION['success'] = "You are now logged in ";
					header('location: client_dashboard.php');
				}else{
					array_push($errors, "Wrong username or password combination");
				}
				
			}
			
		}
		//**** Endo of Client Login *****
		// //**** Client My Profile *****

		// if (isset($_SESSION['username'])){
		// 	$clientuser =$_SESSION['username'];
		// 	//`client` and `ClientUsername` should match your localhost tables
		// 	$query ="SELECT * FROM `client` WHERE `ClientUserName` = '$clientuser' ";
		// 	$clientresult =mysqli_query($db, $query);
		// 	while ($row = mysqli_fetch_array($clientresult)){
		// 		$displayClientID =$row['ClientID'];
		// 		$displayClientFName =$row['ClientFirstName'];
		// 		$displayClientLName =$row['ClientLastName'];
		// 		$displayClientdob =$row['DOB'];
		// 		$displayClientUsername =$row['ClientUserName'];
		// 		$displayClientPassword =$row['ClientPassword'];
		// 		$displayClientEmail =$row['ClientEmail'];
		// 		$displayClientmobile =$row['MobileNumber'];
		// 		$displayClientMembership =$row['Membership'];
		// 	}
		// } //**** End of Client My Profile *****
			
		// 	//***** Client Edit My Profile *****
		// 	//'client-editmyprofile' is the name assigned to the button input on the form
		// 	if (isset($_POST['client-editmyprofile'])){
			
		// 		//receive all input values from thr form
		// 		$displayClientFName= mysqli_real_escape_string($db, $_POST['clientFirstName']);
		// 		$displayClientLName= mysqli_real_escape_string($db, $_POST['clientLastName']);
		// 		$displayClientdob= mysqli_real_escape_string($db, $_POST['clientDOB']);
		// 		$displayClientPassword= mysqli_real_escape_string($db, $_POST['clientPassword']);
		// 		$displayClientEmail= mysqli_real_escape_string($db, $_POST['clientEmail']);
		// 		$displayClientmobile= mysqli_real_escape_string($db, $_POST['clientmobile']);
		// 		$displayClientMembership= mysqli_real_escape_string($db, $_POST['clientmembership']);
		// 		$encclientpassword = md5($displayClientPassword);//encrypt the password before saving in the dabase
				
		// 		//Update user if there are no errors in the form
		// 		$updatequery = "UPDATE `client`
		// 		SET`ClientFirstName` ='$displayClientFName', `ClientLastName`='$displayClientLName',`DOB`='$displayClientdob',`ClientPassword`='$encclientpassword',`ClientEmail`='$displayClientEmail', `MobileNumber`='$displayClientmobile',   `Membership`='$displayClientMembership'
		// 		WHERE `ClientUserName` ='$clientuser'";
		// 		mysqli_query($db, $updatequery);
		// 		$SESSION['message']= "Profile Update";
		// 		header('location: clientprofile.php');
		// 	}//***** End of Client Edit My Profile *****
			
		
			
		// 	//**Staff Sign Up ***	
				
		// 		// 'staffsignup' is the name assigned to the button input on the form
		// 		if ( isset($_POST['staffsignup'])) {
				
		// 		// receive all input value from thr form
		// 		$staffFirstName=mysqli_real_escape_string($db, $_POST['staffFirstName']);
		// 		$staffLastName=mysqli_real_escape_string($db, $_POST['staffLastName']);
		// 		$staffdob=mysqli_real_escape_string($db, $_POST['staffDOB']);
		// 		$staffUsername=mysqli_real_escape_string($db, $_POST['staffUsername']);
		// 		$staffPassword=mysqli_real_escape_string($db, $_POST['staffPassword']);
		// 		$staffEmail=mysqli_real_escape_string($db, $_POST['staffEmail']);
		// 		$staffmobile=mysqli_real_escape_string($db, $_POST['staffMobileNumber']);
				
				
				
		// 		//1. Check if username and e-mail already exits in the database
		// 		$staff_check_query = "SELECT * FROM `staff` WHERE `StaffUserName` = '$staffUsername' OR `StaffEmail`='$staffEmail' LIMIT 1";
		// 		$result =mysqli_query($db, $staff_check_query);
		// 		$staff =mysqli_fetch_assoc($result);
				
				
		// 		if ($staff) { //if user exists
		// 			//ensure that 'StaffUserName' matches your databse column
		// 			if ($staff['StaffUserName']===$staffUsername){
		// 			array_push($errors, "Username already exists");
					
		// 			}
		// 			//ensure that 'StaffEmail' matches your databse column
		// 			if ($staff['StaffEmail']===$staffEmail){
		// 			array_push($errors, "Email already exists");
		// 			}
				
		// 		}
			
		// 	// 2. Sign up user if there are no errors in the form
		// 	if (count($errors) == 0){
		// 		$encstaffpassword = md5($staffPassword);//encrypt the password before saving in the database
		// 		$query ="INSERT INTO `staff` (`StaffFirstName`, `StaffLastName`, `DOB`, `StaffUserName`,  `StaffPassword`, `StaffEmail`, `MobileNumber`)
		// 			VALUES('$staffFirstName', '$staffLastName', '$staffdob','$staffUsername', '$encstaffpassword', '$staffEmail', '$staffmobile')";
		// 		mysqli_query($db, $query);
		// 		header('location: staff_profile.php');
		// 	}
			
		// }//***** End of staff Sign Up *****
		// //****Staff Login*******

		// //* staff_login' is the name assigned to the butoon on the login form
		
		if (isset ($_POST['admin_login'])){
			//received all input values from the form
			$adminUsername = mysqli_real_escape_string($db, $_POST['username']);
			$adminPassword = mysqli_real_escape_string($db, $_POST['password']);
			//checks if the credentials match a record from the databse and logs them in if it does.
			if (count($errors) == 0){
				$encadminPassword = md5($adminPassword);
				$query = "SELECT * FROM `admin` WHERE `AdminUserName`='$adminUsername' AND `AdminPassword`='$encadminPassword' ";
				$results = mysqli_query($db, $query);
				if (mysqli_num_rows($results) == 1){
					$_SESSION['username'] = $adminUsername;
					$_SESSION['success'] = "You are now logged in ";
					header('location: admin_welcome.php');
				}else{
					array_push($errors, "Wrong username//password combination");
				}
				
			}
			
		}
		//**** Endo of staff Login *****
				
		//**** Staff My Profile *****

		if (isset($_SESSION['username'])){
			$adminuser =$_SESSION['username'];
			//`staff` and `StaffUsername` should match your localhost tables
			$query ="SELECT * FROM `admin` WHERE `AdminUserName` = '$adminuser' ";
			$staffresult =mysqli_query($db, $query);
			while ($row = mysqli_fetch_array($staffresult)){
				
				$displayAdminID=$row['AdminID'];
				$displayAdminFName=$row['AdminFirstName'];
				$displayAdminLName=$row['AdminLastName'];
				$displayAdmindob=$row['DOB'];
				$displayAdminUsername=$row['AdminUserName'];
				$displayAdminPassword=$row['AdminPassword'];
				$displayAdminEmail=$row['AdminEmail'];
				$displayAdminmobile=$row['MobileNumber'];
			
			}
		} //**** End of Staff My Profile *****
		
		
		
			
			
				
		// //***** Staff Edit My Profile *****
		// 	//'staff-editmyprofile' is the name assigned to the button input on the form
		// 	if (isset($_POST['staff-editmyprofile'])){
			
		// 		//receive all input values from thr form
		// 		$displayStaffFName= mysqli_real_escape_string($db, $_POST['staffFirstName']);
		// 		$displayStaffLName= mysqli_real_escape_string($db, $_POST['staffLastName']);
		// 		$displayStaffdob= mysqli_real_escape_string($db, $_POST['staffDOB']);
		// 		$displayStaffPassword= mysqli_real_escape_string($db, $_POST['staffPassword']);
		// 		$displayStaffEmail= mysqli_real_escape_string($db, $_POST['staffEmail']);
		// 		$displayStaffmobile= mysqli_real_escape_string($db, $_POST['staffmobile']);
		// 		$encstaffpassword = md5($displayStaffPassword);//encrypt the password before saving in the dabase
				
		// 		//Update user if there are no errors in the form
		// 		$updatequery = "UPDATE `staff`
		// 		SET`StaffFirstName` ='$displayStaffFName', `StaffLastName`='$displayStaffLName', `DOB`='$displayStaffdob', `StaffPassword`='$encstaffpassword',`StaffEmail`='$displayStaffEmail', `MobileNumber`='$displayStaffmobile'
		// 		WHERE `StaffUserName` ='$staffuser'";
		// 		mysqli_query($db, $updatequery);
		// 		$SESSION['message']= "Profile Update";
		// 		header('location: staff_profile.php');
		// 	}//***** End of staff Edit My Profile *****
		// 	//**** Edit Client *****
		// 	//Get the ClientID from the row selected
			if(isset($_GET['editclientprofile'])){
				$getclientID=$_GET['editclientprofile'];
				$query="SELECT * FROM `user` WHERE `ClientID`='$getclientID' ";
				$clientresult=mysqli_query($db, $query);
				while ($row =mysqli_fetch_array($clientresult)){
					
					$displayClientID =$row['ClientID'];
					$displayClientFName = $row['ClientFirstName'];
					$displayClientLName = $row['ClientLastName'];
					$displayClientdob = $row['DOB'];
					$displayClientUsername = $row['ClientUserName'];
					$displayClientPassword = $row['ClientPassword'];
					$displayClientEmail = $row['ClientEmail'];
					$displayClientmobile = $row['MobileNumber'];
					
				}
				
			}
			//*** End of Edit Client ******
		// 	//**** Edit Client Profile******
		// 	//'edit-clientprofile' is the name assigned to the button input on the form
			if (isset($_POST['edit_clientprofile'])){
				//receive all input value from the form
				$displayClientID=mysqli_real_escape_string($db, $_POST['clientID']);
				$displayClientFName=mysqli_real_escape_string($db, $_POST['clientFirstName']);
				$displayClientLName=mysqli_real_escape_string($db, $_POST['clientLastName']);
				$displayClientdob=mysqli_real_escape_string($db, $_POST['clientDOB']);
				$displayClientEmail=mysqli_real_escape_string($db, $_POST['clientEmail']);
				$displayClientmobile=mysqli_real_escape_string($db, $_POST['clientMobileNumber']);
				
				//Update user if there are no errors in the form
				$updatequery="UPDATE `user`
				SET`ClientFirstName` = '$displayClientFName', `ClientLastName`= '$displayClientLName', `DOB`='$displayClientdob', `ClientEmail`='$displayClientEmail',`MobileNumber`= '$displayClientmobile'
				WHERE `ClientID` = '$displayClientID'";
				mysqli_query($db, $updatequery);
				$_SESSION['message']="Profile has been updated.";
				header('location: client_management.php');
				
			}
		// 	// Get the ClientID from the row selected
			if (isset($_GET['deleteclientprofile'])){
				$getclientID = $_GET['deleteclientprofile'];
				$deletequery = "DELETE FROM `user` WHERE `ClientID` = '$getclientID' ";
				mysqli_query($db, $deletequery);
				$_SESSION['message']="Client Deleted.";
				header('location:client_management.php');
				
			}
			// **** End of Delete Client ****
			
			
			
		// 	//**** Edit Staff *****
		// 	//Get the StaffID from the row selected
		// 	if(isset($_GET['editstaffprofile'])){
		// 		$getstaffID=$_GET['editstaffprofile'];
		// 		$query="SELECT * FROM `staff` WHERE `StaffID`='$getstaffID' ";
		// 		$staffresult=mysqli_query($db, $query);
		// 		while ($row =mysqli_fetch_array($staffresult)){
					
		// 			$displayStaffID =$row['StaffID'];
		// 			$displayStaffFName = $row['StaffFirstName'];
		// 			$displayStaffLName = $row['StaffLastName'];
		// 			$displayStaffdob = $row['DOB'];
		// 			$displayStaffUsername = $row['StaffUserName'];
		// 			$displayStaffPassword = $row['StaffPassword'];
		// 			$displayStaffEmail = $row['StaffEmail'];
		// 			$displayStaffmobile = $row['MobileNumber'];
					
					
		// 		}
				
		// 	}//*** End of Edit Staff ******
		// 	//**** Edit Staff Profile******
		// 	//'edit-staffprofile' is the name assigned to the button input on the form
		// 	if (isset($_POST['edit_staffprofile'])){
		// 		//receive all input value from the form
		// 		$displayStaffID=mysqli_real_escape_string($db, $_POST['staffID']);
		// 		$displayStaffFName=mysqli_real_escape_string($db, $_POST['staffFirstName']);
		// 		$displayStaffLName=mysqli_real_escape_string($db, $_POST['staffLastName']);
		// 		$displayStaffdob=mysqli_real_escape_string($db, $_POST['staffDOB']);
		// 		$staffPassword=mysqli_real_escape_string($db, $_POST['staffPassword']);
		// 		$displayStaffEmail=mysqli_real_escape_string($db, $_POST['staffEmail']);
		// 		$displayStaffmobile=mysqli_real_escape_string($db, $_POST['staffmobile']);
		// 		$encstaffpassword =md5($staffPassword);//encrypt the password before saving in the database
				
		// 		//Update user if there are no errors in the form
		// 		$updatequery="UPDATE `staff`
		// 		SET`StaffFirstName` = '$displayStaffFName', `StaffLastName`= '$displayStaffLName', `DOB`='$displayStaffdob',`StaffPassword`= '$encstaffpassword', `StaffEmail`='$displayStaffEmail',`MobileNumber`= '$displayStaffmobile'
		// 		WHERE `StaffID` = '$displayStaffID'";
		// 		mysqli_query($db, $updatequery);
		// 		$_SESSION['message']="Profile Update";
		// 		header('location: staffmanagement.php');
				
		// 	}
		// 	//**** Delete Staff ****
		// 	// Get the StaffID from the row selected
		// 	if (isset($_GET['deletestaffprofile'])){
		// 		$getstaffID = $_GET['deletestaffprofile'];
		// 		$deletequery = "DELETE FROM `staff` WHERE `StaffID` = '$getstaffID' ";
		// 		mysqli_query($db, $deletequery);
		// 		$_SESSION['message']="Staff Deleted";
		// 		header('location:staffmanagement.php');
				
		// 	}// **** End of Delete Staff ****
							
		?> 
     
