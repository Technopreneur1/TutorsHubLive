<template>
   <div class="full-container">
       <!-- <transition name="easy-appear" enter-active-class="animated slideInLeft" leave-active-class="animated slideOutLeft">
            <edit-payment v-if="editPayment" @cancel="editPayment = false" :url="url" :user="authuser"></edit-payment>
        </transition> -->
       <full-loader v-if="loading" ></full-loader>
       <div class="title">My Payment Info</div>
       <div class="payment-info-box">
           <div v-if="authuser.paypal" class="paypal">
               <span>Paypal: &nbsp;</span>
               {{authuser.paypal}}
           </div>
           <div v-if="authuser.bank_name" class="payment">
               <span>Bank Name: &nbsp;</span>
               {{authuser.bank_name}}
           </div>
           <div v-if="authuser.account_number" class="payment">
               <span>Account Number: &nbsp;</span>
               {{authuser.account_number}}
           </div>
           <div v-if="authuser.routing_number" class="payment">
               <span>Routing Number: &nbsp;</span>
               {{authuser.routing_number}}
           </div>

           <div v-if="!authuser.profile.payment && !authuser.profile.paypal" class="paypal">
               No payment account added. Please add your payment deatils.
           </div>

       </div>
       <div class="title">Earnings</div>
       <div class="earnings-row">
           <div class="ecol">
                <div class="cdata">
                    <div class="key">Gross Total</div>
                    <div class="value">${{gross}}</div>
                </div>
           </div>
           <div class="ecol">
                <div class="cdata">
                    <div class="key">Net Earning</div>
                    <div class="value">${{net}}</div>
                </div>
           </div>
           <div class="ecol">
                <div class="cdata">
                    <div class="key">Total Withdrawn</div>
                    <div class="value">${{withdrawn}}</div>
                </div>
           </div>
           <div class="ecol">
                <div class="cdata">
                    <div class="key">Total Available</div>
                    <div class="value">${{balance}}</div>
               </div>
           </div>
       </div>
       <div class="earning-wrapper">
           <div class="title">Available to Withdraw</div>
           <div v-if="bankinfomissing" class="alert alert-danger">Please add bank account details in your profile settings to request payout via bank</div>
           <div class="table-responsive">
               <table class="table table-hover modren-table">
                   <thead>
                   <tr class="tblhead">
                       <th>Status</th>
                       <th>Amount</th>
                       <th class="text-right" >Withdraw</th>
                   </tr>
                   </thead>
                   <tbody>
                   <tr v-if="!balance == 0">
                       <td >Unpaid</td>
                       <td style="color: red">${{balance}}</td>
                       <!-- <td><a :href="url + '/payout'"  class="btn btn-bd" style="min-width: 40px"><i class="fa fa-download"></i></a></td> -->
                        <td class="text-right" v-if="balance > 0">
                            <a :href="url + '/payout'"  class="btn btn-bd" style="min-width: 40px"><i class="fab fa-paypal"></i> Via Paypal</a>
                            <button @click="payoutBank()" class="btn btn-bd" style="min-width: 40px"><i class="fas fa-university"></i> Via Bank</button>
                        </td>
                        <td v-else></td>
                   </tr>
                   
                   </tbody>
               </table>
           </div>
       </div>
       <div class="flexit">
        <div class="title">Payments History</div>
        <a :href="url+ '/export/payments/' + authuser.profile.id" class="btn btn-bd">Export To Excel</a>
       </div>

       <div class="table-responsive">
            <table class="table table-sm">
                <tr>
                    <th>Via</th>
                    <th>Date</th>
                    <th>Total Amount</th>
                    <th>Paypal Transcation ID</th>
                </tr>
                <tr v-for="payment in payments" :key="payment.id">
                    <td v-if="payment.type == 'Paypal'"> <i class="fab fa-paypal"></i> Paypal</td>
                    <td v-else><i class="fas fa-university"></i> Bank</td>
                    <td>{{payment.created_at | moment("dddd, MMMM Do YYYY") }}</td>
                    <th style="color: red">${{payment.amount}}</th>
                    <td v-if="payment.type == 'Paypal'">{{payment.proff}}</td>
                    <td v-else><a :href="url + '/storage/proffs/' + payment.proff"  class="btn btn-bd" download style="min-width: 40px"><i class="fas fa-download"></i></a></td>
                </tr>
               
            </table>
       </div>
   </div>
</template>
<script>
    export default {
        props: {
            url: {
                type: String
            },
            payments: {
                type: Array
            },
            authuser: {
                type: Object
            },
            gross: {
                type: Number
            },
            balance: {
                type: Number
            },
            withdrawn: {
                type: Number
            },
            net: {
                type: Number
            },
        },
        computed: {
            paypal()
            {
                return this.$store.getters.paypal
            },
            bank()
            {
                return this.$store.getters.bank
            },

        },
        data()
        {
           return{
                loading: false,
                editPayment: false,
                bankinfomissing: false
           }
        },
        methods: {
            payoutBank()
            {
                if(!this.authuser.bank_name || !this.authuser.account_number || !this.authuser.routing_number)
                {
                        this.bankinfomissing = true
                }
                else
                {
                    this.loading = true
                    axios.post(this.url +'/post/payout-via-bank')
                    .then(response => {
                        this.loading = false
                        this.$swal({
                            position: 'bottom-end',
                            icon: 'success',
                            title: 'Your Request has successfully been recieved. We will notify you once your payment is sent.',
                            showConfirmButton: false,
                            timer: 2500
                        });
                    })
                    .catch(error => {
                        console.log(error);
                    })

                }
            }
        },  
        created()
        {
            this.$store.commit('setPaypal', this.authuser.profile.paypal)
            this.$store.commit('setBank', this.authuser.profile.payment)
        }
    }
</script>
<style lang="sass" scoped>
    .btn-bd
        border: 1px solid red
        border: 2px solid #2574bc
        border-radius: 20px
        color: #2574bc
    .flexit
        display: flex
        justify-content: space-between
        flex-wrap: wrap
        align-items: center
</style>