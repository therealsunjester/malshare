<?php
include("Malshare.php");
$key = "---- your key here ----";
$mal = new Malshare($key);
echo $mal->getLimit();
?>
