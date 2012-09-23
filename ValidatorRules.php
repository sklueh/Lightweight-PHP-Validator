<?php

/**
 * ValidatorRules
 * - Feel free to add your own validation rules
 * @autor Sebastian Klüh (http://sklueh.de)
 */
class ValidatorRules
{
	public function check_required($mValue)
	{
		return (trim($mValue) === "" ? false : true);
	}
	
	public function check_min_length($mValue, $aParams)
	{
		return (strlen($mValue) >= $aParams[0]);
	}
	
	public function check_exact_length($mValue, $aParams)
	{
		return (strlen($mValue) == $aParams[0]);
	}

	public function check_max_length($mValue, $aParams)
	{
		return (strlen($mValue) <= $aParams[0]);
	}
	
	public function check_less_than($mValue, $aParams)
	{
		return (number_format($mValue, 15) < $aParams[0]);
	}
	
	public function check_greater_than($mValue, $aParams)
	{
		return (number_format($mValue, 15) > $aParams[0]);
	}
	
	public function check_alpha($mValue)
	{
		return ctype_alpha($mValue);
	}
	
	public function check_alpha_numeric($mValue)
	{
		return ctype_alnum($mValue);
	}
	
	public function check_integer($mValue)
	{
		return strval(intval($mValue)) === strval($mValue);
	}
	
	public function check_decimal($mValue)
	{
		 return ($mValue == (string)(float)$mValue);
	}
	
	public function check_date($mValue)
	{
		if(!preg_match("/^\d{1,2}\.\d{1,2}\.\d{4}$/", $mValue)) return false;
		$aDateParts = explode('.', $mValue); 
		return checkdate ( $aDateParts[1], $aDateParts[0] , $aDateParts[2]);
	}
	
	public function check_email($mValue)
	{
		return (filter_var( $mValue, FILTER_VALIDATE_EMAIL ) !== false ? true : false);
	}
	
	public function check_digits($mValue)
	{
		return ctype_digit($mValue);
	}
	
    public function check_url($mValue)
    {
        //Danke an David Müller (http://www.d-mueller.de)
        return ((strpos(trim($mValue), "http://") === 0 || strpos(trim($mValue), "https://") === 0) &&
                 filter_var(trim($mValue), FILTER_VALIDATE_URL, FILTER_FLAG_SCHEME_REQUIRED | FILTER_FLAG_HOST_REQUIRED) !== false);
    }
	
	public function check_equals($mValue, $aParams)
	{
		return ($mValue === $aParams[0]);
	}
	
	public function check_match($mValue, $aParams)
	{
		return in_array($mValue, explode(',', $aParams[0]));
	}
}
?>