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
                        <option v-for="neighborhood in neighborhoods" :key="neighborhood.id" :value="neighborhood.id">{{neighborhood.name}}</option>
                    </select>
                </div>
                <div class="btns">
                    <button @click="reset()" class="btn btn-re">Reset</button>
                    <button @click="getTutors()" class="btn btn-gradient">Search</button>
                </div>
            </div>
            <div id="map">
                <GmapMap :center="center" :map-type-id="mapTypeId" :zoom="5">
                <GmapMarker
                    v-for="(item, index) in markers"
                    :key="index"
                    :position="item.position"
                    @click="markerClicked(item)"
                />
                </GmapMap>
            </div>
            <div v-if="tutors.length" class="search-results">
                <tutor v-for="tutor in tutors"  @startConversation="startConversation(tutor.id)" :url="url" :tutor="tutor" :key="tutor.id"></tutor>
            </div>
            <div v-else class="nothing">
                <p>No Tutor Available</p>
            </div>
            <div class="morebtn text-center">
                <button v-if="nextPage" @click="getMore()" class="btn btn-gradient">Load More</button>
            </div>
         </div>
     </div>
</template>
<style lang="sass" scoped>
    .btns
        display: flex
        justify-content: center
        .btn
            margin: 0 10px
        .btn-re
            background: #777777
            color: #ffffff
            border-radius: 24px
            padding-left: 20px
            padding-right: 20px
            &:hover
                background: #000
                color: #fff
    .vue-map-container
        height: 450px
        max-width: 992px
        width: 100%
</style>
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
                nextPage: '',
                activeTutor: null,
                center: { lat: -3.350235, lng: 111.995865 },
                mapTypeId: "roadmap",
                markers: [
                    // { position: { lat: -0.48585, lng: 117.1466 } },
                    // { position: { lat: -6.9127778, lng: 107.6205556 } }
                ]
               
           }
        },
        methods: {
            markerClicked(item)
            {
                this.center = item.position
                this.activeTutor = item.tutor.id
                window.location = this.url + '/user/' + item.tutor.id
            },
            setMap()
            {
            // Initialize and add the map
                function initMap() {
                // The location of Uluru
                var uluru = {lat: -25.344, lng: 131.036};
                // The map, centered at Uluru
                var map = new google.maps.Map(
                    document.getElementById('map'), {zoom: 4, center: uluru});
                // The marker, positioned at Uluru
                var marker = new google.maps.Marker({position: uluru, map: map});
                }  
            },
            reset()
            {
                this.tutors = []
                this.state = ''
                this.city = ''
                this.country = ''
                this.level = ''
                this.neighborhood = ''
                this.subject = ''
                this.getTutors()
            },
            startConversation(id)
            {
                this.chatWith = id
            },
            getMore()
            {

                axios.post(this.nextPage)
                .then(response => {
                    console.log(response.data.tutors.data)
                    response.data.tutors.data.forEach(tutor => {
                        this.tutors.push(tutor)
                    });
                    
                    this.nextPage = response.data.tutors.next_page_url
                    this.showSearchForm = false
                })
                .catch(error => {
                    console.log(error);
                })
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
                    this.tutors = response.data.tutors.data
                    this.nextPage = response.data.tutors.next_page_url
                    this.updateMap()
                    // this.showSearchForm = false
                })
                .catch(error => {
                    console.log(error);
                })
            },
            updateMap()
            {
                this.tutors.forEach
                this.tutors.forEach(tutor => {
                    let ulat = tutor.latitude
                    let ulng = tutor.longitude
                    if(ulat && ulng)
                    {
                        this.markers.push({ position: { lat: ulat, lng: ulng }, tutor: tutor })
                        this.center = { lat: ulat, lng: ulng }
                    }
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
                    this.state = ''
                    this.city = ''
                    this.neighborhood = ''
                    this.getStates()
                }
            },
            stateSelected()
            {
                this.cities = []
                this.neighborhoods = []
                if(this.state)
                {
                    this.city = ''
                    this.neighborhood = ''
                    this.getCities()
                }
            },
            citySelected()
            {
                this.neighborhoods = []
                if(this.city)
                {
                    this.neighborhood = ''
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
            this.setMap();
        }
    }
</script>
