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
                                    <th>Joined On</th>
                                    <th>Department</th>
                                </tr>
                            </thead>
                            <tbody>
                                <div class="row">
                                    <div class="offset-5 col-md-5">
                                        <pulse-loader :loading="loading" :color="color" :size="size"></pulse-loader>
                                    </div>
                                </div>
                                <tr v-for="student in students" :key="student.id" class="mb-3">
                                    <td>{{ student.id  }}</td>
                                    <td >{{ student.regno }}</td>
                                    <td>
                                    	
                                        <span class="mt-0 mr-2">
                                        	<div v-if="student.gender === 'Male' ">
	                                            <div class="user-block">
	                                                <img alt="" :src="getMaleProfilePicture()" class="img-thumbnail"> 
	                                            </div>
                                    		</div>
                                    		<div v-if="student.gender === 'Female' ">
	                                            <div class="user-block">
	                                                <img alt="" :src="getFemaleProfilePicture()" class="img-thumbnail"> 
	                                            </div>
                                    		</div>
                                        </span>
                                            {{ student.student_name }}
                                        </td>
                                    <td> {{ student.gender }} </td>
                                    <td>{{ student.created_at | dateFormat }}</td>
                                    <td>{{ student.department }}</td>
                                    
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
                loading: false,
                size: '30px',
                color: 'blue',
            }
        },

        methods: {
            getFemaleProfilePicture(){
             return 'imgs/female.png';
           },
           getMaleProfilePicture(){
             return 'imgs/male.png';
           },
            loadStudents(){
            	this.loading = true
                axios.get('/students-list')
                .then(({ data }) => {
                	this.students = data.students
                	this.loading = false;;
                })
                .catch(() => {
                	this.loading = false;
                }) 
            },

            getResults(){
                axios.get('/propose-project?page='+page).then(({ data }) => (this.students = data));
            },
        }, 

        mounted() {
            this.loadStudents();
            Fire.$on('refreshProjects', () => {
                this.loadStudents();
        });
    }
}
</script>
