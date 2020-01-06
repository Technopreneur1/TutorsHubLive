<template>
    <div class="ad-result">
        <div class="ad">
            <div class="student">
                <a :href="url + '/user/' + ad.user.id" class="avatar">
                    <img :src="url + '/img/male.jpg'" alt="">
                </a>
                <div class="data">
                    <a :href="url + '/user/' + ad.user.id" class="info">
                        <div class="name">{{ad.user.name}}</div>
                        <div class="location"><i class="fas fa-map-marker-alt"></i> {{ad.neighborhood ? ad.neighborhood.name + ', ' : ''}}{{ad.city ? ad.city.name + ', ' : ''}}</div>
                    </a>
                    <div class="contactbtn">
                        <button v-if="authid == ad.user.id" @click="deleteMyAd(ad.id)" class="btn btn-gradient">Delete</button>
                        <button  v-else @click="contact(ad.user.id)" class="btn btn-msg">Message</button>
                    </div>
                </div>
            </div>
            <div class="meta">
                <span class="subject">{{ad.discipline.name}}</span>
                <span class="level">{{ad.level.name}}</span>
            </div>
            <div class="ad-info">
                {{ad.description}}
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
                
           }
        },
        methods: {
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
        },
        mounted()
        {
           
        }
    }
</script>
