<?php

	/*
	=====================================================================================================
	Copyright (c) 2015 - Today, Treevea.
	All rights reserved.


	file : Footer.test.class.php
	brief :  contains the Footer test class' code
	authors : Matthieu JABBOUR
	version : 0.0
	date : 2015/09/14


	Further informations : www.treevea.com
	=====================================================================================================
	*/




	namespace Mangrova\Tests\Footer;
	use \Mangrova\Debug;
	include_once('../mangrova/Includes.php');
	include_once('../mangrova/Test.class.php');
	include_once('../resources/modules/footer/Footer.module.class.php');
	include_once('../resources/modules/footer/Footer.view.class.php');




	//====================================================================================================
	//	@brief :  test class for the Footer module
	//====================================================================================================
	class Test extends \Mangrova\Test
	{
		//	@type : void
		//	@brief : executes a unitary & integration test procedure
		public function execute()	{


			/*
			 *
			 *	TEST GROUP 1 : DISPLAYING FOOTER
			 *
			 */
			Debug::log('TEST GROUP 1', 'DISPLAYING FOOTER');
			$footer = new \Mangrova\Modules\Footer\Module();


			// TEST 1 - PROCESS RETURN VALUE (0)
			Test::assertEqual($footer->process(0), 0);

			//	TEST 2 - FOOTER VIEW DISPLAYING
			$footer->render('');
			Debug::log('TEST 2', 'OK');

		}
	}

	(new Test('Footer.results.txt'))->execute();
?>