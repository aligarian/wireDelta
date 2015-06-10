<?php
session_start();
include 'inc/Form.php';
$formValidation = new FormValidation();
if($formValidation->isValid() == false){
	header('Location: wireDelta.php');
}
else{
	 echo json_encode($_POST);
}
