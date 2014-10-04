<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	private $result;
	private $data;

	public function __construct() {
		$this->data = [];
		$this->result = [];
		$this->beforeFilter('csrf', ['on'=>'post|put|patch']);
	}


	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	// /**
	//  * [result - In short, messages]
	//  * @param  [boolean] $success 
	//  * @param  [string] $for     [In what module]
	//  * @param  [string] $message [Result message]
	//  * @param  [object] $redirect [Redirect to other page]
	//  * @return [array]          [Returns the chained results]
	//  */
 //    protected function result($success, $for, $message = NULL, $redirect = NULL) {

 //        $result = $this->result;
 //        $result["success"] = $success;
 //        $result["for"] = $for;

 //        is_null($message) ? : $result["message"] = $message;
 //        is_null($redirect) ? : $result["_redirect"] = $redirect;
        
 //        return $result;
 //    }

	/**
	 * [response - JSON response to browser]
	 * @param  [array] $result [Gets the result messages then convert it to JSON]
	 * @return [array]         [Returns the chained]
	 */
	protected function response($result) {
		return Response::make(json_encode($result), 200)->header('Content-Type', 'text/json');
	}

	/**
	 * [imageOrText - Validation of image or text]
	 * @param  [Boolean] $isImg      [Gets the checkbox value]
	 * @param  [String] $input      [Gets the input]
	 * @param  [String] $credential [Gets sanitized input]
	 * @return [String]             [Returns if it's image or text]
	 */
	protected function imageOrText($isImg, $input, $credential) {
		return $isImg || $isImg != NULL ? $this->convertToImage($input, $credential) : HTML::entities($input);
	}

	/**
	 * [convertToImage - Convertion of Base64 to Image file.]
	 * @param  [String] $input    [Gets the base64 encoded image file]
	 * @param  [String] $question [Gets the question]
	 * @return [String]           [Returns md5 hash filename]
	 */
	protected function convertToImage($input, $question) {
		$input = str_replace('data:image/png;base64,', '', $input);
		$input = str_replace(' ', '+', $input);
		$data = base64_decode($input); 
		$newName = md5(strtolower(str_replace(' ', '+', $question.$input))).'.png';
		$path = public_path().'/assets/photos/';
		$saveToPath = $path.$newName;
		if(!file_exists($path)) mkdir($path, 0777);
		$file = file_put_contents($saveToPath, $data); // Save to /assets/photos folder first

		if($file) return $newName; // Return md5 hash filename			
	}

	protected function credentials() {
		
	}


	protected function sentry($input) {
		try {
			Sentry::cyrus_authenticate()
		}
	}

}
