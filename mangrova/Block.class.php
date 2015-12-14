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
	file : Block.class.php
	brief :  Contains the Block class' code
	author : Matthieu JABBOUR
	version : 1.0
	date : 2015/08/29

	More information at www.mangrova.org
	=====================================================================================================
	*/




	namespace Mangrova;



	
	//====================================================================================================
	//	@brief :  Abstract class modelizing a function block in a web application
	//====================================================================================================
	abstract class Block
	{
		//	@type : HTMLComponent[]
		//	@brief : contains all the block settings (scripts and links)
		protected $m_settings;




		//	@type : void
		//	@brief : class constructor
		//	@param : HTMLComponent[] p_settings - global settings to assign to the block
		public function __construct($p_settings)	{
			Assert::type(__METHOD__, 'is_array($p_settings)', is_array($p_settings));

			$this->m_settings = $p_settings;
		}




		//	@type : void
		//	@brief : class destructor
		public function __destruct()	{
		}




		//	@type : HTMLComponent&[]
		//	@brief : m_settings getter
		//	@return : returns the block's settings
		public function getSettings()	{
			return $this->m_settings;
		}




		//	@type : int
		//	@brief : executes the block's processes
		//	@param : int appState - execution state code that indicates how the previous controllers processes terminated 
		//	@param : mixed[] options - execution options
		//	@return : returns an execution state code that indicates how the controller process terminated
		abstract public function process($appState, $options);




		//	@type : void
		//	@brief : renders the block's HTML code
		//	@param : string tabulations - tabulations in the renderd HTML code
		abstract public function render($tabulations);
	}

?>