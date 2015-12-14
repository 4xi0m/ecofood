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
	file : Model.class.php
	brief :  Contains the Model class' code
	author : Matthieu JABBOUR
	version : 1.0
	date : 2015/08/29

	More information at www.mangrova.org
	=====================================================================================================
	*/




	namespace Mangrova;
	use \PDO;



	
	//====================================================================================================
	//	@brief :  Abstract class modelizing models in a web application
	//====================================================================================================
	abstract class Model
	{
		//	@type : mixed[]
		//	@brief : model's data
		protected $m_data;

		//	@type : PDO
		//	@brief : model's database
		protected $m_dataBase;




		//	@type : void
		//	@brief : class constructor
		//	@param : mixed[] p_data - data to assign to the model
		public function __construct($p_data)	{
			Assert::type(__METHOD__, 'is_array($p_data)', is_array($p_data));

			$this->m_dataBase = NULL;
			$this->m_data = $p_data;
		}




		//	@type : void
		//	@brief : class destructor
		public function __destruct()	{
		}




		//	@type : Model
		//	@brief : connects the model to a database
		//	@param : string dataBase - address of the database
		//	@param : string user - user's name
		//	@param : string password - user's password
		//	@remark : m_dataBase is a PDO
		//	@return : returns the current Model instance
		public function connect($dataBase, $user, $password)	{
			Assert::type(__METHOD__, 'is_string($dataBase)', is_string($dataBase));
			Assert::type(__METHOD__, 'is_string($user)', is_string($user));
			Assert::type(__METHOD__, 'is_string($password)', is_string($password));

			try	{
				$this->m_dataBase = new PDO($dataBase, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
			}
			catch(Exception $exception)	{
				throw new SQLException($exception->getMessage(), 10);
			}

			Assert::postcondition(__METHOD__, '$this->m_dataBase instanceof PDO', $this->m_dataBase instanceof PDO);

			return $this;
		}




		//	@type : Model
		//	@brief : hydrates the model with p_data
		//	@param : mixed[] p_data - data to assign to the model
		//	@return : returns the current Model instance
		public function hydrate($p_data)	{
			Assert::type(__METHOD__, 'is_array($p_data)', is_array($p_data));

			foreach($p_data as $key => $value)	{
				$this->m_data[$key] = $value;
			}

			return $this;
		}




		//	@type : mixed
		//	@brief : m_data getter
		//	@param : string key - key of the data to return
		//	@return : returns the value of the given key if the value exists, NULL else
		public function get($key)	{
			Assert::type(__METHOD__, 'is_string($key)', is_string($key));

			return isset($this->m_data[$key]) ? $this->m_data[$key] : NULL;
		}




		//	@type : Model
		//	@brief : executes a SQL query
		//	@param : string query - query to execute on the database
		//	@param : string[] arguments - query's arguments
		//	@param : string key - index for the query's response storage in the model data
		//	@remark : the model is connected to a database
		//	@return : returns the current Model instance
		public function query($query, $arguments = array(), $key = 'query')	{
			Assert::type(__METHOD__, 'is_string($query)', is_string($query));
			Assert::type(__METHOD__, 'is_array($arguments)', is_array($arguments));
			Assert::precondition(__METHOD__, '$this->m_dataBase instanceof PDO', $this->m_dataBase instanceof PDO);

			try{
				$statement = $this->m_dataBase->prepare($query);
				$statement->execute($arguments);
				$this->m_data['query'] = $statement->fetchAll();
				$statement->closeCursor();
			}
			catch(Exception $exception)	{
					throw new SQLException($exception->getMessage(), 11);
			}

			return $this;
		}
	}

?>