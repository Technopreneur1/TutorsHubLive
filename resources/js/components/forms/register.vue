<template>
    <div class="hero">
        <div @click="openRegForm('teacher')" class="col tcol">
            <div class="lbl">Register As</div>
            <div  class="nm">Tutor</div>
        </div>
        <div @click="openRegForm('student')" class="col scol">
            <div class="lbl">Register As</div>
            <div  class="nm">Student</div>
        </div>
        <div v-if="showLocationAlert" class="locPop">
            <div class="localert">
                <div class="text">Please Allow Tutors-Hub to Access Your Location For Precise Search Results</div>
                <div class="actions">
                    <button @click="continueAnyway()" class="btn btn-anyway">Continue anyway</button>
                    <button @click="reload()" class="btn btn-enb">I have enabled. Reload</button>
                </div>
            </div>
        </div>
         <transition name="easy-appear" enter-active-class="animated slideInLeft" leave-active-class="animated slideOutLeft">
            <teacher-register v-show="openForm == 'teacher'" :lat="lat" :lng="lng" @closeForm="openForm = ''" :url="url"></teacher-register>
        </transition>
        <transition name="easy-appear" enter-active-class="animated slideInLeft" leave-active-class="animated slideOutLeft">
            <student-register v-show="openForm == 'student'" :lat="lat" :lng="lng" @closeForm="openForm = ''" :url="url"></student-register>
        </transition>
    </div>
    
</template>
<style lang="sass" scoped>
    .locPop
        position: fixed
        top: 55px
        left: 0
        bottom: 0
        display: flex
        justify-content: center
        align-items: center
        right: 0
        background: rgba(0,0,0,0.6)
        color: #fff
        z-index: 4
        .localert
            padding: 15px
            border-radius: 4px
            background: #141414
            width: 500px
            text-align: center
            max-width: 95%
            margin: 0 auto
            color: #fff
            .hd
                font-size: 25px
                color: #fff
                font-weight: bold
            .text
                font-size: 22px
                color: #fff
                font-weight: bold
            .actions
                .btn-enb
                    border: 2px solid #7df48c
                    color: #7df48c
                    border-radius: 30px
                    background: none
                    &:hover
                        background: #7df48c
                        color: #000
                        
                .btn-anyway
                    color: #fff
</style>
<script>
    export default {
        props: ['url'],
        data()
        {
           return{
               openForm: '',
               lat: '',
               lng: '',
               selected: '',
               showLocationAlert: false,
               books: []
           }
        },
        
        methods: {
            
            reload()
            {
                location.reload()
            },
            openRegForm(type)
            {
                this.showLocationAlert = false
                console.log(this.lat)
                console.log(this.lng)
                if(!this.lat && !this.lat)
                {
                    // console.log(this.lat)
                    this.selected = type
                    this.showLocationAlert = true
                    
                }
                else
                {
                    this.openForm = type;
                    this.showLocationAlert = false
                }
            },
            continueAnyway()
            {
                this.openForm = this.selected;
            },
            getLocation() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(this.setLocation)
                } 
            },
           setLocation(position) {
            this.lat = position.coords.latitude
            this.lng = position.coords.longitude

            // var img_url = "https://maps.googleapis.com/maps/api/staticmap?center=
            // "+latlon+"&zoom=14&size=400x300&sensor=false&key=YOUR_KEY";

            }
        },
        mounted()
        {
            this.getLocation()
        }
    }
</script>
