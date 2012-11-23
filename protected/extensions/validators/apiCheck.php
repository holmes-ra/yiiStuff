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
			// @todo: move all this to afterValidate() of YUtilRegisteredKey?
			$keyInfo = $api->accountScope->APIKeyInfo();
			$object->activeAPIMask = $keyInfo->key->accessMask;
			$object->characters = $keyInfo->key->characters;
			$object->info = $keyInfo->key->_attribs;
		} catch (PhealAPIException $e) {
			$this->addError($object, $attribute, 'KeyID/vCode combo invalid');
		}
	}
}


?>
