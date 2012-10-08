<?php

	require_once('../view/FileUploadView.php');
	require_once('../model/FileUploadModel.php');
	require_once('../model/LoginModel.php');
	
	class FileUploadController {
				
		public function doControll(Database $db){
			
			/**
			 * Create instances of the Views, Controllers we're using.
			 */
			$fileUploadView = new FileUploadView();
			$fileUploadModel= new FileUploadModel($db);
			
			// The possible FileUpload error.
			$fileUploadError = "";
			
			$html = "";
			
			// If the user is logged in..
			if(LoginModel::IsLoggedIn()) {
				
				// Generate the login form
				$html .= $fileUploadView->doFileUploadForm();
				
				// Did the user try to upload a file.
				if($fileUploadView->triedToUploadFile()){
					// Save the file.
					try {
						if($fileUploadModel->doSaveFile()) {
							$html .= $fileUploadView->doFileUploadSuccess();
						}
					}
					catch (exception $e){
						$fileUploadError = $e->getMessage();
					}
				}
			}
			// Get uploaded files
			$uploadedFiles = $fileUploadModel->doOpenDir();
			// Generate the uploaded files in a HTML list
			$html .= $fileUploadView->doFileList($uploadedFiles);
			
			// Return the HTML and the possible FileUpload error.
			return $html . $fileUploadView->doErrorList($fileUploadError);
		}
	}
