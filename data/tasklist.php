<?php 
	if(isset($_GET['IP'])){$IP = $_GET['IP'];}
	if(isset($_GET['PROXY'])){$PROXY = $_GET['PROXY'];}
	
	if($PROXY!='NA'){
	$EXEC_TASKLIST = "su zabbix -c \" ssh zabbix@$PROXY 'zabbix_get -s $IP -k system.run[\\\"tasklist /nh | sort /+65 /r  \\\"]'\"";	
	shell_exec($EXEC_TASKLIST." > /usr/share/zabbix/scripts/diagnostico/txt/tasklist.txt");	
	shell_exec("cat /usr/share/zabbix/scripts/diagnostico/txt/header.txt /usr/share/zabbix/scripts/diagnostico/txt/tasklist.txt > /usr/share/zabbix/scripts/diagnostico/txt/tasklist_final.txt" );	
	}else{
	$EXEC_TASKLIST = "zabbix_get -s $IP -k system.run[\\\"tasklist /nh | sort /+65 /r  \\\"]";	
	shell_exec($EXEC_TASKLIST." > /usr/share/zabbix/scripts/diagnostico/txt/tasklist.txt");	
	shell_exec("cat /usr/share/zabbix/scripts/diagnostico/txt/header.txt /usr/share/zabbix/scripts/diagnostico/txt/tasklist.txt > /usr/share/zabbix/scripts/diagnostico/txt/tasklist_final.txt" );
	}

	$myfile = fopen("/usr/share/zabbix/scripts/diagnostico/txt/tasklist_final.txt", "r") or die("Unable to open file!");
	echo "<pre>".fread($myfile,filesize("/usr/share/zabbix/scripts/diagnostico/txt/tasklist_final.txt"))."</pre>";
	fclose($myfile);
?>

