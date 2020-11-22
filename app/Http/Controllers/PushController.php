<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Factories\PushFactory;

class PushController extends Controller
{
    /**
     * @var PushFactory
     */
    private $pushFactory;

    public function __construct(PushFactory $pushFactory)
    {
        $this->pushFactory = $pushFactory;
    }

    public function changePassword(Request $request)
    {
        $pushHandler = $this->pushFactory::createPushHandler(
            $request->body,
            $request->title,
            $request->phone,
            $request->push_token,
            $request->client
        );

        return $pushHandler->sendPush();
    }
}