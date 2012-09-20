<?php

class FileUploadView{
	
	private $m_uploadSubmitButton = 'submitUploadForm';
	
	public function triedToUploadFile() {
		return isset($_POST[$this->m_uploadSubmitButton]);
	}
	
	public function doFileUploadForm() {
		return "
			<form action=\"index.php\" method=\"post\" enctype=\"multipart/form-data\">
				<input required name=\"userfile\" type=\"file\" /> 
				<input type=\"submit\" class=\"btn btn-primary btn-large\" name=\"$this->m_uploadSubmitButton\" value=\"Ladda upp\" />
			</form>
		";
	}
	
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
	 * Generate HTMLcode for a errorList.
	 * Takes a array of errors as param.  
	 * 
	 * @return $errorBox HTML CODE
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