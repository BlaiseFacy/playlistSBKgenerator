<?php
/*
if ($_FILES['playlist']['error']) {     
          switch ($_FILES['playlist']['error']){     
                   case 1: // UPLOAD_ERR_INI_SIZE     
                   echo"Le fichier dépasse la limite autorisée par le serveur (fichier php.ini) !";     
                   break;     
                   case 2: // UPLOAD_ERR_FORM_SIZE     
                   echo "Le fichier dépasse la limite autorisée dans le formulaire HTML !"; 
                   break;     
                   case 3: // UPLOAD_ERR_PARTIAL     
                   echo "L'envoi du fichier a été interrompu pendant le transfert !";     
                   break;     
                   case 4: // UPLOAD_ERR_NO_FILE     
                   echo "Le fichier que vous avez envoyé a une taille nulle !"; 
                   break;     
          }     
}
*/
$codeErreur = 0; // pas d'erreur par défaut
$libelleErreur = "";
$listeTitres = array();
$nomFichier = "";

if ($_FILES['playlist']['error'])
{
	switch ($_FILES['playlist']['error'])
	{   
		case 1: // UPLOAD_ERR_INI_SIZE     
			$codeErreur = 1;
			$libelleErreur = "Le fichier ne doit pas dépasser 1Mo !";
		break;     
		case 2: // UPLOAD_ERR_FORM_SIZE  
			$codeErreur = 1;
			$libelleErreur = "Le fichier ne doit pas dépasser 1Mo !";
		break;     
		case 3: // UPLOAD_ERR_PARTIAL     
			$codeErreur = 1;
			$libelleErreur = "L'envoi du fichier a été interrompu !";    
		break;     
		case 4: // UPLOAD_ERR_NO_FILE     
			$codeErreur = 1;
			$libelleErreur = "Le fichier a une taille nulle !";  
		break; 
	}
}
$source = $_FILES["playlist"]["tmp_name"]; // Récupère le fichier sélectionné
if ($source)
{
	$nomOrigine = $_FILES['playlist']['name'];
	$elementsChemin = pathinfo($nomOrigine);
	$extensionFichier = $elementsChemin["extension"];
	$extensionsAutorisees = array("txt", "m3u", "m3u8", "mp3u", "csv");
	$nomFichier = $nomOrigine;
	if (!(in_array($extensionFichier, $extensionsAutorisees)))
	{
		$codeErreur = 1;
		$libelleErreur = "Fichiers de type ".$extensionFichier." non autorisés !";
	}

	if ($codeErreur == 0)
	{
		$file = fopen($source, "r"); // Ouvre le fichier
		// Caractères ASCII à exclure
		$ascii= array(13, 35, 9, 32); // 35:# ; 13:Carriage return; 9:Tab; 32:Space
		$bom = pack('CCC', 0xEF, 0xBB, 0xBF);
		// Lit le fichier ligne par ligne
		$numTitre = 0;
		$isUTF8 = false;
		/*
		if (isset($_POST["encoding"]))
		{
			$encoding = $_POST["encoding"];
		}
		if ($encoding == "utf8")
		{
			$isUTF8 = true;
		}
		*/
		while($line = fgets($file))
		{
			if ($numTitre == 0 & substr($line, 0, 3) === $bom) // On retire le BOM en début de fichier s'il existe
			{
				$line = substr($line, 3);
				$isUTF8 = true; // Seul moyen d'être sûr qu'on a du UTF-8 donc quand on n'a pas de bom on ne peut pas savoir.
			}
			$first_char= ord(substr($line, 0, 1)); // Transforme le premier caractère en ASCII
			if(!in_array($first_char, $ascii)) // Si ce n'est pas un commentaire(#) ou une ligne vide
			{
				//mb_detect_encoding($line, 'UTF-8', true); // Ne fonctionne pas bien
				// Supprime les retours à la ligne
				$line = str_replace(array("\r\n","\n"),"", $line);
				//echo $line."<br>";
				//$items= explode(';', $line);
				/*
				if (!$isUTF8)
				{
					$line = utf8_encode($line);
				}
				*/
				$listeTitres[$numTitre] = $line;
				$numTitre++;
			}
		}
		// Tester si listeTitres est vide
		if (empty($listeTitres))
		{
			// Le fichier est vide on renvoit une erreur
			$codeErreur = 1;
			$libelleErreur = "Le fichier est vide !";
		}
	}	
}
if (empty($listeTitres) & $codeErreur == 0) // Ca ne devrait pas arriver mais si le serveur déconne cela peut se produire
{
	$codeErreur = 1;
	$libelleErreur = "Le fichier ne doit pas dépasser 1Mo !";  
}

if (strlen(json_encode($listeTitres)) <= 0) // Si on a un plantage dans la stringification Json c'est probablement un problème d'encodage ISO
{
	for ($i = 0 ; $i < count($listeTitres) ; $i++)
	{
		$listeTitres[$i] = utf8_encode($listeTitres[$i]);
	}
}
$erreur = array("code" => $codeErreur, "libelle" => $libelleErreur);
$retour = array("nomFichier" => $nomFichier, "erreur" => $erreur, "listeTitres" => $listeTitres);
echo json_encode($retour);

?>
