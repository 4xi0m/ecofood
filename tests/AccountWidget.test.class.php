<?php

	/*
	=====================================================================================================
	Copyright (c) 2015 - Today, Treevea.
	All rights reserved.


	file : AccountWidget.test.class.php
	brief :  contains the AccountWidget test class' code
	authors : Matthieu JABBOUR
	version : 0.0
	date : 2015/09/14


	Further informations : www.treevea.com
	=====================================================================================================
	*/




	namespace Mangrova\Tests\AccountWidget;
	use \Mangrova\Debug;
	use \Exception;
	include_once('../mangrova/Includes.php');
	include_once('../mangrova/Test.class.php');
	include_once('../resources/modules/accountwidget/AccountWidget.module.class.php');
	include_once('../resources/modules/accountwidget/AccountWidget.model.class.php');
	include_once('../resources/modules/accountwidget/AccountWidget.view.class.php');




	//====================================================================================================
	//	@brief :  test class for the AccoundWidget module
	//====================================================================================================
	class Test extends \Mangrova\Test
	{
		//	@type : void
		//	@brief : executes a unitary & integration test procedure
		public function execute()	{


			/*
			 *
			 *	TEST GROUP 1 : ACCOUNT WIDGET WITH NO CONNECTED USER
			 *
			 */
			Debug::log('TEST GROUP 1', 'ACCOUNT WIDGET WITH NO CONNECTED USER');
			$accountWidget = new \Mangrova\Modules\AccountWidget\Module();


			// TEST 1 - PROCESS RETURN VALUE (0)
			Test::assertEqual($accountWidget->process(0), 0);

			// TEST 2 - PROCESS RETURN VALUE (2)
			try {

				$accountWidget->process(2);

			} catch (\Exception $e) {

				Debug::log('TEST 2', 'OK');

			}

			//	TEST 2 - ACCOUNT WIDGET VIEW DISPLAYING
			$accountWidget->render('');
			Debug::log('TEST 3', 'OK');



			/*
			 *
			 *	TEST GROUP 2 : ACCOUNT WIDGET WITH CONNECTED USER
			 *
			 */
			Debug::log('TEST GROUP 2', 'ACCOUNT WIDGET WITH CONNECTED USER');
			$accountWidget = new \Mangrova\Modules\AccountWidget\Module();


			// TEST 1 - PROCESS RETURN VALUE (2)
			$_SESSION = ['user' => 'john'];
			Test::assertEqual($accountWidget->process(2), 2);

			//	TEST 2 - ACCOUNT WIDGET VIEW DISPLAYING
			$accountWidget->render('');
			Debug::log('TEST 2', 'OK');

		}
	}

	(new Test('AccountWidget.results.txt'))->execute();
?>