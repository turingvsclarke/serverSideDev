<?php
/**********************
 Filename: lab4.php
 Written by: Ryan Eades (RE)
 Purpose: User registration page
 Date: 15 September 2020
 Modificaton History:
 09/20/2020: Copied the lab1.php file. Made the following modifications:
1. Changed the password validation so the initial variables pwd and pwdcon are different. This ensures that a password must be entered in order for the validation(which compares the two) to be complete.
2. Changed the status forms due to index errors in lab1. Now status is a key for a status[] array in $_POST. This more easily ensures that one and only one status was selected by making sure the size of this array is 1.
09/22/2020: Created a tooltip for the password box, informing the user of password requirements. Implemented a pwd verification function from util.php to conform to desired password requirements. Tooltip is visible when the user clicks on the password box and goes invisible again if the user clicks elsewhere on the page. Used spam and sqlreplace to further strenghthen input validity.
10/04/2020: Used all inputs generated as attributes for a user object, which is stored as a session variable.
************************/

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

		?>
        <?
			//variables initialization
			$fn = "";
			$ln = "";
			$em = "";
            $emcon = "*";
            $pwd = "";
            $pwdcon = "*";
			$gender = "";
			$dept = "";
			$msg = "";
            $trmpol = "";
            $status = "*";

	

			if (isset($_POST['enter'])) //check if this page is requested after Submit button is clicked
			{
				
				//send information to a process file
			
				$fn = trim($_POST['firstname']); // trim gets rid of white space
				
				$ln = trim($_POST['lastname']);

				// filter and store email and email confirmation
				if ((filter_input(INPUT_POST, 'email',FILTER_VALIDATE_EMAIL))&&(filter_input(INPUT_POST, 'emcon',FILTER_VALIDATE_EMAIL))) {
                    
                        $em = trim($_POST['email']);
                        $emcon = trim($_POST['emcon']);
                }
                
                // filter and store password and password confirmation
                     
                $pwd = pwdValidate(trim($_POST['pwd']));
                $pwdcon = trim($_POST['pwdcon']);
                
         				
                // make sure a gender was checked and store the value
				if (isset($_POST['gender']))
				    $gender = trim($_POST['gender']);
		       
                if (isset($_POST['dept']))
                // get the value of the department
				    $dept = trim($_POST['dept']);
                
                // screen the status
                if (count($_POST['status'])==1)
                    $status = trim($_POST['status'][0]);
                    //  $status = trim($_POST['student']).trim($_POST['faculty']).trim($_POST['staff']);
                
                // make sure terms and policies has been checked
                if (isset($_POST['trmpol']))
					$trmpol = trim($_POST['trmpol']);
             	
                // flag name and email being invalid
                
				if (($fn=="") || ($ln=="") || ($em==""))				
				{	
					$msg = "<br /><span style=\"color:red\">Please enter a valid name and email</span><br />";
				}
                
                // flag emails not matching  
               
                else if ($em!=$emcon) 
                    $msg = "<br /><span style=\"color:red\">Emails do not match</span><br />";
                
                //flag pwds not matching
                
                else if ($pwd!=$pwdcon)
                    $msg = "<br /><span style=\"color:red\">Please enter valid passwords that match</span><br />";
                
                // check the status
                else if ($status=="*") {
                    
                    $msg = "<br /><span style=\"color:red\">Please select one status.</span><br />";   
                }
                
                
                // flag the terms and policies not being checked
                else if ($trmpol=="") {
                    
                    $msg = "<br /><span style=\"color:red\">You must accept the terms and policies.</span><br />";  
                }
                 
				else {
                    
                        $firstUser = new User($fn, $ln, $em, $dept,$gender,$status);
                        $_SESSION['user1']=serialize($firstUser);
                              
					//direct to another file to process using query strings
					Header ("Location:lab4mail.php") ;			
				}
			}
		?>
         

		<!-- Main -->
			<div id="main">
				<section class="wrapper style1">
				<div class="inner">
                <!-- Intro -->
					<div class="row">
						<section class="12u">
							<h2>User Registration</h2>
							<p><?php
				                    print $msg;
		                      ?><p>
						</section>
					</div>


							<!-- Form -->

								<form method="post" action="#">
									<div class="row uniform">
										<div class="6u 12u$(xsmall)">
											<input type="text" name="firstname" id="firstname" value="" placeholder="First Name" required/>
										</div>
                                        <div class="6u 12u$(xsmall)">
											<input type="text" name="lastname" id="lastname" value="" placeholder="Last Name" required/>
										</div>
										<div class="12u$">
											<input type="email" name="email" id="email" value="" placeholder="Email" required/>
										</div>
                                        <div class="12u$">
											<input type="email" name="emcon" id="emcon" value="" placeholder="Email Confirmation" required/>
                                        </div>
                                        <div class="12u$">
											<input type="password" name="pwd" id="pwd" value="" placeholder="Password" required/>
                                        </div>
                                   
                                        <div class="tooltip" id = "pwdReq" style="display:none">
                                                <ul id="reqs" class="tooltiptext"><label for="reqs">Password Requirements</label>
                                                    <li>One number</li>
                                                    <li>One letter</li>
                                                    <li>At least 10 characters</li>
                                                </ul>

                                            
                                        </div>
                                        <script>
                                        document.onclick = e => {
                                          var id = e.target.id;
                                          console.log(id);
                                          if (id!=="pwd")
                                                document.getElementById("pwdReq").style.display = "none";

                                          else 
                                                document.getElementById("pwdReq").style.display = "block";

                                        }
                                        </script>
                                        <div class="12u$">
											<input type="password" name="pwdcon" id="pwdcon" value="" placeholder="Password Confirmation" required/>
										</div>
										<!-- Break -->
										<div class="12u$">
											<div class="select-wrapper">
												<select  name = "dept" checked>
				                                        <?php print deptOptionList(); ?>
			                                    </select>
											</div>
										</div>
										<!-- Break -->
                                        <div class= "12u$">
                                            <fieldset>
                                                <legend>Gender:</legend>
                                               <div class="4u 12u$(small)">
                                                    <input type="radio" id="male" name="gender" value = "Male">
                                                    <label for="male">Male</label>
                                                </div>
                                                <div class="4u$ 12u$(small)">
											         <input type="radio" id="female" name="gender" value = "Female" checked>
											         <label for="female">Female</label>
                                                </div>
                                            </fieldset>
										</div>
										<!-- Break -->
										
                                        <div class ="12u$">
                                            <fieldset data-role="controlgroup" data-type="horizontal">
                                                <legend>Status:</legend>
                                               
                                                    <input type="checkbox" id="student" name = "status[]" value="Student">
											        <label for="student">Student</label>
                                              
                                               
                                                    <input type="checkbox" id = "faculty" name="status[]" value="Faculty">
											        <label for="faculty">Faculty</label>
                                              
                                                
                                                    <input type="checkbox" id="staff" name="status[]" value="Staff">
											        <label for="staff">Staff</label>
                                                                                        
                                            </fieldset>
										</div>
                                        <div class="12u$">
											<input type="checkbox" id = "trmpol" name = "trmpol" value = "trmpol" required>
											<label for="trmpol">I have read and accept the terms and policies</label>
										</div>
										<!-- Break -->
										<div class="12u$">
											<ul class="actions">
												<li><input name = "enter" type="submit" value="Register" /></li>
												<li><input type="reset" value="Reset" class="alt" /></li>
											</ul>
										</div>
									</div>
								</form>


				</div>
				</section>
			</div>

	</body>
</html>
