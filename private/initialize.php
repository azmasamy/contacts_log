<?php
/*__FILE__ is always replaced with the filename in which the symbol appears.*/
// echo __FILE__;
//echo dirname(__FILE__);
define("PRIVATE_PATH", dirname(__FILE__));
define("CONTACTS_LOG_PATH", '../' . PRIVATE_PATH);
define("GUI_PATH", CONTACTS_LOG_PATH . '/gui');


$public_end = strpos($_SERVER['SCRIPT_NAME'], '/contacts_log') + 13;
$doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end);
define("WWW_ROOT", $doc_root);

require_once("header.php");
require_once("vendor/autoload.php");


?>
