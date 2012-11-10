<?php
/**
 * UWebUser: extension of CWebuser to add support for characters (sub accounts)
 *
 */


class UWebUser extends CWebUser
{

	private $_model;


	/**
	 * Returns a value indicating whether the user has selected a character.
	 *
	 * @return boolean whether the current application user has character selected.
	 */
	public function getIsCharacter() {
  		return $this->getState('__charID')!==null;
	}


	/**
	 * Returns a value that uniquely represents the user's character.
	 *
	 * @return mixed the unique identifier for the character. If null, it means the user does not ahve a character selected.
	 */
	public function getCharID() {
		return $this->getState('__charID');
	}


	/**
	 *
	 *
	 * @param unknown $value
	 */
	public function setCharID($value) {
		$this->setState('__charID', $value);
	}


	/*
	 * Handles setting the session data for character switching
	 *
	 * @param int $id ID of character. If invalid, will gracefully reduce to default char or simply basic user (no char selected)
	 */
	public function switchChar($id){
		$user = $this->loadUser();
		$char = $user->regCharacters(array('condition' => 'regCharacters.characterID = :id', 'params'=>array(':id'=>$id)));
		if (count($char) === 1) {
			$this->name   = $char[0]->characterName;
			$this->charID = $char[0]->characterID;
		}
		else if (isset($user->defaultChar) && $id != $user->defaultChar) {
			// @todo: what if default char is not registered?
			$this->switchChar($user->defaultChar);
			return false; // false because original char ID was not valid
		}
		else { 
			$this->name   = $user->email;
			$this->charID = null;
			return false; 
		}
		return true;
	}
	/**
	*
	*
	* @param unknown $fromCookie
	*/
	protected function afterLogin($fromCookie) {
		$user = $this->loadUser();
		$this->switchChar($user->defaultChar);
	}


	/**
	 *
	 *
	 * @return unknown
	 */
	function getCharacters() {
		$user       = $this->loadUser();
		$characters = $user->regCharacters();

		return count($characters) ? $characters : false;
	}



	/**
	 * Load user model.
	 *
	 * @return unknown
	 */
	public function loadUser() {
		if ($this->_model===null) {
			if (Yii::app()->user->id)
				$this->_model=User::model()->findByPk(Yii::app()->user->id);
		}
		return $this->_model;
	}
}
