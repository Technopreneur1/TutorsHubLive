<template>
    <div class="reg-form">
        <full-loader v-if="loading" ></full-loader>
        <!--        <span @click="closeForm()" class="btn-cancel"><i class="fas fa-long-arrow-alt-left"></i></span>-->
        <a href="/" class="btn-cancel"><i class="fas fa-long-arrow-alt-left"></i></a>
        <div v-if="!hasRegistered" class="full-container" >
            <div class="reg-text">
                <div class="title">Register as a Tutor</div>
                <div class="note">Fill the form to get started quickly</div>
            </div>
            <div v-if="step == 2" class="newrow"><span style="background: #fff">Personal Information</span></div>
            <div v-if="step == 3" class="newrow"><span style="background: #fff">Location</span></div>

            <div v-if="step == 2" class="step step1">
                <div class="input">
                    <label for="">Full Name</label>
                    <input type="text" v-model="teacher.name" placeholder="John Doe.">
                </div>
                <div class="input">
                    <label for="">Email</label>
                    <input type="email" v-model="teacher.email" placeholder="Your Email">
                </div>
                <div class="input">
                    <label for="">Phone</label>
                    <input type="text" v-model="teacher.phone" placeholder="Phone Number">
                </div>
                <div class="input">
                    <label for="">Gender</label>
                    <select class="form-control" v-model="teacher.gender" id="">
                        <option value="">Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Prefer Not To Say">Prefer Not To Say</option>
                    </select>
                </div>
                <div class=input>
                    <label class="">Timezone:</label>
                    <select v-model="teacher.timezone"   >
                        <option v-for="(item, key) in timezones" :value="key">
                            {{item}}
                        </option>

                    </select>


                </div>

                <div class="input">
                    <label for="">Location</label>
                    <gmap-autocomplete class="form-control" @place_changed="setPlace"></gmap-autocomplete>
                </div> 
                <!-- <div class="input">
                    <label for="">Country</label>
                    <Select2 v-model="teacher.country" :options="countries" @change="countrySelected()" />
                </div> -->


            </div>
            <!--            <div v-if="step == 2" class="step step2">-->
            <!--                <div class="input">-->
            <!--                    <label for="">Country</label>-->
            <!--                    <Select2 v-model="teacher.country" :options="countries" @change="countrySelected()" />-->
            <!--                </div>-->
            <!--                <div v-show="states.length" class="input">-->
            <!--                    <label for="">State / Province</label>-->
            <!--                    <Select2 v-model="teacher.state" :options="states" @change="stateSelected()"  />-->
            <!--                </div>-->
            <!--                <div v-show="cities.length" class="input">-->
            <!--                    <label for="">City</label>-->
            <!--                    <Select2 v-model="teacher.city" :options="cities" @change="citySelected()"  />-->
            <!--                </div>-->
            <!--                <div v-show="neighborhoods.length" class="input">-->
            <!--                    <label for="">Neighborhood</label>-->
            <!--                    <Select2 v-model="teacher.neighborhood" :options="neighborhoods"   />-->
            <!--                </div>-->

            <!--                <div v-if="teacher.neighborhood == -1" class="input">-->
            <!--                    <label for="">Neighbourhood Name &nbsp; <small>Make sure neighbourhood name is correct and avoid spellings mistakes</small></label>-->
            <!--                    <input type="text" class="input" v-model="teacher.new_neighborhood" placeholder="Neighbourhood">-->
            <!--                </div>-->
            <!-- <div class="input">
                <label for="">Country</label>
                <select @change="countrySelected()" v-model="teacher.country" id="">
                    <option value="" disabled>Country</option>
                    <option v-for="country in countries" :key="country.id"  :value="country.id">{{country.name}}</option>
                </select>
            </div>
            <div v-show="states.length" class="input">
                <label for="">State</label>
                <select @change="stateSelected()" v-model="teacher.state" id="">
                    <option value="" disabled>State / Province</option>
                    <option v-for="state in states" :key="state.id" :value="state.id">{{state.name}}</option>
                </select>
            </div>
            <div v-show="cities.length" class="input">
                <label for="">City</label>
                <select @change="citySelected()" v-model="teacher.city" id="">
                    <option value="" disabled>City</option>
                    <option v-for="city in cities" :key="city.id" :value="city.id">{{city.name}}</option>
                </select>
            </div>
            <div v-show="neighborhoods.length" class="input">
                <label for="">Neighborhood</label>
                <select class="input" v-model="teacher.neighborhood" id="">
                    <option value="" disabled>Neighborhood</option>
                    <option v-for="neighborhood in neighborhoods" :key="neighborhood.id" :value="neighborhood.id">{{neighborhood.name}}</option>
                    <option value="-1"  >Other</option>
                </select>
            </div>
            <div v-if="teacher.neighborhood == -1" class="input">
                <label for="">Neighborhood Name &nbsp; <small>Make sure neighborhood name is correct and avoid spellings mistake for maxmium reach to teachers</small></label>
                <input type="text" class="input" v-model="teacher.new_neighborhood" placeholder="Neighborhood">
            </div> -->

            <!--            </div>-->
            <div v-if="step == 3" class="step step2">
                <div class="input">
                    <label for="">Password</label>
                    <input type="password" v-model="teacher.password" placeholder="Password">
                </div>
                <div class="input">
                    <label for="">Confirm Password</label>
                    <input type="password" v-model="teacher.password_confirmation" placeholder="Repeat Password">
                </div>
                <label for="age" style="display: block" ><input id="age" v-model="teacher.confirm_age" type="checkbox"> &nbsp; I am 18 or older</label>
                <label for="prv"><input id="prv" v-model="teacher.agree" type="checkbox"> &nbsp; I agree to the  <a :href="'/terms-and-conditions'"  target="_blank">Terms &amp; services</a> &amp; <a :href="'/privacy-policy'"  target="_blank">Privacy policy</a></label>
            </div>
            <div v-if="error" class="error-bar">{{error}}</div>
            <div class="options">
                <button v-if="step != 2" @click="back()" class="btn btn-back">Back</button>
                <button v-if="step != 3" @click="next()" class="btn btn-next">Next</button>
                <button v-else @click="next()" class="btn btn-next">Complete Registeration</button>
            </div>
        </div>
        <div v-else class="full-container">
            <div class="regmsg animated zoomIn">
                <div class="suc">Done!</div>
                <div class="txt">Your account has successfully been created</div>
                <div class="btns">
                    <a :href="'/login'" class="btn btn-log">Login Now</a>
                </div>
            </div>
        </div>
    </div>
</template>
<style lang="sass" scoped>
    .step
        text-align: left
        color: #000
</style>
<script>
    import Select2 from 'v-select2-component';
    export default {
        props: ['url', 'lat', 'lng','tz'],
        data()
        {
            return {
                hasRegistered: false,
                loading: false,
                addOther: false,
                step: 2,
                error: '',
                levels: [],
                disciplines: [],
                countries: [],
                states: [],
                cities: [],
                neighborhoods: [],
                type: 'teacher',
                lat: 40.7831,
                lng: -73.9712,
                address: '',
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
                    timezone: '',

                },
                teacher: {
                    name: '',
                    email: '',
                    gender: '',
                    password: '',
                    confirm_password: '',
                    phone: '',
                    neighborhood: '',

                    city: '',
                    state: '',
                    country: '',
                    timezone: '',
                    confirm_age: false,
                    agree: false,
                    new_neighborhood: ''
                }
            }
        },
        computed:
            {
              timezones(){
                  return this.tz;
              }
            },
        components: {Select2},
        methods: {
            setPlace(place)
            {
                this.lat = place.geometry.location.lat();
                this.lng = place.geometry.location.lng();
                this.address = place.formatted_address
            },
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
            postTeacher()
            {
                axios.post('/post/teacher', {
                    name: this.teacher.name,
                    email: this.teacher.email,
                    password: this.teacher.password,
                    phone: this.teacher.phone,
                    country: this.teacher.country,
                    gender: this.teacher.gender,
                    state: '333',
                    timezone: this.teacher.timezone,
                    lat: this.lat,
                    lng: this.lng,
                    address: this.address,
                    city: '333',
                    neighborhood: '333',
                    new_neighborhood: '333',

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
                this.states = []
                this.cities = []
                this.neighborhoods = []
                this.teacher.neighborhood = ""
                if(this.teacher.country)
                {
                    this.getStates()
                }
            },
            stateSelected()
            {
                this.cities = []
                this.neighborhoods = []
                this.teacher.neighborhood = ""
                if(this.teacher.state)
                {
                    this.getCities()
                }
            },
            citySelected()
            {
                this.neighborhoods = []
                if(this.teacher.city)
                {
                    this.getNeighborhoods()
                }
            },
            next()
            {
                if(this.canContinue())
                {
                    this.error = ''
                    if(this.step < 3)
                    {
                        this.step++;
                    }
                    else if(this.step == 3)
                    {
                        this.postTeacher()
                    }
                }
            },
            canContinue()
            {
                if(this.step == 2){
                    if(this.teacher.phone && this.teacher.name && this.teacher.email && this.teacher.gender)
                    {
                        if(this.isEmail(this.teacher.email))
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
                //     if(this.teacher.country && this.teacher.state && this.teacher.city && (this.teacher.neighborhood > 0 || this.teacher.new_neighborhood))
                //     {
                //         return true;
                //     }else{
                //         this.error = "Please complete your address to continue"
                //         return false
                //     }
                // }
                if(this.step == 3){
                    if(this.teacher.password && this.teacher.password == this.teacher.password_confirmation)
                    {
                        if(this.teacher.password.length > 7)
                        {
                            if(this.teacher.confirm_age)
                            {
                                if(this.teacher.agree)
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
                // if(this.type == 'teacher')
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
                axios.post('/get/levels')
                    .then(response => {
                        this.levels = response.data.levels
                    })
                    .catch(error => {
                        console.log(error);
                    })
            },
            getDisciplines()
            {
                axios.post('/get/disciplines')
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
                axios.post('/get/countries')
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

                axios.post('/get/states', {country: this.teacher.country})
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
                axios.post('/get/cities', {state: this.teacher.state})
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
                axios.post('/get/neighborhoods', {city: this.teacher.city})
                    .then(response => {
                        this.neighborhoods = response.data.neighborhoods
                        this.neighborhoods.map(function (obj) {
                            obj.text =  obj.name; // replace name with the property used for the text
                        });
                        if(!response.data.neighborhoods.length)
                        {
                            this.teacher.neighborhood  = -1
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
