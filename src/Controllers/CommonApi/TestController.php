<?php 

namespace Controllers\CommonApi;

use Services\ElevenLabs;

class TestController
{
    public function test()
    {
        // $minio = new \Services\MinIO();
        // $result = $minio->upload('hello');

        // print json_encode($result);

        $text = "Siema, elo, cześć";
        // $textHash = md5($text);
        print ElevenLabs::textToSpeech($text);
    }
}