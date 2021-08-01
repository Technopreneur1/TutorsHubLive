<template>
    <div class="conversation">
        <div v-if="failed" class="err"><div class="sg">
            <h2>Unable To Send Message!</h2>
            <h3>User is temporarily unavailable</h3>
            <button @click="failed  = false" class="btn btn-con">Ok</button>
        </div></div>
        <h1 v-if="contact">
            <a :href="url+'/user/'+contact.id">{{contact.name}}</a>
        </h1>
        <h1 v-else>
            Select a contact
        </h1>
        <MessagesFeed
            :adminsettings="adminsettings ? adminsettings : ''"
            :allowancesettings="allowancesettings ? allowancesettings : ''"
            :contact="contact"
            :messages="messages"/>
        <MessageComposer @send="sendMessage"/>
    </div>
</template>
<style lang="sass" scoped>
    .err
        position: fixed
        background: #00000075
        top: 0
        left: 0
        right: 0
        bottom: 0
        z-index: 1
        display: flex
        -webkit-box-pack: center
        justify-content: center
        -webkit-box-align: center
        align-items: center
        color: #fff
        font-size: 25px
        .sg
            width: 400px
            padding: 15px 20px
            max-width: 95%
            background: #e4f3e4
            color: #000
            border-radius: 5px
            font-size: 20px
            text-align: center
        h2
            font-size: 22px
            color: red
            font-weight: bold
        h3
            font-size: 18px
            color: #000
        .btn-con
            padding: 3px 20px
            background: #2575bc
            font-weight: bold
            color: #fff
            font-size: 17px


</style>

<script>
    import MessagesFeed from './MessagesFeed'
    import MessageComposer from './MessageComposer'

    export default {
        props: {
            url: {
                type: String
            },
            contact: {
                type: Object,
                default: null
            },
            messages: {
                type: Array,
                default: []
            },
            adminsettings: {
                type: Object
            },
            allowancesettings: {
                type: [Object, String],
                default: ""

            }
        },
        data(){
            return {
                failed: false
            }
        },
        methods: {
            sendMessage(text) {
                if (!this.contact) {
                    return;
                }

                axios.post('/conversation/send', {
                    contact_id: this.contact.id,
                    text: text
                }).then((response) => {
                    if(response.data.err)
                    {
                        this.failed = true
                        return false
                    }
                    this.$emit('new', response.data);
                })
            }
        },
        components: {MessagesFeed, MessageComposer}
    }
</script>

<style lang="scss" scoped>
@media screen and ( max-width: 768px )
{
    .conversation {
        background: #ffffff;

        h1 {
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            padding: 10px 0 10px;
            background: #2575bc;
            color: #fff;
            a{
                color: #fff;
            }
        }
    }
}
@media screen and ( min-width: 769px )
{
        .conversation {
            flex: 5;
            display: flex;
            flex-direction: column;
            justify-content: space-between;

            h1 {
                font-size: 20px;
                background: #2575bc;
                color: #ffffff;
                padding: 10px;
                margin: 0;
                border-bottom: 1px dashed lightgray;
                a{
                    color: #ffffff;
                }
            }
        }
}
</style>
