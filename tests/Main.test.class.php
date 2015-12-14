<?php

	/*
	=====================================================================================================
	Copyright (c) 2015 - Today, Treevea.
	All rights reserved.


	file : Main.test.class.php
	brief :  contains the Main test class' code
	authors : Matthieu JABBOUR
	version : 0.0
	date : 2015/09/14


	Further informations : www.treevea.com
	=====================================================================================================
	*/




	namespace Mangrova\Tests\Main;
	use \Mangrova\Debug;
	include_once('../mangrova/Includes.php');
	include_once('../mangrova/Test.class.php');
	include_once('../resources/layouts/main/Main.layout.class.php');




	//====================================================================================================
	//	@brief :  test class for the Main module
	//====================================================================================================
	class Test extends \Mangrova\Test
	{
		//	@type : void
		//	@brief : executes a unitary & integration test procedure
		public function execute()	{


			/*
			 *
			 *	TEST GROUP 1 : DISPLAYING MAIN
			 *
			 */
			Debug::log('TEST GROUP 1', 'DISPLAYING MAIN');
			$main = new \Mangrova\Layouts\Main\Layout();

			//	TEST 1 - MAIN VIEW DISPLAYING
			$main->render('');
			Debug::log('TEST 2', 'OK');

		}
	}

	(new Test('Main.results.txt'))->execute();
?>