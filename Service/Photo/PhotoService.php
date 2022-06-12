<?php

namespace App\Service\Photo;

use DateTime;
use Exception;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class PhotoService
{
    protected $parameterBag;
    protected $appUrl;
    
    public function __construct(ParameterBagInterface $parameterBag)
    {
        $this->parameterBag = $parameterBag;

        $appUrl = $this->parameterBag->get('kernel.project_dir')."\public\galeries\images\\";
        $this->appUrl = $appUrl;

        $now = new DateTime();
        $now->format("Y-m");
        $now = date_format($now, 'Y-m');
        $this->now = $now;
    }
    
    public function getPhotoSize(string $imgName) {
        try {
            $photo = $this->appUrl.$this->now.'\\'.$imgName;
            $Size=getimagesize($photo);
            return array($Size[0], $Size[1]);
        }
        catch (Exception $e){
            return false;
        }
    }

    public function deletePhoto(string $imgName) {
        $photo = $this->appUrl.$this->now.'\\'.$imgName;
        if(file_exists($photo)) {
            unlink($photo);
        }
    }

    public function getPath(string $imgName)
    {
        return "galeries/images/".$this->now.'/'.$imgName;
    }
}