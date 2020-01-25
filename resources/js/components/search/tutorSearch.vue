<template>
    <div class="search-page tutp">
        <transition  name="easy-appear" enter-active-class="animated slideInLeft" leave-active-class="animated slideOutLeft">
            <start-chat v-if="chatWith" :url="url" :to="chatWith" @cancelChat="chatWith = null"></start-chat>
        </transition>
        <div v-if="viewTutor" class="view-tutor">
            <span class="clo" @click="viewTutor = null"><i class="fas fa-times"></i></span>
            <div class="avatar">
                <a  :href="url+ '/user/' +viewTutor.id" class="info">
                <img :src="avatar(viewTutor)" alt="">
                </a>
            </div>
            <div class="data">
            <a  :href="url+ '/user/' +viewTutor.id" class="info">
                <div class="name">{{firstname(viewTutor.name)}}</div>
                <div class="location"><i class="fas fa-map-marker-alt"></i> {{viewTutor.neighborhood ? viewTutor.neighborhood.name + ', ' : ''}}{{viewTutor.city ? viewTutor.city.name + ', ' : ''}}{{viewTutor.state ? viewTutor.state.name + ', ' : ''}}</div>
            </a>
            <div class="contactbtn">
                <button @click="contact(viewTutor.id)" class="btn btn-gradient">Message</button>
            </div>
        </div>
        </div>
        <!-- <div v-if="!showSearchForm" class="short-search-bar">
            <div @click="showSearchForm = true" class="gradient-btn">
                <button><i class="fas fa-filter"></i> Filter Search</button>
            </div>
        </div> -->
        <div class="mbar">
            <div @click="showSearchForm = true" class="mopt">
                <i class="fas fa-filter"></i> Filter
            </div>
            <div @click="viewmode = 'all'" class="mopt" :class="{active: viewmode == 'all'}">
                <i class="fas fa-globe"></i> <span>All</span>
            </div>
            <div @click="viewmode = 'map'" class="mopt" :class="{active: viewmode == 'map'}">
                <i class="fas fa-map-marker-alt"></i> <span>Map</span>
            </div>
            <div @click="viewmode = 'list'" class="mopt" :class="{active: viewmode == 'list'}">
                <i class="fas fa-list-ul"></i> <span>List</span>
            </div>
        </div>
         <!-- Maps -->
         <div class="container-fluid">
            <transition  name="easy-appear" enter-active-class="animated slideInLeft" leave-active-class="animated slideOutLeft">
                <div v-if="showSearchForm" class="searchBox">
                    <span @click="showSearchForm = false" class="clo"><i class="fas fa-times"></i></span>
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
            </transition>
        </div>
        <div v-if="viewmode == 'map' || viewmode == 'all'" >
            <div id="map">
                <GmapMap :center="centerLoc" :map-type-id="mapTypeId" :zoom="theZoom">
                <GmapMarker
                    v-for="(item, index) in markers"
                    :key="index"
                    :position="item.position"
                    @click="markerClicked(item)"
                />
                </GmapMap>
            </div>
         </div>
         <!-- List -->
         <div v-if="viewmode == 'list' || viewmode == 'all'" class="full-container">
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
    #map
        display: flex
        justify-content: flex-end
        margin: 0
        .vue-map-container 
            max-width: 100% !important
    .view-tutor
        
        background: linear-gradient(45deg, white, #f9f9f9)
        position: fixed
        left: 0
        z-index: 1
        bottom: 0
        top: 55px
        width: 33.33%
        min-width: 400px
        max-width: 100%
        padding: 30px 10px
        display: flex
        flex-direction: column
        align-items: center
        justify-content: center
        text-align: center
        .clo
            position: absolute
            top: 10px
            right: 10px
            font-size: 22px
            cursor: pointer
            color: #2575bc
        .avatar
            width: 150px
            height: 150px
            img
                max-width: 100%
                border-radius: 50%
        .data
            a
                color: #000

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
        props: {
            url : {
                type: String
            },
            authuser : {
                type: Object
            }
        },
        data()
        {
           return{
                chatWith: null,
                viewTutor: null,
                viewmode: 'all',
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
                showSearchForm: false,
                level: '',
                subject: '',
                nextPage: '',
                activeTutor: null,
                center: { lat: 40.73061, lng: -73.935242 },
                mapTypeId: "roadmap",
                markers: [
                    // { position: { lat: -0.48585, lng: 117.1466 } },
                    // { position: { lat: -6.9127778, lng: 107.6205556 } }
                ]
               
           }
        },
        computed:
        {
            centerLoc(){
                if(this.country)
                {
                    return { lat: 40.73061, lng: -73.935242 }
                }else if(this.authuser.latitude && this.authuser.longitude)
                {
                    return { lat: this.authuser.latitude, lng: this.authuser.longitude }
                }else
                {
                    return { lat: 40.73061, lng: -73.935242 }
                }
            },
            theZoom(){
                if(this.country)
                {
                    return 3
                }else if(this.authuser.latitude && this.authuser.longitude)
                {
                    return 7
                }else
                {
                    return 4
                }
            }
        },
        methods: {
            contact(id)
            {
                    axios.post(this.url +'/check/hasConversation', {
                        id: id
                    })
                    .then(response => {
                        console.log(response)
                        if(response.data.has)
                        {
                            window.location = this.url + "/messages?u=" + id;
                        }else{
                            this.startConversation(id)
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    })
            },
            markerClicked(item)
            {
                this.center = item.position
                this.viewTutor = item.tutor

                // window.location = this.url + '/user/' + item.tutor.id
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
                this.viewTutor = null
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
                    this.showSearchForm = false
                })
                .catch(error => {
                    console.log(error);
                })
            },
            avatar(user)
            {
                if(user.avatar){
                    return this.url + '/storage/images/' + user.avatar
                }else{
                if(user.gender)
                {
                    return this.url + '/img/' + user.gender.toLowerCase() + '.jpg'
                }else{
                    return this.url + '/img/male.jpg'
                }
                }
            },
            firstname(name){
                return name.split(" ")[0]
            },
            updateMap()
            {
                this.markers = []
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
