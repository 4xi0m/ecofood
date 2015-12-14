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
	file : Tag.class.php
	brief :  Contains the Tag class' code
	author : Matthieu JABBOUR
	version : 1.0
	date : 2015/08/29

	More information at www.mangrova.org
	=====================================================================================================
	*/




	namespace Mangrova;



	
	//====================================================================================================
	//	@brief :  Class modelizing a common HTML tag
	//====================================================================================================
	class Tag extends HTMLComponent
	{
		//	@type : string
		//	@brief : HTML tag's name
		protected $m_tag;

		//	@type : string[]
		//	@brief : contains all the attributes of the HTML tag
		protected $m_attributes;

		//	@type : string
		//	@brief : HTML tag's text content
		protected $m_content;

		//	@type : HTMLComponent[]
		//	@brief : contains all the children nodes of the HTML tag
		protected $m_components;




		//	@type : void
		//	@brief : class constructor
		//	@param : string p_tag - name of the HTML tag
		//	@param : string[] p_attributes = array() - tag attributes
		//	@param : string p_content = '' - tag content
		//	@param : HTMLComponent[] p_components = array() - list of the tag's children components
		public function __construct($p_tag, $p_attributes = array(), $p_content = '', $p_components = array())	{
			Assert::type(__METHOD__, 'is_string($p_tag)', is_string($p_tag));
			Assert::type(__METHOD__, 'is_array($p_attributes)', is_array($p_attributes));
			Assert::type(__METHOD__, 'is_string($p_content)', is_string($p_content));
			Assert::type(__METHOD__, 'is_array($p_components)', is_array($p_components));

			parent::__construct();
			$this->m_tag = $p_tag;
			$this->m_attributes = $p_attributes;
			$this->m_content = $p_content;
			if(sizeof($p_components) > 0)	{
				for($i = 0; $i < sizeof($p_components); ++$i)	{
					$this->add($p_components[$i]);
				}
			}
			else	{
				$this->m_components = array();
			}
		}




		//	@type : void
		//	@brief : class destructor
		public function __destruct()	{
		}




		//	@type : Tag
		//	@brief : adds an HTML component to the current HTML component
		//	@param : HTMLComponent p_component - HTML component to add
		//	@return : returns the current Tag instance
		public function add($p_component)	{
			Assert::type(__METHOD__, '$p_component instanceof HTMLComponent', $p_component instanceof HTMLComponent);

			$this->m_components[] = $p_component;

			return $this;
		}




		//	@type : Tag
		//	@brief : sets a new value to the given attribute for the current HTML component
		//	@param : string p_attribute - attribute to set
		//	@param : string p_value - value of the attribute
		//	@return : returns the current Tag instance
		public function setAttribute($p_attribute, $p_value)	{
			Assert::type(__METHOD__, 'is_string($p_attribute)', is_string($p_attribute));
			Assert::type(__METHOD__, 'is_string($p_value)', is_string($p_value));

			$this->m_attributes[$p_attribute] = $p_value;

			return $this;
		}




		//	@type : Tag
		//	@brief : sets a new content to the current HTML component
		//	@param : string p_content - content to set
		//	@return : returns the current Tag instance
		public function setContent($p_content)	{
			Assert::type(__METHOD__, 'is_string($p_content)', is_string($p_content));

			$this->m_content = $p_content;

			return $this;
		}




		//	@type : void
		//	@brief : renders the component's HTML code
		//	@param : string tabulations - tabulations in the renderd HTML code
		public function render($tabulations)	{
			Assert::type(__METHOD__, 'is_string($tabulations)', is_string($tabulations));
			Debug::startTimer('render');

			$singleTags = array('input', 'br', 'hr', 'img', 'meta', 'link');

			//	m_attributes serialization
			$attributes = '';
			foreach($this->m_attributes as $attribute => $value)	{
				$attributes = $attributes.' '.$attribute.'="'.$value.'"';
			}

			//	<tag> type HTML tags
			if(in_array($this->m_tag, $singleTags))	{
				echo($tabulations.'<'.$this->m_tag.' '.$attributes.'>'."\n");
			}
			//	<tag></tag> type HTML tags
			else{
				echo($tabulations.'<'.$this->m_tag.$attributes.">\n");
				if($this->m_content != '')	{
					echo($tabulations.'	'.$this->m_content."\n");
				}
				foreach($this->m_components as $component)	{
					$component->render($tabulations.'	');
				}
				echo($tabulations.'</'.$this->m_tag.">\n");
			}
			Debug::stopTimer('render');
		}
	}

?>