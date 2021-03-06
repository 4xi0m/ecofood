<?php

	/*
	=====================================================================================================
	Copyright (c) 2015 - Today, Treevea.
	All rights reserved.


	file : LoginForm.view.class.php
	brief :  contains the LoginForm view class' code
	authors : Matthieu JABBOUR
	version : 0.0
	date : 2015/09/14


	Further informations : www.treevea.com
	=====================================================================================================
	*/




	namespace Mangrova\Modules\LoginForm;
	use \Mangrova\Tag;
	use \Mangrova\HTMLTags as Tags;




	//====================================================================================================
	//	@brief : view rendering the login form
	//====================================================================================================
	class View extends \Mangrova\View
	{
		//	@type : void
		//	@brief : creates the view
		//	@param : mixed[] outputs - outputs generated by the controller
		protected function build($outputs)	{

			if($outputs['error'] == true)	{
				$this->add(Tags\dialog(['open' => ''], 'The combinaison user/password is not correct. Please check your input and try again.'));
			}

			$form = Tags\form(['action' => '/login', 'method' => 'POST'])
				->add(new Tag('input', ['name' => 'user']))
				->add(new Tag('input', ['name' => 'password']))
				->add(new Tag('input', ['type' => 'hidden', 'name' => 'formToken', 'value' => $_SESSION['formToken']]))
				->add(new Tag('input', ['type' => 'submit']));

			$this->add($form);
		}
	}

?>