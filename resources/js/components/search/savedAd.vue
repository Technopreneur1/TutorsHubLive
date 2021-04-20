<template>
    <div class="ad-result" v-if="ad">
        <div v-if="loading" class="loader">
            <i class="fas fa-spinner fa-spin"></i>
        </div>
        <div class="ad">
            <div class="title">{{ad.ad.title}}</div>
            <div class="student">
                <a v-if="ad.user_id != undefined" :href="url + '/user/' + ad.user_id" class="avatar">
                    <img :src="avatar(ad)" alt="">
                </a>
                <a v-if="ad.user_id == undefined" :href="url + '/user/' + ad.id" class="avatar">

                    <img :src="avatar(ad)" alt="">
                </a>
                <div class="data">
                    <a v-if="ad.user_id != undefined" :href="url + '/user/' + ad.ad.user_id" class="info">
                        <div class="name">{{ad.ad.user.name}} <span v-if="ad.verified" class="verified"><i class="fas fa-check"></i></span></div>
                        <div class="location"><i class="fas fa-map-marker-alt"></i> {{ ad.ad.address }}</div>
                    </a>
                    <a v-if="ad.user_id == undefined" :href="url + '/user/' + ad.ad.id" class="info">
                        <div class="name">{{ad.ad.user.name}} <span v-if="ad.verified" class="verified"><i class="fas fa-check"></i></span></div>
                        <div class="location"><i class="fas fa-map-marker-alt"></i> {{ ad.address }}</div>
                    </a>
                    <div v-else class="contactbtn">
                        <div @click="addToFav" class="btn-t" ><i class="far fa-heart" :class="{fas: is_fav}"></i></div>
                        <div v-if="ad.can_contact" @click="contact(ad.user_id)" class="btn-t"><i class="fas fa-envelope"></i></div>
                       <!-- <div  @click="addToFavAd" class="btn-t" ><i class="far fa-heart" :class="{fas: is_fav}"></i></div> -->
<!--                        <div v-if="ad.can_contact" @click="contact(ad.id)" class="btn-t"><i class="fas fa-envelope"></i></div>-->
                    </div>
                </div>
            </div>
            <div class="meta" v-if="ad">
                <span class="subject">{{ad.ad.discipline? ad.ad.discipline.name : ''}}</span>
                <span class="level">{{ad.ad.level? ad.ad.level.name : ''}}</span>
            </div>
            <div class="ad-info">
                Description: {{ ad.ad.description ? ad.ad.description : 'N/A' }}
            </div>
            <div class="ad-info">
                Availability: {{ ad.ad.availability ? ad.ad.availability : 'N/A' }}
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: ['url', 'ad', 'authid'],
        data()
        {
           return{
                is_fav: true,
                loading: false,
           }
        },
        methods: {
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
             addToFav()
            {
                this.loading = true
                axios.post(this.url +'/postAd/favorite', {
                    id: this.ad.ad.id
                })
                .then(response => {
                    if(response.data.status === 'liked')
                    {
                        this.is_fav = true
                    }else{
                        this.is_fav = false
                    }
                    this.loading = false
                    this.$emit('getAds')

                })
                .catch(error => {
                    console.log(error);
                })
            },
        },
        mounted()
        {

        }
    }
</script>
