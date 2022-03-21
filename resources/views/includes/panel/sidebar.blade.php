<!-- Sidenav -->
<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
	<div class="scrollbar-inner">
	<!-- Brand -->
	<div class="sidenav-header bg-dark align-items-center">
		<a class="navbar-brand" href="javascript:void(0)">
			<img src="{{asset('img/logo.svg')}}" class="navbar-brand-img" alt="..." width="170">
		</a>
	</div>
	<div class="navbar-inner">
		<!-- Collapse -->
		<div class="collapse navbar-collapse" id="sidenav-collapse-main">
			<!-- Nav items -->
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link {{request() -> is('admin/noticias*') ? 'active' : ''}}" href="#navbar-noticias" data-toggle="collapse" role="button" aria-expanded="{{request() -> is('admin/noticias*') ? 'true' : 'false'}}" aria-controls="navbar-tables">
						<i class="ni ni-books text-default"></i>
						<span class="nav-link-text">Noticias</span>
					</a>
					<div class="collapse {{request() -> is('admin/noticias*') ? 'show' : ''}}" id="navbar-noticias">
						<ul class="nav nav-sm flex-column">
							<li class="nav-item">
								<a class="nav-link {{request() -> is('admin/categorias/blog*') ? 'active' : ''}}" href="{{route('panel.categorias.index', ['seccion' => 'blog'])}}">
									<i class="ni ni-tag text-default"></i>
									<span class="nav-link-text">Categorías</span>
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link {{request() -> is('admin/noticias*') ? 'active' : ''}}" href="{{route('panel.noticias.index')}}">
									<i class="ni ni-bullet-list-67 text-default"></i>
									<span class="nav-link-text">Noticias</span>
								</a>
							</li>
						</ul>
					</div>
				</li>
				<li class="nav-item">
					<a class="nav-link {{request() -> is('admin/customer*') ? 'active' : '' }}" href="{{ route('panel.customer.index') }}">
						<i class="ni ni-single-02 text-default"></i>
						<span class="nav-link-text">Clientes</span>
					</a>
				</li>
				@can(PermissionKey::Admin['permissions']['index']['name'])
					<li class="nav-item">
						<a class="nav-link {{request() -> is('admin/cuentas/usuarios*') ? 'active' : '' }}" href="{{ route('panel.admins.index') }}">
							<i class="ni ni-single-02 text-default"></i>
							<span class="nav-link-text">Usuarios Panel</span>
						</a>
					</li>
				@endcan
			</ul>
		</div>
	</div>
	</div>
</nav>
