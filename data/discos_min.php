<?php 
 	$myfile = fopen("txt/disco_min.txt", "r") or die("Unable to open file!");
        echo fread($myfile,filesize("txt/disco_min.txt"));
        fclose($myfile);
?>

