<?php
session_start();
include 'inc/Form.php';
$oFormHandler = new Form();
$aCreate = array('name' => 'formAdd', 'action'=>'formAction.php', 'method'=>'post', 'id'=>'formAdd');
echo $oFormHandler->form_start($aCreate);
$aInput = array('name'=>'username', 'required'=>'true', 'id'=>'username');
$aInputValidation = array(
							array('required'=>'true','message'=>'Please, enter the value.'), 
							array('minLength'=>'6','message'=>'Character should be more then 6.'),
							array('maxLength'=>'9','message'=>'Character should be less then 6 9.')
						);
echo $oFormHandler->form_label('Username :', array('for'=>'username'));
echo $oFormHandler->form_input($aInput, $aInputValidation,'onclick="javascript:hello();"');
echo '<br>';

$aInput = array('name'=>'password', 'required'=>'true', 'id'=>'password');
$aInputValidation = array(
							array('required'=>'true','message'=>'Please, enter the value.'), 
						);
echo $oFormHandler->form_label('Password :', array('for'=>'username'));
echo $oFormHandler->form_password($aInput, $aInputValidation,'onclick="javascript:hello();"');
echo '<br>';
$aInput = array('name'=>'passwordWith', 'required'=>'true', 'id'=>'passwordWith');
$aInputValidation = array(
							array('required'=>'true','message'=>'Please, enter the value.'), 
							array('equalTo'=>'password', 'message'=>'Value should be equal to password.'),
						);
echo $oFormHandler->form_label('Confirm Password:', array('for'=>'compareWith'));
echo $oFormHandler->form_password($aInput, $aInputValidation,'onclick="javascript:hello();"');
echo '<br>';

$aInput = array('name'=>'useremail', 'required'=>'true', 'id'=>'useremail');
$aInputValidation = array(
							array('required'=>'true','message'=>'Please, enter the value.'), 
							array('email'=>'true'),
						);
echo $oFormHandler->form_label('Useremail :', array('for'=>'useremail'));
echo $oFormHandler->form_input($aInput, $aInputValidation);
echo '<br>';

$aInput = array('name'=>'userWebsite', 'required'=>'true', 'id'=>'userWebsite');
$aInputValidation = array(
							array('required'=>'true','message'=>'Please, enter the value.'), 
							array('url'=>'true'),
						);
echo $oFormHandler->form_label('User website link :', array('for'=>'userWebsite'));
echo $oFormHandler->form_input($aInput, $aInputValidation);
echo '<br>';

echo $oFormHandler->form_label('Textarea :',array('for'=>'Text'));
$aTextareaValidation = array(
							array('required'=>'true','message'=>'Please, enter the value.'), 
							array('minLength'=>'6','message'=>'Content character should be more then 6.'),
							array('maxLength'=>'9','message'=>'Content character should be less then 9.')
						);
echo $oFormHandler->form_textarea(array('name'=>'Textarea', 'id'=>'Text'), $aTextareaValidation,'onclick="javascript:hello();"');
echo "<br>";
echo $oFormHandler->form_label('Dropdown List :', array('for'=>'select'));
$aSelect = array('name'=>'dropdown', 'id'=>'select');
$aSelectList = array('value1'=>'a','value2'=>'b','value3'=>'c');
echo $oFormHandler->form_dropdown($aSelect,$aSelectList,'value2');
echo '<br>';
echo $oFormHandler->form_label('Check Box 1 :',array('for'=>'Checkbox1'));
$aCheckBox = array('name' => 'check1', 'value'=>'hello1', 'id'=>'Checkbox1');
echo $oFormHandler->form_checkbox($aCheckBox);
echo $oFormHandler->form_label('Check Box 2 :',array('for'=>'Checkbox2'));
$aCheckBox = array('name' => 'check2', 'value'=>'hello2', 'id'=>'Checkbox2');
echo $oFormHandler->form_checkbox($aCheckBox);
echo '<br>';
$aRadio = array('name' => 'radio', 'value'=>'hello1');
echo $oFormHandler->form_label('Radio Box 1 :',array('for'=>'Radiobox1'));
echo $oFormHandler->form_radio($aRadio);
$aRadio = array('name' => 'radio', 'value'=>'hello2');
echo $oFormHandler->form_label('Radio Box 2 :',array('for'=>'Radiobox2'));
echo $oFormHandler->form_radio($aRadio);
echo '<br>';
$aButton = array('content'=>'Reset');
$sOptions ='onclick="javascript:document.getElementById(\'formAdd\').reset();"';
echo $oFormHandler->form_button($aButton, $sOptions);
echo '<br>';
echo $oFormHandler->form_submit();
$oFormHandler->form_end();
