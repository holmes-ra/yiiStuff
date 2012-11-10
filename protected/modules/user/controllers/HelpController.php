<?php
class HelpController extends Controller
{
	public $defaultAction = 'help';

	public function actionHelp()
	{
		$this->render('help');
	}
}
?>