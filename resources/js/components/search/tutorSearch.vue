<template>
    <div class="search-page tutp">
        <transition  name="easy-appear" enter-active-class="animated slideInLeft" leave-active-class="animated slideOutLeft">
            <start-chat v-if="chatWith" :url="url" :to="chatWith" @cancelChat="chatWith = null"></start-chat>
        </transition>

        <transition  name="easy-appear" enter-active-class="animated slideInLeft" leave-active-class="animated slideOutLeft">
            <tutor-view @contact="contact" @cancel="viewTutor = null" v-if="viewTutor" :url="url" :vtutor="viewTutor"></tutor-view>
        </transition>
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
                    </div>    <div class="input">
                        <label for="">Availability</label>
                        <select v-model="availability" name="availability" id="">
                            <option value="">-- Availability --</option>
                            <option value="Online">Online</option>
                            <option value="In-Person">In-Person</option>
                            <option value="Both">Both</option>
                        </select>
                    </div>
                    <div class="newrow">
                        <span>Location</span>
                    </div>
                    <div class="input">
                        <label for="">Radius</label>
                        <input type="range" min="1" max="1000" name="radius" value="1000" id="">

                        <!-- <input type="number" v-model="radius" id=""> -->
                    </div>
                    <!-- <div class="input">
                        <label for="">Country</label>
                        <Select2 v-model="country" :options="countries" @change="countrySelected()" />
                    </div>
                    <div v-show="states.length" class="input">
                        <label for="">State / Province</label>
                        <Select2 v-model="state" :options="states" @change="stateSelected()"  />
                    </div>
                    <div v-show="cities.length" class="input">
                        <label for="">City</label>
                        <Select2 v-model="city" :options="cities" @change="citySelected()"  />
                    </div>
                    <div v-show="neighborhoods.length" class="input">
                        <label for="">Neighborhood</label>
                        <Select2 v-model="neighborhood" :options="neighborhoods"   />
                    </div> -->
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
    import Select2 from 'v-select2-component';

    export default {
        props: {
            url : {
                type: String
            },
            authuser : {
                type: Object
            }
        },
        components: {Select2},
        data()
        {
           return{
                myValue: '',
                myOptions: [{id: "1", text: "a"}, {id: "2", text: "b"}],
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
            myChangeEvent(val){
            console.log(val);
            },
            mySelectEvent({id, text}){
                console.log({id, text})
            },
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
                this.radius = $("input[name=radius]").val();
                axios.post(this.url +'/search/tutors', {
                    'radius': this.radius,
                    'level': this.level,
                    'subject': this.subject,
                    'availability': this.availability,
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
                axios.post(this.url +'/get/cities', {state: this.state})
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
                axios.post(this.url +'/get/neighborhoods', {city: this.city})
                .then(response => {
                    this.neighborhoods = response.data.neighborhoods
                    this.neighborhoods.map(function (obj) {
                        obj.text =  obj.name; // replace name with the property used for the text
                    });
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
                    this.countries.map(function (obj) {
                    obj.text =  obj.name; // replace name with the property used for the text
                    });
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
