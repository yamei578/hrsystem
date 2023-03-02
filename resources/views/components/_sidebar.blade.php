


<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('home')}}">
        <div class="sidebar-brand-text mx-3">EMPRESA XYZ</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="{{route('home')}}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
        
      </li>

     

     
      <!-- Nav Item - Pages Collapse Menu -->

      @if(auth()->user()->userHasRole('Admin'))
       <!-- Divider -->
       <hr class="sidebar-divider">
       <!-- Heading -->
       <div class="sidebar-heading">
        Admin
      </div>


      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#admin" aria-expanded="true" aria-controls="admin">
          <i class="fas fa-fw fa-cog"></i>
          <span>Configuración</span>
        </a>
        <div id="admin" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{route('roles.index')}}">Roles</a>
            <a class="collapse-item" href="{{route('permissions.index')}}">Permisos</a>
            <a class="collapse-item" href="{{route('users.index')}}">Usuarios</a>
          </div>
        </div>
      </li>


    @endif

    @if(auth()->user()->userHasRole('Supervisor') || auth()->user()->userHasRole('Admin'))

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Supervisor
      </div>

    
    <!-- Nav Item - Marcaciones Collapse Menu -->
      <li class="nav-item active">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#marcacionessupervisor" aria-expanded="true" aria-controls="marcacionessupervisor">
          <i class="fas fa-fw fa-folder"></i>
          <span>Marcaciones</span>
        </a>
        <div id="marcacionessupervisor" class="collapse " aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
           <!--  <a class="collapse-item" href="{{route('supervisor.marcaciones.index')}}">Propias</a>-->
            <a class="collapse-item" href="{{route('supervisor.colaboradores.marcaciones.index')}}">Colaboradores</a>
          </div>
        </div>
      </li>


        <!-- Nav Item - Solicitudes Collapse Menu -->

        <li class="nav-item active">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#solicitudessupervisor" aria-expanded="true" aria-controls="solicitudessupervisor">
          <i class="fas fa-fw fa-folder"></i>
          <span>Solicitudes</span>
        </a>
        <div id="solicitudessupervisor" class="collapse " aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <!-- <a class="collapse-item" href="{{route('supervisor.solicitudes.index')}}">Propias</a>-->
            <a class="collapse-item" href="{{route('supervisor.solicitudescolaboradores.index')}}">Colaboradores</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - vacante interno Collapse Menu -->
<!--
      <li class="nav-item active">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#vacantesupervisor" aria-expanded="true" aria-controls="vacantesupervisor">
          <i class="fas fa-fw fa-folder"></i>
          <span>Vacante interno</span>
        </a>
        <div id="vacantesupervisor" class="collapse " aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{route('supervisor.vacante.index')}}">Aplicar</a>
          </div>
        </div>
      </li>-->

      @endif

      @if(auth()->user()->userHasRole('Employee') || auth()->user()->userHasRole('Admin'))

         <!-- Divider -->
         <hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
  Colaboradores
</div>


<!-- Nav Item - Marcaciones Collapse Menu -->
<li class="nav-item active">
  <a class="nav-link" href="#" data-toggle="collapse" data-target="#marcacionescolaboradores" aria-expanded="true" aria-controls="marcacionescolaboradores">
    <i class="fas fa-fw fa-folder"></i>
    <span>Marcaciones</span>
  </a>
  <div id="marcacionescolaboradores" class="collapse " aria-labelledby="headingPages" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <a class="collapse-item" href="{{route('colaborador.marcaciones.index')}}">Mis marcaciones</a>
    </div>
  </div>
</li>
<li class="nav-item active">
  <a class="nav-link" href="#" data-toggle="collapse" data-target="#autogestioncolaboradores" aria-expanded="true" aria-controls="autogestioncolaboradores">
    <i class="fas fa-fw fa-folder"></i>
    <span>Autogestión</span>
  </a>
  <div id="autogestioncolaboradores" class="collapse " aria-labelledby="headingPages" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <a class="collapse-item" href="{{route('autogestion.colaboradores.roles.index')}}">Roles de pago</a>
      <a class="collapse-item" href="{{route('autogestion.colaboradores.formulario.impuesto.index')}}">Formulario gastos</a>
      <a class="collapse-item" href="{{route('autogestion.colaboradores.certificados.index')}}">Certificados</a>
    </div>
  </div>
</li>


  <!-- Nav Item - Solicitudes Collapse Menu -->

  <li class="nav-item active">
  <a class="nav-link" href="#" data-toggle="collapse" data-target="#solicitudescolaboradores" aria-expanded="true" aria-controls="solicitudescolaboradores">
    <i class="fas fa-fw fa-folder"></i>
    <span>Solicitudes</span>
  </a>
  <div id="solicitudescolaboradores" class="collapse " aria-labelledby="headingPages" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <a class="collapse-item" href="{{route('colaborador.solicitudes.index')}}">Mis solicitudes</a>
    </div>
  </div>
</li>

<!-- Nav Item - vacante interno Collapse Menu -->

<li class="nav-item active">
  <a class="nav-link" href="#" data-toggle="collapse" data-target="#vacantecolaboradores" aria-expanded="true" aria-controls="vacantecolaboradores">
    <i class="fas fa-fw fa-folder"></i>
    <span>Vacante interna</span>
  </a>
  <div id="vacantecolaboradores" class="collapse " aria-labelledby="headingPages" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <a class="collapse-item" href="{{route('colaborador.vacante.index')}}">Aplicar</a>
    </div>
  </div>
</li>

@endif
  
@if(auth()->user()->userHasRole('Human Resources') || auth()->user()->userHasRole('Admin'))

       <!-- Divider -->
       <hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
  RECURSOS HUMANOS
</div>

<!-- Nav Item - Empresa Collapse Menu -->
<li class="nav-item active">
  <a class="nav-link" href="#" data-toggle="collapse" data-target="#empresa" aria-expanded="true" aria-controls="empresa">
    <i class="fas fa-fw fa-folder"></i>
    <span>Empresa</span>
  </a>
  <div id="empresa" class="collapse " aria-labelledby="headingPages" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <a class="collapse-item" href="{{route('hhrr.colaboradores.index')}}">Colaboradores</a>
      <a class="collapse-item" href="{{route('hhrr.departamentos.index')}}">Departamentos</a>
       <a class="collapse-item" href="{{route('hhrr.puestostrabajo.index')}}">Puestos de trabajo</a>
    </div>
  </div>
</li>
<!-- Nav Item - Marcaciones Collapse Menu -->
<li class="nav-item active">
  <a class="nav-link" href="#" data-toggle="collapse" data-target="#marcaciones" aria-expanded="true" aria-controls="marcaciones">
    <i class="fas fa-fw fa-folder"></i>
    <span>Marcaciones</span>
  </a>
  <div id="marcaciones" class="collapse " aria-labelledby="headingPages" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
     <!-- <a class="collapse-item" href="{{route('marcaciones.propias.index')}}">Propias</a>-->
      <a class="collapse-item" href="{{route('hhrr.marcaciones.colaboradores')}}">Colaboradores</a>
    </div>
  </div>
</li>
<!-- Nav Item - Marcaciones Collapse Menu -->

<li class="nav-item active">
  <a class="nav-link" href="#" data-toggle="collapse" data-target="#rol" aria-expanded="true" aria-controls="rol">
    <i class="fas fa-fw fa-folder"></i>
    <span>Rol de Pagos</span>
  </a>
  <div id="rol" class="collapse " aria-labelledby="headingPages" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
    <a class="collapse-item" href="{{route('hhrr.nomina.index')}}">Reporte Nómina</a>
      <a class="collapse-item" href="{{route('hhrr.rolpagos.index')}}">Reporte Costo Empleado</a>
      <a class="collapse-item" href="{{route('hhrr.rolpagos.colaborador')}}">Rol por colaborador</a>
    </div>
  </div>
</li>

  <!-- Nav Item - Vacantes Collapse Menu -->

  <li class="nav-item active">
  <a class="nav-link" href="#" data-toggle="collapse" data-target="#vacantes" aria-expanded="true" aria-controls="vacantes">
    <i class="fas fa-fw fa-folder"></i>
    <span>Vacantes</span>
  </a>
  <div id="vacantes" class="collapse " aria-labelledby="headingPages" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
    <a class="collapse-item" href="{{route('vacantes.internos.enviados')}}">Anuncios enviados</a>
      <a class="collapse-item" href="{{route('vacantes.internos.index')}}">Internas</a>
      <a class="collapse-item" href="{{route('vacantes.solicitudesexternos.index')}}">Externas</a>
    </div>
  </div>
</li>

  <!-- Nav Item - Solicitudes Collapse Menu -->

  <li class="nav-item active">
  <a class="nav-link" href="#" data-toggle="collapse" data-target="#solicitudes" aria-expanded="true" aria-controls="solicitudes">
    <i class="fas fa-fw fa-folder"></i>
    <span>Solicitudes</span>
  </a>
  <div id="solicitudes" class="collapse " aria-labelledby="headingPages" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
    <!--<a class="collapse-item" href="{{route('hhrr.solicitudes.propias.index')}}">Propias</a> -->
      <a class="collapse-item" href="{{route('hhrr.solicitudes.colaboradores.index')}}">Colaboradores</a>

    </div>
  </div>
</li>


<!-- Nav Item - Configuracion Collapse Menu -->

<li class="nav-item active">
  <a class="nav-link" href="#" data-toggle="collapse" data-target="#configuracion" aria-expanded="true" aria-controls="configuracion">
    <i class="fas fa-fw fa-folder"></i>
    <span>Configuración</span>
  </a>
  <div id="configuracion" class="collapse " aria-labelledby="headingPages" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <a class="collapse-item" href="{{route('rolpagos.index')}}">Rol de pagos</a>
      <a class="collapse-item" href="{{route('marcaciones.index')}}">Marcaciones</a>
      <a class="collapse-item" href="{{route('solicitudes.index')}}">Solicitudes</a>
    </div>
  </div>
</li>
@endif
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>