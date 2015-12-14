<?php

	/*
	=====================================================================================================
	Copyright (c) 2015 - Today, Treevea.
	All rights reserved.


	file : Header.test.class.php
	brief :  contains the Header test class' code
	authors : Matthieu JABBOUR
	version : 0.0
	date : 2015/09/14


	Further informations : www.treevea.com
	=====================================================================================================
	*/




	namespace Mangrova\Tests\Header;
	use \Mangrova\Debug;
	include_once('../mangrova/Includes.php');
	include_once('../mangrova/Test.class.php');
	include_once('../resources/modules/header/Header.module.class.php');
	include_once('../resources/modules/header/Header.view.class.php');




	//====================================================================================================
	//	@brief :  test class for the Header module
	//====================================================================================================
	class Test extends \Mangrova\Test
	{
		//	@type : void
		//	@brief : executes a unitary & integration test procedure
		public function execute()	{


			/*
			 *
			 *	TEST GROUP 1 : DISPLAYING HEADER
			 *
			 */
			Debug::log('TEST GROUP 1', 'DISPLAYING HEADER');
			$header = new \Mangrova\Modules\Header\Module();


			// TEST 1 - PROCESS RETURN VALUE (0)
			Test::assertEqual($header->process(0), 0);

			//	TEST 2 - HEADER VIEW DISPLAYING
			$header->render('');
			Debug::log('TEST 2', 'OK');

		}
	}

	(new Test('Header.results.txt'))->execute();
?>