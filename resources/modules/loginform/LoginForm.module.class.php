<?php

	/*
	=====================================================================================================
	Copyright (c) 2015 - Today, Treevea.
	All rights reserved.


	file : LoginForm.module.class.php
	brief :  contains the LoginForm module class' code
	authors : Matthieu JABBOUR
	version : 0.0
	date : 2015/09/14


	Further informations : www.treevea.com
	=====================================================================================================
	*/




	namespace Mangrova\Modules\LoginForm;
	use \Mangrova\Security;




	//====================================================================================================
	//	@brief :  module generating a login form
	//====================================================================================================
	class Module extends \Mangrova\Module
	{
		//	@type : void
		//	@brief : class constructor
		//	@param : Model model - model to use for user authentification's verification
		//	@param : HTMLComponent[] p_settings = [] - global settings to assign to the module
		public function __construct($model, $p_settings = [])	{
			$p_settings[] = new \Mangrova\Link(['rel' => 'stylesheet', 'type' => 'text/css', 'href' => Module::path() . 'LoginForm.css']);
			parent::__construct($model, new View(), $p_settings);
		}




		//	@type : int
		//	@brief : executes the block's processes
		//	@param : int appState - execution state code that indicates how the previous controllers processes terminated 
		//	@param : mixed[] options - execution options
		//	@return : returns an execution state code that indicates how the controller process terminated
		public function process($appState, $options = array())	{
			$post = Security::secure($_POST);
			$this->outputs['error'] = false;

			//	We only check the sent data if they exist and if a connected user has not already been detected
			if(!empty($post) && $appState != 2)	{
				if($this->m_model->getUserPassword($post['user']) !== NULL && $this->m_model->getUserPassword($post['user']) == $post['password'])	{
					$_SESSION['user'] = $post['user'];
					$_SESSION['password'] = $post['password'];
					//	STATE CODE = 2 : CONNECTED USER
					return 2;
				}
				else	{
					$this->outputs['error'] = true;

					//	STATE CODE = 1 : NO CONNECTED USER
					return 1;
				}
			}

			return $appState;
		}

	}

?>