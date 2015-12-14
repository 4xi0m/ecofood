<?php

	/*
	=====================================================================================================
	The MIT License (MIT)

	Copyright (c) 2015 - Now, Mangrova

	Permission is hereby granted, free of charge, to any person obtaining a copy
	of this software and associated documentation files (the "Software"), to deal
	in the Software without restriction, including without limitation the rights
	to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
	copies of the Software, and to permit persons to whom the Software is
	furnished to do so, subject to the following conditions:

	The above copyright notice and this permission notice shall be included in
	all copies or substantial portions of the Software.

	THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
	IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
	FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
	AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
	LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
	OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
	THE SOFTWARE.
	=====================================================================================================



	=====================================================================================================
	file : Module.class.php
	brief :  Contains the Module class' code
	author : Matthieu JABBOUR
	version : 1.0
	date : 2015/08/29

	More information at www.mangrova.org
	=====================================================================================================
	*/




	namespace Mangrova;



	
	//====================================================================================================
	//	@brief :  Abstract class modelizing a module in a web application
	//====================================================================================================
	abstract class Module extends Block
	{
		//	@type : string
		//	@brief : modules' absolute path on the server (from Mangrova::webRoot)
		public static $path = '/resources/modules';

		//	@type : Model
		//	@brief : module's model
		protected $m_model;

		//	@type : View
		//	@brief : module's view
		protected $m_view;

		//	@type : mixed[]
		//	@brief : outputs renderd by the module's executing process
		protected $outputs;




		//	@type : void
		//	@brief : class constructor
		//	@param : Model p_model - model to assign to the module
		//	@param : View p_view - view to assign to the module
		//	@param : HTMLComponent[] p_settings - global settings to assign to the module
		public function __construct($p_model, $p_view, $p_settings)	{
			Assert::type(__METHOD__, '$p_model instanceof Model || is_null($p_model)', $p_model instanceof Model || is_null($p_model));
			Assert::type(__METHOD__, '$p_view instanceof View || is_null($p_view)', $p_view instanceof View || is_null($p_view));

			parent::__construct($p_settings);
			$this->m_model = $p_model;
			$this->m_view = $p_view;
			$this->outputs = array();
		}




		//	@type : void
		//	@brief : class destructor
		public function __destruct()	{
		}




		//	@type : Module
		//	@brief : m_model setter
		//	@param : Model p_model - new model to assign to the module
		//	@return : returns the current Module instance
		public function setModel($p_model)	{
			Assert::type(__METHOD__, '$p_model instanceof Model', $p_model instanceof Model);

			unset($this->m_model);						//	Destruction of the previous reference to avoid any conflict with the new one
			$this->m_model = $p_model;

			return $this;
		}




		//	@type : Module
		//	@brief : m_view setter
		//	@param : View p_view - new view to assign to the module
		//	@return : returns the current Module instance
		public function setView($p_view)	{
			Assert::type(__METHOD__, '$p_view instanceof View', $p_view instanceof View);

			unset($this->m_view);						//	Destruction of the previous reference to avoid any conflict with the new one
			$this->m_view = $p_view;

			return $this;
		}




		//	@type : string
		//	@brief : returns the current module's directory full path (from Mangrova::webRoot)
		//	@return : returns the module's directory full path (from Mangrova::webRoot)
		public static function path()	{
			$className = explode('\\', get_called_class());
			return Module::$path . '/' . strtolower($className[sizeof($className) - 2]) . '/';
		}




		//	@type : void
		//	@brief : renders the module's HTML code
		//	@param : string tabulations - tabulations in the renderd HTML code
		public function render($tabulations)	{
			if($this->m_view != NULL)	{
				$this->m_view->render($tabulations, $this->outputs);
			}
		}
	}

?>