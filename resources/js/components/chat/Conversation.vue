<template>
    <div class="conversation">
        <h1 v-if="contact">
            <a :href="url+'/user/'+contact.id">{{contact.name}}</a>
        </h1>
        <h1 v-else>
            Select a contact
        </h1>
        <MessagesFeed :contact="contact" :messages="messages"/>
        <MessageComposer @send="sendMessage"/>
    </div>
</template>

<script>
    import MessagesFeed from './MessagesFeed';
    import MessageComposer from './MessageComposer';

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
            background: #52a121;
            color: #fff;
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
