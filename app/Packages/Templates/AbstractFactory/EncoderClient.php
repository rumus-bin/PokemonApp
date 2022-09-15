<?php

namespace App\Packages\Templates\AbstractFactory;

class EncoderClient
{
    public function __construct(private CommsManager $encoderManager)
    {
    }

    public function encodeMassage(): string
    {
        return $this->encoderManager->getHeaderText() .
            $this->encoderManager->getApptEncoder()->encode() .
            $this->encoderManager->getFooter();
    }
}
