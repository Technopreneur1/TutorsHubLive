<template>
    <div class="result">
        <div class="teacher">
            <a :href="url+ '/user/' +tutor.id"  class="avatar">
                <img :src="avatar(tutor)" alt="">
            </a>
            <div class="data">
                <a  :href="url+ '/user/' +tutor.id" class="info">
                    <div class="name">{{firstname(tutor.name)}}</div>
                    <div class="location"><i class="fas fa-map-marker-alt"></i> {{tutor.neighborhood ? tutor.neighborhood.name + ', ' : ''}}{{tutor.city ? tutor.city.name + ', ' : ''}}{{tutor.state ? tutor.state.name + ', ' : ''}}</div>
                </a>
                <div class="contactbtn">
                    <button @click="contact(tutor.id)" class="btn btn-gradient">Message</button>
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
                
           }
        },
        
        methods: {
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
           
        }
    }
</script>
