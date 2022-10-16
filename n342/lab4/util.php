
<?php
/**************
 Filename: util.php
 Written by: Ryan Eades (RE)
 Purpose: File where all the functions are stored for the user registration/activation website
 Date: 22 September 2020
 Modificaton History:
 09/21/2020: Deleted state, birth, year list generators and replaced it with a department list generator. Created codeChecker for verification of email activation codes (RE)

**********/






/* This function will generate a list of departments as a drop down list
*/
function deptOptionList()
{  	
	$list = '<option value="">- Department -</option>
													<option value="Athletics">Athletics</option>
                                                    <option value="Biochemistry and Molecular Biology">Biochemistry and Molecular Biology</option>
                                                    <option value="Biology">Biology</option>
                                                    <option value="Biomedical Engineering">Biomedical Engineering</option>
                                                    <option value="Chemistry and Chemical Biology">Chemistry and Chemical Biology</option>
                                                    <option value="Communication Studies">Communication Studies</option>
                                                    <option value="Computer and Information Sciences" selected>Computer and Information Sciences</option>
                                                    <option value="Computer Technology">Computer Technology</option>
                                                    <option value="Computer, Information, and Graphics Technology">Computer, Information, and Graphics Technology</option>
                                                    <option value="Dermatology">Dermatology</option>
                                                    <option value="Earth Sciences">Earth Sciences</option>
                                                    <option value="Economics">Economics</option>
                                                    <option value="Electrical and Computer Engineering">Electrical and Computer Engineering</option>
													<option value="Engineering Technology">Engineering Technology</option>
													<option value="English">English</option>
													<option value="Environmental Health and Safety">Environmental Health and Safety</option>
                                                    <option value="Geography">Geography</option>
                                                    <option value="Geology">Geology</option>
                                                    <option value="History">History</option>
                                                    <option value="Journalism and Public Relations">Journalism and Public Relations</option>
                                                    <option value="Mathematical Sciences">Mathematical Sciences</option>
                                                    <option value="Mechanical Engineering">Mechanical Engineering</option>
                                                    <option value="Medicine">Medicine</option>
                                                    <option value="Microbiology and Immunology">Microbiology and Immunology</option>
                                                    <option value="Nutrition and Dietetics">Nutrition and Dietetics</option>
                                                    <option value="Pharmacology and Toxicology">Pharmacology and Toxicology</option>
                                                    <option value="Philosophy">Philosophy</option>
                                                    <option value="Physical Education">Physical Education</option>
                                                    <option value="Physical Therapy">Physical Therapy</option>
                                                    <option value="Physics">Physics</option>
                                                    <option value="Political Science">Political Science</option>
                                                    <option value="Psychology">Psychology</option>
                                                    <option value="Sociology">Sociology</option>
                                                    <option value="Surgery">Surgery</option>
                                                    <option value="Technology Leadership and Communication">Technology Leadership and Communication</option>
                                                    <option value="Tourism, Conventions and Event Management">Tourism, Conventions and Event Management</option>
                                                    <option value="Manufacturing">Manufacturing</option>
                                                    <option value="World Languages and Cultures">World Languages and Cultures</option>';

	return $list;
}


/* This function generates a random code with letters and digits.
* The paramter tells the how long the code should be.
*/
function randomCodeGenerator($length){
          $code = "";
         for($i = 0; $i<$length; $i++){
             //generate a random number between 1 and 35
             $r = mt_rand(1,35);
             //if the number is greater than 26, minus 26 will generate a digit between 0 and 9
             if ($r > 26) {
                $r = $r - 26;
                $code = $code.$r ;
            }
             else {    //it's between 1 and 26, generate a character

                 $code = $code.toChar($r);
             }

         }
         return $code;

}

// This function will check to make sure that a code is of the right type
function codeChecker($code){
    $validity = true;
    $length=50;
    // if the code is over the length we created it to be, the code isn't valid
    if(strlen($code)!=$length){
        $validity=false;
        return $validity;
    }
    // if each value is not alphanumeric, it wasn't generated by codegenerator
    for($i=0;$i<$length;$i++){
        // stros checks if the ith character is in our list of valid characters
        if(strpos("ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789",$code[$i])===false){
            $validity = false;   
        }
    }

    return $validity;
}


function toChar($digit){
         $char = "";
         switch ($digit){
                case 1: $char = "A"; break;
                case 2: $char = "B"; break;
                case 3: $char = "C"; break;
                case 4: $char = "D"; break;
                case 5: $char = "E"; break;
                case 6: $char = "F"; break;
                case 7: $char = "G"; break;
                case 8: $char = "H"; break;
                case 9: $char = "I"; break;
                case 10: $char = "J"; break;
                case 11: $char = "K"; break;
                case 12: $char = "L"; break;
                case 13: $char = "M"; break;
                case 14: $char = "N"; break;
                case 15: $char = "O"; break;
                case 16: $char = "P"; break;
                case 17: $char = "Q"; break;
                case 18: $char = "R"; break;
                case 19: $char = "S"; break;
                case 20: $char = "T"; break;
                case 21: $char = "U"; break;
                case 22: $char = "V"; break;
                case 23: $char = "W"; break;
                case 24: $char = "X"; break;
                case 25: $char = "Y"; break;
                case 26: $char = "Z"; break;
                default: "A";

         }
         return $char;
}

/*This function prevents malicious users enter multiple email addresses into the email box
*It makes sure that only one email is entered into the email box.
*/
function spamcheck($field)
  {
  //filter_var() sanitizes the e-mail
  //address using FILTER_SANITIZE_EMAIL. It removes all illegal email characters
  $field=filter_var($field, FILTER_SANITIZE_EMAIL);

  //filter_var() validates the e-mail
  //address using FILTER_VALIDATE_EMAIL
  if(filter_var($field, FILTER_VALIDATE_EMAIL))
    {
    return TRUE;
    }
  else
    {
    return FALSE;
    }
  }

/*This function will validate if user created a strong password
* Longer than 10 characters and alphanumeric letters.
*/
function pwdValidate($field){
	$field = trim($field);
	if (strlen($field) < 10){
		return false;
	}
	else {
		//go through each character and find if there is a number or letter
		$letter = false;
		$number = false;
		$chars = str_split($field);
		for($i = 0; $i<strlen($field); $i++){
			if (preg_match("/[A-Za-z]/",$chars[$i])){
				$letter = true;
				break;
			}

		}

		for($i = 0; $i<strlen($field); $i++){
			if (preg_match("/[0-9]/",$chars[$i])){
				$number = true;
				break;
			}

		}
		if (($letter == true) and ($number == true)){
			return true;
		}
		else return false;
	}	
}





//This function will sanitize text input from the web form before inserting into the database
function sqlReplace($text){
 	 	
 	  $search = array(
    '@<script[^>]*?>.*?</script>@si',   // Strip out anything between the javascript tags
    '@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
    '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments
  );

    $text = preg_replace($search, '', $text);

    //the function below converts special characters to HTML entities, e.g. < becomes &lt;
    //read here about this function - http://php.net/manual/en/function.htmlspecialchars.php
    $text = htmlspecialchars($text, ENT_QUOTES);
        
  	return $text;
} 


?>