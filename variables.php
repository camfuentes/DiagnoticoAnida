<?php 
	//Variables Globales
	$URL = 'http://172.21.2.16/imonyou/api_jsonrpc.php';
	$AUTH_TOKEN="e889b33d6430dabf2fc948bf01c9541b";
	$NOMBRE = $_GET['NOMBRE'];
	$IP = $_GET['IP'];
	$SO = $_GET['TIPO'];
	$PROXY = $_GET['PROXY'];
	$SHOA = "";
	
	$SEVERITY = array('success','default','info','primary','warning','danger');	
	$PRIORITY = array('OK','Information','Warning','Average','High','Disaster');
	
	//Linux
	if($SO=='Linux'){
	//Zabbix Items
	$ITEM_USOMEMORIA = "DUOC - Pct Used Memory";
	$ITEM_USOCPU = "DUOC - Uso % de CPU";
	$LOCALTIME = exec("su zabbix -c \"ssh zabbix@10.93.70.116 'zabbix_get -s $IP -k system.localtime[local]'\"");
	$ITEM_PROCESOS = "Number of processes";
	$ITEM_UPTIME = "System uptime";
	$ITEM_MEMORIAT = "Free memory";}
	
	//Windows
	if($SO=='Windows'){
	//Zabbix Items
	$LOCALTIME = exec("su zabbix -c \"ssh zabbix@10.93.70.116 'zabbix_get -s $IP -k system.localtime[local]'\"");
	$ITEM_USOMEMORIA = "Uso de Memoria %";
	$ITEM_USOCPU = "Uso de CPU %";
	$ITEM_PROCESOS = "Number of processes";
	$ITEM_UPTIME = "System uptime";}
	
?>

<?php 
/*
	$HORAFECHANODO = exec("su zabbix -c \"ssh zabbix@10.93.70.116 'zabbix_get -s $IP -k system.localtime[local]'\"");
        $UPTIME = exec("su zabbix -c \"ssh zabbix@10.93.70.116 'zabbix_get -s $IP -k system.uptime'\"");
        $USOCPU = 100-(exec("su zabbix -c \"ssh zabbix@10.93.70.116 'zabbix_get -s $IP -k system.cpu.util[,idle]'\""));
        $USOMEMORIA = exec("su zabbix -c \"ssh zabbix@10.93.70.116 'zabbix_get -s $IP -k vm.memory.size[pused]'\"");
*/
?>
