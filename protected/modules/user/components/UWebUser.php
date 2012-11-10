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


  /**
   *
   *
   * @param unknown $fromCookie
   */
  protected function afterLogin($fromCookie) {
    $user = $this->loadUser();
    $char = $user->regCharacters(array('condition' => 'regCharacters.characterID = :id', 'params'=>array(':id'=>$user->defaultChar)));

    if (count($char) === 1) {
      $this->name   = $char[0]->characterName;
      $this->charID = $char[0]->characterID;
    }
    else {
      $this->charID = null;
    }
  }


  /**
   *
   *
   * @return unknown
   */
  function getCharacters() {
    $user = $this->loadUser();
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
