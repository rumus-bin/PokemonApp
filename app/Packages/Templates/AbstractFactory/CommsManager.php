<?php

namespace App\Packages\Templates\AbstractFactory;

abstract class CommsManager
{
    abstract public function getHeaderText();
    abstract public function getApptEncoder(): ApptEncoderInterface;
    abstract public function getFooter();
}
