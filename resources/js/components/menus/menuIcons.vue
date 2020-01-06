<template>
        <div class="menubar">
        <div class="link user menuser">
            <a :href="url + '/profile'">
                <img :src="avatar" alt="">
                <span>{{user.name}}</span>
            </a>
        </div>
        
        <a :href="url + '/sessions'" class="link sessions">
            <i class="fas fa-calendar-alt"></i>
            <span v-if="sessions" class="count">{{sessions}}</span>
        </a>
        <a :href="url + '/messages'" class="link messages">
            <i class="fas fa-envelope"></i>
            <span v-if="messages" class="count">{{messages}}</span>
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
               
            }
        },
        computed: {
            avatar()
            {
                if(this.user.avatar){
                    return this.url + '/storage/images/' + this.user.avatar
                }else{
                if(this.user.gender)
                {
                    return this.url + '/img/' + this.user.gender + '.jpg'
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
            }
        },
        
        
    }
</script>

