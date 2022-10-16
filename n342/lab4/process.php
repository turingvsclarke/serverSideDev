<?php session_start(); //this must be the very first line on the php page, to register this page to use session variables
      	$_SESSION['timeout'] = time();
	
	//if this is a page that requires login always perform this session verification
	require_once "inc/sessionVerify.php";

	require_once "dbconnect.php";

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="EN" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<?php session_start(); //this must be the very first line on the php page, to register this page to use session variables
      	$_SESSION['timeout'] = time();
	
	//if this is a page that requires login always perform this session verification
	require_once "inc/sessionVerify.php";

	require_once "dbconnect.php";

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="EN" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<title>Process Query Strings</title>
	<style type = "text/css">
  		h1, h2 {
    		text-align: center;
  		}

		table {
    		border-top: double;
    		border-bottom: double;
    		border-right: blank
		}

		td, th { border: 1px solid }
	</style>

	</head>

	<body>
		Session and Array Demo

		<br/><br/>

		<?php
			$fn = "";
			$ln = "";
			$gender = "";


			//retrieve all the information from the user from the database
			//retrieve all the information from the user from the database
			
			print "session email is ". $_SESSION['email'];

			$stmt = $con->prepare("select * from IN_CLASS_STUDENT where username = ?");
			$stmt->execute(array($_SESSION['Email']));
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			print " user name is ".$row["UserName"]. " and gender is ". $row["Gender"]. "<br />";

			

			
			
		?>
	
		</form>
		<br/><br/>
		<a href="logout.php">Log Out</a>

	</body>
</html>



