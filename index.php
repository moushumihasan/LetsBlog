<?PHP
    require("top.php");
    
    if (isset($_SESSION["user_id"])){
    	header( 'Location: ' . HOME_PAGE ) ;
    	exit;
    }
    
    $success = "";
    $error = "";
    $success_login = "";
    $error_login = "";
    
   if(isset($_POST["form_name"]) && $_POST["form_name"] == 'registration') {

   		$first_name = mysql_real_escape_string($_POST["firstName"], LINK);
   		$surname = mysql_real_escape_string($_POST["surname"], LINK);
   		$email = mysql_real_escape_string($_POST["emailAddress"], LINK);
   		$password = mysql_real_escape_string($_POST["passwordReg"], LINK);
   		$gender = intval($_POST["gender"]);

   		$sql = "INSERT INTO users(first_name, surname, email, password, gender, status, added_datetime) " . 
     			"VALUES('$first_name', '$surname', '$email', md5('$password'), $gender, 1, NOW())";
   		
   		//echo $sql;
   		
   		mysql_query($sql, LINK) or die("Could not insert to users.");
   		
   		if(mysql_insert_id(LINK) > 0) {
   			$success = "Registration successful. Please log in.";
   			
   			$user_id = mysql_insert_id(LINK);
   			$_SESSION["user_id"] = $user_id;
   			$_SESSION["email"] = $email;
   			$_SESSION["first_name"] = $first_name;
   			
   			header( 'Location: ' . HOME_PAGE ) ;
   			exit;
   		} else {
   			$error = "Could not register, please try again";
   		}
   		
   } else if(isset($_POST["form_name"]) && $_POST["form_name"] == 'login') {
   		$email = mysql_real_escape_string($_POST["email"], LINK);
   		$password = mysql_real_escape_string($_POST["password"], LINK);
   	 	
   		$sql = "SELECT * FROM users WHERE email = '$email' AND password = md5('$password')";
   		$result = mysql_query($sql, LINK);
   		
   		if(mysql_num_rows($result) > 0) {
   			$success_login = "Log in success";
   			
   			$row = mysql_fetch_assoc($result);
   			$user_id = $row["user_id"];
   			$first_name = $row["first_name"];
   			
   			
   			$_SESSION["user_id"] = $user_id;
   			$_SESSION["email"] = $email;
   			$_SESSION["first_name"] = $first_name;
   			
   			header( 'Location: ' . HOME_PAGE ) ;
   			exit;
   		} else {
   			$error_login = "Invalid email or password. Please re-enter and try again. ";
   		}
   		
   				 
   }
    
    
    
?>        
<div id="content">
	<h3>Login</h3>
	<?php 
		
		if($error_login != "") {
			echo "<p class='error'>$error_login</p>";
		} else if($success_login != "") {
			echo "<p class='success'>$success_login</p>";
		}
	?>
	<div class="contentItem">
		  <form action="" method="post" onsubmit="return validateFormLogIn();">
			  <div class="logInbox">
					<div class="formItem">
						  <div class="formLebelMandatory_logIn">Email </div>
						  <div class="formInput"> 
								<input type="text" class="inputThirty" id="email" name="email">
								<span id="errEmail" class="errorMessage_LI">please enter valid email</span>
						   </div>
					
					</div>

					<div class="formItem">
						  <div class="formLebelMandatory_logIn">Password </div>
						  <div class="formInput">
							  <input type="password" class="inputThirty" id="password" name="password">
							  <span id="errPassword" class="errorMessage_LI">please enter password</span>    
						  </div>
							  
					</div>

					<div class="formItem">
						  <div class="formLebel">&nbsp; </div>
						  <div class="formInput"> <input type="submit" value ="Submit" > </div>
					</div>                                      
			  </div>
			  <input type="hidden" name="form_name" value="login" />
		  </form>
		  
		  <script>hideErrorsLogIn();</script>
		  
	</div>
	
	
	<h3>Free Sign Up</h3>	
	
	<?php 
		
		if($error != "") {
			echo "<p class='error'>$error</p>";
		} else if($success != "") {
			echo "<p class='success'>$success</p>";
		}
	?>
	
	<div class="contentItem">
	  <form action="" method="post" onsubmit="return validateFormReg();">
		  <div class="userRegistration">
				<div class="formItem">
					  <div class="formLebelMandatory">First Name</div>
					  <div class="formInput"> 
						  <input type="text" class="inputThirty" id="firstName" name="firstName" maxlength="80">
						  <span id="errFirstName" class="errorMessage_CR">please enter first name</span>
					  </div>
				</div>

				<div class="formItem">
					  <div class="formLebelMandatory">Surname</div>
					  <div class="formInput"> 
						  <input type="text" class="inputThirty" id="surname" name="surname" maxlength="60" />
						  <span id="errSurname" class="errorMessage_CR">please enter surname</span>
					  </div>

				</div>


				<div class="formItem">
					  <div class="formLebelMandatory">Gender</div>
					  <div class="formInput"> 
						  <input type="radio" id="male" name="gender" value="1" checked />Male
						  <input type="radio" id="female" name="gender" value="0" />Female
					  </div>

				</div>
				<div class="formItem">
					  <div class="formLebelMandatory">Email Address</div>
					  <div class="formInput"> 
						  <input type="text" id="emailAddress" name="emailAddress" class="inputFourtyFive" maxlength="80" >
						  <span id="errEmailAddress" class="errorMessage_CR">please enter valid email address</span>
					  </div>
				</div>   
				<div class="formItem">
					  <div class="formLebelMandatory">Password</div>
					  <div class="formInput"> 
						  <input type="password" id="passwordReg" name="passwordReg" class="inputFourtyFive" maxlength="20" >
						  <span id="errPasswordReg" class="errorMessage_CR">please enter password</span>
					  </div>
				</div>   
						
				<div class="formItem">

					  <div class="formLebel">&nbsp; </div>
					  <div class="formInput"> <input type="submit" value ="Submit" > </div>
				</div>                                      
		  </div>
			  <input type="hidden" name="form_name" value="registration" />
		</form>
	  <script>hideErrorsReg();</script>
	  
</div>
	
	
</div>        
        
<?PHP
    require("bottom.php");
?>

