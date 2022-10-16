<?php
/***************************
 Filename: lab4registered.php
 Written by: Ryan Eades (RE)
 Purpose: Login page for the user to be directed to via the link in the account activation email.
 Date: 20 September 2020
 Modificaton History:
 09/20/2020: Made a copy of the original registration page from lab1. Deleted registration messages. Built forms for username and password.
09/22/2020: Created code that takes the activation code from the url and verifies it. Printed a message indicating invalidity if it failed the check. Otherwise, the login form is displayed to the user with a congratulatory message for succesfully registering.
10/05/2020: Changed the session variable calls to only call(via unserialization) a user object.
**************/
    include "header.php";
    include "user.php";
    require_once "util.php";
    session_start();
?>
	<body class="subpage">

		<!-- Header -->
			<header id="header">
				<a href="#menu">Menu</a>
			</header>

        <?php
            include "menu.php";
             // we're going to grab the code from the url and test to see if it is correct
        
            $code = $_GET['a'];
        
            //variables initialization
			$user1="";
			$user1=unserialize($_SESSION['user1']);
            
            // We now output our message
            $validity=codeChecker($code);
            $msg = $validity ? "Thanks for registering! You may now login." : "The attempted activation link is invalid."; 
            $style = $validity ? 'display: block' : 'display: none';
         
	    ?>
     
         

		<!-- Main -->
			<div id="main">
				<section class="wrapper style1">
				<div class="inner">
                <!-- Intro -->
                     <div class="row">
                            <section class="12u">
                                     <h2>Registration Successful!!</h2>
                                             <div class="12u$">Name:<? print $user1->getFirstName()." ".$user1->getLastName() ?></div>
                                             <div class="12u$">Email:<? print $user1->getEmail();?></div>
                                             <div class="12u$">Department:<? print $user1->getDepartment();?></div>
                                             <div class="12u$">Gender:<? print $user1->getGender();?></div>
                                             <div class="12u$">Status:<? print $user1->getStatus();?></div>      

                            </section>
                                            
                     </div>
                <!-- Intro -->
					<div class="row">
						<section class="12u">
							<h2>Login</h2>
							<p><?php
				                    print $msg;
		                      ?><p>
						</section>
					</div>

	<body class="subpage">

		<!-- Header -->
			<header id="header">
				<a href="#menu">Menu</a>
			</header>

        <?php
			include "menu.php";
		?>

		<!-- Main -->
                                <div id="main">
                                    <section class="wrapper style1">
                                    <div class="inner">
                                    


                                    </div>
                                    </section>
                                </div>

							<!-- Form -->

								<form method="post" action="process.php" style="display: <? print (($validity) ? 'block' : 'none')?>">
									<div class="row uniform">
										
										<div class="12u$">
											<input type="text" name="email" id="email" value="" placeholder="Username" required/>
										</div>
                                        
                                        <div class="12u$">
											<input type="password" name="pwd" id="pwd" value="" placeholder="Password" required/>
                                        </div>
                                     
										<div class="12u$">
											<ul class="actions">
												<li><input name = "enter" type="submit" value="Login" /></li>
												<li><input type="reset" value="Reset" class="alt" /></li>
											</ul>
										</div>
                                        <div class="12u$">
                                                 <a href="lab1.php">Register another user</a>
                                         </div>
									</div>
								</form>


				</div>
				</section>
			</div>

	</body>
</html>
