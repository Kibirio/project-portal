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
			<div class="offset-2 col-md-7">
				<div class="post" v-for="project in allProjects" :key="project.id">
					<div class="user-block">
						<img alt="" :src="getProfilePicture()" class="img-circle img-bordered-lg"> 
							<span class="username">
								<a href="#">{{ project.name }}</a>
								<!-- <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a> -->
							</span>
							<span class="description">Submitted on - {{ project.created_at | dateFormat }}</span>
							<span class="font-weight-bold text-lg-right">{{ project.title }}</span>
						</div> 
						<p class="mt-0">
							{{ project.description }}
						</p> 
						<p>
							<a href="#" class="link-black text-sm mr-2">
								<i class="fas fa-share mr-1"></i>Language - {{ project.language }}
							</a> 
							<a href="#" class="mr-auto link-black text-sm">
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
								 Type - {{ project.project_type }}
								<span>
									Like<i class="fa fa-thumbs-up mr-1 ml-2"></i>
								</span>
							</a> 
						</p> 
					</div>
					<div class="row">
					<div class="offset-2 col-md-7">
						<pulse-loader :loading="isLoading" :color="color" :size="size"></pulse-loader>
					</div>
		</div>
			<!-- /.card-body -->
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
 import 'vue-loading-overlay/dist/vue-loading.css';
export default {
	data: () => {
		return {
			allProjects: {},
			marks: {},
			color: 'blue',
			size: '20px',
			isLoading: false,
		}
	},

	methods: {
		 getProfilePicture(){
		     return 'imgs/user-1.png';
		   },
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
			this.isLoading =true;
			axios.get('/all-projects')
			.then(({ data }) => {
				this.allProjects = data
				this.isLoading = false;
			})
			.catch(() => {
				this.isLoading = false;
			})
			.finally(() => {
				this.isLoading = false;
			})
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
