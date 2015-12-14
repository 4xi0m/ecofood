<?php

	/*
	=====================================================================================================
	Copyright (c) 2015 - Today, Treevea.
	All rights reserved.


	file : login.php
	brief :  contains the login page's code
	authors : Matthieu JABBOUR
	version : 0.0
	date : 2015/09/14


	Further informations : www.treevea.com
	=====================================================================================================
	*/




	namespace Mangrova;




	try {

		$loginPage = new Application('Connexion');


		//	Users data for Authentificator and LoginForm modules
		$existingUsers = new Modules\Shared\Users\Model();


		$main = (new Layouts\Main\Layout())
			->addBlock(new Modules\HelpButton\Module())
			->addBlock(new Modules\LoginForm\Module($existingUsers));


		$loginPage
			->addLink(new Link(['rel' => 'stylesheet', 'type' => 'text/css', 'href' => \Mangrova::$resourcesPath . '/css/global.css']))
			->addBlock(new Modules\FormToken\Module())
			->addBlock(new Modules\AntiRefresh\Module())
			->addBlock(new Modules\Authentificator\Module($existingUsers))
			->addBlock($main)
			->addBlock(new Modules\Redirection\Module())
	 	 	->run();

	}
	catch (\Exception $e) {
		echo($e->getMessage());
	}

?>