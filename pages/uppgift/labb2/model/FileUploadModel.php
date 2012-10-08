<?php

class FileUploadModel {
	
	private $m_uploadDir = "../uploads/";
	private $m_uploadBasename = "basename";
		
	/**
	 * Open the upload directory and return all filenames.
	 * 
	 * @return All the filenames in Uploads directory
	 */
	public function doOpenDir() {
		$uploadedFiles = array();
		
		// Look if there's any folder
		if (is_dir($this->m_uploadDir)) {
			
			// Open the folder and store the directory in a variable
			if ($dh = opendir($this->m_uploadDir)) {
				
				// Read all files in the folder.
				while (($file = readdir($dh)) !== false) {
					
					// Store the filename in a array
					$uploadedFiles[] = $file;
				}
				
				// Close the opened directory
				closedir($dh);
			}
		}
		// Return the filenames
		return $uploadedFiles;
	}
	
	public function doSaveFile() {
		
		$uploaddir = '../uploads/';
		$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
		
		if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
			return true;
		}
		throw new Exception("Error, The file couldn't be uploaded.", 3002);
	}
	
	/**
	 * Automatic Unittest.
	 * 
	 * @return StringArray, Error list.
	 */
	public static function Test() {
		
		// Creates a System Under Test object.
		$sut = new LoginModel();
		
		// Logging out a user.
		$sut->DoLogout();
		
		// Shouldn't be logged in.
		if ($sut->IsLoggedIn()){
			array_push($sut->errors, "Something is wrong with the IsLoggedIn() function \"When you shouldn't be logged in\"");
		}
			
		// DoLogin fail user
		 try {
			$sut->DoLogin("Fiskpinne", "Fläskpannkaka");
			// Test failed.
			array_push($sut->errors, "Something is wrong with the DoLogin(\"Fiskpinne\", \"Fläskpannkaka\") function");
		} catch (exception $e) {
			// Test success		
		}
		
		// DoLogin success user
		if(!($sut->DoLogin("Fisk", "Fisk22"))){
			array_push($sut->errors, "Something is wrong with the DoLogin(\"Fisk\", \"Fisk22\") function");
		}
		
		// Should be logged in.
		if(!($sut->IsLoggedIn())){
			array_push($sut->errors, "Something is wrong with the IsLoggedIn() function \"When you should be logged in\"");
		}
		
		// Logging out the inlogged test user.
		$sut->DoLogout();		
		if($sut->isLoggedIn()){
			array_push($sut->errors, "Something is wrong with the DoLogout() function");	
		}
		
		// DoLogin right username, fail password
		try {
			$sut->DoLogin("Fisk", "Fisken22");
			// Test failed.
			array_push($sut->errors, "Something is wrong with the DoLogin(\"Fisk\", \"Fisken22\") function");
		} catch (exception $e) {
			// Test success.			
		}
		
		// DoLogin fail username, right password
		try {
			$sut->DoLogin("Fisken", "Fisk22");
			// Test failed.
			array_push($sut->errors, "Something is wrong with the DoLogin(\"Fisken\", \"Fisk22\") function");
		} catch (exception $e) {
			// Test success.			
		}

		return $sut->errors;
	}
}