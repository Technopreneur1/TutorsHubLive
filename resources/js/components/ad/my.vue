<template>
    <div class="full-container">
        <div class="ttl">My <span>Ads</span></div>
        <div v-if="ads.length" class="ad-results">
            <ad v-for="ad in ads" :url="url" :ad="ad" :authid="authid" :key="ad.id"></ad>
        </div>
        <div v-else class="nothing">
            <p>You have no active ad</p>
        </div>
    </div>
    <!-- <div class="ads-list">
        <h1>wth</h1>
        <h1>wth</h1>
        <h1>wth</h1>
        <h1>wth</h1>
        <h1>wth</h1>
        <h1>wth</h1>
            <div v-if="ads.length" class="ad-results">
                <ad v-for="ad in ads" :url="url" :ad="ad" :key="ad.id"></ad>
            </div>
    </div> -->
</template>
<script>
    export default {
        props: ['url', 'authid'],
        data()
        {
           return{
               openForm: '',
               ads: [],
               books: []
           }
        },
        methods: {
           getMyAds()
            {
                axios.post(this.url +'/get/my-ads')
                .then(response => {
                    console.log(response.data)
                    this.ads = response.data.ads.data
                })
                .catch(error => {
                    console.log(error);
                })
            },
           
        },
        mounted()
        {
            this.getMyAds()
        }
    }
</script>
