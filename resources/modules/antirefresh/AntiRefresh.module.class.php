<?php

	/*
	=====================================================================================================
	Copyright (c) 2015 - Today, Treevea.
	All rights reserved.


	file : AntiRefresh.module.class.php
	brief :  contains the AntiRefresh module class' code
	authors : Matthieu JABBOUR
	version : 0.0
	date : 2015/09/14


	Further informations : www.treevea.com
	=====================================================================================================
	*/




	namespace Mangrova\Modules\AntiRefresh;
	use \Mangrova\Security;




	//====================================================================================================
	//	@brief :  module preventing from multiple form sents (on page refreshing)
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

			//	If a form has been sent...
			if(!empty($_POST) || !empty($_FILES))	{
				$_SESSION['$_POST'] = $_POST;
				$_SESSION['$_FILES'] = $_FILES;

				$urlRequest = $_SERVER['REQUEST_URI'];

				if(!empty($_SERVER['QUERY_STRING']))	{
					$urlRequest .= '?' . $_SERVER['QUERY_STRING'];
				}

				header('Location: ' . $urlRequest);
				exit;
			}
			//	If a form was previously sent...
			else if(isset($_SESSION))	{
				if(isset($_SESSION['$_POST']))	{
					$_POST = $_SESSION['$_POST'];
					unset($_SESSION['$_POST']);
				}
				if(isset($_SESSION['$_FILES']))	{
					$_FILES = $_SESSION['$_FILES'];
					unset($_SESSION['$_FILES']);
				}
			}
			
			return $appState;
		}

	}

?>