<template>
    <div class="feed" ref="feed">
        <ul v-if="contact">
            <li v-for="message in messages" :class="`message${message.to == contact.id ? ' sent' : ' received'}`" :key="message.id">
                <div @click="toggleTime(message.id)" class="text">
                    {{ message.text }}
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

