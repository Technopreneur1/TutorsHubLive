<template>
     <div class="slideout">
         <div class="cont">
            <span id="success" @click="$emit('cancel')" class="btn-cancel"><i class="fas fa-long-arrow-alt-left"></i></span>
            <transition  name="easy-appear" enter-active-class="animated bounce" leave-active-class="animated fadeOut">
                <div v-if="success" class="input success"><span>{{success}}</span></div>
            </transition>
            
            <div class="input">
                <label for="">Paypal (payment) Account </label>
                <textarea v-model="paypal" id="" cols="30" rows="3"></textarea>
            </div>
            <div class="input">
                <button @click="update()" class="btn btn-update" :disabled="!isReady">Update</button>
            </div>
         </div>
    </div>
</template>
<style lang="sass" scoped>
    .slideout
        position: fixed
        top: 55px
        padding: 20px 0
        bottom: 0
        left: 0
        width: 400px
        max-width: 100%
        overflow-y: scroll
        background: linear-gradient(30deg, #2575bc, #7df48cf2)
        z-index: 11
        color: #fff
        .success
            background: #e35934
            padding: 5px 10px
            border-radius: 22px
        .btn-cancel
            font-size: 25px
            margin-bottom: 30px
        .btn-update
            background: #fff
            width: 100%
        .cont
            padding: 20px 10px
</style>
<script>
    export default {
        props: {
            user: {
                type: Object
            },
            url: {
                type: String
            },
            
        },
        data()
        {
           return{
                success: '',
                paypal: this.user.profile.payment
           }
        },
        computed: {
            isReady()
            {
                if(this.paypal != this.user.profile.payment)
                {
                    return true
                }else{
                    return false
                }
            }
        },
        methods: {
            update()
            {
                axios.post(this.url +'/update/payment-info', 
                {
                    payment: this.paypal,
                })
                .then(response => {
                    this.success  = "Payment Info Updated"
                    document.getElementById('success').scrollIntoView()
                })
                .catch(error => {
                    console.log(error)
                })
            },
        }
    }
</script>
