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
	file : Layout.class.php
	brief :  Contains the Layout class' code
	author : Matthieu JABBOUR
	version : 1.0
	date : 2015/08/29

	More information at www.mangrova.org
	=====================================================================================================
	*/




	namespace Mangrova;



	
	//====================================================================================================
	//	@brief :  Abstract class modelizing a layout in a web application
	//====================================================================================================
	abstract class Layout extends Block
	{
		//	@type : string
		//	@brief : layouts' absolute path on the server (from Mangrova::webRoot)
		public static $path = '/resources/layouts';

		//	@type : Block[]
		//	@brief : contains all the layout blocks
		protected $m_blocks;

		//	@type : int
		//	@brief : execution state code
		private $state;




		//	@type : void
		//	@brief : class constructor
		//	@param : mixed[] p_settings - global settings to assign to the block
		public function __construct($p_settings)	{
			Assert::type(__METHOD__, 'is_array($p_settings)', is_array($p_settings));

			parent::__construct($p_settings);
			$this->m_blocks = array();
			$this->state = -1;
		}




		//	@type : void
		//	@brief : class destructor
		public function __destruct()	{
		}




		//	@type : string
		//	@brief : returns the current layout's directory full path (from Mangrova::webRoot)
		//	@return : returns the current layout's directory full path (from Mangrova::webRoot)
		public static function path()	{
			$className = explode('\\', get_called_class());
			return Layout::$path . '/' . strtolower($className[sizeof($className) - 2]) . '/';
		}




		//	@type : Layout
		//	@brief : adds a block to the layout
		//	@param : Block p_block - block to add
		//	@remark : the block is not already in the layout
		//	@return : returns the current Layout instance
		public function addBlock($p_block)	{
			Assert::type(__METHOD__, '$p_block instanceof Block', $p_block instanceof Block);
			Assert::precondition(__METHOD__, 'in_array($p_block, $this->m_blocks, true) == false', in_array($p_block, $this->m_blocks, true) == false);

			$this->m_blocks[] = $p_block;

			foreach($p_block->getSettings()	as $setting)	{
				$this->m_settings[] = $setting;
			}

			return $this;
		}




		//	@type : int
		//	@brief : executes the layout's processes
		//	@param : int appState - execution state code that indicates how the previous controllers processes terminated 
		//	@param : mixed[] options - execution options
		//	@return : returns an execution state code that indicates how the execution process terminated
		public function process($appState, $options)	{
			$this->state = $appState;

			foreach($this->m_blocks as $block)	{
				$this->state = $block->process($this->state, $options);
			}

			return $this->state;
		}
	}

?>