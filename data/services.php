<?php
        if(isset($_GET['IP'])){$IP = $_GET['IP'];}
	if(isset($_GET['PROXY'])){$PROXY = $_GET['PROXY'];}
	
	if($PROXY!='NA'){
	shell_exec("bash /usr/share/zabbix/scripts/diagnostico/txt/services.sh \"$IP\" \"$PROXY\"");
	}else{
	shell_exec("bash /usr/share/zabbix/scripts/diagnostico/txt/servicesna.sh \"$IP\"");
	}
	
        $myfile = fopen("/usr/share/zabbix/scripts/diagnostico/txt/services.txt", "r") or die("Unable to open file!");
        $out ="<pre>".fread($myfile,filesize("/usr/share/zabbix/scripts/diagnostico/txt/services.txt"))."</pre>";
        fclose($myfile);
	$out = explode("\n",$out);
	foreach($out as $p){
		if (strpos($p, 'Stopped Automatic') !== false) {
    			echo "<p style='color:red;margin:0;padding:0'>$p</p>";
		}else{
			echo "<p style='margin:0;padding:0'>$p</p>";
		}
	}
?>
