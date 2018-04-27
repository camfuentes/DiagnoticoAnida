<?php 
        if(isset($_GET['IP'])){$IP = $_GET['IP'];}
	if(isset($_GET['PROXY'])){$PROXY = $_GET['PROXY'];}
	$EX = $_GET['EX'];
	if($PROXY!='NA'){
	$EXEC_DMESG = "su zabbix -c \"ssh zabbix@$PROXY 'zabbix_get -s $IP -k system.run[\\\"dmesg $EX\\\"]'\"";
        shell_exec($EXEC_DMESG."|tail -n 50 > /usr/share/zabbix/scripts/diagnostico/txt/dmesg.txt");
  	}else{
	$EXEC_DMESG = "zabbix_get -s $IP -k system.run[\\\"dmesg $EX\\\"]";
        shell_exec($EXEC_DMESG."|tail -n 50 > /usr/share/zabbix/scripts/diagnostico/txt/dmesg.txt");
	}
	
	$myfile = fopen("/usr/share/zabbix/scripts/diagnostico/txt/dmesg.txt", "r") or die("Unable to open file!");
  	echo "<pre>".fread($myfile,filesize("/usr/share/zabbix/scripts/diagnostico/txt/dmesg.txt"))."</pre>";
  	fclose($myfile);
?>
