<?php

	/*
	=====================================================================================================
	Copyright (c) 2015 - Today, Treevea.
	All rights reserved.


	file : Redirection.test.class.php
	brief :  contains the Redirection test class' code
	authors : Matthieu JABBOUR
	version : 0.0
	date : 2015/09/14


	Further informations : www.treevea.com
	=====================================================================================================
	*/




	namespace Mangrova\Tests\Redirection;
	use \Mangrova\Debug;
	include_once('../mangrova/Includes.php');
	include_once('../mangrova/Test.class.php');
	include_once('../resources/modules/redirection/Redirection.module.class.php');




	//====================================================================================================
	//	@brief :  test class for the Redirection module
	//====================================================================================================
	class Test extends \Mangrova\Test
	{
		//	@type : void
		//	@brief : executes a unitary & integration test procedure
		public function execute()	{


			/*
			 *
			 *	TEST GROUP 1 : REDIRECTION VARIANTS
			 *
			 */
			Debug::log('TEST GROUP 1', 'REDIRECTION VARIANTS');
			$redirection = new \Mangrova\Modules\Redirection\Module();


			// TEST 1 - REDIRECTION WITH APPSTATE = 1 AND WITH URI != /login
			$_SERVER['REQUEST_URI'] = '/';
			$redirection->process(1);
			Debug::log('TEST 1', 'OK');

			// TEST 2 - REDIRECTION WITH APPSTATE = 1 AND WITH URI == /login
			$_SERVER['REQUEST_URI'] = '/login';
			$redirection->process(1);
			Debug::log('TEST 2', 'OK');

			// TEST 3 - REDIRECTION WITH APPSTATE = 2 AND WITH URI != /login
			$_SERVER['REQUEST_URI'] = '/';
			$redirection->process(2);
			Debug::log('TEST 3', 'OK');

			// TEST 2 - REDIRECTION WITH APPSTATE = 2 AND WITH URI == /login
			$_SERVER['REQUEST_URI'] = '/login';
			$redirection->process(2);
			Debug::log('TEST 4', 'OK');
		}
	}

	(new Test('Redirection.results.txt'))->execute();
?>