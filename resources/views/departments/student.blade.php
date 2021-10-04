@extends('layouts.master')

	<!-- Content Wrapper. Contains page content -->
	@section('dashboard')
	<div class="">
		<!-- Main content -->
		<div class="content">
			<div class="container-fluid">
				<div class="container mt-2">
			<div class="row">

				<div class="col-lg-3 col-6">
					<!-- small box -->
					<div class="small-box bg-info">
						<div class="inner">
							<h3>Pending:</h3>
							<p>
								<span class="ml-3 font-weight-bold">
								{{ count($sikp) }}
								</span> 
							</p>
						</div>
						<div class="icon">
							<i class="fas fa-clipboard-check"></i>
						</div>
						<a href="#" class="small-box-footer">Pending <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-6">
					<!-- small box -->
					<div class="small-box bg-info">
						<div class="inner">
							<h3>Pending:</h3>
							<p>
								<span class="ml-3 font-weight-bold">
								{{ count($sikp) }}
								</span> 
							</p>
						</div>
						<div class="icon">
							<i class="fas fa-clipboard-check"></i>
						</div>
						<a href="#" class="small-box-footer">Pending <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-6">
					<!-- small box -->
					<div class="small-box bg-info">
						<div class="inner">
							<h3>Pending:</h3>
							<p>
								<span class="ml-3 font-weight-bold">
								{{ count($sikp) }}
								</span> 
							</p>
						</div>
						<div class="icon">
							<i class="fas fa-clipboard-check"></i>
						</div>
						<a href="#" class="small-box-footer">Pending <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-6">
					<!-- small box -->
					<div class="small-box bg-info">
						<div class="inner">
							<h3>Pending:</h3>
							<p>
								<span class="ml-3 font-weight-bold">
								{{ count($sikp) }}
								</span> 
							</p>
						</div>
						<div class="icon">
							<i class="fas fa-clipboard-check"></i>
						</div>
						<a href="#" class="small-box-footer">Pending <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
			</div>
			<hr>
			</div>
				
			</div><!-- /.container-fluid -->
		</div>
		<!-- /.content -->
	</div>
	@endsection
	<!-- /.content-wrapper -->

	<!-- Control Sidebar -->
	
