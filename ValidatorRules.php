<?php

/**
 * ValidatorRules
 * - Feel free to add your own validation rules
 * @autor Sebastian Klüh (http://sklueh.de)
 */
class ValidatorRules
{
	/**
	 * @ErrorMessage[lang=de] Bitte geben Sie einen Wert ein.
	 * @ErrorMessage[lang=en] Please enter a value.
	 */
	public function check_required($mValue)
	{
		return (trim($mValue) === "" ? false : true);
	}
	
	/**
	 * @ErrorMessage[lang=de] Die Eingabe muss mindestens %d Zeichen lang sein.
	 * @ErrorMessage[lang=en] The input must be at least %d characters in length.
	 */
	public function check_min_length($mValue, $aParams)
	{
		return (strlen($mValue) >= $aParams[0]);
	}
	
	/**
	 * @ErrorMessage[lang=de] Die Eingabe muss exakt %d Zeichen lang sein.
	 * @ErrorMessage[lang=en] The input must be exactly %d characters in length.
	 */
	public function check_exact_length($mValue, $aParams)
	{
		return (strlen($mValue) == $aParams[0]);
	}

	/**
	 * @ErrorMessage[lang=de] Die Eingabe darf nicht l&auml;ger als %d Zeichen sein.
	 * @ErrorMessage[lang=en] The input can not exceed %d characters in length.
	 */
	public function check_max_length($mValue, $aParams)
	{
		return (strlen($mValue) <= $aParams[0]);
	}
	
	/**
	 * @ErrorMessage[lang=de] Bitte geben Sie eine Zahl an, die kleiner ist als %d.
	 * @ErrorMessage[lang=en] Please enter a number less than %d.
	 */
	public function check_less_than($mValue, $aParams)
	{
		return (number_format($mValue, 15) < $aParams[0]);
	}
	
	/**
	 * @ErrorMessage[lang=de] Bitte geben Sie eine Zahl an, die gr&ouml;&szlig;er ist als %d.
	 * @ErrorMessage[lang=en] Please enter a number greater than %d.
	 */
	public function check_greater_than($mValue, $aParams)
	{
		return (number_format($mValue, 15) > $aParams[0]);
	}
	
	/**
	 * @ErrorMessage[lang=de] Bitte geben Sie nur Buchstaben ein.
	 * @ErrorMessage[lang=en] Please enter only alphabetical characters.
	 */
	public function check_alpha($mValue)
	{
		return ctype_alpha($mValue);
	}
	
	/**
	 * @ErrorMessage[lang=de] Die Eingabe darf nur Zahlen und Buchstaben enthalten.
	 * @ErrorMessage[lang=en] The input may only contain alpha-numeric characters.
	 */
	public function check_alpha_numeric($mValue)
	{
		return ctype_alnum($mValue);
	}
	
	/**
	 * @ErrorMessage[lang=de] Bitte geben Sie einen ganzzahligen Wert ein.
	 * @ErrorMessage[lang=en] Please enter an integer value.
	 */
	public function check_integer($mValue)
	{
		return strval(intval($mValue)) === strval($mValue);
	}
	
	/** 
	 * @ErrorMessage[lang=de] Bitte geben Sie eine Dezimalzahl ein.
	 * @ErrorMessage[lang=en] Please enter a decimal number.
	 */
	public function check_decimal($mValue)
	{
		 return ($mValue == (string)(float)$mValue);
	}
	
	/** 
	 * @ErrorMessage[lang=de] Bitte geben Sie eine g&uuml;ltiges Datum ein.
	 * @ErrorMessage[lang=en] Please enter a valid date.
	 */
	public function check_date($mValue)
	{
		if(!preg_match("/^\d{1,2}\.\d{1,2}\.\d{4}$/", $mValue)) return false;
		$aDateParts = explode('.', $mValue); 
		return checkdate ( $aDateParts[1], $aDateParts[0] , $aDateParts[2]);
	}
	
	/** 
	 * @ErrorMessage[lang=de] Bitte geben Sie eine g&uuml;ltige E-Mail-Adresse ein.
	 * @ErrorMessage[lang=en] Please enter a valid email address.
	 */
	public function check_email($mValue)
	{
		return (filter_var( $mValue, FILTER_VALIDATE_EMAIL ) !== false ? true : false);
	}
	
	/**
	 * @ErrorMessage[lang=de] Die Eingabe darf nur aus Zahlen bestehen.
	 * @ErrorMessage[lang=en] The input may only contain digits.
	 */
	public function check_digits($mValue)
	{
		return ctype_digit($mValue);
	}
	
	/**
	 * @ErrorMessage[lang=de] Bitte geben Sie eine g&uuml;ltige URL ein.
	 * @ErrorMessage[lang=en] Please enter a valid URL.
	 */
    public function check_url($mValue)
    {
        //Danke an David Müller (http://www.d-mueller.de)
        return ((strpos(trim($mValue), "http://") === 0 || strpos(trim($mValue), "https://") === 0) &&
                 filter_var(trim($mValue), FILTER_VALIDATE_URL, FILTER_FLAG_SCHEME_REQUIRED | FILTER_FLAG_HOST_REQUIRED) !== false);
    }
	
	/**
	 * @ErrorMessage[lang=de] Die Eingabe stimmt nicht mit dem definierten Wert überein.
	 * @ErrorMessage[lang=en] The input does not match the defined value.
	 */
	public function check_equals($mValue, $aParams)
	{
		return ($mValue === $aParams[0]);
	}
	
	/**
	 * @ErrorMessage[lang=de] Die Eingabe stimmt nicht mit den definierten Werten &uuml;berein.
	 * @ErrorMessage[lang=en] The input does not match the defined values​​.
	 */
	public function check_match($mValue, $aParams)
	{
		return in_array($mValue, explode(',', $aParams[0]));
	}
}
?>