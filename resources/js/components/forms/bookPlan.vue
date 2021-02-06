<template>
    <div class="edit-profile-slideout full">
        <full-loader v-if="loading" ></full-loader>
        <span id="success" @click="$emit('cancel')" class="btn-cancel"><i class="fas fa-long-arrow-alt-left"></i></span>
        <!-- <transition  name="easy-appear" enter-active-class="animated slideInLeft" leave-active-class="animated slideOutLeft"> -->
        <div v-if="showThanks" class="showThanks">
            <div class="thnaku">Thanks</div>
            <div class="pleaced">Your session has successfuly been requested with <a :href="url+ '/user/' + user.id">{{user.name}}</a></div>
            <div class="adv">You can <a :href="url + '/messages?u=' + user.id">message</a> {{user.name}} for more details.</div>
            <div class="links">
                <div class="gradient-btn"><a :href="url"><i class="fas fa-Home"></i> Back To Home</a></div>
            </div>
        </div>
        <div v-else class="book-section">
            <div class="bookingform">
                <div class="heading">Book Session</div>
                <div class="info">
                    <table>
                        <tr>
                            <td>Subject: </td>
                            <td>{{plan.discipline.name}}</td>
                        </tr>
                        <tr>
                            <td>Level: </td>
                            <td>{{plan.level.name}}</td>
                        </tr>
                        <tr>
                            <td>Hourly Rate: </td>
                            <td>${{plan.rate}} {{currency}}</td>
                        </tr>
                    </table>
                </div>
                <div class="hours">
                    <div class="input">
                        <label for="">Select Hours</label>
                        <select v-model="hours">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                        </select>
                    </div>
                </div>
                <div class="dte">
                    <div class="input">
                        <label for="">Select Date & Time</label>
                        <datetime type="datetime" v-model="dte" format="yyyy-MM-dd HH:mm:ss"></datetime>

                    </div>
                </div>
                <div class="sessiontype">
                    <div class="input">
                        <label for="">Select Type</label>
                        <select v-model="sessiontype">Please Pay to confirm this Session
                            <option value="Online">Online</option>
                            <option value="In Person">In Person</option>

                        </select>
                    </div>
                </div>
                <div class="total"> <span class="name">= </span> <span>${{total}} <small>{{currency}}</small></span></div>
                <div v-show="!loading" class="btns" style="width: 300px; max-with: 90%; margin: 0 auto">
<!--                              <div  ref="paypal"></div>-->
                    <div v-if="error" class="error">{{error}}</div>

                    <button @click="requestSession()" class="btn-book">Request Session</button>

                </div>
            </div>

        </div>
    </div>
</template>
<style lang="sass" scoped>
    .btn-book
        border: none
        width: 125px
        background: #2575bc
        color: #ffffff
        border-radius: 4px
        .showThanks
            padding: 10px
            text-align: center
            .thnaku
                font-size: 35px
            .pleaced
                font-size: 22px
            .adv
                font-size: 14px
            .links
                display: flex
                justify-content: center
                padding: 20px 0
                .btn-opt
                    background: red
                    color: #fff

        .book-section
            display: flex
            justify-content: center


            .bookingform
                width: 500px
                max-width: 100%
                .heading
                    margin-bottom: 20px
                    font-size: 25px
                    text-align: center
                    font-weight: bold
                .info
                    table
                        background: #fdfdfd
                        width: 100%
                        tr
                            td
                                padding: 5px 15px
                .hours,.dte, .sessiontype
                    margin: 20px 0 10px
                    text-align: center
                    .input
                        max-width: 300px
                        margin: 0 auto
                .total
                    font-size: 40px
                    font-weight: bold
                    text-align: center
                    display: flex
                    flex-direction: column
                    align-items: center
                    justify-content: center
                    .name
                        margin-bottom: -10px
                        font-size: 47px
                        font-weight: bold
                        line-height: 26px


</style>

<script>
    export default {
        props: {
            plan: {
                type: Object
            },
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
                loading: false,
                showThanks: false,
                success: '',
                hours: 1,
                sessiontype:'Online',
                loaded: false,
                paidFor: false,
                product: {
                    price: 777.77
                },

            }
        },
        computed: {
            currency()
            {

                if (this.user.currency) {
                    return this.user.currency;
                }else {
                    return "USD";

                }
                // if(this.user.country.name == "United States")
                // {
                //     return "USD";
                // }
                // else if(this.user.country.name == "Canada")
                // {
                //     return "CAD";
                // }
            },
            total()
            {
                return this.plan.rate * this.hours
            }
        },
        methods: {
            setLoaded: function() {

                this.loaded = true;
                console.log(window.paypal)
                let vob = this
                window.paypal.Buttons({
                    createOrder: (data, actions) => {
                        return actions.order.create({

                            purchase_units: [
                                {
                                    amount: {
                                        currency_code: this.currency,
                                        value: this.total
                                    }
                                }
                            ],
                            application_context: {
                                shipping_preference: 'NO_SHIPPING'
                            }
                        })
                    },
                    onApprove: function(data, actions) {
                        vob.loading = true
                        // This function captures the funds from the transaction.
                        return actions.order.capture().then(function(details) {

                            axios.post(vob.url +'/complete/booking',
                                {
                                    data: data,
                                    subject: vob.plan.discipline.name,
                                    level: vob.plan.level.name,
                                    rate: vob.plan.rate,
                                    hours: vob.hours,
                                    total: vob.total,
                                    teacher: vob.user.profile.id,
                                })
                                .then(response => {
                                    vob.showThanks = true;
                                    vob.loading = false
                                })
                                .catch(error => {
                                    console.log(error);
                                })
                        });
                        // This function shows a transaction success message to your buyer.

                        // });
                    },
                    style: {
                        layout:  'vertical',
                        color:   'blue',
                        shape:   'rect',
                        label:   'paypal'
                    }
                }).render(this.$refs.paypal)
            },
            requestSession(){
                if (!this.dte) {
                    this.error = "Please select your preferred date & time"
                    return false
                }
                this.loading = true;
                axios.post(this.url +'/complete/sessionrequest',
                    {
                        subject: this.plan.discipline.name,
                        level: this.plan.level.name,
                        rate: this.plan.rate,
                        hours: this.hours,
                        date: this.dte,
                        sessiontype: this.sessiontype,
                        total: this.total,
                        teacher: this.user.profile.id,
                    })
                    .then(response => {
                        this.showThanks = true;
                        this.loading = false
                    })
                    .catch(error => {
                        console.log(error);
                    })

            },
            post(data)
            {

            },
        },
        mounted()
        {
            const script = document.createElement("script");
            script.src = "https://www.paypal.com/sdk/js?client-id=AU1qSrl-VvM9r15F6lhSITnPRtJvJwFJfd__J5cMP8FvpXCDcEloTOysg8exK1DZN8rMCsgBXCOUbPFd&currency=" + this.currency;
            script.addEventListener("load", this.setLoaded);
            document.body.appendChild(script);
        }
    }
</script>
