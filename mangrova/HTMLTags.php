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
	file : HTMLTags.php
	brief :  Contains some shortcut functions to create HTML tags easier and faster
	author : Matthieu JABBOUR
	version : 1.0
	date : 2015/08/29

	More information at www.mangrova.org
	=====================================================================================================
	*/




	namespace Mangrova\HTMLTags;
	use \Mangrova\Tag;




	//	@type : Tag
	//	@brief : creates a h1 HTML tag
	//	@param : string[] attributes = array() - tag attributes
	//	@param : string content = '' - tag content
	//	@param : HTMLComponent[] components = array() - list of the tag's children components
	//	@return : returns a new h1 Tag instance
	function h1($attributes = array(), $content = '', $components = array())	{
		return new Tag('h1', $attributes, $content, $components);
	}




	//	@type : Tag
	//	@brief : creates a main HTML tag
	//	@param : string[] attributes = array() - tag attributes
	//	@param : string content = '' - tag content
	//	@param : HTMLComponent[] components = array() - list of the tag's children components
	//	@return : returns a new main Tag instance
	function main($attributes = array(), $content = '', $components = array())	{
		return new Tag('main', $attributes, $content, $components);
	}




	//	@type : Tag
	//	@brief : creates a article HTML tag
	//	@param : string[] attributes = array() - tag attributes
	//	@param : string content = '' - tag content
	//	@param : HTMLComponent[] components = array() - list of the tag's children components
	//	@return : returns a new article Tag instance
	function article($attributes = array(), $content = '', $components = array())	{
		return new Tag('article', $attributes, $content, $components);
	}





	//	@type : Tag
	//	@brief : creates a section HTML tag
	//	@param : string[] attributes = array() - tag attributes
	//	@param : string content = '' - tag content
	//	@param : HTMLComponent[] components = array() - list of the tag's children components
	//	@return : returns a new section Tag instance
	function section($attributes = array(), $content = '', $components = array())	{
		return new Tag('section', $attributes, $content, $components);
	}





	//	@type : Tag
	//	@brief : creates a form HTML tag
	//	@param : string[] attributes = array() - tag attributes
	//	@param : string content = '' - tag content
	//	@param : HTMLComponent[] components = array() - list of the tag's children components
	//	@return : returns a new form Tag instance
	function form($attributes = array(), $content = '', $components = array())	{
		return new Tag('form', $attributes, $content, $components);
	}





	//	@type : Tag
	//	@brief : creates a aside HTML tag
	//	@param : string[] attributes = array() - tag attributes
	//	@param : string content = '' - tag content
	//	@param : HTMLComponent[] components = array() - list of the tag's children components
	//	@return : returns a new aside Tag instance
	function aside($attributes = array(), $content = '', $components = array())	{
		return new Tag('aside', $attributes, $content, $components);
	}





	//	@type : Tag
	//	@brief : creates a nav HTML tag
	//	@param : string[] attributes = array() - tag attributes
	//	@param : string content = '' - tag content
	//	@param : HTMLComponent[] components = array() - list of the tag's children components
	//	@return : returns a new nav Tag instance
	function nav($attributes = array(), $content = '', $components = array())	{
		return new Tag('nav', $attributes, $content, $components);
	}




	//	@type : Tag
	//	@brief : creates a footer HTML tag
	//	@param : string[] attributes = array() - tag attributes
	//	@param : string content = '' - tag content
	//	@param : HTMLComponent[] components = array() - list of the tag's children components
	//	@return : returns a new footer Tag instance
	function footer($attributes = array(), $content = '', $components = array())	{
		return new Tag('footer', $attributes, $content, $components);
	}




	//	@type : Tag
	//	@brief : creates a header HTML tag
	//	@param : string[] attributes = array() - tag attributes
	//	@param : string content = '' - tag content
	//	@param : HTMLComponent[] components = array() - list of the tag's children components
	//	@return : returns a new header Tag instance
	function header($attributes = array(), $content = '', $components = array())	{
		return new Tag('header', $attributes, $content, $components);
	}




	//	@type : Tag
	//	@brief : creates a dialog HTML tag
	//	@param : string[] attributes = array() - tag attributes
	//	@param : string content = '' - tag content
	//	@param : HTMLComponent[] components = array() - list of the tag's children components
	//	@return : returns a new dialog Tag instance
	function dialog($attributes = array(), $content = '', $components = array())	{
		return new Tag('dialog', $attributes, $content, $components);
	}





	//	@type : Tag
	//	@brief : creates an a HTML tag
	//	@param : string[] attributes = array() - tag attributes
	//	@param : string content = '' - tag content
	//	@param : HTMLComponent[] components = array() - list of the tag's children components
	//	@return : returns a new a Tag instance
	function a($attributes = array(), $content = '', $components = array())	{
		return new Tag('a', $attributes, $content, $components);
	}




	//	@type : Tag
	//	@brief : creates a div HTML tag
	//	@param : string[] attributes = array() - tag attributes
	//	@param : string content = '' - tag content
	//	@param : HTMLComponent[] components = array() - list of the tag's children components
	//	@return : returns a new div Tag instance
	function div($attributes = array(), $content = '', $components = array())	{
		return new Tag('div', $attributes, $content, $components);
	}





	//	@type : Tag
	//	@brief : creates a span HTML tag
	//	@param : string[] attributes = array() - tag attributes
	//	@param : string content = '' - tag content
	//	@param : HTMLComponent[] components = array() - list of the tag's children components
	//	@return : returns a new span Tag instance
	function span($attributes = array(), $content = '', $components = array())	{
		return new Tag('span', $attributes, $content, $components);
	}

?>