<?php
        
	class Validator
	{
		// Reguljära uttryck
	   private static $m_emailRegExp = "/^[a-z0-9-_]+(\.[a-z0-9-_]+)?@[a-z0-9-]+(\.[a-z0-9-]+)?\.[a-z]{2,6}$/i";
	   private static $m_socialSecurityNumberRegExp = "/^(((19)?[0-9]{2})|((20)?([0]{1}[0-9]{1}|[1]{1}[012]{1})))(((01|03|05|07|08|10|12)((0{1}[1-9]{1})|([12]{1}[0-9]{1})|(3{1}[01]{1})))|(((04|06|09|11)((0{1}[1-9]{1})|([12]{1}[0-9]{1})|30)))|(02((0{1}[1-9]{1})|(1{1}[0-9]{1})|(2{1}[0-9]{1}))))(-)?[0-9]{4}$/";
	   
	   private static $m_dateRegExp1 = "/^(((19)?[0-9]{2})|((20)?([0]{1}[0-9]{1}|[1]{1}[012]{1})))-(((01|03|05|07|08|10|12)-((0{1}[1-9]{1})|([12]{1}[0-9]{1})|(3{1}[01]{1})))|(((04|06|09|11)-((0{1}[1-9]{1})|([12]{1}[0-9]{1})|30)))|(02-((0{1}[1-9]{1})|(1{1}[0-9]{1})|(2{1}[0-9]{1}))))$/";
	   
	   private static $m_dateRegExp2 = "/^([0-9]{2})(((01|03|05|07|08|10|12)((0{1}[1-9]{1})|([12]{1}[0-9]{1})|(3{1}[01]{1})))|(((04|06|09|11)((0{1}[1-9]{1})|([12]{1}[0-9]{1})|30)))|(02((0{1}[1-9]{1})|(1{1}[0-9]{1})|(2{1}[0-9]{1}))))$/";
	   
	   private static $m_passwordRegExp = "/^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/";
	   
	   /* Errormessages */
	   private static $m_errorMessages;
	   private static $m_emailError = "emailError";
	   private static $m_usernameError = "usernameError";
	   private static $m_passwordError = "passwordError";
	   private static $m_numberError = "numberError";
	   private static $m_dateError = "dateError";
	   private static $m_socialSecurityNumberError = "socSecNumbError";
	   private static $m_filterJSError = "JSError";
		private static $m_filterHTMLAndJSError= "HTMLAndJSError";
   
		public function __construct()
   	{
       	self::$m_errorMessages = array();
   	}
   
	   public function getErrorMessages()
	   {
	       return self::$m_errorMessages;
	   }
	   
	  /**
	   * Validate an Emailadress ex daniel@domain.se daniel.toll@lnu.se daniel@student.lnu.se
	   * @param $email Email adress
	   * @return bool
	   */
	   public function validateEmail($email) 
	   {
	      $emailIsValid = preg_match(self::$m_emailRegExp, $email);
	      if (!$emailIsValid) {
         	self::$m_errorMessages[self::$m_emailError] = "Invalid EmailAdress";
			}	 
         return $emailIsValid;
      }
		
	  /**
	   * Validate a social security number
	   * @param $number Social security number
	   * @return bool
	   */
	   public function validateSocialSecurityNumber($number)
	   {
	       $socialSecurityNumbIsValid = preg_match(self::$m_socialSecurityNumberRegExp, $number);
	       if (!$socialSecurityNumbIsValid)
	       {
	           self::$m_errorMessages[self::$m_socialSecurityNumberError] =
	           "Social security number entered in the wrong format";
	           
	           return $socialSecurityNumbIsValid;
	       }
	       
	       // Ta bort "-"
	       $standardNumber = str_replace("-", "", $number);                        
	       
	       // Ta bort de ev. två första siffrorna (årtusonde och århundrade)
	       if (strlen($standardNumber) > 10)
	       {
	           // De fyra första, t.ex. 1985 är mer än årets år
	           if (substr($standardNumber, strlen($standardNumber) - 8) > date("Y"))
	           {
	               self::$m_errorMessages[self::$m_socialSecurityNumberError] =
	               "Year not valid must be less then " . date("Y") . ".";
	               
	               return false;
	           }
	           
	           $standardNumber = substr($standardNumber, strlen($standardNumber) - 10);
	       }
	            
	       // Luhn algorithmen
	       $numbers = array();
	       
	       for ($i = 0; $i < strlen($standardNumber); $i++)
	       {
	           if ($i % 2 == 0)
	               $numbers[] = $standardNumber[$i] * 2;
	           else
	               $numbers[] = $standardNumber[$i] * 1;
	       }
	                   
	       $luhnNumbs = array();
	       
	       foreach ($numbers as $numb)
	       {
	           if ($numb > 9)
	           {
	               $luhnNumbs[] = 1;
	               $luhnNumbs[] = $numb - 10;
	           }
	           else
	               $luhnNumbs[] = $numb;
	       }
	       
	       $total = 0;
	       foreach ($luhnNumbs as $luhnNumb)
	           $total = $total + $luhnNumb;
	       
	       if ($total % 10 != 0)
	       {
	           self::$m_errorMessages[self::$m_socialSecurityNumberError] =
	           "Invalid social security number entered";
	           
	           return false;
	       }
	       
	       return $standardNumber;
	   }
	   
	   /**
	    * Validate a date
	    * @param $date Date
	    * @return bool
	    */
	   public function validateDate($date)
	   {
	       // Validate with RegEx
	       if (!preg_match(self::$m_dateRegExp1, $date) && !preg_match(self::$m_dateRegExp2, $date))
	       {
	           self::$m_errorMessages[self::$m_dateError] = "Invalid date format";
	           return false;
	       }
	       
	       // Convert to standard format (YYMMDD)
	       str_replace("-", "", $date);
	       
	       if (strlen($date) == 10)
	       {
	           $date = substr($date, 2);
	       }
	       
	       // Return date in standard format
	       return $date;
	   }
	   
	   /**
	    * Validate an username
	    * @param $username Username
	    * @return bool
	    */
	   public function validateUsername($username)
	   {
	       $usernameIsValid = true;
	       if(!isset($username)) {
	       	self::$m_errorMessages[self::$m_usernameError] =
	           "Username can't be null.";
	       	$usernameIsValid = false;
	       }
	       if(strlen($username) < 3 || strlen($username) > 50)
	       {
	           self::$m_errorMessages[self::$m_usernameError] =
	           "Username must be longer than 3 and shorter than 51 characters";
	           $usernameIsValid = false;
	       }
	       return $usernameIsValid;                
	   }
	   
	   /**
	    * Validate an email
	    * @param $password Password
	    * @return bool
	    */
	   public function validatePassword($password)
	   {
	       $passwordIsValid = true;
	       if(!preg_match(self::$m_passwordRegExp, $password))
	       {
	           self::$m_errorMessages[self::$m_passwordError ] = 
	           "Password must contain letters.";
	           $passwordIsValid = false;
	       }
	       return $passwordIsValid;
	   }
	   
	   /**
	    * Validate var as number
	    * @param $number Number
	    * @return bool
	    */
	   public function validateNumber($number) 
	   {
	       $numberIsValid = true;
	       if (!is_numeric($number))
	       {
	           self::$m_errorMessages[self::$m_numberError] = 
	               "Value is not a number";
	           $numberIsValid = false;
	       }
	   
	       return $numberIsValid;
	   }
	   
	   /**
	    * Filter out javascript
	    * @return string
	    */
	   public function filterTextInputFromJS($input)
	   {
	       $input = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', "", $input);
	       $input = htmlentities($input);
	       return $input;
	   }
	   
	   /**
	    * Filter out html and javascript
	    * @return string
	    */
	   public function filterTextInputFromHTMLandJS($input)
	   {
	       // Ta bort html-taggar
	       $input = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', "", $input);
	       $input = strip_tags($input);
	       return $input;
	   }
	   
	   public function testErrorMessageFormat($testName, $testFunction){
	       return "<div>
	                   Fel vid validering av $testName
	                   <div>
	                       <p>TEST: $testFunction</p>
	                   </div>
	               </div>";
	   }
	       
	   public static function test()
	   {
	       $testSuccess = true;
	   
	       $sut = new Validator();
	       
	       /**
	        * Test with a valid email address.
	        */
	       if (!$sut->validateEmail("jesper_vill_eata_fisk@hotmail.se"))
	       {
	           echo $sut->testErrorMessageFormat("eEmail", "validateEmail('jesper_vill_eata_fisk@hotmail.se')");
	           $testSuccess = false;
	       }
	       
	       /**
	        * Test with a bad email address
	        */
	       if ($sut->validateEmail("hej"))
	       {
	           echo $sut->testErrorMessageFormat("Email", "validateEmail('hej')");
	           $testSuccess = false;
	       }
	       
	       if ($sut->validateEmail(".@.com"))
	       {
	           echo $sut->testErrorMessageFormat("Email", "validateEmail('.@.com'");
	           $testSuccess = false;
	       }
	       
	       /**
	        * Test with a bad SocialSecurityNumber
	        */
	       if ($sut->validateSocialSecurityNumber("92-07-03-5488"))
	       {
	           echo $sut->testErrorMessageFormat("Personnummer", "validateSocialSecurityNumber('92-07-03-4488')");
	           $testSuccess = false;
	       }
	       
	       /**
	        * Test with a bad SocialSecurityNumber because Luhn FAILS
	        */
	       if ($sut->validateSocialSecurityNumber("920703-4488"))
	       {
	           echo $sut->testErrorMessageFormat("Personnummer", "validateSocialSecurityNumber('920703-4488')");
	           $testSuccess = false;
	       }
	       
	       /**
	        * Test with a correct SocialSecurityNumber
	        */
	       if (!$sut->validateSocialSecurityNumber("851208-4016"))
	       {
	           echo $sut->testErrorMessageFormat("Personnummer", "validateSocialSecurityNumber('851208-4016')");
	           $testSuccess = false;
	       }
	       
	       /**
	        * Test with a bad SocialSecurityNumber
	        */
	       if ($sut->validateSocialSecurityNumber("apa"))
	       {
	           echo $sut->testErrorMessageFormat("Personnummer", "validateSocialSecurityNumber('apa')");
	           $testSuccess = false;
	       }
	       
	       /**
	        * Test with good datetime
	        */
	       if(!$sut->validateDate("1999-01-01"))
	       {
	           echo $sut->testErrorMessageFormat("Datum", "validateDate('1999-01-01')");
	           $testSuccess = false;
	       }
	       
	       /**
	        * Test with bad datetime
	        */
	       if($sut->validateDate("jagärinteettdatum"))
	       {
	           echo $sut->testErrorMessageFormat("Datum", "validateDate('jagärinteettdatum')");
	           $testSuccess = false;
	       }
	       
	       /**
	        * Test with good datetime
	        */
	       if(!$sut->validateDate("990101"))
	       {
	           echo $sut->testErrorMessageFormat("Datum", "validateDate('19990101')");
	           $testSuccess = false;
	       }
	       
	       /**
	        * Test with good datetime
	        */
	       if(!$sut->validateDate("99-01-01"))
	       {
	           echo $sut->testErrorMessageFormat("Datum", "validateDate('99-01-01')");
	           $testSuccess = false;
	       }
	       
	       /**
	        * Test with good username
	        */
	       if(!($sut->validateUsername("Fisken")))
	       {
	           echo $sut->testErrorMessageFormat("Användarnamn", "validateUsername('Fisken')");
	           $testSuccess = false;
	       }
	       
	       /**
	        * Test with bad username
	        */
	       if($sut->validateUsername("JoakimhatarmffimhatarmffnimhatarmffnimhatarmffnimhatarmffnnardeforlorarmotGAISellerOstersIF"))
	       {
	           echo $sut->testErrorMessageFormat("Användarnamn", "validateUsername('JoakimhatarmffimhatarmffnimhatarmffnimhatarmffnimhatarmffnnardeforlorarmotGAISellerOstersIF')");
	           $testSuccess = false;
	       }
	       
	       /**
	        * Test with correct password
	        */
	       if(!$sut->validatePassword("FiskBulle22"))
	       {
	           echo $sut->testErrorMessageFormat("Lösenord", "validatePassword('FiskBulle22')");
	           $testSuccess = false;
	       }
	       
	       /**
	        * Test with bad password
	        */
	       if($sut->validatePassword("jesper"))
	       {
	           echo $sut->testErrorMessageFormat("Lösenord", "validatePassword('jesper')");
	           $testSuccess = false;
	       }
	       
	       /**
	        * Test with bad password
	        */
	       if($sut->validatePassword("jesper2"))
	       {
	           echo $sut->testErrorMessageFormat("Lösenord", "validatePassword('jesper2')");
	           $testSuccess = false;
	       }
	       
	       /**
	        * Test with correct Number as string
	        */
	       if(!$sut->validateNumber("8"))
	       {
	           echo $sut->testErrorMessageFormat("Nummer", "validateNumber('8')");
	           $testSuccess = false;
	       }
	       
	       /**
	        * Test with correct Number as int
	        */
	       if(!$sut->validateNumber(8))
	       {
	           echo $sut->testErrorMessageFormat("Nummer", "validateNumber(8)");
	           $testSuccess = false;
	       }
	       
	       /**
	        * Test with bad number
	        */
	       if($sut->validateNumber("jesper"))
	       {
	           echo $sut->testErrorMessageFormat("Nummer", "validateNumber('jesper'))");
	           $testSuccess = false;
	       }
	       
	       /**
	        * Test to strip Javascript from string
	        */
	       $strippedStr = $sut->filterTextInputFromJS("<div>Korvstroganoff<script>Fisk</script></div>");
	       if ($strippedStr != "&lt;div&gt;Korvstroganoff&lt;/div&gt;")
	       {
	           echo $sut->testErrorMessageFormat("filterTextInputFromJS", "filterTextInputFromJS('<div><script>Fisk</script></div>'))");
	           $testSuccess = false;
	       }
	       
	       /**
	        * Test to strip HTML-tags and JS from string
	        */
	       $filteredStr = $sut->filterTextInputFromHTMLandJS("<div>hej</div><div><script>Fisk</script></div>");
	       if ($filteredStr != "hej")
	       {
	           echo $sut->testErrorMessageFormat("filterTextInputFromHTMLandJS", "filterTextInputFromHTMLandJS('<div>hej</div><div><script>Fisk</script></div>')");
	           $testSuccess = false;
	       }
	       
	       /*              
	       foreach(self::$m_errorMessages as $error)
	       echo "<div>" . $error . "</div>";
	       */            
	                  
	          return $testSuccess;
	      }
	  }