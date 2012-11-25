<?php

// Validates an API key, returns data if successful

class apiCheck extends CValidator
{
	public $vCode;

	// if keyID already exists, do not do this

	protected function validateAttribute($object, $attribute) {
		$keyID = $object->$attribute;

		$vCodeAttr = $this->vCode === null ? $attribute.'_repeat' : $this->vCode;
		$vCode     = $object->$vCodeAttr;

		if (($this->isEmpty($keyID) || $this->isEmpty($vCode))) {
			return; }

		$api = new Pheal($keyID, $vCode);
		try {
			$object->keyInfo = $api->accountScope->APIKeyInfo();
		} catch (PhealAPIException $e) {
			$this->addError($object, $attribute, 'KeyID/vCode combo invalid');
		}
		// @todo: does Pheal throw an exception when it cannot connect to API server? If so, display that
	}
}


?>
