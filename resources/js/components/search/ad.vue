<template>
    <div class="ad-result" v-if="ad">
        <div v-if="loading" class="loader">
            <i class="fas fa-spinner fa-spin"></i>
        </div>
        <div class="ad">
            <div class="title">{{ outputBio(ad.title) }}</div>
            <div class="student">
                <a v-if="ad.user_id != undefined" :href="url + '/user/' + ad.user_id" class="avatar">
                    <img :src="avatar(ad)" alt="">
                </a>
                <a v-if="ad.user_id == undefined" :href="url + '/user/' + ad.id" class="avatar">

                    <img :src="avatar(ad)" alt="">
                </a>
                <div class="data">
                    <a v-if="ad.user_id != undefined" :href="url + '/user/' + ad.user_id" class="info">
                        <div class="name">{{ad.name}} <span v-if="ad.verified" class="verified"><i class="fas fa-check"></i></span></div>
                        <div class="location"><i class="fas fa-map-marker-alt"></i> {{ ad.address }}</div>
                    </a>
                    <a v-if="ad.user_id == undefined" :href="url + '/user/' + ad.id" class="info">
                        <div class="name">{{ad.name}} <span v-if="ad.verified" class="verified"><i class="fas fa-check"></i></span></div>
                        <div class="location"><i class="fas fa-map-marker-alt"></i> {{ ad.address }}</div>
                    </a>
                    <div v-if="authid == ad.user.id" class="contactbtn">
                        <button  @click="deleteMyAd(ad.id)" class="btn btn-gradient">Delete</button>
                    </div>
                    <div v-else class="contactbtn">
                        <div @click="addToFav" class="btn-t" ><i class="far fa-heart" :class="{fas: is_fav}"></i></div>
                        <div v-if="ad.user.can_contact" @click="contact(ad.user_id)" class="btn-t"><i class="fas fa-envelope"></i></div>
                       <!-- <div  @click="addToFavAd" class="btn-t" ><i class="far fa-heart" :class="{fas: is_fav}"></i></div> -->
<!--                        <div v-if="ad.can_contact" @click="contact(ad.id)" class="btn-t"><i class="fas fa-envelope"></i></div>-->
                    </div>
                </div>
            </div>
            <div class="meta" v-if="ad">
                <span class="subject">{{ad? ad.discipline.name : ''}}</span>
                <span class="level">{{ad? ad.level.name : ''}}</span>
            </div>
            <div class="ad-info">
                Description: {{ ad.description ? outputBio(ad.description) : 'N/A' }}
            </div>
            <div class="ad-info">
                Availability: {{ ad.availability ? ad.availability : 'N/A' }}
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: {
            url : {
                type: String
            },

            ad : {
                type: Object
            },

            authid : {
                type: Number
            },

            adminsettings : {
                type: Object
            },
            allowancesettings : {
                type: [Object, String]
            }
        },
        data()
        {
            // console.log('Auth ID:' + authid)
           return{
                is_fav: false,
                loading: false,
           }
        },
        methods: {
            outputBio(message)
            {

                var re = /\b[\+]?[(]?[0-9]{2,6}[)]?[-\s\.]?[-\s\/\.0-9]{3,15}\b/m;;
                let msg = message
                let phoneText = []

                if(this.allowancesettings) {
                    if (this.allowancesettings.allow_confidentials_in_ads) {
                        if (!this.allowancesettings.allow_confidentials_in_ads) {
                            while (this.checkIfPhoneInString(msg)) {
                                phoneText = msg.match(re)[0]
                                msg = msg.replace(phoneText, "*****")
                                console.log('bio: ' + msg)
                            }
                        }
                    } else {
                        if (this.adminsettings) {
                            if (!this.adminsettings.allow_confidentials_in_ads) {
                                while (this.checkIfPhoneInString(msg)) {
                                    phoneText = msg.match(re)[0]
                                    msg = msg.replace(phoneText, "*****")
                                    console.log('bio: ' + msg)
                                }
                            }
                        }
                    }
                } else {
                    if (this.adminsettings) {
                        if (!this.adminsettings.allow_confidentials_in_ads) {
                            while (this.checkIfPhoneInString(msg)) {
                                phoneText = msg.match(re)[0]
                                msg = msg.replace(phoneText, "*****")
                                console.log('bio: ' + msg)
                            }
                        }
                    }
                }

                return this.finalBio(msg)

            },
            finalBio(message)
            {
                // if(this.checkIfEmailInString(msg))
                // {
                var re = /(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))/;
                let msg = message
                let emailText = []

                if (this.allowancesettings) {
                    if (this.allowancesettings.allow_confidentials_in_ads
                    ) {
                        if (!this.allowancesettings.allow_confidentials_in_ads) {
                            while (this.checkIfEmailInString(msg)) {
                                emailText = msg.match(re)[0]
                                msg = msg.replace(emailText, "*****")
                                console.log(msg)
                            }
                        }
                    } else {
                        if (this.adminsettings) {
                            if (!this.adminsettings.allow_confidentials_in_ads) {
                                while (this.checkIfEmailInString(msg)) {
                                    emailText = msg.match(re)[0]
                                    msg = msg.replace(emailText, "*****")
                                    console.log(msg)
                                }
                            }
                        }
                    }
                } else {
                    if (this.adminsettings) {
                        if (!this.adminsettings.allow_confidentials_in_ads) {
                            while (this.checkIfEmailInString(msg)) {
                                emailText = msg.match(re)[0]
                                msg = msg.replace(emailText, "*****")
                                console.log(msg)
                            }
                        }
                    }
                }
                return msg
                // return "This message contains email"
                // console.log(this.extractEmails(message))
                // }
            },
            checkIfEmailInString(text)
            {
                var re = /(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))/;
                return re.test(text);
            },
            checkIfPhoneInString(text)
            {
                var re = /\b[\+]?[(]?[0-9]{2,6}[)]?[-\s\.]?[-\s\/\.0-9]{3,15}\b/m;;
                return re.test(text);
            },
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
                axios.post(this.url +'/postAd/favorite', {
                    id: this.ad.id
                })
                .then(response => {
                    if(response.data.status === 'liked')
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
            this.allowancesettings = JSON.parse(this.allowancesettings)
        }
    }
</script>
