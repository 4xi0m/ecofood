<?php

	/*
	=====================================================================================================
	Copyright (c) 2015 - Today, Treevea.
	All rights reserved.


	file : FormToken.module.class.php
	brief :  contains the FormToken module class' code
	authors : Matthieu JABBOUR
	version : 0.0
	date : 2015/09/14


	Further informations : www.treevea.com
	=====================================================================================================
	*/




	namespace Mangrova\Modules\FormToken;
	use \Mangrova\Security;




	//====================================================================================================
	//	@brief :  module preventing from external POST data sending 
	//====================================================================================================
	class Module extends \Mangrova\Module
	{
		//	@type : void
		//	@brief : class constructor
		public function __construct()	{
			parent::__construct(NULL, NULL, array());
		}




		//	@type : int
		//	@brief : executes the block's processes
		//	@param : int appState - execution state code that indicates how the previous controllers processes terminated 
		//	@param : mixed[] options - execution options
		//	@return : returns an execution state code that indicates how the controller process terminated
		public function process($appState, $options = array())	{

			$post = Security::secure($_POST);
			$session = Security::secure($_SESSION);

			if($_SERVER['REQUEST_METHOD'] == 'GET')	{
				if(!isset($_SESSION['formToken']))	{
					$_SESSION['formToken'] = rand();
				}
			}
			else	{
				if(!isset($session['formToken']) || !isset($post['formToken']) || $session['formToken'] != $post['formToken'])	{
					header('Status: 403 Forbidden', false, 403);      
					exit;
				}
			}

			return $appState;
		}

	}

?>