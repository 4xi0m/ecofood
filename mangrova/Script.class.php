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
	file : Script.class.php
	brief :  Contains the Script class' code
	author : Matthieu JABBOUR
	version : 1.0
	date : 2015/08/29

	More information at www.mangrova.org
	=====================================================================================================
	*/




	namespace Mangrova;



	
	//====================================================================================================
	//	@brief :  Class modelizing a script HTML tag
	//====================================================================================================
	class Script extends HTMLComponent
	{
		//	@type : string[]
		//	@brief : script attributes
		protected $m_attributes;

		//	@type : string
		//	@brief : script content
		protected $m_content;




		//	@type : void
		//	@brief : class constructor
		//	@param : string[] p_attributes - script attributes
		//	@param : string p_content = '' - script content
		public function __construct($p_attributes, $p_content = '')	{
			Assert::type(__METHOD__, 'is_array($p_attributes)', is_array($p_attributes));
			Assert::type(__METHOD__, 'is_string($p_content)', is_string($p_content));

			parent::__construct();
			$this->m_attributes = $p_attributes;
			$this->m_content = $p_content;
		}




		//	@type : void
		//	@brief : class destructor
		public function __destruct()	{
		}




		//	@type : void
		//	@brief : renders the script's HTML code
		//	@param : string tabulations - tabulations in the renderd HTML code
		public function render($tabulations)	{
			Assert::type(__METHOD__, 'is_string($tabulations)', is_string($tabulations));
			Debug::startTimer('render');

			//	m_attributes serialization
			$attributes = '';
			foreach($this->m_attributes as $attribute => $value)	{
				$attributes = $attributes.' '.$attribute.'="'.$value.'"';
			}
			echo($tabulations.'<script'.$attributes.'>'."\n");
			if($this->m_content != '')	{
				echo($tabulations.'	'.$this->m_content."\n");
			}
			echo($tabulations.'</script>'."\n");
			Debug::stopTimer('render');
		}
	}

?>