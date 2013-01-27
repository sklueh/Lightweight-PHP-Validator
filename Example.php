<?php
require_once 'ValidatorRules.php';
require_once 'Validator.php';

//Example 1
//How to use (with english error messages)
$aErrorMessages = array();

$oValidator = new Validator();

$oValidator->setLanguage('en'); //optional - English error messages. Use 'de' for german error messages.
$oValidator->setValidationClass('ValidatorRules'); //optional - To use a custom validation-class (e.g. 'MySpecialValidationClass');

$oValidator->isValid("http//sklueh.de", 'url'); //false
$aErrorMessages[] = $oValidator->getLastErrorMessage();
$oValidator->isValid("http://sklueh.de", 'url|min_length[17]|max_length[20]|required'); //false
$aErrorMessages[] = $oValidator->getLastErrorMessage();
$oValidator->isValid("15", 'greater_than[39.90]'); //false
$aErrorMessages[] = $oValidator->getLastErrorMessage();
print_r($aErrorMessages);

/*
Array
(
    [0] => Please enter a valid URL.
    [1] => The input must be at least 17 characters in length.
    [2] => Please enter a number greater than 39.
)
*/

//Example 2
//How to use (with german error messages)
$aErrorMessages = array();

$oValidator = new Validator();

$oValidator->setLanguage('de'); //optional - German error messages. Use 'en' for english error messages.
$oValidator->setValidationClass('ValidatorRules'); //optional - To use a custom validation-class (e.g. 'MySpecialValidationClass');

$oValidator->isValid("http//sklueh.de", 'url'); //false
$aErrorMessages[] = $oValidator->getLastErrorMessage();
$oValidator->isValid("http://sklueh.de", 'url|min_length[17]|max_length[20]|required'); //false
$aErrorMessages[] = $oValidator->getLastErrorMessage();
$oValidator->isValid("15", 'greater_than[39.90]'); //false
$aErrorMessages[] = $oValidator->getLastErrorMessage();
print_r($aErrorMessages);

/*
Array
(
    [0] => Bitte geben Sie eine gültige URL ein.
    [1] => Die Eingabe muss mindestens 17 Zeichen lang sein.
    [2] => Bitte geben Sie eine Zahl an, die größer ist als 39.
)

*/

//Example 3
//Different validation rules
$oValidator->isValid("http:/%$$^1sklueh.de", 'url');//false
$oValidator->isValid("http://sklueh.de", 'url|min_length[16]|max_length[20]|required'); //true
$oValidator->isValid("http://sklueh.de", 'url|min_length[17]|max_length[20]|required'); //false
$oValidator->isValid("http://sklueh.de", 'url|min_length[10]|max_length[15]|required'); //false
$oValidator->isValid("39.91", 'greater_than[39.90]'); //true
$oValidator->isValid("40", 'greater_than[39.90]'); //true
$oValidator->isValid("39.90", 'greater_than[39.90]'); //false
$oValidator->isValid('2', 'match[1,2]'); //true
$oValidator->isValid('3', 'match[1,2,5,7]'); //false
$oValidator->isValid('o_O?', 'match[lol,rofl,o_O?,lololol,l000000l]'); //true
$oValidator->isValid(md5('my_password'), 'equals['.md5('my_password').']'); //true
$oValidator->isValid(md5('my_password'), 'equals['.md5('my_wrong_password').']'); //false
$oValidator->isValid("1.1.2012", 'date'); //true
$oValidator->isValid("30.2.2012", 'date'); //false
$oValidator->isValid("2.2012", 'date'); //false

?>