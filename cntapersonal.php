<?php
$pagina = 'personal';

include_once 'templates/header.php';
include_once 'templates/barra.php';
include_once 'templates/navegacion.php';

include_once 'bd/conexion.php';
$objeto = new conn();
$conexion = $objeto->connect();

$consulta = 'SELECT * FROM vcolaborador WHERE estado_col=1 ORDER BY id_col';
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data = $resultado->fetchAll(PDO::FETCH_ASSOC);

$cntam = "SELECT * FROM puesto WHERE estado_puesto=1 ORDER BY id_puesto";
$res = $conexion->prepare($cntam);
$res->execute();
$datapuesto = $res->fetchAll(PDO::FETCH_ASSOC);

$message = '';
?>

<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->


  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card">
      <div class="card-header bg-gradient-green text-light">
        <h1 class="card-title mx-auto">Colaboradores</h1>
      </div>

      <div class="card-body">

        <div class="row">
          <div class="col-lg-12">
            <button id="btnNuevo" type="button" class="btn bg-gradient-green btn-ms" data-toggle="modal"><i class="fas fa-plus-square text-light"></i><span class="text-light"> Nuevo</span></button>
          </div>
        </div>
        <br>
        <div class="container-fluid">

          <div class="row">
            <div class="col-lg-12">
              <div class="table-responsive">
                <table name="tablaV" id="tablaV" class="table table-sm table-striped table-bordered table-condensed text-nowrap w-auto mx-auto" style="width:100%">
                  <thead class="text-center bg-gradient-green">
                    <tr>
                      <th>Id</th>
                      <th>Nombre</th>
                      <th>Direccion</th>
                      <th>Telefono</th>
                      <th>Whatsapp/Cel</th>
                      <th>Correo</th>
                      <th>Id puesto</th>
                      <th>Puesto</th>
                      <th>Color</th>

                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($data as $dat) { ?>
                      <tr>
                        <td><?php echo $dat['id_col']; ?></td>
                        <td><?php echo $dat['nom_col']; ?></td>
                        <td><?php echo $dat['dir_col']; ?></td>
                        <td><?php echo $dat['tel_col']; ?></td>
                        <td><?php echo $dat['cel_col']; ?></td>
                        <td><?php echo $dat['correo_col']; ?></td>
                        <td><?php echo $dat['id_puesto']; ?></td>
                        <td><?php echo $dat['nom_puesto']; ?></td>
                        <td><?php echo $dat['color_col']; ?></td>

                        <td></td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

      </div>
      <!-- /.card-body -->

      <!-- /.card-footer-->
    </div>
    <!-- /.card -->

  </section>


  <section>
    <div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header bg-gradient-green">
            <h5 class="modal-title" id="exampleModalLabel">NUEVO COLABORADOR</h5>

          </div>
          <div class="card card-widget" style="margin: 10px;">
            <form id="formDatos" action="" method="POST">
              <div class="modal-body row">


                <div class="col-sm-12">
                  <div class="form-group input-group-sm">
                    <label for="nombre" class="col-form-label">Nombre:</label>
                    <input type="text" class="form-control" name="nombre" id="nombre" autocomplete="off" placeholder="Nombre">
                  </div>
                </div>

                <div class="col-sm-12">
                  <div class="form-group input-group-sm">
                    <label for="dir" class="col-form-label">Dirección:</label>
                    <textarea rows="2" type="text" class="form-control" name="dir" id="dir" autocomplete="off" placeholder="Dirección"></textarea>
                  </div>
                </div>

                <div class="col-sm-6">
                  <div class="form-group input-group-sm">
                    <label for="correo" class="col-form-label">Correo Eléctronico:</label>
                    <input type="text" class="form-control" name="correo" id="correo" autocomplete="off" placeholder="Correo Eléctronico">
                  </div>
                </div>

                <div class="col-sm-3">
                  <div class="form-group input-group-sm">
                    <label for="tel" class="col-form-label">Tel:</label>
                    <input type="text" class="form-control" name="tel" id="tel" autocomplete="off" placeholder="Tel.">
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group input-group-sm">
                    <label for="cel" class="col-form-label">Whatsapp/Cel:</label>
                    <input type="text" class="form-control" name="cel" id="cel" autocomplete="off" placeholder="Whatsapp">
                  </div>
                </div>

                <div class="col-sm-6">
                  <div class="form-group input-group-sm auto">
                    <label for="puesto" class="col-form-label">Puesto:</label>
                    <select class="form-control" name="puesto" id="puesto">
                      <?php
                      foreach ($datapuesto as $dtt) {
                      ?>
                        <option id="<?php echo $dtt['id_puesto'] ?>" value="<?php echo $dtt['id_puesto'] ?>"> <?php echo $dtt['nom_puesto'] ?></option>

                      <?php
                      }
                      ?>
                    </select>
                  </div>
                </div>

                <div class="col-lg-3">
                  <div class="input-group input-group-sm">
                    <label for="color" class="col-form-label">Color:</label>
                    <div class="input-group input-group-sm my-colorpicker2 colorpicker-element" data-colorpicker-id="2">
                      <input type=" text" class="form-control" name="color" id="color" placeholder="Seleccionar Color" data-original-title="" title="" autocomplete="off">
                      <span class=" input-group-append">
                        <span class="input-group-text">
                          <i class="fas fa-square " style="color: rgb(65, 115, 146);"></i>
                        </span>
                      </span>
                    </div>

                  </div>
                </div>


              </div>
          </div>


          <?php if ($message != '') { ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <span class="badge "><?php echo $message; ?></span>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>

            </div>

          <?php } ?>
          <div class="modal-footer">
            <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fas fa-ban"></i> Cancelar</button>
            <button type="submit" id="btnGuardar" name="btnGuardar" class="btn btn-success" value="btnGuardar"><i class="far fa-save"></i> Guardar</button>
          </div>
          </form>
        </div>
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>


<?php include_once 'templates/footer.php'; ?>
<script src="fjs/cntapersonal.js"></script>
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/sweetalert2/sweetalert2.all.min.js"></script>
<script src="plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>