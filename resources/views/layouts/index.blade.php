
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
 <link rel="stylesheet" href="{{ asset('css/mdbootstrap.min.css') }}">
	<!-- Theme style -->
	<link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper" id="app">

	<!-- Navbar -->
	<nav class="navbar navbar-expand-lg navbar-fixed navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Features</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Pricing</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li>
    </ul>
  </div>
</nav>

		<!-- Main content -->
		<div class="content">
			<div class="container-fluid">
				<router-view></router-view>
				<vue-progress-bar></vue-progress-bar>
			</div><!-- /.container-fluid -->
		</div>
		<!-- /.content -->
	</div>


	<!-- Main Footer -->
	<footer class="main-footer">
		<!-- To the right -->
		<div class="float-right d-none d-sm-inline">
			Anything you want
		</div>
		<!-- Default to the left -->
		<strong>Copyright &copy;2021 <a href="https://adminlte.io">SCI GITLAB</a>.</strong> All rights reserved.
	</footer>
</div>

<!-- REQUIRED SCRIPTS -->

<script src="/js/app.js"></script>
<script src="{{ asset('js/mdbootstrap.min.js') }}"></script>
</body>
</html>
