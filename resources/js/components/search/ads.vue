<template>
     <div class="search-page">
         <transition  name="easy-appear" enter-active-class="animated slideInLeft" leave-active-class="animated slideOutLeft">
            <start-chat v-if="chatWith" :url="url" :to="chatWith" @cancelChat="chatWith = null"></start-chat>
         </transition>
         <transition  name="easy-appear" enter-active-class="animated slideInLeft" leave-active-class="animated slideOutLeft">
            <div v-if="viewAd" class="view-ad">
                <span class="clo" @click="viewAd = null"><i class="fas fa-times"></i></span>
                <div class="avatar">
                    <a  :href="url+ '/user/' +viewAd.user.id" class="info">
                        <img :src="avatar(viewAd.user)" alt="">
                    </a>
                </div>
                <div class="data">
                    <a  :href="url+ '/user/' +viewAd.user.id" class="info">
                        <div class="name">{{viewAd.user.name}}</div>
                        <div class="location"><i class="fas fa-map-marker-alt"></i> {{viewAd.user.neighborhood ? viewAd.user.neighborhood.name + ', ' : ''}}{{viewAd.user.city ? viewAd.user.city.name + ', ' : ''}}{{viewAd.user.state ? viewAd.user.state.name + ', ' : ''}}</div>
                    </a>
                    <div class="contactbtn">
                        <button @click="contact(viewAd.user.id)" class="btn btn-gradient">Message</button>
                    </div>
                </div>
                <div class="adData">
                    <div class="title">{{viewAd.title}}</div>
                </div>
                <div class="adDescription">
                    <div class="title">{{viewAd.description}}</div>
                </div>
            </div>
         </transition>
         <div class="container-fluid">
             <div class="row">
                 <div :class="showSearchForm ? 'col-md-4' : 'col-md-12' " class="mb-3" >
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
                            <button @click="getAds()" class="btn btn-gradient">Search</button>
                        </div>
                    </div>
                 </div>
                 <div :class="showSearchForm ? 'col-md-8' : 'col-md-12' ">
                     <div id="map">
                        <GmapMap :center="center" :map-type-id="mapTypeId" :zoom="7">
                        <GmapMarker
                            v-for="(item, index) in markers"
                            :key="index"
                            :position="item.position"
                            @click="markerClicked(item)"
                        />
                        </GmapMap>
                    </div>
                </div>
             </div>
         </div>
        <div class="full-container">
            <div v-if="ads.length" class="ad-results">
                <ad v-for="ad in ads" @startConversation="startConversation(ad.user.id)" :url="url" :ad="ad" :key="ad.id"></ad>
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
        .adData
            margin-top: 20px
            .title
                font-size: 22px
                font-weight: bold
            .adDescription
                font-size: 16px
    #map
        display: flex
        justify-content: flex-end
        margin: 0 -15px
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
    export default {
        props: ['url'],
        data()
        {
           return{
               chatWith: null,
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
                this.viewAd = item.ad

                // window.location = this.url + '/user/' + item.tutor.id
            },
            updateMap()
            {
                this.markers = []
                this.ads.forEach(ad => {
                    let ulat = ad.user.latitude
                    let ulng =  ad.user.longitude
                    if(ulat && ulng)
                    {
                        this.markers.push({ position: { lat: ulat, lng: ulng }, ad: ad })
                        this.center = { lat: ulat, lng: ulng }
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
                axios.post(this.url +'/search/ads', {
                    'country': this.country,
                    'state': this.state,
                    'city': this.city,
                    'neighborhood': this.neighborhood,
                    'level': this.level,
                    'subject': this.subject,
                })
                .then(response => {
                    console.log(response.data)
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
            this.getAds()
            this.getLevels()
            this.getDisciplines()
        }
    }
</script>
