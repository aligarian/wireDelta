<?php
/**
 * PHP form class
 * 
 * This class generate the form elements.
 * Here is an example with single input field:
 * <code>
 * <?php
 * session_start();
 * include 'inc/Form.php';
 * $oFormHandler = new Form();
 * $aCreate = array('name' => 'formAdd', 'action'=>'formAction.php', 'method'=>'post');
 * echo $oFormHandler->form_start($aCreate);
 * $aInput = array('name'=>'username', 'id'=>'username');
 * $aInputValidation = array(
 * 							array('required'=>'true','message'=>'Please, enter the value.'), 
 * 						);
 * echo $oFormHandler->form_label('Username :', array('for'=>'username'));
 * echo $oFormHandler->form_input($aInput, $aInputValidation,'onclick="javascript:hello();"');
 * echo '<br>';
 * echo $oFormHandler->form_submit();
 * $oFormHandler->form_end();
 * ?>
 * </code>
 * a complete example link is {@link http://localhost/wireDelta.php is here}
 * @author Ammar Khan <ammar.hayder@gmail.com>
 * @version 1.0
 * @package Form
 */
class Form{
	public $aSessValidations, $aValidationErr, $aPostParams;
	/**
	 * A constructor function - intialize the class object.
	 * set @aValidationErr, $aPostParams form session and unset session
	 */
	function __construct(){
		if(isset($_SESSION['validationError']) && isset($_SESSION['postParams'])){
			$this->aValidationErr = $_SESSION['validationError'];
			$this->aPostParams = $_SESSION['postParams'];
		}
		else
		{
			$this->aValidationErr = array();
		}
		unset($_SESSION['validationError']);
		unset($_SESSION['postParams']);
	}
	/**
	 * A form_start
	 *  {@link http://localhost/wireDelta.php example}
	 * @param array $aAttributes associative array of form attributes
	 * @param string $sOptions with simple string
	 * @return string
	 * 
	 */
	
	function form_start($aAttributes = array(), $sOptions =""){
		$sFormHtml = '<form ';
		foreach ($aAttributes as $key => $value) {
			$sFormHtml .= $key.'="'.$value.'" ';
		}
		$sFormHtml .= $sOptions.'>';
		return $sFormHtml;
	}
	/**
	 * A form_label create a form element lable
	 * @param string $sLabelHtml with simple string
	 * @param array $aAttributes with all valid label attributes
	 * @return string
	 */
	function form_label($sLabelHtml ="",$aAttributes= array()){
		$sLabel = '<label ';
		foreach ($aAttributes as $key => $value) {
			$sLabel .= $key.'="'.$value.'"';
		}
		$sLabel .= '>'. $sLabelHtml .'</label>';
		return $sLabel;
	}
	/**
	 * A form_input generate a standard text input field. 
	 * @param array $aAttributes associate array of input attributes
	 * @param array $aValidations with all validation attributes
	 * @param string $sOptions with simple string
	 * @return string
	 */
	function form_input($aAttributes= array(), $aValidations= array(), $sOptions=""){
		$sInput = '<input type="text"';
		foreach ($aAttributes as $key => $value) {
			$sInput .= $key.'=\''.$value.'\' ';
			if(count($this->aPostParams)){
				$sInput .= 'value=\''.$this->aPostParams[$aAttributes['name']].'\'';
			}
		}
		if(count($aValidations) > 0){
			$this->aSessValidations[$aAttributes['name']] = $aValidations;
		}
		$sInput .= $sOptions.' />';
		if(array_key_exists($aAttributes['name'], $this->aValidationErr)){
			$sInput .= '<span class="'.$aAttributes['name'].'_error">'.$this->aValidationErr[$aAttributes['name']][0].'</span>';
		}
		return $sInput;
	}
	/**
	 * A form_password is identical in all respects to the form_input() 
	 * function above except that is sets it as a "password" type.
	 * @param array $aAttributes with input attributes
	 * @param array $aValidations with all validation attributes
	 * @param string $sOptions with simple string
	 * @return string
	 */
	function form_password($aAttributes= array(), $aValidations= array(), $sOptions=""){
		$sInput = '<input type="password"';
		foreach ($aAttributes as $key => $value) {
			$sInput .= $key.'=\''.$value.'\' ';
			if(count($this->aPostParams)){
				$sInput .= 'value=\''.$this->aPostParams[$aAttributes['name']].'\'';
			}
		}
		if(count($aValidations) > 0){
			$this->aSessValidations[$aAttributes['name']] = $aValidations;
		}
		$sInput .= $sOptions.' />';
		if(array_key_exists($aAttributes['name'], $this->aValidationErr)){
			$sInput .= '<span class="'.$aAttributes['name'].'_error">'.$this->aValidationErr[$aAttributes['name']][0].'</span>';
		}
		return $sInput;
	}
	/**
	 * A form_hidden is identical in all respects to the form_input() 
	 * function above except that is sets it as a "hidden" type.
	 * @param array $aAttributes with input attributes
	 * @param array $aValidations with all validation attributes
	 * @param string $sOptions with simple string
	 * @return string
	 */
	function form_hidden($aAttributes= array(), $aValidations= array(), $sOptions=""){
		$sInput = '<input type="hidden"';
		foreach ($aAttributes as $key => $value) {
			$sInput .= $key.'=\''.$value.'\' ';
			if(count($this->aPostParams)){
				$sInput .= 'value=\''.$this->aPostParams[$aAttributes['name']].'\'';
			}
		}
		if(count($aValidations) > 0){
			$this->aSessValidations[$aAttributes['name']] = $aValidations;
		}
		$sInput .= $sOptions.' />';
		if(array_key_exists($aAttributes['name'], $this->aValidationErr)){
			$sInput .= '<span class="'.$aAttributes['name'].'_error">'.$this->aValidationErr[$aAttributes['name']][0].'</span>';
		}
		return $sInput;
	}
	/**
	 * A form_textarea is identical in all respects to the form_input()  
	 * function above except that it generates a "textarea" type.
	 * @param array $aAttributes textarea field attributes
	 * @param array $aValidations with all validation attributes
	 * @param string $sOptions with simple string
	 * @return string
	 */
	function form_textarea($aAttributes= array(), $aValidations= array(), $sOptions =""){
		$sTextarea = '<textarea ';
		foreach ($aAttributes as $key => $value) {
			$sTextarea .= $key.'=\''.$value.'\' ';
			
		}
		$sTextarea .= $sOptions.' >';
		if(count($aValidations) > 0){
			$this->aSessValidations[$aAttributes['name']] = $aValidations;
		}
		if(count($this->aPostParams)){
				$sTextarea .= $this->aPostParams[$aAttributes['name']];
			}
		$sTextarea .= '</textarea>';
		if(array_key_exists($aAttributes['name'], $this->aValidationErr)){
			$sTextarea .= '<span class="'.$aAttributes['name'].'_error">'.$this->aValidationErr[$aAttributes['name']][0].'</span>';
		}
		return $sTextarea;
	}
	/**
	 * form_dropdown creates a standard drop-down field.
	 * Here is copy paste example code
	 * <code>
	 *	echo $oFormHandler->form_label('Dropdown List :', array('for'=>'select'));
	 *	$aSelect = array('name'=>'dropdown', 'id'=>'select');
	 *	$aSelectList = array('value1'=>'a','value2'=>'b','value3'=>'c');
	 *	echo $oFormHandler->form_dropdown($aSelect,$aSelectList,'value1');
	 * </code> 
	 * @param array $aAttributes with select field attributes
	 * @param array $aDropdownList associative or plain array of options
	 * @param string $sSelectedOption the value you wish to be selected
	 * @param array $aValidations with all validation attributes
	 * @param string $sOptions with simple string
	 * @return string
	 */
	function form_dropdown($aAttributes= array(),$aDropdownList= array(), $sSelectedOption="", $aValidations= array(), $sOptions =""){
		$sSelect = '<select ';
		foreach ($aAttributes as $key => $value) {
			$sSelect .= $key.'="'.$value.'" ';
		}
		$sSelect .= $sOptions.'>';
		foreach ($aDropdownList as $key => $value) {
			if((count($this->aPostParams) && $this->aPostParams[$aAttributes['name']] == $key) || $sSelectedOption == $key){
				$sSelect .='<option value="'.$key.'" selected>'.$value.'</option>';
			}
			else{
				$sSelect .='<option value="'.$key.'">'.$value.'</option>';
			}
		}
		$sSelect .= '</select>';
		return $sSelect;
	}
	/**
	 * form_checkbox creates a standard checkbox field.
	 * function above except that it generates a "checkbox" type.
	 * Here is copy paste example code
	 * <code>
	 * echo $oFormHandler->form_label('Check Box 1 :',array('for'=>'Checkbox1'));
	 * $aCheckBox = array('name' => 'check1', 'value'=>'hello1', 'id'=>'Checkbox1');
	 * echo $oFormHandler->form_checkbox($aCheckBox);
	 * echo $oFormHandler->form_label('Check Box 2 :',array('for'=>'Checkbox2'));
	 * $aCheckBox = array('name' => 'check2', 'value'=>'hello2', 'id'=>'Checkbox2');
	 * echo $oFormHandler->form_checkbox($aCheckBox);
	 * </code>
	 * @param array $aAttributes associate array of checkbox attributes
	 * @param array $aValidations with all validation attributes
	 * @param string $sOptions with simple string
	 * @return string
	 */
	function form_checkbox($aAttributes= array(), $aValidations= array(), $sOptions=""){
		$sInput = '<input type="checkbox" ';
		//print_r($aAttributes);
		foreach ($aAttributes as $key => $value) {
			$sInput .= $key.'=\''.$value.'\' ';
			if(isset($this->aPostParams[rtrim($aAttributes['name'],'[]')]) &&
				is_array($this->aPostParams[rtrim($aAttributes['name'],'[]')]) && 
				in_array($value, $this->aPostParams[rtrim($aAttributes['name'],'[]')])
				){
					$sInput .= 'checked ';
				}
			if(count($this->aPostParams) > 0 && isset($this->aPostParams[$aAttributes['name']]) && $this->aPostParams[$aAttributes['name']] == $value){
				$sInput .= 'checked ';
			}
		}
		if(count($aValidations) > 0){
			$this->aSessValidations[$aAttributes['name']] = $aValidations;
		}
		$sInput .= $sOptions.' />';
		if(array_key_exists($aAttributes['name'], $this->aValidationErr)){
			$sInput .= '<span class="'.$aAttributes['name'].'_error">'.$this->aValidationErr[$aAttributes['name']][0].'</span>';
		}
		return $sInput;
	}
	/**
	 * form_radio creates a standard radio field.
	 * function above except that it generates a "radio" type.
	 * Here is copy paste example code
	 * <code>
	 * $aRadio = array('name' => 'radio', 'value'=>'hello1');
	 * echo $oFormHandler->form_label('Radio Box 1 :',array('for'=>'Radiobox1'));
	 * echo $oFormHandler->form_radio($aRadio);
	 * $aRadio = array('name' => 'radio', 'value'=>'hello2');
	 * echo $oFormHandler->form_label('Radio Box 2 :',array('for'=>'Radiobox2'));
	 * echo $oFormHandler->form_radio($aRadio);
	 * </code>
	 * @param array $aAttributes textarea field attributes
	 * @param array $aValidations with all validation attributes
	 * @param string $sOptions with simple string
	 * @return string
	 */
	function form_radio($aAttributes= array(), $aValidations= array(), $sOptions=""){
		$sRadio = '<input type="radio" ';
		//print_r($aAttributes);
		foreach ($aAttributes as $key => $value) {
			$sRadio .= $key.'=\''.$value.'\' ';
			if(isset($this->aPostParams[rtrim($aAttributes['name'],'[]')]) &&
				is_array($this->aPostParams[rtrim($aAttributes['name'],'[]')]) && 
				in_array($value, $this->aPostParams[rtrim($aAttributes['name'],'[]')])
				){
					$sRadio .= 'checked ';
				}
			if(count($this->aPostParams) > 0 && isset($this->aPostParams[$aAttributes['name']]) && $this->aPostParams[$aAttributes['name']] == $value){
				$sRadio .= 'checked ';
			}
		}
		if(count($aValidations) > 0){
			$this->aSessValidations[$aAttributes['name']] = $aValidations;
		}
		$sRadio .= $sOptions.' />';
		if(array_key_exists($aAttributes['name'], $this->aValidationErr)){
			$sRadio .= '<span class="'.$aAttributes['name'].'_error">'.$this->aValidationErr[$aAttributes['name']][0].'</span>';
		}
		return $sRadio;
	}
	/**
	 * form_button creates a standard button element.
	 * Here is copy paste example code
	 * <code>
	 * $aButton = array('content'=>'Reset');
     * $sOptions ='onclick="javascript:document.getElementById(\'formAdd\').reset();"';
	 * echo $oFormHandler->form_button($aButton, $sOptions);
	 * </code>
	 * @param array $aAttributes associate array of button attributes
	 * @param string $sOptions a optional string.
	 * @return string
	 */
	function form_button($aAttributes= array(), $sOptions=""){
		$sButton = '<button ';
		foreach ($aAttributes as $key => $value) {
			if($key != 'content' && $key != 'name')
				$sButton .= $key.'="'.$value.'" ';
		}
		$sButton .= stripslashes($sOptions).'>'.$aAttributes['content'].'</button>';
		return $sButton;
	}
	/**
	 * form_button creates a standard button element.
	 * Here is copy paste code
	 * <code>
	 * echo $oFormHandler->form_submit();
	 * </code>
	 * @param array $aAttributes associate array of input field attributes
	 * @param string $sOptions a optional string.
	 * @return string
	 */
	function form_submit($aAttributes = array(), $sOptions= ""){
		$sButton = '<input type="submit" ';
		foreach ($aAttributes as $key => $value) {
			$sButton .= $key.'="'.$value.'" ';
		}
		$sButton .= $sOptions. '/>';
		return $sButton;
	}

	/**
	 * form_end close the form and set validation array to session.
	 * @return string
	 */
	function form_end(){
		$_SESSION['validation'] = $this->aSessValidations;
		return '</form>';
	}

}

/**
 * PHP form validation class
 * 
 * This class validate the form elements. To validate call the isValid in form action file 
 * e.g 
 *<code>
 *  session_start();
 * include 'inc/Form.php';
 * $formValidation = new FormValidation();
 * if($formValidation->isValid() == false){
 * 	header('Location: wireDelta.php');
 * }
 * else{
 * 	 echo json_encode($_POST);
 * }
 * </code>
 * @author Ammar Khan <ammar.hayder@gmail.com>
 * @version 1.0
 * @package FormValidation
 */
class FormValidation{
	public $aFormValidators, $aParams, $aErr;
	/**
	 * A constructor function - execute after object is create 
	 * and put the object in valid state.
	 * set @aFormValidators from session and , $aParams from $_POST 
	 */
	public function __construct(){
		$this->aFormValidators = $_SESSION['validation'];
		$this->aParams = $_POST;
	}
	/**
	 * isValid function validate the form.
	 * @return true or false
	 */
	public function isValid(){
		foreach ($this->aParams as $paramKey => $paramValue) {
			if(array_key_exists($paramKey, $this->aFormValidators)){
				foreach ($this->aFormValidators[$paramKey] as $validateKey => $validateValue) {

					if(array_key_exists('required', $validateValue) && $validateValue['required'] == 'true'){
						if($paramValue == ""){
							($validateValue['message'])?$this->aErr[$paramKey][] = $validateValue['message']:'Please, Enter the value.';
						}
					}
					if(array_key_exists('minLength', $validateValue)){
						$this->minLength($paramKey, $paramValue, $validateValue);
					}
					if(array_key_exists('maxLength', $validateValue)){
						$this->maxLength($paramKey, $paramValue, $validateValue);
					}
					if(array_key_exists('number', $validateValue) &&  $validateValue['number'] == 'true'){
						$this->onlyNumber($paramKey, $paramValue, $validateValue);
					}
					if(array_key_exists('minValue', $validateValue)){
						$this->minValue($paramKey, $paramValue, $validateValue);
					}
					if(array_key_exists('maxValue', $validateValue)){
						$this->maxValue($paramKey, $paramValue, $validateValue);
					}
					if(array_key_exists('email', $validateValue) && $validateValue['email'] == 'true'){
						$this->validEmail($paramKey, $paramValue, $validateValue);
					}
					if(array_key_exists('url', $validateValue) && $validateValue['url'] == 'true'){
						$this->validURL($paramKey, $paramValue, $validateValue);
					}
					if(array_key_exists('equalTo', $validateValue) ){
						$this->equalTo($paramKey, $paramValue, $validateValue);
					}
				}
			}
		}
		if(count($this->aErr) >0 ){
			$_SESSION['postParams'] = $this->aParams;
			$_SESSION['validationError'] = $this->aErr;
			return false; 
		}
		else{
			$_SESSION['validationError'] = array();
			return true;
		}
		
	}
	/**
	 * minLength validate the minimum length of character.
	 * Here is copy paste code
	 *<code>
	 * $aInput = array('name'=>'username', 'required'=>'true', 'id'=>'username');
	 * $aInputValidation = array(
	 *                           array('required'=>'true','message'=>'Please, enter the value.'), 
	 *                           array('minLength'=>'6','message'=>'Character should be more then 6.'),
	 *                           array('maxLength'=>'9','message'=>'Character should be less then 6 9.')
	 *						);
	 * echo $oFormHandler->form_label('Username :', array('for'=>'username'));
	 * echo $oFormHandler->form_input($aInput, $aInputValidation,'onclick="javascript:hello();"');
	 *</code>
	 * @param string $key name of post params to be validate 
	 * @param string $value of post params to be validate 
	 * @param string $validation is value of validation minLength i.e character length
	 * @return string
	 */
	function minLength($key, $value, $validation){
		if(strlen($value) < $validation['minLength'])
			($validation['message'])?$this->aErr[$key][] = $validation['message']:$this->aErr[$key][]='Please, Length should be '.$validation['minLength'].' character long.';
	}
	/**
	 * maxLength validate the maximum character length of string.
	 * Here is copy paste code
	 *<code>
	 * $aInput = array('name'=>'username', 'required'=>'true', 'id'=>'username');
	 * $aInputValidation = array(
	 *                           array('required'=>'true','message'=>'Please, enter the value.'), 
	 *                           array('minLength'=>'6','message'=>'Character should be more then 6.'),
	 *                           array('maxLength'=>'9','message'=>'Character should be less then 6 9.')
	 *						);
	 * echo $oFormHandler->form_label('Username :', array('for'=>'username'));
	 * echo $oFormHandler->form_input($aInput, $aInputValidation,'onclick="javascript:hello();"');
	 *</code>
	 * @param string $key name of post params to be validate 
	 * @param string $value of post params to be validate 
	 * @param string $validation is value of validation maxLength i.e character length
	 * @return string
	 */
	function maxLength($key, $value, $validation){
		if(strlen($value) >= $validation['maxLength'])
			($validation['message'])?$this->aErr[$key][] = $validation['message']:$this->aErr[$key][]='Please, Length should be less then '.$validation['maxLength'].' character.';
	}
	function onlyNumber($key, $value, $validation){
		if(!is_numeric($value)){
			isset($validation['message'])?$this->aErr[$key][] = $validation['message']:$this->aErr[$key][]='Please, Enter number only.';
		}
	}
	/**
	 * minValue validate the minimum value of number.
	 * Here is copy paste code
	 *<code>
	 * $aInput = array('name'=>'age', 'required'=>'true', 'id'=>'userAge');
	 * $aInputValidation = array(
	 *                           array('required'=>'true','message'=>'Please, enter the value.'), 
	 *							 array('number'=>'true'),
	 *                           array('minValue'=>'6','message'=>'Character should be more then 6.'),
	 *                           array('maxValue'=>'100','message'=>'Character should be less then 9.')
	 *						);
	 * echo $oFormHandler->form_label('Age :', array('for'=>'userAge'));
	 * echo $oFormHandler->form_input($aInput, $aInputValidation,'onclick="javascript:hello();"');
	 *</code>
	 * @param string $key name of post params to be validate 
	 * @param string $value of post params to be validate 
	 * @param string $validation is value of validation minValue i.e number value
	 * @return string
	 */
	function minValue($key, $value, $validation){
		if($value < $validation['minValue'])
			($validation['message'])?$this->aErr[$key][] = $validation['message']:$this->aErr[$key][]='Please, Enter value more then '.$validation['minValue'].'.';
	}
	/**
	 * maxValue validate the number value.
	 * Here is copy paste code
	 *<code>
	 * $aInput = array('name'=>'age', 'required'=>'true', 'id'=>'userAge');
	 * $aInputValidation = array(
	 *                           array('required'=>'true','message'=>'Please, enter the value.'), 
	 *							 array('number'=>'true'),
	 *                           array('minValue'=>'6','message'=>'Character should be more then 6.'),
	 *                           array('maxValue'=>'100','message'=>'Character should be less then 9.')
	 *						);
	 * echo $oFormHandler->form_label('Age :', array('for'=>'userAge'));
	 * echo $oFormHandler->form_input($aInput, $aInputValidation,'onclick="javascript:hello();"');
	 *</code>
	 * @param string $key name of post params to be validate 
	 * @param string $value of post params to be validate 
	 * @param string $validation is value of validation maxValue i.e number value
	 * @return string
	 */
	function maxValue($key, $value, $validation){
		if($value > $validation['maxValue'])
			($validation['message'])?$this->aErr[$key][] = $validation['message']:$this->aErr[$key][]='Please, Enter value less then '.$validation['maxValue'].'.';
	}
	/**
	 * email validate the email.
	 * Here is copy paste code
	 *<code>
	 * $aInput = array('name'=>'useremail', 'required'=>'true', 'id'=>'useremail');
     * $aInputValidation = array(
     * 							array('required'=>'true','message'=>'Please, enter the value.'), 
     * 							array('email'=>'true'),
     * 						);
     * echo $oFormHandler->form_label('Useremail :', array('for'=>'useremail'));
     * echo $oFormHandler->form_input($aInput, $aInputValidation);
	 *</code>
	 * @param string $key name of post params to be validate 
	 * @param string $value of post params to be validate 
	 * @param string $validation is value of validation email.
	 * @return string
	 */
	function validEmail($key, $value, $validation){
		if (!filter_var($value, FILTER_VALIDATE_EMAIL))
			($validation['message'])?$this->aErr[$key][] = $validation['message']:$this->aErr[$key][]='Please, Enter valid email.';
	}
	/**
	 * email validate the email.
	 * Here is copy paste code
	 *<code>
     * $aInput = array('name'=>'userWebsite', 'required'=>'true', 'id'=>'userWebsite');
     * $aInputValidation = array(
     * 							array('required'=>'true','message'=>'Please, enter the value.'), 
     * 							array('url'=>'true'),
     * 						);
     * echo $oFormHandler->form_label('User website link :', array('for'=>'userWebsite'));
     * echo $oFormHandler->form_input($aInput, $aInputValidation);
	 *</code>
	 * @param string $key name of post params to be validate 
	 * @param string $value of post params to be validate 
	 * @param string $validation is value of validation email.
	 * @return string
	 */
	function validURL($key, $value, $validation){
		if (!filter_var($value, FILTER_VALIDATE_URL)) 
			($validation['message'])?$this->aErr[$key][] = $validation['message']:$this->aErr[$key][]='Please, Enter valid URL.';
	}
	/**
	 * equalTo compare the element value with another one.
	 * Here is copy paste code
	 *<code>
	 * $aInput = array('name'=>'password', 'required'=>'true', 'id'=>'password');
	*$aInputValidation = array(
	*							array('required'=>'true','message'=>'Please, enter the value.'), 
	*						);
	*echo $oFormHandler->form_label('Password :', array('for'=>'username'));
	*echo $oFormHandler->form_password($aInput, $aInputValidation,'onclick="javascript:hello();"');
	*echo '<br>';
	*$aInput = array('name'=>'passwordWith', 'required'=>'true', 'id'=>'passwordWith');
	*$aInputValidation = array(
	*							array('required'=>'true','message'=>'Please, enter the value.'), 
	*							array('equalTo'=>'password', 'message'=>'Value should be equal to password.')*,
	*						);
	*echo $oFormHandler->form_label('Confirm Password:', array('for'=>'compareWith'));
	*echo $oFormHandler->form_password($aInput, $aInputValidation,'onclick="javascript:hello();"');
	*echo '<br>';
	 *</code>
	 * @param string $key name of post params to be validate 
	 * @param string $value of post params to be validate 
	 * @param string $validation is value of validation maxValue i.e number value
	 * @return string
	 */
	function equalTo($key, $value, $validation){
		if($value != $this->aParams[$validation['equalTo']])
			($validation['message'])?$this->aErr[$key][] = $validation['message']:$this->aErr[$key][]='Value is mismatch.';
	}
}
