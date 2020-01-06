<template>
   <div class="full-container">
       <full-loader v-if="loading" ></full-loader>
       <div class="title">My Payment Info <span>Edit <i class="fas fa-pencil"></i></span></div>
       <div class="payment-info-box">
           Paypal: abcdef@ghi.com
       </div>
       <div class="title">Earnings</div>
       <div class="earnings-row">
           <div class="ecol">
                <div class="cdata">
                    <div class="key">Gross Total</div>
                    <div class="value">$1000</div>
                </div>    
           </div>
           <div class="ecol">
                <div class="cdata">
                    <div class="key">Net Earning</div>
                    <div class="value">$1000</div>
                </div>    
           </div>
           <div class="ecol">
                <div class="cdata">
                    <div class="key">Total Withdrawn</div>
                    <div class="value">$500</div>
                </div>
           </div>
           <div class="ecol">
                <div class="cdata">
                    <div class="key">Total Available</div>
                    <div class="value">$500</div>
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
                <tr>
                    <td>21 January 2018</td>
                    <th style="color: red">$400</th>
                    <td><button class="btn btn-blue"><i class="fa fa-download"></i></button></td>
                </tr>
                <tr>
                    <td>21 January 2018</td>
                    <th style="color: red">$400</th>
                    <td><button class="btn btn-blue"><i class="fa fa-download"></i></button></td>
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
        },
        data()
        {
           return{
                loading: false,
           }
        },
        methods: {
         
        },
        mounted()
        {
           
        }
    }
</script>
