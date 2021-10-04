<template>
    <div>
        <section class="h-100 h-custom" style="background-color: #8fc4b7;">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-lg-8 col-xl-6">
                        <div class="card rounded-3">
                        <img src="https://mdbootstrap.com/img/Photos/new-templates/bootstrap-registration/img3.jpg" class="w-100" style="border-top-left-radius: .3rem; border-top-right-radius: .3rem;" alt="Sample photo">
                        <div class="card-body p-4 p-md-5">
                            <h3 class="mb-2 pb-2 pb-md-0 mb-md-5 px-md-2 text-center">Create Account</h3>

                            <form @submit.prevent="createStudent()" class="px-md-2">
                                
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline datepicker">
                                            <input 
                                            id="name"
                                            type="text"
                                            class="form-control"
                                            v-model="form.name"
                                            name="name"
                                            :class="{ 'is-invalid': form.errors.has('name') }"
                                            />
                                            <has-error :form="form" field="name" />
                                            <label for="exampleDatepicker1" class="form-label">First Name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline datepicker">
                                            <input
                                                id="last_name"
                                                type="text"
                                                class="form-control"
                                                v-model="form.last_name"
                                                name="name"
                                                :class="{ 'is-invalid': form.errors.has('name') }"
                                            />
                                            <has-error :form="form" field="name" />
                                            <label for="exampleDatepicker1" class="form-label">Last Name</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                    <div class="form-outline datepicker">
                                        <input
                                        id="school"
                                        type="text"
                                        class="form-control"
                                        v-model="form.school"
                                        name="school"
                                        :class="{ 'is-invalid': form.errors.has('school') }"
                                        />
                                        <has-error :form="form" field="school" />
                                        <label for="exampleDatepicker1" class="form-label">School/Faculty</label>
                                    </div>

                                    </div>
                                    <div class="col-md-6 mb-4 ">
                                        <select 
                                            id="department" 
                                            v-model="form.department" 
                                            name="department"  
                                            class="custom-select"
                                            :class="{ 'is-invalid': form.errors.has('department') }"
                                            >
                                            <option selected>Select Department</option>
                                            <option value="Computer Science">Computer Science</option>
                                            <option value="Information Technology">Information Technology</option>
                                            <option value="SIK">SIK</option>
                                            <option value="ETS">ETS</option>
                                        </select>
                                        <has-error :form="form" field="department" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <input
                                            id="reg_no"
                                            type="text"
                                            class="form-control"
                                            v-model="form.registration_number"
                                            name="reg_no"
                                            :class="{ 'is-invalid': form.errors.has('registration_number') }"
                                        />
                                        <has-error :form="form" field="registration_number" />
                                        <label class="form-label" for="form3Example1w">Reg Number</label>
                                    </div>

                                    </div>
                                    <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <input
                                            id="email"
                                            type="email"
                                            class="form-control"
                                            v-model="form.email"
                                            name="email"
                                            :class="{ 'is-invalid': form.errors.has('email') }"
                                        />
                                        <has-error :form="form" field="email" />
                                        <label class="form-label" for="form3Example1w">Email</label>
                                    </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <input
                                            id="password"
                                            type="password"
                                            class="form-control"
                                            v-model="form.password"
                                            name="password"
                                            :class="{ 'is-invalid': form.errors.has('password') }"
                                        />
                                        <has-error :form="form" field="password" />
                                        <label class="form-label" for="form3Example1w">Password</label>
                                    </div>

                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <input
                                                id="confirm_password"
                                                type="password"
                                                class="form-control"
                                                v-model="form.confirm_password"
                                                name="confirm_password"
                                                :class="{ 'is-invalid': form.errors.has('password') }"
                                            />
                                            <has-error :form="form" field="password" />
                                            <label class="form-label" for="form3Example1w">Confirm Password</label>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success btn-lg btn-block mb-1">Submit</button>
                            <!-- </div> -->
                            </form>
                    </div>
                </div>
            </div>
            </div>
            </div>
        </section>
    </div>
</template>


<script>
export default {
    data: () => {
        return {
            // students: {},
            form : new Form({
                'name': '',
                'school': '',
                'department': '',
                'registration_number': '',
                'email': '',
                'password': '',
            })
        }
    },

    methods: {
        createStudent(){
				this.$Progress.start();
				this.form.post('/student-register')
				.then(() => {
					// Fire.$emit('refreshUsers');
					toast.fire({
						type: 'success',
						title: 'User created successfully'
					})
					this.$Progress.finish();
                    this.form.reset();
                    window.location.href = '/dashboard';
				})
				.catch(() => {

				})
			}
    },

    created() {
        
    },
}
</script>