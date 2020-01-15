<!doctype html>
<?php
	if (isset($_GET["lang"]))
	{
		$langage = $_GET["lang"];
	}
	else
	{
		$langage = "fr";
	}
	switch ($langage)
	{
		case "fr":
			include("lang/fr-lang.php");
			break;
		case "en":
			include("lang/en-lang.php");
			break;
		case "es":
			include("lang/es-lang.php");
			break;
	}
	
	// Taille max des fichiers à uploader
	$MAX_FILE_SIZE = 1048576;
	// Extensions autorisées
	$AUTHORIZED_EXTENSIONS = "['txt', 'm3u', 'm3u8', 'mp3u', 'csv']";
?>
<html lang="en">
	<head>
		<title>PlaylistSBKgenerator</title>
		<link rel="icon" size="32x32" href="./img/favicon32.png" type="image/png">
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="Blaise Facy">
		<title>Playlist SBK Generator</title>

		<!--
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		-->
		
		<script type="text/javascript" src="./js/jquery.min.js"></script><!-- jquery 1.11.3 -->
		<script type="text/javascript" src="./js/umd/popper.min.js"></script><!-- popper 1.14.7 -->
		<script type="text/javascript" src="./js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="./css/bootstrap.min.css"><!-- bootstrap 4.3.1 -->
		<link rel="stylesheet" href="./lang/languages.min.css"/><!-- langages -->
	

		<style type="text/css">
		<!--
			body {
				height: 100%;
				color: #000000;
			}

			@media (max-width: 740px) {
				html,
				body,
				header,
				.view {
					height: 100vh;
				}
			}
			
			@media (max-width: 991px) {
				.navbar:not(.top-nav-collapse) {
					background: #563e91 !important;
				}
			}

			.rgba-gradient {
			
				/*
				background: -moz-linear-gradient(45deg, rgba(213, 15, 61, 0.6), rgba(13, 17, 198, 0.69) 100%);
				background: -webkit-linear-gradient(45deg, rgba(213, 15, 61, 0.6), rgba(13, 17, 198, 0.69) 100%);
				background: linear-gradient(to 45deg, rgba(213, 15, 61, 0.6), rgba(13, 17, 198, 0.69) 100%);
				
				background: -moz-linear-gradient(45deg, rgba(213, 15, 61, 0.6), rgba(13, 17, 198, 1) 100%);
				background: -webkit-linear-gradient(45deg, rgba(213, 15, 61, 0.6), rgba(13, 17, 198, 1) 100%);
				background: linear-gradient(to 45deg, rgba(213, 15, 61, 0.6), rgba(13, 17, 198, 1) 100%);
				
				background: -webkit-linear-gradient(45deg, green, yellow, rgba(213, 15, 61, 0.6), rgba(13, 17, 198, 0.5), rgba(0, 0, 0, 1));
				
				background: linear-gradient(320deg, #231557 0%, #44107A 19%, #FF1361 77%, #FFF800 100%, #00F800);
				
				background: linear-gradient(217deg, rgba(255, 0, 0, 0.8), rgba(255, 0, 0, 0) 70.71%), linear-gradient(127deg, rgba(0, 255, 0, 0.8), rgba(0, 255, 0, 0) 70.71%), linear-gradient(336deg, rgba(0, 0, 255, 0.8), rgba(0, 0, 255, 0) 70.71%);

				background-color: #ac0;
				background-size: 50px 50px;
				background-image: linear-gradient(45deg, rgba(255, 255, 255, .2) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, .2) 50%, rgba(255, 255, 255, .2) 75%, transparent 75%, transparent);
				
				background: -moz-linear-gradient(45deg, rgba(213, 15, 61, 0.6), rgba(13, 17, 198, 0.69) 100%);
				background: -webkit-linear-gradient(45deg, rgba(213, 15, 61, 0.6), rgba(13, 17, 198, 0.69) 100%);
				background: linear-gradient(to 45deg, rgba(213, 15, 61, 0.6), rgba(13, 17, 198, 0.69) 100%);

				background-image: url(./img/egg_shell_transp.png), -moz-linear-gradient(45deg, rgba(213, 15, 61, 0.6), rgba(13, 17, 198, 1) 100%);
				background-image: url(./img/egg_shell_transp.png), -webkit-linear-gradient(45deg, rgba(213, 15, 61, 0.6), rgba(13, 17, 198, 1) 100%);
				background-image: url(./img/egg_shell_transp.png), linear-gradient(to 45deg, rgba(213, 15, 61, 0.6), rgba(13, 17, 198, 1) 100%);
				
				background-image: url(./img/fabric.png), linear-gradient(217deg, rgba(255, 0, 0, 0.8), rgba(255, 0, 0, 0) 70.71%), linear-gradient(127deg, rgba(0, 255, 0, 0.8), rgba(0, 255, 0, 0) 70.71%), linear-gradient(336deg, rgba(0, 0, 255, 0.8), rgba(0, 0, 255, 0) 70.71%);
				
				background-color: #a9a788;
				background-image: url(./img/egg_shell_transp.png);				
				*/
				
				background: url(./img/egg_shell.jpg) repeat top left;
			}
			.alert-success {
				background-color: #94d091;
				background-image: url(./img/fabric.png);
				color: #FFF;
				box-shadow: -1px -1px 3px rgba(0,0,0,0.1), 6px 6px 8px rgba(0,0,0,0.3);
			}
			.alert-danger {
				background-color: #e23235;
				background-image: url(./img/fabric.png);
				color: #FFF;
				box-shadow: -1px -1px 3px rgba(0,0,0,0.1), 6px 6px 8px rgba(0,0,0,0.3);
			}
			.alert-info {
				background-color: #17a2b8;
				background-image: url(./img/fabric.png);
				color: #FFF;
				box-shadow: -1px -1px 3px rgba(0,0,0,0.1), 6px 6px 8px rgba(0,0,0,0.3);
			}
			#enTete {
				/*background-image: url(./img/fabric.png), linear-gradient(45deg, rgba(213, 15, 61, 0.6), rgba(13, 17, 198, 0.69) 100%);*/
				/*padding: 20px 0px;*/
			}
			.btn-circle {
				width: 30px;
				height: 30px;
				padding: 6px 0px;
				border-radius: 15px;
				text-align: center;
				font-size: 12px;
				line-height: 1.42857;
			}
		-->	
		</style>
		<script type='text/javascript'>
			var playlistSBK = [];
			var listeTitres = {"salsa":[], "bachata":[], "kizomba":[]};
			var liste_Id_SBK = {"salsa":[], "bachata":[], "kizomba":[]};
			var cycle_SBK = 0;
			var type_SBK = "";
			erreurGeneration = false;
			erreurGeneration_libelle = "";
		
			function replaceAll(chaineAModifier,recherche, remplacement)
			{
				return chaineAModifier.split(recherche).join(remplacement);
			}
			function checkTypes()
			{
				var e3 = document.getElementById("L3");
				var strUser3 = e3.options[e3.selectedIndex].value;
				if (strUser3 == "")
				{
					document.getElementById("N3").value = "";
					document.getElementById("N3").disabled = true;
					document.getElementById("L4").value = "";
					document.getElementById("L4").disabled = true;
				}
				else
				{
					document.getElementById("N3").disabled = false;
					document.getElementById("L4").disabled = false;
					document.getElementById("N4").disabled = false;
				}
				var e4 = document.getElementById("L4");
				var strUser4 = e4.options[e4.selectedIndex].value;
				if (strUser4 == "")
				{
					document.getElementById("N4").value = "";
					document.getElementById("N4").disabled = true;
				}
				else
				{
					document.getElementById("N4").disabled = false;
				}
			}
			function controlMusiquePath(musique)
			{
				textPath = $("#" + musique + "Path").val();
				if ($("#pathTypeRadioMS").prop("checked"))
				{
					textPath = replaceAll(textPath, "/", "\\");
					$("#" + musique + "Path").val(textPath);
				}
				if (!textPath.endsWith("\\") && $("#pathTypeRadioMS").prop("checked"))
				{
					if (textPath.trim() == "")
					{
						$("#" + musique + "Path").val("..\\")
					}
					else
					{
						$("#" + musique + "Path").val(textPath + "\\")
					}
				}
				if ($("#pathTypeRadioUnix").prop("checked"))
				{
					textPath = replaceAll(textPath, "\\", "/");
					$("#" + musique + "Path").val(textPath);
				}
				if (!textPath.endsWith("/") && $("#pathTypeRadioUnix").prop("checked"))
				{
					if (textPath.trim() == "")
					{
						$("#" + musique + "Path").val("./")
					}
					else
					{
						$("#" + musique + "Path").val(textPath + "/")
					}
				}
			}
			function controlMusiquesPath()
			{
				controlMusiquePath("salsa");
				controlMusiquePath("bachata");
				controlMusiquePath("kizomba");
			}
			function controlMusique(musique)
			{
				switch (musique)
				{
					case "salsa":
						lettre = "S"
						break;
					case "bachata":
						lettre = "B"
						break;
					case "kizomba":
						lettre = "K"
						break;
					default:
				}
				if (lettre == $("#L1").val() || lettre == $("#L2").val() || lettre == $("#L3").val() || lettre == $("#L4").val())
				{
					if (listeTitres[musique].length == 0)
					{
						erreurGeneration = true;
						erreurGeneration_libelle = erreurGeneration_libelle + "<br>" + "- <?php echo TXT_THE_PLAYLIST ?> " + musique + " <?php echo TXT_IS_EMPTY ?>";
					}
				}
			}
			function controlForm()
			{
				for (i = 1 ; i <= 4 ; i++) 
				{
					if ($("#L" + i).val() != "" && $("#N" + i).val() == "")
					{
						erreurGeneration = true;
						erreurGeneration_libelle = erreurGeneration_libelle + "<br>" + "- <?php echo TXT_THE_LETTRE ?> n° " + i + " <?php echo TXT_DONT_HAVE_ASSOC_NB ?>";
					}
				}
				var doublon = false;
				for (i = 1 ; i <= 4 ; i++) 
				{
					labelTest = $("#L" + i).val();
					if (i < 4)
					{
						if (i == 3 & $("#L4").val() == "")
						{
							labelTestSuivant = $("#L1").val();
						}
						else
						{
							labelTestSuivant = $("#L" + (i + 1)).val();
						}
					}
					else
					{
						labelTestSuivant = $("#L1").val();
					}
					if (labelTest == labelTestSuivant && labelTest != "")
					{
						doublon = true;
					}
				}
				if (doublon)
				{
					erreurGeneration = true;
					erreurGeneration_libelle = erreurGeneration_libelle + "<br>" + "- <?php echo TXT_NO_CONS_LETTRES ?>";
				}
				
			}
			function composeType()
			{
				// On compose le type
				type_SBK = "";
				for (i = 1 ; i <= 4 ; i++) 
				{
					if ($("#L" + i).val() != "") type_SBK += $("#L" + i).val();
				}
				for (i = 1 ; i <= 4 ; i++) 
				{
					if ($("#N" + i).val() != "") type_SBK += $("#N" + i).val();
				}
			}
			function genererPlaylist()
			{
				playlistSBK = [];
				erreurGeneration = false;
				erreurGeneration_libelle = "";
				
				controlForm();
				controlMusiquesPath();
				controlMusique("salsa");
				controlMusique("bachata");
				controlMusique("kizomba");
				
				if (erreurGeneration == true)
				{
					//alert("Génération de la playlist impossible :\n" + erreurGeneration_libelle);
					document.getElementById("infoGenererPlaylist").style.visibility = "visible";			
					$("#infoGenererPlaylist").attr("class", "alert alert-danger");
					document.getElementById("infoGenererPlaylist").innerHTML = "<?php echo TXT_CANT_GENERATE ?> :<br>" + erreurGeneration_libelle;
				}
				else
				{
					afficheExportModel();
					document.getElementById("infoGenererPlaylist").innerHTML = "";
					document.getElementById("infoGenererPlaylist").style.visibility = "visible";
					$("#infoGenererPlaylist").attr("class", "spinner-border m-2");
				
					composeType();
					// On calcule le cycle
					cycle_SBK = parseInt($("#N1").val()) + parseInt($("#N2").val());
					if (!isNaN(parseInt($("#N3").val())))
					{
						cycle_SBK += parseInt($("#N3").val());
					}
					if (!isNaN(parseInt($("#N4").val())))
					{
						cycle_SBK += parseInt($("#N4").val());
					}
					genererMusique("salsa");
					genererMusique("bachata");
					genererMusique("kizomba");
					// On enlève les éléments en trop
					var pos = 0;
					for (t = 0 ; t < playlistSBK.length ; t++)
					{
						if (playlistSBK[t] === undefined)
						{
							pos = t;
							break;
						}
					}
					if (pos > 0)
					{
						playlistSBK.splice(pos, playlistSBK.length - pos);
					}
					
					// Si on doit limiter la taille des playlists
					var maxCycle = true;
					if ($("#maxCycle").val() == 0)
					{
						maxCycle = false;
					}
					if (maxCycle)
					{
						nbCycles = Math.floor(playlistSBK.length / cycle_SBK);
						maxItems = $("#maxCycle").val() * cycle_SBK;
						if (nbCycles > 1 && maxItems < playlistSBK.length)
						{
							maxItems = $("#maxCycle").val() * cycle_SBK;
							playlistSBK.splice(maxItems, playlistSBK.length - maxItems);
						}
						else
						{
							maxCycle = false;
						}
					}
					if (!maxCycle)
					{
						// On coupe pour avoir des cycles complets jusqu'à la fin
						if (playlistSBK.length > cycle_SBK)
						{
							for (j = playlistSBK.length ; j >= 1 ; j--) 
							{
								if (j % cycle_SBK == 0)
								{
									playlistSBK.splice(j, playlistSBK.length - j);
									break;
								}
							}
						}
					}
					$("#infoGenererPlaylist").attr("class", "alert alert-success");
					document.getElementById("infoGenererPlaylist").innerHTML = "<?php echo TXT_THE_PLAYLIST ?> " + type_SBK + " <?php echo TXT_OF ?> " + playlistSBK.length + " <?php echo TXT_TITLES_GENERATED ?> :-)";
				}
			}
			function randomInt(mini, maxi)
			{
				 var nb = mini + (maxi+1-mini)*Math.random();
				 return Math.floor(nb);
			}
			Array.prototype.shuffle = function(n)
			{
				// Permet de mélanger un tableau aléatoirement
				 if (!n)
					  n = this.length;
				 if (n > 1)
				 {
					  var i = randomInt(0, n-1);
					  var tmp = this[i];
					  this[i] = this[n-1];
					  this[n-1] = tmp;
					  this.shuffle(n-1);
				 }
			}
			function genererMusique(musique)
			{
				switch (musique)
				{
					case "salsa":
						lettre = "S"
						break;
					case "bachata":
						lettre = "B"
						break;
					case "kizomba":
						lettre = "K"
						break;
					default:
				}
				// Si le type choisi comporte cette musique
				if (lettre == $("#L1").val() || lettre == $("#L2").val() || lettre == $("#L3").val() || lettre == $("#L4").val())
				{
					liste_Id_SBK[musique] = [];
					// On mélange la playlist
					listeTitres[musique].shuffle();
					// On génère les ID du 1er cycle
					var rang = 0;
					var p, c;
					var texte = "";
					for (i = 1 ; i <= 4 ; i++) // On parcourt les lettres
					{
						if (lettre == $("#L" + i).val())
						{
							p = 0
							if (i > 1)
							{
								for (j = 1 ; j < i ; j++)
								{
									p = p + parseInt($("#N" + j).val());
								}
							}
							for (c = 1 ; c <= parseInt($("#N" + i).val()) ; c++)
							{
								liste_Id_SBK[musique][rang] = p + c;
								rang = rang + 1;
							}
						}
					}
					var pas = liste_Id_SBK[musique].length;
					// On complète les ID des cycles suivants
					for (y = liste_Id_SBK[musique].length ; y < listeTitres[musique].length ; y++)
					{
						liste_Id_SBK[musique][y] = parseInt(liste_Id_SBK[musique][y - pas]) + cycle_SBK;
					}
					//On constitue la playlist SBK
					for (z = 0 ; z < listeTitres[musique].length ; z++)
					{
						//alert(listeTitres[musique][z]);
						texte = listeTitres[musique][z];
						if ($("#pathOptionRadios_yes").prop("checked"))
						{
							if (texte.lastIndexOf("/") != -1)
							{
								texte = texte.substring(texte.lastIndexOf("/") + 1, texte.length);
							}
							if (texte.lastIndexOf("\\") != -1)
							{
								texte = texte.substring(texte.lastIndexOf("\\") + 1, texte.length);
							}
							texte = $("#" + musique + "Path").val() + texte;
						}
						playlistSBK[liste_Id_SBK[musique][z]-1] = texte;
					}
				}
			}
			function controlOptionPath()
			{
				if ($("#pathOptionRadios_yes").prop("checked"))
				{
					$("#formPath").show();
				}
				else
				{
					$("#formPath").hide();
				}
			}
			function afficheAide(type)
			{
				if (document.getElementById(type).style.visibility == "visible")
				{
					document.getElementById(type).innerHTML  = "";
					document.getElementById(type).style.marginTop = "-30px";
					document.getElementById(type).style.visibility = "hidden";
				}
				else
				{
					switch (type)
					{
						case "helpImport":
							texte = "<?php echo TXT_HELP_IMPORT ?>"
							break;
						case "helpGeneration":
							texte = "<?php echo TXT_HELP_GENERATION ?>"
							break;
						case "helpGenerationPath":
							texte = "<?php echo TXT_HELP_GENERATION_PATH ?>"
							break;
						case "helpEncoding":
							texte = "<?php echo TXT_HELP_ENCODING ?>"
							break;
						case "helpExport":
							texte = "<?php echo TXT_HELP_EXPORT ?>"
							break;
						default:
					}
					if (type == "helpGenerationPath")
					{
						document.getElementById(type).style.marginTop = "20px";
					}
					else
					{
						document.getElementById(type).style.marginTop = "0px";
					}
					document.getElementById(type).innerHTML  = texte;
					document.getElementById(type).style.visibility = "visible";
				}
			}
			function afficheExportModel()
			{
				composeType();
				document.getElementById("exportModel").innerHTML  = $("#exportPrefixe").val() + "_" + type_SBK + "_(x)." + $("#exportExtension").val();
			}
			function changeEncoding()
			{
				if (document.getElementById("encoding_utf8").checked)
				{
					document.getElementById("encoding_salsa").value = "utf8";
					document.getElementById("encoding_bachata").value = "utf8";
					document.getElementById("encoding_kizomba").value = "utf8";
				}
				else
				{
					document.getElementById("encoding_salsa").value = "iso";
					document.getElementById("encoding_bachata").value = "iso";
					document.getElementById("encoding_kizomba").value = "iso";
				}
			}
		</script>
	
	</head>
	<body class="bg-light">
		<div class="mask rgba-gradient d-flex justify-content-center align-items-center">
			<div class="container">
				<img src="./img/playlistSBKgenerator2.png" style="width:100%;height:auto;">
				<div class="row justify-content-center">
					<div class="input-group-addon" id="lang_select">
						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
							<span class="lang-sm lang-lbl" lang="<?php echo $langage ?>"></span> <span class="caret"></span>
						</button>
						<div class="dropdown-menu">
							<?php if ($langage != "fr") echo "<a class='dropdown-item' href='./index.php?lang=fr'><span class='lang-lg lang-lbl' lang='fr'></span></a>" ?>
							<?php if ($langage != "en") echo "<a class='dropdown-item' href='./index.php?lang=en'><span class='lang-lg lang-lbl' lang='en'></span></a>" ?>
							<?php if ($langage != "es") echo "<a class='dropdown-item' href='./index.php?lang=es'><span class='lang-lg lang-lbl' lang='es'></span></a>" ?>
						</div>
					</div>
					<a class="btn btn-dark" href="http://paypal.me/BlaiseFacy" role="button"><?php echo TXT_DONATE ?></a>
				</div>
				<hr class="mb-4">
				<h4 class="mb-3"><?php echo TXT_IMPORT ?>
					<button type="button" class="btn btn-info btn-circle" onClick="afficheAide('helpImport');">
						<img src="./img/info.png" style="width:18px;height:auto;">
					</button>
				</h4>
				<div class="alert alert-info" role="info" id="helpImport" style="visibility:hidden;margin-top:-30px"></div>
				<div class="custom-file">
					<form id="salsaFileUpload">
						<input type="file" class="custom-file-input" id="salsaFile" name="playlist" onChange="uploadFileAjax('salsa');">
						<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $MAX_FILE_SIZE ?>"/>
						<input type="hidden" name="encoding" id="encoding_salsa"value="utf8"/>
						<label class="custom-file-label" for="customFile" id="salsaFileName"><?php echo TXT_CHOOSE_SALSA_FILE ?></label>
					</form>
				</div>
				<div class="alert alert-success" role="alert" id="infoImport_salsa" style="visibility:hidden"></div>
				<div class="custom-file">
					<form id="bachataFileUpload">
						<input type="file" class="custom-file-input" id="bachataFile" name="playlist" onChange="uploadFileAjax('bachata');">
						<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $MAX_FILE_SIZE ?>"/>
						<input type="hidden" name="encoding" id="encoding_bachata"value="utf8"/>
						<label class="custom-file-label" for="customFile" id="bachataFileName"><?php echo TXT_CHOOSE_BACHATA_FILE ?></label>
					</form>
				</div>
				<div class="alert alert-success" role="alert" id="infoImport_bachata" style="visibility:hidden"></div>
				<div class="custom-file">
					<form id="kizombaFileUpload">
						<input type="file" class="custom-file-input" id="kizombaFile" name="playlist" onChange="uploadFileAjax('kizomba');">
						<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $MAX_FILE_SIZE ?>"/>
						<input type="hidden" name="encoding" id="encoding_kizomba"value="utf8"/>
						<label class="custom-file-label" for="customFile" id="kizombaFileName"><?php echo TXT_CHOOSE_KIZOMBA_FILE ?></label>
					</form>
				</div>
				<div class="alert alert-success" role="alert" id="infoImport_kizomba" style="visibility:hidden"></div>
				<hr class="mb-4">
				<h4 class="mb-3"><?php echo TXT_GENERATION ?>
					<button type="button" class="btn btn-info btn-circle" onClick="afficheAide('helpGeneration');">
						<img src="./img/info.png" style="width:18px;height:auto;">
					</button>
				</h4>
				<div class="alert alert-info" role="info" id="helpGeneration" style="visibility:hidden;margin-top:-30px"></div>
				<div class="row justify-content-center">
					<div class="col-3 col-md-1">
						<select class="custom-select mr-sm-2" id="L1">
							<option value="S" selected>S</option>
							<option value="B">B</option>
							<option value="K">K</option>
						</select>
					</div>
					<div class="col-3 col-md-1">
						<select class="custom-select mr-sm-2" id="L2">
							<option value="S">S</option>
							<option value="B" selected>B</option>
							<option value="K">K</option>
						</select>
					</div>
					<div class="col-3 col-md-1">
						<select class="custom-select mr-sm-2" id="L3" onChange=checkTypes()>
							<option value=""></option>
							<option value="S">S</option>
							<option value="B">B</option>
							<option value="K" selected>K</option>
						</select>
					</div>
					<div class="col-3 col-md-1">
						<select class="custom-select mr-sm-2" id="L4" onChange=checkTypes()>
							<option value=""></option>
							<option value="S">S</option>
							<option value="B">B</option>
							<option value="K">K</option>
						</select>
					</div>
				</div>
				<div class="row justify-content-md-center">	
					<div class="col-3 col-md-1">
						<select class="custom-select mr-sm-2" id="N1">
							<option value=1>1</option>
							<option value=2 selected>2</option>
							<option value=3>3</option>
							<option value=4>4</option>
							<option value=5>5</option>
							<option value=6>6</option>
							<option value=7>7</option>
							<option value=8>8</option>
							<option value=9>9</option>
						</select>
					</div>
					<div class="col-3 col-md-1">
						<select class="custom-select mr-sm-2" id="N2">
							<option value=1>1</option>
							<option value=2>2</option>
							<option value=3 selected>3</option>
							<option value=4>4</option>
							<option value=5>5</option>
							<option value=6>6</option>
							<option value=7>7</option>
							<option value=8>8</option>
							<option value=9>9</option>
						</select>
					</div>
					<div class="col-3 col-md-1">
						<select class="custom-select mr-sm-2" id="N3">
							<option value=""></option>
							<option value=1>1</option>
							<option value=2>2</option>
							<option value=3 selected>3</option>
							<option value=4>4</option>
							<option value=5>5</option>
							<option value=6>6</option>
							<option value=7>7</option>
							<option value=8>8</option>
							<option value=9>9</option>
						</select>
					</div>
					<div class="col-3 col-md-1">
						<select class="custom-select mr-sm-2" id="N4">
							<option value="" selected></option>
							<option value=1>1</option>
							<option value=2>2</option>
							<option value=3>3</option>
							<option value=4>4</option>
							<option value=5>5</option>
							<option value=6>6</option>
							<option value=7>7</option>
							<option value=8>8</option>
							<option value=9>9</option>
						</select>
					</div>
				</div>
				<br>
				<div class="form-check form-check-inline">
					<h5 class="mb-3"><?php echo TXT_SPECIFY_PATH ?></h5>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="radio" name="pathOptionRadios" id="pathOptionRadios_yes" value="yes" onClick="controlOptionPath()">
					<label class="form-check-label" for="inlineRadioPath_yes"><?php echo TXT_YES ?></label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="radio" name="pathOptionRadios" id="pathOptionRadios_no" value="no" onClick="controlOptionPath()" checked>
					<label class="form-check-label" for="inlineRadioPath_no"><?php echo TXT_NO ?></label>
				</div>
				<button type="button" class="btn btn-info btn-circle"onClick="afficheAide('helpGenerationPath');">
					<img src="./img/info.png"/ style="width:18px;height:auto;">
				</button>
				<div class="alert alert-info" role="info" id="helpGenerationPath" style="visibility:hidden;margin-top:-30px"></div>
				<br>
				<div id="formPath">
					<div class="row justify-content-md-center">	
						<div class="input-group">
							<label class="col-12 col-sm-12 col-lg-2 col-form-label"><?php echo TXT_SALSA_PATH ?> :</label>
							<div class="col-12 col-sm-12 col-lg-10">
								<input id="salsaPath" type="text" class="form-control" value = "./Salsa/">
							</div>
						</div>
						<br><br>
						<div class="input-group">
							<label class="col-12 col-sm-12 col-lg-2 col-form-label"><?php echo TXT_BACHATA_PATH ?> :</label>
							<div class="col-12 col-sm-12 col-lg-10">
								<input id="bachataPath" type="text" class="form-control" value = "./Bachata/">
							</div>
						</div>
						<br><br>
						<div class="input-group">
							<label class="col-12 col-sm-12 col-lg-2 col-form-label"><?php echo TXT_KIZOMBA_PATH ?> :</label>
							<div class="col-12 col-sm-12 col-lg-10">
								<input id="kizombaPath" type="text" class="form-control" value = "./Kizomba/">
							</div>
						</div>
					</div>
					<br>
					<div class="form-check">
						<input class="form-check-input" type="radio" name="pathTypeRadios" id="pathTypeRadioFree" value="Web">
						<label class="form-check-label" for="pathTypeRadioWeb">
						<?php echo TXT_FREE_INPUT ?>
						</label>
					</div>
					<div class="form-check">
						<input class="form-check-input" type="radio" name="pathTypeRadios" id="pathTypeRadioUnix" value="Unix" onClick="controlMusiquesPath()" checked>
						<label class="form-check-label" for="pathTypeRadioUnix">
						<?php echo TXT_UNIX_FORMAT ?> (Android, Apple)
						</label>
					</div>
					<div class="form-check">
						<input class="form-check-input" type="radio" name="pathTypeRadios" id="pathTypeRadioMS" value="MS" onClick="controlMusiquesPath()">
						<label class="form-check-label" for="pathTypeRadioMS">
						<?php echo TXT_MS_FORMAT ?>
						</label>
					</div>
				</div>
				<br>
				<script>
				/*
				<div class="form-check form-check-inline">
					<h5 class="mb-3"><?php echo TXT_ENCODING ?></h5>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="radio" name="encoding" id="encoding_utf8" value="UTF-8" onClick="changeEncoding()" checked>
					<label class="form-check-label" for="inlineRadioEncoding_yes">UTF-8</label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="radio" name="encoding" id="encoding_iso" value="ISO" onClick="changeEncoding()">
					<label class="form-check-label" for="inlineRadioEncoding_no">ISO</label>
				</div>
				<button type="button" class="btn btn-info btn-circle"onClick="afficheAide('helpEncoding');">
					<img src="./img/info.png"/ style="width:18px;height:auto;">
				</button>
				<br>
				*/
				</script>
				<div class="alert alert-info" role="info" id="helpEncoding" style="visibility:hidden;margin-top:-30px"></div>
				<div class="row justify-content-center">
					<div class="col-md-4 my-1">
						<div class="input-group">
							<div class="input-group-prepend">
								<div class="input-group-text"><?php echo TXT_PLAYLIST_MAX_SIZE ?></div>
							</div>
							<select class="custom-select" id="maxCycle">
								<option value=1>1 <?php echo TXT_CYCLE ?></option>
								<option value=2>2 <?php echo TXT_CYCLE ?>s</option>
								<option value=3>3 <?php echo TXT_CYCLE ?>s</option>
								<option value=4>4 <?php echo TXT_CYCLE ?>s</option>
								<option value=5>5 <?php echo TXT_CYCLE ?>s</option>
								<option value=6>6 <?php echo TXT_CYCLE ?>s</option>
								<option value=7>7 <?php echo TXT_CYCLE ?>s</option>
								<option value=8>8 <?php echo TXT_CYCLE ?>s</option>
								<option value=9>9 <?php echo TXT_CYCLE ?>s</option>
								<option value=10>10 <?php echo TXT_CYCLE ?>s</option>
								<option value=20>20 <?php echo TXT_CYCLE ?>s</option>
								<option value=30>30 <?php echo TXT_CYCLE ?>s</option>
								<option value=40>40 <?php echo TXT_CYCLE ?>s</option>
								<option value=50>50 <?php echo TXT_CYCLE ?>s</option>
								<option value=60>60 <?php echo TXT_CYCLE ?>s</option>
								<option value=70>70 <?php echo TXT_CYCLE ?>s</option>
								<option value=80>80 <?php echo TXT_CYCLE ?>s</option>
								<option value=90>90 <?php echo TXT_CYCLE ?>s</option>
								<option value=100>100 <?php echo TXT_CYCLE ?>s</option>
								<option value=0 selected><?php echo TXT_UNLIMITED ?></option>
							</select>
						</div>
					</div>
				</div>
				<br>
				<div class="custom-file text-center">
					<button type="submit" class="btn btn-primary" onClick="genererPlaylist()"><?php echo TXT_GENERATE_PLAYLIST ?></button>
				</div>
				<div class="alert alert-success" role="alert" id="infoGenererPlaylist" style="visibility:hidden;margin-top:10px;"></div>
				<hr class="mb-4">
				<h4 class="mb-6"><?php echo TXT_EXPORT ?>
					<button type="button" class="btn btn-info btn-circle"onClick="afficheAide('helpExport');">
						<img src="./img/info.png"/ style="width:18px;height:auto;">
					</button>
				</h4>
				<div class="alert alert-info" role="info" id="helpExport" style="visibility:hidden;margin-top:-30px"></div>
				<div class="row justify-content-center">
					<div class="col-md-5 my-1">
						<div class="input-group">
							<div class="input-group-prepend">
								<div class="input-group-text"><?php echo TXT_PREFIX ?></div>
							</div>
							<input id="exportPrefixe" type="text" class="form-control" maxlength="35" value = "Playlist" onkeyup="afficheExportModel();">
						</div>
					</div>
					<div class="col-md-2 my-1">
						<div class="input-group">
							<div class="input-group-prepend">
								<div class="input-group-text"><?php echo TXT_EXTENSION ?></div>
							</div>
							<input id="exportExtension" type="text" class="form-control" maxlength="4" value = "m3u" onkeyup="afficheExportModel();">
						</div>
					</div>
				</div>
				<br>
				<h5 class="row justify-content-center" id="exportModel"></h5>
				<br>
				<div class="row justify-content-center">
					<div class="col-md-3 my-1">
						<div class="input-group">
							<div class="input-group-prepend">
								<div class="input-group-text"><?php echo TXT_HOW_MANY_PLAYLIST ?></div>
							</div>
							<select class="custom-select" id="iterations">
								<option value=1 selected>1</option>
								<option value=2>2</option>
								<option value=3>3</option>
								<option value=4>4</option>
								<option value=5>5</option>
								<option value=6>6</option>
								<option value=7>7</option>
								<option value=8>8</option>
								<option value=9>9</option>
								<option value=10>10</option>
								<option value=20>20</option>
								<option value=30>30</option>
								<option value=40>40</option>
								<option value=50>50</option>
								<option value=60>60</option>
								<option value=70>70</option>
								<option value=80>80</option>
								<option value=90>90</option>
								<option value=100>100</option>
							</select>
						</div>
					</div>
				</div>
				<br>
				<div class="custom-file text-center">
					<button type="submit" class="btn btn-primary" id="submitGetPlaylist" onClick=""><?php echo TXT_DOWNLOAD_FILE ?></button>
				</div>
				<div class="alert alert-success" role="alert" id="infoDownloadPlaylist" style="visibility:hidden;margin-top:10px;"></div>
				<hr class="mb-4">
				<h5>
					<div class="custom-file text-center">
						© 2019 <a href="mailto:blaisefacy@gmail.com">Blaise Facy</a>
					</div>
				</h5>
			</div>
		</div>
		<script>
		function dump(obj)
		{
			var out = '';
			for (var i in obj) {
				out += i + ": " + obj[i] + "\n";
			}
		 
			// Affiche les donnees dans une alert
			alert(out);
		 
			// Affiche les donnees dans un <pre>
			var pre = document.createElement('pre');
			pre.innerHTML = out;
			document.body.appendChild(pre)
		}

		function uploadFileAjax(musique)
		{
			document.getElementById("infoImport_" + musique).innerHTML = "";
			document.getElementById("infoImport_" + musique).style.visibility = "visible";
			$("#infoImport_" + musique).attr("class", "spinner-border m-2");
			var myForm = document.getElementById(musique + "FileUpload");
			
			var inputFile = $("#" + musique + "File");
			var fileSize = inputFile[0].files[0].size;
			var nameFile = inputFile[0].files[0].name;

			var erreur = false;
			var libelleErreur = "";
			
			if (fileSize == 0)
			{
				return false;
			}
			if (nameFile.lastIndexOf(".") == -1)
			{
				erreur = true;
				libelleErreur = "<?php echo TXT_NO_EXTENSION ?> !"
			}
			else
			{
				var extension = nameFile.substring(nameFile.lastIndexOf(".") + 1, nameFile.length);
				var checkExtension = <?php echo $AUTHORIZED_EXTENSIONS ?>.includes(extension);
				if (!checkExtension)
				{
					erreur = true;
					libelleErreur = "<?php echo TXT_FILE_TYPE ?> " + extension + " <?php echo TXT_NOT_ALLOWED ?> !";
				}
			}
			if (fileSize > <?php echo $MAX_FILE_SIZE ?>)
			{
				erreur = true;
				libelleErreur = "<?php echo TXT_MUST_NOT_EXCEED ?> 1<?php echo TXT_MEGA_BYTE ?> !";
			}
			if (erreur)
			{
				$("#infoImport_" + musique).attr("class", "alert alert-danger");
				document.getElementById("infoImport_" + musique).innerHTML = libelleErreur;
				return false;
			}
			
			$.ajax({

			url : 'readPlaylist.php',

			type : 'POST', // Le type de la requête HTTP

			data : new FormData(myForm),
			
			processData: false,
			
			contentType: false,
			
			success : function(code_html, statut) {
			
				//alert(code_html);
				var erreur = false;
				var libelleErreur = "";
				if (code_html == null || code_html === "")
				{
					erreur = true;
					libelleErreur = "Echec de l'upload !";
				}	
				if (!erreur & (code_html.substring(0,1) != "[")  &  (code_html.substring(0,1) != "{"))
				{
					erreur = true;
					if (code_html.includes("POST Content-Length") || code_html.includes("file size is limited"))
					{
						libelleErreur = "<?php echo TXT_MUST_NOT_EXCEED ?> 1<?php echo TXT_MEGA_BYTE ?> !";
					}
					else
					{
						libelleErreur = "Echec de l'upload !";
					}
				}
				if (!erreur)
				{
					//Content-Length
					var json_data = JSON.parse(code_html.replace(/(?:\\[rn])+/g, ""));
					var libelleErreur = "";
					if (json_data["erreur"]["code"] == null)
					{
						erreur = true;
						libelleErreur = "<?php echo TXT_MUST_NOT_EXCEED ?> 1<?php echo TXT_MEGA_BYTE ?> !";
					}
					if (json_data["erreur"]["code"] == 1)
					{
						erreur = true;
						libelleErreur = json_data["erreur"]["libelle"];
					}
					var listeResultat = [];
					if (!erreur)
					{
						listeTitres[musique] = json_data["listeTitres"];
					}
				}
				if (erreur)
				{
					$("#infoImport_" + musique).attr("class", "alert alert-danger");
					document.getElementById("infoImport_" + musique).innerHTML = libelleErreur;
				}
				else
				{
					//$("#infoImport_" + musique).attr("class", "green");
					$("#infoImport_" + musique).attr("class", "alert alert-success");
					document.getElementById("infoImport_" + musique).innerHTML = listeTitres[musique].length + " <?php echo TXT_TITLES ?> <?php echo TXT_OF ?> " + musique + " <?php echo TXT_IMPORTED ?> :-)";
					document.getElementById(musique + "FileName").innerHTML = json_data["nomFichier"]
				}
				document.getElementById("infoImport_" + musique).style.visibility = "visible";
			},
			
			error : function(resultat, statut, erreur) {
				//alert("error");
			},

			complete : function(resultat, statut) {
			}
			});
		}

		// Ne fonctionne pas avec le smartphone...
		function getPlaylistAjax()
		{
			$.ajax({

			url : 'getPlaylist.php',

			type : 'POST', // Le type de la requête HTTP

			data : 'playlist=' + encodeURIComponent(JSON.stringify(playlistSBK)),
			
			dataType : 'html',
			
			success : function(code_html, statut) {
				//alert(code_html);
				//window.location = 'getPlaylist.php';
					var a;
						// Trick for making downloadable link
						a = document.createElement('a');
						a.href = window.URL.createObjectURL('yourfile.txt');
						// Give filename you wish to download
						a.download = "test-file.m3u";
						a.style.display = 'none';
						document.body.appendChild(a);
						a.click();
			},
			
			error : function(resultat, statut, erreur) {
				//alert("error");
			},

			complete : function(resultat, statut) {
			}
			});
		}

		function lenTwo(fn){
			return function(){return ('0'+fn.call(this)).substr(-2,2)}
		}
		with(Date.prototype)
		{
			getDay = lenTwo(getDay);
			getMonth = lenTwo(getMonth);
			getHours = lenTwo(getHours);
			getMinutes = lenTwo(getMinutes);
		}
		
		$("#submitGetPlaylist").on("click", function()
		{
			var erreurModel = false;
			var erreurModel_libelle = "";
			if ($("#exportPrefixe").val() == "")
			{
				erreurModel = true;
				erreurModel_libelle = "Vous devez indiquer un préfixe !";
			}
			if ($("#exportExtension").val().length < 3)
			{
				erreurModel = true;
				if (erreurModel_libelle != "")
				{
					erreurModel_libelle += "<br>";
				}
				erreurModel_libelle += "L'extension doit faire au moins 3 caractères !";
			}
			if (erreurModel)
			{
				$("#infoDownloadPlaylist").attr("class", "alert alert-danger");
				document.getElementById("infoDownloadPlaylist").innerHTML = erreurModel_libelle;
				document.getElementById("infoDownloadPlaylist").style.visibility = "visible";
			}
			else
			{
				document.getElementById("infoDownloadPlaylist").innerHTML = "";
				document.getElementById("infoDownloadPlaylist").style.visibility = "visible";
				$("#infoDownloadPlaylist").attr("class", "spinner-border m-2");
				myBatch(1);
			}
		});
		
		function myBatch(iter)
		{
			genererPlaylist();
			var fileName = $("#exportPrefixe").val() + "_" + type_SBK + "_" + iter + "." + $("#exportExtension").val();
			// Data to post
			data = {
			};

			// Use XMLHttpRequest instead of Jquery $ajax
			xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function()
			{
				var a;
				if (xhttp.readyState === 4 && xhttp.status === 200) {
					if (iter <= $("#iterations").val() && !erreurGeneration)
					{
						// Trick for making downloadable link
						a = document.createElement('a');
						a.href = window.URL.createObjectURL(xhttp.response);
						// Give filename you wish to download
						a.download = fileName;
						a.style.display = 'none';
						document.body.appendChild(a);
						a.click();
						document.body.removeChild(a);
					}
					else
					{
						if (erreurGeneration)
						{
							$("#infoDownloadPlaylist").attr("class", "alert alert-danger");
							document.getElementById("infoDownloadPlaylist").innerHTML = "<?php echo TXT_CANT_GENERATE ?>";
						}
						else
						{
							$("#infoDownloadPlaylist").attr("class", "alert alert-success");
							var texteFichier = "<?php echo TXT_FILE_DOWNLOADED ?>";
							if (iter > 2)
							{
								texteFichier = "<?php echo TXT_FILES_DOWNLOADED ?>"
							}
							document.getElementById("infoDownloadPlaylist").innerHTML = (iter - 1) + " " + texteFichier + " :-)";
						}
						return;
					}
					iter++; 
					myBatch(iter);
				}
			};
			// Post data to URL which handles post request
			xhttp.open("POST", "getPlaylist.php");
			xhttp.setRequestHeader("Content-Type", "application/json");
			// You should set responseType as blob for binary responses
			xhttp.responseType = 'blob';
			xhttp.send(JSON.stringify(playlistSBK));
		}
		
		afficheExportModel();
		$("#formPath").hide();
		/*
		$("#submitGetPlaylist").on("click", function()
		{
			var d = new Date();
			var now = d.getFullYear() + d.getMonth() + d.getDay();
			var fileName = "Playlist_" + now + "_" + type_SBK + ".m3u";
			// Data to post
			data = {
			};

			// Use XMLHttpRequest instead of Jquery $ajax
			xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function()
			{
				var a;
				if (xhttp.readyState === 4 && xhttp.status === 200) {
					// Trick for making downloadable link
					a = document.createElement('a');
					a.href = window.URL.createObjectURL(xhttp.response);
					// Give filename you wish to download
					a.download = fileName;
					a.style.display = 'none';
					document.body.appendChild(a);
					a.click();
					document.body.removeChild(a);
				}
			};
			// Post data to URL which handles post request
			xhttp.open("POST", "getPlaylist.php");
			xhttp.setRequestHeader("Content-Type", "application/json");
			// You should set responseType as blob for binary responses
			xhttp.responseType = 'blob';
			xhttp.send(JSON.stringify(playlistSBK));
		});
		*/
		</script>
	</body>
</html>
