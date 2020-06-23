<?php

/**
 * replacer.php file search_for replace_with path_to_output.
 */

//var_dump($argv);
//die();

$input = isset($argv[1]) ? $argv[1] : null;
$searchFor = isset($argv[2]) ? $argv[2] : null;
$replaceWith = isset($argv[3]) ? $argv[3] : null;
$outputFolder = isset($argv[4]) ? $argv[4] : './';

$output = time() . '-output-' . basename($input);

if ($input == null || $searchFor == null || $replaceWith == null) {
    echo "I'm affraid I can't do that..." . PHP_EOL;
    echo "Usage:" . PHP_EOL;
    echo "php replacer.php path/to/file 'search for this' 'replace with this' path/to/output/" . PHP_EOL;
    exit;
}

$finput = fopen($input, 'r');
$foutput = fopen($outputFolder . '/' . $output, 'a');

$replacedString = '';
$hits = 0;
while ($line = fread($finput, filesize($input))) {
    if (strpos($line, $searchFor) >= 0) {
        $replacedString = str_replace($searchFor, $replaceWith, $line);
        $hits++;
    } else {
        $replacedString = $line;
    }
    echo 'Found: ' . $hits;
    echo "\n";
    fputs($foutput, $replacedString);
}

fclose($finput);
fclose($foutput);