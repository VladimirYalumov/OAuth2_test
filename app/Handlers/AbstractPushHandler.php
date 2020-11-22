<?php

namespace App\Handlers;

abstract class AbstractPushHandler
{
    protected $body;
    protected $title;
    protected $phone;
    protected $key;
    protected $url;
    protected $pushToken;

    public function __construct($body, $title, $phone, $pushToken)
    {
        $this->title = $title;
        $this->body = $body;
        $this->phone = $phone;
        $this->pushToken = $pushToken;
    }

    abstract public function sendPush(); // : bool;
}