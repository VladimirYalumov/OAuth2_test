<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Config;
use SendGrid\Mail\Mail;

class EmailService
{
    private $mailer;
    private $to;
    private $body;
    private $subject;

    public function __construct($body = 'test', $subject = 'test', $to = 'vladimir.ylmv@gmail.com')
    {
        $this->body = $body;
        $this->subject = $subject;
        $this->to = $to;
        $this->mailer = Config::get('mail.mailers.smtp');
    }

    public function sendEmail()
    {
        $email = new Mail();
        $email->setFrom($this->mailer['email']);
        $email->setSubject($this->subject);
        $email->addTo($this->to);
        $email->addContent("text/plain", $this->body);

        $sendgrid = new \SendGrid($this->mailer['api_key']);

        try {
            $response = $sendgrid->send($email);
        } catch (Exception $e) {
            var_dump('Caught exception: '. $e->getMessage() ."\n");
        }
    }
    

    /**
     * Get the value of subject
     */ 
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set the value of subject
     *
     * @return  self
     */ 
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get the value of body
     */ 
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set the value of body
     *
     * @return  self
     */ 
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get the value of to
     */ 
    public function getTo()
    {
        return $this->to;
    }

    /**
     * Set the value of to
     *
     * @return  self
     */ 
    public function setTo($to)
    {
        $this->to = $to;

        return $this;
    }
}