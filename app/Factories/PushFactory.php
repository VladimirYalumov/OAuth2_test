<?php

namespace App\Factories;

use App\Entities\Client;
use App\Handlers\AbstractPushHandler;
use App\Handlers\Push\IOSPushHandler;

class PushFactory
{
    public static function createPushHandler($body, $title, $phone, $pushToken, Client $client) : AbstractPushHandler
    {
        switch($client->getId()){
            case 1:
                return new IOSPushHandler($body, $title, $phone, $pushToken);
                break;
            /*case 2:
                return new IOSPushHandler($body, $title, $phone, $pushToken);
                break;*/
            default:
                return new IOSPushHandler($body, $title, $phone, $pushToken);
        }
    }
}