<?php 

namespace Services;

use Aws\S3\S3Client;
use Aws\Result;

class MinIO
{
  protected S3Client $client;

  public function __construct()
  {
    $this->client = new S3Client([
      'version' => 'latest',
      'region' => 'us-east-1',
      'endpoint' => "http://{$_ENV['MINIO_ENDPOINT']}:{$_ENV['MINIO_PORT']}",
      'use_path_style_endpoint' => true,
      'credentials' => [
        'key' => $_ENV['MINIO_ACCESS_KEY'],
        'secret' => $_ENV['MINIO_SECRET_KEY'],
      ],
    ]);
  }

  /**
   * Download a file from MinIO
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
   * Upload a file to MinIO
   * 
   * @return Result
   */
  public function upload(string $bucket): Result
  {
    return $this->client->putObject([
      'Bucket' => $bucket,
      'Key' => "hell.txt",
      'Body' => "HELLO",
    ]);
  }
}
