<template>
        <span class="link hamburger">
            <full-loader v-if="loading" ></full-loader>
            <i  @click="toggleShow" class="fas" :class="[show ? 'fa-times' : 'fa-bars']" ></i>
            <transition  name="easy-appear" enter-active-class="animated slideInRight" leave-active-class="animated slideOutRight">
                <div v-show="show" class="slideMenu">
                    <div class="smuser">
                        <a :href="url + '/profile'">
                            <div class="avatar">
                                <img :src="avatar" alt="">
                            </div>
                            <p class="name">{{user.name}}</p>
                        </a>
                        <span @click="logout" class="logout">Logout</span>
                    </div>
                    <ul class="smlinks">
                        <li><a :href="this.url">Home</a></li>
                        <li v-if="user.type == 'teacher'"><a :href="url + '/ads'">Find Students</a></li>
                        <li v-if="user.type == 'student'"><a :href="url + '/find'">Find Tutors</a></li>
                        <li v-if="user.type == 'student'"><a :href="url + '/my-ads'">My Ads</a></li>
                        <li v-if="user.type == 'student'"><a :href="url + '/create/ad'">Post New Ad</a></li>
                        <li><a :href="url + '/messages'">Messages <span v-if="messages" class="tag">{{messages}}</span></a></li>
                        <li><a :href="url + '/sessions'">My Sessions <span v-if="sessions" class="tag">{{sessions}}</span></a></li>
                        <li><a :href="url + '/profile'">My Account</a></li>
                        <li><a :href="url + '/favorites'">Saved Profiles</a></li>
                    </ul>
                </div>
            </transition>
        </span>
</template>
<style lang="sass" scoped>
    .slideMenu
        background: linear-gradient(30deg, #2575bc, #7df48cf2)
        color: #fff
        position: fixed
        width: 300px
        max-width: 100%
        right: 0
        bottom: 0
        top: 55px
        z-index: 112
        overflow-y: scroll
        .fa
            transition: 1s ease all
        .smuser
            text-align: center
            display: flex
            background: rgba(0, 0, 0, 0.16862745098039217)
            padding: 10px
            flex-direction: column
            justify-content: center
            align-items: center
            a
                text-decoration: none
            .name
                font-size: 17px
                margin: 0
                color: #fff

            .logout
                font-size: 16px
                background: linear-gradient(45deg, white, #e4f3e4)
                position: absolute
                left: 5px
                top: 5px
                color: #333
                border-radius: 19px
                padding: 2px 12px
                font-weight: bold
                cursor: pointer
            .avatar
                width: 80px
                height: 80px
                margin: 0 auto
                img
                    border-radius: 50%
                    max-width: 100%
        .smlinks
            list-style: none
            margin: 10px 0
            padding: 0
            font-size: 17px
            
            
            li
                a
                    display: block
                    background: rgba(0, 0, 0, 0.16862745098039217)
                    color: #fff
                    padding: 3px 15px
                    text-decoration: none
                    margin: 1px 0
                    .tag 
                        background: linear-gradient(30deg, #d22f2a, #f3963d)
                        padding: 3px 10px
                        border-radius: 4px
                    &:hover   
                        background: rgba(0, 0, 0, 0.6862745098039217)


    
    @media screen and (max-width: 425px)
        .slideMenu
            width: 100%
</style>
<script>
    export default {
        props: {
            url: {
                type: String
            },
            user: {
                type: Object
            },
            messages: {
                type: String
            },
            sessions: {
                type: String
            },
        },
        data(){
            return {
                show: false,
                loading: false
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
            openMenu()
            {
                alert('ok')
            },
            toggleShow()
            {
                this.show ? this.show = false : this.show = true
            },
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
        
        created()
        {
            let self = this
            window.addEventListener('click', function(e){
                // close dropdown when clicked outside
                if (!self.$el.contains(e.target)){
                self.show = false
                } 
            })

        }
    }
</script>

