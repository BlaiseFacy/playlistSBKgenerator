<?php

define("TXT_DONATE", "Faire un don");
define("TXT_IMPORT", "Importation");
define("TXT_GENERATION", "Génération");
define("TXT_EXPORT", "Exportation");
define("TXT_CHOOSE_SALSA_FILE", "Choisir une playlist salsa");
define("TXT_CHOOSE_BACHATA_FILE", "Choisir une playlist bachata");
define("TXT_CHOOSE_KIZOMBA_FILE", "Choisir une playlist kizomba");
define("TXT_SPECIFY_PATH", "Spécifier un chemin de lecture pour les titres de la playlist ?");
define("TXT_SALSA_PATH", "Chemin salsa");
define("TXT_BACHATA_PATH", "Chemin bachata");
define("TXT_KIZOMBA_PATH", "Chemin kizomba");
define("TXT_FREE_INPUT", "Saisie libre");
define("TXT_UNIX_FORMAT", "Format Unix");
define("TXT_MS_FORMAT", "Format Microsoft");
define("TXT_YES", "Oui");
define("TXT_NO", "Non");
define("TXT_ENCODING", "Encodage");
define("TXT_GENERATE_PLAYLIST", "Générer la playlist SBK");
define("TXT_PREFIX", "Préfixe");
define("TXT_EXTENSION", "Extension");
define("TXT_HOW_MANY_PLAYLIST", "Combien de playlists");
define("TXT_PLAYLIST_MAX_SIZE", "Taille max de la playlist");
define("TXT_UNLIMITED", "illimité");
define("TXT_CYCLE", "cycle");
define("TXT_DOWNLOAD_FILE", "Télécharger la playlist SBK");
define("TXT_THE_PLAYLIST", "La playlist");
define("TXT_OF", "de");
define("TXT_TITLES", "titres");
define("TXT_TITLES_GENERATED", "titres a été générée");
define("TXT_IMPORTED", "importés");
define("TXT_IS_EMPTY", "est vide");
define("TXT_CANT_GENERATE", "La playlist n'a pas pu être générée");
define("TXT_THE_LETTRE", "La lettre");
define("TXT_DONT_HAVE_ASSOC_NB", "n'a pas de chiffre associé");
define("TXT_NO_CONS_LETTRES", "Il ne doit pas y avoir 2 lettres consécutives");
define("TXT_FILE_TYPE", "Fichier de type");
define("TXT_NOT_ALLOWED", "non autorisé");
define("TXT_MUST_NOT_EXCEED", "Le fichier ne doit pas dépasser");
define("TXT_MEGA_BYTE", "Mo");
define("TXT_NO_EXTENSION", "Le fichier n'a pas d'extension");
define("TXT_FILE_DOWNLOADED", "fichier a été téléchargé");
define("TXT_FILES_DOWNLOADED", "fichiers ont étés téléchargés");
define("TXT_HELP_IMPORT", "Les playlists peuvent comporter les titres des musiques seulement ou bien les chemins + les titres.<br>Il ne doit pas y avoir d'entête ni de caractères spéciaux pour marquer le début ou la fin de la playlist.<br>Le format m3u convient parfaitement.<br>Vous pouvez utiliser <a href='http://www.tunemymusic.com/?keeporder=true' target='_blank'>tunemymusic</a> pour importer facilement des playlists depuis les principaux portails de musique.");
define("TXT_HELP_GENERATION", "Vous pouvez composer le type de playlist SBK en modifiant les lettres et les chiffres du formulaire. Vous pouvez créer des playlists avec 1, 2 ou 3 alternances.<br>Chaque set d'un type de musique est limité à 9 titres.<br>Vous ne pouvez pas combiner deux types de musique identiques à la suite.<br>Un cycle correspond à un enchaînement de musique complet sur lequel va boucler la playlist SBK. Par exemple, pour du SBK233, le cycle est de 2 + 3 + 3 = 8.");
define("TXT_HELP_GENERATION_PATH", "Si vous voulez écouter la playlist sur un autre appareil, vous aurez certainement besoin de spécifier un chemin de lecture différent de celui des playlists importées, dans ce cas cliquez sur 'oui'. Si vous voulez conserver le chemin des playlists importées ou bien si vous avez uniquement besoin des titres pour une utilisation sur un service de musique en ligne, cliquez sur 'non'.<br>Les chemins correspondent à l'endroit où seront stockés les fichiers de musique lorsque la playlist sera lue. Selon l'appareil ou la plateforme utilisés, la location des fichiers et le format seront différents. Vous pouvez spécifier un chemin différent pour chaque type de musique.<br>Pour vous aider, choisissez le format correspondant à l'appareil sur lequel vous lirez votre playlist.<br>'Format Unix' pour les smartphones Android, Apple, Unix, Linux.<br>'Format Microsoft' pour une utilisation sur un environnement Windows.<br>Le mode 'Saisie libre' désactive l'aide de formatage lors de la saisie des chemins.");
define("TXT_HELP_EXPORT", "Vous pouver exporter plusieurs playlists du même type à la fois. Chaque playlist sera unique car les musiques sont mélangées aléatoirement à chaque itération. Les playlists peuvent être écoutées sur cet appareil ou un autre, suivant les chemins de lecture que vous avez paramétré dans les options de génération.<br>Vous pouvez utiliser <a href='http://www.tunemymusic.com/?keeporder=true' target='_blank'>tunemymusic</a> pour exporter facilement des playlists vers les principaux portails de musique.");
define("TXT_HELP_ENCODING", "Sélectionnez le type d'encodage correspondant à vos fichiers. Si vous constatez des caractères illisibles dans la playlist générée, changez l'option d'encodage ou bien modifiez l'encodage des fichiers que vous importez. Il est conseillé d'utiliser le format UTF-8 qui est plus complet et polyvalent.");

?>