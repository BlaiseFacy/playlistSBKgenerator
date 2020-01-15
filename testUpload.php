<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php

?>

<html>
  <body>
    <form enctype="multipart/form-data" action="readPlaylist.php" method="post">
      <input type="hidden" name="MAX_FILE_SIZE" value="1048576"/>
      Transfère le fichier
	  <input type="file" name="playlist"/>
      <input type="submit"/>
	  <br><br>
	  Encoding :<input type="text" size="4" name="encoding" value="utf8"/>
    </form>
  </body>
</html>