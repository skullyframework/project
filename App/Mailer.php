<?php

namespace App;
class Mailer
{

    /**
     * @var \PHPMailer
     */
    private $_mail = null;
	public $errors = array();

    /** @var  Application $app */
    protected $app;

	public function __construct($app, $options = array()) {
		$this->app = $app;
        $this->initMail();
	}

	// to: array of recipients (recipient could be array('email@address.com', 'name') or 'email@address.com'
	// isHtml: boolean
	// subject: string
	// message: string
	// altMessage: string
	public function send($options = array()) {
		if (empty($this->_mail)) {
			$this->initMail();
		}
		if (!empty($options['to'])) {
			foreach($options['to'] as $recipient) {
				if (is_array($recipient)) {
					$this->_mail->AddAddress($recipient[0], $recipient[1]);
				}
				else {
					$this->_mail->AddAddress($recipient);
				}
			}
		}

		//set attachments
		if(!empty($options["attachments"])){
			foreach($options["attachments"] as $attachment){
				$this->_mail->AddAttachment($attachment["filePath"], $attachment["fileName"]);
			}
		}

		$this->_mail->IsHTML($options['isHtml']);                                  // Set email format to HTML

		$this->_mail->Subject = $options['subject'];
		$this->_mail->Body    = $options['message'];

		if (!empty($options['altMessage'])) {
			$this->_mail->AltBody = $options['altMessage'];
		}
		if(!$this->_mail->Send()) {
			$this->errorLog('Message could not be sent.');
			$this->errorLog('Mailer Error: ' . $this->_mail->ErrorInfo);
			$this->_mail = null;
			return false;
		}
		else {
			$this->_mail = null;
			return true;
		}
	}

	public function errorLog($message = '') {
		$this->errors[] = $message;
		// errorLog("Mailing error: " . $message);
	}

	private function initMail() {
		require_once BASE_PATH.'library/PHPMailer/class.phpmailer.php';

        $crypt = new \EncryptionClass();

		$this->_mail = new \PHPMailer;

		$this->_mail->IsSMTP();                                      // Set mailer to use SMTP
		$this->_mail->Host = $this->app->config('smtpHost');  // Specify main and backup server
		$this->_mail->SMTPAuth = true;                               // Enable SMTP authentication
		$this->_mail->Username = $this->app->config('smtpUsername');                            // SMTP username
		$this->_mail->Password = $crypt->decrypt($this->app->config('globalSalt'), $this->app->config('smtpPassword'));                           // SMTP password
		$this->_mail->SMTPSecure = $this->app->config('smtpSecurity');                            // Enable encryption, 'ssl' also accepted
		$this->_mail->Port = $this->app->config("smtpPort");

		$this->_mail->From = $this->app->config('senderEmail');
		$this->_mail->FromName = $this->app->config('senderName');
		$this->_mail->AddReplyTo($this->app->config('replyToEmail'), $this->app->config('replyToName'));

		$this->_mail->WordWrap = 100;
//		$this->_mail->SMTPDebug = 1; // for debugging
	}
}
