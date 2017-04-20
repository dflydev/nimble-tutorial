<?php

namespace LoneStar\Http;

use Psr\Http\Message\ServerRequestInterface;

class SpeakersDetail
{
    public function __invoke(ServerRequestInterface $serverRequest)
    {
        return 'Hello (from a CLASS!!!! AS A STRING!!!!!!) '.$serverRequest->getAttribute('parameters')['speaker_name'];
    }
}