<?php
require_once 'ValidatorRules.php';
require_once 'Validator.php';

//How to use
$oValidator = new Validator();

$oValidator->isValid("http://sklueh.de", 'url'); //true
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