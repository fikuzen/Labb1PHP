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
		
	}
}