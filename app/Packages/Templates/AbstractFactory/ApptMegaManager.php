<?php

namespace App\Packages\Templates\AbstractFactory;

class ApptMegaManager extends CommsManager
{

    public function getHeaderText()
    {
        return "Appt Mega Encoder Header";
    }

    public function getApptEncoder(): ApptEncoderInterface
    {
        return new ApptMegaEncoder();
    }

    public function getFooter()
    {
        return "Appt Mega Encoder Footer";
    }
}
