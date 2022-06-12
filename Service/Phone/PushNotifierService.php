<?php

namespace App\Service\Phone;

use App\Service\Pbo\PboService;

class PushNotifierService
{

    const SON_PUSHOVER = "pushover";
    const SON_BIKE = "bike";
    const SON_BUGLE = "bugle";
    const SON_CASHREGISTER = "cashregister";
    const SON_CLASSICAL = "classical";
    const SON_COSMIC = "cosmic";
    const SON_PIANOBAR = "pianobar";
    const SON_SIREN = "siren";
    const SON_SPACEALARM = "spacealarm";
    const SON_TUGBOAT = "tugboat";
    const SON_ALIEN = "alien";
    const SON_CLIMB = "climb";
    const SON_PERSISTENT = "persistent";
    const SON_ECHO = "echo";
    const SON_UPDOWN = "updown";
    const SON_VIBRATE = "vibrate";
    const SON_NONE = "none";

    protected $PboService;

    public function __construct(PboService $PboService) {
        $this->PboService = $PboService;
    }

    public function index()
    {
        //
    }

    public function PushMsg($Titre, $Msg, $Son) {

        $Arr = array(
            "user" => "uoyhmjhur1qa4g743wocn6a26qvmed", "device" => "Oneplus_8T", "html" => "1",
            "title" => $Titre, "message" => $Msg, "sound" => $Son=="" ? "none" : $Son
        );
        $this->PboService->SendReq("https://api.pushover.net/1/messages.json", true, $Arr, "", false, "");
    }

}