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
                        <div class="name">{{ses.teacher.user.name}}</div>
                    </div>
               </a>
               <a v-else :href="url + '/user/' + ses.student.user.id" class="with">
                    <div class="avatar">
                        <img :src="avatar(ses.student.user)" alt="">
                    </div>
                    <div class="info">
                        <div class="name">{{ses.student.user.name}}</div>
                    </div>
               </a>
               <div class="info">
                   <div class="val">Level: <span>{{ses.level}}</span></div>
                   <div class="val">Subject: <span>{{ses.subject}}</span></div>
               </div>
               <div class="rates">
                   <div class="val">Hours: <span>{{ses.hours}} hours</span></div>
                   <div class="val">Rate: <span>${{ses.rate}}/hour</span></div>
                   <div class="val">Total: <span>${{ses.total}}</span></div>
               </div>
               <div class="dates">
                   <span>Booking Date</span>
                   <span class="dt">{{ses.created_at | moment('DD MMMM, YYYY')}}</span>
               </div>
           </div>
       </div>
       <div v-else class="nothing">
           No Session Available
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
            .with
                margin: 10px 0
                .avatar
                    width: 75px
                    height: 75px
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
            .rates
                margin: 10px 0
                padding: 0 5px
                display: flex
                flex-direction: column
                justify-content: center
                align-items: center 
            .dates
                margin: 10px 0
                padding: 0 5px
                display: flex
                flex-direction: column
                justify-content: center
                align-items: center 
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
