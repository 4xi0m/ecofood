<?php

	/*
	=====================================================================================================
	Copyright (c) 2015 - Today, Treevea.
	All rights reserved.


	file : Redirection.module.class.php
	brief :  contains the Redirection module class' code
	authors : Matthieu JABBOUR
	version : 0.0
	date : 2015/09/14


	Further informations : www.treevea.com
	=====================================================================================================
	*/




	namespace Mangrova\Modules\Redirection;




	//====================================================================================================
	//	@brief :  module handling redirection if needed (in case no user is connected for instance)
	//====================================================================================================
	class Module extends \Mangrova\Module
	{
		//	@type : void
		//	@brief : class constructor
		public function __construct()	{
			parent::__construct(NULL, NULL, []);
		}




		//	@type : int
		//	@brief : executes the block's processes
		//	@param : int appState - execution state code that indicates how the previous controllers processes terminated 
		//	@param : mixed[] options - execution options
		//	@return : returns an execution state code that indicates how the controller process terminated
		public function process($appState, $options = array())	{
			//	Asking for an account page whereas no user is connected...
			if($appState == 1 && !preg_match('#^/login/?$#', $_SERVER['REQUEST_URI']))	{
				header('Status: 302 Moved Temporarely', false, 302);      
				header('Location: /login');
				exit;
			}
			//	Asking for the login page whereas a user is already connected...
			else if($appState != 1 && preg_match('#^/login/?$#', $_SERVER['REQUEST_URI']))	{
				header('Status: 302 Moved Temporarely', false, 302);      
				header('Location: /');
				exit;
			}

			return $appState;
		}
	}

?>