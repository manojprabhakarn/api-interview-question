<?php
/**
 * MIT License
 * ===========
 *
 * Copyright (c) 2022 Selfmade Ninja Solutions
 *
 * Permission is hereby granted, free of charge, to any person obtaining
 * a copy of this software and associated documentation files (the
 * "Software"), to deal in the Software without restriction, including
 * without limitation the rights to use, copy, modify, merge, publish,
 * distribute, sublicense, and/or sell copies of the Software, and to
 * permit persons to whom the Software is furnished to do so, subject to
 * the following conditions:
 *
 * The above copyright notice and this permission notice shall be included
 * in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS
 * OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
 * IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY
 * CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,
 * TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE
 * SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 *
 * @category   PHP Developer Test
 * @package    problems/api-problem
 * @subpackage api
 * @author     Sibidharan <sibi@selfmade.ninja>
 * @copyright  2022 Selfmade Ninja Solutions
 * @license    http://www.opensource.org/licenses/mit-license.php  MIT License
 * @version    0.1
 * @link       http://git.aftertutor.com/problems/api-problem
 */

	error_reporting(E_ALL ^ E_DEPRECATED);
	require_once("Rest.inc.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/lib/Database.class.php");
	
	class API extends REST {
	
		public $data = "";
		
		
		private $db = NULL;
	
		public function __construct(){
			parent::__construct();									// Init parent contructor
			$this->db = Database::getConnection(); 					// Initiate Database connection
		}
			

		
		/*
		 * Public method for access api.
		 * This method dynmically call the method based on the query string
		 *
		 */
		public function processApi(){
			$func = strtolower(trim(str_replace("/","",$_REQUEST['rquest'])));
			if((int)method_exists($this,$func) > 0)					//check method exists with in API class
				$this->$func();
			else{
				//scan and include the external funtion into API Class using Closure::
				if($func){
					$dir = $_SERVER['DOCUMENT_ROOT'].'/apis/';			
					$methods = scandir($dir);						
						foreach($methods as $m){
								if($m == "." or $m == ".."){		//skip the . and ..
									continue;
								}
								$basem = basename($m, '.php');
								
								//check and bind funtion using Closure
								if($basem == $func){
									include_once $dir."/".$m;
									$this->current_call = Closure::bind(${$basem}, $this, get_class());
									$this->$basem();
								}
							}
					
				}
				
			}
		}
		// __call() method is invoked automatically when a inaccessible method is called
		public function __call($method, $args){
			if(is_callable($this->current_call)){
				return call_user_func_array($this->current_call, $args);
			} else {
				$this->response($this->json(['error'=>'methood_not_callable']),404);
			}
		}
		
	
				

		/*************API SPACE START*******************/

		private function about(){

			if($this->get_request_method() != "POST"){
				$error = array('status' => 'WRONG_CALL', "msg" => "The type of call cannot be accepted by our servers.");
				$error = $this->json($error);
				$this->response($error,406);
			}
			$data = array('version' => '0.1', 'desc' => 'This API is created by Aftertutor Medias Pvt. Ltd., for the public usage for accessing data about vehicles.');
			$data = $this->json($data);
			$this->response($data,200);

		}
		
		private function test(){
			$data = $this->json(getallheaders());
			$this->response($data,200);
		}


		
		/*************API SPACE END*********************/
		
		/*
			Encode array into JSON
		*/
		private function json($data){
			if(is_array($data)){
				return json_encode($data, JSON_PRETTY_PRINT);
			}
		}
		
	}
	
	// Initiiate Library
	
	$api = new API;
	$api->processApi();
?>