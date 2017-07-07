<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHP</title>
</head>
<body>

<?php

function readFileByLine($filename)
{
    $file = fopen($filename, "r");
    $lineArray = array();
    $i = 0;
    //输出文本中所有的行，直到文件結束為止。
    while(! feof($file))
    {
        $lineArray[$i] = fgets($file);//fgets()函數從文件指針中讀取一行
        $i++;
    }
    fclose($file);
    $lineArray = array_filter($lineArray);
    return $lineArray;
}

function dump($vars, $label = '', $return = false) {
    if (ini_get('html_errors')) {
        $content = "<pre>\n";
        if ($label != '') {
            $content .= "<strong>{$label} :</strong>\n";
        }
        $content .= htmlspecialchars(print_r($vars, true));
        $content .= "\n</pre>\n";
    } else {
        $content = $label . " :\n" . print_r($vars, true);
    }
    if ($return) { return $content; }
    echo $content;
    return null;
}

$filename = "2017-06-27.txt";
$fileArray = readFileByLine($filename);
dump($fileArray);
// $strArr = explode("|", $fileArray[0]);
// dump($strArr);

?>

</body>
</html>
