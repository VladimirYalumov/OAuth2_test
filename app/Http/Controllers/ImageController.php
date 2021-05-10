<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\AmasonS3Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    /**
     * @var AmasonS3Service
     */
    private $amasonS3Service;

    public function __construct(AmasonS3Service $authService)
    {
        $this->authService = $authService;
    }

    public function test2()
    {
        return base64_encode(Storage::disk('s3')->get('test/test.jpg'));
    }

    public function test(Request $request)
    {
        $image = $request->images[0];
        Storage::disk('s3')->put('test/test.jpg', base64_decode($image));
        return true;
    }
}