<template>
     <div class="search-page">
         <transition  name="easy-appear" enter-active-class="animated slideInLeft" leave-active-class="animated slideOutLeft">
            <start-chat v-if="chatWith" :url="url" :to="chatWith" @cancelChat="chatWith = null"></start-chat>
         </transition>
         <div class="full-container">
            <div v-if="!showSearchForm" class="short-search-bar">
                <div @click="showSearchForm = true" class="gradient-btn">
                    <button><i class="fas fa-filter"></i> Filter Search</button>
                </div>
            </div>
            <div v-else class="searchBox">
                <div class="input">
                    <label for="">Level</label>
                    <select v-model="level" name="level" id="">
                        <option value="">-- Level --</option>
                        <option v-for="level in levels" :value="level.id" :key="level.id">{{level.name}}</option>
                    </select>
                </div>
                <div class="input">
                    <label for="">Subject</label>
                    <select v-model="subject" name="subject" id="">
                        <option value="">-- Subject --</option>
                        <option v-for="discipline in disciplines" :value="discipline.id" :key="discipline.id">{{discipline.name}}</option>
                    </select>
                </div>
                <div class="newrow">
                    <span>Location</span>
                </div>
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
                    <button @click="getTutors()" class="btn-de">Search</button>
                </div>
            </div>
            <div v-if="tutors.length" class="search-results">
                <tutor v-for="tutor in tutors" @startConversation="startConversation(tutor.id)" :url="url" :tutor="tutor" :key="tutor.id"></tutor>
            </div>
            <div v-else class="nothing">
                <p>No Tutor Available</p>
            </div>
         </div>
     </div>
</template>
<script>
    export default {
        props: ['url'],
        data()
        {
           return{
                chatWith: null,
                tutors: [],
                success: '',
                levels: [],
                disciplines: [],
                countries: [],
                states: [],
                cities: [],
                neighborhoods: [],
                country: '',
                state: '',
                city: '',
                neighborhood: '',
                showSearchForm: true,
                level: '',
                subject: '',
               
           }
        },
        methods: {
            startConversation(id)
            {
                this.chatWith = id
            },
            getTutors()
            {
                axios.post(this.url +'/search/tutors', {
                    'country': this.country,
                    'state': this.state,
                    'city': this.city,
                    'neighborhood': this.neighborhood,
                    'level': this.level,
                    'subject': this.subject,
                })
                .then(response => {
                    console.log(response.data)
                    this.tutors = response.data.tutors.data
                    this.showSearchForm = false
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
            // this.getStates()
            // this.getCities()
            this.getTutors()
            this.getLevels()
            this.getDisciplines()
        }
    }
</script>
