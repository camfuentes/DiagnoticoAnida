<?php
        if(isset($_GET['IP'])){$IP = $_GET['IP'];}
	if(isset($_GET['PROXY'])){$PROXY = $_GET['PROXY'];}
	if($PROXY!='NA'){
	$EXEC_SAR = "su zabbix -c \"ssh zabbix@$PROXY 'zabbix_get -s $IP -k system.run[\\\"sar \\\"]'\"";
        shell_exec($EXEC_SAR."|tail -n 80 > /usr/share/zabbix/scripts/diagnostico/txt/cpu.txt");
	}else{
	$EXEC_SAR = "zabbix_get -s $IP -k system.run[\\\" sar \\\"]";
        shell_exec($EXEC_SAR."|tail -n 80 > /usr/share/zabbix/scripts/diagnostico/txt/cpu.txt");
	}
	$myfile = fopen("/usr/share/zabbix/scripts/diagnostico/txt/cpu.txt", "r") or die("Unable to open file!");
  	echo "<pre>".fread($myfile,filesize("/usr/share/zabbix/scripts/diagnostico/txt/cpu.txt"))."</pre>";
  	fclose($myfile);
?>
