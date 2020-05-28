<template>
    <div class="full-container">
        <full-loader v-if="loading" ></full-loader>
        
        <div v-if="sess.length" class="sessionsList">
            <div v-for="ses in sess" :key="ses.id" class="session">
                <a v-if="authuser.type == 'student'" :href="url + '/user/' + ses.teacher.user.id" class="with">
                    <div class="avatar">
                        <img :src="avatar(ses.teacher.user)" alt="">
                    </div>
                    <div class="info">
                        <div class="name">{{ses.teacher.user.name}} <span v-if="ses.teacher.user.verified" class="verified"><i class="fas fa-check"></i></span></div>
                    </div>
                </a>
                <a v-if="authuser.type == 'teacher'" :href="url + '/user/' + ses.student.user.id" class="with">
                    <div class="avatar">
                        <img :src="avatar(ses.student.user)" alt="">
                    </div>
                    <div class="info">
                        <div class="name">{{ses.student.user.name}} <span v-if="ses.student.user.verified" class="verified"><i class="fas fa-check"></i></span></div>
                    </div>
                </a>
                <div class="info">
                    <span class="dt">{{ses.created_at | moment('DD MMM, YYYY')}}</span>
                    <div class="val"><span>{{ses.level}}</span></div>
                    <div class="val"><span>{{ses.subject}}</span></div>
                </div>
                <div class="actions">
                    <div class="status">{{ses.completed ? "Completed" : 'Incomplete'}}</div>
                    <button class="btn btn-gradient">Open</button>
                </div>
           </div>
       </div>
   </div>
</template>
<style lang="sass" scoped>
    .sessionsList
        .session
            display: flex
            background: #e4f3e4
            padding: 5px
            border-radius: 3px
            justify-content: space-between
            margin-bottom: 10px
            flex-wrap: wrap
            box-shadow: 0 1px 1px 0 #53a2216b
            .with
                margin: 10px 0
                .avatar
                    width: 65px
                    height: 65px
                    margin: 0 auto
                    img
                        max-width: 100%
                        border-radius: 50%
            
            .info
                padding: 0 5px
                margin: 5px 0
                display: flex
                flex-direction: column
                justify-content: center
                align-items: center 
            .actions
                margin: 10px 0
                padding: 0 5px
                display: flex
                flex-direction: column
                justify-content: center
                align-items: center
                .status
                    font-weight: bold
                    text-align: center
                    color: #df5033
                    padding: 2px 5px
            
</style>
<script>
    export default {
        props: {
            url: {
                type: String
            },
            sessions: {
                type: Array
            },
            authuser: {
                type: Object
            },
        },
        data()
        {
           return{
                loading: false,
                sess: this.sessions
           }
        },
        methods: {
            del(fav){
                this.loading = true
                axios.post(this.url +'/delete/favorite', {
                    id: fav.user.id
                })
                .then(response => {
                this.favs.splice( this.favs.indexOf(fav), 1 )
                    this.loading = false
                })
                .catch(error => {
                    console.log(error)
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
        },
        mounted()
        {
           
        }
    }
</script>
