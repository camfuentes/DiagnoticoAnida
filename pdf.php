<?php
	require_once 'dompdf/autoload.inc.php';
	use Dompdf\Dompdf;
	setlocale(LC_ALL,"es_ES");

	$DATE = strftime("%T %B %d, %Y");
	$DATE2 = new DateTime(strftime("%F %T"));
	$DATE_CORTO = strftime("%A %d de %B del %Y");
	$NOMBRE=$_POST['NOMBRE'];
	$IP=$_POST['IP'];
	$SO=$_POST['SO'];
	$PROXY=$_POST['PROXY'];
	$LOCALTIME=$_POST['LOCALTIME'];
	$UPTIME=$_POST['UPTIME'];
	$USOCPU=$_POST['USOCPU'];
	$USOMEMORIA=$_POST['USOMEMORIA'];
	$PROCESOS=$_POST['PROCESOS'];
	$SALIDA=$_POST['SALIDA'];

	if($SO=='Linux'){
	$DATE3 = new DateTime(shell_exec("su zabbix -c \"ssh zabbix@10.93.70.116 'zabbix_get -s $IP -k system.run[\\\"date \\\\\\\"+%F %T\\\\\\\" \\\"]'\""));	
	$interval = date_diff($DATE2,$DATE3);
	$LINUX = shell_exec("su zabbix -c \"ssh zabbix@10.93.70.116 'zabbix_get -s $IP -k system.run[\\\"cat /proc/version\\\"]'\"");
	
	//PAGINAS PHP LINUX
	ob_start();
	require_once('data/discos_min.php');
	$discos_min = ob_get_contents();
	ob_clean();
        
	//CODIGO HTML LINUX	
	$html='
	<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	</head>
	<body>
	<div style="position:fixed;bottom:3mm;color:#5c5c3d;font-size:8"><hr style="color:#337AB7">
	<table width="18.7cm" style="table-layout:fixed"> 
	<td>'.$NOMBRE.'</td>
	<td align="center">Anida Chile</td>
	<td align="right">'.$DATE_CORTO.'</td>
	</table>
	</div>
	<table><td><img alt="Brand" src="img/logo.jpg" height="33px"></td>
	<td style="padding-left:7cm;"></td>
	<td style="color:#5c5c3d;font-size:10">Subgerencia de monitoreo y Disponibilidad de servicio</td></table>
	<center><h2>Informe Diagnostico Maquina : '.$NOMBRE.'</h2></center>
	<center><div style="font-size:11"><b>IP :</b> '.$IP.'</div></center>
	<center><div style="font-size:11"><b>Proxy :</b> '.$PROXY.'</div></center>
	<center><div style="font-size:11"><b>Sistema Operativo :</b> '.$LINUX.'</div></center>
	<br>
	<table cellspacing="0" style="width:100%">
	<thead>
	<tr style="background-color:#337AB7;color:white;font-size:14" align="center"><th colspan="2">Estado Del Nodo</th></tr>
	</thead>
	<tbody style="font-size:11">
	<tr style="background-color:#F7F7F7"><td >Hora y Fecha de la Consulta</td><td align="right">'.$DATE.'</td></tr>
	<tr ><td>Hora y Fecha del Nodo</td><td align="right">'.$LOCALTIME.'</td></tr>
	<tr style="background-color:#F7F7F7"><td>Diferencia Horia</td><td align="right">'.$interval->format('%R %h horas %i minutos y %s segundos').'</td></tr>
	<tr ><td>Uptime del Nodo</td><td align="right">'.$UPTIME.'</td></tr>
	<tr style="background-color:#F7F7F7"><td>Uso de CPU</td><td align="right">'.$USOCPU.'%</td></tr>
	<tr ><td>Memoria Utilizada</td><td align="right">'.$USOMEMORIA.'%</td></tr>
	<tr style="background-color:#F7F7F7"><td>Total Procesos</td><td align="right">'.$PROCESOS.'</td></tr>
	<tr ><td>Discos</td><td align="right">'.$discos_min.'</td></tr>
	</tbody>
	</table><br>
	<div style="color:#337AB7"> Proceda a la siguente pagina para ver los resultados</div>
	<div style="page-break-after:always;"></div>';

	if(isset($_POST['PCS'])){
		require_once('data/procesos_min.php');
		$data_procesos = ob_get_contents();
		ob_clean();
		$html.='<div><b>Procesos</b></div>
		<div style="font-size:8;padding-left:1mm;overflow:hidden;">'.$data_procesos.'</div>
		<div style="page-break-after:always;"></div>';

	}
	if(isset($_POST['TOP'])){
		require_once('data/top.php');
		$data_top = ob_get_contents();
		ob_clean();
		$html.='<div><b>Top</b></div>
		<div style="font-size:8;padding-left:1mm;overflow:hidden;">'.$data_top.'</div>
		<div style="page-break-after:always;"></div>';

	}
	if(isset($_POST['CPUL'])){
		require_once('data/cpu.php');
        	$data_cpu = ob_get_contents();
		ob_clean();
		$html.='<div><b>Cpu</b></div>
		<div style="font-size:8;padding-left:1mm;overflow:hidden;">'.$data_cpu.'</div>
		<div style="page-break-after:always;"></div>';

	}
	if(isset($_POST['MEM'])){
         	require_once('data/memoria.php');
        	$data_memoria = ob_get_contents();
		ob_clean();
		$html.='<div><b>Memoria</b></div>
		<div style="font-size:8;padding-left:1mm;overflow:hidden;">'.$data_memoria.'</div>
		<div style="page-break-after:always;"></div>';

	}
	if(isset($_POST['DSC'])){
		require_once('data/discos.php');
        	$data_discos = ob_get_contents();
		ob_clean();
		$html.='<div><b>Discos</b></div>
		<div style="font-size:8;padding-left:1mm;overflow:hidden;">'.$data_discos.'</div>
		<div style="page-break-after:always;"></div>';

	}
	if(isset($_POST['DMESG'])){
		require_once('data/dmesg_min.php');
        	$data_dmesg = ob_get_contents();
		ob_end_clean();
		$html.='<div><b>DMESG</b></div>
		<div style="font-size:8;padding-left:1mm;overflow:hidden;">'.$data_dmesg.'</div>
		<div style="page-break-after:always;"></div>';

	}
	
	$html.='</body></html>';}

	if($SO=='Windows'){
	$DATE3 = shell_exec("su zabbix -c \"ssh zabbix@10.93.70.116 'zabbix_get -s $IP -k system.run[\\\"echo %date% %time% \\\"]'\"");
	$DATE3 = preg_replace("/[^0-9\/:. ]/", "", $DATE3);
	$DATE3 = new DateTime(substr($DATE3, 0, strpos($DATE3, ".")));	
	
	$interval = date_diff($DATE2,$DATE3);
	
	//CODIGO HTML WINDOWS
	$html='
	<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	</head>
	<body>
	<div style="position:fixed;bottom:3mm;color:#5c5c3d;font-size:8"><hr style="color:#337AB7">
	<table width="18.7cm" style="table-layout:fixed"> 
	<td>'.$NOMBRE.'</td>
	<td align="center">Anida Chile</td>
	<td align="right">'.$DATE_CORTO.'</td>
	</table>
	</div>
	<table><td><img alt="Brand" src="img/logo.jpg" height="33px"></td>
	<td style="padding-left:7cm;"></td>
	<td style="color:#5c5c3d;font-size:10">Subgerencia de monitoreo y Disponibilidad de servicio</td></table>
	<center><h2>Informe Diagnostico Maquina : '.$NOMBRE.'</h2></center>
	<center><div style="font-size:11"><b>IP :</b> '.$IP.'</div></center>
	<center><div style="font-size:11"><b>Sistema Operativo : </b>'.$SO.'</div></center>
	<center><div style="font-size:11"><b>Proxy : </b>'.$PROXY.'</div></center>
	<br>
	<table cellspacing="0" style="width:100%">
	<thead>
	<tr style="background-color:#337AB7;color:white;font-size:14" align="center"><th colspan="2">Estado Del Nodo</th></tr>
	</thead>
	<tbody style="font-size:11">
	<tr style="background-color:#F7F7F7"><td >Hora y Fecha de la Consulta</td><td align="right">'.$DATE.'</td></tr>
	<tr ><td>Hora y Fecha del Nodo</td><td align="right">'.$LOCALTIME.'</td></tr>
	<tr style="background-color:#F7F7F7"><td>Diferencia Horaria</td><td align="right">'.$interval->format('%R %h horas %i minutos y %s segundos').'</td></tr>
	<tr ><td>Uptime del Nodo</td><td align="right">'.$UPTIME.'</td></tr>
	<tr style="background-color:#F7F7F7"><td>Uso de CPU</td><td align="right">'.$USOCPU.'%</td></tr>
	<tr ><td>Memoria Utilizada</td><td align="right">'.$USOMEMORIA.'%</td></tr>
	<tr style="background-color:#F7F7F7"><td>Total Procesos</td><td align="right">'.$PROCESOS.'</td></tr>
	</tbody>
	</table><br>
	<div style="color:#337AB7"> Proceda a la siguente pagina para ver los resultados '.$ee.'</div>
	<div style="page-break-after:always;"></div>';
	
		
	ob_start();
	if(isset($_POST['TSK'])){
		require_once('data/tasklist.php');
        	$data_tasklist = ob_get_contents();
        	ob_clean();
		$html.='<div><b>Tasklist</b></div>
		<div style="font-size:8;padding-left:1mm;overflow:hidden;">'.$data_tasklist.'</div>
		<div style="page-break-after:always;"></div>';

	}
	if(isset($_POST['PT'])){
		require_once('data/processtime.php');
        	$data_processtime = ob_get_contents();
		ob_clean();
		$html.='<div><b>Processtime</b></div>
        	<div style="font-size:8;padding-left:1mm;overflow:hidden;">'.$data_processtime.'</div>
		<div style="page-break-after:always;"></div>';
	
	}
	if(isset($_POST['WC'])){
		require_once('data/wimcpu.php');
        	$data_wimcpu = ob_get_contents();
		ob_clean();
		$html.='<div><b>CPU%</b></div>
        	<div style="font-size:8;padding-left:1mm;overflow:hidden;">'.$data_wimcpu.'</div>
		<div style="page-break-after:always;"></div>';

	}
	if(isset($_POST['SVS'])){
		require_once('data/services.php');
        	$data_services = ob_get_contents();
		ob_clean();
		$html.='<div><b>Services</b></div>
        	<div style="font-size:8;padding-left:1mm;overflow:hidden;">'.$data_services.'</div>
		<div style="page-break-after:always;"></div>';

	}
	if(isset($_POST['APPLG'])){
		require_once('data/applog.php');
        	$data_applog = ob_get_contents();
		ob_clean();
		$html.='<div><b>APPLICATION LOG</b></div>
        	<div style="font-size:8;padding-left:1mm;overflow:hidden;"><pre>'.strip_tags($data_applog).'</pre></div>
		<div style="page-break-after:always;"></div>';
	}
	if(isset($_POST['SYSLG'])){
		require_once('data/syslog.php');
        	$data_syslog = ob_get_contents();
		ob_clean();
		$html.='<div><b>SYSTEM LOG</b></div>
        	<div style="font-size:8;padding-left:1mm;overflow:hidden;">'.$data_syslog.'</div>
		<div style="page-break-after:always;"></div>';

	}	
       	ob_end_clean();
	
		
	$html.='</body></html>';
	
	} 

	$mipdf = new DOMPDF();
	$mipdf ->set_paper("A4", "portrait");
	$mipdf ->load_html(utf8_decode($html));
	$mipdf ->render();

	if($SALIDA=='1'){
		$mipdf ->stream(''.$NOMBRE.' '.$DATE,array("Attachment" => false));
	exit(0);} else if($SALIDA=='0'){
		$output = $mipdf->output();
   		file_put_contents('/usr/share/zabbix/scripts/diagnostico/pdf/'.$NOMBRE.' '.$LOCALTIME.'.pdf',$output);
		echo 'exito';
	} 

?>
