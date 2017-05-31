<?php

if (exif_imagetype("image.gif") != IMAGETYPE_GIF) {
    echo "The picture is not a gif";
} else {
    echo "The picture is a gif </br>";
}

list($width, $height, $type, $attr) = getimagesize("image.gif");
echo "<img src=\"image.gif\" $attr>";
echo "list($width, $height, $type, $attr)";