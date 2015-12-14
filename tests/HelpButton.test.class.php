<?php

	/*
	=====================================================================================================
	Copyright (c) 2015 - Today, Treevea.
	All rights reserved.


	file : HelpButton.test.class.php
	brief :  contains the HelpButton test class' code
	authors : Matthieu JABBOUR
	version : 0.0
	date : 2015/09/14


	Further informations : www.treevea.com
	=====================================================================================================
	*/




	namespace Mangrova\Tests\HelpButton;
	use \Mangrova\Debug;
	include_once('../mangrova/Includes.php');
	include_once('../mangrova/Test.class.php');
	include_once('../resources/modules/helpbutton/HelpButton.module.class.php');
	include_once('../resources/modules/helpbutton/HelpButton.view.class.php');




	//====================================================================================================
	//	@brief :  test class for the HelpButton module
	//====================================================================================================
	class Test extends \Mangrova\Test
	{
		//	@type : void
		//	@brief : executes a unitary & integration test procedure
		public function execute()	{


			/*
			 *
			 *	TEST GROUP 1 : DISPLAYING HELPBUTTON
			 *
			 */
			Debug::log('TEST GROUP 1', 'DISPLAYING HELPBUTTON');
			$helpbutton = new \Mangrova\Modules\HelpButton\Module();


			// TEST 1 - PROCESS RETURN VALUE (0)
			Test::assertEqual($helpbutton->process(0), 0);

			//	TEST 2 - HELPBUTTON VIEW DISPLAYING
			$helpbutton->render('');
			Debug::log('TEST 2', 'OK');

		}
	}

	(new Test('HelpButton.results.txt'))->execute();
?>