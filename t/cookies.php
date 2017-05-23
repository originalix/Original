<?php

setcookie("Original", "Wsx21", time()+60);

echo $_COOKIE["Original"];

setcookie("color", "red", time()+60);

echo $_COOKIE["color"];

setcookie("color", "blue", time()+60);

unset($_COOKIE["Original"]);

setcookie("Original","Wsx21",time()-1);

