<?php 
	$myfile = fopen("/usr/share/zabbix/scripts/diagnostico/txt/procesos.txt", "r") or die("Unable to open file!");
        echo "<pre>".fread($myfile,filesize("/usr/share/zabbix/scripts/diagnostico/txt/procesos.txt"))."</pre>";
        fclose($myfile);
?>
