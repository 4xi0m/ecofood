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
	file : Debug.class.php
	brief :  Contains the Debug class' code
	author : Matthieu JABBOUR
	version : 1.0
	date : 2015/08/29

	More information at www.mangrova.org
	=====================================================================================================
	*/




	namespace Mangrova;



	
	//====================================================================================================
	//	@brief : Abstract class providing debugging tools
	//====================================================================================================
	abstract class Debug
	{
		//	@type : bool
		//	@brief : indicates weither the debugging mode is enabled or not
		private static $enabled = false;

		//	@type : FILE
		//	@brief : logs file
		private static $logsFile = NULL;

		//	@type : mixed[]
		//	@brief : timers for performances tests
		private static $timers = array('global' => 0);




		//	@type : void
		//	@brief : displays an information
		//	@param : string callingFunction - name of the calling function
		//	@param : string information - information to display
		public static function log($callingFunction, $information)	{
			if(self::$enabled == true)	{
				if(self::$logsFile != NULL)	{
					fputs(self::$logsFile, str_pad('['.$callingFunction.']', 30).'		'.$information.'
');				}
	 			else	{
 					throw new \Exception('No logs file defined');
 				}
 			}
		}




		//	@type : void
		//	@brief : enables the debugging mode
		//	@param : string filePath - output file's path
		public static function enable($filePath)	{
			self::$enabled = true;
			touch($filePath);
			self::$logsFile = fopen($filePath, 'w+');
		}




		//	@type : void
		//	@brief : disables the debugging mode
		public static function disable()	{
			self::$enabled = false;
			if(self::$logsFile != null)	{
				fclose(self::$logsFile);
			}
		}




		//	@type : void
		//	@brief : starts the timer for performances tests
		//	@param : timerName = '' - group that the timer belongs to
		public static function startTimer($timerName = '')	{
			if($timerName != '')	{
				if(!isset(self::$timers[$timerName]))	{
					self::$timers[$timerName] = array(0.0, 0.0);
				}
				self::$timers[$timerName][1]++;
				self::$timers[$timerName][0] -= microtime(true);
			}
			else	{
				self::$timers['global'] = -microtime(true);
			}
		}




		//	@type : void
		//	@brief : stops the timer for performances tests
		//	@param : timerName = '' - group that the timer belongs to
		public static function stopTimer($timerName = '')	{
			if($timerName != '')	{
				self::$timers[$timerName][0] += microtime(true);
			}
			else	{
				self::$timers['global'] += microtime(true);
			}
		}




		//	@type : void
		//	@brief : logs the global performances statistics at the current execution point
		public static function showStats()	{
			$time = 0;
			self::log('GENERAL', 'GLOBAL STATS');
			self::log('GENERAL', '-----------------------------------------------');
			self::log('GENERAL', 'TOTAL EXECUTION TIME : ' . self::$timers['global']);
			foreach(self::$timers as $timer => $value)	{
				if($timer != 'global')	{
					self::log('GENERAL', 'AVERAGE EXEC TIME FOR ' . $timer . ' : ' . $value[0]/$value[1]);
					$time += $value[0];
				}
			}
			self::log('GENERAL', 'TOTAL TIMES EXECUTION TIME : ' . $time);
		}

	}

?>