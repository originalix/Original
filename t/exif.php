<?php

if (exif_imagetype("image.gif") != IMAGETYPE_GIF) {
    echo "The picture is not a gif";
} else {
    echo "The picture is a gif </br>";
}