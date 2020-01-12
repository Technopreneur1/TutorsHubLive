<template>
   <div class="full-container">
       <transition name="easy-appear" enter-active-class="animated slideInLeft" leave-active-class="animated slideOutLeft">
            <edit-payment v-if="editPayment" @cancel="editPayment = false" :url="url" :user="authuser"></edit-payment>
        </transition>
       <full-loader v-if="loading" ></full-loader>
       <div class="title">My Payment Info <span @click="editPayment = true">Edit <i class="fas fa-pencil"></i></span></div>
       <div class="payment-info-box">
           <div v-if="authuser.profile.paypal" class="paypal">
               <span>Paypal: &nbsp;</span>
               {{authuser.profile.paypal}}
           </div>
           <div v-if="authuser.profile.payment" class="payment">
               <span>Bank: &nbsp; &nbsp;</span>
               {{authuser.profile.payment}}
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
       <div class="title">Payments</div>
       <div class="table-responsive">
            <table class="table table-sm">
                <tr>
                    <th>Date</th>
                    <th>Total Amount</th>
                    <th>Proff</th>
                </tr>
                <tr v-for="payment in payments" :key="payment.id">
                    <td>{{payment.created_at | moment("dddd, MMMM Do YYYY") }}</td>
                    <th style="color: red">${{payment.amount}}</th>
                    <td><a v-if="payment.proff" :href="url + '/storage/proffs/' + payment/proff"  class="btn btn-blue"><i class="fa fa-download"></i></a></td>
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
        data()
        {
           return{
                loading: false,
                editPayment: false
           }
        },
        methods: {
         
        },
        mounted()
        {
           
        }
    }
</script>
