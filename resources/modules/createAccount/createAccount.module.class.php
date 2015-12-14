<?php

	/*
	=====================================================================================================
	Copyright (c) 2015 - Today, Treevea.
	All rights reserved.


	file : Authentificator.module.class.php
	brief :  contains the Authentificator module class' code
	authors : Matthieu JABBOUR
	version : 0.0
	date : 2015/09/14


	Further informations : www.treevea.com
	=====================================================================================================
	*/




	namespace Mangrova\Modules\CreateAccount;
	use \Mangrova\Security;




	//====================================================================================================
	//	@brief :  module checking wether a user is already connected or not
	//====================================================================================================
	class Module extends \Mangrova\Module
	{
		//	@type : void
		//	@brief : class constructor
		//	@param : Model model - model to use for user authentification's verification
		public function __construct($model)	{
			parent::__construct($model, NULL, array());
		}




		//	@type : int
		//	@brief : executes the block's processes
		//	@param : int appState - execution state code that indicates how the previous controllers processes terminated 
		//	@param : mixed[] options - execution options
		//	@return : returns an execution state code that indicates how the controller process terminated
		public function process($appState, $options = array())	{

			/*if(isset($_SESSION))	{
				$session = Security::secure($_SESSION);

				if(isset($session['user']) && isset($session['password']))	{
					if($this->m_model->getUserPassword($session['user']) == $session['password'])	{
						//	STATE CODE = 2 : USER CONNECTED
						return 2;
					}
				}
			}*/

			$post = Security::secure($_POST);
			if(isset($post['name']))	{
				if($post['name'] == '' || $post['first_name'] == '' ||$post['mail'] == '' ||$post['phone'] == '' ||$post['adress'] == '')	{

				}
			}
			





			//	STATE CODE = 1 : NO CONNECTED USER
			return 1;
		}

	}

?>