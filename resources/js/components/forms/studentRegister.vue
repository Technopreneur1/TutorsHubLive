<template>
    <div class="reg-form">
        <full-loader v-if="loading" ></full-loader>
        <span @click="closeForm()" class="btn-cancel"><i class="fas fa-long-arrow-alt-left"></i></span>
        <div v-if="!hasRegistered" class="full-container" >
            <div class="reg-text">
                <div class="title">Register as a student</div>
                <div class="note">Fill the form to get started quickly</div>
            </div>
            <div v-if="step == 1" class="newrow"><span style="background: #fff">Personal Information</span></div>
            <div v-if="step == 2" class="newrow"><span style="background: #fff">Location</span></div>
            <div v-if="step == 3" class="newrow"><span style="background: #fff">Study Information</span></div>
            
            <div v-if="step == 1" class="step step1">
                <div class="input">
                    <label for="">Full Name</label>
                    <input type="text" v-model="student.name" placeholder="John Doe.">
                </div>
                <div class="input">
                    <label for="">Email</label>
                    <input type="email" v-model="student.email" placeholder="Your Email">
                </div>
                <div class="input">
                    <label for="">Phone</label>
                    <input type="text" v-model="student.phone" placeholder="Phone Number">
                </div>
                <div class="input">
                    <label for="">Gender</label>
                    <select class="form-control" v-model="student.gender" id="">
                        <option value="">Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
            </div>
            <div v-if="step == 2" class="step step2">
                <div class="input">
                    <label for="">Country</label>
                    <select @change="countrySelected()" v-model="student.country" id="">
                        <option value="" disabled>Country</option>
                        <option v-for="country in countries" :key="country.id"  :value="country.id">{{country.name}}</option>
                    </select>
                </div>
                <div v-show="states.length" class="input">
                    <label for="">State / Province</label>
                    <select @change="stateSelected()" v-model="student.state" id="">
                        <option value="" disabled>State / Province</option>
                        <option v-for="state in states" :key="state.id" :value="state.id">{{state.name}}</option>
                    </select>
                </div>
                <div v-show="cities.length" class="input">
                    <label for="">City</label>
                    <select @change="citySelected()" v-model="student.city" id="">
                        <option value="" disabled>City</option>
                        <option v-for="city in cities" :key="city.id" :value="city.id">{{city.name}}</option>
                    </select>
                </div>
                <div v-show="neighborhoods.length" class="input">
                    <label for="">Neighborhood</label>
                    <select v-model="student.neighborhood" id="">
                        <option value="" disabled>Neighborhood</option>
                        <option v-for="neighborhood in neighborhoods" :key="neighborhood.id" :value="neighborhood.id">{{neighborhood.name}}</option>
                        <option value="-1"  >Other</option>
                    </select>
                </div>
                <div v-if="student.neighborhood == -1" class="input">
                    <label for="">Neighborhood Name &nbsp; <small>Make sure neighborhood name is correct and avoid spellings mistakes</small></label>
                    <input type="text" class="input" v-model="student.new_neighborhood" placeholder="Neighborhood">
                </div>
            </div>
            <div v-if="step == 3" class="step step2">
                <div class="input">
                    <label for="">Level</label>
                    <select v-model="student.level" id="">
                        <option value="" disabled>Level</option>
                        <option v-for="level in levels" :key="level.id"  :value="level.id">{{level.name}}</option>
                    </select>
                </div>
                
                <div class="input">
                    <label for="">Discipline</label>
                    <select v-model="student.discipline" id="">
                        <option value="" disabled>Discipline</option>
                        <option v-for="discipline in disciplines" :key="discipline.id"  :value="discipline.id">{{discipline.name}}</option>
                    </select>
                </div>
                
                
            </div>
            <div v-if="step == 4" class="step step3">
                <div class="input">
                    <label for="">Password</label>
                    <input type="password" v-model="student.password" placeholder="Password">
                </div>
                <div class="input">
                    <label for="">Confirm Password</label>
                    <input  type="password" v-model="student.password_confirmation" placeholder="Repeat Password">
                </div>
                <label for="age" style="display: block" ><input id="age" v-model="student.confirm_age" type="checkbox"> &nbsp; I am 18 or older</label>
                <label for="prv"><input id="prv" v-model="student.agree" type="checkbox"> &nbsp; I agree to the <a :href="url + '/terms-and-conditions'" target="_blank">Terms &amp; services</a> &amp; <a :href="url + '/privacy-policy'"  target="_blank">Privacy policy</a></label>
            </div>
            <div v-if="error" class="error-bar">{{error}}</div>
            <div class="options">
                <button @click="back()" class="btn btn-back">Back</button>
                <button v-if="step != 4" @click="next()" class="btn btn-next">Next</button>
                <button v-else @click="next()" class="btn btn-next">Complete Registeration</button>
            </div>
        </div>
        <div v-else class="full-container">
            <div class="regmsg animated zoomIn">
                <div class="suc">Done!</div> 
                <div class="txt">Your account has successfully been created</div>
                <div class="btns">
                    <a :href="url + '/login'" class="btn btn-log">Login Now</a>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: ['url', 'lat', 'lng'],
        data()
        {
            return {
                    hasRegistered: false,
                    loading: false,
                    step: 1,
                    error: '',
                    levels: [],
                    disciplines: [],
                    countries: [],
                    states: [],
                    cities: [],
                    neighborhoods: [],
                    type: 'student',
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
                        confirm_age: false,
                        agree: false,

                    },
            }
        },
        methods: {
            isEmail(email) 
            {
                var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,5})+$/;
                if(email.match(mailformat))
                {
                    return true;
                }else{
                    return false
                }
            },
            closeForm()
            {
                this.$emit('closeForm')
            },
            postStudent()
            {
                this.loading = true
                axios.post(this.url +'/post/student', {
                    name: this.student.name,
                    email: this.student.email,
                    password: this.student.password,
                    phone: this.student.phone,
                    country: this.student.country,
                    level: this.student.level,
                    lat: this.lat,
                    lng: this.lng,
                    discipline: this.student.discipline,
                    gender: this.student.gender,
                    state: this.student.state,
                    city: this.student.city,
                    neighborhood: this.student.neighborhood,
                    new_neighborhood: this.student.new_neighborhood,
                })
                .then(response => {
                    if(response.data.error == "email")
                    {
                        this.error = "Email is already registered. Please Login" 
                        this.step = 1
                        this.loading = false
                    }
                    else if(response.data.error == "phone")
                    {
                        this.error = "Phone Number is already registered. Please Login" 
                        this.step = 1
                        this.loading = false
                    }else
                    {
                        this.hasRegistered = true
                        this.loading = false
                    }
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
                if(this.canContinue())
                {
                    this.error = ''
                    if(this.step < 4)
                    {
                        this.step++;
                    }
                    else if(this.step == 4)
                    {
                        this.postStudent()
                    }
                }
            },
            canContinue()
            {
                if(this.step == 1){
                    if(this.student.phone && this.student.name && this.student.email && this.student.gender)
                    {
                        if(this.isEmail(this.student.email))
                        {
                            return true;
                        }else{
                            this.error = "Incorrect Email"
                            return false
                        }
                    }else{
                        this.error = "Please complete form to continue"
                        return false
                    }
                }
                if(this.step == 2){
                    if(this.student.country && this.student.state && this.student.city && (this.student.neighborhood > 0 || this.student.new_neighborhood))
                    {
                        return true;
                    }else{
                        this.error = "Please complete your address to continue"
                        return false
                    }
                }
                if(this.step == 3){
                    if(this.student.level && this.student.discipline)
                    {
                        return true;
                    }else{
                        this.error = "Please provide both level and discipline to continue"
                        return false
                    }
                }
                if(this.step == 4){
                    if(this.student.password && this.student.password == this.student.password_confirmation)
                    {
                        if(this.student.password.length > 7)
                        {
                            if(this.student.confirm_age)
                            {
                                if(this.student.agree)
                                {
                                    return true
                                }else{
                                    this.error = "Please must agree to the terms & conditions"
                                    return false
                                }
                            }else{
                                this.error = "Please confirm your age"
                                return false
                            }
                        }else{
                            this.error = "Password must be atleast 8 charcters"
                            return false
                        }
                    }else{
                        this.error = "Password confirmation did not match"
                        return false
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
                this.loading = true
                axios.post(this.url +'/get/states', {country: this.student.country})
                .then(response => {
                    this.loading = false
                    this.states = response.data.states
                })
                .catch(error => {
                    console.log(error);
                })
            },
            getCities()
            {
                this.loading = true
                axios.post(this.url +'/get/cities', {state: this.student.state})
                .then(response => {
                    this.loading = false
                    this.cities = response.data.cities
                })
                .catch(error => {
                    console.log(error);
                })
            },
            getNeighborhoods()
            {
                this.loading = true
                axios.post(this.url +'/get/neighborhoods', {city: this.student.city})
                .then(response => {
                    this.loading = false
                    this.neighborhoods = response.data.neighborhoods
                    if(!response.data.neighborhoods.length)
                    {
                        this.student.neighborhood  = -1
                    }
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
