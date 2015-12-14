<?php

	/*
	=====================================================================================================
	Copyright (c) 2015 - Today, Treevea.
	All rights reserved.


	file : LoginForm.test.class.php
	brief :  contains the LoginForm test class' code
	authors : Matthieu JABBOUR
	version : 0.0
	date : 2015/09/14


	Further informations : www.treevea.com
	=====================================================================================================
	*/




	namespace Mangrova\Tests\LoginForm;
	use \Mangrova\Debug;
	include_once('../mangrova/Includes.php');
	include_once('../mangrova/Test.class.php');
	include_once('../resources/modules/loginform/LoginForm.module.class.php');
	include_once('../resources/modules/loginform/LoginForm.view.class.php');
	include_once('../resources/modules/shared/users/Users.model.class.php');




	//====================================================================================================
	//	@brief :  test class for the LoginForm module
	//====================================================================================================
	class Test extends \Mangrova\Test
	{
		//	@type : void
		//	@brief : executes a unitary & integration test procedure
		public function execute()	{


			$model = new \Mangrova\Modules\Shared\Users\Model();
			/*
			 *
			 *	TEST GROUP 1 : LOGINFORM WITH A CONNECTED USER
			 *
			 */
			Debug::log('TEST GROUP 1', 'LOGINFORM WITH A CONNECTED USER');
			$loginform = new \Mangrova\Modules\LoginForm\Module($model);


			// TEST 1 - PROCESS RETURN VALUE (0)
			Test::assertEqual($loginform->process(2), 2);

			//	TEST 2 - LOGINFORM VIEW DISPLAYING
			$loginform->render('');
			Debug::log('TEST 2', 'OK');





			/*
			 *
			 *	TEST GROUP 2 : LOGINFORM WITH NO CONNECTED USER & NO SENT FORM DATA
			 *
			 */
			Debug::log('TEST GROUP 2', 'LOGINFORM WITH NO CONNECTED USER');
			$loginform = new \Mangrova\Modules\LoginForm\Module($model);


			// TEST 1 - PROCESS RETURN VALUE (0)
			Test::assertEqual($loginform->process(0), 0);

			//	TEST 2 - LOGINFORM VIEW DISPLAYING
			$loginform->render('');
			Debug::log('TEST 2', 'OK');





			/*
			 *
			 *	TEST GROUP 3 : LOGINFORM WITH NO CONNECTED USER & INVALID SENT FORM DATA
			 *
			 */
			Debug::log('TEST GROUP 3', 'LOGINFORM WITH NO CONNECTED USER & INVALID SENT FORM DATA');
			$loginform = new \Mangrova\Modules\LoginForm\Module($model);
			$_POST = ['user' => 'wrong', 'password' => 'hello'];


			// TEST 1 - PROCESS RETURN VALUE (0)
			Test::assertEqual($loginform->process(0), 1);

			//	TEST 2 - LOGINFORM VIEW DISPLAYING
			$loginform->render('');
			Debug::log('TEST 2', 'OK');




			/*
			 *
			 *	TEST GROUP 3 : LOGINFORM WITH NO CONNECTED USER & VALID SENT FORM DATA
			 *
			 */
			Debug::log('TEST GROUP 4', 'LOGINFORM WITH NO CONNECTED USER & VALID SENT FORM DATA');
			$loginform = new \Mangrova\Modules\LoginForm\Module($model);
			$_POST = ['user' => 'john', 'password' => 'bonjour'];


			// TEST 1 - PROCESS RETURN VALUE (0)
			Test::assertEqual($loginform->process(0), 2);

			//	TEST 2 - LOGINFORM VIEW DISPLAYING
			$loginform->render('');
			Debug::log('TEST 2', 'OK');

		}
	}

	(new Test('LoginForm.results.txt'))->execute();
?>