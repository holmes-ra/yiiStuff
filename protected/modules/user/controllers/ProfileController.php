<?php
/**
 * C:\Users\Ryan\AppData\Roaming\Sublime Text 2\Packages/PhpTidy/phptidy-sublime-buffer.php
 *
 * @package default
 */


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
		Yii::log('hi there', 'info', 'system.web.CController');

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

	// @todo this leaves the URL as type/char/id/112345, find better URL management for this
	public function actionAccess($type, $id) {		
		$user = User::model()->findByPk(Yii::app()->user->id);

		if ($type === 'char') {
			$model = $user->regCharacters(array('condition' => 'regCharacters.characterID = :id', 'params'=>array(':id'=>$id)));
		} else if ($type === 'key') {
			// if key is account, use char. if corp, use corp
			$model = $user->keys(array('condition' => 'keys.keyID = :id', 'params'=>array(':id'=>$id)));
		}
		if ($model) {
			$dataProvider=new CActiveDataProvider(YUtilAccessMask::model()->char());
			$this->renderPartial('_access', array(
					'model'         => $model,
					'dataProvider'  => $dataProvider,
				));
		}
		
	}
	/*
	 * Button functions
	 * @todo Make sure user can modify character! If not, don't allow it
	 * Also, may them POSTs with ajax or whatev
	 * @todo when registering / adding api, check characters in system. If any conflicts, notify 
	 * the user and ask that he delete the key's associated with the characters from his API page on EVEO
	 *
	 * @todo Perhaps put all character edits in a new CharacterControler and API edits in a KeysController. Must look into this.
	 * Default view could be user's associated characters and keys in a gridview.
	 */

	// Light function to keep code clean.
	protected function showFlash() {
		$this->widget('bootstrap.widgets.TbAlert', array(
      		'block'=>true, // display a larger alert block?
       		'fade'=>true, // use transitions?
		    'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
		));
	}

	public function actionActivateChar($id) {
		// when activating char, default to highest apiMask available from ENABLED keys (use scopes?)
		// also, check to see if there is a charater already in registered table. If there is, raise warning and display info to user about keys associated with character
	}

	public function actionEnableChar($id) {
		$user      = User::model()->findByPk(Yii::app()->user->id);
		$character = $user->regCharacters(array('condition' => 'regCharacters.characterID = :id', 'params'=>array(':id'=>$id)));

		if(count($character) === 1) {
			$character[0]->isActive = 1;
			if ($character[0]->save()) {
				Yii::app()->user->setFlash('success', $character[0]->characterName." was enabled! Data will be polled from API servers momentarily."); }
			else {
				// @todo: actually log error
				Yii::app()->user->setFlash('error', 'There was an error while trying to save data into database. This error has been logged and will be reviewed ASAP.');
			} // @todo what if it fails? set alert?
		} else {
			// @fixme: maybe throw invalid input exception or soemthing?
			Yii::app()->user->setFlash('error', '<strong>ERROR:</strong> Trying to modify data that doesn\'t exist in your user account');
		}
		if (Yii::app()->request->isAjaxRequest) {
			$this->showFlash(); // Just return the html and exit
            exit;               
       	}
		// regardless of what happens, should also redirect back to profile page.
		// set alert?
        $this->redirect(Yii::app()->controller->module->profileUrl);
	}

	public function actionDisableChar($id) {
		$user      = User::model()->findByPk(Yii::app()->user->id);
		$character = $user->regCharacters(array('condition' => 'regCharacters.characterID = :id', 'params'=>array(':id'=>$id)));

		if(count($character) === 1) {
			$character[0]->isActive = 0;
			if ($character[0]->save()) {
				Yii::app()->user->setFlash('info', $character[0]->characterName." was successfully disabled. API data will no longer be polled from this character."); }
			else {
				// @todo: actually log error
				Yii::app()->user->setFlash('error', 'There was an error while trying to save data into database. This error has been logged and will be reviewed ASAP.');
			} // @todo what if it fails? set alert?
		} else {
			// @fixme: maybe throw invalid input exception or soemthing?
			Yii::app()->user->setFlash('error', '<strong>ERROR:</strong> Trying to modify data that doesn\'t exist in your user account');
		}
		if (Yii::app()->request->isAjaxRequest) {
			$this->showFlash(); // Just return the html and exit
            exit;               
       	}
		// regardless of what happens, should also redirect back to profile page.
		// set alert?
        $this->redirect(Yii::app()->controller->module->profileUrl);
	}

	public function actionDeleteChar($id) {
		// if default character, change

	}

	public function actionDefaultChar($id) {
		$user      = User::model()->findByPk(Yii::app()->user->id);
		$character = $user->regCharacters(array('condition' => 'regCharacters.characterID = :id', 'params'=>array(':id'=>$id)));

		if(count($character) === 1){
			$user->defaultChar = $character[0]->characterID;
			if ($user->update()) {
				// if this is ajax, we simply return the data and that's it
				if (Yii::app()->request->isAjaxRequest) {
					// @todo better ajax response
            		echo "<strong>Save Succesful</strong>";
            		exit;               
       			}
			} // @todo what if it fails? set alert?
		}
		// regardless of what happens, should also redirect back to profile page.
		// set alert?
        $this->redirect(Yii::app()->controller->module->profileUrl);
	}

	public function actionEnableKey($id) {
		$user = User::model()->findByPk(Yii::app()->user->id);
		$key  = $user->keys(array('condition' => 'keys.keyID = :id', 'params'=>array(':id'=>$id)));

		if(count($key) === 1){
			$key[0]->isActive = 1;
			if ($key[0]->save()) {
				// if this is ajax, we simply return the data and that's it
				if (Yii::app()->request->isAjaxRequest) {
            		echo "<strong>Save Succesful</strong>";
            		exit;               
       			}
			} // @todo what if it fails? set alert?
		}
		// regardless of what happens, should also redirect back to profile page.
		// set alert?
        $this->redirect(Yii::app()->controller->module->profileUrl);
	}

	public function actionDisableKey($id) {
		$user = User::model()->findByPk(Yii::app()->user->id);
		$key  = $user->keys(array('condition' => 'keys.keyID = :id', 'params'=>array(':id'=>$id)));

		if(count($key) === 1){
			$key[0]->isActive = 0;
			if ($key[0]->save()) {
				// if this is ajax, we simply return the data and that's it
				if (Yii::app()->request->isAjaxRequest) {
            		echo "<strong>Save Succesful</strong>";
            		exit;               
       			}
			} // @todo what if it fails? set alert?
		}
		// regardless of what happens, should also redirect back to profile page.
		// set alert?
        $this->redirect(Yii::app()->controller->module->profileUrl);
	}
	public function actionAddApi() {
		$model = new YUtilRegisteredKey;


        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
 
        if(isset($_POST['YUtilRegisteredKey']))
        {
            $model->attributes=$_POST['YUtilRegisteredKey'];
            $model->userID = Yii::app()->user->id;
            if($model->validate() && $model->withRelated->save(false, array('accountCharacters')))
            {
                if (Yii::app()->request->isAjaxRequest)
                {
                    echo CJSON::encode(array(
                        'status'=>'success', 
                        'div'=>"API successfully added!"
                        ));
                    exit;               
                }
                else
                    $this->redirect('.');
                    //$this->redirect(array('view','id'=>$model->id));
            }
        }

        if (Yii::app()->request->isAjaxRequest)
        {
            echo CJSON::encode(array(
                'status'=>'failure', 
                'div'=>$this->renderPartial('_addApi', array('model'=>$model), true)));
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
	public function actionChangepassword() {
		$model = new UserChangePassword;
		if (Yii::app()->user->id) {

			// ajax validator
			if (isset($_POST['ajax']) && $_POST['ajax']==='changepassword-form') {
				echo UActiveForm::validate($model);
				Yii::app()->end();
			}

			if (isset($_POST['UserChangePassword'])) {
				$model->attributes=$_POST['UserChangePassword'];
				if ($model->validate()) {
					$new_password = User::model()->notsafe()->findbyPk(Yii::app()->user->id);
					$new_password->password = UserModule::encrypting($model->password);
					$new_password->activkey=UserModule::encrypting(microtime().$model->password);
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


}
