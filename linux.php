<?php/*LINUX*/?>
<!DOCTYPE html>

<html>
<head>
	<title>Diagnostico <?= $NOMBRE;?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Pragma" content="no-cache">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="icon" href="../../favicon.ico">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>	
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="js/js.js"></script>
</head>
<body>
	<div>
		<nav class="navbar navbar-default">
  		<div class="container-fluid">
    		<div class="navbar-header">
      			<a class="navbar-brand" href="http://172.21.2.16/imonyou/zabbix.php?action=dashboard.view"><img alt="Brand" src="img/logo.jpg" height="33px"></a>
    		</div>
    		<div class="navbar-collapse collapse navbar-right">
        	<p class="navbar-text">Subgerencia de Monitoreo y disponiblidad de Servicio </p>
      		</div>
  		</div>
		</nav>
    </div>
    <div align="center">
    	<h1>Diagnostico Anida - Check</h1>
    	<p>Nodo Consultado : <?= $NOMBRE;?></p>
    	<p>IP : <?= $IP;?></p>
    	<p>Sistema Operativo : <?= $SO;?></p>
    	<p>Proxy : <?= $PROXY;?></p>
	 
	<form id='mail' action="pdf.php" method="POST">  
        <div id="oculto">
	<input type="hidden" name="IP" id="IP" value="<?= $IP;?>">
        <input type="hidden" name="NOMBRE" id="NOMBRE" value="<?= $NOMBRE;?>">
        <input type="hidden" name="SO" id="SO" value="<?= $SO;?>">
        <input type="hidden" name="PROXY" id="PROXY" value="<?= $PROXY;?>">
        <input type="hidden" name="LOCALTIME" id="LOCALTIME" value="<?= $LOCALTIME;?>">
        <input type="hidden" name="UPTIME" id="UPTIME" value="<?= $UPTIME;?>">
        <input type="hidden" name="USOCPU" id="USOCPU" value="<?= $USOCPU;?>">
        <input type="hidden" name="USOMEMORIA" id="USOMEMORIA" value="<?= $USOMEMORIA;?>">
        <input type="hidden" name="PROCESOS" id="PROCESOS" value="<?= $PROCESOS;?>">
        <input type="hidden" name="SALIDA" id="SALIDA" value="0">
        </div>
	</form>
        <a href="#" data-toggle="modal" data-target="#modal" id="btnmail"><img alt="Brand" src="img/pdf.png" height="50px"></a></p>
	
    </div>
    <div class="col-sm-8 col-sm-offset-2">
	    <div class="panel panel-primary ">
	  			<div class="panel-heading">
	    		<h3 class="panel-title">Estado del Nodo</h3>
	  		</div>
	  			<table class="table fixed">
	    		<tr>
	    			<td>Hora y Fecha de la Consulta </td>
	    			<td><?= date('H:i:s F j, Y');?></td>
	    		</tr>
	    		<tr>
	    			<td>Hora y Fecha del Nodo </td>
	    			<td><?= $LOCALTIME;?></td>
	    		</tr>
	    		<tr>
	    			<td>Uptime del Nodo<span class="label label-<?php if($UPTIME_T){echo $SEVERITY[$UPTIME_T];}else{echo $SEVERITY[$UPTIME_T];}?> pull-right"><?= $PRIORITY[$UPTIME_T]?></span></td>
	    			<td><?= $UPTIME;?></td>
	    		</tr>
	    		<tr>
	    			<td>Uso de CPU<span class="label label-<?php if($USOCPU_T){echo $SEVERITY[$USOCPU_T];}else{echo $SEVERITY[$USOCPU_T];}?> pull-right"><?= $PRIORITY[$USOCPU_T]?></span></td>
	    			<td><?= $USOCPU."%";?></td>
	    		</tr>
	    		<tr>
	    			<td>Memoria Utilizada<span class="label label-<?php if($USOMEMORIA_T){echo $SEVERITY[$USOMEMORIA_T];}else{echo $SEVERITY[$USOMEMORIA_T];}?> pull-right"><?= $PRIORITY[$USOMEMORIA_T]?></span></td>
	    			<td><?= $USOMEMORIA."%";?></td>
	    		</tr>
	    		<tr>
	    			<td>Total Procesos<span class="label label-<?php if($PROCESOS_T){echo $SEVERITY[$PROCESOS_T];}else{echo $SEVERITY[$PROCESOS_T];}?> pull-right"><?= $PRIORITY[$PROCESOS_T]?></span></td>
	    			<td><?= $PROCESOS?></td>
	    		</tr>
	    		<tr>
	    			<td>Disco</td>
	    			<td><?php include('data/discos_min.php');?></td>
	    		</tr>
	  			</table>
		</div>
	</div>
	<div class=" col-md-12">
		<ul class="nav nav-tabs nav-justified" >
  		<li id="t_procesos" class="active"><a data-toggle="tab" href="#procesos">Procesos</a></li>
    		<li id="t_top"><a data-toggle="tab" href="#top">TOP</a></li>
    		<li id="t_cpu"><a data-toggle="tab" href="#cpu">CPU</a></li>
    		<li id="t_memoria"><a data-toggle="tab" href="#memoria">Memoria</a></li>
    		<li id="t_discos"><a data-toggle="tab" href="#discos">Discos</a></li>
    		<li id="t_dmesg"><a data-toggle="tab" href="#dmesg">DMESG</a></li>
		</ul>
		<div class="tab-content">
			<div id="procesos" class="tab-pane fade in active tope">
				<h3>PROCESOS &nbsp;&nbsp;<button id="titulo1" class='btn-default btn'>Refresh</button></h3>
				<div id="r_procesos"><img id="image" class="gif" src="img/carga.gif"></div>	
			</div>
			<div id="top" class="tab-pane fade tope">
				<h3>TOP &nbsp;&nbsp;<button id="titulo2" class='btn-default btn'>Refresh</button></h3>
				<div id="r_top"><img id="image" class="gif" src="img/carga.gif"></div>		
			</div>
			<div id="cpu" class="tab-pane fade tope">
				<h3>CPU &nbsp;&nbsp;<button id="titulo3" class='btn-default btn'>Refresh</button></h3>
				<div id="r_cpu"><img id="image" class="gif" src="img/carga.gif"></div>
			</div>
			<div id="memoria" class="tab-pane fade tope">
				<h3>MEMORIA &nbsp;&nbsp;<button id="titulo4" class='btn-default btn'>Refresh</button></h3>
				<div id="r_memoria"><img id="image" class="gif" src="img/carga.gif"></div>
			</div>
			<div id="discos" class="tab-pane fade tope">
				<h3>DISCOS &nbsp;&nbsp;<button id="titulo5" class='btn-default btn'>Refresh</button></h3>
				<div id="r_discos"><img id="image" class="gif" src="img/carga.gif"></div>
			</div>
			<div id="dmesg" class="tab-pane fade tope">
				<h3>DMESG &nbsp;&nbsp;<div class="btn-group" role="group" aria-label="..."><button id="titulo61" type="button" class="btn btn-default">Refresh</button><button id="titulo62" type="button" class="btn btn-default">-T</button></div></h3>
				<div id="r_dmesg"><img id="image" class="gif" src="img/carga.gif"></div>
			</div>
  		</div>
	</div>

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
        <div class="modal-dialog" role="document">
                <div class="modal-content">
                        <div class="modal-header">
                                <h4><b>Generar PDF </b></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                                <div id="checkboxes">
                                        <input type="checkbox" name="chkpcs" id="chkpcs" value="1" > Procesos<br>
                                        <input type="checkbox" name="chktop" id="chktop" value="1" > Top<br>
                                        <input type="checkbox" name="chkcpu" id="chkcpu" value="1" > Cpu<br>
                                        <input type="checkbox" name="chkmem" id="chkmem" value="1" > Memoria<br>
                                        <input type="checkbox" name="chkdsc" id="chkdsc" value="1" > Discos<br>
                                        <input type="checkbox" name="chkdmesg" id="chkdmesg" value="1" > DMESG<br>
                                </div>

                                <div id="procesosPDF" style="padding-top:2%">
                                        <div id="generar"><button type="button" class="btn btn-primary" id="btngenerar" disabled>Generar PDF</button></div>
                                        <div class="progress" style="margin-top:2%" hidden><div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">Generando Archivo PDF</div></div>
                                        <div id="envio" style="padding-top:2%" hidden><p><a href="pdf/<?= $NOMBRE;?> <?= $LOCALTIME;?>.pdf" id="pdf-flat" target="_blank"><img alt="Brand" src="img/pdf-flat.png" height="50px">&nbsp;&nbsp;<?= $NOMBRE;?> <?= $LOCALTIME;?>.pdf</a></p></div>
                                </div>

                                <div id='formmail' hidden>
                                        <hr>
                                        <form id='send' action="mailer.php" method="POST">
                                                <div class="form-group">
                                                        <label for="lbldestinatario" class="col-form-label">Destinatario:</label>
                                                        <input type="email" placeholder="email@example.com" class="form-control" id="destinatario" name="destinatario">
                                                </div>
                                                <div class="form-group">
                                                        <label for="lblasunto" class="col-form-label">Asunto:</label>
                                                        <input type="text" class="form-control" id="asunto" name="asunto">
                                                </div>
                                                <div class="form-group">
                                                        <label for="lblmensaje" class="col-form-label">Mensaje:</label>
                                                        <textarea class="form-control" id="mensaje" rows="10" name="mensaje"></textarea>
                                                </div>
                                                <input type="hidden" name="adjunto" id="adjunto" value="<?= $NOMBRE;?> <?= $LOCALTIME;?>.pdf">
                                        </form>
                                </div>
                                <div id="respuesta"></div>
                                <div class="modal-footer" style="margin-top:2%">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                        <button type="button" class="btn btn-primary" id="btnenviar" disabled>Enviar</button>
                                </div>
                        </div>
                </div>
        </div>
</div>

</body>
</html>

