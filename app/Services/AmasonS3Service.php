<?php

namespace App\Services;

use Aws\S3\S3Client;
use League\Flysystem\AwsS3v3\AwsS3Adapter;
use League\Flysystem\Filesystem;

class AmasonS3Service
{
    private $client = new S3Client([
        'credentials' => [
            'key'    => 'your-key',
            'secret' => 'your-secret'
        ],
        'region' => 'your-region',
        'version' => 'latest|version',
    ]);

    
}