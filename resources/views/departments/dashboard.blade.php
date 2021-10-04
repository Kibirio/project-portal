<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>GitLab</title>

	<meta name="csrf-token" content="{{ csrf_token() }}">

 <link rel="stylesheet" href="/css/app.css">
 <link rel="stylesheet" href="/css/select2.min.css">
	<!-- Theme style -->
<!-- <link rel="stylesheet" type="text/css" href="dist/css/adminlte.min.css"> -->
<link rel="stylesheet" href="/css/adminlte.min.css">
	
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper" id="app">

	<!-- Navbar -->
	<nav class="main-header navbar navbar-expand navbar-white navbar-light">
		<!-- Left navbar links -->
		<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
			</li>
			<!-- Navbar Search -->
			<li class="nav-item">
					{{-- <form class="form-inline ml-3 mt-1"> --}}
						<div class="input-group input-group-sm">
							<input class="form-control form-control-navbar" type="search" @keyup="searchit" v-model="search" placeholder="Search" aria-label="Search">
							<div class="input-group-append">
								<button class="btn btn-navbar" @click="searchit">
									<i class="fas fa-search"></i>
								</button>
							</div>
						</div>
					{{-- </form> --}}
			</li>
		</ul>

		<!-- Right navbar links -->
		<ul class="navbar-nav ml-auto">
			

			<!-- Messages Dropdown Menu -->
			<li class="nav-item dropdown">
				<a class="nav-link" data-toggle="dropdown" href="#">
					<i class="fas fa-comments"></i>
					<span class="badge badge-danger navbar-badge">3</span>
				</a>
				<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
					<a href="#" class="dropdown-item">
						<!-- Message Start -->
						<div class="media">
							<img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
							<div class="media-body">
								<h3 class="dropdown-item-title">
									Brad Diesel
									<span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
								</h3>
								<p class="text-sm">Call me whenever you can...</p>
								<p class="text-sm text-muted"><i class="fas fa-clock mr-1"></i> 4 Hours Ago</p>
							</div>
						</div>
						<!-- Message End -->
					</a>
					<div class="dropdown-divider"></div>
					<a href="#" class="dropdown-item">
						<!-- Message Start -->
						<div class="media">
							<img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
							<div class="media-body">
								<h3 class="dropdown-item-title">
									John Pierce
									<span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
								</h3>
								<p class="text-sm">I got your message bro</p>
								<p class="text-sm text-muted"><i class="fas fa-clock mr-1"></i> 4 Hours Ago</p>
							</div>
						</div>
						<!-- Message End -->
					</a>
					<div class="dropdown-divider"></div>
					<a href="#" class="dropdown-item">
						<!-- Message Start -->
						<div class="media">
							<img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
							<div class="media-body">
								<h3 class="dropdown-item-title">
									Nora Silvester
									<span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
								</h3>
								<p class="text-sm">The subject goes here</p>
								<p class="text-sm text-muted"><i class="fas fa-clock mr-1"></i> 4 Hours Ago</p>
							</div>
						</div>
						<!-- Message End -->
					</a>
					<div class="dropdown-divider"></div>
					<a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
				</div>
			</li>
			<!-- Notifications Dropdown Menu -->
			<li class="nav-item dropdown">
				<a class="nav-link" data-toggle="dropdown" href="#">
					<i class="fas fa-bell"></i>
					<span class="badge badge-warning navbar-badge">15</span>
				</a>
				<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
					<span class="dropdown-header">15 Notifications</span>
					<div class="dropdown-divider"></div>
					<a href="#" class="dropdown-item">
						<i class="fas fa-envelope mr-2"></i> 4 new messages
						<span class="float-right text-muted text-sm">3 mins</span>
					</a>
					<div class="dropdown-divider"></div>
					<a href="#" class="dropdown-item">
						<i class="fas fa-users mr-2"></i> 8 friend requests
						<span class="float-right text-muted text-sm">12 hours</span>
					</a>
					<div class="dropdown-divider"></div>
					<a href="#" class="dropdown-item">
						<i class="fas fa-file mr-2"></i> 3 new reports
						<span class="float-right text-muted text-sm">2 days</span>
					</a>
					<div class="dropdown-divider"></div>
					<a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
				</div>
			</li>
			<li class="nav-item">
				<a class="nav-link" data-widget="fullscreen" href="#" role="button">
					<i class="fas fa-expand-arrows-alt"></i>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
					<i class="fas fa-th-large"></i>
				</a>
			</li>
		</ul>
	</nav>
	<!-- /.navbar -->

	<!-- Main Sidebar Container -->
	<aside class="main-sidebar sidebar-dark-primary elevation-4">
		<!-- Brand Logo -->
		<a href="index3.html" class="brand-link">
			<img src="./imgs/mmust-logo.png" alt="scigit logo" class="brand-image img-circle elevation-3" style="opacity: .8">
			<span class="brand-text font-weight-light">Sky Git</span>
		</a>

		<!-- Sidebar -->
		<div class="sidebar">
			<!-- Sidebar user panel (optional) -->
			<div class="user-panel mt-3 pb-3 mb-3 d-flex">
				<div class="image">
					<img src="./imgs/user.png" class="img-circle elevation-4" alt="User Image">
				</div>
				<div class="info">
					<a href="#" class="d-block">{{ Auth::user()->name }}</a>
					<p class="{{ Auth::user()->type == 'admin' ? 'badge badge-admin' : 'badge badge-student' }}">{{ Auth::user()->type }}</p>
				</div>
			</div>


			<!-- Sidebar Menu -->
			@can('isStudent')
			<nav class="mt-2">
				<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"    data-accordion="false">
					<!-- Add icons to the links using the .nav-icon class
							 with font-awesome or any other icon font library -->
					<li class="nav-item menu-open">
						<router-link to="student-list" class="nav-link">
							<i class="nav-icon fas fa-cog"></i>
							<p>
								Student Board 
								<i class="right fas fa-angle-left"></i>
							</p> 
						</router-link>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<router-link to="/proposals-list" class="nav-link">
									<i class="fas fa-users nav-icon"></i>
									<p>Projects List</p>
								</router-link>
							</li>
						</ul>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<router-link to="/student-list" class="nav-link">
									<i class="fas fa-users nav-icon"></i>
									<p>My Current Project</p>
								</router-link>
							</li>
					</li>
					@endcan()

					@can('isAdmin')
					<nav class="mt-2">
						<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"    data-accordion="false">
							<li class="nav-item menu-open">
								<router-link to="/admin-dashboard" class="nav-link">
									<i class="nav-icon fas fa-cog"></i>
									<p>
										Coordinator Board
										<i class="right fas fa-angle-left"></i>
									</p> 
								</router-link>
								<ul class="nav nav-treeview">
									<li class="nav-item">
										<router-link to="/students-list" class="nav-link">
											<i class="fas fa-users nav-icon"></i>
											<p>Student List</p>
										</router-link>
									</li>
								</ul>
								<ul class="nav nav-treeview">
									<li class="nav-item">
										<router-link to="/supervisors-list" class="nav-link">
											<i class="fas fa-users nav-icon"></i>
											<p>Supervisors List</p>
										</router-link>
									</li>
								</ul>
								<ul class="nav nav-treeview">
									<li class="nav-item">
										<router-link to="/proposals-list-pending" class="nav-link">
											<i class="fas fa-users nav-icon"></i>
											<p>Proposal List</p>
										</router-link>
									</li>
								</ul>
								<ul class="nav nav-treeview">
									<li class="nav-item">
										<router-link to="/proposals-list-approved" class="nav-link">
											<i class="fas fa-users nav-icon"></i>
											<p>Accepted Proposal List</p>
										</router-link>
									</li>
								</ul>
								<ul class="nav nav-treeview">
									<li class="nav-item">
										<router-link to="/presentations-list" class="nav-link">
											<i class="fas fa-users nav-icon"></i>
											<p>Presentation List</p>
										</router-link>
									</li>
								</ul>
							</li>
					@endcan()

					@can('isSupervisor')
					<nav class="mt-2">
						<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"    data-accordion="false">
							<li class="nav-item menu-open">
								<router-link to="/admin-dashboard" class="nav-link">
									<i class="nav-icon fas fa-cog"></i>
									<p>
										Supervisor Board
										<i class="right fas fa-angle-left"></i>
									</p> 
								</router-link>
								<ul class="nav nav-treeview">
									<li class="nav-item">
										<router-link to="/student-list-supervisor" class="nav-link">
											<i class="fas fa-users nav-icon"></i>
											<p>Student List</p>
										</router-link>
									</li>
								</ul>
								<ul class="nav nav-treeview">
									<li class="nav-item">
										<router-link to="/proposals-list" class="nav-link">
											<i class="fas fa-users nav-icon"></i>
											<p>Proposal List</p>
										</router-link>
									</li>
								</ul>
								<ul class="nav nav-treeview">
									<li class="nav-item">
										<router-link to="/new-proposal" class="nav-link">
											<i class="fas fa-users nav-icon"></i>
											<p>Submit Proposal</p>
										</router-link>
									</li>
								</ul>
							</li>
					@endcan()
				
						<li class="nav-item">
							<a href="{{ route('logout') }}" class="nav-link"
								onclick="event.preventDefault();
									document.getElementById('logout-form').submit();">
								<i class="nav-icon fas fa-power-off"></i>
								<p>
									Logout
								</p>
							</a>
							<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
									@csrf
							</form>
						</li>
					</ul>
				</nav>
			<!-- /.sidebar-menu -->
		</div>
		<!-- /.sidebar -->
	</aside>

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Main content -->
		<div class="content">
			<div class="container-fluid">
				<router-view></router-view>
				<vue-progress-bar></vue-progress-bar>
				<dashboard 
					:pending= '{{ $pending }}'
					:approved = '{{ $approved }}'
					:projects = '{{ $projects }}'
					:cancelled = '{{ $cancelled }}'
					:python = '{{ $python }}'
					:java = '{{ $java }}'
					:cpp = '{{ $cpp }}'
					:c = '{{ $c }}'
					:js = '{{ $js }}'
					:csharp = '{{ $csharp }}'
					:php = '{{ $php }}'
					:web = '{{ $web }}'
					:apps = '{{ $apps }}'
					:desktop = '{{ $desktop }}'
					:iot = '{{ $iot }}'
					:networking = '{{ $networking }}'
					:ml = '{{ $ml }}'
					:ds = '{{ $ds }}'
					>
				</dashboard>
			</div><!-- /.container-fluid -->
		</div>
		<!-- /.content -->
	</div>
	<!-- /.content-wrapper -->

	<!-- Control Sidebar -->
	<aside class="control-sidebar control-sidebar-dark">
		<!-- Control sidebar content goes here -->
		<div class="p-3">
			<h5>Title</h5>
			<p>Sidebar content</p>
		</div>
	</aside>
	<!-- /.control-sidebar -->

	<!-- Main Footer -->
	<footer class="main-footer">
		<!-- To the right -->
		<div class="float-right d-none d-sm-inline">
			Anything you want
		</div>
		<!-- Default to the left -->
		<strong>Copyright &copy;2021 <a href="">SCI GITLAB</a>.</strong> All rights reserved.
	</footer>
</div>
<!-- ./wrapper -->
@auth
<script>
	window.user = @json(auth()->user());
</script>
@endauth
<!-- REQUIRED SCRIPTS -->

<script src="/js/app.js"></script>
</body>
</html>

	
