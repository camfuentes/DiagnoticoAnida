<?php 
	if(isset($_GET['IP'])){$IP = $_GET['IP'];}
	if(isset($_GET['PROXY'])){$PROXY = $_GET['PROXY'];}

	if($PROXY!='NA'){
	$EXEC_PS = "su zabbix -c \"ssh zabbix@$PROXY 'zabbix_get -s $IP -k system.run[\\\"ps -fea\\\"]'\"";	
	shell_exec($EXEC_PS." > /usr/share/zabbix/scripts/diagnostico/txt/procesos.txt");
	}else{
	$EXEC_PS = "zabbix_get -s $IP -k system.run[\\\"ps -fea\\\"]";	
	shell_exec($EXEC_PS." > /usr/share/zabbix/scripts/diagnostico/txt/procesos.txt");
	}	
	
	$myfile = fopen("/usr/share/zabbix/scripts/diagnostico/txt/procesos.txt", "r") or die("Unable to open file!");
	echo "<pre>".fread($myfile,filesize("/usr/share/zabbix/scripts/diagnostico/txt/procesos.txt"))."</pre>";
	fclose($myfile);
	
?>

