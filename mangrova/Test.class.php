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
	file : Test.class.php
	brief :  Contains the Test class' code
	author : Matthieu JABBOUR
	version : 1.0
	date : 2015/08/29

	More information at www.mangrova.org
	=====================================================================================================
	*/




	namespace Mangrova;



	
	//====================================================================================================
	//	@brief : Abstract class providing unitary & integration tests tools
	//====================================================================================================
	abstract class Test
	{
		//	@type : FILE
		//	@brief : logs file
		private static $logsFile = NULL;

		//	@type : int
		//	@brief : number of failed tests
		private static $failsNumber = 0;




		//	@type : void
		//	@brief : class constructor
		//	@param : string filePath - path of the log file
		public function __construct($filePath)	{
			Debug::enable($filePath);
		}




		//	@type : void
		//	@brief : class destructor
		public function __destruct()	{
			Debug::log('TOTAL FAILED TESTS', self::$failsNumber);
		}




		//	@type : void
		//	@brief : compares two expressions and logs the result for unitary tests
		//	@param : mixed expression1 - first expression to compare
		//	@param : mixed expression2 - second expression to compare
		public static function assertEqual($expression1, $expression2)	{
			Debug::log('ASSERT EQUAL', $expression1 == $expression2);
			if($expression1 != $expression2)	{
				self::$failsNumber++;
			}
		}




		//	@type : void
		//	@brief : executes a unitary & integration test procedure
		abstract public function execute();
	}

?>