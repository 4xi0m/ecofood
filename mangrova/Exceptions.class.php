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
	file : Exceptions.class.php
	brief :  Contains the custom exceptions classes' code
	author : Matthieu JABBOUR
	version : 1.0
	date : 2015/08/29

	More information at www.mangrova.org
	=====================================================================================================
	*/




	namespace Mangrova;
	use \Exception;



	
	//====================================================================================================
	//	@brief : Exception thrown if a SQL query is not valid
	//====================================================================================================
	class SQLException extends Exception
	{
		//	@type : void
		//	@brief : class constructor
		//	@param : string message - message describing the exception
		//	@param : int code : exception's corresponding code
		public function __construct($message, $code)
		{
			parent::__construct($message, $code);
		}
	}




	//====================================================================================================
	//	@brief : Exception thrown if a type condition is not satisfied
	//====================================================================================================
	class TypeException extends Exception
	{
		//	@type : void
		//	@brief : class constructor
		//	@param : string message - message describing the exception
		//	@param : int code : exception's corresponding code
		public function __construct($message, $code)
		{
			parent::__construct($message, $code);
		}
	}




	//====================================================================================================
	//	@brief : Exception thrown if a precondition is not satisfied
	//====================================================================================================
	class PreconditionException extends Exception
	{
		//	@type : void
		//	@brief : class constructor
		//	@param : string message - message describing the exception
		//	@param : int code : exception's corresponding code
		public function __construct($message, $code)
		{
			parent::__construct($message, $code);
		}
	}




	//====================================================================================================
	//	@brief : Exception thrown if a postcondition is not satisfied
	//====================================================================================================
	class PostconditionException extends Exception
	{
		//	@type : void
		//	@brief : class constructor
		//	@param : string message - message describing the exception
		//	@param : int code : exception's corresponding code
		public function __construct($message, $code)
		{
			parent::__construct($message, $code);
		}
	}

?>