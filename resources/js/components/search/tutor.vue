<template>
    <div class="result">
        <a :href="url+ '/user/' +tutor.id" class="teacher">
            <div class="avatar">
                <img :src="url + '/img/male.jpg'" alt="">
            </div>
            <div class="data">
                <div class="info">
                    <div class="name">{{tutor.name}}</div>
                    <div class="location"><i class="fas fa-map-marker-alt"></i> {{tutor.neighborhood ? tutor.neighborhood.name + ', ' : ''}}{{tutor.city ? tutor.city.name + ', ' : ''}}</div>
                </div>
                <div class="contactbtn">
                    <button @click="contact(tutor.id)" class="btn btn-success">Message</button>
                </div>
            </div>
        </a>
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
