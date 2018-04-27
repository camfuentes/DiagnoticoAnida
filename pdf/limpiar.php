<?php
	
	if($_POST){
		shell_exec("cd /usr/share/zabbix/scripts/diagnostico/pdf/ && rm -rf *.pdf");	
		echo 'archivos eliminados';
	}
?>
