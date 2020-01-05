<template>
    <div class="edit-profile-slideout chp" :class="{full: 'editPlans'}">
        <!-- <transition  name="easy-appear" enter-active-class="animated slideInLeft" leave-active-class="animated slideOutLeft"> -->
        <div class="startchat">
            <div class="htd">Start Conversation</div>
            <div class="input">
                <textarea v-model="text" cols="30" rows="5" placeholder="Write Your Message"></textarea>
            </div>
            <div class="input">
                <button v-if="!loading" @click="send" class="btn btn-snd" :disabled="loading">Send</button>
                <button v-else class="btn btn-snd" :disabled="loading"><i class="fas fa-spinner fa-spin"></i></button>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: ['url', 'to'],
        data()
        {
           return{
               loading: false,
               text: ''
           }
        },
        methods: {
           send()
            {
                this.loading = true;
                if (!this.text) {
                    return;
                }

                axios.post('/conversation/send', {
                    contact_id: this.to,
                    text: this.text
                }).then((response) => {
                    window.location = this.url + "/messages?u=" + this.to
                })
            },
        },
        mounted()
        {
            
        }
    }
</script>
<style lang="scss" scoped>
    .htd{
        text-align: center;
        font-size: 30px;
        color: #53a221;
    }
    .chp{
        background: rgba(0, 0, 0, 0.92)
    }
    .startchat{
        margin: 0 auto;
        max-width: 450px;
    }
    .btn-snd{
        background: #53a221;
        color: #ffffff;
        width: 100%;
    }
</style>