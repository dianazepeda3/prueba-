<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Titulación DIVTIC</title>
    <link rel="icon" type="image/png" href="{{ asset("logo_udg.png")}} ">

    <!-- Custom fonts for this template-->
    <link href="{{ asset("vendor/fontawesome-free/css/all.min.css") }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset("css/sb-admin-2.min.css") }}" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="{{ asset("vendor/datatables/dataTables.bootstrap4.min.css") }}" rel="stylesheet">
    <!-- Dependencias de Signature Pad -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/signature_pad/dist/signature-pad.css">
    <script src="https://cdn.jsdelivr.net/npm/signature_pad"></script>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            {{-- <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Titulación DIVTIC</div>
            </a> --}}

            <!-- Sidebar - Brand -->
            <div class="d-none d-sm-none d-md-block">
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('profile.show')}}">
                    <img src="{{asset('img/universidad-guadalajara-mexico.jpg')}}" class="img-fluid" alt="logo" height="60" width="180">
                </a>
             </div>
             <div class="d-block d-sm-block d-md-none">
                <div class="sidebar-brand-text mx-3">Titulación DIVTIC</div>
            </div>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{route('dashboard')}}">
                    {{-- <i class="fas fa-fw fa-tachometer-alt"></i> --}}
                    <i class="fas fa-user-graduate"></i>
                    <span>Tr&aacute;mites</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Menú
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            @can('admin')
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-users"></i>
                    <span>Usuarios</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Menú Usuarios:</h6>
                        <a class="collapse-item" href="{{ route('admin.usuarios.create') }}">Registrar Usuario</a>
                        <a class="collapse-item" href="{{ route('admin.usuarios.index') }}">Ver listado</a>
                    </div>
                </div>
            </li>
            @endcan

            <!-- Nav Item - Utilities Collapse Menu -->
            @can('admin-coordinador')                            
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                        aria-expanded="true" aria-controls="collapseUtilities">
                        <i class="fas fa-chalkboard-teacher"></i>
                        <span>Maestros</span>
                    </a>
                    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Menú Maestros:</h6>
                            <a class="collapse-item" href="{{ route('admin.maestros.create') }}">Registrar Maestro</a>
                            <a class="collapse-item" href="{{ route('admin.maestros.index') }}">Ver Listado</a>
                        </div>
                    </div>
                </li>
            @endcan

            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.firma')}}">
                    {{-- <i class="fas fa-fw fa-tachometer-alt"></i> --}}
                    <i class="fas fa-edit"></i>
                    <span>Firma Digital</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    {{-- <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Buscar..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-dark" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form> --}}

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                       <!-- Nav Item - Messages -->
                       <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link " href="{{route('chatify')}}" role="button"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter" id="cantidadMensajes"></span>
                            </a>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                                <i class="fas fa-angle-down"></i>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                {{-- <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a> --}}
                                <a class="dropdown-item" href="{{ route('admin.perfil.show') }}">
                                    <i class="fas fa-user-circle fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Perfil
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>

                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->
                @yield('content')
            </div>
            <!-- End of Main Content -->

            <!-- Contenido -->


            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; CUCEI 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">¿Seguro que quiere salir?</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                  </button>
              </div>
              <div class="modal-body">Presione "Salir" para confirma su salida del sistema.</div>
              <div class="modal-footer">
                  <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                  <form method="POST" action="{{ route('logout') }}">
                      @csrf
                      <a class="btn btn-primary" href="{{ route('logout') }}"
                          onclick="event.preventDefault();this.closest('form').submit();">Salir</a>
                  </form>
              </div>
          </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset("vendor/jquery/jquery.min.js") }}"></script>
    <script src="{{ asset("vendor/bootstrap/js/bootstrap.bundle.min.js") }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset("vendor/jquery-easing/jquery.easing.min.js") }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset("js/sb-admin-2.min.js") }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset("vendor/datatables/jquery.dataTables.js") }}"></script>
    <script src="{{ asset("vendor/datatables/dataTables.bootstrap4.min.js") }}"></script>

    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
        $(document).ready(function() {
            $('#tramitesTable').DataTable({
                order: [],
                responsive: true,
                autoWidth: false
            });
        });
    </script>

    {{-- Que se vean los mensajes nuevos que han llegado con una petición de jquery --}}
    <script>
        $(document).ready(function() {
                $.ajax({
                    url: "{{ route('admin.mensajes.sinleer') }}",
                    type: "GET",
                    success: function(data) {
                        $("#cantidadMensajes").text(data);
                    }
                });
        });


    </script>


</body>

</html>
