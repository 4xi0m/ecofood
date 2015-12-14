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
	file : Security.class.php
	brief :  Contains the Security class' code
	author : Matthieu JABBOUR
	version : 1.0
	date : 2015/08/29

	More information at www.mangrova.org
	=====================================================================================================
	*/




	namespace Mangrova;



	
	//====================================================================================================
	//	@brief : Abstract class providing security tools
	//====================================================================================================
	abstract class Security
	{
		//	@type : mixed
		//	@brief : securises an array or a string to avoid any security issue
		//	@param : mixed variable - variable to securise
		//	@return : returns the securised string or array
		public static function secure($variable)
		{
			Assert::type(__METHOD__, 'is_string($variable) || is_array($variable) || is_null($variable) || is_numeric($variable)', is_string($variable) || is_array($variable) || is_null($variable) || is_numeric($variable));

			if(is_string ($variable)) {
				return htmlspecialchars($variable, ENT_QUOTES);
			}
			else if(is_array($variable) && !empty($variable)) 	{
				foreach($variable as $key => $value) {
					$variable[$key] = self::secure($value);
				}
			}
			return $variable;
		}




		//	@type : mixed
		//	@brief : unsecurises an array or a string securised with Security::secure()
		//	@param : mixed variable - variable to unsecurise
		//	@return : returns the unsecurised string or array
		public static function unsecure($variable)
		{
			Assert::type(__METHOD__, 'is_string($variable) || is_array($variable) || is_null($variable) || is_numeric($variable)', is_string($variable) || is_array($variable) || is_null($variable) || is_numeric($variable));

			if(is_string ($variable)) {
				return (htmlspecialchars_decode($variable, ENT_QUOTES));
			}
			else if(is_array($variable) && !empty($variable)) 	{
				foreach($variable as $key => $value) {
					$variable[$key] = self::unsecure($value);
				}
			}
			return $variable;
		}
	}

?>