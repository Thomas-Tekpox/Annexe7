<?php

function VersionSite() {
    dd("Version 1");
}


/**
 * @function getDistance()
 * Calculates the distance between two address
 * 
 * @params
 * $addressFrom - Starting point
 * $addressTo - End point
 * $unit - Unit type
 * 
 * @author CodexWorld
 * @url https://www.codexworld.com
 *
 */

function getDistance($addressFrom, $addressTo, $unit = '')
{
	// Google API key
	

	// Change address format
	$formattedAddrFrom    = str_replace(' ', '+', $addressFrom);
	$formattedAddrTo     = str_replace(' ', '+', $addressTo);

	// Geocoding API request with start address
	$geocodeFrom = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=' . $formattedAddrFrom . '&sensor=false&key=' . $apiKey);
	$outputFrom = json_decode($geocodeFrom);
	if (!empty($outputFrom->error_message)) {
		return $outputFrom->error_message;
	}

	// Geocoding API request with end address
	$geocodeTo = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=' . $formattedAddrTo . '&sensor=false&key=' . $apiKey);
	$outputTo = json_decode($geocodeTo);
	if (!empty($outputTo->error_message)) {
		return $outputTo->error_message;
	}

	// Get latitude and longitude from the geodata
	$latitudeFrom    = $outputFrom->results[0]->geometry->location->lat;
	$longitudeFrom    = $outputFrom->results[0]->geometry->location->lng;
	$latitudeTo        = $outputTo->results[0]->geometry->location->lat;
	$longitudeTo    = $outputTo->results[0]->geometry->location->lng;

	// Calculate distance between latitude and longitude
	$theta    = $longitudeFrom - $longitudeTo;
	$dist    = sin(deg2rad($latitudeFrom)) * sin(deg2rad($latitudeTo)) +  cos(deg2rad($latitudeFrom)) * cos(deg2rad($latitudeTo)) * cos(deg2rad($theta));
	$dist    = acos($dist);
	$dist    = rad2deg($dist);
	$miles    = $dist * 60 * 1.1515;

	// Convert unit and return distance
	$unit = strtoupper($unit);
	if ($unit == "K") {
		return round($miles * 1.609344, 2) . ' km';
	} elseif ($unit == "M") {
		return round($miles * 1609.344, 2) . ' meters';
	} else {
		return round($miles, 2) . ' miles';
	}
}

function DHfichier($Nomfic, $MaintenantSiInfoAbsente = true)
{
	$DH = "0000-00-00 00:00:00";
	if ($exif = exif_read_data($Nomfic, 'EXIF', true)) {

		$DH = $exif["EXIF"]["DateTimeOriginal"];
		$DH = substr($DH, 0, 4) . "-" . substr($DH, 5, 2) . "-" . substr($DH, 8, 11);
		$ort = $exif['IFD0']['Orientation'];
		//print "<br/><b>Heure lue : ".$DH."</b>. orientation : ".$ort."<br/>";
	} else {
		$DH = date("Y-m-d H:i:s");
	}

	if ((substr($DH, 0, 1) != "2") && ($MaintenantSiInfoAbsente)) {
		$DH = date("Y-m-d H:i:s");
	}

	return $DH;
}

function OrientationFichier($Nomfic, $MaintenantSiInfoAbsente = true)
{
	$DH = "0000-00-00 00:00:00";
	if ($exif = exif_read_data($Nomfic, 'EXIF', true)) {

		$DH = $exif["EXIF"]["DateTimeOriginal"];
		$DH = substr($DH, 0, 4) . "-" . substr($DH, 5, 2) . "-" . substr($DH, 8, 11);
		$ort = $exif['IFD0']['Orientation'];
		//print "<br/><b>Heure lue : ".$DH."</b>. ORientation : ".$ort."<br/>";
	} else {
		$DH = date("Y-m-d H:i:s");
	}

	if ((substr($DH, 0, 1) != "2") && ($MaintenantSiInfoAbsente)) {
		$DH = date("Y-m-d H:i:s");
	}

	return $ort;
}


function SexeDuPrenom($Prenom)
{
	$myKey = 'rEhCJmrhclvKfXHEvb';
	$data = json_decode(file_get_contents(
		'https://gender-api.com/get?key=' . $myKey .
			'&name=' . urlencode($Prenom)
	));
	return $data->gender;
}

function RotationImage($fic, $ort) {
	// Chargement
	if (file_exists($fic)) {
		$source = imagecreatefromjpeg($fic);
		//print "<hr>ROTATION :".$fic."<br/>";
		
		// Rotation
		switch ($ort) {
			case 6:
				//print "<br/>Rotation Gauche";
				$rotate = imagerotate($source, -90, 0);
				break;
			case 8:
				//print "<br/>Rotation Droite";
				$rotate = imagerotate($source, 90, 0);
				break;
		}
		imagejpeg($rotate, $fic);
	} else {
		//print "<hr>ROTATION IMPOSSIBLE :".$fic." absent.<br/>";
	}	
		
}	

	function image_resize($src, $dst, $width, $height, $crop=0){
	  if(!list($w, $h) = getimagesize($src)) return "Unsupported picture type!";
	  $type = strtolower(substr(strrchr($src,"."),1));
	  if($type == 'jpeg') $type = 'jpg';
	  switch($type){
	    case 'bmp': $img = imagecreatefromwbmp($src); break;
	    case 'gif': $img = imagecreatefromgif($src); break;
	    case 'jpg': $img = imagecreatefromjpeg($src); break;
	    case 'png': $img = imagecreatefrompng($src); break;
	    case 'webp': $img = imagecreatefromwebp($src); break;
	    default : return "Unsupported picture type!";
	  }
	  // resize
	  if($crop){
	    //if($w < $width or $h < $height) return "Picture is too small!";
	    $ratio = max($width/$w, $height/$h);
	    $h = $height / $ratio;
	    $x = ($w - $width / $ratio) / 2;
	    $w = $width / $ratio;
	  }
	  else{
	    //if($w < $width and $h < $height) return "Picture is too small!";
	    $ratio = min($width/$w, $height/$h);
	    $width = $w * $ratio;
	    $height = $h * $ratio;
	    $x = 0;
	  }
	  $new = imagecreatetruecolor($width, $height);
	  // preserve transparency
	  if($type == "gif" or $type == "png"){
	    imagecolortransparent($new, imagecolorallocatealpha($new, 0, 0, 0, 127));
	    imagealphablending($new, false);
	    imagesavealpha($new, true);
	  }
	  imagecopyresampled($new, $img, 0, 0, $x, 0, $width, $height, $w, $h);
	  switch($type){
	    case 'bmp': imagewbmp($new, $dst); break;
	    case 'gif': imagegif($new, $dst); break;
	    case 'jpg': imagejpeg($new, $dst); break;
	    case 'png': imagepng($new, $dst); break;
	    case 'webp': imagewebp($new, $dst); break;
	  }
	  return true;
	}
	
function envoiimage($nomchamp, $chemin, $QryStr, $champdb, $cp, $vcp, $pdoSB, $widthbig, $heightbig, $widthsmall, $heightsmall, $supprimer) { 
		if(is_array($_FILES)) {
			if(is_uploaded_file($_FILES[$nomchamp]['tmp_name'])) {
				$sourcePath = $_FILES[$nomchamp]['tmp_name'];
				$ext = '.'.pathinfo($_FILES[$nomchamp]['name'], PATHINFO_EXTENSION);
				/* if ($ext==".jpg") {
				    $LeWebP=str_replace(".jpg", ".webp", $sourcePath);
				    ConversionJpgWebp($_FILES[$nomchamp]['tmp_name'],$LeWebP);
				    $ext=".webp";
				    $sourcePath=$LeWebP;
				}
				*/
				
				$targetFile = pathinfo($_FILES[$nomchamp]['name'], PATHINFO_BASENAME); // date("YmdHis").$ext;
				$targetPath = $chemin.'/Upl/'.$targetFile;
				// On vérifie que le fichier n'existe pas déjà avec ce nom dans la destination, sinon, on le renomme
				if (file_exists($targetPath)) {
				    $i=1;
				    while (file_exists($chemin.'/Upl/'.$i."_".$targetFile)) {
				        $i++;
				    }
				    $targetPath = $chemin.'/Upl/'.$i."_".$targetFile;
				    $targetFile=pathinfo($targetPath, PATHINFO_BASENAME);
				}
				
				

				if(move_uploaded_file($sourcePath,$targetPath)) {
					$ArrParams=array($champdb=> $targetFile, $cp=> $vcp);
					Exec_QryUpd_Count($QryStr, $ArrParams,$pdoSB);
					$widthheight=getimagesize($targetPath);
					if ($widthheight[0]<=$widthbig && $widthheight[1]<=$heightbig) {
						copy($targetPath, $chemin.'/Big/'.$targetFile);
					} else {
						image_resize($targetPath, $chemin.'/Big/'.$targetFile, $widthbig, $heightbig, $crop=0);
					}
					if ($widthheight[0]<=$widthsmall && $widthheight[1]<=$heightsmall) {
						copy($targetPath, $chemin.'/Small/'.$targetFile);
					} else {
						image_resize($targetPath, $chemin.'/Small/'.$targetFile, $widthsmall, $heightsmall, $crop=0);
					}
					if (!empty($_POST[$supprimer])) {
						unlink($chemin.'/Upl/'.$_POST[$supprimer]);
						unlink($chemin.'/Big/'.$_POST[$supprimer]);
						unlink($chemin.'/Small/'.$_POST[$supprimer]);
					}
					return $targetFile;
				}
			}
		}
}

function ViderRepertoire($Rep) {
	$handle=opendir($Rep);
	while (false !== ($fichier = readdir($handle))) {
		if (($fichier != ".") && ($fichier != "..")) {
			unlink($Rep.'/'.$fichier);
		}
	} 	
}

function ConversionJpgWebp($fichier) {
    $im = @imagecreatefromjpeg($fichier);
    $fic=str_replace('.jpg', '.webp', $fichier);
    imagewebp($im, $fic);
    
    // Libération de la mémoire
    imagedestroy($im);
}
	
	
function Separer($Quoi, $Separateur, &$Deb, &$Fin) {
  $P = strpos($Quoi,$Separateur);
  
  If ($P===false) {
  	$Deb=$Quoi;
  	$Fin = "";
  	//print "KO - ".$Separateur."<br/>";
  	return false;
  }
  else {
    //print "OK - ".$Separateur."<br/>";
    $Deb = substr($Quoi,0,$P);
    $Fin = substr($Quoi, $P+strlen($Separateur),strlen($Quoi)-strlen($P)-strlen($Separateur)+1);
    return true;
  }	
}
	

function Decouper($Quoi, $SeparateurDebut, $SeparateurFin, &$Avant, &$Milieu, &$Apres) {
    $P1 = strpos($Quoi,$SeparateurDebut);
    
    If ($P1===false) {
        $Avant=$Quoi;
        $Milieu = "";
        $Apres = "";
        return false;
    }
    else {
        Separer($Quoi, $SeparateurDebut, $Avant, $Fin);
        Separer($Fin, $SeparateurFin, $Milieu, $Apres);
/*        print '<div style="background-color: green;"><hr/>AV='.$Avant;
        print "<hr/>MI=".$Milieu;
        print "<hr/>FI=".$$Apres."<hr/></div>";
        */
        return true;
    }
}

function println($texte) {
  echo $texte."\n";
}

function zeroSiNull($Nb) {
	if ($Nb=="") {
		return 0;
	} else {
		return $Nb;
	}
}

function ValeurSiNull($Nb,$MettreCetteValeur) {
    if ($Nb=="") {
        return $MettreCetteValeur;
    } else {
        return $Nb;
    }
}

function retourneAge( $naissance ) {
	if (strrpos($naissance,'-')) {
		list( $annee, $mois, $jour ) = explode( '-', $naissance );
	} else {
		list( $jour, $mois, $annee ) = explode( '/', $naissance );
	}

	
	    $now = array( 'J'=>date('j'), 'M'=>date('n'), 'A'=>date('Y') );
	 
	    $age = $now['A'] - $annee;
	    if( $mois > $now['M'] ) $age = $age - 1;
	    elseif( $now['M']==$mois && $jour>$now['J'] ) $age = $age - 1;
	             
	    return $age;
}

function CommencePar($Needle,$DansLaChaine) {
    if (strtolower($Needle)==strtolower(substr($DansLaChaine,0,strlen($Needle)))) {
        return true;
    } else {
        return false;
    }
}


function InfosIPVisiteur() {
    $ip = $_SERVER['REMOTE_ADDR']; // Recuperation de l'IP du visiteur
    $query = @unserialize(file_get_contents('http://ip-api.com/php/'.$ip)); //connection au serveur de ip-api.com et recuperation des données
    if($query && $query['status'] == 'success')
    {
        //code avec les variables
        return $query;
        //echo "Bonjour visiteur de " . $query['country'] . "," . $query['city'];
    } else {
        return false;
    }
}
	
	
