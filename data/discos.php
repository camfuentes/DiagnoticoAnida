<?php 
	if(isset($_GET['IP'])){$IP = $_GET['IP'];}
	if(isset($_GET['PROXY'])){$PROXY = $_GET['PROXY'];}
	if($PROXY!='NA'){
	$EXEC_DF = "su zabbix -c \" ssh zabbix@$PROXY 'zabbix_get -s $IP -k system.run[\\\"df -h\\\"]'\"";
        shell_exec($EXEC_DF." > /usr/share/zabbix/scripts/diagnostico/txt/discos.txt");
	}else{
	$EXEC_DF = "zabbix_get -s $IP -k system.run[\\\"df -h\\\"]";
        shell_exec($EXEC_DF." > /usr/share/zabbix/scripts/diagnostico/txt/discos.txt");
	}
	
  	$myfile = fopen("/usr/share/zabbix/scripts/diagnostico/txt/discos.txt", "r") or die("Unable to open file!");
    	echo "<pre>".fread($myfile,filesize("/usr/share/zabbix/scripts/diagnostico/txt/discos.txt"))."</pre>";
    	fclose($myfile);
?>
