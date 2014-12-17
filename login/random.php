<?php 
require "config/config.php";
require "checklogin.php";
require "rndPass.class.php";

    $rndcode=new rndPass(7);
    $usercode=$rndcode->PassGen();
	echo "$1$".$usercode.".$";
	
?>