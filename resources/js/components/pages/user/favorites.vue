<template>
   <div class="full-container">
       <full-loader v-if="loading" ></full-loader>
       <div v-if="favs.length" class="usersList">
           <div  v-for="fav in favs" :key="fav.id" class="user">
               <a :href="url + '/user/' + fav.user.id">
                <div class="avatar">
                    <img :src="avatar(fav.user)" alt="">
                </div>
                <div class="info">
                    <div class="name">{{fav.user.name}}</div>
                </div>
               </a>
               <span @click="del(fav)" class="del"><i class="fa fa-times"></i></span>
           </div>
       </div>
        <div v-else class="nothing">
            No Saved Profile Available
        </div>
   </div>
</template>
<style lang="sass" scoped>
    .usersList
        display: flex
        flex-wrap: wrap
        justify-content: center
        .user
            background: #e4f3e4
            padding: 10px 10px 5px
            text-align: center
            border-radius: 4px
            position: relative
            margin: 0 15px 20px
            a
                color: #000
                text-decoration: none
            .del
                position: absolute
                top: 3px 
                right: 3px
                font-size: 18px
                color: #df4c32
                &:hover
                    color: #000
                    cursor: pointer
            .info
                font-size: 16px
                font-weight: bold
            .avatar
                width: 75px
                height: 75px
                img
                    max-width: 100%
                    border-radius: 50%
</style>
<script>
    export default {
        props: {
            url: {
                type: String
            },
            favorites: {
                type: Array
            },
        },
        data()
        {
           return{
                loading: false,
                favs: this.favorites
           }
        },
        methods: {
            del(fav){
                this.loading = true
                axios.post(this.url +'/delete/favorite', {
                    id: fav.user.id
                })
                .then(response => {
                this.favs.splice( this.favs.indexOf(fav), 1 );
                    this.loading = false
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
        },
        mounted()
        {
           
        }
    }
</script>
