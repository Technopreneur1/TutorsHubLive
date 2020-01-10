<template>
    <div class="create-ad-component">
        <!-- <div class="options">
            <button @click="show = true" class="btn btn-create">Post an Ad</button>
        </div> -->
            <transition name="easy-appear" enter-active-class="animated slideInLeft" leave-active-class="animated slideOutLeft">
                <div  class="create-ad-slide ">
                    <a :href="url" class="btn-back"><i class="fas fa-long-arrow-alt-left"></i></a>
                    <div class="text">
                        <div class="title">Create Ad</div>
                        <div class="info">Your ad will be visible to the teachers in selected area.</div>
                    </div>
                    <div class="form-box">
                        <div class="input">
                            <label for="">Title</label>
                            <input type="text" v-model="ad.title" placeholder="I am looking for a physics tutor ....">
                        </div>
        

                        <div class="newrow">
                            <span>Location</span>
                        </div>
                        <transition name="custom-classes-transition" enter-active-class="animated tada" leave-active-class="animated bounceOutRight">
                        <div v-if="editingLocation" class="addlocations">
                            <div class="input">
                                <label for="">Country</label>
                                <select @change="getStates()" v-model="ad.country" >
                                    <option value="">-- Select Country --</option>
                                    <option v-for="country in countries" :value="country.id" :key="country.id">{{country.name}}</option>
                                </select>
                            </div>
                            <div v-if="states.length" class="input">
                                <label for="">State / Province</label>
                                <select @change="getCities()" v-model="ad.state" >
                                    <option value="">-- Select State --</option>
                                    <option v-for="state in states" :value="state.id" :key="state.id">{{state.name}}</option>
                                </select>
                            </div>
                            <div v-if="cities.length" class="input">
                                <label for="">City</label>
                                <select @change="getNeighborhoods()" v-model="ad.city" >
                                    <option value="">-- Select City --</option>
                                    <option v-for="city in cities" :value="city.id" :key="city.id">{{city.name}}</option>
                                </select>
                            </div>
                            <div v-if="neighborhoods.length" class="input">
                                <label for="">Neighborhood</label>
                                <select v-model="ad.neighborhood" >
                                    <option value="">-- Select Neighborhood --</option>
                                    <option v-for="neighborhood in neighborhoods" :value="neighborhood.id" :key="neighborhood.id">{{neighborhood.name}}</option>
                                    <option value="-1"  >Other</option>
                                </select>
                            </div>
                            <div v-if="ad.neighborhood == -1" class="input">
                                <label for="">Neighborhood Name &nbsp; <small>Make sure neighborhood name is correct and avoid spellings mistakes</small></label>
                                <input type="text" class="input" v-model="ad.new_neighborhood" placeholder="Neighborhood">
                            </div>
                        </div>
                        </transition>
                        <div v-if="!editingLocation" class="locations">
                            <span class="current">
                                {{user.neighborhood ? user.neighborhood.name : ''}}
                                {{user.city ? ', '+user.city.name : ''}}
                                {{user.state ? ', '+user.state.name : ''}}
                                {{user.country ? ', '+user.country.name : ''}}
                                </span>
                            <span @click="editingLocation = true" class="change">Change <i class="fas fa-cog"></i></span>
                        </div>


                        <div class="newrow">
                            <span>Details</span>
                        </div>
                        <div class="input">
                            <label for="">Level</label>
                            <select v-model="ad.level" >
                                <option value="">-- Select Level --</option>
                                <option v-for="level in levels" :value="level.id" :key="level.id">{{level.name}}</option>
                            </select>
                        </div>
                        <div class="input">
                            <label for="">Subject / Discipline</label>
                            <select v-model="ad.discipline" >
                                <option value="">-- Select Subject --</option>
                                <option v-for="discipline in disciplines" :value="discipline.id" :key="discipline.id">{{discipline.name}}</option>
                            </select>
                        </div>
                        
                        <div class="input">
                            <label for="">Description</label>
                            <textarea class="form-control" v-model="ad.description" rows="4" placeholder="Describe your requirements (optional)"></textarea>
                        </div>

                        <div class="btns">
                            <button class="btn btn-cancel">Cancel</button>
                            <button @click="postAd" class="btn btn-post">Post Now</button>
                        </div>
                    </div>
                </div>
            </transition>
    </div>
</template>

<script>
    export default {
        props: ['url', 'city',],
        data(){
            return {
                show: false,
                editingLocation: false,
                user: {},
                levels: [],
                disciplines: [],
                countries: [],
                states: [],
                cities: [],
                neighborhoods: [],
                ad: {
                    title: '',
                    description: '',
                    level: '',
                    discipline: '',
                    neighborhood: '',
                    new_neighborhood: '',
                    city: '',
                    state: '',
                    country: ''
                }
            }
        },
        methods: {
            postAd()
            {
                // console.log('ok')
                
                axios.post(this.url +'/post/ad', {
                    title: this.ad.title,
                    description: this.ad.description,
                    level: this.ad.level,
                    discipline: this.ad.discipline,
                    neighborhood: this.ad.neighborhood,
                    country: this.ad.country,
                    city: this.ad.city,
                    state: this.ad.state,
                    new_neighborhood: this.ad.new_neighborhood
                })
                    .then(response => {
                        this.resetForm()
                        window.location = this.url + '/my-ads'
                    })
                    .catch(error => {
                       if(error.response.data.errors)
                       {
                           alert(error.response.data.errors.title);
                       }else
                       {
                           alert("OOps! Something went wrong. Can't post your ad at the moment")
                       }
                    })
            },
            resetForm()
            {
                this.ad.title = ''
                this.ad.description = ''
                this.ad.title = ''
            },
            getUserInfo(){
                    axios.post(this.url +'/get/userinfo')
                    .then(response => {
                        console.log(response)
                        this.user = response.data.user
                        if(this.user.country){
                            this.ad.country = this.user.country.id
                            this.getStates()
                        }
                        if(this.user.state){
                            this.ad.state = this.user.state.id
                            this.states.push(this.user.state)
                            // this.states.push(this.user.state)
                            this.getCities()
                        }
                        if(this.user.city){
                            this.ad.city = this.user.city.id
                            this.cities.push(this.user.city)
                        }
                        if(this.user.neighborhood){
                            this.ad.neighborhood = this.user.neighborhood.id
                            this.neighborhoods.push(this.user.neighborhood)
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    })
            },
            getStates()
            {
                console.log("Get States")
                axios.post(this.url +'/get/states', {country: this.ad.country})
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
                axios.post(this.url +'/get/cities', {state: this.ad.state})
                .then(response => {
                    this.cities = response.data.cities
                })
                .catch(error => {
                    console.log(error);
                })
            },
            getNeighborhoods()
            {
                axios.post(this.url +'/get/neighborhoods', {city: this.ad.city})
                .then(response => {
                    this.neighborhoods = response.data.neighborhoods
                    if(!response.data.neighborhoods.length)
                    {
                        this.ad.neighborhood  = -1
                    }
                })
                .catch(error => {
                    console.log(error);
                })
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
        },
        mounted()
        {
            this.getDisciplines()
            this.getUserInfo()
            this.getLevels()
            this.getCountries()
        }
    }
</script>
