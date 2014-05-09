#!/usr/bin/env php
<?php
/**
 * Converts tab-delimited 1Password file into KeePassX XML import-ready format.
 * Only export 4 fields for logins only:  title, username, password, url/location
 *
 * @author Adam Altman
 * @license The Unlicense
 */

$params = $_SERVER['argv'];
$debug = false;
// debug code:
if ($debug) {
    echo print_r($params, true);
}

// check the filepath
if (empty($params[1])) {
    echo "Error:  missing a required argument, filepath.\n\n";
    echo getHelp();
    return 1;
} else {
    $sourcePath = $params[1];
}

// check if debug flag is set
if (isset($params[2]) && $params[2] === '--debug') {
    $debug = true;
    echo "1Password to KeePassX converter running in debug mode:\n\n";
}

// The $source should have the path of a valid file
if (!is_file($sourcePath)) {
    echo "Path to file is incorrect.\n";
    echo getHelp();
    return 1;
}

// We'll turn it into an array, with 1 line per element.
$source = file($sourcePath, FILE_IGNORE_NEW_LINES);

if ($debug) {
    echo print_r($source, true);
    // How many lines are in the $source file?
    echo "    There are " . count($source) . " lines in the file.\n\n";
}

// The start of the file:
echo "<!DOCTYPE KEEPASSX_DATABASE>
<database>
 <group>
   <title>1Password Import</title>
   <icon>1</icon>
";

// now we need to iterate through the file, and make an entry for each line.
foreach ($source as $line) {

    if (empty($line)) {
        if ($debug) {
            echo "    The line is empty, move on.\n";
        }
    } else {
        $entry = explode("\t", $line);
        $title = htmlspecialchars($entry[0]);
        $username = htmlspecialchars($entry[1]);
        $password = htmlspecialchars($entry[2]);
        $url = htmlspecialchars($entry[3]);
        echo "     <entry>\n";
        echo "       <title>$title</title>\n";
        echo "       <username>$username</username>\n";
        echo "       <password>$password</password>\n";
        echo "       <url>$url</url>\n";
        echo "     </entry>\n";
    }
}

echo " </group>
</database>
";

function getHelp()
{
    return <<<EOD
USAGE
  php convert.php <string> [--debug]

DESCRIPTION
  This command converts a data.txt 1Password tab-delimited text file into a KeePassX XML Database format.
  It only works with 4 fields for 1Password logins:  title, username, password, url/location.

PARAMETERS
   filepath:  the relative path to the file.
    --debug:  optional, runs with extra debug output.

HINTS
   You can echo the output directly into a file:  ./convert.php [filepath of data.txt] > output.xml

EOD;
}
