<?php
/**
 * Validator
 * - This class is used to iterate the rules
 * @autor Sebastian Klüh (http://sklueh.de)
 */
class Validator
{
	public function isValid($mValue, $mPattern)
	{
		$aPatterns = explode("|", $mPattern);
		
		foreach( (array) $aPatterns as $sRule)
		{
			$aRuleParams = $this->detachParams("[", "]", $sRule);
			$oReflectionMethod = new ReflectionMethod($sValidationClass = "ValidatorRules", 'check_'.$sRule);
			if(!$oReflectionMethod->invoke(new $sValidationClass(), $mValue, $aRuleParams)) return false;
		} return true;
	}
	
	public function detachParams($cFirstChar, $cSecondChar, &$sRule)
	{
	    preg_match_all("/\\".$cFirstChar."(.*?)\\".$cSecondChar."/", $sRule, $aMatches);
		$sRule = preg_replace("/\\[(.*?)\\]/", "", $sRule);
	    return $aMatches[1];
	}
}
?>