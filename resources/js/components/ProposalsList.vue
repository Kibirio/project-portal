<template>
	<div class="container mt-4">

		<nav class="navbar navbar-expand navbar-white navbar-light">
			<!-- Left navbar links -->
			<ul class="navbar-nav">
				<li class="nav-item">
					<p>Export PDF</p>
					<!-- <button class="btn btn-primary btn-xl" @click="assignModalNotice">Assign Supervisor Student<i class="fas fa-users"></i></button> -->
				</li>
			</ul>
			<ul class="ml-auto mb-0">
				<li class="nav-item">
					<!-- <router-link to="/student-supervisor-list" class="btn btn-primary btn-xl" @click="assignModalNotice">View Assignment List<i class="fas fa-users"></i></router-link> -->
				</li>
			</ul>
		</nav>
		<hr>
		<div class="row">
			<div class="col-12">
				<div class="card" v-if="$gate.isStudent()">
					<div class="card-header">
						<h3 class="card-title text-bold">All Proposed Projects</h3>
						<div class="card-tools d-flex">
							<div class="mr-4">
								<!-- <button class="btn btn-success" @click="newModal">Add New <i class="fas fa-user-plus"></i></button> -->
							</div>
						</div>
					</div>
					<!-- /.card-header -->
					<div class="card-body table-responsive p-0">
						<table class="table table-hover text-nowrap">
							<thead>
								<tr>
									<th>Id</th>
									<th>Reg No.</th>
									<th>Project Title </th>
									<th>Project Type</th>
									<th>Date Submited</th>
								</tr>
							</thead>
							<tbody>
								<tr v-for="project in allProjects" :key="project.id" class="mb-3">
									<td>{{ project.id }}</td>
									<td >{{ project.regno }}</td>
									<td> {{ project.title }} <span class="mr-3"></i></span> </td>
									<td>
										<span 
										class="dot-app mr-2"
										:class="[
										project.project_type === 'Web Application' ? 'dot-web' : '', 
										project.project_type == 'Desktop Application' ?  'dot-app' : '',
										project.project_type == 'IOT' ?  'dot-iot' : '',
										project.project_type == 'Networking' ?  'dot-net' : '', 
										project.project_type == 'Machine Learning' ?  'dot-ml' : '',
										project.project_type == 'Data Science' ?  'dot-ds' : '',
										project.project_type == 'Mobile Application' ?  'dot-app' : '',
										]">
									</span>
									{{ project.project_type }}
								</td>
								<td>{{ project.created_at | dateFormat }}</td>
							</tr>
						</tbody>
					</table>
				</div>
			<!-- /.card-body -->
			<div class="card-footer">
				<pagination :data="allProjects" @pagination-change-page="getResults"></pagination>
			</div>
		</div>

		<div v-if="!$gate.isStudent()">
			<not-found></not-found>
		</div>
		<!-- /.card -->
	</div>
</div>

</div>

</template>

<script>
export default {
	data: () => {
		return {
			allProjects: {},
			marks: {},
		}
	},

	methods: {
		editModal(marks){
                this.editMode = true;
				this.form.reset();
				$('#showEditModal').modal('show');
				this.form.fill(marks);
			},
		awardProject(){
			this.editMode = false;
			this.$Progress.start();
			this.form.post('/presentation-list/award-project')
			.then(() => {
				swal.fire({
					title: 'Awarding' ,
					text: "Project Successfully Awarded!",
					icon: 'success',
				})
				Fire.$emit('refreshProjects');
				this.$Progress.finish();
				$('#showAwardModal').modal('hide')
			})
			.catch(() => {
				this.$Progress.fail();
				$('#showAwardModal').modal('hide')
				swal.fire({
					title: 'Failed' ,
					text: "An error occurred! Try Again",
					icon: 'error',
				})
			})
		},

		awardModal(marks){
			this.editMode =true;
			this.form.reset();
			$('#showAwardModal').modal('show');
			this.form.fill(marks);
		},

		getResults(page = 1) {
			axios.get('/propose-project?page='+page).then(({ data }) => (this.allProjects = data));
		},
		
		loadProposals() {
			axios.get('/admin-dashboard/projects').then(({ data }) => (this.allProjects = data));
		},
	},

	created() {
		this.loadProposals();
		Fire.$on('refreshProjects', () => this.loadPresentations);
		Fire.$on('searching', () => {
			let query = this.$parent.search;
			axios.get('api/findUser?q=' + query)
			.then((data) => {
				this.allProjects = data;
					// alert(this.users);
				})
			.catch(() => {
				alert("Error happened");
			});
		});
	}
}
</script>
