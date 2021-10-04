<template>
		<div class="container mt-2">

			<div class="row">
          <!-- /.col (left) -->
			  	<div class="col-md-12">
						<div class="card-body table-responsive p-0">
							<table class="table table-hover text-nowrap">
							<thead>
								<tr>
									<th>No.</th>
									<th>Reg No.</th>
									<th>Student Name</th>
									<th>Gender</th>
									<th>Department</th>
								</tr>
							</thead>
							<tbody>
								<tr v-for="student in students" :key="student.id" class="mb-3">
									<td>{{ student.id  }}</td>
									<td >{{ student.regno }}</td>
									<td>
										<span>
											<div class="user-block">
												<img alt="" :src="getProfilePicture()" class="img-circle img-bordered-lg"> 
												<span class="username">
													<a href="#">{{ student.name }}</a>
													<!-- <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a> -->
												</span>
											</div> 
										</span>
											{{ student.name }}
										</td>
									<td> {{ student.name }} <span class="mr-3"><i class="fas fa-ellipsis-v"></i></span> </td>
									<td>{{ student.created_at | dateFormat }}</td>
									
								</tr>
							</tbody>
							</table>
						</div>
						<div class="card-footer">
		            <pagination :data="students" @pagination-change-page="getResults"></pagination>
		         </div>
			</div>
          <!-- /.col (right) -->
        </div>
	</div>
</template>

<script>
	export default {
		data: () => {
			return {
				students: {},
			}
		},

		methods: {
			getProfilePicture(){
		     return 'imgs/user-1.png';
		   },
			loadStudents(){
				axios.get('/students-list').then(({ data }) => (this.students = data));
			},

			getResults(){
				axios.get('/propose-project?page='+page).then(({ data }) => (this.students = data));
			},
		}, 

		created() {
			this.loadStudents();
			Fire.$on('refreshProjects', () => {
				// axios.get('/propose-project').then(response => console.log('hello'));
		})
		}
}
</script>
