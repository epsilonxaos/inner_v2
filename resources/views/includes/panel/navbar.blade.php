<!-- Topnav -->
<nav class="navbar navbar-top navbar-expand navbar-dark bg-default border-bottom">
  <div class="container-fluid">
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Navbar links -->
          <ul class="navbar-nav align-items-center  ml-md-auto ">
              <li class="nav-item d-xl-none">
                  <!-- Sidenav toggler -->
                  <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin"
                      data-target="#sidenav-main">
                      <div class="sidenav-toggler-inner">
                          <i class="sidenav-toggler-line"></i>
                          <i class="sidenav-toggler-line"></i>
                          <i class="sidenav-toggler-line"></i>
                      </div>
                  </div>
              </li>
          </ul>
          <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
              <li class="nav-item dropdown">
                  <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                      aria-expanded="false">
                      <div class="media align-items-center">
                          <span class="avatar avatar-sm rounded-circle" style="background-image: url({{asset(auth()->user()->avatar) }}); background-position: center; background-repeat: no-repeat; background-size: cover">
                              <img alt="Image placeholder" src="{{asset(auth()->user()->avatar) }}" style="opacity: 0">
                          </span>

                          <div class="media-body  ml-2  d-none d-lg-block">
                              <span class="mb-0 text-sm  font-weight-bold">{{ auth()->user()->name  }}</span>
                          </div>
                      </div>
                  </a>
                  <div class="dropdown-menu  dropdown-menu-right ">
                        @can(PermissionKey::Admin['permissions']['edit']['name'])
                            <a href="{{ route('panel.admins.edit', ['id' => auth()->user()->id]) }}" class="dropdown-item">
                                <i class="ni ni-single-02"></i>
                                <span>Mi perfil</span>
                            </a>
                        @endcan
                        @can(PermissionKey::Seo['permissions']['index']['name'])
                            <a href="{{ route('panel.seo.index') }}" class="dropdown-item">
                                <i class="ni ni-world-2"></i>
                                <span>Configurar SEO</span>
                            </a>
                        @endcan
                        <div class="dropdown-divider"></div>
                        <form action="{{ route('panel.admins.logout') }}" method="POST">
                            {{ csrf_field() }}
                            <button class="dropdown-item">
                                <i class="ni ni-button-power"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                  </div>
              </li>
          </ul>
      </div>
  </div>
</nav>
