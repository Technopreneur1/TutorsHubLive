<template>
    <div class="home-form">
        <div class="steps">
            <div v-if="type == 'student'" class="timeline">
                <div class="step" :class="{active: step == 1}">
                    <span>1</span>
                </div>
                <div class="step" :class="{active: step == 2}">
                    <span>2</span>
                </div>
                <div class="step" :class="{active: step == 3}">
                    <span>3</span>
                </div>
                <div class="step" :class="{active: step == 4}">
                    <span>4</span>
                </div>
                <div class="step" :class="{active: step == 5}">
                    <span>5</span>
                </div>
            </div>
            <!-- Type -->
            <div v-if="step == 1" class="step1">
                <div class="titles">
                    <div class="lgs">Let's Get Started</div>
                    <div class="chp">Choose Your Profile Type</div>
                </div>
                <div class="types">
                    <div class="type">
                        <button @click="selectType('student')" class="btn" :class="{active : type == 'student'}">Studnet</button>
                    </div>
                    <div class="type">
                        <button @click="selectType('seacher')" class="btn" :class="{active : type == 'teacher'}">Teacher</button>
                    </div>
                </div>
            </div>
            <!-- Peronal -->
            <div v-if="step == 2" class=" step2">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" class="form-control" v-model="student.name" placeholder="Name">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" class="form-control" v-model="student.email" placeholder="Name">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Phone</label>
                            <input type="text" class="form-control" v-model="student.phone" placeholder="Name">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">gender</label>
                            <select class="form-control" v-model="student.gender" id="">
                                <option value="">Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="N/A">N/A</option>
                            </select>
                        </div>
                    </div>
                </div>
                
            </div>
            <!-- Step 3 Password -->
            <div v-if="step == 3" class=" step2">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" class="form-control" v-model="student.password" placeholder="Name">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Confirm Password</label>
                            <input type="password" class="form-control" v-model="student.password_confirmation" placeholder="Name">
                        </div>
                    </div>
                </div>
                
            </div>

            <!-- Step 3 Password -->
            <div v-if="step == 4" class=" step2">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Level</label>
                            <select class="form-control" v-model="student.level" id="">
                                <option value="">Level</option>
                                <option v-for="level in levels" :key="level.id" :value="level.id" >{{level.name}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Discipline</label>
                            <select class="form-control" v-model="student.discipline" id="">
                                <option value="">Discipline</option>
                                <option v-for="discipline in disciplines" :key="discipline.id" :value="discipline.id">{{discipline.name}}</option>
                            </select>
                        </div>
                    </div>
                </div>
                
            </div>

            <!-- Step 5 Address -->
             <div v-if="step == 5" class=" step2">
                <div class="row">
                    <div class="col-md-6">
                       <div class="form-group">
                            <label for="">Country</label>
                            <select @change="countrySelected()" class="form-control" v-model="student.country" id="">
                                <option value="" disabled>Country</option>
                                <option v-for="country in countries" :key="country.id"  :value="country.id">{{country.name}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                       <div class="form-group">
                            <label for="">State</label>
                            <select @change="stateSelected()" class="form-control" v-model="student.state" id="">
                                <option value="" disabled>State</option>
                                <option v-for="state in states" :key="state.id" :value="state.id">{{state.name}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                       <div class="form-group">
                            <label for="">City</label>
                            <select @change="citySelected()" class="form-control" v-model="student.city" id="">
                                <option value="" disabled>City</option>
                                <option v-for="city in cities" :key="city.id" :value="city.id">{{city.name}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                       <div class="form-group">
                            <label for="">Neighborhood</label>
                            <select class="form-control" v-model="student.neighborhood" id="">
                                <option value="" disabled>Neighborhood</option>
                                <option v-for="neighborhood in neighborhoods" :key="neighborhood.id" :value="neighborhoods.id">{{neighborhood.name}}</option>
                            </select>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div v-if="step == 6" class="step2">
                <div class="row">
                    <div class="col-md-12">
                        <div class="confirmation-box">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsa placeat, velit facere reiciendis voluptate dicta nesciunt, distinctio enim suscipit magni voluptates voluptas qui numquam? Vel distinctio soluta impedit eos possimus.
                        </div>
                    </div>
                </div>
            </div>
            <div v-if="type == 'student' && step == 6" class="buttons">
                <button @click="back"  class="btn btn-back">Back</button>
                <button @click="next" class="btn btn-next">I Agree</button>
            </div>
            <div v-else class="buttons">
                <button @click="back"  class="btn btn-back">Back</button>
                <button @click="next" class="btn btn-next">Next</button>
            </div>

        </div>

    </div>
</template>

<script>
    export default {
        props: ['url'],
        data()
        {
            return {
                    step: 1,
                    levels: [],
                    disciplines: [],
                    countries: [],
                    states: [],
                    cities: [],
                    neighborhoods: [],
                    type: '',
                    student: {
                        name: '',
                        email: '',
                        gender: '',
                        password: '',
                        confirm_password: '',
                        level: '',
                        discipline: '',
                        phone: '',
                        neighborhood: '',
                        city: '',
                        state: '',
                        country: '',
                    }
            }
        },
        methods: {
            postStudent()
            {
                axios.post(this.url +'/post/student', {
                    type: this.type,
                    name: this.student.name,
                    email: this.student.email,
                    password: this.student.password,
                    phone: this.student.phone,
                    level: this.student.level,
                    discipline: this.student.discipline,
                    country: this.student.country,
                    gender: this.student.gender,
                    state: this.student.state,
                    city: this.student.city,
                    neighborhood: this.student.neighborhood,

                })
                .then(response => {
                    // Redirect user
                })
                .catch(error => {
                    console.log(error);
                })
            },
            countrySelected()
            {
                if(this.student.country)
                {
                    this.getStates()
                }
            },
            stateSelected()
            {
                if(this.student.state)
                {
                    this.getCities()
                }
            },
            citySelected()
            {
                if(this.student.city)
                {
                    this.getNeighborhoods()
                }
            },
            next()
            {
                if(this.type == 'student')
                {
                    if(this.step < 6)
                    {
                        this.step++;
                    }
                    else if(this.step == 6)
                    {
                        this.postStudent()
                    }
                }
            },
            back()
            {
                // if(this.type == 'student')
                // {
                    if(this.step > 1)
                    {
                        this.step--;
                    }
                // }
            },
            selectType(type)
            {
                this.type = type
                this.step = 2
            },
            getLevels()
            {
                axios.post(this.url +'/get/levels')
                .then(response => {
                    this.levels = response.data.levels
                })
                .catch(error => {
                    console.log(error);
                })
            },
            getDisciplines()
            {
                axios.post(this.url +'/get/disciplines')
                .then(response => {
                    this.disciplines = response.data.disciplines
                })
                .catch(error => {
                    console.log(error);
                })
            },
            getCountries()
            {
                axios.post(this.url +'/get/countries')
                .then(response => {
                    this.countries = response.data.countries
                })
                .catch(error => {
                    console.log(error);
                })
            },
            getStates()
            {
                console.log("get State")
                axios.post(this.url +'/get/states', {country: this.student.country})
                .then(response => {
                    console.log(response)
                    this.states = response.data.states
                })
                .catch(error => {
                    console.log(error);
                })
            },
            getCities()
            {
                axios.post(this.url +'/get/cities', {state: this.student.state})
                .then(response => {
                    this.cities = response.data.cities
                })
                .catch(error => {
                    console.log(error);
                })
            },
            getNeighborhoods()
            {
                axios.post(this.url +'/get/neighborhoods', {city: this.student.city})
                .then(response => {
                    this.neighborhoods = response.data.neighborhoods
                })
                .catch(error => {
                    console.log(error);
                })
            },
        },
        mounted()
        {
            this.getDisciplines()
            this.getLevels()
            this.getCountries()
            // this.getNeighborhoods()
        }
    }
</script>
