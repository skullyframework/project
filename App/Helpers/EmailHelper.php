<?php
/**
 * Created by TrioDesign (trio@tgitriodesign.com).
 * User: Bobby Stenly Irawan
 * Date: 5/21/13
 * Time: 1:29 PM
 *
 */
namespace App\Helpers;
use App\Mailer;
use Skully\Core\ApplicationAwareHelper;
use Skully\Core\Templating\SmartyAdapter;

class EmailHelper extends ApplicationAwareHelper
{

	public function SendNewPassword($user, $newPassword){
		self::$app->getTemplateEngine()->assign(array(
			"user" => $user->attributes,
			"newPassword" => $newPassword,
			'clientConfig' => self::$app->clientConfig()
		));
		$content = self::$app->getTemplateEngine()->fetch("new.password.tpl");
		$altContent = new \HtmlPlainText($content);
		$mailer = new Mailer(self::$app);
        $res = $mailer->send(array(
			'to' => array($user->attributes["email"]),
			'message' => $content,
			'altMessage' => $altContent->plainText,
			'subject' => "New Password",
			'isHtml' => true
		));
		return $res;
	}
}
