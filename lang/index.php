<?php
session_start();
include("./config.php");
require("./util.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>

<head>

<title>Accueil</title>
<link rel="icon" size="16x16" href="./pics/favicon16.png" type="image/png">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1 user-scalable=no"><!-- Mise à l'échelle du smartphone pour avoir un ratio confortable -->
<meta name="keywords" content="tortues, tortue, chélonien, chéloniens, collection, collections, collectionneur, collectionneurs">
<meta name="keywords" content="reptile, reptiles, turtle, tortoise, recherche, statistiques">
<meta name="description" content="Consultation en ligne d'une collection de tortues de plus de 36000 pièces, de tous matériaux et de toutes formes">
<!-- Attention, l'ordre des imports de librairies javascript est important -->
<script type="text/javascript" src="./js/jquery-1.11.3.min.js"></script><!-- jquery -->
<script type="text/javascript" src="./js/bootstrap.min.js"></script><!-- bootstrap -->
<script type="text/javascript" src="./js/bootbox.min.js"></script><!-- bootstrap dialog boxes -->
<script type="text/javascript" src="./js/modernizr.js"></script><!-- Modernizr -->
<script type="text/javascript" src="./js/jquery.menu-aim.js"></script><!-- pour le menu -->	  
<script type="text/javascript" src="./js/jquery.ui.totop.js"></script><!-- UItoTop plugin -->
<script type="text/javascript" src="./js/jquery.easing.js"></script><!-- UItoTop plugin -->
<link rel="stylesheet" href="./css/bootstrap.min.css"><!-- bootstrap -->
<link rel="stylesheet" href="./css/simple-sidebar.css"><!-- simple-sidebar -->
<link rel="stylesheet" href="./css/ui.totop.css" media="screen,projection"><!-- UItoTop plugin -->
<link rel="stylesheet" href="./css/tortues-backgrounds.css"/><!-- backgrounds tortues -->
<link rel="stylesheet" href="./lang/languages.min.css"/><!-- backgrounds tortues -->

<?php
require("./dbConnection.php"); // Page contenant les methodes de connection et les paramétrages sql

// On set l'acces aux prix en session
if (isset($_GET["codeprix"]))
{
	$codePrix = $_GET["codeprix"];

	// Connexion à la base de données
	dbConnect();

	// Récupération du MDP pour les prix
	$tableMdp = getTableMdp();

	$queryTableMdp = "SELECT mot_de_passe FROM $tableMdp WHERE intitule = 'codeprix'";
	$result = mysql_query($queryTableMdp) or die ('Erreur SQL !'.$sql.'<br />'.mysql_error());
	$codePrixSql = mysql_fetch_row($result);
	$codePrixSql = $codePrixSql[0];
	mysql_free_result($result);

	if ($codePrix == $codePrixSql) $_SESSION["accesPrix"] = "oui";
	else $_SESSION["accesPrix"] = "non";
}
else if (!isset($_SESSION["accesPrix"])) $_SESSION["accesPrix"] = "non";

//logDebug("Acces prix:".$_SESSION["accesPrix"]);

// On set le tableau des signets en session s'il n'existe pas
if (!isset($_SESSION["tableauSignets"])) $_SESSION["tableauSignets"] = array();

//logDebug("Signets:".count($_SESSION["tableauSignets"]));

if (!isset($_SESSION["backgroundSession"])) $_SESSION["backgroundSession"] = 'EscherIrise';

/*
CREATE TABLE  `rfy2`.`table_tortues_maj` (
`id_maj` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`date_maj` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
`nb_tortues` INT NOT NULL
) ENGINE = MYISAM ;
*/
	
// Connexion à la base de données
dbConnect();

$table = getTable();
$tableMaj = getTableMaj();

$queryTableMaj = "SELECT date_maj, nb_tortues FROM $tableMaj order by date_maj ASC";
$queryCountTableMaj = "SELECT count(date_maj) FROM $tableMaj WHERE 1";
$queryNbTortues = "SELECT count(numero) FROM $table WHERE 1";

$result = mysql_query($queryNbTortues) or die ('Erreur SQL !'.$queryNbTortues.'<br />'.mysql_error());
$nbTortues = mysql_fetch_row($result);
$nbTortues = intval($nbTortues[0]);
mysql_free_result($result);

$result = mysql_query($queryCountTableMaj) or die ('Erreur SQL !'.$queryCountTableMaj.'<br />'.mysql_error());
$nbDatesMaj = mysql_fetch_row($result);
$nbDatesMaj = $nbDatesMaj[0];
mysql_free_result($result);

$result = mysql_query($queryTableMaj) or die ('Erreur SQL !'.$queryTableMaj.'<br />'.mysql_error());

for($i=0; $i<$nbDatesMaj; $i++) // On boucle
{
	$row = mysql_fetch_row($result);
	// On récupère les infos de chaque élément en base
	$dateMaj[$i] = $row[0];
	$nbTortuesMaj[$i] = $row[1];
	//logDebug(f_dateFR($dateMaj[$i]).":".$nbTortuesMaj[$i]." tortues");
}

// Si le nombre de tortues de la dernière mise à jour est inférieur à celui de la table tortues
// c'est qu'une mise à jour a été effectuée depuis, il faut updater la table des mises à jour

if ($nbTortuesMaj[$nbDatesMaj - 1] < $nbTortues)
{
	$dateCourante = date('Ymd H:i:s');
	//logDebug($dateCourante."<br>";
	$queryUpdateMaj = "INSERT INTO table_tortues_maj VALUES (NULL, CURRENT_TIMESTAMP, ".$nbTortues.")";
	//logDebug($queryUpdateMaj);
	mysql_query($queryUpdateMaj) or die ('Erreur SQL !'.$queryUpdateMaj.'<br />'.mysql_error());
	$dateDerniereMaj = f_dateFR($dateCourante)." à ".f_timeFR($dateCourante);
}
else
{
	$dateDerniereMaj = f_dateFR($dateMaj[$nbDatesMaj - 1])." à ".f_timeFR($dateMaj[$nbDatesMaj - 1]);
}

mysql_free_result($result);
dbDisconnect();	// Déconnexion de la base de données

?>

<script type="text/javascript">
<!--

var dataTortue;

function checkLoadingPhoto()
{
	var nextSlide = $('#nextSlide').val();
	var cheminPhoto = './photos/' + dataTortue[0]['cheminPhoto'];
	var imageConteneur = new Image();
	imageConteneur.src = cheminPhoto;
	if (imageConteneur.complete)
	{
		$('#' + nextSlide + 'Slide').attr('src', cheminPhoto);
		miseEnPage();
		if ($("#firstSlide").attr("class") == "opaque")
		{
			$("#firstSlide").removeClass("opaque");
			$("#firstTitle").removeClass("opaque");
			$("#secondSlide").addClass("opaque");
			$("#secondTitle").addClass("opaque");
		}
		else
		{
			$("#firstSlide").addClass("opaque");
			$("#firstTitle").addClass("opaque");
			$("#secondSlide").removeClass("opaque");
			$("#secondTitle").removeClass("opaque");
		}
	}
	else
	{
		setTimeout('checkLoadingPhoto()', 500);
	}	
}

function miseEnPage()
{
	var largeurMaxPhoto = 700;
	var hauteurMaxPhoto = 500;
	var largeurPage = document.getElementById('wrapper').offsetWidth;
	var hauteurPage = document.getElementById('wrapper').offsetHeight;
	if (largeurPage < largeurMaxPhoto)
	{
		largeurMaxPhoto = largeurPage - 2 * parseInt($('#wrapper').css('padding-left'), 10);
		hauteurMaxPhoto = Math.round(largeurMaxPhoto * 5 / 7) - 2 * parseInt($('#wrapper').css('padding-left'), 10);
	}
	//if (hauteurPage < hauteurMaxPhoto) hauteurMaxPhoto = hauteurPage;
	var largeurCadrePhoto = largeurMaxPhoto;
	var hauteurCadrePhoto = hauteurMaxPhoto;
	var nextSlide = $('#nextSlide').val();
	//$('#' + nextSlide + 'Title').css('top', $('#' + nextSlide + 'Slide').css('bottom'));
	document.getElementById('cadrePhoto').style.width = largeurCadrePhoto;
	document.getElementById('cadrePhoto').style.height = hauteurCadrePhoto;
	var	photoPageWeb = document.getElementById(nextSlide + 'Slide'); // L'objet photo dans la page web
	var	photoObjet = new Image(); // L'objet photo original
	photoObjet.src = photoPageWeb.src;
	//alert('largeur:' + photoObjet.width + ',hauteur:' + photoObjet.height);
	if (photoObjet.width < largeurMaxPhoto) largeurMaxPhoto = photoObjet.width;
	if (photoObjet.height < hauteurMaxPhoto) hauteurMaxPhoto = photoObjet.height;
	//alert('largeurMax:' + largeurMaxPhoto + ',hauteurMax:' + hauteurMaxPhoto);
	var ratio = photoObjet.width / photoObjet.height;
	if (ratio < 1)
	{
		if (hauteurMaxPhoto * ratio > largeurMaxPhoto)
		{
			photoPageWeb.style.width = largeurMaxPhoto + 'px';
			photoPageWeb.style.height = Math.round(largeurMaxPhoto / ratio) + 'px';
		}
		else
		{
			photoPageWeb.style.height = hauteurMaxPhoto + 'px';
			photoPageWeb.style.width = Math.round(hauteurMaxPhoto * ratio) + 'px';
		}
	}
	else
	{
		if (largeurMaxPhoto / ratio > hauteurMaxPhoto)
		{
			photoPageWeb.style.height = hauteurMaxPhoto + 'px';
			photoPageWeb.style.width = Math.round(hauteurMaxPhoto * ratio) + 'px';
		}
		else
		{
			photoPageWeb.style.width = largeurMaxPhoto + 'px';
			photoPageWeb.style.height = Math.round(largeurMaxPhoto / ratio) + 'px';
		}
	}
	var positionTigeTop = -10;
	var positionTigeLeft = (largeurCadrePhoto - $('#tige').width()) / 2;
	var hauteurTige = (hauteurCadrePhoto - $('#' + nextSlide + 'Slide').height()) / 2 + Math.abs(positionTigeTop) - 1;
	$('#tige').css('bottom', positionTigeTop);
	$('#tige').css('left', positionTigeLeft);
	$("#tige").animate({height: hauteurTige}, 200);
}

function changeBackground()
{
	var bg_select = document.getElementById('background_select').value;
	if (parent.window.innerWidth < parent.window.innerHeight) document.getElementsByTagName('body')[0].className = bg_select + '_portrait';
	else document.getElementsByTagName('body')[0].className = bg_select;
	//setTimeout('hideBackground()', 5000);
}

function checkResolution()
{
	document.getElementById('largeur').innerHTML = window.innerWidth;
	document.getElementById('hauteur').innerHTML = window.innerHeight;
}

// Préchargement d'images pour éviter un retard de chargement d'image
// On verifie si une url est mauvaise on stoppe le script et on alerte
var loadImagesStepLimite = 10;
var loadImageStep = 0;
var loadImageError = "";
function loadImages()
{
	var images = new Array();
	var loading_complete = true;
	images[0]=new Image();
	images[0].src='./pics/fondTortueBlancPur.png';
	images[1]=new Image();
	images[1].src='./pics/bandeargent.jpg';
	images[2]=new Image();
	images[2].src='./pics/fondtabtitre_marron.png';
	images[3]=new Image();
	images[3].src='./pics/tortueLoading.gif';
	images[4]=new Image();
	images[4].src='./pics/tortueLoading700.gif';
	for (i = 0 ; i < images.length ; i++)
	{
		if (!images[i].complete)
		{
			loading_complete = false;
			loadImageError = images[i].src;
		}
	}
	if  (!loading_complete)
	{
		if  (loadImageStep < loadImagesStepLimite )
		{
			loadImageStep++;
			setTimeout('loadImages()',200);
		}
		else alert ('load image error:' + loadImageError);
	}
}
	
var resizeDelay;
// On récupère l'event sur la page parent car la frame perturbe les events sur certains mobiles
parent.onresize = function()
{
	<?php
		if (!isTactile()) echo "
		checkResolution();
		clearTimeout(resizeDelay);
		resizeDelay = setTimeout('changeBackground();', 200);
		";
	?>
}
// On récupère l'event sur la page parent car la frame perturbe les events sur certains mobiles
parent.window.onorientationchange = function()
{
	var background = document.getElementById('background_select').value;
	checkResolution();
	clearTimeout(resizeDelay);
	resizeDelay = setTimeout('changeBackground();', 200);
}
function submitChangeBackgroundAjax()
{

	$.ajax({

	url : 'changeBackgroundAjax.php',

	type : 'POST', // Le type de la requête HTTP

	data : 'background=' + document.getElementById('background_select').value,

	dataType : 'html',
	
	success : function(code_html, statut) {
	
		//alert(code_html);
		changeBackground(code_html);

	},

	error : function(resultat, statut, erreur) {
	},


	complete : function(resultat, statut) {
	}
	
	});

}
-->
</script>

<style type="text/css">
<!--

body {
	/*background-image: linear-gradient(#425363,#82C341);*/
	font-size: 1.5em;
	color: #000;
	text-align: center;
}
#wrapper {
	padding: 15px;
	font-size: 1.5em;
}

#background_select, #background_text, #lang_select {
	color: black;
	border: 1px solid black;
}

#legende_background, #background_input {
	margin: 0 auto;
}

#legende_input {
	background: linear-gradient(to bottom, #555 0%, #000 100%);
	border: 1px solid #CCC;
	border-radius: 20px 20px 0px 0px;
	height: 32px;
}

@media(min-width:350px) {
	#background_input, #legende_background, #legende_input {
		width: 350px;
	}
}

#firstTitle, #secondTitle {
	width: 310px;
	position: absolute;
	color: #FFF;
	font-size: 18px;
	text-align: center;
	background: transparent;
	border: 0px;
	-webkit-transition: opacity 1s ease-in-out;
	-moz-transition: opacity 1s ease-in-out;
	-o-transition: opacity 1s ease-in-out;
	transition: opacity 1s ease-in-out;
	opacity:0;
	-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
	filter: alpha(opacity=0);
}

#cadrePhoto {
	position: relative;
	width: 700px;
	height: 500px;
	margin: 0 auto 10px;
	text-align: center;
}

#cadrePhoto img {
	position: absolute;
	top: 50%;
	left: 50%;
	width: 100px;
	height: 100px;
	-webkit-transform: translate(-50%,-50%);
	transform: translate(-50%,-50%);
	border: 2px solid black;
	border-radius: 20px;
	cursor: pointer;
	-webkit-transition: opacity 1s ease-in-out;
	-moz-transition: opacity 1s ease-in-out;
	-o-transition: opacity 1s ease-in-out;
	transition: opacity 1s ease-in-out;
	opacity:0;
	-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
	filter: alpha(opacity=0);
}

#cadrePhoto img.opaque, #firstTitle.opaque, #secondTitle.opaque {
	opacity:1;
	-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
	filter: alpha(opacity=1);
}

#tige {
	position: absolute;
	width: 50px;
	height: 50px;
	background: linear-gradient(to right, #000000 0%, #969696 50%, #000000 100%);
	margin: 0 auto;
}
#playStop {
	cursor: pointer;
	border-radius: 0px 20px 0px 0px;
	border-width: 0px 0px 0px 1px;
	border-color: #CCC;
	color: #CCC;
	border-style: solid;
	background-color: transparent;
}

-->
</style>

</head>

<body>

<div id="conteneur">

	<?php include("./menu.php"); ?>

	<div id="wrapper">
		Dernière mise à jour : 
		<script>if (window.innerWidth < <?php echo $resolutionBascule ?>) document.write('<br>');</script>
		<?php echo $dateDerniereMaj ?>
		<h2 style="margin-top:0px;"><?php echo $nbTortues ?> tortues</h2>
		<div align="center">
			<div id="cadrePhoto" class="shadow">
				<img id="firstSlide" class="opaque" src="./pics/tortueLoading700.gif">
				<img id="secondSlide" class="opaque" src="./pics/fondTranspBlanc.png">
				<input id="nextSlide" type="hidden" value="second">
				<div id="tige"></div>
			</div>
		</div>
		<div id="legende_background">
			<div class="input-group" id="legende_input">
				<span class="input-group-addon default" id="firstTitle"></span>
				<span class="input-group-addon default" id="secondTitle"></span>
				<span class="input-group-addon" id="playStop" onClick="playStop();">
					<span class="glyphicon glyphicon-pause" aria-hidden="true"></span>
				</span>
			</div>
		</div>
		<br>
		<div class="input-group" id="background_input">
			<span class="input-group-addon" id="background_text">Thème</span>
			<select class="form-control" id="background_select" onChange="submitChangeBackgroundAjax();">
				<option value="EscherIrise">Escher irisé</option>
				<option value="EscherNB">Escher noir et blanc</option>
				<option value="TurtleTexture">Turtle texture</option>
				<option value="TurtleTextureLight">Turtle texture light</option>
				<option value="EcaillesTexture">Ecailles texture</option>
				<option value="TortueNinja">Tortue Ninja</option>
			</select>
			<script>
				bgSelector = document.getElementById('background_select');
				for (var i=0; i<bgSelector.options.length; i++)
				{
					if (bgSelector.options[i].value == '<?php echo $_SESSION["backgroundSession"]; ?>')
					{
						bgSelector.options[i].selected = true;
					}
				}
			</script>
			<div class="input-group-btn" id="lang_select">
				<div class="btn-group dropup">
					<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
						<span class="lang-sm lang-lbl" lang="<?php echo $_SESSION["lang"] ?>"></span> <span class="caret"></span>
					</button>
					<ul class="dropdown-menu" role="menu">
						<?php if ($_SESSION["lang"] != "fr") echo "<li><a href='./index.php?lang=fr'><span class='lang-lg lang-lbl' lang='fr'></span></a></li>" ?>
						<?php if ($_SESSION["lang"] != "en") echo "<li><a href='./index.php?lang=en'><span class='lang-lg lang-lbl' lang='en'></span></a></li>" ?>
						<?php if ($_SESSION["lang"] != "es") echo "<li><a href='./index.php?lang=es'><span class='lang-lg lang-lbl' lang='es'></span></a></li>" ?>
						<?php if ($_SESSION["lang"] != "de") echo "<li><a href='./index.php?lang=de'><span class='lang-lg lang-lbl' lang='de'></span></a></li>" ?>
						<?php if ($_SESSION["lang"] != "it") echo "<li><a href='./index.php?lang=it'><span class='lang-lg lang-lbl' lang='it'></span></a></li>" ?>
					</ul>
				</div>
			</div>
		</div>
		<div id="infosEcran">
			<p>Surface d'écran disponible : 
			<span id="largeur"></span> x <span id="hauteur"></span> pixels.</p>
		</div>
	</div> <!-- wrapper -->
</div>

<script>

document.getElementById("titrePage").innerHTML = "<?php echo TXT_HOME ?>";
document.getElementById("infosEcran").style.display = 'none';

function submitRequeteAjax(first)
{
	nbrPP = 1;
	if (first) miseEnPage();
	var offsetRandom = Math.floor(Math.random() * <?php echo $nbTortues; ?> + 1);
	//var offsetRandom = Math.floor(Math.random() * 500 + 1);
	if (first) offsetRandom = <?php echo $nbTortues; ?>;
	var queryParams = " and numero = " + offsetRandom;
	
	$.ajax({

	url : 'requeteAjax.php',

	type : 'POST', // Le type de la requête HTTP

	data : 'queryParams=' + encodeURIComponent(queryParams) + '&offset=1&nbrPP=' + nbrPP,

	dataType : 'html',
	
	success : function(code_html, statut) {
	
	//alert(code_html);
	
	dataTortue = JSON.parse(code_html)['listeTortues'];
	var numero = dataTortue[0]['numero'];
	var forme = dataTortue[0]['forme'].trim();
	var materiaux1 = dataTortue[0]['materiaux1'].trim();
	var materiaux2 = dataTortue[0]['materiaux2'].trim();
	var titre = forme;
	if (forme == '')
	{
		titre += materiaux1;
		if (materiaux2 != '') titre += ' et ' + materiaux2;
	}
	if (titre.length > 30) titre = titre.substring(0, 30) + '...';
	var nextSlide = $('#nextSlide').val();
	$('#' + nextSlide + 'Title').html(titre);
	checkLoadingPhoto();

	},
	
	error : function(resultat, statut, erreur) {

	},

	complete : function(resultat, statut) {
	}
	
	});

}

function playStop() {
	if (slideActive)
	{
		slideActive = false;
		$('#playStop').find('span').attr('class', 'glyphicon glyphicon-play');
	}
	else
	{
		slideActive = true;
		$('#playStop').find('span').attr('class', 'glyphicon glyphicon-pause');
	}
}
var slideActive = true;
function slideShow()
{
	if (slideActive)
	{
		if ($("#firstSlide").attr("class") == "opaque")
		{
			$('#nextSlide').val("second");
		}
		else
		{
			$('#nextSlide').val("first");
		}
		submitRequeteAjax(false);
	}
}
submitRequeteAjax(true);
setInterval("slideShow();", 5000)
checkResolution();
loadImages();

</script>

</body>

</html>