<?php
/**
 * Validator
 * - This class is used to iterate the rules
 * @autor Sebastian Klüh (http://sklueh.de)
 */
class Validator
{
	private $sLastErrorMessage = "";
	private $sLanguage = "de";
	private $sValidationClass = "ValidatorRules";
	
	public function isValid($mValue, $mPattern)
	{
		$aPatterns = explode("|", $mPattern);
		
		foreach( (array) $aPatterns as $sRule)
		{
			$aRuleParams = $this->detachParams("[", "]", $sRule);
			$oReflectionMethod = new ReflectionMethod($this->sValidationClass, $sMethod = 'check_'.$sRule);
			if(!$oReflectionMethod->invoke(new $this->sValidationClass(), $mValue, $aRuleParams))
			{
				$this->sLastErrorMessage = $this->getAnnotation($oReflectionMethod->getDocComment(), $aRuleParams);
				return false;
			}
		} 
		$this->sLastErrorMessage = "";
		return true;
	}
	
	public function getLastErrorMessage()
	{
		return $this->sLastErrorMessage;
	}
	
	public function setLanguage($sLanguage)
	{
		$this->sLanguage = $sLanguage;
	}
	
	public function setValidationClass($sValidationClass)
	{
		$this->sValidationClass = $sValidationClass;
	}
	
	private function detachParams($cFirstChar, $cSecondChar, &$sRule)
	{
	    preg_match_all("/\\".$cFirstChar."(.*?)\\".$cSecondChar."/", $sRule, $aMatches);
		$sRule = preg_replace("/\\[(.*?)\\]/", "", $sRule);
	    return $aMatches[1];
	}
	
	private function getAnnotation($sAnnotation, $aRuleParams)
	{
		$sReturn = "";
		$sAnnotationIdentifier = '@ErrorMessage[lang='.trim($this->sLanguage).']';
		if(strpos($sAnnotation, $sAnnotationIdentifier) !== FALSE)
		{
			$sAnnotation = substr($sAnnotation, strpos($sAnnotation, $sAnnotationIdentifier)+strlen($sAnnotationIdentifier));
			$sReturn = trim(substr($sAnnotation, 0, strpos($sAnnotation, PHP_EOL)));
			
			if(isset($aRuleParams[0]))
			{
				return sprintf($sReturn, $aRuleParams[0]);
			}
		}
		return $sReturn;
	}
}
?>