<aside class="main-sidebar sidebar-light-primary elevation-3 ">
  <!-- Brand Logo -->

  <a href="inicio.php" class="brand-link">

    <img src="img/bombonela.png" alt="Logo" class="brand-image  " style="opacity: .8">
    <span class="brand-text font-weight-bold">BOMBONELA</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar ">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex ">
      <div class="image">
        <img src="img/user.png" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block"><?php echo $_SESSION['s_nombre']; ?></a>
        <input type="hidden" id="iduser" name="iduser" value="<?php echo  $_SESSION['s_usuario']; ?>">
        <input type="hidden" id="nameuser" name="nameuser" value="<?php echo $_SESSION['s_nombre']; ?>">
        <input type="hidden" id="tipousuario" name="tipousuario" value="<?php echo $_SESSION['s_rol']; ?>">
        <input type="hidden" id="fechasys" name="fechasys" value="<?php echo date('Y-m-d') ?>">
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar  text-white flex-column nav-compact nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->


        <li class="nav-item ">
          <a href="inicio.php" class="nav-link <?php echo ($pagina == 'home') ? "active" : ""; ?> ">
            <i class="nav-icon fas fa-home "></i>
            <p>
              Home
            </p>
          </a>
        </li>
        
        <li class="nav-item  has-treeview <?php echo ($pagina == 'cliente' || $pagina == 'personal' || $pagina == 'prospectos' ) ? "menu-open" : ""; ?>">
          <a href="#" class="nav-link  <?php echo ($pagina == 'cliente' || $pagina == 'personal' || $pagina == 'prospectos') ? "active" : ""; ?>">
            <i class="nav-icon fas fa-bars "></i>
            <p>
              Catalogos
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>


          <ul class="nav nav-treeview">
          <li class="nav-item">
              <a href="cntapersonal.php" class="nav-link <?php echo ($pagina == 'personal') ? "active seleccionado" : ""; ?>  ">
                <i class="fas fa-user-md nav-icon"></i>
                <p>Personal</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="cntaprospecto.php" class="nav-link <?php echo ($pagina == 'prospectos') ? "active seleccionado" : ""; ?>  ">
                <i class="fas fa-id-card nav-icon"></i>
                <p>Prospecto</p>
              </a>
            </li>
      
            <li class="nav-item">
              <a href="cntacliente.php" class="nav-link <?php echo ($pagina == 'cliente') ? "active seleccionado" : ""; ?>  ">
                <i class="fas fa-hospital-user nav-icon"></i>
                <p>Clientes</p>
              </a>
            </li>

  
          </ul>

        </li>





        <li class="nav-item has-treeview <?php echo ($pagina == 'tmpventa' || $pagina == 'venta' || $pagina == 'cntaventa' || $pagina == 'buscadoragenda'
         || $pagina == 'calendario' || $pagina == 'confirmacion' || $pagina == 'vcalendario' || $pagina == 'recepcion') ? "menu-open" : ""; ?>">


          <a href="#" class="nav-link <?php echo ($pagina == 'tmpventa' || $pagina == 'venta' || $pagina == 'cntaventa' || $pagina == 'buscadoragenda'
           || $pagina == 'calendario' || $pagina == 'confirmacion' || $pagina == 'vcalendario' || $pagina == 'recepcion') ? "active" : ""; ?>">
            <span class="fa-stack">
              <i class="fas fa-file-invoice-dollar nav-icon"></i>
            </span>
            <p>Operaciones
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
          <li class="nav-item">
              <a href="buscadoragenda.php" class="nav-link <?php echo ($pagina == 'buscadoragenda') ? "active seleccionado" : ""; ?>  ">
                <i class="fa-solid fa-magnifying-glass nav-icon"></i>
                <p>Buscador Agenda</p>
              </a>
            </li>

          <li class="nav-item">
              <a href="calendario.php" class="nav-link <?php echo ($pagina == 'calendario') ? "active seleccionado" : ""; ?>  ">
                <i class="fa-solid fa-calendar nav-icon"></i>
                <p>Agenda</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="vcalendario.php" class="nav-link <?php echo ($pagina == 'vcalendario') ? "active seleccionado" : ""; ?>  ">
                <i class="fa-solid fa-calendar-days  nav-icon"></i>
                <p>Calendario Diario</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="confirmacion.php" class="nav-link <?php echo ($pagina == 'confirmacion') ? "active seleccionado" : ""; ?>  ">
                <i class="fa-solid fa-calendar-check nav-icon"></i>
                <p>Confirmaciones</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="recepcion.php" class="nav-link <?php echo ($pagina == 'recepcion') ? "active seleccionado" : ""; ?>  ">
                <i class="fa-solid fa-calendar-day nav-icon"></i>
                <p>Recepecion</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="tmpventa.php" class="nav-link <?php echo ($pagina == 'tmpventa') ? "active seleccionado" : ""; ?>  ">
                <i class="fas fa-money-check-alt nav-icon"></i>
                <p>Venta</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="cntaventa.php" class="nav-link <?php echo ($pagina == 'cntaventa') ? "active seleccionado" : ""; ?>  ">
                <i class="fas fa-search-dollar nav-icon"></i>
                <p>Consulta de Ventas</p>
              </a>
            </li>
<!--
            <li class="nav-item">
              <a href="recepcion.php" class="nav-link <?php echo ($pagina == 'recepcion') ? "active seleccionado" : ""; ?>  ">
                <i class="fas fa-hospital nav-icon"></i>
                <p>Recepción</p>
              </a>
            </li>
-->
           
            <!--
            <li class="nav-item">
              <a href="cntavisitas.php" class=" nav-link <?php echo ($pagina == 'cntavisitas') ? "active seleccionado" : ""; ?> ">
                <i class=" fas fa-file-invoice nav-icon"></i>
                <p>Reporte de Visitas</p>
              </a>
            </li>
            
         

            <?php if ($_SESSION['s_rol'] == '2') { ?>
              <li class="nav-item">
                <a href="cntaingresos.php" class=" nav-link <?php echo ($pagina == 'ingresos') ? "active seleccionado" : ""; ?> ">
                  <i class=" fas fa-file-invoice nav-icon"></i>
                  <p>Reporte de Ingresos</p>
                </a>
              </li>


            <?php } ?>
-->
          </ul>
        </li>

        <!-- ADMINISTRACION-->
       




        <?php if ($_SESSION['s_rol'] == '2') { ?>
          <hr class="sidebar-divider">
          <li class="nav-item">
            <a href="cntausuarios.php" class="nav-link <?php echo ($pagina == 'usuarios') ? "active" : ""; ?> ">
              <i class="fas fa-user-shield"></i>
              <p>Usuarios</p>
            </a>
          </li>
        <?php } ?>

        <hr class="sidebar-divider">
        <li class="nav-item">
          <a class="nav-link" href="bd/logout.php">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <p>Salir</p>
          </a>
        </li>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
<!-- Main Sidebar Container -->