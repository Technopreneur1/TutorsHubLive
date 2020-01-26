<template>
    <div class="feed" ref="feed">
        <ul v-if="contact">
            <li v-for="message in messages" :class="`message${message.to == contact.id ? ' sent' : ' received'}`" :key="message.id">
                <div @click="toggleTime(message.id)" class="text">
                    <!-- {{ message.text }} -->
                    {{ outputMessage(message.text) }}
                </div>
                <div v-if="showTime == message.id"  class="time animated fadeIn">{{ message.created_at | moment("calendar")}}</div>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        props: {
            contact: {
                type: Object
            },
            messages: {
                type: Array,
                required: true
            }
        },
        data(){
            return {
                showTime: null
            }
        },
        methods: {
            // outputMessage(message)
            // {
            //     let msg = message
            //     if(this.checkIfPhoneInString(msg))
            //     {
            //         var re = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im;
                    
            //         let phoneText = []
            //         while(this.checkIfPhoneInString(msg))
            //         {
            //             phoneText = msg.match(re)[0]
            //             msg = msg.replace(phoneText, "*****")
            //             console.log(msg)
            //         }
                    
            //         // return "This message contains email"
            //         // console.log(this.extractEmails(message))
            //     }
            //     if(this.checkIfEmailInString(msg))
            //     {
            //         var re = /(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))/;
            //         let msg = message
            //         let emailText = []
            //         while(this.checkIfEmailInString(msg))
            //         {
            //             emailText = msg.match(re)[0]
            //             msg = msg.replace(emailText, "*****")
            //             console.log(msg)
            //         }
            //         return msg
            //         // return "This message contains email"
            //         // console.log(this.extractEmails(message))
            //     }
            //     return msg
            // },
            outputMessage(message)
            {
            
                    var re = /\b[\+]?[(]?[0-9]{2,6}[)]?[-\s\.]?[-\s\/\.0-9]{3,15}\b/m;;
                    let msg = message
                    let phoneText = []
                    while(this.checkIfPhoneInString(msg))
                    {
                        phoneText = msg.match(re)[0]
                        msg = msg.replace(phoneText, "*****")
                        console.log('bio: ' + msg)
                    }
                    return this.finalBio(msg)
                    
            },
            finalBio(message)
            {
                // if(this.checkIfEmailInString(msg))
                // {
                    var re = /(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))/;
                    let msg = message
                    let emailText = []
                    while(this.checkIfEmailInString(msg))
                    {
                        emailText = msg.match(re)[0]
                        msg = msg.replace(emailText, "*****")
                        console.log(msg)
                    }
                    return msg
                    // return "This message contains email"
                    // console.log(this.extractEmails(message))
                // }
            },
            
            checkIfEmailInString(text)
            {
                var re = /(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))/;
                return re.test(text);
            },
            checkIfPhoneInString(text)
            {
                var re = /\b[\+]?[(]?[0-9]{2,6}[)]?[-\s\.]?[-\s\/\.0-9]{3,15}\b/m;;
                return re.test(text);
            },
            extractEmails (text)
            {
                return text.match(/([a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.[a-zA-Z0-9._-]+)/gi);
            },
            toggleTime(id)
            {
                if(this.showTime == id)
                {
                    this.showTime = null
                }else
                {
                    this.showTime = id
                }
            },
            scrollToBottom() {
                setTimeout(() => {
                    this.$refs.feed.scrollTop = this.$refs.feed.scrollHeight - this.$refs.feed.clientHeight;
                }, 50);
            }
        },
        watch: {
            contact(contact) {
                this.scrollToBottom();
            },
            messages(messages) {
                this.scrollToBottom();
            }
        }
    }
</script>

<style lang="scss" scoped>
.feed {
    background: none;
    height: 100%;
    max-height: 470px;
    overflow: scroll;

    ul {
        list-style-type: none;
        padding: 5px;

        li {
            &.message {
                margin: 10px 0;
                width: 100%;

                .text {
                    max-width: 200px;
                    border-radius: 5px;
                    padding: 5px 12px;
                    display: inline-block;
                }

                &.received {
                    text-align: left;

                    .text {
                        background: #b2b2b2;
                    }
                }

                &.sent {
                    text-align: right;

                    .text {
                            background: #2575bc;
                            color: #fff;
                    }
                }
            }
        }
    }
}
</style>

