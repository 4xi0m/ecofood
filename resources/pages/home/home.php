<?php

	/*
	=====================================================================================================
	Copyright (c) 2015 - Today, Treevea.
	All rights reserved.


	file : home.php
	brief :  contains the home page's code
	authors : Matthieu JABBOUR
	version : 0.0
	date : 2015/09/14


	Further informations : www.treevea.com
	=====================================================================================================
	*/




	namespace Mangrova;




	try {

		$main = (new Layouts\Main\Layout());


		$homePage = (new Applications\Standard\Application($main, 'Accueil'))
			->addMeta(new Meta(['charset' => 'UTF-8']))
			->addLink(new Link(['rel' => 'stylesheet', 'type' => 'text/css', 'href' => \Mangrova::$resourcesPath . '/pages/home/home.css']))
			->addScript(new Script(['src' => 'https://cdnjs.cloudflare.com/ajax/libs/react/0.13.0/react.js']))
			->addScript(new Script(['src' => 'https://cdnjs.cloudflare.com/ajax/libs/react/0.13.0/JSXTransformer.js']))
			->addScript(new Script(['src' => 'https://cdn.socket.io/socket.io-1.3.2.js']))
			->addScript(new Script(['type' => 'text/javascript', 'src' => \Mangrova::$resourcesPath . '/js/model/Project.class.js']))
			->addScript(new Script(['type' => 'text/javascript', 'src' => \Mangrova::$resourcesPath . '/js/model/Slide.class.js']))
			->addScript(new Script(['type' => 'text/javascript', 'src' => \Mangrova::$resourcesPath . '/js/model/Path.class.js']))
			->addScript(new Script(['type' => 'text/javascript', 'src' => \Mangrova::$resourcesPath . '/js/model/DragAndDrop.class.js']))
			->addScript(new Script(['type' => 'text/jsx', 'src' => \Mangrova::$resourcesPath . '/js/view/NavBar.react.js']))
			->addScript(new Script(['type' => 'text/jsx', 'src' => \Mangrova::$resourcesPath . '/js/view/ContentsList.react.js']))
			->addScript(new Script(['type' => 'text/jsx', 'src' => \Mangrova::$resourcesPath . '/js/view/ToolBar.react.js']))
			->addScript(new Script(['type' => 'text/jsx', 'src' => \Mangrova::$resourcesPath . '/pages/home/home.js']))
			->run();

	}
	catch (\Exception $e) {
		echo($e->getMessage());
	}

?>