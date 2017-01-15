<?php //The name of this file in this example is imgdata.php

  $url=$_GET['url'];
  $type=$_GET['type'];
  $img = file_get_contents($url);
  $fn = substr(strrchr($url, "="), 1);
  $nfn= $type . $fn . ".jpg";
  file_put_contents($nfn,$img);
  echo $nfn;
  
?>