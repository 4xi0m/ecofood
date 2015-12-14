<?php

	/*
	=====================================================================================================
	Copyright (c) 2015 - Today, Treevea.
	All rights reserved.


	file : dashboard.php
	brief :  contains the dashboard page's code
	authors : Matthieu JABBOUR
	version : 0.0
	date : 2015/09/24


	Further informations : www.treevea.com
	=====================================================================================================
	*/




	namespace Mangrova;




	try {

		$main = (new Layouts\Main\Layout());


		$dashboard = (new Applications\Standard\Application($main, 'Tableau de bord'))
			->addLink(new Link(['rel' => 'stylesheet', 'type' => 'text/css', 'href' => \Mangrova::$resourcesPath . '/pages/dashboard/dashboard.css']))
			->addScript(new Script(['src' => 'https://cdnjs.cloudflare.com/ajax/libs/react/0.13.0/react.js']))
			->addScript(new Script(['src' => 'https://cdnjs.cloudflare.com/ajax/libs/react/0.13.0/JSXTransformer.js']))
			->addScript(new Script(['src' => 'https://cdn.socket.io/socket.io-1.3.2.js']))
			->addScript(new Script(['type' => 'text/jsx', 'src' => \Mangrova::$resourcesPath . '/pages/dashboard/dashboard.js']))
			->run();

	}
	catch (\Exception $e) {
		echo($e->getMessage());
	}

?>