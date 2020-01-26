<template>
    <div class="view-tutor">
        <div v-if="loading || loadingwage" class="loader">
            <i class="fas fa-spinner fa-spin"></i>
        </div>
        <span class="clo" @click="cancel"><i class="fas fa-times"></i></span>
        <div class="avatar">
            <a  :href="url+ '/user/' +tutor.id" class="info">
                <img :src="avatar(tutor)" alt="">
            </a>
        </div>
        <div class="data">
            <a  :href="url+ '/user/' +tutor.id" class="info">
                <div class="name">{{firstname(tutor.name)}}</div>
                <div class="location"><i class="fas fa-map-marker-alt"></i> {{tutor.neighborhood ? tutor.neighborhood.name + ', ' : ''}}{{tutor.city ? tutor.city.name + ', ' : ''}}{{tutor.state ? tutor.state.name + ', ' : ''}}</div>
            </a>
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
</template>
<style lang="sass" scoped>
.view-tutor
    background: linear-gradient(45deg, #fffffff0, #f9f9f9e8)
    position: fixed
    left: 0
    z-index: 1
    bottom: 0
    top: 55px
    width: 33.33%
    
    max-width: 100%
    padding: 30px 10px
    display: flex
    flex-direction: column
    align-items: center
    justify-content: center
    text-align: center
    .loader
        position: absolute
        top: 0
        left: 0
        right: 0
        bottom: 0
        background: rgba(0, 0, 0, 0.4)
        color: #fff
        font-size: 25px
        display: flex
        justify-content: center
        align-items: center
    .clo
        position: absolute
        top: 10px
        right: 10px
        font-size: 22px
        cursor: pointer
        color: #2575bc
    .avatar
        width: 150px
        height: 150px
        img
            max-width: 100%
            border-radius: 50%
    .data
        .price
            font-size: 20px

        .contactbtn
            display: flex
            justify-content: center
            font-size: 22px
            border-top: 1px solid #e4f3e4
            .btn-t
                margin: 0 5px
                width: 50%
                text-align: center
                display: flex
                justify-content: center
                align-items: center
                padding: 7px
                border: 2px solid #212529
                border-radius: 50px
                cursor: pointer
                &:hover
                    background: #333
                    color: #fff

        .info
            .name
                font-size: 22px
                font-weight: bold
            .location
                font-size: 18px
                margin-bottom: 15px
        a
            color: #000
@media screen and ( max-width: 767px )
    .view-tutor
        width: 100%
@media screen and ( min-width: 768px )
    .view-tutor
        min-width: 400px
</style>
<script>
    export default {
        props: {
            url: {
                type: String
            },
            vtutor: {
                vtutor: Object
            }
        },
        watch: { 
            vtutor: function(newval, oldVal) { // watch it
            this.tutor = newval
            this.doILike()
            this.getMinWage()
            }
        },
        data()
        {
           return{
                is_fav: false,
                loading: false,
                loadingwage: false,
                wage: '',
                tutor: this.vtutor

           }
        },
        
        methods: {
            contact(id)
            {
                this.$emit("contact", id)
            },
            cancel()
            {
                this.$emit("cancel")
            },
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
           
        },
        mounted()
        {
           this.doILike()
           this.getMinWage()
           
        }
    }
</script>
