<?php

	/*
	=====================================================================================================
	Copyright (c) 2015 - Today, Treevea.
	All rights reserved.


	file : AccountWidget.model.class.php
	brief :  contains the AccountWidget model class' code
	authors : Matthieu JABBOUR
	version : 0.0
	date : 2015/09/14


	Further informations : www.treevea.com
	=====================================================================================================
	*/




	namespace Mangrova\Modules\Shared\Users;




	//====================================================================================================
	//	@brief :  model providing users connection informations for other modules, such as Authentificator
	//====================================================================================================
	class Model extends \Mangrova\Model
	{
		//	@type : void
		//	@brief : class constructor
		public function __construct()	{
			parent::__construct(['john' => 'bonjour']);
		}



		//	@type : string
		//	@brief : returns the password of the user given in parameter if it exists
		//	@param : string user - user id
		//	@return : returns the password of the user given in parameter if it exists, NULL otherwise
		public function getUserPassword($user)	{
			return $this->get($user);
		}
	}

?>