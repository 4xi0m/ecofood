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
	file : Mangrova.class.php
	brief :  Contains the Mangrova class' code
	author : Matthieu JABBOUR
	version : 1.0
	date : 2015/08/29

	More information at www.mangrova.org
	=====================================================================================================
	*/




	//====================================================================================================
	//	@brief : Abstract class modelizing the Mangrova engine
	//====================================================================================================
	abstract class Mangrova
	{
		//	@type : string
		//	@brief : library's absolute path on the server
		public static $libraryPath = '/mangrova';

		//	@type : string
		//	@brief : resources directory's absolute path on the server
		public static $resourcesPath = '/resources';




		//	@type : void
		//	@brief : starts the Mangrova engine
		public static function start()	{
			require_once(self::$libraryPath.'/Includes.php');
			include_once('/pages.php');

			
			$pageFound = false;

			foreach($pages as $page => $path)	{
				if(preg_match('#^' . $page . '/?(\?.*)?$#', $_SERVER['REQUEST_URI']))	{
					include_once($path);
					$pageFound = true;
					break;
				}
			}
			//	If the requested page is not found...
			if($pageFound == false)	{
				if(array_key_exists('error404', $pages))	{
					include_once($pages['error404']);
				}
				else	{
					header('Status: 404 Not Found', false, 404);
					include_once('MangrovaError.php');
					exit;
				}
			}
		}
	}




	//====================================================================================================
	//	brief : Autoload function
	//====================================================================================================
	spl_autoload_register(function ($className) {
		$decomposedPath = explode('\\', $className);
		$filePath = '';
		for($i = 1; $i < sizeof($decomposedPath) - 2; ++$i)	{
			$filePath = $filePath . strtolower($decomposedPath[$i]) . '/';
		}
		$filePath = __DIR__ . '/' . Mangrova::$resourcesPath . '/' . $filePath . strtolower($decomposedPath[sizeof($decomposedPath) - 2]) . '/' . $decomposedPath[sizeof($decomposedPath) - 2] . '.' . strtolower($decomposedPath[sizeof($decomposedPath) - 1]) . '.class.php';
		if(file_exists($filePath))	{
			include_once($filePath);
		}
	});




	session_start();
	Mangrova::start();

?>