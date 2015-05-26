<?php
/**
 * class.Mailer.php
 * David Lin ( david.lin@digitalcrossroads.com.au )
 */
include_once (APP_ROOT . '/tools/phpmailer/class.phpmailer.php');

class Mailer{
    public $emailObj;
    public $error;

    public function Mailer(){
        $this->emailObj = new PHPMailer();
        // $this->emailObj->IsSMTP(); //uncomment to use SMTP
        // $this->emailObj->Host     = "smtp1.site.com;smtp2.site.com"; // SMTP servers
        // $this->emailObj->SMTPAuth = true;     // turn on SMTP authentication
        // $this->emailObj->Username = "jswan";  // SMTP username
        // $this->emailObj->Password = "secret"; // SMTP password
        $this->emailObj->From = "sales@directedge.com.au";
        $this->emailObj->FromName = TRADING_NAME;

        $this->emailObj->AddAddress("david.lin@directedge.com.au", "David Lin"); //name is optional

        $this->emailObj->AddReplyTo("sales@directedge.com.au", "Sales");
        // $this->emailObj->WordWrap = 50;                              // set word wrap
        // $this->emailObj->AddAttachment("/var/tmp/file.tar.gz"); // attachment
        // $this->emailObj->AddAttachment("/tmp/image.jpg", "new.jpg");
        $this->emailObj->IsHTML(true); // send as HTML
    }

    public function send(Array $info){
        $default = array();
        $default['Subject'] = TRADING_NAME;
        $default['Body'] = ''; //empty body
        $default['AltBody'] = '';
        $default['ReceiptantAddress'] = '';
        $default['ReceiptantName'] = '';

        $default = array_merge($default, $info);


        $this->emailObj->Subject = $default['Subject'];
        $this->emailObj->Body = $default['Body'];



        $this->emailObj->AltBody = $default['AltBody'];

        if($default['ReceiptantAddress'] != ''){
            if($default['ReceiptantName'] != ''){
                $this->emailObj->AddAddress($default['ReceiptantAddress'], $default['ReceiptantName']); //name is optional
            }else{
                $this->emailObj->AddAddress($default['ReceiptantAddress']); //name is optional
            }
        }
        if(!$this->emailObj->Send()){
            $this->error = $this->emailObj->ErrorInfo;
            return false;
        }else{
            return true;
        }
    }



} //  end of class page

?>