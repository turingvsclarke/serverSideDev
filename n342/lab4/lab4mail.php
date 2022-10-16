<?php
/**********************

 Filename: lab3mail.php
 Written by: Ryan Eades (RE)
 Purpose: User registration directs here and it alerts the user that an activation email has been sent to them.
 Date: 15 September 2020
 Modificaton History:
 09/20/2020: Copied the original lab1 registration file. Removed all the information about them posted. Created a simple message displaying their name and the email the activation link was sent to.
09/21/2020: Used the inbuilt mail() function along with session variables from the registration page to send a personalized message with an activation url containing a randomly generated code.
************************/

	include "header.php";
    session_start();


?>

	<body class="subpage">

		<!-- Header -->
			<header id="header">
				<a href="#menu">Menu</a>
			</header>

<?php

			include "menu.php";
            require_once "util.php";
            include "header.php";

			//variables initialization
			$fn = "";
			$ln = "";
			$em = "";
			$gender = "";
			$dept = "";	
            $status = "";

			
			$fn = $_SESSION['firstname'];
            $ln = $_SESSION['lastname'];
            $em = $_SESSION['email'];
            $dept = $_SESSION['dept'];
            $gender = $_SESSION['gender'];
            $status = $_SESSION['status'];


            // generate the code
            $code=randomCodeGenerator(50);

            $message = $fn." ".$ln.", \n We recently received a request for a new user using this email address. Please use the following link for account activation:http://corsair.cs.iupui.edu:24331/lab4/lab4registered.php?a=".$code;
            $message = wordwrap($message,70);
            mail($em,"User Activation Link",$message);
?>                
		<!-- Main -->
			<div id="main">
				<section class="wrapper style1">
				<div class="inner">
                <!-- Intro -->
					<div class="row">
						<section class="12u">
							<h2><? print "Thank you for registering, ".$fn." ".$ln.". An activation email has been sent to "."$em"."."?></h2>
                             
                         
						</section>
                	</div>


				</div>
				</section>
			</div>

	</body>
</html>






