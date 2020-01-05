<template>
    <div class="chat-app">
        <Conversation :url="url"  :contact="selectedContact" :messages="messages" @new="saveNewMessage"/>
        <ContactsList :url="url" :contacts="contacts" :selectedContact="selectedContact" @selected="startConversationWith"/>
    </div>
</template>

<script>
    import Conversation from './Conversation';
    import ContactsList from './ContactsList';

    export default {
        props: {
            url: {
                type: String
            },
            user: {
                type: Object,
                required: true
            },
            with: {
                type: Object
            }
        },
        data() {
            return {
                selectedContact: null,
                messages: [],
                contacts: []
            };
        },
        created() {
            Echo.private(`messages.${this.user.id}`)
                .listen('NewMessage', (e) => {
                    console.log('hmm')
                    this.hanleIncoming(e.message);
                });

            axios.get('/contacts')
                .then((response) => {
                    console.log(response.data)
                    this.contacts = response.data;
                    if(this.with)
                    {
                        this.selectedContact = this.with
                        this.startConversationWith(this.with)
                    }
                    else if(response.data.length)
                    {
                        this.selectedContact = response.data[0]
                        this.startConversationWith(response.data[0])
                    }
                });
        },
        methods: {
            startConversationWith(contact) {
                this.updateUnreadCount(contact, true);

                axios.get(`/conversation/${contact.id}`)
                    .then((response) => {
                        this.messages = response.data;
                        this.selectedContact = contact;
                    })
            },
            saveNewMessage(message) {
                this.messages.push(message);
            },
            hanleIncoming(message) {
                if (this.selectedContact && message.from == this.selectedContact.id) {
                    this.saveNewMessage(message);
                    return;
                }

                this.updateUnreadCount(message.from_contact, false);
            },
            updateUnreadCount(contact, reset) {
                this.contacts = this.contacts.map((single) => {
                    if (single.id !== contact.id) {
                        return single;
                    }

                    if (reset)
                        single.unread = 0;
                    else
                        single.unread += 1;

                    return single;
                })
            }
        },
        components: {Conversation, ContactsList}
    }
</script>


<style lang="scss" scoped>

@media screen and ( max-width: 768px )
{
    .chat-app {
        display: flex;
        flex-direction: column-reverse;
        margin: 0 -15px;
        // padding: 25px 0;
    }
}
@media screen and ( min-width: 769px )
{
    .chat-app {
        display: flex;
        background: #ffffff;
        margin: 30px -15px;

    }
}
</style>
