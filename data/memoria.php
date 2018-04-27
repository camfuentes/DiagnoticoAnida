<?php 
	if(isset($_GET['IP'])){$IP = $_GET['IP'];}
	if(isset($_GET['PROXY'])){$PROXY = $_GET['PROXY'];}
	if($PROXY!='NA'){
	$EXEC_FREE = "su zabbix -c \"ssh zabbix@$PROXY 'zabbix_get -s $IP -k system.run[\\\"free -mk\\\"]'\"";
        shell_exec($EXEC_FREE." > /usr/share/zabbix/scripts/diagnostico/txt/memoria.txt");
	}else{
	$EXEC_FREE = "zabbix_get -s $IP -k system.run[\\\"free -mk\\\"]";
        shell_exec($EXEC_FREE." > /usr/share/zabbix/scripts/diagnostico/txt/memoria.txt");
	}

	$myfile = fopen("/usr/share/zabbix/scripts/diagnostico/txt/memoria.txt", "r") or die("Unable to open file!");
  	echo "<pre>".fread($myfile,filesize("/usr/share/zabbix/scripts/diagnostico/txt/memoria.txt"))."</pre>";
  	fclose($myfile);
?>
