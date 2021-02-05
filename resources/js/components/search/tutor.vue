<template>
    <div class="result">
        <div v-if="loading || loadingwage" class="loader">
            <i class="fas fa-spinner fa-spin"></i>
        </div>
        <div class="teacher">
            <a :href="url+ '/user/' +tutor.id"  class="avatar">
                <img :src="avatar(tutor)" alt="">
            </a>
            <div class="data">
                <a  :href="url+ '/user/' +tutor.id" class="info">
                    <div class="name">{{firstname(tutor.name)}}  <span v-if="tutor.verified" class="verified"><i class="fas fa-check"></i></span></div>
                    <div class="location"><i class="fas fa-map-marker-alt"></i> {{tutor.address}}</div>
                </a>
                <div class="rightinfo">
                    <div class="price">
                        <span v-if="!this.wage && !loadingwage">No Plans</span>
                        <span v-else>${{wage}}/hour</span>
                    </div>
                    <div class="contactbtn">
                        <div @click="addToFav" class="btn-t" ><i class="far fa-heart" :class="{fas: is_fav}"></i></div>
                        <div v-if="tutor.can_contact" @click="contact(tutor.id)" class="btn-t"><i class="fas fa-envelope"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: ['url', 'tutor'],
        data()
        {
           return{
                is_fav: false,
                loading: false,
                loadingwage: false,
                wage: ''
           }
        },
        
        methods: {
            doILike()
            {
                this.loading = true
                axios.post(this.url +'/check/doILike', {
                    id: this.tutor.id
                })
                .then(response => {
                    if(response.data.status)
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
            getMinWage()
            {
                this.loadingwage = true
                axios.post(this.url +'/get/min-wage', {
                    id: this.tutor.id
                })
                .then(response => {
                   this.wage = response.data.wage
                   this.loadingwage = false
                })
                .catch(error => {
                    console.log(error);
                })
            },
            addToFav()
            {
                this.loading = true
                axios.post(this.url +'/post/favorite', {
                    id: this.tutor.id
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
            firstname(name){
                console.log(name)
                return name.split(" ")[0]
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
           }
        },
        mounted()
        {
           this.doILike()
           this.getMinWage()
           
        }
    }
</script>
