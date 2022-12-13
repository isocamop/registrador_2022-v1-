<HTML>
	<HEAD><link rel="stylesheet" href="css/style2.css" /></HEAD>
<BODY>
<?php
/*Ejemplo de paginacIón*/
echo "<div align='center'> Paginación de Resultados para registro de Datos </div>"; 
echo "<hr>";

    include("conexion2.php");
    $res = mysqli_query($conexion, "SELECT * FROM historial");
    $numeroRegistros = mysqli_num_rows($res); 
    if($numeroRegistros<=0)
    {
        echo "<div align='center'>";
        echo "<font face='verdana'>No se encontraron resultados</font>"; 
        echo "</div>";
    } else {
        $orden = "id";
        $tamPag = 10; // tamaño de la página 10 filas
        if(!isset($_GET["pagina"])) // pagina actual si no está definida y limites
        {
            $pagina = 1;
            $inicio = 1;
            $final = $tamPag;
        }  else {
            $pagina	= $_GET["pagina"];
        }
        $limitInf = ($pagina-1)*$tamPag; //calculo del límite inferior
        $numPags = $numeroRegistros/$tamPag; //calculo del numero de paginas if(!isset($pagina))
        if(!isset($pagina))
        {
            $pagina = 1;
            $inicio = 1;
            $final = $tamPag;
        } else {
            $seccionActual = intval(($pagina-1)/$tamPag);
            $inicio = ($seccionActual*$tamPag)+1; 
            if($pagina<$numPags)
            {
                $final=$inicio + $tamPag - l;
            } else {
                $final = $numPags;
            }        
            if ($final>$numPags);
            {    
                $final	= $numPags;
            } 
        }// fin de calculo
    // creacion de la consulta con límites
    $sql = "SELECT * FROM historial ORDER BY ".$orden." ASC LIMIT ".$limitInf.",".$tamPag;
    $res = mysqli_query($conexion, $sql); 
    echo "<div align='center'>";
    echo "<font face='verdana' size='-3'>Se encontraron ".$numeroRegistros." registros "; 
    echo "ordenados por <b>".$orden."</b>";
    echo "</font></div>";
    echo "<TABLE border = 0  align='center' width='70%'>"; 
    echo "<tr><td colspan='6'><hr></td></tr>"; 
    echo "<th>ID    </th>";
    echo "<th>Datos    </th>"; 
    echo "<th>Fecha  </th>"; 
    echo "<th>ID_Sensor       </th>";
    while($registro = mysqli_fetch_array($res))
    {
?>
    <!--tabla de resultados-->
<tr bgcolor="   #270909   " ('<?php echo "[".$registro["id"]."]".$registro["datos"]." - ".$registro["fecha"]; ?>');">
<td><?php echo $registro["id"]; ?> </td>
<td><?php echo $registro["datos"]; ?> </td>
<td><?php echo $registro["fecha"]; ?> </td>
<TD><?php echo $registro["id_sensor"]; ?> </td></TD>
</tr>
    <!--fin  tabla resultados-->
<?php
    } /* fin while */ 
echo "</TABLE>";
} //fin if else
/* aqui inicia la paginacion */
?>
<br>
<TABLE align="center">
<tr><td  align="center">
<?php
    if($pagina>1)
    {
        echo "<a class='p' href='".$_SERVER["PHP_SELF"]."?pagina=".($pagina-1)."'>";
        echo "<font face='verdana' >Anterior</font>"; 
        echo "</a> ";
    }
    for($i	= $inicio; $i<=$final; $i++)
    {
        if($i==$pagina)
        {
            echo "<Font face= 'vendana' ><b>".$i."</b> </font>";
        } else {
            echo "<a  class= 'p' href= '".$_SERVER["PHP_SELF"]."?pagina=".$i."'>";
            echo "<font	face= 'verdana'  >".$i."</font></a> ";
        }
    }
    if($pagina<$numPags)
    {
        echo " <a class='p' href= '".$_SERVER["PHP_SELF"]."?pagina=".($pagina+1)."'>";
        echo " <font face= 'verdana' >Siguiente</font></a>";
    }	/*  finaliza la  paginacion */
?>
    </td></tr>
    </TABLE>
    
    <!-- codigo para agregar nuevos registro, buscador y imprimir en paginacion -->
    <center>
    <hr>
    <TABLE border=0 cellpadding=1 >
    <TR>
    
    <FORM METHOD=POST Action=impresion_bd.php>
    <TD><input type=submit name=buscar value=Imprimir ></TD>
    </FORM>
    </TR>
    </center>

    </BODY>
    </HTML>
<?php
    mysqli_close($conexion);
?>
</body>
</html>