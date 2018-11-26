<?php

//Setting new cookie
setcookie("Original", "Wsx21", time()+60);

//Getting Cookie
echo $_COOKIE["Original"];

//Updating Cookie
setcookie("color", "red", time()+60);

echo $_COOKIE["color"];

setcookie("color", "blue", time()+60);

//无效unset
unset($_COOKIE["Original"]);

/*it expired so it's deleted*/
setcookie("Original","Wsx21",time()-1);
