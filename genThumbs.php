<?php
set_time_limit(900);

define('CLI_SCRIPT', false);
GLOBAL $CFG, $DB, $UTILITY;

if (CLI_SCRIPT) {
    $newline = "\n";
    $batchdir = dirname($argv[0])."/";
} else {
    $newline = "<BR />\n";
    $batchdir = getcwd()."/";
}

require_once($batchdir.'../config.php');
require_once($batchdir.'../setup.php');
require_once($batchdir.'../template.class.php');

$page = new template(NOLOGIN, NOSHOWMSG, REDIRECTSAFE);

echo $newline.date('m/d/Y H:i:s')." - BEGIN Generate Thumbnails batch".$newline;
$dirPath = "/var/data/dealernetx/sharedImages";
$files = scandir($dirPath);

$thumbPath = "/var/data/dealernetx/sharedImages/thumbs150";
$t = scandir($thumbPath);
$thumbs = array_flip($t);

foreach ($files as $file) {
    if ($file !== '.' && $file !== '..') {
        if (!array_key_exists($file, $thumbs)) {
            $filePath = $dirPath . '/' . $file;
            if (is_file($filePath)) {
                echo $newline.$filePath;
                $x = $page->utility->getPrefixPublicImageURL($file, THUMB100);
                echo $newline.$x;
                $x = $page->utility->getPrefixPublicImageURL($file, THUMB150);
                echo $newline.$x;
            }
            echo $newline;
        } else {
            echo $newline."Skipping ".$file;
        }
    }
}

echo $newline.date('m/d/Y H:i:s')." - Finished Demote Blue Star batch".$newline;
?>
