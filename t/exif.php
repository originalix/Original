<?php

if (exif_imagetype("image.gif") != IMAGETYPE_GIF) {
    echo "The picture is not a gif";
} else {
    echo "The picture is a gif </br>";
}

list($width, $height, $type, $attr) = getimagesize("image.gif");
echo "<img src=\"image.gif\" $attr>";
echo "list($width, $height, $type, $attr)";


  function is_jpeg(&$pict)
  {
    return (bin2hex($pict[0]) == 'ff' && bin2hex($pict[1]) == 'd8');
  }

  function is_png(&$pict)
  {
    return (bin2hex($pict[0]) == '89' && $pict[1] == 'P' && $pict[2] == 'N' && $pict[3] == 'G');
  }