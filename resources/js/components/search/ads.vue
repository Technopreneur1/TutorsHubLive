<template>
     <div class="search-page">
         <transition  name="easy-appear" enter-active-class="animated slideInLeft" leave-active-class="animated slideOutLeft">
            <start-chat v-if="chatWith" :url="url" :to="chatWith" @cancelChat="chatWith = null"></start-chat>
         </transition>


        <transition  name="easy-appear" enter-active-class="animated slideInLeft" leave-active-class="animated slideOutLeft">
            <ad-view @contact="contact" @cancel="viewAd = null" v-if="viewAd" :url="url" :vad="viewAd"></ad-view>
        </transition>


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

         <div class="container-fluid">
            <div  v-if="showSearchForm"  class="searchBox">
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
                <div class="input">
                    <label for="">In Person/Online</label>
                    <select v-model="availability" name="availability" id="">
                        <option value="">-- Availability --</option>
                        <option value="Online">Online</option>
                        <option value="In-Person">In-Person</option>
                        <option value="Both" selected>Both</option>
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
                    <button @click="getAds()" class="btn btn-gradient">Search</button>
                </div>
            </div>
         </div>

                 <div  v-if="viewmode == 'map' || viewmode == 'all'" >
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

        <div v-if="viewmode == 'list' || viewmode == 'all'"  class="full-container">
            <div v-if="ads.length" class="ad-results">
                <ad v-for="ad in ads" @startConversation="startConversation(ad.id)" :url="url" :ad="ad" :key="ad.id"></ad>
            </div>
            <div v-else class="nothing">
                <p>No Ad Found</p>
            </div>
        </div>
    </div>

</template>
<style lang="sass" scoped>
    .view-ad
        background: linear-gradient(45deg, white, #f9f9f9)
        position: fixed
        left: 0
        z-index: 1
        bottom: 0
        top: 55px
        width: 33.33%
        max-width: 100%
        min-width: 400px
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
            width: 100px
            height: 100px
            img
                max-width: 100%
                border-radius: 50%
        .data
            a
                color: #000

    #map
        display: flex
        justify-content: flex-end
        margin: 0
        .vue-map-container
            height: 450px
            width: 100%
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
               chatWith: null,
               viewmode: 'all',
                ads: [],
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
                viewAd: null,
                level: '',
                subject: '',
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
                this.viewAd = null
                this.center = item.position
                this.viewAd = item.ad
            },
            updateMap()
            {
                this.markers = []
                this.ads.forEach(ad => {
                    let ulat = ad.latitude
                    let ulng =  ad.longitude
                    if(ulat && ulng)
                    {
                        this.markers.push({ position: { lat: ulat, lng: ulng }, ad: ad })
                        // this.center = { lat: ulat, lng: ulng }
                    }
                })
            },
            startConversation(id)
            {
                this.chatWith = id
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
                this.getAds()
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
            getAds()
            {
                this.radius = $("input[name=radius]").val();
                axios.post(this.url +'/search/ads', {
                    'radius': this.radius,
                    'level': this.level,
                    'availability': this.availability,
                    'subject': this.subject,
                })
                .then(response => {
                    // console.log(response.data)
                    this.ads = response.data.ads.data
                    this.updateMap()
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
            // this.getCountries()
            // this.getStates()
            // this.getCities()
            this.getAds()
            this.getLevels()
            this.getDisciplines()
        }
    }
</script>
