<?php
        if(isset($_GET['IP'])){$IP = $_GET['IP'];}
        shell_exec("bash /usr/share/zabbix/scripts/diagnostico/txt/syslog.sh \"$IP\"");

        $myfile = fopen("/usr/share/zabbix/scripts/diagnostico/txt/syslog.txt", "r") or die("Unable to open file!");
	echo "<div><b>System Log</b></div>";
        echo "<pre>".fread($myfile,filesize("/usr/share/zabbix/scripts/diagnostico/txt/syslog.txt"))."</pre>";
        fclose($myfile);
	
	shell_exec("bash /usr/share/zabbix/scripts/diagnostico/txt/applog.sh \"$IP\"");

        $myfile = fopen("/usr/share/zabbix/scripts/diagnostico/txt/applog.txt", "r") or die("Unable to open file!");
        echo "<div><b>Application Log</b></div>";
        echo "<pre>".fread($myfile,filesize("/usr/share/zabbix/scripts/diagnostico/txt/applog.txt"))."</pre>";
	fclose($myfile);
?>

