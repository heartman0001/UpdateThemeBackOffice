<?php
require_once 'ActiveDirectory.php';
$ad = new ActiveDirectory();
$obj_url = $ad->getURLOneAccount();
$obj_data = json_decode($ad->callNMX());