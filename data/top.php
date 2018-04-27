<?php 
        if(isset($_GET['IP'])){$IP = $_GET['IP'];}
	if(isset($_GET['PROXY'])){$PROXY = $_GET['PROXY'];}
	
	if($PROXY!='NA'){
	$EXEC_TOP = "su zabbix -c \"ssh zabbix@$PROXY 'zabbix_get -s $IP -k system.run[\\\"TERM=vt100 top -c -b -n 1 \\\"]'\"";
        shell_exec($EXEC_TOP." > /usr/share/zabbix/scripts/diagnostico/txt/top.txt");
	}else{
	$EXEC_TOP = "zabbix_get -s $IP -k system.run[\\\"TERM=vt100 top -c -b -n 1 \\\"]";
        shell_exec($EXEC_TOP." > /usr/share/zabbix/scripts/diagnostico/txt/top.txt");
	}

  	$myfile = fopen("/usr/share/zabbix/scripts/diagnostico/txt/top.txt", "r") or die("Unable to open file!");
  	echo "<pre>".fread($myfile,filesize("/usr/share/zabbix/scripts/diagnostico/txt/top.txt"))."</pre>";
  	fclose($myfile);
?>
