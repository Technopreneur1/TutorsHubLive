<template>
    <div class="contacts-list">
        <ul>
            <li v-for="contact in sortedContacts" :key="contact.id" @click="selectContact(contact)" :class="{ 'selected': contact.id == selectedContact.id }">
                <div class="avatar">
                    <img :src="avatar(contact)" :alt="contact.name">
                </div>
                <div class="contact">
                    <p class="name">{{ contact.name }}  <span v-if="contact.verified" class="verified"><i class="fas fa-check"></i></span></p>
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
            avatar(user)
            {
                if(user.avatar){
                    return this.url + '/storage/images/' + user.avatar
                }else{
                if(user.gender)
                {
                    return this.url + '/img/' + user.gender.toLowerCase() + '.jpg'
                }else{
                    return this.url + '/img/male.jpg'
                }
                }
            },
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
                    background: #2575bc;
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
        background: #e4f3e4;
        max-height: 100%;
        height: 600px;
        overflow: scroll;
        border-left: 1px solid #e4f3e4;
        
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
                    background: #2575bc;
                    .name{
                        color: #ffffff !important
                    }
                }

                span.unread {
                    background: #fa1515;
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
                            font-size: 17px;
                            font-weight: bold;
                            color: #000;
                        }
                    }
                }
            }
        }
    }
}
</style>
