<?php

namespace App\Service\Phone;

class SmsService
{
    public function index()
    {
        //
    }

    public function sendSmsPro($Tel, $Msg) {

    }


    function SendSmsProEx($Emetteur, $Tel, $Msg, $RaspberryPi = 0)
    {  // Version MAIL
        //$Msg=utf8_encode($Msg);
        $Tel = str_replace("+33", "0", $Tel);
        $Tel = str_replace(".", "", $Tel);
        $Tel = str_replace(" ", "", $Tel);
        $Tel = str_replace("-", "", $Tel);
    
        // Forçage temporaire
        $RaspberryPi = 0;
    
    
        if (((substr($Tel, 0, 2) == "06") || (substr($Tel, 0, 2) == "07")) && strlen($Tel) > 9) {
            if (EstEnProd()) {
                $IdClient = zeroSiNull(Exec_QryValue("select IdClient from client where Mobile=:MF", array("MF" => $Tel), $pdoSB));
                $QryStr = 'insert into echangesmailssms(DH,TypeMsg,MsgFrom,MsgTo,Direction,Titre,Corps, IdClient) values (now(), "S", "StudioBontant", :MsgTo, "E", "", :Msg, :IdClient)';
                if (EstEnProd()) {
                    if (EnvoiMailSMSautorise()) {
                        $Arr["MsgTo"] = $Tel;
                    } else {
                        $Arr["MsgTo"] = "0687738512";
                    }
                    $Arr["Msg"] = utf8_decode($Msg);
                } else {
                    $Arr["MsgTo"] = "0652675075";
                    $Arr["Msg"] = "[DEV] " . utf8_decode($Msg);
                }
                $Arr["IdClient"] = $IdClient;
                Exec_QryIns_Id($QryStr, $Arr, $pdoSB);
    
                if ($RaspberryPi == 0) {
                    $To = "baa1f4764eac53d8.silent@sms-to-phone.appspotmail.com";
                    $From = "studiobontant@gmail.com";
                    $Reply = "studiobontant@gmail.com";
                    $Entete = "From:" . $From . "\r\nReply-To:" . $Reply;
                    mail($To, $Arr["MsgTo"], $Arr["Msg"], $Entete);
                } else {
                    sendSmsProRaspberryPi("", $Arr["MsgTo"], $Msg);
                }
            } else {
                mailSBSimple("pbo.spam@gmail.com", "[DEV] SendSms à " . $Tel, $Msg, null);
            }
        }
    }
    
    function sendSmsProRaspberryPi($Emetteur, $Tel, $Msg)
    {  // Version utilisation RaspiSMS du rasberry-pi à l'appart de Courbevoie
        $url = "patbont.zapto.org/RaspiSMS/smsAPI";
        $data["email"] = "pat@sb.fr";
        $data["password"] = 'rototo';
        $data["numbers"] = $Tel;
        $data["text"] = $Msg; // 'c\'était 2€ "le" où 10% êô tre 2 ! '.date("h:i:s");
    
        $RES = SendReq($url, true, $data, "", false, null);
        separer($RES, '{"error":', $Vide, $Fin);
        separer($Fin, '}', $REP, $Vide);
        print "<br/>Code erreur:" . $REP;
        return $REP;
    }
    
    function SendSmsPro2Ex($Emetteur, $Tel, $Msg, $pdoSB)
    {
        $To = "862561035487071.silent@sms-to-phone.appspotmail.com"; // Ancien : 358276070095637
        $From = "studiobontant@gmail.com";
        $Reply = "studiobontant@gmail.com";
        $Entete = "From:" . $From . "\r\nReply-To:" . $Reply;
        $Tel = trim($Tel);
        $Tel = str_replace(".", "", $Tel);
        $Tel = str_replace(" ", "", $Tel);
        $Tel = str_replace("-", "", $Tel);
    
        if (EstEnProd()) {
            if (((substr($Tel, 0, 2) == "06") || (substr($Tel, 0, 2) == "07")) && strlen($Tel) > 9) {
                mail($To, $Tel, stripcslashes($Msg), $Entete);
            } else {
                mail("studiobontant@gmail.com", "Envoi SMS (via Anais) interdit au :" . $Tel, stripcslashes($Msg), $Entete);
            }
        } else {
            mail("pbo.spam@gmail.com", "[DeV] sms à " . $Tel, stripcslashes($Msg), $Entete);
        }
    }
    

}