<template>
    <div class="reg-form">
        <full-loader v-if="loading" ></full-loader>
        <span @click="closeForm()" class="btn-cancel"><i class="fas fa-long-arrow-alt-left"></i></span>
        <div v-if="!hasRegistered" class="full-container" >
            <div class="reg-text">
                <div class="title">Register as a student</div>
                <div class="note">Fill the form to get started quickly</div>
            </div>
            <div v-if="step == 2" class="newrow"><span style="background: #fff">Personal Information</span></div>
            <div v-if="step == 3" class="newrow"><span style="background: #fff">Location</span></div>
            <div v-if="step == 4" class="newrow"><span style="background: #fff">Study Information</span></div>

            <div v-if="step == 2" class="step step1">
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
                        <option value="Prefer Not To Say">Prefer Not To Say</option>
                    </select>
                </div>
                <div class="input">
                    <label for="">Country</label>
                    <Select2 v-model="student.country" :options="countries" @change="countrySelected()" />
                </div>
            </div>
<!--            <div v-if="step == 2" class="step step2">-->
<!--                <div class="input">-->
<!--                    <label for="">Country</label>-->
<!--                    <Select2 v-model="student.country" :options="countries" @change="countrySelected()" />-->
<!--                </div>-->
<!--&lt;!&ndash;                <div v-show="states.length" class="input">&ndash;&gt;-->
<!--                    <label for="">State / Province</label>-->
<!--                    <Select2 v-model="student.state" :options="states" @change="stateSelected()"  />-->
<!--                </div>-->
<!--                <div v-show="cities.length" class="input">-->
<!--                    <label for="">City</label>-->
<!--                    <Select2 v-model="student.city" :options="cities" @change="citySelected()"  />-->
<!--                </div>-->
<!--                <div v-show="neighborhoods.length" class="input">-->
<!--                    <label for="">Neighborhood</label>-->
<!--                    <Select2 v-model="student.neighborhood" :options="neighborhoods"   />-->
<!--                </div>-->

<!--                <div v-if="student.neighborhood == -1" class="input">-->
<!--                    <label for="">Neighbourhood Name &nbsp; <small>Make sure neighbourhood name is correct and avoid spellings mistakes</small></label>-->
<!--                    <input type="text" class="input" v-model="student.new_neighborhood" placeholder="Neighbourhood">-->
<!--                </div>-->
<!--            </div>-->
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
                <label for="age" style="display: block; text-align: left; color: #000;" ><input id="age" v-model="student.confirm_age" type="checkbox"> &nbsp; I am 18 or older</label>
                <label for="prv" style="display: block; text-align: left; color: #000;"><input id="prv" v-model="student.agree" type="checkbox"> &nbsp; I agree to the <a :href="'https://tutors-hub.com/terms-and-conditions'" target="_blank">Terms &amp; services</a> &amp; <a :href="'https://tutors-hub.com/privacy-policy'"  target="_blank">Privacy policy</a></label>
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
                    <a :href="'http://localhost:8000/login'" class="btn btn-log">Login Now</a>
                </div>
            </div>
        </div>
    </div>
</template>
<style lang="sass" scoped>
    // .step
    //     text-align: left
    //     color: #000

    .input
        text-align: left
        label
            color: #000
</style>
<style lang="sass">
    .select2-container
        width: 100% !important
</style>
<script>
import Select2 from 'v-select2-component';
    export default {
        props: ['url', 'lat', 'lng'],
        data()
        {
            return {
                    hasRegistered: false,
                    loading: false,
                    step: 2,
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
        components: {Select2},
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
                axios.post('https://tutors-hub.com/post/student', {
                    name: this.student.name,
                    email: this.student.email,
                    password: this.student.password,
                    phone: this.student.phone,
                    country: this.student.country,
                    level: this.student.level,
                   // lat: this.lat,
                    //lng: this.lng,
                    discipline: this.student.discipline,
                    gender: this.student.gender,
                    state: '111',
                    city: '111',
                    neighborhood: '111',
                    new_neighborhood: '222',
                })
                .then(response => {
                    if(response.data.error == "email")
                    {
                        this.error = "Email is already registered. Please Login"
                        this.step = 2
                        this.loading = false
                    }
                    else if(response.data.error == "phone")
                    {
                        this.error = "Phone Number is already registered. Please Login"
                        this.step = 2
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
                this.states = []
                this.cities = []
                this.neighborhoods = []
                this.student.neighborhood = ""
                if(this.student.country)
                {
                    this.getStates()
                }
            },
            stateSelected()
            {
                this.cities = []
                this.neighborhoods = []
                this.student.neighborhood = ""
                if(this.student.state)
                {
                    this.getCities()
                }
            },
            citySelected()
            {
                this.neighborhoods = []
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
                if(this.step == 2){
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
                // if(this.step == 2){
                //     if(this.student.country && this.student.state && this.student.city && (this.student.neighborhood > 0 || this.student.new_neighborhood))
                //     {
                //         return true;
                //     }else{
                //         this.error = "Please complete your address to continue"
                //         return false
                //     }
                // }
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
                    if(this.step > 2)
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
                axios.post('https://tutors-hub.com/get/levels')
                .then(response => {
                    this.levels = response.data.levels
                })
                .catch(error => {
                    console.log(error);
                })
            },
            getDisciplines()
            {
                axios.post('https://tutors-hub.com/get/disciplines')
                .then(response => {
                    this.disciplines = response.data.disciplines
                })
                .catch(error => {
                    console.log(error);
                })
            },
            getCountries()
            {
                this.states = []
                this.cities = []
                this.neighborhoods = []
                axios.post('https://tutors-hub.com/get/countries')
                .then(response => {
                    this.countries = response.data.countries
                    this.countries.map(function (obj) {
                    obj.text =  obj.name; // replace name with the property used for the text
                    });
                })
                .catch(error => {
                    console.log(error);
                })
            },

            getStates()
            {

                axios.post('https://tutors-hub.com/get/states', {country: this.student.country})
                .then(response => {
                    console.log(response)
                    this.states = response.data.states
                    this.states.map(function (obj) {
                        obj.text =  obj.name; // replace name with the property used for the text
                    });
                })
                .catch(error => {
                    console.log(error);
                })
            },
            getCities()
            {
                axios.post('https://tutors-hub.com/get/cities', {state: this.student.state})
                .then(response => {
                    this.cities = response.data.cities
                    this.cities.map(function (obj) {
                        obj.text =  obj.name; // replace name with the property used for the text
                    });
                })
                .catch(error => {
                    console.log(error);
                })
            },
            getNeighborhoods()
            {
                axios.post('https://tutors-hub.com/get/neighborhoods', {city: this.student.city})
                .then(response => {
                    this.neighborhoods = response.data.neighborhoods
                    this.neighborhoods.map(function (obj) {
                        obj.text =  obj.name; // replace name with the property used for the text
                    });
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
        }
    }
</script>
