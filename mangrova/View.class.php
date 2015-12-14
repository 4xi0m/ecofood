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
	file : View.class.php
	brief :  Contains the View class' code
	author : Matthieu JABBOUR
	version : 1.0
	date : 2015/08/29

	More information at www.mangrova.org
	=====================================================================================================
	*/




	namespace Mangrova;



	
	//====================================================================================================
	//	@brief :  Abstract class modelizing views in a web application
	//====================================================================================================
	abstract class View
	{
		//	@type : HTMLComponent[]
		//	@brief : view components
		protected $m_components;

		//	@type : Model
		//	@brief : view model
		protected $m_model;




		//	@type : void
		//	@brief : class constructor
		//	@param : Model p_model = NULL - model to assign to the view
		public function __construct($p_model = NULL)	{
			Assert::type(__METHOD__, '$p_model instanceof Model || is_null($p_model)', $p_model instanceof Model || is_null($p_model));

			$this->m_model = $p_model;
			$this->m_components = array();
		}




		//	@type : void
		//	@brief : class destructor
		public function __destruct()	{
		}




		//	@type : View
		//	@brief : m_model setter
		//	@param : Model p_model - new model to assign to the view
		//	@return : returns the current View instance
		public function setModel($p_model)	{
			Assert::type(__METHOD__, '$p_model instanceof Model', $p_model instanceof Model);

			unset($this->m_model);						//	Destruction of the previous reference to avoid any conflict with the new one
			$this->m_model = $p_model;

			return $this;
		}




		//	@type : View
		//	@brief : adds an HTML component to the view
		//	@param : HTMLComponent p_component - HTML component to add
		//	@return : returns the current View instance
		public function add($p_component)	{
			Assert::type(__METHOD__, '$p_component instanceof HTMLComponent', $p_component instanceof HTMLComponent);

			$this->m_components[] = $p_component;

			return $this;
		}




		//	@type : void
		//	@brief : builds the view
		//	@param : mixed[] outputs - outputs renderd by the controller
		abstract protected function build($outputs);




		//	@type : void
		//	@brief : renders the view's HTML code
		//	@param : string tabulations - tabulations in the renderd HTML code
		//	@param : mixed[] outputs - outputs renderd by the controller
		public function render($tabulations, $outputs)	{
			Assert::type(__METHOD__, 'is_string($tabulations)', is_string($tabulations));
			Assert::type(__METHOD__, 'is_array($outputs)', is_array($outputs));

			$this->build($outputs);
			if(!empty($this->m_components))	{
				foreach($this->m_components as $component)	{
					$component->render($tabulations);
				}
			}
		}
	}

?>