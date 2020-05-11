<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>AbaNet_mesaayuda 2.0 - Menú principal</title>
  <!--CSS FILES-->
  <link href="/Proyecto_base_mesaayuda/assets/frameworks/bootstrap/css/bootstrap.css" rel="stylesheet">
  <link rel="stylesheet" href="/Proyecto_base_mesaayuda/assets/libs/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="/Proyecto_base_mesaayuda/assets/css/main.css">
  <link href="/Proyecto_base_mesaayuda/assets/libs/pNotify/pnotify.custom.css" media="all" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" type="text/css" href="/Proyecto_base_mesaayuda/assets/libs/DataTables/datatables.css"/>
  <link rel="stylesheet" href="/Proyecto_base_mesaayuda/assets/frameworks/bootstrap/css/bootstrap-datepicker3.css"/>
  <link rel="stylesheet" href="/Proyecto_base_mesaayuda/assets/frameworks/bootstrap/css/bootstrap-iso.css"/>

  <!--JS FILES-->
  <script src="/Proyecto_base_mesaayuda/assets/libs/jQuery/jquery-1.9.1.min.js"></script>
  <script src="/Proyecto_base_mesaayuda/assets/frameworks/bootstrap/js/bootstrap.js"></script>
  <script type="text/javascript" src="/Proyecto_base_mesaayuda/assets/libs/pNotify/pnotify.custom.js"></script>
  <script type="text/javascript" src="/Proyecto_base_mesaayuda/controllers/client/index/js_index.js?v=0.0.1"></script>
  <script type="text/javascript" src="/Proyecto_base_mesaayuda/assets/libs/DataTables/datatables.js"></script>
  <script type="text/javascript" src="/Proyecto_base_mesaayuda/assets/js/main.js"></script>
  <script type="text/javascript" src="/Proyecto_base_mesaayuda/assets/libs/blockUI/blockUI.js"></script>
  <script type="text/javascript" src="/Proyecto_base_mesaayuda/assets/libs/validaCamposFranz/validCampoFranz.js"></script>
  <script type="text/javascript" src="/Proyecto_base_mesaayuda/assets/libs/Rut/rut.js"></script>
  <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
  <script src="/Proyecto_base_mesaayuda/assets/frameworks/bootstrap/js/bootstrap-datepicker.min.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">

</head>
<body>

  <div id="wrapper">

    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><img alt="Logo" height="22" src="/Proyecto_base_mesaayuda/assets/img/logo_hospital.png"></a>
          <ul class="nav navbar-nav navbar-right">
            <li><a class="navbar-brand" href="#">AbaNet_mesaayuda 2.0</a></li>
          </ul>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">

            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Gestión de Compras <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li role="separator" class="divider"></li>
                <li><a href="#" id="solicitudes_usuario" class="item-menu">Mis Solicitudes realizadas</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#" id="solicitud_compra" class="item-menu">Solicitudes de Compra</a></li>
                <li><a href="#" id="orden_compra" class="item-menu" onclick="clearDataTable('ordenes_compra');">Ordenes de Compra</a></li>
                <li role="separator" class="divider"></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Recepción y Despacho <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li role="separator" class="divider"></li>
                <li><a href="#">Recepcionar Ordenes de Compra</a></li>
                <li><a href="#">Despachar Productos</a></li>
                <li role="separator" class="divider"></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Gestión de Presupuestos <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li role="separator" class="divider"></li>
                <li><a href="#">Presupuesto general por Items</a></li>
                <li><a href="#">Asignacion de presupuesto a CC</a></li>
                <li><a href="#">Balance de presupuesto asignado</a></li>
                <li role="separator" class="divider"></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Control de Inventario <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li role="separator" class="divider"></li>
                <li><a href="#">Maestro de productos</a></li>
                <li><a href="#">Inventario por Bodega</a></li>
                <li><a href="#">Bincard de productos</a></li>
                <li role="separator" class="divider"></li>

              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Reportes <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li role="separator" class="divider"></li>
                <li><a href="#">Salidas de productos</a></li>
                <li><a href="#">Tiempos de respuesta a solicitudes</a></li>
                <li role="separator" class="divider"></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Maestros <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li role="separator" class="divider"></li>
                <li><a href="#" id="maestro_bodega"    class="item-menu">Bodega</a></li>
                <li><a href="#" id="maestro_proveedor" class="item-menu">Proveedor</a></li>
                <li><a href="#" id="maestro_convenio"  class="item-menu">Convenio</a></li>
                <li><a href="#" id="maestro_producto"  class="item-menu">Producto</a></li>
                <li role="separator" class="divider"></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Testing Notificaciones <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li role="separator" class="divider"></li>
                <li><a href="#" id="test_pnotify">Info normal</a></li>
                <li><a href="#" id="test_pnotify_desktop">Notificacion de escritorio</a></li>
                <li role="separator" class="divider"></li>
              </ul>
            </li>
          </ul>

          <ul class="nav navbar-nav navbar-right">

            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Carlos Quijarro Fajardo <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">Salir del Sistema</a></li>
              </ul>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bell" aria-hidden="true"></i> Notificaciones <span class="badge badge-red">16</span></a>
              <ul class="dropdown-menu">
                <li role="separator" class="divider"></li>
                <li><a href="#">Nuevas solicitudes por aprobar <span class="badge badge-red">13</span></a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#">Solicitudes rechazas observadas <span class="badge badge-red">2</span></a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#">Ordenes de compras por retirar <span class="badge badge-red">1</span></a></li>
                <li role="separator" class="divider"></li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
    <div id="page-wrapper">
      <div id="contenido" class="container-fluid">
      </div>
    </div><!-- /#page-wrapper -->
  </div>
  <!-- /#wrapper -->
</body>
</html>