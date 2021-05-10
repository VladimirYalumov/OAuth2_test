<?php

namespace App\Services;

use App\Repositories\PostRepository;
use Illuminate\Support\Facades\Storage;

class AmasonS3Service
{
    private $postRepository;
 
    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function saveImage($file) : bool
    {
        Storage::disk('s3')->put('/pdf/filename', file_get_contents($file));
        return true;
    }
    
}