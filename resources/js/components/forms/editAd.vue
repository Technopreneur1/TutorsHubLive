<template>
    <div class="create-ad-component">
        <!-- <div class="options">
            <button @click="show = true" class="btn btn-create">Post an Ad</button>
        </div> -->
            <transition name="easy-appear" enter-active-class="animated slideInLeft" leave-active-class="animated slideOutLeft">
                <div  class="create-ad-slide ">
                    <div class="full-container">
                        <a @click="$emit('cancel')" class="btn-back"><i class="fas fa-long-arrow-alt-left"></i></a>
                    <div class="text">
                        <div class="title">Edit Ad</div>
                        <div class="info">Your ad will be visible to the tutors in selected area.</div>
                    </div>
                    <div class="form-box">
                        <div class="input">
                            <label for="">Title</label>
                            <input type="text" v-model="ad.title" placeholder="I am looking for a tutor ....">
                        </div>
        

                        <div class="newrow">
                            <span>Location</span>
                        </div>
                        <transition name="custom-classes-transition" enter-active-class="animated fadeIn" leave-active-class="animated fadeOut">
                        <div v-if="editingLocation" class="addlocations">
                            <div class="input">
                                <label for="">Address</label>
                                <gmap-autocomplete class="form-control" @place_changed="setPlace"></gmap-autocomplete>
                            </div> 
                            <!-- <div class="input">
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
                            </div> -->
                        </div>
                        </transition>
                        <div v-if="!editingLocation" class="locations">
                            <span class="current">
                                {{thead.address}}
                                <input type="hidden" name="address_" :value="thead.address" />
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
                            <label for="">Availability</label>
                            <select v-model="ad.availability" name="availability" id="availability">
                                <option value="">-- Select Availability --</option>
                                <option value="Online">Online</option>
                                <option value="In-Person">In-Person</option>
                                <option value="Both" selected>Both</option>
                            </select>
                        </div>
                        <div class="input">
                            <label for="">Description</label>
                            <textarea class="form-control" v-model="ad.description" rows="4" placeholder="Describe your requirements (optional)"></textarea>
                        </div>
                        <div v-if="error" class="error">{{error}}</div>
                        <div v-if="success" class="success">{{success}}</div>
                        <div class="btns">
                            <button @click="$emit('cancel')" class="btn btn-cancel">Cancel</button>
                            <button @click="updateAd()" class="btn btn-post" :disabled="posting" >Post Now <i v-if="posting" class="fas fa-spinner fa-spin"></i> </button>
                        </div>
                    </div>
                    </div>
                    
                </div>
            </transition>
    </div>
</template>
<style lang="sass" scoped>
.error
    background: #F44336
    color: #fff
    padding: 4px 15px
    margin: 10px 0 15px
    border-radius: 50px
    text-align: center
.success
    background: #53a221
    color: #fff
    text-align: center
    padding: 5px 20px
    border-radius: 50px
    margin: 10px 0 15px
</style>
<script>
    export default {
            props: {
            url: {
                type: String
            },
            thead: {
                type: Object
            },
            },
        data(){
            return {
                success: '',
                error: '',
                show: false,
                posting: false,
                editingLocation: false,
                user: {},
                levels: [],
                disciplines: [],
                countries: [],
                states: [],
                cities: [],
                neighborhoods: [],
                address: $("input[name=address_]").val(),
                lat: 40.7831,
                lng: -73.9712,
                address: '',
                ad: {
                    title: this.thead.title,
                    description: this.thead.description,
                    level: this.thead.level_id,
                    discipline: this.thead.discipline_id,
                    neighborhood: this.thead.neighborhood_id,
                    new_neighborhood: '',
                    city: this.thead.city_id,
                    state: this.thead.state_id,
                    country: this.thead.country_id,
                    availability: '',
                }
            }
        },
        methods: {
            isReady()
            {
                if(this.ad.title.length > 4)
                {
                    if(this.ad.description)
                    {
                        if(this.ad.level)
                        {
                            if(this.ad.discipline)
                            {
                                if(this.address)
                                {
                                    if(this.ad.availabilty)
                                    {
                                        return true
                                    }else
                                    {
                                        this.error = "Availabilty is required"
                                        return false
                                    }
                                }else
                                {
                                    this.error = "Address is required"
                                    return false
                                }

                            }else
                            {
                                this.error = "Subject/Discipline is required"
                                return false
                            }
                        }else
                        {
                            this.error = "Level is required"
                            return false
                        }
                    }else
                    {
                        this.error = "Please enter description"
                        return false
                    }
                }else
                {
                    this.error = "Please enter a valid title"
                    return false
                }
            },
            setPlace(place)
            {
                this.lat = place.geometry.location.lat();
                this.lng = place.geometry.location.lng();
                this.address = place.formatted_address
            },
            updateAd()
            {
                // console.log('ok')
                if(!this.isReady())
                {
                    return false
                }else
                {
                    this.posting = true
                    axios.post(this.url +'/update/ad', {
                        id: this.thead.id,
                        title: this.ad.title,
                        description: this.ad.description,
                        level: this.ad.level,
                        discipline: this.ad.discipline,
                        neighborhood: this.ad.neighborhood,
                        country: this.ad.country,
                        availability: $("#availability").val(),
                        city: this.ad.city,
                        lat: this.lat,
                        lng: this.lng,
                        address: this.address,
                        state: this.ad.state,
                        new_neighborhood: this.ad.new_neighborhood
                    })
                        .then(response => {
                            this.posting = false
                            this.success = "Your ad has been updated"
                        })
                        .catch(error => {
                            this.posting = false
                           if(error.response.data.errors)
                           {
                               alert(error.response.data.errors.title)
                           }else
                           {
                               alert("Oops! Something went wrong. Can't post your ad at the moment")
                           }
                        })
                }
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
                            this.getStates()
                        }
                        if(this.user.state){
                            this.states.push(this.user.state)
                            // this.states.push(this.user.state)
                            this.getCities()
                        }
                        if(this.user.city){
                            this.cities.push(this.user.city)
                        }
                        if(this.user.neighborhood){
                            this.neighborhoods.push(this.user.neighborhood)
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    })
            },
            getStates()
            {
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
            this.getStates()
            this.getCities()
            this.getNeighborhoods()
        }
            }
</script>
