<?php
/***************************
 Filename: user.php
 Written by: Ryan Eades (RE)
 Purpose: User class. Every register will be an instance of this class. All attributes are kept private. Not storing passwords, but every other user generated input from the registration page is saved as an attribute
 Date: 04 October 2020
 Modificaton History:
 10/04/2020: Copied Professor Lu's cat class and changed the variables to . Modified getters,setters,constructors to handle the appropriate attributes of the user class
**************/

class User{

  private $firstName;
  private $lastName;
  private $email; 
  private $department;
  private $gender;
  private $status;
  //constructor of the object instance. All the contructors are formed by two underscores followed by the word "construct". Providing some default values if no function arguments are provided.
  function __construct($firstName="anonymous", $lastName = "anonymous", $email = "unknown",$department="department",$gender="gender",$status="status"){
    $this->setFirstName($firstName);
    $this->setLastName($lastName); 
    $this->setEmail($email);
    $this->setDepartment($department);
    $this->setGender($gender);
    $this->setStatus($status);
  } // end constructor

  function setfirstName($newFname){
    $this->firstName = $newFname;
  } // end setName

  function setlastName($newLname){
    $this->lastName = $newLname;
  } // end setSize
    
  function setEmail($newEmail){
    $this->email = $newEmail;
  } // end setSizefunction
    
  function setDepartment($newDept){
    $this->department = $newDepartment;
  } // end setDepartmentfunction  
    
  function setGender($newGender){
    $this->gender= $newGender;
  } // end setGenderfunction  
    
  function setStatus($newStatus){
    $this->status = $newStatus;
  } // end setStatusfunction 

  function getFirstName(){
	return $this->firstName;	
  } // end getFirstName

  function getLastName(){
    return $this->lastName;
  } // end getLastName

  function getEmail(){
    return $this->email;
  } // end getEmail
    
  function getDepartment(){
    return $this->lastName;
  } // end getDepartment

  function getGender(){
    return $this->gender;
  } // end getEmail

  function getStatus(){
    return $this->status;
  } // end getStatus

} // end Cat class

?>

