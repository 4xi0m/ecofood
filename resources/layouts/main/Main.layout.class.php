<?php

	/*
	=====================================================================================================
	The MIT License (MIT)

	Copyright (c) 2015 - Now, Treevea

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
	file : Authentificator.module.class.php
	brief :  Contains the Authentificator class' code
	author : Matthieu JABBOUR
	version : 1.0
	date : 2015/09/12
	=====================================================================================================
	*/	




	namespace Mangrova\Layouts\Main;




	//====================================================================================================
	//	
	//====================================================================================================
	class Layout extends \Mangrova\Layout
	{
		//	@type : void
		//	@brief : class constructor
		public function __construct($p_settings = array())	{
			$p_settings[] = new \Mangrova\Link(['rel' => 'stylesheet', 'type' => 'text/css', 'href' => Layout::path() . 'Main.css']);
			parent::__construct($p_settings);
		}


		public function render($tabulations)	{
			echo($tabulations.'<input type="hidden" id="token" value="' . $_SESSION['formToken'] . '" />' . "\n");
			echo($tabulations.'<main>'."\n");


				foreach($this->m_blocks as $block)	{
					$block->render($tabulations.'	');
				}

			echo($tabulations.'</main>'."\n");

		}
	}

?>