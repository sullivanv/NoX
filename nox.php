<?php
$timestart=microtime(true);

if ($argc != 3) {
    if ($argc < 3) {
        echo "Il manque des arguments\n";
        return ;
    }
    elseif ($argc > 3) {
        echo "Il y a trop d'arguments\n";
        return ;
    }
}

if (!file_exists($argv[1]) || !file_exists($argv[2])) {
    if (!file_exists($argv[1])) {
        echo "Le fichier contenant le message n'existe pas.\n";
        return ;
    }
    if (!file_exists($argv[2])) {
        echo "Le fichier contenant le dictionnaire n'existe pas.\n";
        return ;
    }
}

$file = fopen($argv[1], 'r');
$text = fread($file, filesize($argv[1]));
fclose($file);
preg_match_all("/[a-zA-Z\S]+[^\W\d\s]+/", $text, $tab1);
unset($text);
$file2 = fopen($argv[2], 'r');
$text2 = fread($file2, filesize($argv[2]));
fclose($file2);
preg_match_all("/[a-zA-Z\S]+[^\W\d\s]+/", $text2, $tab2);
unset($text2);
foreach ($tab2[0] as $key) {
    $u[$key] = 1;
}
$i = 0;
foreach ($tab1[0] as $value) {
    if (isset($u[$value])) {
        echo "$value\n";
        $i++;
    }
}
$timeend=microtime(true);
$time=$timeend-$timestart;
$page_load_time = number_format($time, 9);
echo "\n\n" . count($tab1[0]) . " mots trouvés dans le texte\n";
echo $i . " mots trouvés sont dans le dictionnaire\n\n";
echo "Script execute en " . $page_load_time . " sec\n";
?>
