<?php

namespace Libraries;

use Aws\S3\S3Client;
use Aws\Result;

class S3
{
  protected S3Client $client;

  public function __construct()
  {
    $this->client = new S3Client([
      'version' => 'latest',
      'region' => 'us-east-1',
      'endpoint' => "http://{$_ENV['S3_ENDPOINT']}:{$_ENV['S3_PORT']}",
      'use_path_style_endpoint' => true,
      'credentials' => [
        'key' => $_ENV['S3_ACCESS_KEY'],
        'secret' => $_ENV['S3_SECRET_KEY'],
      ],
    ]);
  }

  /**
   * Download a file from S3
   *
   * @return Result
   */
  public function download(string $bucket, string $key, string $file): Result
  {
    return $this->client->getObject([
      'Bucket' => $bucket,
      'Key' => $key,
      'SaveAs' => $file,
    ]);
  }

  /**
   * Upload a file to S3
   *
   * @return Result
   */
  public function upload(string $bucket, string $key, string $body): Result
  {
    return $this->client->putObject([
      'Bucket' => $bucket,
      'Key' => $key,
      'Body' => $body,
    ]);
  }
}
