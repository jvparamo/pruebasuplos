
<?php
$data = file_get_contents("data-1.json");
$goods = json_decode($data, true);
foreach ($goods as $g) {
 $city[]=$g['Ciudad']; 
 $type_house[]=$g['Tipo']; 
}
$city=array_unique($city);
$type_house=array_unique($type_house);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
  <link type="text/css" rel="stylesheet" href="css/customColors.css"  media="screen,projection"/>
  <link type="text/css" rel="stylesheet" href="css/ion.rangeSlider.css"  media="screen,projection"/>
  <link type="text/css" rel="stylesheet" href="css/ion.rangeSlider.skinFlat.css"  media="screen,projection"/>
  <link type="text/css" rel="stylesheet" href="css/index.css"  media="screen,projection"/>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Formulario</title>
</head>
<body>
  <video src="img/video.mp4" id="vidFondo"></video>
  <div class="contenedor">
    <div class="card rowTitulo">
      <h1>Bienes Intelcost</h1>
    </div>
    <div class="colFiltros">
      <form action="#" method="post" id="formulario">
        <div class="filtrosContenido">
          <div class="tituloFiltros">
            <h5>Filtros</h5>
          </div>
          <div class="filtroCiudad input-field">
            <p><label for="selectCiudad">Ciudad:</label><br></p>
                <select name="ciudad" id="selectCiudad">
              <option value="" selected>Elige una ciudad</option>
              <?php foreach ($city as $c) 
                    { ?>
                      <option value="<?=$c?>"><?=$c?></option>
              <?php } ?>
             
            </select>
          </div>
          <div class="filtroTipo input-field">
            <p><label for="selecTipo">Tipo:</label></p>
            <br>
            <select name="tipo" id="selectTipo">
              <option value="">Elige un tipo</option>
              <?php foreach ($type_house as $th) 
                    { ?>
                      <option value="<?=$th?>"><?=$th?></option>
              <?php } ?>
            </select>
          </div>
          <div class="filtroPrecio">
            <label for="rangoPrecio">Precio:</label>
            <input type="text" id="rangoPrecio" name="precio" value="" />
          </div>
          <div class="botonField">
            <input type="submit" class="btn white" value="Buscar" id="submitButton">
          </div>
        </div>
      </form>
    </div>
    <div id="tabs" style="width: 75%;">
      <ul>
        <li><a href="#tabs-1">Bienes disponibles</a></li>
        <li><a href="#tabs-2">Mis bienes</a></li>
        <li><a href="#tabs-3">Reporte</a></li>
      </ul>
      <div id="tabs-1">
        <div class="colContenido" id="divResultadosBusqueda">
          <div class="tituloContenido card" style="justify-content: center;">
            <h5>Resultados de la búsqueda:</h5>
            <?php if ($_POST)
                  {
                    foreach ($goods as $g)
                    {
                      if ($g['Tipo']==$_POST['tipo'] || $g['Ciudad']==$_POST['ciudad'])
                      { ?>
                        <div class="row">
                          <div class="col m8">
                            <img src="img/home.jpg" width="300" height="200">
                          </div>
                          <div class="col m4">
                            <p><b>Dirección: </b><?=$g['Direccion']?></p>
                            <p><b>Ciudad: </b><?=$g['Ciudad']?></p>
                            <p><b>Teléfono: </b><?=$g['Telefono']?></p>
                            <p><b>Codigo Postal: </b><?=$g['Codigo_Postal']?></p>
                            <p><b>Tipo: </b><?=$g['Tipo']?></p>
                            <p><b>Precio: </b><?=$g['Precio']?></p>
                            <div class="botonField">
                          <a href="?c=bienes&a=create&city=<?=$g['Ciudad']?>&type=<?=$g['Tipo']?>&address=<?=$g['Direccion']?>&phone=<?=$g['Telefono']?>&postal_code=<?=$g['Codigo_Postal']?>&price=<?=$g['Precio']?>" class="btn" data-toggle="tooltip" data-placement="top" title="Guardar">Guardar</a>
                            </div>
                          </div>
                        </div>
                        <div class="divider">
                        </div>
            <?php     } 
                    } 
                  }
                  else 
                  {
                    foreach ($goods as $g) 
                    { ?>
                      <div class="row">
                        <div class="col m8">
                          <img src="img/home.jpg" width="300" height="200">
                        </div>
                   <div class="col m4">
                     
                     <p><b>Dirección: </b><?=$g['Direccion']?></p>
                     <p><b>Ciudad: </b><?=$g['Ciudad']?></p>
                     <p><b>Teléfono: </b><?=$g['Telefono']?></p>
                     <p><b>Codigo Postal: </b><?=$g['Codigo_Postal']?></p>
                     <p><b>Tipo: </b><?=$g['Tipo']?></p>
                     <p><b>Precio: </b><?=$g['Precio']?></p>
                     <div class="botonField">
                          <a href="?c=bienes&a=create&city=<?=$g['Ciudad']?>&type=<?=$g['Tipo']?>&address=<?=$g['Direccion']?>&phone=<?=$g['Telefono']?>&postal_code=<?=$g['Codigo_Postal']?>&price=<?=$g['Precio']?>" class="btn" data-toggle="tooltip" data-placement="top" title="Guardar">Guardar</a>
                            </div>
                   </div>
                 </div>
                   <div class="divider">
                   </div>
                   <?php } }?>
           
          </div>
        </div>
      </div>
      
      <div id="tabs-2" >
        <div class="colContenido" id="divResultadosBusqueda">
          <div class="tituloContenido card" style="justify-content: center;">
            <h5>Bienes guardados:</h5>
            <?php foreach ($this->model->goods() as $g) 
                    {?>
                    <div class="col m8">
                          <img src="img/home.jpg" width="300" height="200">
                        </div>
                        <div class="col m4">
                        <p><b>Dirección: </b><?=$g->address?></p>
                     <p><b>Ciudad: </b><?=$g->city?></p>
                     <p><b>Teléfono: </b><?=$g->phone?></p>
                     <p><b>Codigo Postal: </b><?=$g->postal_code?></p>
                     <p><b>Tipo: </b><?=$g->type?></p>
                     <p><b>Precio: </b><?=$g->price?></p>
                     </div>
                        <div class="botonField">
                        <a href="?c=bienes&a=delete&id=<?=$g->id?>" class="btn" data-toggle="tooltip" data-placement="top" title="eliminar">Eliminar</a>
                            </div>
            <div class="divider"></div>
            <?php } ?>
          </div>
        </div>
      </div>
      <div id="tabs-3" >
        <div class="colContenido" id="divResultadosBusqueda">
          <div class="tituloContenido card" style="justify-content: center;">
            <h5>Reporte:</h5>
            <div class="filtroCiudad input-field">
            <p><label for="selectCiudad">Ciudad:</label><br></p>
                <select name="ciudad" id="selectCiudad">
              <option value="" selected>Elige una ciudad</option>
              <?php foreach ($city as $c) 
                    { ?>
                      <option value="<?=$c?>"><?=$c?></option>
              <?php } ?>
             
            </select>
          </div>
          <div class="filtroTipo input-field">
          <form action="">
            <p><label for="selecTipo">Tipo:</label></p>
            <br>
            <select name="tipo" id="selectTipo">
              <option value="">Elige un tipo</option>
              <?php foreach ($type_house as $th) 
                    { ?>
                      <option value="<?=$th?>"><?=$th?></option>
              <?php } ?>
            </select>
          </div>
          <div class="botonField">
                        <a href="?c=bienes&a=report" class="btn" data-toggle="tooltip" type="submit" data-placement="top" title="eliminar">Generar Reporte</a>
                </div>
                </form>
          </div>
        </div>
      </div>
    </div>


    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    
    <script type="text/javascript" src="js/ion.rangeSlider.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script type="text/javascript" src="js/index.js"></script>
    <script type="text/javascript" src="js/buscador.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript">
      $( document ).ready(function() {
          $( "#tabs" ).tabs();
      });
    </script>
  </body>
  </html>
 