<template>
    <div class="contacts-list">
        <ul>
            <li v-for="contact in sortedContacts" :key="contact.id" @click="selectContact(contact)" :class="{ 'selected': contact.id == selectedContact.id }">
                <div class="avatar">
                    <img :src="url + '/img/male.jpg'" :alt="contact.name">
                </div>
                <div class="contact">
                    <p class="name">{{ contact.name }}</p>
                </div>
                <span class="unread" v-if="contact.unread">{{ contact.unread }}</span>
            </li>
        </ul>
    </div>
</template>

<script>
import { type } from 'os'
    export default {
        props: {
            selectedContact: {
                type: Object
            },
            contacts: {
                type: Array,
                default: [],
            },
            url: {
                type: String
            }
        },
        data() {
            return {
                selected: this.contacts[0]
            };
        },
        methods: {
            selectContact(contact) {
                this.selected = contact;

                this.$emit('selected', contact);
            }
        },
        computed: {
            sortedContacts() {
                return _.sortBy(this.contacts, [(contact) => {
                    if (contact == this.selected) {
                        return Infinity;
                    }

                    return contact.unread;
                }]).reverse();
            }
        },
       
    }
</script>

<style lang="scss" scoped>
@media screen and ( max-width: 768px )
{
    .contacts-list{
        overflow-x: scroll;
        box-shadow: 0 0 4px 0 #00000030;
        background: #fff;

        ul {
            display: flex;
            list-style: none;
            margin: 0;
            padding: 0;
            li{
                display: flex;
                flex-direction: column;
                padding: 5px 20px;
                text-align: center;
                justify-content: center;
                align-items: center;
                .avatar {
                    width: 40px;
                    height: 40px;
                    border-radius: 50%;
                    overflow: hidden;

                    img {
                        max-width: 100%;
                    }
                }
                .contact {
                    font-size: 14px;
                    font-weight: bold;

                    p {
                        margin: 0;

                        &.name {
                            font-weight: bold;
                            white-space: nowrap;
                            overflow: hidden;
                            text-overflow: ellipsis;
                            max-width: 80px;
                        }
                    }
                }
                &.selected {
                    background: #52a121;
                    color: #fff;
                }
                span.unread {
                    background: #82e0a8;
                    color: #fff;
                    position: absolute;
                    right: 11px;
                    top: 20px;
                    display: flex;
                    font-weight: 700;
                    min-width: 20px;
                    justify-content: center;
                    align-items: center;
                    line-height: 20px;
                    font-size: 12px;
                    padding: 0 4px;
                    border-radius: 3px;
                }
            }
        }
    }

}
@media screen and ( min-width: 769px )
{
    .contacts-list {
        flex: 2;
        max-height: 100%;
        height: 600px;
        overflow: scroll;
        border-left: 1px solid #a6a6a6;
        
        ul {
            list-style-type: none;
            padding-left: 0;

            li {
                display: flex;
                padding: 2px;
                border-bottom: 1px solid #aaaaaa;
                height: 80px;
                position: relative;
                cursor: pointer;

                &.selected {
                    background: #dfdfdf;
                }

                span.unread {
                    background: #82e0a8;
                    color: #fff;
                    position: absolute;
                    right: 11px;
                    top: 20px;
                    display: flex;
                    font-weight: 700;
                    min-width: 20px;
                    justify-content: center;
                    align-items: center;
                    line-height: 20px;
                    font-size: 12px;
                    padding: 0 4px;
                    border-radius: 3px;
                }

                .avatar {
                    flex: 1;
                    display: flex;
                    align-items: center;

                    img {
                        width: 35px;
                        border-radius: 50%;
                        margin: 0 auto;
                    }
                }

                .contact {
                    flex: 3;
                    font-size: 10px;
                    overflow: hidden;
                    display: flex;
                    flex-direction: column;
                    justify-content: center;

                    p {
                        margin: 0;

                        &.name {
                            font-weight: bold;
                        }
                    }
                }
            }
        }
    }
}
</style>
