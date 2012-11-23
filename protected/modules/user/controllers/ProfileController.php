<?php

class ProfileController extends Controller
{
	public $defaultAction = 'profile';

	/**
	 *
	 *
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;

	/**
	 * Shows a particular model.
	 */
	public function actionProfile() {

		$model  = $this->loadUser();
		$keyDP  = User::keysDataProvider(Yii::app()->user->id);
		$charDP = User::charDataProvider(Yii::app()->user->id);
		$this->render('profile', array(
				'model'            => $model,
				'profile'          => $model->profile,
				'keysDataProvider' => $keyDP,
				'charDataProvider' => $charDP,
			));
	}

	public function actionSwitch($id) {
		Yii::app()->user->switchChar($id);
		$this->redirect(Yii::app()->controller->module->profileUrl);
	}


	/**
	 * Button functions
	 * @todo when registering / adding api, check characters in system. If any conflicts, notify 
	 * the user and ask that he delete the key's associated with the characters from his API page on EVEO
	 *
	 * @todo Perhaps put all character edits in a new CharacterControler and API edits in a KeysController. Must look into this.
	 * Default view could be user's associated characters and keys in a gridview.
	 */

	// Only allow access mask modification to characters.
	public function actionAccess($id) {
		$char = $this->loadChar($id);

		if ($char) {

			$availableMask = YUtilRegisteredCharacter::model()->getAvailableBitmask(Yii::app()->user->id, $id);
			
			if (isset($_POST['mask'])) {

				$mask = array_reduce($_POST['mask'], function($a, $b) { return $a | $b; });
				$mask = $mask & $availableMask; // only apply what character can use
				$char->activeAPIMask = $mask;

				if ($char->update()) {
					Yii::app()->user->setFlash('success', "New mask <b>".$mask."</b> for ".$char->characterName);

					if (Yii::app()->request->isAjaxRequest) {
                    	echo CJSON::encode(array(
                        	'status'=>'success', 
	                        'content'=>"API Access Mask successfully updated!"
                        	));
                    	exit;
                	}
				} // @todo: error if not updated
			}

			if (Yii::app()->request->isAjaxRequest) {
				$dataProvider=new CActiveDataProvider(YUtilAccessMask::model()->char()->bitmask($availableMask));
            	echo CJSON::encode(array(
                	'content'=>$this->renderPartial('_accessDialog', array(
                		'char'=>$char,
                		'dataProvider'  => $dataProvider,
						'availableMask' => YUtilRegisteredCharacter::model()->getAvailableBitmask(Yii::app()->user->id, $id)), true, true)));
	            exit;   
        	}
        	$dataProvider=new CActiveDataProvider(YUtilAccessMask::model()->char());
			$this->render('access', array(
				'char'          => $char,
				'dataProvider'  => $dataProvider,
				'availableMask' => YUtilRegisteredCharacter::model()->getAvailableBitmask(Yii::app()->user->id, $id),
			));
		} else {
			// @todo log error
			if (Yii::app()->request->isAjaxRequest) {
            	echo CJSON::encode(array(
                	'status' => 'error',
                	'content'=> 'An error happened. You shouldn\'t have seen this. You. Saw. <strong>Nothing</strong>.'));
            	exit;
            }

			$this->redirect(Yii::app()->controller->module->profileUrl); 
		}
	}

	// Light function to keep code clean.
	protected function showFlash() {
		$this->widget('bootstrap.widgets.TbAlert', array(
      		'block'=>true, // display a larger alert block?
       		'fade'=>true, // use transitions?
		    'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
		));
	}

	public function actionActivateChar($id) {
		$char = $this->loadChar($id, false);

		$new = YUtilRegisteredCharacter::model()->findByPk($id);
		if (!$new) {
			$new = new YUtilRegisteredCharacter;
			$new->characterID   = $id;
			$new->isActive      = 1;
			$new->characterName = $char->characterName;
			$new->activeAPIMask = $new->getAvailableBitmask(Yii::app()->user->id, $id);
			$new->userID        = Yii::app()->user->id;
			if ($new->save()){
				Yii::app()->user->setFlash('success', $char->characterName." was activated! Data will be polled from API servers momentarily."); }
			else {
				// @todo: actually log error
				Yii::app()->user->setFlash('error', 'There was an error while trying to save data into database. This error has been logged and will be reviewed ASAP.');
			}
		} 
		else {
			// @todo if character is already activated, raise better warning and display info to user about keys associated with
			Yii::app()->user->setFlash('error', '<strong>ERROR:</strong> Character is already registered. This could mean someone else is using your API keys.');
		}
		if (Yii::app()->request->isAjaxRequest) {
			$this->showFlash(); // Just return the html and exit
            exit;               
       	}
        $this->redirect(Yii::app()->controller->module->profileUrl);
	}

	public function actionEnableChar($id) {
		$char = $this->loadChar($id);

		if(count($char) === 1) {
			$char->isActive = 1;
			if ($char->save()) {
				Yii::app()->user->setFlash('success', $char->characterName." was enabled! Data will be polled from API servers momentarily."); }
			else {
				// @todo: actually log error
				Yii::app()->user->setFlash('error', 'There was an error while trying to save data into database. This error has been logged and will be reviewed ASAP.');
			}
		} else {
			// @fixme: maybe throw invalid input exception or soemthing?
			Yii::app()->user->setFlash('error', '<strong>ERROR:</strong> Trying to modify data that doesn\'t exist in your user account');
		}
		if (Yii::app()->request->isAjaxRequest) {
			$this->showFlash(); // Just return the html and exit
            exit;               
       	}
		// regardless of what happens, should also redirect back to profile page.
        $this->redirect(Yii::app()->controller->module->profileUrl);
	}

	public function actionDisableChar($id) {
		$char = $this->loadChar($id);

		if($char) {
			$char->isActive = 0;
			if ($char->save()) {
				Yii::app()->user->setFlash('info', $char->characterName." was successfully disabled. API data will no longer be polled from this character."); }
			else {
				// @todo: actually log error
				Yii::app()->user->setFlash('error', 'There was an error while trying to save data into database. This error has been logged and will be reviewed ASAP.');
			} // @todo
		} else {
			// @fixme: maybe throw invalid input exception or soemthing?
			Yii::app()->user->setFlash('error', '<strong>ERROR:</strong> Trying to modify data that doesn\'t exist in your user account');
		}
		if (Yii::app()->request->isAjaxRequest) {
			$this->showFlash(); // Just return the html and exit
            exit;               
       	}
		// regardless of what happens, should also redirect back to profile page.
        $this->redirect(Yii::app()->controller->module->profileUrl);
	}

	public function actionDeleteChar($id) {
		// @todo: if default character, change
		$char = $this->loadChar($id);

		if ($char) {
			if (isset($_POST['confirmDelete'])) {
				if ($char->delete()) {
					Yii::app()->user->setFlash('info', $char->characterName." was successfully deleted, along with all data associated with character.");

					if (Yii::app()->request->isAjaxRequest) {
                    	echo CJSON::encode(array(
                        	'status'=>'success', 
	                        'content'=>"Character was successfully deleted."
                        	));
                    	exit;
                	}
                	$this->redirect(Yii::app()->controller->module->profileUrl);
				} // @todo: if error, do something
			}
			else if (isset($_POST['denyDelete'])) {
				$this->redirect(Yii::app()->controller->module->profileUrl);
			}

			if (Yii::app()->request->isAjaxRequest) {
            	echo CJSON::encode(array(
                	'content'=>$this->renderPartial('_deleteChar', array(
                		'char'=>$char), true, true)));
	            exit;   
        	}
			$this->render('deleteChar', array('char' => $char));
		} else {
			// @todo log error
			if (Yii::app()->request->isAjaxRequest) {
            	echo CJSON::encode(array(
                	'status' => 'error',
                	'content'=> 'An error happened. You shouldn\'t have seen this. You. Saw. <strong>Nothing</strong>.'));
            	exit;
            }

			$this->redirect(Yii::app()->controller->module->profileUrl); 
		}
	}

	public function actionDefaultChar($id) {
		$char = $this->loadChar($id);

		if($char){
			$this->_model->defaultChar = $char->characterID;
			if ($this->_model->update()) {
				Yii::app()->user->setFlash('info', "<strong>".$char->characterName."</strong> has been set to the default character."); }
			else {
				// @todo: actually log error
				Yii::app()->user->setFlash('error', 'There was an error while trying to save data into database. This error has been logged and will be reviewed ASAP.');
			}     
       	} else {
			// @fixme: maybe throw invalid input exception or soemthing?
			Yii::app()->user->setFlash('error', '<strong>ERROR:</strong> Trying to modify data that doesn\'t exist in your user account');
		}
		if (Yii::app()->request->isAjaxRequest) {
			$this->showFlash(); // Just return the html and exit
            exit;               
       	}
		// regardless of what happens, should also redirect back to profile page.
        $this->redirect(Yii::app()->controller->module->profileUrl);
	}

	public function actionDeleteKey($id) {
		// @todo: When deleting key, go through characters accociated with key that are also in utilRegChars. 
		// If any are found, see if character is associated with another key -by the same user (?)- and if so, update 
		// characters active API to include LIKE (?) calls. if no characters are found, delete from utilRegChars
		$user = $this->loadUser();
		$key = YUtilRegisteredKey::model()->with(array(
			'regCharacters'=>array(
				'on'=>'t.userID = regCharacters.userID',
			),
			'regCharacters.keys'=>array(
				'on'=>'`keys`.`userID` = `t`.`userID` AND `keys`.`keyID` != `t`.`keyID`',
			)))->findByPk($id, 't.userID=:userID',array(':userID'=>$user->id));

		if ($key) {
			if (isset($_POST['confirmDelete'])) {
				// we have confirmation, go go go
				$transaction = $key->dbConnection->beginTransaction();
				try{
					if (count($key->regCharacters)){
						foreach($key->regCharacters AS $char) { //if characters? what if no characters?
							if (count($char->keys)) { // if keys, modify
								$mask = 0;
								foreach ($char->keys AS $key2) {
									$mask = $mask | $key2->activeAPIMask;
								}
								$char->activeAPIMask = $mask;
								$char->update();
							}
							else { // if no keys, delete
								$char->delete();
							}
						}
					}
					$key->delete();
					$transaction->commit();

					Yii::app()->user->setFlash('info', $key->keyID." was successfully deleted.");

					if (Yii::app()->request->isAjaxRequest) {
                    	echo CJSON::encode(array(
                        	'status'=>'success', 
	                        'content'=>"Key was successfully deleted."
                        	));
                    	exit;
                	}
                	$this->redirect(Yii::app()->controller->module->profileUrl);
				}
				catch(Exception $e)
				{
					$transaction->rollback();
				}
			}
			else if (isset($_POST['denyDelete'])) {
				$this->redirect(Yii::app()->controller->module->profileUrl);
			}

			if (Yii::app()->request->isAjaxRequest) {
            	echo CJSON::encode(array(
                	'content'=>$this->renderPartial('_deleteKey', array('key'=>$key), true, true)));
	            exit;   
        	}
			$this->render('deleteKey', array('key' => $key));
		} else {
			// @todo log error
			if (Yii::app()->request->isAjaxRequest) {
            	echo CJSON::encode(array(
                	'status' => 'error',
                	'content'=> 'An error happened. You shouldn\'t have seen this. You. Saw. <strong>Nothing</strong>.'));
            	exit;
            }

			$this->redirect(Yii::app()->controller->module->profileUrl); 
		}
	}

	public function actionRefreshKey($id){
		$key = $this->loadKey($id);

		if($key){
			// @todo - validate key
			$key->isActive = 1;
			if ($key->update()) {
				Yii::app()->user->setFlash('info', "<strong>".$key->keyID."</strong> has been refreshed."); }
			else {
				// @todo: actually log error
				Yii::app()->user->setFlash('error', 'There was an error while trying to save data into database. This error has been logged and will be reviewed ASAP.');
			}     
       	} else {
			// @fixme: maybe throw invalid input exception or soemthing?
			Yii::app()->user->setFlash('error', '<strong>ERROR:</strong> Trying to modify data that doesn\'t exist in your user account');
		}
		if (Yii::app()->request->isAjaxRequest) {
			$this->showFlash(); // Just return the html and exit
            exit;               
       	}
		// regardless of what happens, should also redirect back to profile page.
        $this->redirect(Yii::app()->controller->module->profileUrl);
	}

	public function actionAddApi() {
		$model = new YUtilRegisteredKey;

        if(isset($_POST['YUtilRegisteredKey'])) {
            $model->attributes=$_POST['YUtilRegisteredKey'];
            $model->userID = Yii::app()->user->id;

            if($model->validate() && $model->withRelated->save(false, array('accountCharacters', 'info')))
            {
                if (Yii::app()->request->isAjaxRequest)
                {
                    echo CJSON::encode(array(
                        'status'=>'success', 
                        'content'=>"API successfully added!"
                        ));
                    exit;               
                }
                else {
       				 $this->redirect(Yii::app()->controller->module->profileUrl); }
            }
        }

        if (Yii::app()->request->isAjaxRequest)
        {
            echo CJSON::encode(array(
           		'status' => 'render', 
                'content'=>$this->renderPartial('_addApi', array('model'=>$model), true,true)));
            exit;    
        }
        else {
            $this->render('addApi',array('model'=>$model,)); }
	}




	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionEdit() {
		$model = $this->loadUser();
		$profile=$model->profile;

		// ajax validator
		if (isset($_POST['ajax']) && $_POST['ajax']==='profile-form') {
			echo UActiveForm::validate(array($model, $profile));
			Yii::app()->end();
		}

		if (isset($_POST['User'])) {
			$model->attributes=$_POST['User'];
			$profile->attributes=$_POST['Profile'];

			if ($model->validate()&&$profile->validate()) {
				$model->save();
				$profile->save();
				Yii::app()->user->setFlash('profileMessage', UserModule::t("Changes is saved."));
				$this->redirect(array('/user/profile'));
			} else $profile->validate();
		}

		$this->render('edit', array(
				'model'=>$model,
				'profile'=>$profile,
			));
	}



	/**
	 * Change password
	 */
	public function actionChangePassword() {
		$model = new UserChangePassword;
		if (Yii::app()->user->id) {

			// ajax validator
			if (isset($_POST['ajax']) && $_POST['ajax']==='changepassword-form') {
				echo CActiveForm::validate($model);
				Yii::app()->end();
			}

			if (isset($_POST['UserChangePassword'])) {
				$model->attributes=$_POST['UserChangePassword'];

				if ($model->validate()) {
					$new_password = User::model()->notsafe()->findbyPk(Yii::app()->user->id);
					if (UserModule::encrypting($model->oldpass) != $new_password->password) {

					}
					$new_password->password = $pass;
					$new_password->activkey = UserModule::encrypting(microtime().$model->password);
					$new_password->save();
					Yii::app()->user->setFlash('profileMessage', UserModule::t("New password is saved."));
					$this->redirect(array("profile"));
				}
			}
			$this->render('changepassword', array('model'=>$model));
		}
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 *
	 * @param integer the primary key value. Defaults to null, meaning using the 'id' GET variable
	 * @return unknown
	 */
	public function loadUser() {
		if ($this->_model===null) {
			if (Yii::app()->user->id)
				$this->_model=Yii::app()->controller->module->user();
			if ($this->_model===null)
				$this->redirect(Yii::app()->controller->module->loginUrl);
		}
		return $this->_model;
	}
	
	// loads registered character
	public function loadChar($id, $registered = true) {
		$model = $this->loadUser();
		$tbl = ($registered ? 'regCharacters' : 'characters');
		$char  = $model->{$tbl}(array('condition' => $tbl.'.characterID = :id', 'params'=>array(':id'=>$id)));

		if (count($char) === 1 && !($registered && $char[0]->userID != Yii::app()->user->id)) {
			return $char[0];
		}
		return false;
	}
	
	public function loadKey($id) {
		$model = $this->loadUser();
		$key   = $model->keys(array('condition' => 'keys.keyID = :id', 'params'=>array(':id'=>$id)));
		if (count($key) === 1) {
			return $key[0];
		}
		return false;
	}
}
