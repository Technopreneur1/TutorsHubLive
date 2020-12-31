<template>
    <div class="ad-result">
        <div v-if="loading" class="loader">
            <i class="fas fa-spinner fa-spin"></i>
        </div>
        <div class="ad">
            <div class="title">{{ad.title}}</div>
            <div class="student">
                <a :href="url + '/user/' + ad.id" class="avatar">
                    <img :src="avatar(ad)" alt="">
                </a>
                <div class="data">
                    <a :href="url + '/user/' + ad.id" class="info">
                        <div class="name">{{ad.name}} <span v-if="ad.verified" class="verified"><i class="fas fa-check"></i></span></div>
                        <div class="location"><i class="fas fa-map-marker-alt"></i> {{ad.neighborhood ? ad.neighborhood.name + ', ' : ''}}{{ad.city ? ad.city.name + ', ' : ''}}{{ad.state ? ad.state.name + ', ' : ''}}</div>
                    </a>
                    <div v-if="authid == ad.id" class="contactbtn">
                        <button  @click="deleteMyAd(ad.id)" class="btn btn-gradient">Delete</button>
                    </div>
                    <div v-else class="contactbtn">
                        <div  @click="addToFav" class="btn-t" ><i class="far fa-heart" :class="{fas: is_fav}"></i></div>
                        <div v-if="ad.can_contact" @click="contact(ad.id)" class="btn-t"><i class="fas fa-envelope"></i></div>
                    </div>
                </div>
            </div>
            <div class="meta" v-if="ad.ad_detail">
                <span class="subject">{{ad.ad_detail? ad.ad_detail.discipline.name : ''}}</span>
                <span class="level">{{ad.ad_detail? ad.ad_detail.level.name : ''}}</span>
            </div>
            <div class="ad-info">
                {{ ad.ad_detail ? ad.ad_detail.description : '' }}
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
                is_fav: false,
                loading: false,
           }
        },
        methods: {
            editAd()
            {
                this.$emit("editAd")
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
            contact(id)
           {
                axios.post(this.url +'/check/hasConversation', {
                    id: id
                })
                .then(response => {
                    if(response.data.has)
                    {
                        window.location = this.url + "/messages?u=" + id;
                    }else{
                        this.$emit('startConversation')
                    }
                })
                .catch(error => {
                    console.log(error);
                })
           },
           deleteMyAd(id)
            {
                axios.post(this.url +'/delete/my-ad', {
                    'id': id
                })
                .then(response => {
                    console.log(response.data)
                    window.location = this.url + '/my-ads'
                })
                .catch(error => {
                    console.log(error);
                })
            },
             addToFav()
            {
                this.loading = true
                axios.post(this.url +'/post/favorite', {
                    id: this.ad.id
                })
                .then(response => {
                    if(response.data.status == 'liked')
                    {
                        this.is_fav = true
                    }else{
                        this.is_fav = false
                    }
                    this.loading = false
                })
                .catch(error => {
                    console.log(error);
                })
            },
        },
        mounted()
        {
        //    console.log(this.ad)
        }
    }
</script>
