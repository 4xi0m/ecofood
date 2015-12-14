<?php

	/*
	=====================================================================================================
	Copyright (c) 2015 - Today, Treevea.
	All rights reserved.


	file : Standard.application.class.php
	brief :  contains the standard application class' code
	authors : Matthieu JABBOUR
	version : 0.0
	date : 2015/09/14


	Further informations : www.treevea.com
	=====================================================================================================
	*/




	namespace Mangrova\Applications\Standard;
	use Mangrova\Modules;
	use Mangrova\Link;
	use Mangrova\Script;




	//====================================================================================================
	//	@brief : application's standard template
	//====================================================================================================
	class Application extends \Mangrova\Application
	{
		//	@type : void
		//	@brief : class constructor
		//	@param : Block main - main content of the application
		//	@param : string p_title - application's title
		public function __construct(\Mangrova\Block $main, $title = '')	{
			parent::__construct($title);


			//	Users data for Authentificator module
			$existingUsers = new Modules\Shared\Users\Model();


			$this
				->addLink(new Link(['rel' => 'stylesheet', 'type' => 'text/css', 'href' => '/resources/css/global.css']))
				->addScript(new Script(['type' => 'text/javascript', 'src' => '/resources/js/view/load.js']))
				//->addBlock(new Modules\FormToken\Module())
				//->addBlock(new Modules\Authentificator\Module($existingUsers))
				//->addBlock(new Modules\Redirection\Module())
				//->addBlock(new Modules\RightMenu\Module())
				//->addBlock(new Modules\LeftMenu\Module())
				->addBlock($main);
				//->addBlock(new Modules\Menu\Module());
		}
	}

?>