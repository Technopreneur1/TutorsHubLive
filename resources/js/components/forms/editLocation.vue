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
            <label for="">State</label>
            <select @change="stateSelected()" v-model="state" id="">
                <option value="" disabled>State</option>
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
                <option v-for="neighborhood in neighborhoods" :key="neighborhood.id" :value="neighborhood.id">{{neighborhood.name}}</option>
            </select>
        </div>
        <div class="input">
            <button @click="update()" class="btn btn-update">Update</button>
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

                country: this.user.country.id,
                state: this.user.state.id,
                city: this.user.city.id,
                neighborhood: this.user.neighborhood_id,

                books: []
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
                    neighborhood: this.neighborhood
                })
                .then(response => {
                    console.log(response)
                    this.success  = "Adress Updated"
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
                if(this.country)
                {
                    this.getStates()
                }
            },
            stateSelected()
            {
                this.cities = []
                this.neighborhoods = []
                if(this.state)
                {
                    this.getCities()
                }
            },
            citySelected()
            {
                this.neighborhoods = []
                if(this.city)
                {
                    this.getNeighborhoods()
                }
            },
        },
        mounted()
        {
            this.getCountries()
            this.getStates()
            this.getCities()
            this.getNeighborhoods()
        }
    }
</script>
