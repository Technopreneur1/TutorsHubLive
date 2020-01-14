<template>
     <div class="slideout">
         <div class="cont">
            <span id="success" @click="$emit('cancel')" class="btn-cancel"><i class="fas fa-long-arrow-alt-left"></i></span>
            <transition  name="easy-appear" enter-active-class="animated bounce" leave-active-class="animated fadeOut">
                <div v-if="success" class="input success"><span>{{success}}</span></div>
            </transition>
            <div class="text">
                Please provide either Paypal or Bank account details to recive your payments on time.
            </div>
            <div class="input">
                <label for="">Paypal account address (email) </label>
                <input type="email" v-model="paypal" id="" cols="30" rows="3">
            </div>
            <div class="newrow" style="border-top: 1px dotted #fff"><span style="background: #52aba9; color: #fff">OR</span></div>
            <div class="input">
                <label for="">Bank Account Details (Please enter all the necessary information)</label>
                <textarea v-model="bank"  cols="30" rows="6" placeholder="Bank Details"></textarea>
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
        .text
            text-align: center
            font-size: 18px
            border-bottom: 1px solid #e4f3e4
            margin-bottom: 15px
            padding-bottom: 5px
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
                paypal: this.user.profile.paypal,
                bank: this.user.profile.payment
           }
        },
        computed: {
            isReady()
            {
                if(this.paypal != this.user.profile.paypal || this.bank != this.user.profile.payment)
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
                    paypal: this.paypal,
                    payment: this.bank,
                })
                .then(response => {
                    this.success  = "Payment Info Updated"
                    this.$store.commit('setPaypal', this.paypal)
                    this.$store.commit('setBank', this.bank)
                    document.getElementById('success').scrollIntoView()
                })
                .catch(error => {
                    console.log(error)
                })
            },
        }
    }
</script>
