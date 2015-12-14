<?php

	/*
	=====================================================================================================
	Copyright (c) 2015 - Today, Treevea.
	All rights reserved.


	file : Menu.test.class.php
	brief :  contains the Menu test class' code
	authors : Matthieu JABBOUR
	version : 0.0
	date : 2015/09/14


	Further informations : www.treevea.com
	=====================================================================================================
	*/




	namespace Mangrova\Tests\Menu;
	use \Mangrova\Debug;
	include_once('../mangrova/Includes.php');
	include_once('../mangrova/Test.class.php');
	include_once('../resources/modules/menu/Menu.module.class.php');
	include_once('../resources/modules/menu/Menu.view.class.php');




	//====================================================================================================
	//	@brief :  test class for the Menu module
	//====================================================================================================
	class Test extends \Mangrova\Test
	{
		//	@type : void
		//	@brief : executes a unitary & integration test procedure
		public function execute()	{


			/*
			 *
			 *	TEST GROUP 1 : DISPLAYING MENU
			 *
			 */
			Debug::log('TEST GROUP 1', 'DISPLAYING MENU');
			$menu = new \Mangrova\Modules\Menu\Module();


			// TEST 1 - PROCESS RETURN VALUE (0)
			Test::assertEqual($menu->process(0), 0);

			//	TEST 2 - MENU VIEW DISPLAYING
			$menu->render('');
			Debug::log('TEST 2', 'OK');

		}
	}

	(new Test('Menu.results.txt'))->execute();
?>