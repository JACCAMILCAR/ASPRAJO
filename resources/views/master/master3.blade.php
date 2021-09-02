<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>ASPRAJO</title>
        <link href="{{ asset('frontend6') }}/assets/img/apple-touch-icon.png" rel="apple-touch-icon">
        <link href="{{ asset('frontend') }}/dist/css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        @yield('css_rol')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="#">ASPRAJO</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <div class="input-group">
                
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i>
                    @auth
                        {{ Auth::user()->name }} {{ Auth::user()->rols->isNotEmpty() ? Auth::user()->rols->first()->name : "" }}
                    @endauth
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                      
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Cerrar Sesión</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            @can('isAdministrador')
                                <div class="sb-sidenav-menu-heading">Stock</div>
                                <a class="nav-link" href="{{ url('productos') }}">
                                    <div class="sb-nav-link-icon"><i class="fab fa-product-hunt"></i></div>
                                    Productos
                                </a>
                                <a class="nav-link" href="{{ url('ventas') }}">
                                    <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart"></i></div>
                                    Venta
                                </a>
                                <a class="nav-link" href="{{ url('especies') }}">
                                    <div class="sb-nav-link-icon"><i class="fas fa-sort	"></i></div>
                                    Especie
                                </a>
                                <a class="nav-link" href="{{ url('categorias') }}">
                                    <div class="sb-nav-link-icon"><i class="fab fa-first-order-alt"></i></div>
                                    Categoría
                                </a>
                                <a class="nav-link" href="{{ url('variedads') }}">
                                    <div class="sb-nav-link-icon"><i class="fas fa-certificate"></i></div>
                                    Variedad
                                </a>
                                <a class="nav-link" href="{{ url('unidadMedidas') }}">
                                    <div class="sb-nav-link-icon"><i class="fas fa-ruler-combined"></i></div>
                                    Unidad de Medida
                                </a>
                                <a class="nav-link" href="{{ url('tamanos') }}">
                                    <div class="sb-nav-link-icon"><i class="fas fa-asterisk"></i></div>
                                    Tamaño
                                </a>
                            @endcan
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Authentication
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="login.html">Login</a>
                                            <a class="nav-link" href="password.html">Forgot Ppassword</a>
                                        </nav>
                                    </div>
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                        Error
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="401.html">401 Page</a>
                                            <a class="nav-link" href="404.html">404 Page</a>
                                            <a class="nav-link" href="500.html">500 Page</a>
                                        </nav>
                                    </div>
                                </nav>
                            </div>
                            @canany(['isPresidente','isAsociado'])
                                <div class="sb-sidenav-menu-heading">Menú del usuario</div>
                            @endcanany
                            @can('isPresidente')
                                <a class="nav-link" href="{{ url('rols') }}">
                                    <div class="sb-nav-link-icon"><i class="fab fa-critical-role"></i></div>
                                    Rol
                                </a>
                                <a class="nav-link" href="{{ url('permisos') }}">
                                    <div class="sb-nav-link-icon"><i class="fas fa-universal-access"></i></div>
                                    Permisos
                                </a>
                            @endcan
                            @canany(['isPresidente','isAsociado'])
                                <a class="nav-link" href="{{ url('users') }}">
                                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                    Usuario
                                </a>
                            @endcanany
                            @canany(['isPresidente','isAdministrador'])
                                <div class="sb-sidenav-menu-heading">Reportes</div>
                                    <a class="nav-link" href="{{ url('reporteProductos') }}">
                                        <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                        Reportes de Productos
                                    </a>
                                    
                                    <a class="nav-link" href="{{ url('reporteVentas') }}">
                                        <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                        Reportes de Venta
                                    </a>
                            @endcanany
                        </div>
                    </div>
                   
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <div class="card mb-4">
                            @yield('content')
                            @yield('btn_imprimir')
                        </div>
                    </div>
                </main>
                
            </div>
        </div>
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">¿Esta seguro de cerrar la sesión?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">De lo contrario puede cancelar.</div>
        <div class="modal-footer">
          <button class="btn btn-success" type="button" data-dismiss="modal">Cancelar</button>

          <a class="btn btn-success" href="#"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
              {{ __('¿Salir?') }}
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>

          {{-- <a class="btn btn-success" href="login.html">Logout</a> --}}
        </div>
      </div>
    </div>
  </div>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('frontend') }}/dist/js/scripts.js"></script>
        
        
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        
        @yield('js_rol')
        @yield('js_user')
        
    </body>
</html>
