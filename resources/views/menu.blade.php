<!-- Desplegable -->
<ul id="dropdown1" class="dropdown-content">
	<li><a href="#!">Usuario</a></li>
	<li class="divider"></li>
	<li><a href="#!">Salir</a></li>
</ul>

<ul id="ddw_comercial" class="dropdown-content">
	<li><a href="{{ route('show_comercial_performance') }}">Performance comercial</a></li>
</ul>


<div class="navbar-fixed">
	<nav>
		<div class="nav-wrapper">
			<a href="#!" class="brand-logo" id='logo'>
				<img src="{{asset('img/logo.gif')}}" alt="">
			</a>

			<a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
			
			<ul class="right hide-on-med-and-down">
				<li class='bold'><a href="#">Agence</a></li>
				<li><a href="#">Projectos</a></li>
				<li><a href="#">Administrativo</a></li>
				<li><a href="#" class="dropdown-button" data-activates="ddw_comercial">Comercial<i class="material-icons right">arrow_drop_down</i></a></li>
				<li><a href="#">Financiero</a></li>

				<li><a class="dropdown-button" href="#!" data-activates="dropdown1">Opciones<i class="material-icons right">arrow_drop_down</i></a></li>
			</ul>





			<ul class="side-nav" id="mobile-demo">

				<a href="/" class='center' id='logo-menu'>
					<img src="{{asset('img/logo.gif')}}" alt="">
				</a>

				<li><a href="#">Agence</a></li>
				<li><a href="#">Projectos</a></li>
				<li><a href="#">Administrativo</a></li>
				
				<li class="no-padding">
					<ul class="collapsible collapsible-accordion">
						<li>
							<a class="collapsible-header">Comercial<i class="mdi-navigation-arrow-drop-down right"></i></a>
							
							<div class="collapsible-body">
								<ul>
									<li><a href="{{ route('show_comercial_performance') }}">Comercial performance</a></li>
								</ul>
							</div>
						</li>
					</ul>
				</li>

				<li><a href="#">Financiero</a></li>		



				
				<li class="divider"></li>
				<li><a href="#!">Usuario</a></li>
				<li><a href="#!">Salir</a></li>

			</ul>




		</div>
	</nav>
</div>