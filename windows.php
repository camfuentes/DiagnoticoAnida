<?php /*WINDOWS*/?>
<!DOCTYPE html>
<html>
<head>
	<title>Diagnostico <?= $NOMBRE;?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="icon" href="../../favicon.ico">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>	
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="js/js2.js"></script>
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
	  			</table>
		</div>
	</div>
	<div class=" col-md-12">
		<ul class="nav nav-tabs nav-justified" >
  			<li id="t_tasklist" class="active"><a data-toggle="tab" href="#tasklist">TASKLIST</a></li>
			<li id="t_processtime"><a data-toggle="tab" href="#processtime">PROCESS-TIME</a></li>
			<li id="t_wimcpu"><a data-toggle="tab" href="#wimcpu">CPU%</a></li>
			<li id="t_services"><a data-toggle="tab" href="#services">SERVICES</a></li>
			<li id="t_applog"><a data-toggle="tab" href="#applog">APPLICATION LOG</a></li>
			<li id="t_syslog"><a data-toggle="tab" href="#syslog">SYSTEM LOG</a></li>
		</ul>
		<div class="tab-content">
			<div id="tasklist" class="tab-pane fade in active tope">
				<h3>TASKLIST &nbsp;&nbsp;<button id="titulo1" class='btn-default btn'>Refresh</button></h3>
				<div id="r_tasklist"><img id="image" class="gif" src="img/carga.gif"></div>
			</div>
			<div id="processtime" class="tab-pane fade tope">
				<h3>PROCESS-TIME &nbsp;&nbsp;<button id="titulo2" class='btn-default btn'>Refresh</button></h3>
				<div id="r_processtime"><img id="image" class="gif" src="img/carga.gif"></div>
			</div>
			<div id="wimcpu" class="tab-pane fade tope">
				<h3>CPU%&nbsp;&nbsp;<button id="titulo3" class='btn-default btn'>Refresh</button></h3>
				<div id="r_wimcpu"><img id="image" class="gif" src="img/carga.gif"></div>
			</div>
			<div id="services" class="tab-pane fade tope">
				<h3>SERVICES&nbsp;&nbsp;<button id="titulo4" class='btn-default btn'>Refresh</button></h3>
				<div id="r_services"><img id="image" class="gif" src="img/carga.gif"></div>
			</div>
			<div id="applog" class="tab-pane fade tope">
				<h3>APPLICATION LOG&nbsp;&nbsp;<button id="titulo5" class='btn-default btn'>Refresh</button></h3>
				<div id="r_applog"><img id="image" class="gif" src="img/carga.gif"></div>
			</div>
			<div id="syslog" class="tab-pane fade tope">
				<h3>SYSTEM LOG&nbsp;&nbsp;<button id="titulo6" class='btn-default btn'>Refresh</button></h3>
				<div id="r_syslog"><img id="image" class="gif" src="img/carga.gif"></div>
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
						<input type="checkbox" name="chktsk" id="chktsk" value="1" > Tasklist<br>
    						<input type="checkbox" name="chkpt" id="chkpt" value="1" > Process-time<br>
    						<input type="checkbox" name="chkwc" id="chkwc" value="1" > CPU%<br>
    						<input type="checkbox" name="chksvs" id="chksvs" value="1" > Services<br>
    						<input type="checkbox" name="chkapplg" id="chkapplg" value="1" > Application log<br>
    						<input type="checkbox" name="chksyslg" id="chksyslg" value="1" > System log<br>	
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

