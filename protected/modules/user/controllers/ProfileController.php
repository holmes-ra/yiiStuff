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


	/**
	 *
	 */
	public function actionAddApi() {
		$model=new YUtilRegisteredKey;


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
                'div'=>$this->renderPartial('_formDialog', array('model'=>$model), true)));
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
