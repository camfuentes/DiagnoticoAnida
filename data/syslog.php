<?php
        if(isset($_GET['IP'])){$IP = $_GET['IP'];}
	if(isset($_GET['PROXY'])){$PROXY = $_GET['PROXY'];}

	if($PROXY!='NA'){
	shell_exec("bash /usr/share/zabbix/scripts/diagnostico/txt/syslog.sh \"$IP\" \"$PROXY\"");
	}else{
	shell_exec("bash /usr/share/zabbix/scripts/diagnostico/txt/syslogna.sh \"$IP\"");
	}
	
        $myfile = fopen("/usr/share/zabbix/scripts/diagnostico/txt/syslog.txt", "r") or die("Unable to open file!");
        echo "<pre>".fread($myfile,filesize("/usr/share/zabbix/scripts/diagnostico/txt/syslog.txt"))."</pre>";
        fclose($myfile);
?>
