<?php
        if(isset($_GET['IP'])){$IP = $_GET['IP'];}
	if(isset($_GET['PROXY'])){$PROXY = $_GET['PROXY'];}
	
	if($PROXY!='NA'){
	shell_exec("bash /usr/share/zabbix/scripts/diagnostico/txt/applog.sh \"$IP\" \"$PROXY\"");
	}else{
	shell_exec("bash /usr/share/zabbix/scripts/diagnostico/txt/applogna.sh \"$IP\"");
	}	
	
        $myfile = fopen("/usr/share/zabbix/scripts/diagnostico/txt/applog.txt", "r") or die("Unable to open file!");
        echo "<pre>".fread($myfile,filesize("/usr/share/zabbix/scripts/diagnostico/txt/applog.txt"))."</pre>";
        fclose($myfile);
?>
