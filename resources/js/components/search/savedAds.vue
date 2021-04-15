<template>
    <div class="search-page">
<!--        <transition  name="easy-appear" enter-active-class="animated slideInLeft" leave-active-class="animated slideOutLeft">-->
<!--            <start-chat v-if="chatWith" :url="url" :to="chatWith" @cancelChat="chatWith = null"></start-chat>-->
<!--        </transition>-->


<!--        <transition  name="easy-appear" enter-active-class="animated slideInLeft" leave-active-class="animated slideOutLeft">-->
<!--            <ad-view @contact="contact" @cancel="viewAd = null" v-if="viewAd" :url="url" :vad="viewAd"></ad-view>-->
<!--        </transition>-->

        <div class="full-container">
            <div v-if="ads.length" class="ad-results">
                <savedAd v-for="ad in ads" @getAds="getAds()" :url="url" :ad="ad" :key="ad.id"  :authid="authid"></savedAd>
            </div>
            <div v-else class="nothing">
                <p>No Ad Found</p>
            </div>
        </div>
    </div>

</template>
<style lang="sass" scoped>
    .view-ad
        background: linear-gradient(45deg, white, #f9f9f9)
        position: fixed
        left: 0
        z-index: 1
        bottom: 0
        top: 55px
        width: 33.33%
        max-width: 100%
        min-width: 400px
        padding: 30px 10px
        display: flex
        flex-direction: column
        align-items: center
        justify-content: center
        text-align: center
        .clo
            position: absolute
            top: 10px
            right: 10px
            font-size: 22px
            cursor: pointer
            color: #2575bc
        .avatar
            width: 100px
            height: 100px
            img
                max-width: 100%
                border-radius: 50%
        .data
            a
                color: #000

        #map
            display: flex
            justify-content: flex-end
            margin: 0
            .vue-map-container
                height: 450px
                width: 100%
                max-width: 100% !important
        .btns
            display: flex
            justify-content: center
            .btn
                margin: 0 10px
            .btn-re
                background: #777777
                color: #ffffff
                border-radius: 24px
                padding-left: 20px
                padding-right: 20px
                &:hover
                    background: #000
                    color: #fff

</style>
<script>
    import Select2 from 'v-select2-component';
    export default {
        props: {
            url : {
                type: String
            },
            authuser : {
                type: Object
            }
        },
        components: {Select2},
        data()
        {
            return{
                chatWith: null,
                viewmode: 'all',
                authid: this.authuser.id,
                ads: [],
                success: '',
                availability:'Both',
                neighborhood: '',
                showSearchForm: true,
                viewAd: null
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
            getAds()
            {
                axios.get(this.url +'/get-saved-ads')
                    .then(response => {
                        console.log(response.data)
                        this.ads = response.data.ads
                    })
                    .catch(error => {
                        console.log(error);
                    })
            }
        },
        mounted()
        {
            this.getAds()
        }
    }
</script>
