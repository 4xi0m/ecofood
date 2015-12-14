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
	file : Application.class.php
	brief :  Contains the Application class' code
	author : Matthieu JABBOUR
	version : 1.0
	date : 2015/08/29

	More information at www.mangrova.org
	=====================================================================================================
	*/




	namespace Mangrova;



	
	//====================================================================================================
	//	@brief :  Class modelizing a web application
	//====================================================================================================
	class Application
	{
		//	@type : string
		//	@brief : application's title
		private $m_title;

		//	@type : Block[]
		//	@brief : contains all the layouts and modules of the application
		private $m_blocks;

		//	@type : Link[]
		//	@brief : application's links
		private $m_links;

		//	@type : Script[]
		//	@brief : application's scripts
		private $m_scripts;

		//	@type : Meta[]
		//	@brief : application's meta properties
		private $m_metas;

		//	@type : int
		//	@brief : execution state code
		private $state;




		//	@type : void
		//	@brief : class constructor
		//	@param : string p_title = '' - application's title
		public function __construct($p_title = '')	{
			Assert::type(__METHOD__, 'is_string($p_title)', is_string($p_title));

			$this->m_title = $p_title;
			$this->m_blocks = array();
			$this->m_links = array();
			$this->m_scripts = array();
			$this->m_metas = array();
			$this->state = -1;
		}




		//	@type : void
		//	@brief : class destructor
		public function __destruct()	{
		}




		//	@type : bool
		//	@brief : indicates weither the web application is running or not
		//	@return : returns true if the web application is launched (state code -1), false else (state code >= 0)
		public function isRunning()	{
			return ($this->state >= 0);
		}




		//	@type : Application
		//	@brief : m_title setter
		//	@param : string p_title - title to set to the application
		//	@remark : the web application is not already launched
		//	@return : returns the current Application instance
		public function setTitle($p_title)	{
			Assert::type(__METHOD__, 'is_string($p_title)', is_string($p_title));
			Assert::precondition(__METHOD__, '$this->isRunning() == false', $this->isRunning() == false);

			$this->m_title = $p_title;

			return $this;
		}




		//	@type : Application
		//	@brief : adds a block to the application
		//	@param : Block p_block - block to add to the application
		//	@remark : the web application is not already launched and the block is not already in the application
		//	@return : returns the current Application instance
		public function addBlock($p_block)	{
			Assert::type(__METHOD__, '$p_block instanceof Block', $p_block instanceof Block);
			Assert::precondition(__METHOD__, '$this->isRunning() == false', $this->isRunning() == false);
			Assert::precondition(__METHOD__, 'in_array($p_block, $this->m_blocks, true) == false', in_array($p_block, $this->m_blocks, true) == false);

			$this->m_blocks[] = $p_block;

			foreach($p_block->getSettings() as $setting)	{
				if($setting instanceof Link)	{
					$this->addLink($setting);
				}
				else if($setting instanceof Meta)	{
					$this->addMeta($setting);
				}
				else if($setting instanceof Script)	{
					$this->addScript($setting);
				}
			}

			return $this;
		}




		//	@type : Application
		//	@brief : adds a meta property to the application
		//	@param : Meta p_meta - meta to add to the application
		//	@remark : the web application is not already launched
		//	@return : returns the current Application instance
		public function addMeta($p_meta)	{
			Assert::type(__METHOD__, '$p_meta instanceof Meta', $p_meta instanceof Meta);
			Assert::precondition(__METHOD__, '$this->isRunning() == false', $this->isRunning() == false);

			$this->m_metas[] = $p_meta;

			return $this;
		}




		//	@type : Application
		//	@brief : adds a script property to the application
		//	@param : Script p_script - script to add to the application
		//	@remark : the web application is not already launched
		//	@return : returns the current Application instance
		public function addScript($p_script)	{
			Assert::type(__METHOD__, '$p_script instanceof Script', $p_script instanceof Script);
			Assert::precondition(__METHOD__, '$this->isRunning() == false', $this->isRunning() == false);

			$this->m_scripts[] = $p_script;

			return $this;
		}




		//	@type : Application
		//	@brief : adds a link property to the application
		//	@param : Link p_link - link to add to the application
		//	@remark : the web application is not already launched
		//	@return : returns the current Application instance
		public function addLink($p_link)	{
			Assert::type(__METHOD__, '$p_link instanceof Link', $p_link instanceof Link);
			Assert::precondition(__METHOD__, '$this->isRunning() == false', $this->isRunning() == false);

			$this->m_links[] = $p_link;

			return $this;
		}




		//	@type : void
		//	@brief : launches the web application
		//	@param : mixed[] options = array() - execution options for the blocks
		public function run($options = array())	{
			Assert::type(__METHOD__, 'is_array($options)', is_array($options));

			foreach($this->m_blocks as $block)	{
				$this->state = $block->process($this->state, $options);
			}
			echo("<!DOCTYPE html>\n");
			echo("	<html>\n");
			echo("		<head>\n");
			foreach($this->m_metas as $meta)	{
				$meta->render('			');
			}
			foreach($this->m_links as $link)	{
				$link->render('			');
			}
			foreach($this->m_scripts as $script)	{
				$script->render('			');
			}

			echo("			<title>".$this->m_title."</title>\n");
			echo("		</head>\n");
			echo("		<body>\n");

			foreach($this->m_blocks as $block)	{
				$block->render('			');
			}

			echo("		</body>\n");
			echo("	</html>\n");
		}
	}

?>