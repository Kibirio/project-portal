<template>
		<div class="container mt-2">
			<nav class="navbar navbar-expand navbar-white navbar-light">
		<!-- Left navbar links -->
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link">Department Analytics</a>
					</li>
				</ul>
				<ul class="ml-auto mb-0">
					<li class="nav-item">
						<a class="nav-link text-muted">General Information</a>
					</li>
				</ul>
			</nav>
			<hr class="mt-0">
				<div class="row">
					<div class="col-lg-3 col-6">
						<!-- small box -->
						<div class="small-box bg-info">
							<div class="inner">
								<!-- <h3>Pending:</h3> -->
								<p>Pending <span class="ml-3 font-weight-bold">40</span> </p>
								<p>Rejected</p>
								<p>Computer Science</p>
							</div>
							<div class="icon">
								<i class="fas fa-clipboard-check"></i>
							</div>
							<a href="#" class="small-box-footer">Computer Science <i class="fas fa-arrow-circle-right"></i></a>
						</div>
					</div>
					<!-- ./col -->
					<div class="col-lg-3 col-6">
						<!-- small box -->
						<div class="small-box bg-success">
							<div class="inner">
								<h3>34<sup style="font-size: 20px"></sup></h3>

								<p>Information Technology</p>
							</div>
							<div class="icon">
								<i class="fas fa-calendar-alt"></i>
							</div>
							<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
						</div>
					</div>
					<!-- ./col -->
					<div class="col-lg-3 col-6">
						<!-- small box -->
						<div class="small-box bg-warning">
							<div class="inner">
								<h3>0</h3>

								<p>SIK</p>
							</div>
							<div class="icon">
								<i class="fas fa-calendar-times"></i>
							</div>
							<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
						</div>
					</div>
					<!-- ./col -->
					<div class="col-lg-3 col-6">
						<!-- small box -->
						<div class="small-box bg-danger">
							<div class="inner">
								<h3>4</h3>

								<p>ETS</p>
							</div>
							<div class="icon">
								<i class="fas fa-check-double"></i>
							</div>
							<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
						</div>
					</div>
					<!-- ./col -->
				</div>
				<hr>
		</div>
</template>

<script>
	export default {
		data: () => {
			return {
				projects: {},
			}
		},

		methods: {

		}, 

		created() {
			Fire.$on('refreshProjects', () => {
				axios.get('/propose-project').then();
		})
		}
}
</script>
