<template>
        <div class="menubar">
        <div class="link user menuser">
            <a :href="url + '/profile'">
                <img :src="avatar" alt="">
                <span>{{user.name}} {{ !user.is_active ? "( DeActivated )" : ''}}</span>
            </a>
        </div>

        <a :href="url + '/sessions'" class="link sessions">
            <i class="fas fa-calendar-alt"></i>
            <span v-if="csessions" class="count">{{csessions}}</span>
        </a>
        <a :href="url + '/messages'" class="link messages">
            <i class="fas fa-envelope"></i>
            <span v-if="cmessages" class="count">{{cmessages}}</span>
        </a>

        <slide-menu :messages="messages" :sessions="sessions" :url="url" :user="user"></slide-menu>

    </div>
</template>
<style lang="sass" scoped>
    .link
        position: relative
        .count
            position: absolute
            background: linear-gradient(30deg, #d22f2a, #f3963d)
            display: flex
            width: 20px
            height: 20px
            font-size: 13px
            justify-content: center
            align-items: center
            color: #fff
            top: 5px
            right: 2px
            border-radius: 50%
            font-weight: bold
</style>
<script>
    export default {
        props: {
            url: {
                type: String
            },
            messages: {
                type: String
            },
            sessions: {
                type: String
            },
            user: {
                type: Object
            }
        },
        data(){
            return {
               lat: '',
               lng: ''
            }
        },
        computed: {
            cmessages()
            {
                return this.$store.getters.messages
            },
            csessions()
            {
                return this.$store.getters.sessions
            },
            avatar()
            {
                if(this.user.avatar){
                    return this.url + '/storage/images/' + this.user.avatar
                }else{
                if(this.user.gender)
                {
                    return this.url + '/img/' + this.user.gender.toLowerCase() + '.jpg'
                }else{
                    return this.url + '/img/male.jpg'
                }
                }
            },
        },
        methods: {

            logout()
            {
                this.loading = true
                axios.post(this.url + '/logout')
                .then(response => {
                    window.location = this.url
                    this.loading = false
                })
                .catch(error => {
                    console.log(error)
                })
            },
            locate()
            {
                if(this.user)
                {
                    if(this.user.latitude && this.user.longitude)
                    {

                    }else{
                        this.getLocation()
                    }
                }
            },
            getLocation() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(this.setLocation)
                }
            },
           setLocation(position) {
            this.lat = position.coords.latitude
            this.lng = position.coords.longitude
                axios.post(this.url + '/post/long-lat', {
                    longitude: this.lng,
                    latitude: this.lat,
                })
                .then(response => {
                   console.log(response.data)
                })
                .catch(error => {
                    console.log(error)
                })
            }
        },
        created()
        {
            this.$store.commit('setSessions', this.sessions)
            this.$store.commit('setMessages', this.messages)
            this.locate()
        }

    }
</script>

