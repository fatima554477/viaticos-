<?php
/**
 	--------------------------
	Autor: Sandor Matamoros
	Programer: Fatima Arellano
	Propietario: EPC
	----------------------------
 
*/

define("__ROOT1__", dirname(dirname(__FILE__)));
	include_once (__ROOT1__."/../includes/error_reporting.php");
	include_once (__ROOT1__."/../pagoproveedores/class.epcinnPP.php");

	
	class orders extends accesoclase {
	public $mysqli;
	public $counter;//Propiedad para almacenar el numero de registro devueltos por la consulta

	function __construct(){
		$this->mysqli = $this->db();
    }
	
	public function countAll($sql){
		$query=$this->mysqli->query($sql);
		$count=$query->num_rows;
		return $count;
	}
	//STATUS_EVENTO,NOMBRE_CORTO_EVENTO,NOMBRE_EVENTO
	public function getData($tables,$campos,$search){
		$offset=$search['offset'];
		$per_page=$search['per_page'];
		$tables = '02SUBETUFACTURA';
		$tables2 = '02XML';	
		
		$sWhereCC =" ON 02SUBETUFACTURA.id = 02XML.`ultimo_id` ";
		$sWhere2="";$sWhere3="";
		
		
		if($search['NUMERO_CONSECUTIVO_PROVEE']!=""){
$sWhere2.="  $tables.NUMERO_CONSECUTIVO_PROVEE LIKE '%".$search['NUMERO_CONSECUTIVO_PROVEE']."%' and ";}
if($search['NOMBRE_COMERCIAL']!=""){
$sWhere2.="  $tables.NOMBRE_COMERCIAL LIKE '%".$search['NOMBRE_COMERCIAL']."%' and ";}
if($search['RAZON_SOCIAL']!=""){
$sWhere2.="  $tables.RAZON_SOCIAL LIKE '%".$search['RAZON_SOCIAL']."%' and ";}
if($search['VIATICOSOPRO']!=""){
$sWhere2.="  $tables.VIATICOSOPRO LIKE '%".$search['VIATICOSOPRO']."%' and ";}
if($search['RFC_PROVEEDOR']!=""){
$sWhere2.="  $tables.RFC_PROVEEDOR LIKE '%".$search['RFC_PROVEEDOR']."%' and ";}
if($search['NUMERO_EVENTO']!=""){
$sWhere2.="  $tables.NUMERO_EVENTO LIKE '%".$search['NUMERO_EVENTO']."%' and ";}
if($search['NOMBRE_EVENTO']!=""){
$sWhere2.="  $tables.NOMBRE_EVENTO LIKE '%".$search['NOMBRE_EVENTO']."%' and ";}
if($search['MOTIVO_GASTO']!=""){
$sWhere2.="  $tables.MOTIVO_GASTO LIKE '%".$search['MOTIVO_GASTO']."%' and ";}
if($search['CONCEPTO_PROVEE']!=""){
$sWhere2.="  $tables.CONCEPTO_PROVEE LIKE '%".$search['CONCEPTO_PROVEE']."%' and ";}
if($search['MONTO_TOTAL_COTIZACION_ADEUDO']!=""){
$sWhere2.="  $tables.MONTO_TOTAL_COTIZACION_ADEUDO LIKE '%".$search['MONTO_TOTAL_COTIZACION_ADEUDO']."%' and ";}
if($search['MONTO_FACTURA']!=""){
$sWhere2.="  $tables.MONTO_FACTURA LIKE '%".$search['MONTO_FACTURA']."%' and ";}
if($search['MONTO_PROPINA']!=""){
$sWhere2.="  $tables.MONTO_PROPINA LIKE '%".$search['MONTO_PROPINA']."%' and ";}
if($search['MONTO_DEPOSITAR']!=""){
$sWhere2.="  $tables.MONTO_DEPOSITAR LIKE '%".$search['MONTO_DEPOSITAR']."%' and ";}
if($search['TIPO_DE_MONEDA']!=""){
$sWhere2.="  $tables.TIPO_DE_MONEDA LIKE '%".$search['TIPO_DE_MONEDA']."%' and ";}
if($search['PFORMADE_PAGO']!=""){
$sWhere2.="  $tables.PFORMADE_PAGO LIKE '%".$search['PFORMADE_PAGO']."%' and ";}

if($search['TImpuestosRetenidosIVA']!=""){
$sWhere2.="  $tables.TImpuestosRetenidosIVA LIKE '%".$search['TImpuestosRetenidosIVA']."%' and ";}

if($search['TImpuestosRetenidosISR']!=""){
$sWhere2.="  $tables.TImpuestosRetenidosISR LIKE '%".$search['TImpuestosRetenidosISR']."%' and ";}

if($search['descuentos']!=""){
$sWhere2.="  $tables.descuentos LIKE '%".$search['descuentos']."%' and ";}


if($search['FECHA_DE_PAGO']!="" and $search['FECHA_DE_PAGO2a']!=""){
//BETWEEN '2022-01-12' AND '2022-01-22' DATE(`ribono_tabla`.fechaamazon) 	
$sWhere2.=" $tables.FECHA_DE_PAGO BETWEEN 
'".$search['FECHA_DE_PAGO']."' and '".$search['FECHA_DE_PAGO2a']."'  and ";
}elseif($search['FECHA_DE_PAGO']!=""){
$sWhere2.=" $tables.FECHA_DE_PAGO LIKE '%".$search['FECHA_DE_PAGO']."%' and ";
}elseif($search['FECHA_DE_PAGO2a']!=""){
$sWhere2.=" $tables.FECHA_DE_PAGO LIKE '%".$search['FECHA_DE_PAGO2a']."%' and ";
}


if($search['FECHA_A_DEPOSITAR']!=""){
$sWhere2.="  $tables.FECHA_A_DEPOSITAR LIKE '%".$search['FECHA_A_DEPOSITAR']."%' and ";}
if($search['STATUS_DE_PAGO']!=""){
$sWhere2.="  $tables.STATUS_DE_PAGO LIKE '%".$search['STATUS_DE_PAGO']."%' and ";}
if($search['ACTIVO_FIJO']!=""){
$sWhere2.="  $tables.ACTIVO_FIJO LIKE '%".$search['ACTIVO_FIJO']."%' and ";}
if($search['GASTO_FIJO']!=""){
$sWhere2.="  $tables.GASTO_FIJO LIKE '%".$search['GASTO_FIJO']."%' and ";}
if($search['PAGAR_CADA']!=""){
$sWhere2.="  $tables.PAGAR_CADA LIKE '%".$search['PAGAR_CADA']."%' and ";}
if($search['FECHA_PPAGO']!=""){
$sWhere2.="  $tables.FECHA_PPAGO LIKE '%".$search['FECHA_PPAGO']."%' and ";}
if($search['FECHA_TPROGRAPAGO']!=""){
$sWhere2.="  $tables.FECHA_TPROGRAPAGO LIKE '%".$search['FECHA_TPROGRAPAGO']."%' and ";}
if($search['NUMERO_EVENTOFIJO']!=""){
$sWhere2.="  $tables.NUMERO_EVENTOFIJO LIKE '%".$search['NUMERO_EVENTOFIJO']."%' and ";}
if($search['CLASI_GENERAL']!=""){
$sWhere2.="  $tables.CLASI_GENERAL LIKE '%".$search['CLASI_GENERAL']."%' and ";}
if($search['SUB_GENERAL']!=""){
$sWhere2.="  $tables.SUB_GENERAL LIKE '%".$search['SUB_GENERAL']."%' and ";}
if($search['MONTO_DEPOSITADO']!=""){
$sWhere2.="  $tables.MONTO_DEPOSITADO LIKE '%".$search['MONTO_DEPOSITADO']."%' and ";}
if($search['NUMERO_EVENTO1']!=""){
$sWhere2.="  $tables.NUMERO_EVENTO1 LIKE '%".$search['NUMERO_EVENTO1']."%' and ";}
if($search['CLASIFICACION_GENERAL']!=""){
$sWhere2.="  $tables.CLASIFICACION_GENERAL LIKE '%".$search['CLASIFICACION_GENERAL']."%' and ";}
if($search['CLASIFICACION_ESPECIFICA']!=""){
$sWhere2.="  $tables.CLASIFICACION_ESPECIFICA LIKE '%".$search['CLASIFICACION_ESPECIFICA']."%' and ";}
if($search['PLACAS_VEHICULO']!=""){
$sWhere2.="  $tables.PLACAS_VEHICULO LIKE '%".$search['PLACAS_VEHICULO']."%' and ";}
if($search['MONTO_DE_COMISION']!=""){
$sWhere2.="  $tables.MONTO_DE_COMISION LIKE '%".$search['MONTO_DE_COMISION']."%' and ";}
if($search['POLIZA_NUMERO']!=""){
$sWhere2.="  $tables.POLIZA_NUMERO LIKE '%".$search['POLIZA_NUMERO']."%' and ";}
if($search['NOMBRE_DEL_EJECUTIVO']!=""){
$sWhere2.="  $tables.NOMBRE_DEL_EJECUTIVO LIKE '%".$search['NOMBRE_DEL_EJECUTIVO']."%' and ";}
if($search['NOMBRE_DEL_AYUDO']!=""){
$sWhere2.="  $tables.NOMBRE_DEL_AYUDO LIKE '%".$search['NOMBRE_DEL_AYUDO']."%' and ";}
if($search['OBSERVACIONES_1']!=""){
$sWhere2.="  $tables.OBSERVACIONES_1 LIKE '%".$search['OBSERVACIONES_1']."%' and ";}
if($search['FECHA_DE_LLENADO']!=""){
$sWhere2.="  $tables.FECHA_DE_LLENADO LIKE '%".$search['FECHA_DE_LLENADO']."%' and ";}
if($search['hiddenpagoproveedores']!=""){
$sWhere2.="  $tables.hiddenpagoproveedores LIKE '%".$search['hiddenpagoproveedores']."%' and ";}
if($search['TIPO_CAMBIOP']!=""){
$sWhere2.="  $tables.TIPO_CAMBIOP LIKE '%".$search['TIPO_CAMBIOP']."%' and ";}

if($search['TOTAL_ENPESOS']!=""){
$sWhere2.="  $tables.TOTAL_ENPESOS LIKE '%".$search['TOTAL_ENPESOS']."%' and ";}

if($search['BANCO_ORIGEN']!=""){
$sWhere2.="  $tables.BANCO_ORIGEN LIKE '%".$search['BANCO_ORIGEN']."%' and ";}
//////////////////////////////////////////////////////////////////////////////////////////////////
if($search['ID_RELACIONADO']!=""){
$sWhere2.="  $tables.ID_RELACIONADO LIKE '%".$search['ID_RELACIONADO']."%' and ";}

if($search['IVA']!=""){
$sWhere2.="  $tables.IVA LIKE '%".$search['IVA']."%' and ";}

if($search['IEPS']!=""){
$sWhere2.="  $tables.IEPS LIKE '%".$search['IEPS']."%' and ";}




if($search['UUID']!=""){
$sWhere2.="  $tables2.UUID = '".$search['UUID']."' and ";}

if($search['metodoDePago']!=""){
$sWhere2.="  $tables2.metodoDePago = '".$search['metodoDePago']."' and ";}

if($search['totalf']!=""){
$totalf = str_replace(',','',str_replace('$','',$search['totalf']));
$sWhere2.="  $tables2.totalf = '".$totalf."' and ";}

if($search['serie']!=""){
$sWhere2.="  $tables2.serie = '".$search['serie']."' and ";}

if($search['folio']!=""){
$sWhere2.="  $tables2.folio = '".$search['folio']."' and ";}

if($search['regimenE']!=""){
$sWhere2.="  $tables2.regimenE = '".$search['regimenE']."' and ";}

if($search['UsoCFDI']!=""){
$sWhere2.="  $tables2.UsoCFDI = '".$search['UsoCFDI']."' and ";}

if($search['TImpuestosTrasladados']!=""){
$TImpuestosTrasladados = str_replace(',','',str_replace('$','',$search['TImpuestosTrasladados']));
$sWhere2.="  $tables2.TImpuestosTrasladados = ".$TImpuestosTrasladados." and ";}

if($search['TImpuestosRetenidos']!=""){
$TImpuestosRetenidos = str_replace(',','',str_replace('$','',$search['TImpuestosRetenidos']));
$sWhere2.="  $tables2.TImpuestosRetenidos = ".$TImpuestosRetenidos." and ";}

if($search['Version']!=""){
$sWhere2.="  $tables2.Version = '".$search['Version']."' and ";}

if($search['tipoDeComprobante']!=""){
$sWhere2.="  $tables2.tipoDeComprobante = '".$search['tipoDeComprobante']."' and ";}

if($search['condicionesDePago']!=""){
$sWhere2.="  $tables2.condicionesDePago = '".$search['condicionesDePago']."' and ";}

if($search['fechaTimbrado']!=""){
$sWhere2.="  $tables2.fechaTimbrado = '".$search['fechaTimbrado']."' and ";}

if($search['nombreR']!=""){
$sWhere2.="  $tables2.nombreR = '".$search['nombreR']."' and ";}

if($search['rfcR']!=""){
$sWhere2.="  $tables2.rfcR = '".$search['rfcR']."' and ";}

if($search['Moneda']!=""){
$sWhere2.="  $tables2.Moneda = '".$search['Moneda']."' and ";}

if($search['TipoCambio']!=""){
$sWhere2.="  $tables2.TipoCambio = '".$search['TipoCambio']."' and ";}

if($search['ValorUnitarioConcepto']!=""){
$sWhere2.="  $tables2.ValorUnitarioConcepto = '".$search['ValorUnitarioConcepto']."' and ";}

if($search['DescripcionConcepto']!=""){
$sWhere2.="  $tables2.DescripcionConcepto like '%".$search['DescripcionConcepto']."%' and ";}

if($search['ClaveUnidadConcepto']!=""){
$sWhere2.="  $tables2.ClaveUnidadConcepto like '%".$search['ClaveUnidadConcepto']."%' and ";}

if($search['ClaveProdServConcepto']!=""){
$sWhere2.="  $tables2.ClaveProdServConcepto = '".$search['ClaveProdServConcepto']."' and ";}

if($search['RFC_RECEPTOR']!=""){
$sWhere2.="  $tables2.RFC_RECEPTOR = '".$search['RFC_RECEPTOR']."' and ";}

if($search['CantidadConcepto']!=""){
$sWhere2.="  $tables2.CantidadConcepto = '".$search['CantidadConcepto']."' and ";}

if($search['ImporteConcepto']!=""){
$sWhere2.="  $tables2.ImporteConcepto = '".$search['ImporteConcepto']."' and ";}

if($search['UnidadConcepto']!=""){
$sWhere2.="  $tables2.UnidadConcepto = '".$search['UnidadConcepto']."' and ";}

if($search['TUA']!=""){
	$TUA = str_replace(',','',str_replace('$','',$search['TUA']));
$sWhere2.="  $tables2.TUA = '".$TUA."' and ";}

if($search['TuaTotalCargos']!=""){
	$TuaTotalCargos = str_replace(',','',str_replace('$','',$search['TuaTotalCargos']));
$sWhere2.="  $tables2.TuaTotalCargos = '".$TuaTotalCargos."' and ";}

if($search['DESCUENTO']!=""){
	$DESCUENTO = str_replace(',','',str_replace('$','',$search['DESCUENTO']));
$sWhere2.="  $tables2.DESCUENTO = '".$DESCUENTO."' and ";}

if($search['subTotal']!=""){
	$subTotal = str_replace(',','',str_replace('$','',$search['subTotal']));
$sWhere2.="  $tables2.subTotal = '".$subTotal."' and ";}

if($search['IMPUESTO_HOSPEDAJE']!=""){
	$IMPUESTO_HOSPEDAJE = str_replace(',','',str_replace('$','',$search['IMPUESTO_HOSPEDAJE']));
$sWhere2.="  $tables2.IMPUESTO_HOSPEDAJE = '".$IMPUESTO_HOSPEDAJE."' and ";}

if($search['propina']!=""){
	$propina = str_replace(',','',str_replace('$','',$search['propina']));
$sWhere2.="  $tables2.propina = '".$propina."' and ";}

if($search['IVAXML']!=""){
	$IVAXML = str_replace(',','',str_replace('$','',$search['IVAXML']));
$sWhere2.="  $tables2.IVAXML = '".$IVAXML."' and ";}

if($search['IEPSXML']!=""){
	$IEPSXML = str_replace(',','',str_replace('$','',$search['IEPSXML']));
$sWhere2.="  $tables2.IEPSXML = '".$IEPSXML."' and ";}


/*IF($sWhere2!=""){
				$sWhere22 = substr($sWhere2,0,-3);
			$sWhere3  = ' where ( '.$sWhere22.' ) ';
		}ELSE{
		$sWhere3  = '';	
		}*/



IF($sWhere2!=""){
			$sWhere22 = substr($sWhere2,0,-4);
			$sWhere33  = ' ('.$sWhere22.') ';
			$sWhere3  = ' '.$sWhereCC.' where '.$tables.'.VIATICOSOPRO = "VIATICOS" and ('.$sWhere33.' ) ';			
		}ELSE{
			//$sWhereCC = substr($sWhereCC,0,-4);			
		$sWhere3  = ' '.$sWhereCC.' where '.$tables.'.VIATICOSOPRO = "VIATICOS" ';
		}




		$sWhere3 .= " order by $tables.id desc ";
		
		 $sql="SELECT $campos , 02SUBETUFACTURA.id as 02SUBETUFACTURAid FROM $tables LEFT JOIN $tables2 $sWhere $sWhere3 LIMIT $offset,$per_page";
		
		
		$query=$this->mysqli->query($sql);
		$sql1="SELECT $campos , 02SUBETUFACTURA.id as 02SUBETUFACTURAid FROM  $tables LEFT JOIN $tables2 $sWhere $sWhere3 ";
		$nums_row=$this->countAll($sql1);
		//Set counter
		$this->setCounter($nums_row);
		return $query;
	}
	function setCounter($counter) {
		$this->counter = $counter;
	}
	function getCounter() {
		return $this->counter;
	}
}
?>
