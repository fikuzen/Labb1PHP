<?php
	/**
	 * @name:SendMail
	 * @author:Emil Carlsson
	 */
	class SendMail {
		
		private $m_sender_name;
		private $m_sender_email;
		private $m_receiver_name;
		private $m_receiver_email;
		private $m_subject;
		private $m_message;
				
		function __construct($rgMail) {
			
			if (empty($rgMail) || !is_array($rgMail))
				throw new Exception('Value error. Passed argument must be of type array.', 1001);
			
			foreach ($rgMail as $k => $v) {
				switch ($k) {
					case 'sender_name':
						$this->m_sender_name = $v;
						break;
					case 'sender_email':
						$this->m_sender_email = $v;
						break;
					case 'receiver_name':
						$this->m_receiver_name = $v;
						break;
					case 'receiver_email':
						$this->m_receiver_email = $v;
						break;
					case 'subject':
						$this->m_subject = $v;
						break;
					case 'message':
						$this->m_message = wordwrap($v, 70);
						break;
					default:
						throw new Exception('Unknown array message.', 1002);
						break;
				}
			}
			
			return $this->Send();
		}
		
		private function Send() {
			
			$to = $this->m_receiver_email;
			$subject = $this->m_subject;
			$message = $this->m_message;
			$isosubject = iconv("UTF-8", "ISO-8859-1", $subject);
			$isomessage = iconv("UTF-8", "ISO-8859-1", $message);
			$headers = "From: $this->m_sender_name <$this->m_sender_email>\r\n";
			
			/*
			 * För att lägga till ytterligare header information gör på detta vis:
			 * 
			 * $header .= "Den informationen du vill ha här \r\n" !!OBS!! \r\n på slutet.
			 */

			if (mail($to, $isosubject, $isomessage, $headers))
			{
				echo("<script type='text/javascript'>	          alert('Ditt meddelande har blivit skickat'); window.location = 'http://php.murum.nu'</script>");
			}
		}
	}
	