<?php

	/*
	=====================================================================================================
	Copyright (c) 2015 - Today, Treevea.
	All rights reserved.


	file : AntiRefresh.test.class.php
	brief :  contains the AntiRefresh test class' code
	authors : Matthieu JABBOUR
	version : 0.0
	date : 2015/09/14


	Further informations : www.treevea.com
	=====================================================================================================
	*/




	namespace Mangrova\Tests\AntiRefresh;
	use \Mangrova\Debug;
	include_once('../mangrova/Includes.php');
	include_once('../mangrova/Test.class.php');
	include_once('../resources/modules/antirefresh/AntiRefresh.module.class.php');




	//====================================================================================================
	//	@brief :  test class for the AntiRefresh module
	//====================================================================================================
	class Test extends \Mangrova\Test
	{
		//	@type : void
		//	@brief : executes a unitary & integration test procedure
		public function execute()	{


			/*
			 *
			 *	TEST GROUP 1 : ANTIREFRESH WITH NO FORM DATA SENT
			 *
			 */
			Debug::log('TEST GROUP 1', 'ANTIREFRESH WITH NO FORM DATA SENT');
			$antirefresh = new \Mangrova\Modules\AntiRefresh\Module();


			// TEST 1
			Test::assertEqual($antirefresh->process(0), 0);
			Test::assertEqual(empty($_POST), true);
			Test::assertEqual(empty($_FILES), true);


		}
	}

	(new Test('AntiRefresh.results.txt'))->execute();
?>