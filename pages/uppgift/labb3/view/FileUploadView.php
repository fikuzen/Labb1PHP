<?php

class FileUploadView{
	
	private $m_uploadSubmitButton = 'submitUploadForm';
	
	/**
	 * Did the user try to upload a file?
	 */
	public function triedToUploadFile() {
		return isset($_POST[$this->m_uploadSubmitButton]);
	}
	
	/**
	 * Generate the fileupload Form
	 */
	public function doFileUploadForm() {
		return "
			<form action=\"index.php\" method=\"post\" enctype=\"multipart/form-data\">
				<input required name=\"userfile\" type=\"file\" /> 
				<input type=\"submit\" class=\"btn btn-primary btn-large\" name=\"$this->m_uploadSubmitButton\" value=\"Ladda upp\" />
			</form>
		";
	}
	
	/**
	 * Generate a Unsorted list with filenames
	 * 
	 * @param $fileNames an array of files in upload folder.
	 * @return the unsorted list in HTML.
	 */
	public function doFileList($fileNames) {
		$ret = "<ul>";
		foreach ($fileNames as $fileName) {
			if($fileName[0] != "."){
				$ret .= "
						<li>
							<a href=\"../uploads/$fileName\">$fileName</a>
						</li>";
			}
			$ret .= "</ul>";
		}
		return $ret;
	}
	
	/**
	 * Generate HTML Code to show the user that the fileupload suceeded
	 */
	 public function doFileUploadSuccess(){
	 	return "
	 			<div class=\"alert alert-success\">
		    		<button type=\"button\" id=\"loginFormClose\" data-dismiss=\"alert\" class=\"close\">×</button>
					<p>Du lyckades ladda upp en filen.</p>
				</div>
				";
	 }
	
	/**
	 * Generate HTMLcode for a errorList.
	 * Takes a array of errors as param.  
	 * 
	 * @return $errorBox HTML CODE
	 * @param $error an Error Message.
	 */ 
	public function doErrorList($error) {
		if($error != ""){
			
			// Påbörja row, span4, alert alert-error.
			$errorBox = "
				<div class=\"row\">
					<div class=\"span4\">
						<div class=\"alert alert-error\"> 
							" . $error . "<br />
						</div>
					</div>
				</div>";
			return $errorBox;
		}
		return null;		
	}	
}