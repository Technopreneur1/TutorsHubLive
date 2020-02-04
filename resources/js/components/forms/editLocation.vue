<template>
     <div class="edit-location">
        <span id="success" @click="$emit('cancel')" class="btn-cancel"><i class="fas fa-long-arrow-alt-left"></i></span>
        <transition  name="easy-appear" enter-active-class="animated bounce" leave-active-class="animated fadeOut">
            <div v-if="success" class="input success"><span>{{success}}</span></div>
        </transition>
        <div class="input">
            <label for="">Country</label>
            <select @change="countrySelected()" v-model="country" id="">
                <option value="" disabled>Country</option>
                <option v-for="country in countries" :key="country.id"  :value="country.id">{{country.name}}</option>
            </select>
        </div>
        <div v-show="states.length" class="input">
            <label for="">State / Province</label>
            <select @change="stateSelected()" v-model="state" id="">
                <option value="" disabled>State / Province</option>
                <option v-for="state in states" :key="state.id" :value="state.id">{{state.name}}</option>
            </select>
        </div>
        <div v-show="cities.length" class="input">
            <label for="">City</label>
            <select @change="citySelected()" v-model="city" id="">
                <option value="" disabled>City</option>
                <option v-for="city in cities" :key="city.id" :value="city.id">{{city.name}}</option>
            </select>
        </div>
        <div v-show="neighborhoods.length" class="input">
            <label for="">Neighborhood</label>
            <select v-model="neighborhood" id="">
                <option value="" disabled>Neighborhood</option>
                <option v-for="neighborhood in neighborhoods" :key="neighborhood.id" :value="neighborhood.id" >{{neighborhood.name}}</option>
                <option value="-1"  >Other</option>
            </select> 
        </div>
        <div v-if="neighborhood == -1" class="input">
            <label for="">Neighborhood Name &nbsp; <small>Make sure neighborhood name is correct and avoid spellings mistakes</small></label>
            <input type="text" class="input" v-model="new_neighborhood" placeholder="Neighborhood">
        </div>
        <div class="input">
            <button @click="update()" class="btn btn-update" :disabled="!isReady">Update</button>
        </div>
    </div>
</template>
<script>
    export default {
        props: ['url', 'user'],
        data()
        {
           return{
                success: '',
                countries: [],
                states: [],
                cities: [],
                neighborhoods: [],

                country: '',
                state: '',
                city: '',
                neighborhood: '',
                new_neighborhood: '',

                books: []
           }
        },
        computed:
        {
            isReady()
            {
                if(this.state && this.country && this.city &&(this.neighborhood > 0 || this.new_neighborhood.length > 2))
                {
                    return true
                }else{
                    return false
                }
            }
        },
        methods: {
            update()
            {
                axios.post(this.url +'/update/location', 
                {
                    country: this.country,
                    state: this.state,
                    city: this.city,
                    neighborhood: this.neighborhood,
                    new_neighborhood: this.new_neighborhood
                })
                .then(response => {
                    console.log(response)
                    this.success  = "Address Updated"
                    document.getElementById('success').scrollIntoView();
                })
                .catch(error => {
                    console.log(error);
                })
            },
            getStates()
            {
                axios.post(this.url +'/get/states', {country: this.country})
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
                axios.post(this.url +'/get/cities', {state: this.state})
                .then(response => {
                    this.cities = response.data.cities
                })
                .catch(error => {
                    console.log(error);
                })
            },
            getNeighborhoods()
            {
                axios.post(this.url +'/get/neighborhoods', {city: this.city})
                .then(response => {
                    this.neighborhoods = response.data.neighborhoods
                    if(!response.data.neighborhoods.length)
                    {
                        this.neighborhood  = -1
                    }
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
                axios.post(this.url +'/get/countries')
                .then(response => {
                    this.countries = response.data.countries
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
                this.state = ''
                this.city = ''
                this.neighborhood = ''
                if(this.country)
                {
                    this.getStates()
                }
            },
            stateSelected()
            {
                this.cities = []
                this.neighborhoods = []
                this.city = ''
                this.neighborhood = ''
                if(this.state)
                {
                    this.getCities()
                }
            },
            citySelected()
            {
                this.neighborhoods = []
                this.neighborhood = ''
                if(this.city)
                {
                    this.getNeighborhoods()
                }
            },
        },
        mounted()
        {
            this.getCountries()
            // this.getStates()
            // this.getCities()
            // this.getNeighborhoods()
        }
    }
</script>
