<?php

/**
 	--------------------------
	Autor: Sandor Matamoros
	Programer: Fatima Arellano
	Propietario: EPC
	FECHA sandor:
	FECHA fatis: 07/04/2025
	----------------------------
 
*/


	if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
	define("__ROOT6__", dirname(__FILE__));
$action = (isset($_POST["action"])&& $_POST["action"] !=NULL)?$_POST["action"]:"";
if($action == "ajax"){

	require(__ROOT6__."/class.filtro.php");
	$database=new orders();	

	$query=isset($_POST["query"])?$_POST["query"]:"";

	$DEPARTAMENTO = !empty($_POST["DEPARTAMENTO2"])?$_POST["DEPARTAMENTO2"]:"DEFAULT";	
	$nombreTabla = "SELECT * FROM `08ventasoperacionesfiltroDes`, 08altaeventosfiltroPLA WHERE 08ventasoperacionesfiltroDes.id = 08altaeventosfiltroPLA.idRelacion";
	$altaeventos = "ventasoperaciones";

	

$NUMERO_CONSECUTIVO_PROVEE = isset($_POST["NUMERO_CONSECUTIVO_PROVEE"])?$_POST["NUMERO_CONSECUTIVO_PROVEE"]:""; 
$NOMBRE_COMERCIAL = isset($_POST["NOMBRE_COMERCIAL"])?$_POST["NOMBRE_COMERCIAL"]:""; 
$RAZON_SOCIAL = isset($_POST["RAZON_SOCIAL"])?$_POST["RAZON_SOCIAL"]:""; 
$VIATICOSOPRO = isset($_POST["VIATICOSOPRO"])?$_POST["VIATICOSOPRO"]:""; 
$RFC_PROVEEDOR = isset($_POST["RFC_PROVEEDOR"])?$_POST["RFC_PROVEEDOR"]:""; 
$NUMERO_EVENTO = isset($_POST["NUMERO_EVENTO"])?$_POST["NUMERO_EVENTO"]:""; 
$NOMBRE_EVENTO = isset($_POST["NOMBRE_EVENTO"])?$_POST["NOMBRE_EVENTO"]:""; 
$MOTIVO_GASTO = isset($_POST["MOTIVO_GASTO"])?$_POST["MOTIVO_GASTO"]:""; 
$CONCEPTO_PROVEE = isset($_POST["CONCEPTO_PROVEE"])?$_POST["CONCEPTO_PROVEE"]:""; 
$MONTO_TOTAL_COTIZACION_ADEUDO = isset($_POST["MONTO_TOTAL_COTIZACION_ADEUDO"])?$_POST["MONTO_TOTAL_COTIZACION_ADEUDO"]:""; 
$MONTO_FACTURA = isset($_POST["MONTO_FACTURA"])?$_POST["MONTO_FACTURA"]:""; 
$MONTO_PROPINA = isset($_POST["MONTO_PROPINA"])?$_POST["MONTO_PROPINA"]:""; 
$MONTO_DEPOSITAR = isset($_POST["MONTO_DEPOSITAR"])?$_POST["MONTO_DEPOSITAR"]:""; 
$TIPO_DE_MONEDA = isset($_POST["TIPO_DE_MONEDA"])?$_POST["TIPO_DE_MONEDA"]:""; 
$PFORMADE_PAGO = isset($_POST["PFORMADE_PAGO"])?$_POST["PFORMADE_PAGO"]:""; 
$STATUS_CHECKBOX = isset($_POST["STATUS_CHECKBOX"])?$_POST["STATUS_CHECKBOX"]:""; 

$FECHA_DE_PAGO = isset($_POST["FECHA_DE_PAGO"])?trim($_POST["FECHA_DE_PAGO"]):"";
$FECHA_DE_PAGO2a = isset($_POST["FECHA_DE_PAGO2a"])?trim($_POST["FECHA_DE_PAGO2a"]):"";

$FECHA_A_DEPOSITAR = isset($_POST["FECHA_A_DEPOSITAR"])?$_POST["FECHA_A_DEPOSITAR"]:""; 
$STATUS_DE_PAGO = isset($_POST["STATUS_DE_PAGO"])?$_POST["STATUS_DE_PAGO"]:""; 
$ACTIVO_FIJO = isset($_POST["ACTIVO_FIJO"])?$_POST["ACTIVO_FIJO"]:""; 
$GASTO_FIJO = isset($_POST["GASTO_FIJO"])?$_POST["GASTO_FIJO"]:""; 
$PAGAR_CADA = isset($_POST["PAGAR_CADA"])?$_POST["PAGAR_CADA"]:""; 
$FECHA_PPAGO = isset($_POST["FECHA_PPAGO"])?$_POST["FECHA_PPAGO"]:""; 
$FECHA_TPROGRAPAGO = isset($_POST["FECHA_TPROGRAPAGO"])?$_POST["FECHA_TPROGRAPAGO"]:""; 
$NUMERO_EVENTOFIJO = isset($_POST["NUMERO_EVENTOFIJO"])?$_POST["NUMERO_EVENTOFIJO"]:""; 
$CLASI_GENERAL = isset($_POST["CLASI_GENERAL"])?$_POST["CLASI_GENERAL"]:""; 
$SUB_GENERAL = isset($_POST["SUB_GENERAL"])?$_POST["SUB_GENERAL"]:""; 
$MONTO_DEPOSITADO = isset($_POST["MONTO_DEPOSITADO"])?$_POST["MONTO_DEPOSITADO"]:""; 
$NUMERO_EVENTO1 = isset($_POST["NUMERO_EVENTO1"])?$_POST["NUMERO_EVENTO1"]:""; 
$CLASIFICACION_GENERAL = isset($_POST["CLASIFICACION_GENERAL"])?$_POST["CLASIFICACION_GENERAL"]:""; 
$CLASIFICACION_ESPECIFICA = isset($_POST["CLASIFICACION_ESPECIFICA"])?$_POST["CLASIFICACION_ESPECIFICA"]:""; 
$PLACAS_VEHICULO = isset($_POST["PLACAS_VEHICULO"])?$_POST["PLACAS_VEHICULO"]:""; 
$MONTO_DE_COMISION = isset($_POST["MONTO_DE_COMISION"])?$_POST["MONTO_DE_COMISION"]:""; 
$POLIZA_NUMERO = isset($_POST["POLIZA_NUMERO"])?$_POST["POLIZA_NUMERO"]:""; 
$NOMBRE_DEL_EJECUTIVO = isset($_POST["NOMBRE_DEL_EJECUTIVO"])?$_POST["NOMBRE_DEL_EJECUTIVO"]:""; 
$NOMBRE_DEL_AYUDO = isset($_POST["NOMBRE_DEL_AYUDO"])?$_POST["NOMBRE_DEL_AYUDO"]:""; 
$OBSERVACIONES_1 = isset($_POST["OBSERVACIONES_1"])?$_POST["OBSERVACIONES_1"]:""; 
$FECHA_DE_LLENADO = isset($_POST["FECHA_DE_LLENADO"])?$_POST["FECHA_DE_LLENADO"]:""; 
$hiddenpagoproveedores = isset($_POST["hiddenpagoproveedores"])?$_POST["hiddenpagoproveedores"]:""; 
$TIPO_CAMBIOP = isset($_POST["TIPO_CAMBIOP"])?$_POST["TIPO_CAMBIOP"]:""; 
$TOTAL_ENPESOS = isset($_POST["TOTAL_ENPESOS"])?$_POST["TOTAL_ENPESOS"]:""; 
$IMPUESTO_HOSPEDAJE = isset($_POST["IMPUESTO_HOSPEDAJE"])?$_POST["IMPUESTO_HOSPEDAJE"]:""; 
$BANCO_ORIGEN = isset($_POST["BANCO_ORIGEN"])?$_POST["BANCO_ORIGEN"]:"";
 
$ID_RELACIONADO = isset($_POST["ID_RELACIONADO"])?$_POST["ID_RELACIONADO"]:""; 
$IVA = isset($_POST["IVA_1"])?$_POST["IVA_1"]:""; 
$IEPS = isset($_POST["IEPS"])?$_POST["IEPS"]:""; 
$TImpuestosRetenidosIVA = isset($_POST["TImpuestosRetenidosIVA_4"])?$_POST["TImpuestosRetenidosIVA_4"]:""; 
$TImpuestosRetenidosISR = isset($_POST["TImpuestosRetenidosISR_4"])?$_POST["TImpuestosRetenidosISR_4"]:""; 
$descuentos = isset($_POST["descuentos_4"])?$_POST["descuentos_4"]:""; 

$UUID = isset($_POST["UUID"])?trim($_POST["UUID"]):""; 
$metodoDePago = isset($_POST["metodoDePago"])?trim($_POST["metodoDePago"]):""; 
$totalf = isset($_POST["totalf"])?trim($_POST["totalf"]):""; 
$serie = isset($_POST["serie"])?trim($_POST["serie"]):""; 
$folio = isset($_POST["folio"])?trim($_POST["folio"]):""; 
$regimenE = isset($_POST["regimenE"])?trim($_POST["regimenE"]):""; 
$UsoCFDI = isset($_POST["UsoCFDI"])?trim($_POST["UsoCFDI"]):""; 
$TImpuestosTrasladados = isset($_POST["TImpuestosTrasladados"])?trim($_POST["TImpuestosTrasladados"]):""; 
$TImpuestosRetenidos = isset($_POST["TImpuestosRetenidos"])?trim($_POST["TImpuestosRetenidos"]):""; 
$Version = isset($_POST["Version"])?trim($_POST["Version"]):""; 
$tipoDeComprobante = isset($_POST["tipoDeComprobante"])?trim($_POST["tipoDeComprobante"]):""; 
$condicionesDePago = isset($_POST["condicionesDePago"])?trim($_POST["condicionesDePago"]):""; 
$fechaTimbrado = isset($_POST["fechaTimbrado"])?trim($_POST["fechaTimbrado"]):""; 
$nombreR = isset($_POST["nombreR"])?trim($_POST["nombreR"]):""; 
$rfcR = isset($_POST["rfcR"])?trim($_POST["rfcR"]):""; 
$Moneda = isset($_POST["Moneda"])?trim($_POST["Moneda"]):""; 
$TipoCambio = isset($_POST["TipoCambio"])?trim($_POST["TipoCambio"]):""; 
$ValorUnitarioConcepto = isset($_POST["ValorUnitarioConcepto"])?trim($_POST["ValorUnitarioConcepto"]):""; 
$DescripcionConcepto = isset($_POST["DescripcionConcepto"])?trim($_POST["DescripcionConcepto"]):""; 
$ClaveUnidadConcepto = isset($_POST["ClaveUnidadConcepto"])?trim($_POST["ClaveUnidadConcepto"]):""; 
$ClaveProdServConcepto = isset($_POST["ClaveProdServConcepto"])?trim($_POST["ClaveProdServConcepto"]):""; 
$CantidadConcepto = isset($_POST["CantidadConcepto"])?trim($_POST["CantidadConcepto"]):""; 
$ImporteConcepto = isset($_POST["ImporteConcepto"])?trim($_POST["ImporteConcepto"]):"";
$UnidadConcepto = isset($_POST["UnidadConcepto"])?trim($_POST["UnidadConcepto"]):""; 
$TUA = isset($_POST["TUA"])?trim($_POST["TUA"]):""; 
$TuaTotalCargos = isset($_POST["TuaTotalCargos"])?trim($_POST["TuaTotalCargos"]):""; 
$DESCUENTO = isset($_POST["DESCUENTO"])?trim($_POST["DESCUENTO"]):""; 
$subTotal = isset($_POST["subTotal"])?trim($_POST["subTotal"]):""; 
$propina = isset($_POST["propina"])?trim($_POST["propina"]):"";

$IVAXML = isset($_POST["IVAXML"])?trim($_POST["IVAXML"]):"";
$IEPSXML = isset($_POST["IEPSXML"])?trim($_POST["IEPSXML"]):"";


if($_SESSION['num_evento']==true){
	$NUMERO_EVENTO = $_SESSION['num_evento'];
}
if($_POST['NUMERO_EVENTO']==true){
	$NUMERO_EVENTO = $_POST['NUMERO_EVENTO'];	
}

$per_page=intval($_POST["per_page"]);
	$campos="*";
	//Variables de paginación
	$page = (isset($_POST["page"]) && !empty($_POST["page"]))?$_POST["page"]:1;
	$adjacents  = 4; //espacio entre páginas después del número de adyacentes
	$offset = ($page - 1) * $per_page;
	
	$search=array(

"NUMERO_CONSECUTIVO_PROVEE"=>$NUMERO_CONSECUTIVO_PROVEE,
"NOMBRE_COMERCIAL"=>$NOMBRE_COMERCIAL,
"RAZON_SOCIAL"=>$RAZON_SOCIAL,
"RFC_PROVEEDOR"=>$RFC_PROVEEDOR,
"VIATICOSOPRO"=>$VIATICOSOPRO,
"NUMERO_EVENTO"=>$NUMERO_EVENTO,
"NOMBRE_EVENTO"=>$NOMBRE_EVENTO,
"MOTIVO_GASTO"=>$MOTIVO_GASTO,
"CONCEPTO_PROVEE"=>$CONCEPTO_PROVEE,
"MONTO_TOTAL_COTIZACION_ADEUDO"=>$MONTO_TOTAL_COTIZACION_ADEUDO,
"MONTO_FACTURA"=>$MONTO_FACTURA,
"MONTO_PROPINA"=>$MONTO_PROPINA,
"MONTO_DEPOSITAR"=>$MONTO_DEPOSITAR,
"TIPO_DE_MONEDA"=>$TIPO_DE_MONEDA,
"PFORMADE_PAGO"=>$PFORMADE_PAGO,

"FECHA_DE_PAGO"=>$FECHA_DE_PAGO,
"FECHA_DE_PAGO2a"=>$FECHA_DE_PAGO2a,

"FECHA_A_DEPOSITAR"=>$FECHA_A_DEPOSITAR,
"STATUS_DE_PAGO"=>$STATUS_DE_PAGO,
"ACTIVO_FIJO"=>$ACTIVO_FIJO,
"GASTO_FIJO"=>$GASTO_FIJO,
"PAGAR_CADA"=>$PAGAR_CADA,
"FECHA_PPAGO"=>$FECHA_PPAGO,
"FECHA_TPROGRAPAGO"=>$FECHA_TPROGRAPAGO,
"NUMERO_EVENTOFIJO"=>$NUMERO_EVENTOFIJO,
"CLASI_GENERAL"=>$CLASI_GENERAL,
"SUB_GENERAL"=>$SUB_GENERAL,
"MONTO_DEPOSITADO"=>$MONTO_DEPOSITADO,
"NUMERO_EVENTO1"=>$NUMERO_EVENTO1,
"CLASIFICACION_GENERAL"=>$CLASIFICACION_GENERAL,
"CLASIFICACION_ESPECIFICA"=>$CLASIFICACION_ESPECIFICA,
"PLACAS_VEHICULO"=>$PLACAS_VEHICULO,
"MONTO_DE_COMISION"=>$MONTO_DE_COMISION,
"POLIZA_NUMERO"=>$POLIZA_NUMERO,
"NOMBRE_DEL_EJECUTIVO"=>$NOMBRE_DEL_EJECUTIVO,
"NOMBRE_DEL_AYUDO"=>$NOMBRE_DEL_AYUDO,
"OBSERVACIONES_1"=>$OBSERVACIONES_1,
"FECHA_DE_LLENADO"=>$FECHA_DE_LLENADO,
"hiddenpagoproveedores"=>$hiddenpagoproveedores,
"TIPO_CAMBIOP"=>$TIPO_CAMBIOP,
"TOTAL_ENPESOS"=>$TOTAL_ENPESOS,
"IMPUESTO_HOSPEDAJE"=>$IMPUESTO_HOSPEDAJE,
"BANCO_ORIGEN"=>$BANCO_ORIGEN,
"TImpuestosRetenidosIVA"=>$TImpuestosRetenidosIVA,
"TImpuestosRetenidosISR"=>$TImpuestosRetenidosISR,
"descuentos"=>$descuentos,
"ID_RELACIONADO"=>$ID_RELACIONADO,
"IVA"=>$IVA,
"IEPS"=>$IEPS,
"STATUS_CHECKBOX"=>$STATUS_CHECKBOX,


"UUID"=>$UUID,
"totalf"=>$totalf,
"metodoDePago"=>$metodoDePago,
"serie"=>$serie,
"folio"=>$folio,
"regimenE"=>$regimenE,
"UsoCFDI"=>$UsoCFDI,
"TImpuestosTrasladados"=>$TImpuestosTrasladados,
"TImpuestosRetenidos"=>$TImpuestosRetenidos,
"Version"=>$Version,
"tipoDeComprobante"=>$tipoDeComprobante,
"condicionesDePago"=>$condicionesDePago,
"fechaTimbrado"=>$fechaTimbrado,
"nombreR"=>$nombreR,
"rfcR"=>$rfcR,
"MonedaF"=>$MonedaF,
"TipoCambio"=>$TipoCambio,
"ValorUnitarioConcepto"=>$ValorUnitarioConcepto,
"DescripcionConcepto"=>$DescripcionConcepto,
"ClaveUnidadConcepto"=>$ClaveUnidadConcepto,
"ClaveProdServConcepto"=>$ClaveProdServConcepto,
"CantidadConcepto"=>$CantidadConcepto,
"ImporteConcepto"=>$ImporteConcepto,
"UnidadConcepto"=>$UnidadConcepto,
"Moneda"=>$Moneda,
"TUA"=>$TUA,
"TuaTotalCargos"=>$TuaTotalCargos,
"DESCUENTO"=>$DESCUENTO,
"subTotal"=>$subTotal,
"propina"=>$propina,

"IVAXML"=>$IVAXML,
"IEPSXML"=>$IEPSXML,


 "per_page"=>$per_page,
	"query"=>$query,
	"offset"=>$offset);
	//consulta principal para recuperar los datos
	$datos=$database->getData($tables,$campos,$search);
	$countAll=$database->getCounter();
	$row = $countAll;
	
	if ($row>0){
		$numrows = $countAll;;
	} else {
		$numrows=0;
	}	
	$total_pages = ceil($numrows/$per_page);
	
	
	//Recorrer los datos recuperados
		?>


		<div class="clearfix">
			<?php 
				echo '<div class="hint-text">Mostrando '.$inicios.' al '.$finales.' de '.$numrows.' registros</div>';
				  
				require __ROOT6__."/pagination.php"; //include pagination class
				$pagination=new Pagination($page, $total_pages, $adjacents);
				echo $pagination->paginate();
			?>
        </div>
	<div class="table-responsive">
		<style>
    thead tr:first-child th {
        position: sticky;
        top: 0;
        background: #c9e8e8;
        z-index: 10;
    }

    thead tr:nth-child(2) td {
        position: sticky;
        top: 55px; /* Altura del primer encabezado */
        background: #e2f2f2;
        z-index: 9;
    }
</style>
<div style="max-height: 600px; overflow-y: auto;">
	 <table class="table table-striped table-bordered" >	
		<thead>
            <tr>
<th style="background:#c9e8e8"></th>
<th style="background:#c9e8e8">#</th>
>

<?php 
if($database->plantilla_filtro($nombreTabla,"ADJUNTAR_FACTURA_XML",$altaeventos,$DEPARTAMENTO)=="si"){ ?><th style="background:#c9e8e8;text-align:center">FACTURA XML</th>
<?php } ?><?php 
if($database->plantilla_filtro($nombreTabla,"ADJUNTAR_FACTURA_PDF",$altaeventos,$DEPARTAMENTO)=="si"){ ?><th style="background:#c9e8e8;text-align:center">FACTURA PDF</th>
<?php } ?><?php 
if($database->plantilla_filtro($nombreTabla,"NUMERO_CONSECUTIVO_PROVEE",$altaeventos,$DEPARTAMENTO)=="si"){ ?><th style="background:#c5f58c;text-align:center">NÚMERO CONSECUTIVO PROVEE<br><a style="color:red;font-size:11px">BUSCAR</a></th>
<?php } ?>

<?php 
if($database->plantilla_filtro($nombreTabla,"ID_RELACIONADO",$altaeventos,$DEPARTAMENTO)=="si"){ ?><th style="background:#c9e8e8;text-align:center">ID RELACIONADO A <br>ESTE VIÁTICO</th>
<?php } ?>

<?php 
if($database->plantilla_filtro($nombreTabla,"VIATICOSOPRO",$altaeventos,$DEPARTAMENTO)=="si"){ ?><th style="background:#c9e8e8;text-align:center">VIÁTICOS</th>
<?php } ?>


<?php 
if($database->plantilla_filtro($nombreTabla,"NOMBRE_COMERCIAL",$altaeventos,$DEPARTAMENTO)=="si"){ ?><th style="background:#c9e8e8;text-align:center">NOMBRE COMERCIAL</th>
<?php } ?><?php 
if($database->plantilla_filtro($nombreTabla,"RAZON_SOCIAL",$altaeventos,$DEPARTAMENTO)=="si"){ ?><th style="background:#c9e8e8;text-align:center">RAZON SOCIAL</th>
<?php } ?><?php 
if($database->plantilla_filtro($nombreTabla,"RFC_PROVEEDOR",$altaeventos,$DEPARTAMENTO)=="si"){ ?><th style="background:#c9e8e8;text-align:center">RFC PROVEEDOR</th>
<?php } ?><?php 
if($database->plantilla_filtro($nombreTabla,"NUMERO_EVENTO",$altaeventos,$DEPARTAMENTO)=="si"){ ?><th style="background:#c9e8e8;text-align:center">NUMERO EVENTO</th>
<?php } ?><?php 
if($database->plantilla_filtro($nombreTabla,"NOMBRE_EVENTO",$altaeventos,$DEPARTAMENTO)=="si"){ ?><th style="background:#c9e8e8;text-align:center">NOMBRE EVENTO</th>
<?php } ?><?php 
if($database->plantilla_filtro($nombreTabla,"MOTIVO_GASTO",$altaeventos,$DEPARTAMENTO)=="si"){ ?><th style="background:#c9e8e8;text-align:center">MOTIVO GASTO</th>
<?php } ?><?php 
if($database->plantilla_filtro($nombreTabla,"CONCEPTO_PROVEE",$altaeventos,$DEPARTAMENTO)=="si"){ ?><th style="background:#c9e8e8;text-align:center">CONCEPTO DE LA FACTURA</th>
<?php } ?><?php 
if($database->plantilla_filtro($nombreTabla,"MONTO_TOTAL_COTIZACION_ADEUDO",$altaeventos,$DEPARTAMENTO)=="si"){ ?><th style="background:#c9e8e8;text-align:center">MONTO TOTAL COTIZACIÓN ADEUDO</th>
<?php } ?><?php 
if($database->plantilla_filtro($nombreTabla,"MONTO_FACTURA",$altaeventos,$DEPARTAMENTO)=="si"){ ?><th style="background:#c9e8e8;text-align:center">SUB TOTAL</th>
<?php } ?>
<?php 
if($database->plantilla_filtro($nombreTabla,"MONTO_DEPOSITAR",$altaeventos,$DEPARTAMENTO)=="si"){ ?><th style="background:#c9e8e8;text-align:center">IVA</th>
<?php } ?>
<?php 
if($database->plantilla_filtro($nombreTabla,"TImpuestosRetenidosIVA",$altaeventos,$DEPARTAMENTO)=="si"){ ?><th style="background:#c9e8e8;text-align:center">IMPUESTOS RETENIDOS (IVA)</th>
<?php } ?>

<?php 
if($database->plantilla_filtro($nombreTabla,"TImpuestosRetenidosISR",$altaeventos,$DEPARTAMENTO)=="si"){ ?><th style="background:#c9e8e8;text-align:center">IMPUESTOS RETENIDOS (ISR)</th>
<?php } ?>
<?php 
if($database->plantilla_filtro($nombreTabla,"MONTO_PROPINA",$altaeventos,$DEPARTAMENTO)=="si"){ ?><th style="background:#c9e8e8;text-align:center">MONTO PROPINA</th>
<?php } ?>
<?php 
if($database->plantilla_filtro($nombreTabla,"IMPUESTO_HOSPEDAJE",$altaeventos,$DEPARTAMENTO)=="si"){ ?><th style="background:#c9e8e8"> IMPUESTO SOBRE HOSPEDAJE MÁS<br> EL IMPUESTO DE SANEAMIENTO</th>
<?php } ?>

<?php 
if($database->plantilla_filtro($nombreTabla,"descuentos",$altaeventos,$DEPARTAMENTO)=="si"){ ?><th style="background:#c9e8e8">DESCUENTO</th>
<?php } ?>

<?php 
if($database->plantilla_filtro($nombreTabla,"MONTO_DEPOSITAR",$altaeventos,$DEPARTAMENTO)=="si"){ ?><th style="background:#c9e8e8;text-align:center">TOTAL</th>
<?php } ?>


<?php 
if($database->plantilla_filtro($nombreTabla,"TIPO_DE_MONEDA",$altaeventos,$DEPARTAMENTO)=="si"){ ?><th style="background:#c9e8e8;text-align:center">TIPO DE MONEDA</th>
<?php } ?>

<?php 
if($database->plantilla_filtro($nombreTabla,"TIPO_CAMBIOP",$altaeventos,$DEPARTAMENTO)=="si"){ ?><th style="background:#c9e8e8">TIPO DE CAMBIO</th>
<?php } ?>
<?php 
if($database->plantilla_filtro($nombreTabla,"TOTAL_ENPESOS",$altaeventos,$DEPARTAMENTO)=="si"){ ?><th style="background:#c9e8e8">TOTAL DE LA CONVERSIÓN</th>
<?php } ?>

<?php 
if($database->plantilla_filtro($nombreTabla,"PFORMADE_PAGO",$altaeventos,$DEPARTAMENTO)=="si"){ ?><th style="background:#c9e8e8;text-align:center">FORMA DE PAGO</th>
<?php } ?>



<?php 
if($database->plantilla_filtro($nombreTabla,"FECHA_A_DEPOSITAR",$altaeventos,$DEPARTAMENTO)=="si"){ ?><th style="background:#f48a81;text-align:center">FECHA EFECTIVA DE PAGO</th>
<?php } ?><?php 
if($database->plantilla_filtro($nombreTabla,"STATUS_DE_PAGO",$altaeventos,$DEPARTAMENTO)=="si"){ ?><th style="background:#f48a81;text-align:center">STATUS DE PAGO</th>
<?php } ?>
<?php 
if($database->plantilla_filtro($nombreTabla,"COMPROBANTE_DE_DEVOLUCION",$altaeventos,$DEPARTAMENTO)=="si"){ ?><th style="background:#c9e8e8;text-align:center">COMPROBANTE DE DEVOLUCIÓN<br> DE DINERO</th>
<?php } ?>
<?php                                     
if($database->plantilla_filtro($nombreTabla,"ADJUNTAR_COTIZACION",$altaeventos,$DEPARTAMENTO)=="si"){ ?><th style="background:#c9e8e8;text-align:center"> COTIZACIÓN O REPORTE</th>
<?php } ?>

<?php                                     
if($database->plantilla_filtro($nombreTabla,"BANCO_ORIGEN",$altaeventos,$DEPARTAMENTO)=="si"){ ?><th style="background:#c9e8e8;text-align:center">INSTITUCIÓN BANCARIA</th>
<?php } ?>

<?php 
if($database->plantilla_filtro($nombreTabla,"NOMBRE_DEL_EJECUTIVO",$altaeventos,$DEPARTAMENTO)=="si"){ ?><th style="background:#c9e8e8;text-align:center">NOMBRE DEL EJECUTIVO</th>
<?php } ?><?php 
if($database->plantilla_filtro($nombreTabla,"NOMBRE_DEL_AYUDO",$altaeventos,$DEPARTAMENTO)=="si"){ ?><th style="background:#c9e8e8;text-align:center">NOMBRE DEL EJECUTIVO QUE<br> INGRESO ESTÁ FACTURA</th>
<?php } ?><?php 
if($database->plantilla_filtro($nombreTabla,"OBSERVACIONES_1",$altaeventos,$DEPARTAMENTO)=="si"){ ?><th style="background:#c9e8e8;text-align:center">OBSERVACIONES </th>
<?php } ?><?php 
if($database->plantilla_filtro($nombreTabla,"ADJUNTAR_ARCHIVO_1",$altaeventos,$DEPARTAMENTO)=="si"){ ?><th style="background:#c9e8e8;text-align:center">ARCHIVO RELACIONADO A ESTE GASTO:</th>
<?php } ?><?php 
if($database->plantilla_filtro($nombreTabla,"FECHA_DE_LLENADO",$altaeventos,$DEPARTAMENTO)=="si"){ ?><th style="background:#c9e8e8;text-align:center">FECHA DE LLENADO</th>
<?php } ?>









<?php /*INICIA copiar y PEGAR XML */ ?>
<?php 
if($database->plantilla_filtro($nombreTabla,"NOMBRE_RECEPTOR",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
<th style="background:#f9f3a1;text-align:center">NOMBRE RECEPTOR</th>
<?php } ?>
<?php 
if($database->plantilla_filtro($nombreTabla,"RFC_RECEPTOR",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
<th style="background:#f9f3a1;text-align:center">RFC RECEPTOR</th>
<?php } ?>
<?php 
if($database->plantilla_filtro($nombreTabla,"REGIMEN_FISCAL",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
<th style="background:#f9f3a1;text-align:center">REGÍMEN FISCAL</th>
<?php } ?>
<?php 
if($database->plantilla_filtro($nombreTabla,"UUID",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
<th style="background:#f9f3a1;text-align:center">UUID:</th>
<?php } ?>

<?php 
if($database->plantilla_filtro($nombreTabla,"FOLIO",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
<th style="background:#f9f3a1;text-align:center">FOLIO</th>
<?php } ?>

<?php 
if($database->plantilla_filtro($nombreTabla,"SERIE",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
<th style="background:#f9f3a1;text-align:center">SERIE</th>
<?php } ?>
<?php 
if($database->plantilla_filtro($nombreTabla,"CLAVE_UNIDAD",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
<th style="background:#f9f3a1;text-align:center">CLAVE DE UNIDAD:</th>
<?php } ?>
<?php 
if($database->plantilla_filtro($nombreTabla,"CANTIDAD",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
<th style="background:#f9f3a1;text-align:center">CANTIDAD</th>
<?php } ?>
<?php 
if($database->plantilla_filtro($nombreTabla,"CLAVE_PODUCTO",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
<th style="background:#f9f3a1;text-align:center">CLAVE DE PRODUCTO O SERVICIO</th>
<?php } ?>
<?php 
if($database->plantilla_filtro($nombreTabla,"DESCRIPCION",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
<th style="background:#f9f3a1;text-align:center">DESCRIPCIÓN</th>
<?php } ?>



<?php 
if($database->plantilla_filtro($nombreTabla,"MonedaF",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
<th style="background:#f9f3a1;text-align:center">MONEDA:</th>
<?php } ?>

<?php 
if($database->plantilla_filtro($nombreTabla,"TIPO_CAMBIO",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
<th style="background:#f9f3a1;text-align:center">TIPO DE CAMBIO:</th>
<?php } ?>



<?php 
if($database->plantilla_filtro($nombreTabla,"USO_CFDI",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
<th style="background:#f9f3a1;text-align:center">USO DE CFDI</th>
<?php } ?>
<?php 
if($database->plantilla_filtro($nombreTabla,"metodoDePago",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
<th style="background:#f9f3a1;text-align:center">METODO DE PAGO:</th>
<?php } ?>
<?php 
if($database->plantilla_filtro($nombreTabla,"CONDICIONES_PAGO",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
<th style="background:#f9f3a1;text-align:center">CONDICIONES DE PAGO:</th>
<?php } ?>
<?php 
if($database->plantilla_filtro($nombreTabla,"TIPO_COMPROBANTE",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
<th style="background:#f9f3a1;text-align:center">TIPO DE COMPROBANTE:</th>
<?php } ?>
<?php 
if($database->plantilla_filtro($nombreTabla,"VERSION",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
<th style="background:#f9f3a1;text-align:center">VERSIÓN:</th>
<?php } ?>

<?php 
if($database->plantilla_filtro($nombreTabla,"FECHA_TIMBRADO",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
<th style="background:#f9f3a1;text-align:center">FECHA DE TIMBRADO:</th>
<?php } ?>


<?php 
if($database->plantilla_filtro($nombreTabla,"subTotal",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
<th style="background:#f9f3a1;text-align:center">SUBTOTAL</th>
<?php } ?>

<?php 
if($database->plantilla_filtro($nombreTabla,"propina",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
<th style="background:#f9f3a1;text-align:center">SERVICIO, PROPINA,ISH Y SANAMIENTO</th>
<?php } ?>

<?php 
if($database->plantilla_filtro($nombreTabla,"DESCUENTO",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
<th style="background:#f9f3a1;text-align:center">DESCUENTO</th>
<?php } ?>



<?php 
if($database->plantilla_filtro($nombreTabla,"TOTAL_IMPUESTOS_TRASLADADOS",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
<th style="background:#f9f3a1;text-align:center">IVA</th>
<?php } ?>
<?php 
if($database->plantilla_filtro($nombreTabla,"IEPSXML",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
<th style="background:#f9f3a1;text-align:center">IEPS</th>
<?php } ?>
<?php 
if($database->plantilla_filtro($nombreTabla,"TOTAL_IMPUESTOS_RETENIDOS",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
<th style="background:#f9f3a1;text-align:center">TOTAL DE IMPUESTOS RETENIDOS</th>
<?php } ?>

<th style="background:#f9f3a1;text-align:center">TUA:</th>

<?php 
if($database->plantilla_filtro($nombreTabla,"total",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
<th style="background:#f9f3a1;text-align:center">TOTAL:</th>
<?php } ?>





<th style="background:#f16c4f;text-align:center">46% PERDIDA DE COSTO FISCAL</th>

<?php if($database->variablespermisos('','viaticosquitar','ver')=='si'){ ?>
<th style="background:#c6eaaa;text-align:center">SIN 46%</th>
<?php } ?>
<th style="background:#c9e8e8;text-align:center"></th>
<th style="background:#c9e8e8;text-align:center"></th>


            </tr>
            <tr>
<td style="background:#c9e8e8"></td>
<td style="background:#c9e8e8"></td>

<?php  
if($database->plantilla_filtro($nombreTabla,"ADJUNTAR_FACTURA_XML",$altaeventos,$DEPARTAMENTO)=="si"){ ?><td style="background:#c9e8e8;text-align:center"><input type="text" class="form-control" id="ADJUNTAR_FACTURA_XML" value="<?php
echo $ADJUNTAR_FACTURA_XML; ?>"></td>
<?php } ?>

<?php  
if($database->plantilla_filtro($nombreTabla,"ADJUNTAR_FACTURA_PDF",$altaeventos,$DEPARTAMENTO)=="si"){ ?><td style="background:#c9e8e8;text-align:center"><input type="text" class="form-control" id="ADJUNTAR_FACTURA_PDF" value="<?php
echo $ADJUNTAR_FACTURA_PDF; ?>"></td>
<?php } ?>

<?php if($database->plantilla_filtro($nombreTabla,"NUMERO_CONSECUTIVO_PROVEE",$altaeventos,$DEPARTAMENTO)=="si"){ ?><td style="background:#c5f58c"><input type="text" class="form-control" id="NUMERO_CONSECUTIVO_PROVEE_1" value="<?php 
echo $NUMERO_CONSECUTIVO_PROVEE; ?>"></td>
<?php } ?>

<?php if($database->plantilla_filtro($nombreTabla,"ID_RELACIONADO",$altaeventos,$DEPARTAMENTO)=="si"){ ?><td style="background:#c9e8e8"><input type="text" class="form-control" id="ID_RELACIONADO_1" value="<?php 
echo $ID_RELACIONADO; ?>"></td>
<?php } ?>


<?php if($database->plantilla_filtro($nombreTabla,"VIATICOSOPRO",$altaeventos,$DEPARTAMENTO)=="si"){ ?><td style="background:#c9e8e8"><input type="text" class="form-control" id="VIATICOSOPRO_1" value="<?php 
echo $VIATICOSOPRO; ?>"></td>
<?php } ?>
<?php  
if($database->plantilla_filtro($nombreTabla,"NOMBRE_COMERCIAL",$altaeventos,$DEPARTAMENTO)=="si"){ ?><td style="background:#c9e8e8"><input type="text" class="form-control" id="NOMBRE_COMERCIAL_1" value="<?php 
echo $NOMBRE_COMERCIAL; ?>"></td>
<?php } ?><?php  
if($database->plantilla_filtro($nombreTabla,"RAZON_SOCIAL",$altaeventos,$DEPARTAMENTO)=="si"){ ?><td style="background:#c9e8e8"><input type="text" class="form-control" id="RAZON_SOCIAL_1" value="<?php 
echo $RAZON_SOCIAL; ?>"></td>
<?php } ?><?php  
if($database->plantilla_filtro($nombreTabla,"RFC_PROVEEDOR",$altaeventos,$DEPARTAMENTO)=="si"){ ?><td style="background:#c9e8e8"><input type="text" class="form-control" id="RFC_PROVEEDOR_1" value="<?php 
echo $RFC_PROVEEDOR; ?>"></td>
<?php } ?><?php  
if($database->plantilla_filtro($nombreTabla,"NUMERO_EVENTO",$altaeventos,$DEPARTAMENTO)=="si"){ ?><td style="background:#c9e8e8"><input type="text" class="form-control" id="NUMERO_EVENTO_1" value="<?php 
echo $NUMERO_EVENTO; ?>"></td>
<?php } ?><?php  
if($database->plantilla_filtro($nombreTabla,"NOMBRE_EVENTO",$altaeventos,$DEPARTAMENTO)=="si"){ ?><td style="background:#c9e8e8"><input type="text" class="form-control" id="NOMBRE_EVENTO_1" value="<?php 
echo $NOMBRE_EVENTO; ?>"></td>
<?php } ?><?php  
if($database->plantilla_filtro($nombreTabla,"MOTIVO_GASTO",$altaeventos,$DEPARTAMENTO)=="si"){ ?><td style="background:#c9e8e8"><input type="text" class="form-control" id="MOTIVO_GASTO_1" value="<?php 
echo $MOTIVO_GASTO; ?>"></td>
<?php } ?><?php  
if($database->plantilla_filtro($nombreTabla,"CONCEPTO_PROVEE",$altaeventos,$DEPARTAMENTO)=="si"){ ?><td style="background:#c9e8e8"><input type="text" class="form-control" id="CONCEPTO_PROVEE_1" value="<?php 
echo $CONCEPTO_PROVEE; ?>"></td>
<?php } ?><?php  
if($database->plantilla_filtro($nombreTabla,"MONTO_TOTAL_COTIZACION_ADEUDO",$altaeventos,$DEPARTAMENTO)=="si"){ ?><td style="background:#c9e8e8"><input type="text" class="form-control" id="MONTO_TOTAL_COTIZACION_ADEUDO_1" value="<?php 
echo $MONTO_TOTAL_COTIZACION_ADEUDO; ?>"></td>
<?php } ?><?php  
if($database->plantilla_filtro($nombreTabla,"MONTO_FACTURA",$altaeventos,$DEPARTAMENTO)=="si"){ ?><td style="background:#c9e8e8"><input type="text" class="form-control" id="MONTO_FACTURA_1" value="<?php 
echo $MONTO_FACTURA; ?>"></td>
<?php } ?>
<?php  
if($database->plantilla_filtro($nombreTabla,"IVA",$altaeventos,$DEPARTAMENTO)=="si"){ ?><td style="background:#c9e8e8"><input type="text" class="form-control" id="IVA_1" value="<?php 
echo $IVA; ?>"></td>
<?php } ?>

<?php  
if($database->plantilla_filtro($nombreTabla,"TImpuestosRetenidosIVA",$altaeventos,$DEPARTAMENTO)=="si"){ ?><td style="background:#c9e8e8"><input type="text" class="form-control" id="TImpuestosRetenidosIVA_4" value="<?php 
echo $TImpuestosRetenidosIVA; ?>"></td>
<?php } ?>

<?php  
if($database->plantilla_filtro($nombreTabla,"TImpuestosRetenidosISR",$altaeventos,$DEPARTAMENTO)=="si"){ ?><td style="background:#c9e8e8"><input type="text" class="form-control" id="TImpuestosRetenidosISR_4" value="<?php 
echo $TImpuestosRetenidosISR; ?>"></td>
<?php } ?>


<?php  
if($database->plantilla_filtro($nombreTabla,"MONTO_PROPINA",$altaeventos,$DEPARTAMENTO)=="si"){ ?><td style="background:#c9e8e8"><input type="text" class="form-control" id="MONTO_PROPINA_1" value="<?php 
echo $MONTO_PROPINA; ?>"></td>
<?php } ?>

<?php  
if($database->plantilla_filtro($nombreTabla,"IMPUESTO_HOSPEDAJE",$altaeventos,$DEPARTAMENTO)=="si"){ ?><td style="background:#c9e8e8"><input type="text" class="form-control" id="IMPUESTO_HOSPEDAJE_1" value="<?php 
echo $IMPUESTO_HOSPEDAJE; ?>"></td>
<?php } ?>


<?php  
if($database->plantilla_filtro($nombreTabla,"descuentos",$altaeventos,$DEPARTAMENTO)=="si"){ ?><td style="background:#c9e8e8"><input type="text" class="form-control" id="descuentos_4" value="<?php 
echo $descuentos; ?>"></td>
<?php } ?>


<?php  
if($database->plantilla_filtro($nombreTabla,"MONTO_DEPOSITAR",$altaeventos,$DEPARTAMENTO)=="si"){ ?><td style="background:#c9e8e8"><input type="text" class="form-control" id="MONTO_DEPOSITAR_1" value="<?php 
echo $MONTO_DEPOSITAR; ?>"></td>
<?php } ?>

<?php  
if($database->plantilla_filtro($nombreTabla,"TIPO_DE_MONEDA",$altaeventos,$DEPARTAMENTO)=="si"){ ?><td style="background:#c9e8e8"><input type="text" class="form-control" id="TIPO_DE_MONEDA_1" value="<?php 
echo $TIPO_DE_MONEDA; ?>"></td>
<?php } ?>

<?php  
if($database->plantilla_filtro($nombreTabla,"TIPO_CAMBIOP",$altaeventos,$DEPARTAMENTO)=="si"){ ?><td style="background:#c9e8e8"><input type="text" class="form-control" id="TIPO_CAMBIOP_1" value="<?php 
echo $TIPO_CAMBIOP; ?>"></td>
<?php } ?><?php  
if($database->plantilla_filtro($nombreTabla,"TOTAL_ENPESOS",$altaeventos,$DEPARTAMENTO)=="si"){ ?><td style="background:#c9e8e8"><input type="text" class="form-control" id="TOTAL_ENPESOS_1" value="<?php 
echo $TOTAL_ENPESOS; ?>"></td>
<?php } ?>

<?php  
if($database->plantilla_filtro($nombreTabla,"PFORMADE_PAGO",$altaeventos,$DEPARTAMENTO)=="si"){ ?><td style="background:#c9e8e8"><input type="text" class="form-control" id="PFORMADE_PAGO_1" value="<?php 
echo $PFORMADE_PAGO; ?>"></td>
<?php } ?>


<?php  
if($database->plantilla_filtro($nombreTabla,"FECHA_A_DEPOSITAR",$altaeventos,$DEPARTAMENTO)=="si"){ ?><td style="background:#f48a81"><input type="date" class="form-control" id="FECHA_A_DEPOSITAR_1" value="<?php 
echo $FECHA_A_DEPOSITAR; ?>"></td>
<?php } ?><?php  
if($database->plantilla_filtro($nombreTabla,"STATUS_DE_PAGO",$altaeventos,$DEPARTAMENTO)=="si"){ ?><td style="background:#f48a81"><input type="text" class="form-control" id="STATUS_DE_PAGO_1" value="<?php 
echo $STATUS_DE_PAGO; ?>"></td>
<?php } ?>
<?php  
if($database->plantilla_filtro($nombreTabla,"COMPROBANTE_DE_DEVOLUCION",$altaeventos,$DEPARTAMENTO)=="si"){ ?><td style="background:#c9e8e8;text-align:center"><input type="text" class="form-control" id="COMPROBANTE_DE_DEVOLUCION" value="<?php
echo $COMPROBANTE_DE_DEVOLUCION; ?>"></td>
<?php } ?>
<?php  
if($database->plantilla_filtro($nombreTabla,"ADJUNTAR_COTIZACION",$altaeventos,$DEPARTAMENTO)=="si"){ ?><td style="background:#c9e8e8;text-align:center"><input type="text" class="form-control" id="ADJUNTAR_COTIZACION" value="<?php
echo $ADJUNTAR_COTIZACION; ?>"></td>
<?php } ?>
<?php  
if($database->plantilla_filtro($nombreTabla,"BANCO_ORIGEN",$altaeventos,$DEPARTAMENTO)=="si"){ ?><td style="background:#c9e8e8;text-align:center"><input type="text" class="form-control" id="BANCO_ORIGEN_1" value="<?php
echo $BANCO_ORIGEN; ?>"></td>
<?php } ?>
<?php  
if($database->plantilla_filtro($nombreTabla,"NOMBRE_DEL_EJECUTIVO",$altaeventos,$DEPARTAMENTO)=="si"){ ?><td style="background:#c9e8e8"><input type="text" class="form-control" id="NOMBRE_DEL_EJECUTIVO_1" value="<?php 
echo $NOMBRE_DEL_EJECUTIVO; ?>"></td>
<?php } ?>

<?php  
if($database->plantilla_filtro($nombreTabla,"NOMBRE_DEL_AYUDO",$altaeventos,$DEPARTAMENTO)=="si"){ ?><td style="background:#c9e8e8"><input type="text" class="form-control" id="NOMBRE_DEL_AYUDO_1" value="<?php 
echo $NOMBRE_DEL_AYUDO; ?>"></td>
<?php } ?>

<?php  
if($database->plantilla_filtro($nombreTabla,"OBSERVACIONES_1",$altaeventos,$DEPARTAMENTO)=="si"){ ?><td style="background:#c9e8e8"><input type="text" class="form-control" id="OBSERVACIONES_1_1" value="<?php 
echo $OBSERVACIONES_1; ?>"></td>
<?php } ?>
<?php  
if($database->plantilla_filtro($nombreTabla,"ADJUNTAR_ARCHIVO_1",$altaeventos,$DEPARTAMENTO)=="si"){ ?><td style="background:#c9e8e8;text-align:center"><input type="text" class="form-control" id="ADJUNTAR_ARCHIVO_1" value="<?php
echo $ADJUNTAR_ARCHIVO_1; ?>"></td>
<?php } ?>

<?php  
if($database->plantilla_filtro($nombreTabla,"FECHA_DE_LLENADO",$altaeventos,$DEPARTAMENTO)=="si"){ ?><td style="background:#c9e8e8"><input type="date" class="form-control" id="FECHA_DE_LLENADO_1" value="<?php 
echo $FECHA_DE_LLENADO; ?>"></td>
<?php } ?>














<?php /*INICIA copiar y PEGAR XML*/ ?>
<?php  
if($database->plantilla_filtro($nombreTabla,"NOMBRE_RECEPTOR",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
<td style="background:#f9f3a1;text-align:center"><input type="text" class="form-control" id="nombreR" value="<?php
echo $nombreR; ?>"></td>
<?php } ?>
<?php  
if($database->plantilla_filtro($nombreTabla,"RFC_RECEPTOR",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
<td style="background:#f9f3a1;text-align:center"><input type="text" class="form-control" id="rfcR" value="<?php
echo $rfcR; ?>"></td>
<?php } ?>
<?php  
if($database->plantilla_filtro($nombreTabla,"REGIMEN_FISCAL",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
<td style="background:#f9f3a1;text-align:center"><input type="text" class="form-control" id="regimenE" value="<?php
echo $regimenE; ?>"></td>
<?php } ?>
<?php  
if($database->plantilla_filtro($nombreTabla,"UUID",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
<td style="background:#f9f3a1;text-align:center"><input type="text" class="form-control" id="UUID" value="<?php
echo $UUID; ?>"></td>
<?php } ?>
<?php  
if($database->plantilla_filtro($nombreTabla,"FOLIO",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
<td style="background:#f9f3a1;text-align:center"><input type="text" class="form-control" id="folio" value="<?php
echo $folio; ?>"></td>
<?php } ?>
<?php  
if($database->plantilla_filtro($nombreTabla,"SERIE",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
<td style="background:#f9f3a1;text-align:center"><input type="text" class="form-control" id="serie" value="<?php echo $serie; ?>"></td>
<?php } ?>
<?php  
if($database->plantilla_filtro($nombreTabla,"CLAVE_UNIDAD",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
<td style="background:#f9f3a1;text-align:center"><input type="text" class="form-control" id="ClaveUnidadConcepto" value="<?php
echo $ClaveUnidadConcepto; ?>"></td>
<?php } ?>
<?php  
if($database->plantilla_filtro($nombreTabla,"CANTIDAD",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
<td style="background:#f9f3a1;text-align:center"><input type="text" class="form-control" id="CantidadConcepto" value="<?php
echo $CantidadConcepto; ?>"></td>
<?php } ?>
<?php  
if($database->plantilla_filtro($nombreTabla,"CLAVE_PODUCTO",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
<td style="background:#f9f3a1;text-align:center"><input type="text" class="form-control" id="ClaveProdServConcepto" value="<?php
echo $ClaveProdServConcepto; ?>"></td>
<?php } ?>
<?php  
if($database->plantilla_filtro($nombreTabla,"DESCRIPCION ",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
<td style="background:#f9f3a1;text-align:center"><input type="text" class="form-control" id="DescripcionConcepto" value="<?php
echo $DescripcionConcepto ; ?>"></td>
<?php } ?>




<?php  
if($database->plantilla_filtro($nombreTabla,"MonedaF",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
<td style="background:#f9f3a1;text-align:center"><input type="text" class="form-control" id="Moneda" value="<?php
echo $Moneda; ?>"></td>
<?php } ?>


<?php  
if($database->plantilla_filtro($nombreTabla,"TIPO_CAMBIO",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
<td style="background:#f9f3a1;text-align:center"><input type="text" class="form-control" id="TipoCambio" value="<?php
echo $TipoCambio; ?>"></td>
<?php } ?>


<?php  
if($database->plantilla_filtro($nombreTabla,"USO_CFDI",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
<td style="background:#f9f3a1;text-align:center"><input type="text" class="form-control" id="UsoCFDI" value="<?php
echo $UsoCFDI; ?>"></td>
<?php } ?>
<?php  
if($database->plantilla_filtro($nombreTabla,"metodoDePago",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
<td style="background:#f9f3a1;text-align:center"><input type="text" class="form-control" id="metodoDePago" value="<?php
echo $metodoDePago; ?>"></td>
<?php } ?>
<?php  
if($database->plantilla_filtro($nombreTabla,"CONDICIONES_PAGO",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
<td style="background:#f9f3a1;text-align:center"><input type="text" class="form-control" id="condicionesDePago" value="<?php
echo $condicionesDePago; ?>"></td>
<?php } ?>
<?php  
if($database->plantilla_filtro($nombreTabla,"TIPO_COMPROBANTE",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
<td style="background:#f9f3a1;text-align:center"><input type="text" class="form-control" id="tipoDeComprobante" value="<?php
echo $tipoDeComprobante; ?>"></td>
<?php } ?>
<?php  
if($database->plantilla_filtro($nombreTabla,"VERSION",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
<td style="background:#f9f3a1;text-align:center"><input type="text" class="form-control" id="Version" value="<?php
echo $Version; ?>"></td>
<?php } ?>





<?php  
if($database->plantilla_filtro($nombreTabla,"FECHA_TIMBRADO",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
<td style="background:#f9f3a1;text-align:center"><input type="text" class="form-control" id="fechaTimbrado" value="<?php
echo $fechaTimbrado; ?>"></td>
<?php } ?>




<?php  
if($database->plantilla_filtro($nombreTabla,"SUBTOTAL",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
<td style="background:#f9f3a1;text-align:center"><input type="text" class="form-control" id="subTotal" value="<?php
echo $subTotal; ?>"></td>
<?php } ?>

<?php  
if($database->plantilla_filtro($nombreTabla,"propina",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
<td style="background:#f9f3a1;text-align:center"><input type="text" class="form-control" id="propina" value="<?php
echo $propina; ?>"></td>
<?php } ?>

<?php  
if($database->plantilla_filtro($nombreTabla,"DESCUENTO",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
<td style="background:#f9f3a1;text-align:center"><input type="text" class="form-control" id="DESCUENTO" value="<?php
echo $DESCUENTO; ?>"></td>
<?php } ?>


<?php  
if($database->plantilla_filtro($nombreTabla,"TOTAL_IMPUESTOS_TRASLADADOS",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
<td style="background:#f9f3a1;text-align:center"><input type="text" class="form-control" id="TImpuestosTrasladados" value="<?php
echo $TImpuestosTrasladados; ?>"></td>
<?php } ?>

<?php  
if($database->plantilla_filtro($nombreTabla,"IEPSXML",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
<td style="background:#f9f3a1;text-align:center"><input type="text" class="form-control" id="IEPSXML" value="<?php
echo $IEPSXML; ?>"></td>
<?php } ?>


<?php  
if($database->plantilla_filtro($nombreTabla,"TOTAL_IMPUESTOS_RETENIDOS",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
<td style="background:#f9f3a1;text-align:center"><input type="text" class="form-control" id="TImpuestosRetenidos" value="<?php
echo $TImpuestosRetenidos; ?>"></td>
<?php } ?>

<td style="background:#f9f3a1;text-align:center"><input type="text" class="form-control" id="TUA" value="<?php
echo $TUA; ?>"></td>

<?php  
if($database->plantilla_filtro($nombreTabla,"total",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
<td style="background:#f9f3a1;text-align:center"><input type="text" class="form-control" id="totalf" value="<?php echo $totalf; ?>"></td>
<?php } ?>







<td style="background:#f16c4f;text-align:center"><input type="text" class="form-control" id="PorfaltaDeFactura" value="<?php echo $PorfaltaDeFactura; ?>"></td>

<?php if($database->variablespermisos('','viaticosquitar','ver')=='si'){ ?>
<td style="background:#c6eaaa;text-align:center"></td>
<?php } ?>




<?php 

		foreach ($datos as $key=>$row){
			/*el ID_RELACIONADO me regresa quien es papá e hijo*/
			if($row['ID_RELACIONADO']==''){
				if ($row['subTotal'] > 0) {
					$SUBTOL2i += $row['subTotal'];
				} ELSE{
					$SUBTOL2i += $row['MONTO_FACTURA'];
				}			
			}else{
				if ($row['subTotal'] > 0) {
					$SUBTOL2g += $row['subTotal'];
				} ELSE{
					$SUBTOL2g += $row['MONTO_FACTURA'];
				}				
			}
			if($row['ID_RELACIONADO']==''){
				if ($row['MONTO_PROPINA'] + $row['IMPUESTO_HOSPEDAJE'] > 0) {
					$propina12i += $row['MONTO_PROPINA'] + $row['IMPUESTO_HOSPEDAJE'];
				}				
			}else{
				if ($row['MONTO_PROPINA'] + $row['IMPUESTO_HOSPEDAJE'] > 0) {
					$propina12g += $row['MONTO_PROPINA'] + $row['IMPUESTO_HOSPEDAJE'];
				}				
			}
			if($row['ID_RELACIONADO']==''){
				if ($row['DESCUENTO'] > 0) {
					$DESCUENTO12i += $row['DESCUENTO'];
				}				
			}else{
				if ($row['DESCUENTO'] > 0) {
					$DESCUENTO12g += $row['DESCUENTO'];
				}				
			}

			if($row['ID_RELACIONADO']==''){
				if ($row['IEPS'] > 0) {
					$IEPSXML12i += $row['IEPS'];
				}				
			}else{
				if ($row['IEPS'] > 0) {
					$IEPSXML12g += $row['IEPS'];
				}				
			}
			if($row['ID_RELACIONADO']==''){
				if ($row['IEPS'] > 0) {
					$IEPSXML12i += $row['IEPS'];
				}				
			}else{
				if ($row['IEPS'] > 0) {
					$IEPSXML12g += $row['IEPS'];
				}				
			}
			if($row['ID_RELACIONADO']==''){
				if ($row['TImpuestosRetenidos'] > 0) {
					$TImpuestosRetenidos12i += $row['TImpuestosRetenidos'];
				}				
			}else{
				if ($row['TImpuestosRetenidos'] > 0) {
					$TImpuestosRetenidos12g += $row['TImpuestosRetenidos'];
				}				
			}
			if($row['ID_RELACIONADO']==''){
				if ($row['TUA'] > 0) {
					$TUA12i += $row['TUA'];
				}				
			}else{
				if ($row['TUA'] > 0) {
					$TUA12g += $row['TUA'];
				}				
			}
			if($row['ID_RELACIONADO']==''){
				if ($row['TUA'] > 0) {
					$TUA12i += $row['TUA'];
				}				
			}else{
				if ($row['TUA'] > 0) {
					$TUA12g += $row['TUA'];
				}				
			}

			if($row['ID_RELACIONADO']==''){
				if ($row['totalf'] > 0) {
					$totalf12i += $row['totalf'];
				} ELSE{
					$totalf12i += $row['MONTO_DEPOSITAR'];
				}				
			}else{
				if ($row['totalf'] > 0) {
					$totalf12g += $row['totalf'];
				} ELSE{
					$totalf12g += $row['MONTO_DEPOSITAR'];
				}				
			}
			
			if($row['ID_RELACIONADO']==''){
				if ($row['IVA'] > 0) {
					$IVAXMLGTOTAL2i += $row['IVA'];
				} ELSE{
					$IVAXMLGTOTAL2i += $row['TImpuestosTrasladados'];
				}				
			}else{
				if ($row['IVA'] > 0) {
					$IVAXMLGTOTAL2g += $row['IVA'];
				} ELSE{
					$IVAXMLGTOTAL2g += $row['TImpuestosTrasladados'];
				}				
			}
	
		}			
if (
    (strlen(trim($row['UUID'])) < 1) && 
    (isset($row['STATUS_CHECKBOX']) && $row['STATUS_CHECKBOX'] == 'no')
) {
    $totalf12ii += $totalf12i * 1.46;
    $totalf12gg += $totalf12g * 1.46;
} else {
    $totalf12ii += $totalf12i;
    $totalf12gg += $totalf12g;
}



$PorfaltaDeFactura12ig = ($totalf12ii - $totalf12gg) ;

	

	
$PorfaltaDeFactura12igNEW = ($totalf12ii ) ;

$TUA12ig = $TUA12i - $TUA12g;
$TImpuestosRetenidos12ig = $TImpuestosRetenidos12i - $TImpuestosRetenidos12g;
$IEPSXML12ig = $IEPSXML12i - $IEPSXML12g;
$IVAXMLGTOTAL2ig = $IVAXMLGTOTAL2i - $IVAXMLGTOTAL2g;
$DESCUENTO12ig = $DESCUENTO12i - $DESCUENTO12g;
$totalf12if = $totalf12i - $totalf12g;		
$SUBTOL2ig = $SUBTOL2i - $SUBTOL2g ;
$propina12ig = $propina12i - $propina12g;
 ?>
	
		<td style="background:#c9e8e8"></td>
		<td style="background:#c9e8e8"></td>
            </tr>			
        </thead>
		<?php 	if ($numrows<0){ ?>
		</table>
		<?php }else{ ?>		
        <tbody>
<?php
$finales = 0;
$totales = 'no';

foreach ($datos as $key => $row) {
    $colspan = 0;
    $fondo_existe_xml = "";
    $fondo_existe_xml2 = "";
    
    // Si ID_RELACIONADO está vacío → AMARILLO (#fdfe87)
    if (empty($row['ID_RELACIONADO'])) {
        $fondo_existe_xml = "style='background-color: #fdfe87'"; 
        $fondo_existe_xml2 = "style='background-color: #fdfe87'"; 
    } 
    // Si ID_RELACIONADO está lleno → BLANCO
    else { 
        $fondo_existe_xml = "style='background-color: white'"; 
        $fondo_existe_xml2 = "style='background-color: white'"; 
    }
?>
<tr <?php echo $fondo_existe_xml2; ?>>
<td>
    <input type="checkbox" 
           class="checkbox"
           data-id="<?php echo $row['02SUBETUFACTURAid']; ?>" 
           style="transform: scale(1.1); cursor: pointer;" 
           onchange="
               const fila = this.closest('tr');
               const id = this.getAttribute('data-id');
               if (this.checked) {
                   fila.style.filter = 'brightness(65%) sepia(100%) saturate(500%) hue-rotate(0deg)';
                   localStorage.setItem('checkbox_' + id, 'checked');
               } else {
                   fila.style.filter = 'none';
                   localStorage.removeItem('checkbox_' + id);
               }">
</td>
    <td <?php echo $fondo_existe_xml; ?>>
        <?php echo $row['02SUBETUFACTURAid']; $colspan += 1; ?>
    </td>

<?php
                                                               
 
	
	$ADJUNTAR_FACTURA_PDF = '';$ADJUNTAR_FACTURA_XML='';$ADJUNTAR_COTIZACION='';$CONPROBANTE_TRANSFERENCIA='';$ADJUNTAR_ARCHIVO_1='';$COMPLEMENTOS_PAGO_PDF='';
   $COMPLEMENTOS_PAGO_XML='';$CANCELACIONES_PDF='';$CANCELACIONES_XML='';$ADJUNTAR_FACTURA_DE_COMISION_PDF='';$ADJUNTAR_FACTURA_DE_COMISION_XML='';$CALCULO_DE_COMISION='';
   $COMPROBANTE_DE_DEVOLUCION='';  $NOTA_DE_CREDITO_COMPRA='';$FOTO_ESTADO_PROVEE11='';$ADJUNTAR_ARCHIVO_1='';
	$querycontrasDOCTOS = $database->Listado_subefacturaDOCTOS($row['02SUBETUFACTURAid']);
	while($rowDOCTOS = mysqli_fetch_array($querycontrasDOCTOS))
	{
			//$ADJUNTAR_FACTURA_PDF = '';				
		if($rowDOCTOS["ADJUNTAR_FACTURA_PDF"]!=''){
			$ADJUNTAR_FACTURA_PDF .= '<a href="includes/archivos/'.$rowDOCTOS["ADJUNTAR_FACTURA_PDF"].'" target ="_blank">Ver!</a><br/>';
		}
		
		if($rowDOCTOS["ADJUNTAR_FACTURA_XML"]!=''){
			$ADJUNTAR_FACTURA_XML .= '<a href="includes/archivos/'.$rowDOCTOS["ADJUNTAR_FACTURA_XML"].'" target ="_blank">Ver!</a><br/>';
		}
		if($rowDOCTOS["ADJUNTAR_COTIZACION"]!=''){
			$ADJUNTAR_COTIZACION .= '<a href="includes/archivos/'.$rowDOCTOS["ADJUNTAR_COTIZACION"].'" target ="_blank">Ver!</a><br/>';
		}
		if($rowDOCTOS["CONPROBANTE_TRANSFERENCIA"]!=''){
			$CONPROBANTE_TRANSFERENCIA .= '<a href="includes/archivos/'.$rowDOCTOS["CONPROBANTE_TRANSFERENCIA"].'" target ="_blank">Ver!</a><br/>';
		}
      if($rowDOCTOS["COMPLEMENTOS_PAGO_PDF"]!=''){
			$COMPLEMENTOS_PAGO_PDF .= '<a href="includes/archivos/'.$rowDOCTOS["COMPLEMENTOS_PAGO_PDF"].'" target ="_blank">Ver!</a><br/>';
		}
      if($rowDOCTOS["COMPLEMENTOS_PAGO_XML"]!=''){
			$COMPLEMENTOS_PAGO_XML .= '<a href="includes/archivos/'.$rowDOCTOS["COMPLEMENTOS_PAGO_XML"].'" target ="_blank">Ver!</a><br/>';
		}
      if($rowDOCTOS["CANCELACIONES_PDF"]!=''){
			$CANCELACIONES_PDF .= '<a href="includes/archivos/'.$rowDOCTOS["CANCELACIONES_PDF"].'" target ="_blank">Ver!</a><br/>';
		}
      if($rowDOCTOS["CANCELACIONES_XML"]!=''){
			$CANCELACIONES_XML .= '<a href="includes/archivos/'.$rowDOCTOS["CANCELACIONES_XML"].'" target ="_blank">Ver!</a><br/>';
		}
      if($rowDOCTOS["ADJUNTAR_FACTURA_DE_COMISION_PDF"]!=''){
			$ADJUNTAR_FACTURA_DE_COMISION_PDF .= '<a href="includes/archivos/'.$rowDOCTOS["ADJUNTAR_FACTURA_DE_COMISION_PDF"].'" target ="_blank">Ver!</a><br/>';
		}
      if($rowDOCTOS["ADJUNTAR_FACTURA_DE_COMISION_XML"]!=''){
			$ADJUNTAR_FACTURA_DE_COMISION_XML .= '<a href="includes/archivos/'.$rowDOCTOS["ADJUNTAR_FACTURA_DE_COMISION_XML"].'" target ="_blank">Ver!</a><br/>';
		}
      if($rowDOCTOS["CALCULO_DE_COMISION"]!=''){
			$CALCULO_DE_COMISION .= '<a href="includes/archivos/'.$rowDOCTOS["CALCULO_DE_COMISION"].'" target ="_blank">Ver!</a><br/>';
		}
      if($rowDOCTOS["COMPROBANTE_DE_DEVOLUCION"]!=''){
			$COMPROBANTE_DE_DEVOLUCION .= '<a href="includes/archivos/'.$rowDOCTOS["COMPROBANTE_DE_DEVOLUCION"].'" target ="_blank">Ver!</a><br/>';
		}
      if($rowDOCTOS["NOTA_DE_CREDITO_COMPRA"]!=''){
			$NOTA_DE_CREDITO_COMPRA .= '<a href="includes/archivos/'.$rowDOCTOS["NOTA_DE_CREDITO_COMPRA"].'" target ="_blank">Ver!</a><br/>';
		}
      if($rowDOCTOS["FOTO_ESTADO_PROVEE11"]!=''){
			$FOTO_ESTADO_PROVEE11 .= '<a href="includes/archivos/'.$rowDOCTOS["FOTO_ESTADO_PROVEE11"].'" target ="_blank">Ver!</a><br/>';
		}
	
		if($rowDOCTOS["ADJUNTAR_ARCHIVO_1"]!=''){
			$ADJUNTAR_ARCHIVO_1 .= '<a href="includes/archivos/'.$rowDOCTOS["ADJUNTAR_ARCHIVO_1"].'" target ="_blank">Ver!</a><br/>';
		}

	}



?>




<?php /*inicia copiar y pegar iniciaA5*/ ?>
<!--<hr/><H1>FOREACH FILTRO .PHP A5</H1><BR/>-->
<?php  if($database->plantilla_filtro($nombreTabla,"ADJUNTAR_FACTURA_XML",$altaeventos,$DEPARTAMENTO)=="si"){ $colspan += 1; ?><td style="text-align:center"><?php echo $ADJUNTAR_FACTURA_XML; ?></td>
<?php } ?>

<?php  if($database->plantilla_filtro($nombreTabla,"ADJUNTAR_FACTURA_PDF",$altaeventos,$DEPARTAMENTO)=="si"){ $colspan += 1; ?><td style="text-align:center"><?php echo $ADJUNTAR_FACTURA_PDF; ?></td>
<?php } ?>

<?php  if($database->plantilla_filtro($nombreTabla,"NUMERO_CONSECUTIVO_PROVEE",$altaeventos,$DEPARTAMENTO)=="si"){ $colspan += 1; ?><td style="text-align:center"><?php echo $row['NUMERO_CONSECUTIVO_PROVEE'];?></td>
<?php } ?>


<?php  if($database->plantilla_filtro($nombreTabla,"ID_RELACIONADO",$altaeventos,$DEPARTAMENTO)=="si"){ $colspan += 1; ?><td style="text-align:center"><?php echo $row['ID_RELACIONADO'];?></td>
<?php } ?>


<?php  if($database->plantilla_filtro($nombreTabla,"VIATICOSOPRO",$altaeventos,$DEPARTAMENTO)=="si"){ $colspan += 1; ?><td style="text-align:center"><?php echo $row['VIATICOSOPRO'];?></td>
<?php } ?>
<?php  if($database->plantilla_filtro($nombreTabla,"NOMBRE_COMERCIAL",$altaeventos,$DEPARTAMENTO)=="si"){ $colspan += 1; ?><td style="text-align:center"><?php echo $row['NOMBRE_COMERCIAL'];?></td>
<?php } ?>
<?php  if($database->plantilla_filtro($nombreTabla,"RAZON_SOCIAL",$altaeventos,$DEPARTAMENTO)=="si"){ $colspan += 1; ?><td style="text-align:center"><?php echo $row['RAZON_SOCIAL'];?></td>
<?php } ?>
<?php  if($database->plantilla_filtro($nombreTabla,"RFC_PROVEEDOR",$altaeventos,$DEPARTAMENTO)=="si"){ $colspan += 1; ?><td style="text-align:center"><?php echo $row['RFC_PROVEEDOR'];?></td>
<?php } ?>
<?php  if($database->plantilla_filtro($nombreTabla,"NUMERO_EVENTO",$altaeventos,$DEPARTAMENTO)=="si"){ $colspan += 1; ?><td style="text-align:center"><?php echo $row['NUMERO_EVENTO'];?></td>
<?php } ?>
<?php  if($database->plantilla_filtro($nombreTabla,"NOMBRE_EVENTO",$altaeventos,$DEPARTAMENTO)=="si"){ $colspan += 1; ?><td style="text-align:center"><?php echo $row['NOMBRE_EVENTO'];?></td>
<?php } ?>
<?php  if($database->plantilla_filtro($nombreTabla,"MOTIVO_GASTO",$altaeventos,$DEPARTAMENTO)=="si"){  $colspan += 1;?><td style="text-align:center"><?php echo $row['MOTIVO_GASTO'];?></td>
<?php } ?>
<?php  if($database->plantilla_filtro($nombreTabla,"CONCEPTO_PROVEE",$altaeventos,$DEPARTAMENTO)=="si"){  $colspan += 1;?><td style="text-align:center"><?php echo $row['CONCEPTO_PROVEE'];?></td>
<?php } ?>

<?php $colspan2 = $colspan; ?>

<?php  if($database->plantilla_filtro($nombreTabla,"MONTO_TOTAL_COTIZACION_ADEUDO",$altaeventos,$DEPARTAMENTO)=="si"){ ?><td style="text-align:center">$<?php 
		$totales = 'si';
echo  number_format($row['MONTO_TOTAL_COTIZACION_ADEUDO'],2,'.',',');
$MONTO_TOTAL_COTIZACION_ADEUDO12 += $row['MONTO_TOTAL_COTIZACION_ADEUDO']; $colspan2 += 1;
?></td>
<?php } ?>


<?php  if($database->plantilla_filtro($nombreTabla,"MONTO_FACTURA",$altaeventos,$DEPARTAMENTO)=="si"){ ?><td style="text-align:center">$<?php
		$totales = 'si';
echo  number_format($row['MONTO_FACTURA'],2,'.',',');
$MONTO_FACTURA12 += $row['MONTO_FACTURA']; $colspan2 += 1;
?></td>
<?php } ?>

<?php  if($database->plantilla_filtro($nombreTabla,"IVA",$altaeventos,$DEPARTAMENTO)=="si"){ ?><td style="text-align:center">
$<?php 
		$totales = 'si';
echo  number_format($row['IVA'],2,'.',',');
$IVA12 += $row['IVA']; $colspan2 += 1;
?></td>
<?php } ?>


<?php  if($database->plantilla_filtro($nombreTabla,"TImpuestosRetenidosIVA",$altaeventos,$DEPARTAMENTO)=="si"){ ?><td style="text-align:center"><?php
		$totales = 'si';
echo number_format($row['TImpuestosRetenidosIVA'],2,'.',',');
$TImpuestosRetenidosIVA12 += $row['TImpuestosRetenidosIVA'];
 $colspan2 += 1;
?></td>
<?php } ?>

<?php  if($database->plantilla_filtro($nombreTabla,"TImpuestosRetenidosISR",$altaeventos,$DEPARTAMENTO)=="si"){ ?><td style="text-align:center"><?php
		$totales = 'si';
echo number_format($row['TImpuestosRetenidosISR'],2,'.',',');
$TImpuestosRetenidosISR12 += $row['TImpuestosRetenidosISR'];
 $colspan2 += 1;
?></td>
<?php } ?>




<?php  if($database->plantilla_filtro($nombreTabla,"MONTO_PROPINA",$altaeventos,$DEPARTAMENTO)=="si"){ ?><td style="text-align:center">$<?php
		$totales = 'si';
echo number_format($row['MONTO_PROPINA'],2,'.',',');
$MONTO_PROPINA12 += $row['MONTO_PROPINA'];
 $colspan2 += 1;
 ?></td>
<?php } ?>

<?php  if($database->plantilla_filtro($nombreTabla,"IMPUESTO_HOSPEDAJE",$altaeventos,$DEPARTAMENTO)=="si"){ ?><td style="text-align:center">$<?php 
echo  number_format($row['IMPUESTO_HOSPEDAJE'],2,'.',',');
		$totales = 'si';
		$IMPUESTO_HOSPEDAJE12 += $row['IMPUESTO_HOSPEDAJE'];
		$colspan2 += 1;
		
		$supropinamashospedaje = $row['MONTO_PROPINA'] + $row['IMPUESTO_HOSPEDAJE'];
		
		
?></td>
<?php } ?>


<?php  if($database->plantilla_filtro($nombreTabla,"descuentos",$altaeventos,$DEPARTAMENTO)=="si"){ ?><td style="text-align:center"><?php 
		$totales = 'si';
echo  number_format($row['descuentos'],2,'.',',');
$descuentos12 += $row['descuentos']; $colspan2 += 1;
?></td>
<?php } ?>



<?php  if($database->plantilla_filtro($nombreTabla,"MONTO_DEPOSITAR",$altaeventos,$DEPARTAMENTO)=="si"){ ?><td style="text-align:center">$<?php 
		$totales = 'si';
echo  number_format($row['MONTO_DEPOSITAR'],2,'.',',');
$MONTO_DEPOSITAR12 += $row['MONTO_DEPOSITAR']; $colspan2 += 1;
?></td>
<?php } ?>





<?php  if($database->plantilla_filtro($nombreTabla,"TIPO_DE_MONEDA",$altaeventos,$DEPARTAMENTO)=="si"){ ?><td style="text-align:center"><?php echo $row['TIPO_DE_MONEDA']; $colspan2 += 1;?></td>
<?php } ?>

<?php  if($database->plantilla_filtro($nombreTabla,"TIPO_CAMBIOP",$altaeventos,$DEPARTAMENTO)=="si"){ ?><td style="text-align:center">$<?php 
echo  number_format($row['TIPO_CAMBIOP'],2,'.',',');
		$totales = 'si';
		$TIPO_CAMBIOP12 += $row['TIPO_CAMBIOP'];
		$colspan2 += 1;
?></td>
<?php } ?>
<?php  if($database->plantilla_filtro($nombreTabla,"TOTAL_ENPESOS",$altaeventos,$DEPARTAMENTO)=="si"){ ?><td style="text-align:center">$<?php 
echo  number_format($row['TOTAL_ENPESOS'],2,'.',',');
		$totales = 'si';
		$TOTAL_ENPESOS12 += $row['TOTAL_ENPESOS'];
		$colspan2 += 1;
?></td>
<?php } ?>


<?php  if($database->plantilla_filtro($nombreTabla,"PFORMADE_PAGO",$altaeventos,$DEPARTAMENTO)=="si"){ ?><td style="text-align:center"><?php echo $row['PFORMADE_PAGO']; $colspan2 += 1;?></td>
<?php } ?>

<?php  if($database->plantilla_filtro($nombreTabla,"FECHA_A_DEPOSITAR",$altaeventos,$DEPARTAMENTO)=="si"){ ?><td style="text-align:center"><?php echo $row['FECHA_A_DEPOSITAR']; $colspan2 += 1;?></td>
<?php } ?>
<?php  if($database->plantilla_filtro($nombreTabla,"STATUS_DE_PAGO",$altaeventos,$DEPARTAMENTO)=="si"){ ?><td style="text-align:center"><?php echo $row['STATUS_DE_PAGO']; $colspan2 += 1;?></td>
<?php } ?>2
<?php  if($database->plantilla_filtro($nombreTabla,"COMPROBANTE_DE_DEVOLUCION",$altaeventos,$DEPARTAMENTO)=="si"){ ?><td style="text-align:center"><?php echo $COMPROBANTE_DE_DEVOLUCION;
 $colspan2 += 1;
 ?></td>
<?php } ?>
<?php  if($database->plantilla_filtro($nombreTabla,"ADJUNTAR_COTIZACION",$altaeventos,$DEPARTAMENTO)=="si"){ ?><td style="text-align:center"><?php echo $ADJUNTAR_COTIZACION;  $colspan2 += 1;?></td>
<?php } ?>

<?php  if($database->plantilla_filtro($nombreTabla,"BANCO_ORIGEN",$altaeventos,$DEPARTAMENTO)=="si"){ ?><td style="text-align:center"><?php echo $row['BANCO_ORIGEN']; $colspan2 += 1;?></td>
<?php } ?>

<?php  if($database->plantilla_filtro($nombreTabla,"NOMBRE_DEL_EJECUTIVO",$altaeventos,$DEPARTAMENTO)=="si"){ ?><td style="text-align:center"><?php echo $row['NOMBRE_DEL_EJECUTIVO']; $colspan2 += 1;?></td>
<?php } ?>
<?php  if($database->plantilla_filtro($nombreTabla,"NOMBRE_DEL_AYUDO",$altaeventos,$DEPARTAMENTO)=="si"){ ?><td style="text-align:center"><?php echo $row['NOMBRE_DEL_AYUDO']; $colspan2 += 1;?></td>
<?php } ?>
<?php  if($database->plantilla_filtro($nombreTabla,"OBSERVACIONES_1",$altaeventos,$DEPARTAMENTO)=="si"){ ?><td style="text-align:center"><?php echo $row['OBSERVACIONES_1']; $colspan2 += 1;?></td>
<?php } ?>
<?php  if($database->plantilla_filtro($nombreTabla,"ADJUNTAR_ARCHIVO_1",$altaeventos,$DEPARTAMENTO)=="si"){ ?><td style="text-align:center"><?php echo $ADJUNTAR_ARCHIVO_1;  $colspan2 += 1;?></td>
<?php } ?>
<?php  if($database->plantilla_filtro($nombreTabla,"FECHA_DE_LLENADO",$altaeventos,$DEPARTAMENTO)=="si"){ ?><td style="text-align:center"><?php echo $row['FECHA_DE_LLENADO']; $colspan2 += 1;?></td>
<?php } ?>
















<?php /*INICIA copiar y PEGAR XML*/ ?>
<?php  if($database->plantilla_filtro($nombreTabla,"NOMBRE_RECEPTOR",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
    <td style="text-align:center"><?php echo $row['nombreR'];
	 $colspan2 += 1;
	 ?></td>
<?php } ?>
<?php  if($database->plantilla_filtro($nombreTabla,"RFC_RECEPTOR",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
    <td style="text-align:center"><?php echo $row['rfcR'];
	 $colspan2 += 1;
	 ?></td>
<?php } ?>
<?php  if($database->plantilla_filtro($nombreTabla,"REGIMEN_FISCAL",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
    <td style="text-align:center"><?php echo $row['regimenE'];
	 $colspan2 += 1;
	 ?></td>
<?php } ?>
<?php  if($database->plantilla_filtro($nombreTabla,"UUID",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
    <td style="text-align:center"><?php echo $row['UUID'];
	 $colspan2 += 1;
	 ?></td>
<?php } ?>
<?php  if($database->plantilla_filtro($nombreTabla,"FOLIO",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
    <td style="text-align:center"><?php  echo $row['folio'];
	 $colspan2 += 1;
	 ?></td>
<?php } ?>
<?php  if($database->plantilla_filtro($nombreTabla,"SERIE",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
    <td style="text-align:center"><?php echo $row['serie'];
	 $colspan2 += 1;
	 ?></td>
<?php } ?>


<?php  if($database->plantilla_filtro($nombreTabla,"CLAVE_UNIDAD",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
    <td style="text-align:center"><?php echo $row['ClaveUnidadConcepto'];
	 $colspan2 += 1;
	 ?></td>
<?php } ?>


<?php  if($database->plantilla_filtro($nombreTabla,"CANTIDAD",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
    <td style="text-align:center"><?php echo number_format($row['CantidadConcepto'],2,'.',',');
	 $colspan2 += 1;
	 ?></td>
<?php } ?>


<?php  if($database->plantilla_filtro($nombreTabla,"CLAVE_PODUCTO",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
    <td style="text-align:center"><?php echo $row['ClaveProdServConcepto'];
	 $colspan2 += 1;
	 ?></td>
<?php } ?>


<?php  if($database->plantilla_filtro($nombreTabla,"DESCRIPCION",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
    <td style="text-align:center"><?php echo ''. $row['DescripcionConcepto'];
 $colspan2 += 1;
 ?></td>
<?php } ?>


<?php  if($database->plantilla_filtro($nombreTabla,"MonedaF",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
    <td style="text-align:center"><?php echo $row['Moneda']; $colspan2 += 1;?></td>
<?php } ?>

<?php  if($database->plantilla_filtro($nombreTabla,"TIPO_CAMBIO",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
    <td style="text-align:center"><?php echo number_format($row['TipoCambio'],2,'.',','); $colspan2 += 1;?></td>
<?php } ?>

<?php  if($database->plantilla_filtro($nombreTabla,"USO_CFDI",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
    <td style="text-align:center"><?php echo $row['UsoCFDI']; $colspan2 += 1;?></td>
<?php } ?>
<?php  if($database->plantilla_filtro($nombreTabla,"metodoDePago",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
    <td style="text-align:center"><?php  echo $row['metodoDePago']; $colspan2 += 1;?></td>
<?php } ?>
<?php  if($database->plantilla_filtro($nombreTabla,"CONDICIONES_PAGO",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
    <td style="text-align:center"><?php  echo $row['condicionesDePago']; $colspan2 += 1;?></td>
<?php } ?>
<?php  if($database->plantilla_filtro($nombreTabla,"TIPO_COMPROBANTE",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
    <td style="text-align:center"><?php echo $row['tipoDeComprobante']; $colspan2 += 1;?></td>
<?php } ?>
<?php  if($database->plantilla_filtro($nombreTabla,"VERSION",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
    <td style="text-align:center"><?php echo $row['Version']; $colspan2 += 1;?></td>
<?php } ?>

<?php  if($database->plantilla_filtro($nombreTabla,"FECHA_TIMBRADO",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
    <td style="text-align:center"><?php echo $row['fechaTimbrado']; $colspan2 += 1;?></td>
<?php } ?>



<?php  if($database->plantilla_filtro($nombreTabla,"SUBTOTAL",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
    <td style="text-align:center">$<?php 

$subTotal123 = isset($row['subTotal'])?$row['subTotal']:'' ;
$MONTO_FACTURA123 = isset($row['MONTO_FACTURA'])?$row['MONTO_FACTURA']:'' ;

if ($subTotal123 > 0) {
    $SUBTOL = number_format($subTotal123, 2, '.', ',');
    $SUBTOL2 = ($subTotal123);
 
} ELSE{

    $SUBTOL = number_format($MONTO_FACTURA123, 2, '.', ',');
    $SUBTOL2 = ($MONTO_FACTURA123);
} 

$SUBTOTALG +=$SUBTOL2;
echo $SUBTOL;
	
	
	$totales2 = 'si';
	



	?></td>
<?php } ?>

<?php  if($database->plantilla_filtro($nombreTabla,"propina",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
    <td style="text-align:center">$<?php 
	echo number_format($row['propina'] + $supropinamashospedaje ,2,'.',',');
	$propina12 += $row['propina']+ $supropinamashospedaje ;
	$totales2 = 'si';
	 ?></td>
<?php } ?> 

<?php  if($database->plantilla_filtro($nombreTabla,"DESCUENTO",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
    <td style="text-align:center">$<?php 
	echo number_format($row['DESCUENTO'],2,'.',',');
	$DESCUENTO12 += $row['DESCUENTO'];
	$totales2 = 'si';
	 ?></td>
<?php } ?>

<?php  /*if($database->plantilla_filtro($nombreTabla,"TOTAL_IMPUESTOS_TRASLADADOS",$altaeventos,$DEPARTAMENTO)=="si"){*/ ?>
    <td style="text-align:center">$<?php 

//$IVAXML = '';
$TImpuestosTrasladados123 = isset($row['TImpuestosTrasladados'])?$row['TImpuestosTrasladados']:'' ;
$IVA123 = isset($row['IVA'])?$row['IVA']:'' ;

if ($TImpuestosTrasladados123 > 0) {
    $IVAXML = number_format($TImpuestosTrasladados123, 2, '.', ',');
    $IVAXML2 = ($TImpuestosTrasladados123);
    //$IVAXMLqq = $TImpuestosTrasladados123;
} ELSE{
   // $IVAXMLqq = $IVA123;
    $IVAXML = number_format($IVA123, 2, '.', ',');
    $IVAXML2 = ($IVA123);
} 

$IVAXMLGTOTAL2 +=$IVAXML2;
echo $IVAXML;
	
	
	$totales2 = 'si';
	
	
	?></td>
<?php /*}*/ ?>


<?php  if($database->plantilla_filtro($nombreTabla,"IEPS",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
    <td style="text-align:center">$<?php 
	echo number_format($row['IEPS'],2,'.',',');
	$IEPSXML12 += $row['IEPS'];
	$totales2 = 'si';
	?></td>
<?php } ?>

<?php  if($database->plantilla_filtro($nombreTabla,"TOTAL_IMPUESTOS_RETENIDOS",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
    <td style="text-align:center">$<?php echo number_format($row['TImpuestosRetenidos'],2,'.',',');
	$TImpuestosRetenidos12 += $row['TImpuestosRetenidos'];
	$totales2 = 'si';
	?></td>
<?php } ?>

<?php  if($database->plantilla_filtro($nombreTabla,"TUA",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
    <td style="text-align:center"><?php echo  number_format($row['TUA'],2,'.',',');
	$TUA12 += $row['TUA'];
	$TUA2 = 'si';
	?></td>
<?php } ?>



   <td style="text-align:center" id="montoOriginal_<?php echo $row['02SUBETUFACTURAid']; ?>"><?php 

$total123 = isset($row['totalf'])?$row['totalf']:'' ;
$MONTO_DEPOSITAR123 = isset($row['MONTO_DEPOSITAR'])?$row['MONTO_DEPOSITAR']:'' ;

if ($total123 > 0) {
    $porfalta = number_format($total123, 2, '.', ',');
    $porfalta2 = $total123 + $supropinamashospedaje;
    
} ELSE{
   // $IVAXMLqq = $IVA123;
    $porfalta = number_format($MONTO_DEPOSITAR123, 2, '.', ',');
    $porfalta2 = ($MONTO_DEPOSITAR123);
} 

$totalf12  +=$porfalta2;
echo $porfalta;
	
$totales2 = 'si';
	
		
	
	?></td>

<td style="text-align:center; background-color: <?php echo ($row['ID_RELACIONADO'] == '') ? '#00FF00' : 'transparent'; ?>" id="valorCalculado_<?php echo $row['02SUBETUFACTURAid']; ?>"> 
<?php 
    if (strlen($row['UUID']) < 1) {
        if ($row['ID_RELACIONADO'] == '') {
            echo number_format((float)$PorfaltaDeFactura12ig, 2, '.', ',');        
        } else {
            if (!empty($COMPROBANTE_DE_DEVOLUCION)) {
                echo '<span style="color: red;">Devolución</span>';
            } else {
                if ($row['STATUS_CHECKBOX'] === 'no' || $row['STATUS_CHECKBOX'] === NULL) {
                    echo number_format((float)$porfalta2 * 1.46, 2, '.', ',');
                } else {
                    echo ""; 
                }
            }
        }
    }
?>
</td>
   

<?php if($database->variablespermisos('','viaticosquitar','ver')=='si'){ ?>
<td style="text-align:center; background:<?php 
    if(strlen($row['UUID']) < 1) {
        if($row["STATUS_CHECKBOX"]=='si') { 
            echo '#ceffcc'; 
        } else { 
            echo '#e9d8ee'; 
        }
    } else {
        echo '#f0f0f0'; 
    }
?>" id="color_CHECKBOX<?php echo $row["02SUBETUFACTURAid"]; ?>">
    <span id="buscanumero<?php echo $row["02SUBETUFACTURAid"]; ?>">
        <?php if(strlen($row['UUID']) < 1): ?>
            <?php
            // Verificar permiso de modificación
            $permiso_modificar = $database->variablespermisos('','viaticosquitar','modificar') == 'si';
            $disabled = ($row["STATUS_CHECKBOX"] == 'si' && !$permiso_modificar) ? 'disabled' : '';
            ?>
            
<input type="checkbox" style="width:30PX;" class="form-check-input" 
    id="STATUS_CHECKBOX<?php echo $row["02SUBETUFACTURAid"]; ?>"  
    name="STATUS_CHECKBOX<?php echo $row["02SUBETUFacturaid"]; ?>" 
    value="<?php echo $row["02SUBETUFACTURAid"]; ?>" 
    onclick="STATUS_CHECKBOX(<?php echo $row['02SUBETUFACTURAid']; ?>, <?php echo $permiso_modificar ? 'true' : 'false'; ?>)" 
    <?php if($row["STATUS_CHECKBOX"]=='si') echo "checked"; ?>
    <?php echo $disabled; ?>
/>
        <?php else: ?>
            <span style="color:#999;">CON XML </span>
        <?php endif; ?>
    </span>
</td>
<?php } ?>

<!-- Elemento para mostrar notificaciones -->
<div id="ajax-notification" style="position:fixed; top:20px; right:20px; padding:15px; background:#4CAF50; color:white; border-radius:5px; display:none; z-index:1000;"></div>



<?php

$SICOMPRO = ($row['STATUS_CHECKBOX'] == 'no');

$uuidVacio = empty($row['UUID']);
$uuidlleno = !empty($row['UUID']);
$ncplleno = !empty($row['NUMERO_CONSECUTIVO_PROVEE']);
$idlleno = !empty($row['ID_RELACIONADO']);
$idvacio = empty($row['ID_RELACIONADO']);
$comprobanteLleno = !empty($COMPROBANTE_DE_DEVOLUCION);
$comprobantevacio = empty($COMPROBANTE_DE_DEVOLUCION);


if ($uuidVacio && $idlleno && $SICOMPRO ) {
    $TOTALEE += $porfalta2;

    $PorfaltaDeFactura12 = $PorfaltaDeFactura12ig + ($TOTALEE * 1.46);
} 






?>




<?php


$SICOMPRO = ($row['STATUS_CHECKBOX'] == 'no');
$uuidVacio = empty($row['UUID']);
$uuidlleno = !empty($row['UUID']);
$ncplleno = !empty($row['NUMERO_CONSECUTIVO_PROVEE']);



if ($ncplleno && $uuidVacio && $SICOMPRO ) {
 
  
    $PorfaltaDeFactura123 =  $PorfaltaDeFactura12ig ;
      	
} 
    



?>




<?php /*termina copiar y terminaA5*/ ?>
<td  <?php echo $fondo_existe_xml; ?>>
<?php if($database->variablespermisos('','viaticos','modificar')=='si'){ ?>


<input type="button" name="view" value="MODIFICAR" id="<?php echo $row["02SUBETUFACTURAid"]; ?>" class="btn btn-info btn-xs view_dataPAGOPROVEEmodifica" /><?php } ?></td>
<td><?php if($database->variablespermisos('','viaticos','borrar')=='si'){ ?>


<input type="button" name="view2" value="BORRAR" id="<?php echo $row["02SUBETUFACTURAid"]; ?>" class="btn btn-info btn-xs view_dataSBborrar" /><?php } ?></td>			
		</tr>
			<?php
			$finales++;
		}	
	?>



<?php if($database->variablespermisos('','totales_VYO','ver')=='si'){ ?>
<tr>


<?php if($totales == 'si'){ ?>
<td style="text-align:right; padding-right:45px;" colspan="<?php echo $colspan; ?>" ><strong style="font-size:16px">TOTALES</strong></td>
<?php } ?>

<?php if($database->plantilla_filtro($nombreTabla,"MONTO_TOTAL_COTIZACION_ADEUDO",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
<td style="text-align:center"><strong style="font-size:16px">$<?php echo number_format($MONTO_TOTAL_COTIZACION_ADEUDO12,2,'.',','); ?></strong></td>
<?php } ?>

<?php if($database->plantilla_filtro($nombreTabla,"MONTO_FACTURA",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
<td style="text-align:center"><strong style="font-size:16px">$<?php echo number_format($MONTO_FACTURA12,2,'.',','); ?></strong></td>
<?php } ?>


<?php if($database->plantilla_filtro($nombreTabla,"IVA",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
<td style="text-align:center"><strong style="font-size:16px">$<?php  echo number_format($IVA12,2,'.',','); ?></strong></td>
<?php } ?>


<?php if($database->plantilla_filtro($nombreTabla,"TImpuestosRetenidosIVA",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
<td style="text-align:center"><strong style="font-size:16px">$<?php echo number_format($TImpuestosRetenidosIVA12,2,'.',','); ?></strong></td>
<?php } ?>
<?php if($database->plantilla_filtro($nombreTabla,"TImpuestosRetenidosISR",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
<td style="text-align:center"><strong style="font-size:16px">$<?php echo number_format($TImpuestosRetenidosISR12,2,'.',','); ?></strong></td>
<?php } ?>

<?php if($database->plantilla_filtro($nombreTabla,"MONTO_PROPINA",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
<td style="text-align:center"><strong style="font-size:16px">$<?php  echo number_format($MONTO_PROPINA12,2,'.',','); ?></strong></td>
<?php } ?>


<?php if($database->plantilla_filtro($nombreTabla,"IMPUESTO_HOSPEDAJE",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
<td style="text-align:center"><strong style="font-size:16px">$<?php  echo number_format($IMPUESTO_HOSPEDAJE12,2,'.',','); ?></strong></td>
<?php } ?>

<?php if($database->plantilla_filtro($nombreTabla,"descuentos",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
<td style="text-align:center"><strong style="font-size:16px">$<?php  echo number_format($descuentos12,2,'.',','); ?></strong></td>
<?php } ?>



<?php  if($database->plantilla_filtro($nombreTabla,"MONTO_DEPOSITAR",$altaeventos,$DEPARTAMENTO)=="si"){  ?>
<td style="text-align:center"><strong style="font-size:16px">$<?php echo number_format($MONTO_DEPOSITAR12,2,'.',','); ?></strong></td>
<?php } ?>


</tr>	
<?php } ?>



<?php if($NUMERO_CONSECUTIVO_PROVEE==''){
/*cuando no está filtrado*/
?>
<tr>	

<?php if($totales2 == 'si'){ ?>
<td style="text-align:right;padding-right:45px;" colspan="<?php echo $colspan2 +1; ?>"><strong style="font-size:16px;COLOR: #C70039 ">TOTALES POR COMPROBAR</strong></td>
<?php } ?>

<?php if($database->plantilla_filtro($nombreTabla,"SUBTOTAL",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
<td style="text-align:center"><strong style="font-size:16px">$<?php echo number_format($SUBTOL2ig,2,'.',','); ?></strong></td>
<?php } ?>
                                                             

<?php if($database->plantilla_filtro($nombreTabla,"propina",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
<td style="text-align:center"><strong style="font-size:16px">$ <?php echo number_format($propina12,2,'.',','); ?></strong></td>
<?php } ?>

<?php if($database->plantilla_filtro($nombreTabla,"DESCUENTO",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
<td style="text-align:center"><strong style="font-size:16px">$<?php echo number_format($DESCUENTO12,2,'.',','); ?></strong></td>
<?php } ?>

<?php  if($database->plantilla_filtro($nombreTabla,"TOTAL_IMPUESTOS_TRASLADADOS",$altaeventos,$DEPARTAMENTO)=="si"){  ?>
<td style="text-align:center" ><strong style="font-size:16px" >$<?php echo number_format($IVAXMLGTOTAL2,2,'.',','); ?></strong></td>
<?php } ?>

<?php  if($database->plantilla_filtro($nombreTabla,"IEPSXML",$altaeventos,$DEPARTAMENTO)=="si"){  ?>
<td style="text-align:center" ><strong style="font-size:16px" >$<?php echo number_format($IEPSXML12,2,'.',','); ?></strong></td>
<?php } ?>

<?php  if($database->plantilla_filtro($nombreTabla,"TOTAL_IMPUESTOS_RETENIDOS",$altaeventos,$DEPARTAMENTO)=="si"){  ?>
<td style="text-align:center" ><strong style="font-size:16px" >$<?php echo number_format($TImpuestosRetenidos12,2,'.',','); ?></strong></td>
<?php } ?>

<td style="text-align:center" ><strong style="font-size:16px" >$<?php echo number_format($TUA12,2,'.',','); ?></strong></td>


<?php  if($database->plantilla_filtro($nombreTabla,"total",$altaeventos,$DEPARTAMENTO)=="si"){  ?>
<td style="text-align:center;color:#a90d3a;" ><strong style="font-size:16px" >$<?php echo number_format($totalf12if,2,'.',','); ?></strong></td>
<?php } ?>




<td style="text-align:center;" ><strong style="font-size:16px;" id="totalCalculado">$<?php 
if (!empty($PorfaltaDeFactura12)) {
    echo number_format($PorfaltaDeFactura12, 2, '.', ',');
} elseif (isset($PorfaltaDeFactura123)) {
    echo number_format($PorfaltaDeFactura123, 2, '.', ',');
} else {
    echo number_format($PorfaltaDeFactura12ig, 2, '.', ',');
}
?></strong></td> 


</tr>
<?php } ?>



<?php if($NUMERO_CONSECUTIVO_PROVEE!=''){
/*cuando SI está filtrado*/
?>
<tr>	

<?php if($totales2 == 'si'){ ?>
<td style="text-align:right; padding-right:45px;" colspan="<?php echo $colspan2 +1; ?>"><strong style="font-size:16px;COLOR: #C70039 ">TOTALES POR COMPROBAR </strong></td>
<?php } ?>

<?php if($database->plantilla_filtro($nombreTabla,"SUBTOTAL",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
<td style="text-align:center"><strong style="font-size:16px">$<?php echo number_format($SUBTOL2ig,2,'.',','); ?></strong></td>
<?php } ?>
                                                             

<?php if($database->plantilla_filtro($nombreTabla,"propina",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
<td style="text-align:center"><strong style="font-size:16px">$ <?php echo number_format($propina12 ,2,'.',','); ?></strong></td>
<?php } ?>

<?php if($database->plantilla_filtro($nombreTabla,"DESCUENTO",$altaeventos,$DEPARTAMENTO)=="si"){ ?>
<td style="text-align:center"><strong style="font-size:16px">$<?php echo number_format($DESCUENTO12,2,'.',','); /*echo number_format($DESCUENTO12,2,'.',',');*/ ?></strong></td>
<?php } ?>

<?php  if($database->plantilla_filtro($nombreTabla,"TOTAL_IMPUESTOS_TRASLADADOS",$altaeventos,$DEPARTAMENTO)=="si"){  ?>
<td style="text-align:center" ><strong style="font-size:16px" >$<?php echo number_format($IVAXMLGTOTAL2,2,'.',','); /*echo number_format($IVAXMLGTOTAL2,2,'.',','); */ ?></strong></td>
<?php } ?>

<?php  if($database->plantilla_filtro($nombreTabla,"IEPSXML",$altaeventos,$DEPARTAMENTO)=="si"){  ?>
<td style="text-align:center" ><strong style="font-size:16px" >$<?php echo number_format($IEPSXML12,2,'.',','); /*echo number_format($IEPSXML12,2,'.',','); */ ?></strong></td>
<?php } ?>

<?php  if($database->plantilla_filtro($nombreTabla,"TOTAL_IMPUESTOS_RETENIDOS",$altaeventos,$DEPARTAMENTO)=="si"){  ?>
<td style="text-align:center" ><strong style="font-size:16px" >$<?php echo number_format($TImpuestosRetenidos12,2,'.',','); /* echo number_format($TImpuestosRetenidos12,2,'.',',');*/ ?></strong></td>
<?php } ?>

<td style="text-align:center" ><strong style="font-size:16px" >$<?php echo number_format($TUA12ig,2,'.',','); /* echo number_format($TUA12,2,'.',','); */?></strong></td>


<?php  if($database->plantilla_filtro($nombreTabla,"total",$altaeventos,$DEPARTAMENTO)=="si"){  ?>
<td style="text-align:center;color:#a90d3a;" ><strong style="font-size:16px" >$<?php echo number_format($totalf12if,2,'.',','); ?></strong></td>
<?php } ?>

<td style="text-align:center;" ><strong style="font-size:16px;" id="totalCalculado">$<?php 
if (!empty($PorfaltaDeFactura12)) {
    echo number_format($PorfaltaDeFactura12, 2, '.', ',');
} elseif (isset($PorfaltaDeFactura123)) {
    echo number_format($PorfaltaDeFactura123, 2, '.', ',');
} else {
    echo number_format($PorfaltaDeFactura12ig, 2, '.', ',');
}
?></strong></td>  



</tr>
<?php } ?>

</tbody>
		</table>
		</div>
		<div class="clearfix">
			<?php 
				$inicios=$offset+1;
				$finales+=$inicios -1;
				echo '<div class="hint-text">Mostrando '.$inicios.' al '.$finales.' de '.$numrows.' registros</div>';
				echo $pagination->paginate();
			?>
        </div>
	<?php
	}
}
?>
