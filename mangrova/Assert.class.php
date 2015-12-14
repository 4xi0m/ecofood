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
	file : Assert.class.php
	brief :  Contains the Assert class' code
	author : Matthieu JABBOUR
	version : 1.0
	date : 2015/08/29

	More information at www.mangrova.org
	=====================================================================================================
	*/




	namespace Mangrova;



	
	//====================================================================================================
	//	@brief : Abstract class providing assertion functions
	//====================================================================================================
	abstract class Assert
	{
		//	@type : void
		//	@brief : tests a type condition
		//	@param : string callingFunction - name of the calling function
		//	@param : string description - type condition's description
		//	@param : bool test - type condition
		public static function type($callingFunction, $description, $test)	{
			Debug::startTimer('type');
			$test = ($test == true) ? 'true' : 'false';

			Debug::log($callingFunction, 'Type test - '.$description.' : '.$test);
			if($test === 'false')	{
				throw  new TypeException($description.' : '.$test, 1);
			}
			Debug::stopTimer('type');
		}




		//	@type : void
		//	@brief : tests a precondition
		//	@param : string callingFunction - name of the calling function
		//	@param : string description - precondition's description
		//	@param : bool test - precondition
		public static function precondition($callingFunction, $description, $test)	{
			Debug::startTimer('precondition');
			$test = ($test == true) ? 'true' : 'false';

			Debug::log($callingFunction, 'Precondition test - '.$description.' : '.$test);
			if($test === 'false')	{
				throw  new PreconditionException($description.' : '.$test, 2);
			}
			Debug::stopTimer('precondition');
		}




		//	@type : void
		//	@brief : tests a postcondition
		//	@param : string callingFunction - name of the calling function
		//	@param : string description - postcondition's description
		//	@param : bool test - postcondition
		public static function postcondition($callingFunction, $description, $test)	{
			Debug::startTimer('postcondition');
			$test = ($test == true) ? 'true' : 'false';

			Debug::log($callingFunction, 'Postcondition test - '.$description.' : '.$test);
			if($test === 'false')	{
				throw  new PostconditionException($description.' : '.$test, 3);
			}
			Debug::stopTimer('postcondition');
		}
	}

?>