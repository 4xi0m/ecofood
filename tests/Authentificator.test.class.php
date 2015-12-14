<?php

	/*
	=====================================================================================================
	Copyright (c) 2015 - Today, Treevea.
	All rights reserved.


	file : Authentificator.test.class.php
	brief :  contains the Authentificator test class' code
	authors : Matthieu JABBOUR
	version : 0.0
	date : 2015/09/14


	Further informations : www.treevea.com
	=====================================================================================================
	*/




	namespace Mangrova\Tests\Authentificator;
	use \Mangrova\Debug;
	use \Exception;
	include_once('../mangrova/Includes.php');
	include_once('../mangrova/Test.class.php');
	include_once('../resources/modules/authentificator/Authentificator.module.class.php');
	include_once('../resources/modules/shared/users/Users.model.class.php');




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
			 *	TEST GROUP 1 : AUTHENTIFICATOR WITH NO CONNECTED USER
			 *
			 */
			Debug::log('TEST GROUP 1', 'AUTHENTIFICATOR WITH NO CONNECTED USER');
			$model = new \Mangrova\Modules\Shared\Users\Model();
			$authentificator = new \Mangrova\Modules\Authentificator\Module($model);


			// TEST 1 - PROCESS RETURN VALUE (0)
			Test::assertEqual($authentificator->process(0), 1);






			/*
			 *
			 *	TEST GROUP 2 : AUTHENTIFICATOR WITH FAKE CONNECTED USER
			 *
			 */
			Debug::log('TEST GROUP 2', 'AUTHENTIFICATOR WITH FAKE CONNECTED USER');
			$_SESSION = ['user' => 'john', 'password' => 'hello'];
			$model = new \Mangrova\Modules\Shared\Users\Model();
			$authentificator = new \Mangrova\Modules\Authentificator\Module($model);


			// TEST 1 - PROCESS RETURN VALUE (0)
			Test::assertEqual($authentificator->process(0), 1);






			/*
			 *
			 *	TEST GROUP 3 : AUTHENTIFICATOR WITH GOOD CONNECTED USER
			 *
			 */
			Debug::log('TEST GROUP 3', 'AUTHENTIFICATOR WITH GOOD CONNECTED USER');
			$_SESSION = ['user' => 'john', 'password' => 'bonjour'];
			$model = new \Mangrova\Modules\Shared\Users\Model();
			$authentificator = new \Mangrova\Modules\Authentificator\Module($model);


			// TEST 1 - PROCESS RETURN VALUE (0)
			Test::assertEqual($authentificator->process(0), 2);

		}
	}

	(new Test('Authentificator.results.txt'))->execute();
?>