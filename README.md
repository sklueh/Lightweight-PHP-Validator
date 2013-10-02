Lightweight-PHP-Validator
=========================
Lightweight PHP class for validation

**Example 1 - How to use (with english error messages):**
```php
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
[2] => Please enter a number greater than 39.90.
)
*/
```

For more information visit the following link:

http://sklueh.de/2012/09/lightweight-validator-in-php/
