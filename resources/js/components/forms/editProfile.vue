<template>
    <div   class="edit-profile-slideout" :class="{full: 'editPlans'}">

        <!-- <transition  name="easy-appear" enter-active-class="animated slideInLeft" leave-active-class="animated slideOutLeft"> -->
        <div v-if="editLocation" class="full-container">
            <edit-location :user='user' @cancel="editLocation = false" :url="url"></edit-location>

        </div>
        <div v-if="editPlans" class="full-container">
            <edit-plans :user='user' @cancel="editPlans = false" :url="url"></edit-plans>
        </div>
        <div v-if="editPassword" class="full-container">
            <change-password :user='user' @cancel="editPassword = false" :url="url"></change-password>
        </div>
        <!-- </transition> -->

        <div v-if="!editPlans && !editLocation && !editPassword" class="full-container">
             <span id="success" v-if="!editLocation && !editPlans" @click="$emit('cancel')" class="btn-cancel"><i class="fas fa-long-arrow-alt-left"></i></span>
            <transition  name="easy-appear" enter-active-class="animated bounce" leave-active-class="animated fadeOut">
                <div v-if="success"  class="input success"><span>{{success}}</span></div>
            </transition>
            <div class="editbtns">
                <button @click="editPlans = true"  v-if="user.type == 'teacher'" class="btn">Manage Plans</button>
                <a :href="url+ '/settings'" class="btn">Change Address</a>
                <button @click="editPassword = true" class="btn">Change Password</button>
                <a :href="url+ '/my-files'" class="btn">Manage Files</a>
            </div>
            <div class="name">
                <div class="input">
                    <label for="">Full Name</label>
                    <input type="text" v-model="user.name" placeholder="Full Name">
                </div>
            </div>
            <div class="field">
                <div class="input">
                    <label for="">Phone</label>
                    <input type="text" v-model="user.phone" placeholder="Phone">
                </div>
            </div>
            <div class="field">



            <div class="field">
                <div class="input">
                    <label for="">Gender</label>
                    <select v-model="user.gender" id="">
                        <option value="">-- Select Gener --</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Prefer Not To Say">Prefer Not To Say</option>
                    </select>
                </div>
            </div>
            <div class="field">
                <div class="input">
                    <label for="">Bio</label>
                    <textarea v-model="user.profile.bio" id="" cols="30" rows="4" placeholder="Bio"></textarea>
                </div>
            </div>
            <div class="field">
                <div class="input">
                    <label for="">Gender Preference</label>
                    <select v-model="user.profile.gender_preference" id="">
                        <option value="">Gender Preference</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Prefer Not To Say">Prefer Not To Say</option>
                    </select>
                </div>
            </div>
             <div class="input">
                <label for="paypal">Paypal Account</label>
                    <input type="text" v-model="user.paypal" placeholder="Paypal email to recieve your payments">
                </div>
            </div>
            <div class="field">

            <div class="input">
                <label for="bank_name">Bank Name</label>
                    <input type="text" v-model="user.bank_name" placeholder="Bank Name">
                </div>
            </div>
            <div class="field">

            <div class="input">
                <label for="paypal">Account Number</label>
                    <input type="text" v-model="user.account_number" placeholder="Bank Account Number">
                </div>
            </div>
            <div class="field">

            <div class="input">
                <label for="routing_number">Routing Number</label>
                    <input type="text" v-model="user.routing_number" placeholder="Routing Number">
                </div>
            </div>
            <div class="field">
                <div class="input">
                    <label for="">{{user.type == 'teacher' ? 'Students' : 'Teachers'}} Can Contact</label>
                    <select v-model="user.can_contact" id="">
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>
            </div>
            <div class="field">
                <div class="input">
                    <label for="">Hide Profile Temporarily</label>
                    <select v-model="user.is_hidden" id="">
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>
            </div>


            <div class="field">
                <div class="input">
                    <button @click="update" class="btn btn-update">Update</button>
                </div>
            </div>

        </div>
    </div>
</template>
<script>
    export default {
        props: ['url', 'user'],
        data()
        {
           return{
               success: '',
               name: '',
               openForm: '',
               books: [],
               editPlans: false,
               editPassword: false,
               editLocation: false,
           }
        },
        methods: {
           update()
            {
                axios.post(this.url +'/update/user',
                {
                    name: this.user.name,
                    phone: this.user.phone,
                    gender: this.user.gender,
                    gender_preference: this.user.profile.gender_preference,
                    can_contact: this.user.can_contact,
                    is_hidden: this.user.is_hidden,
                    paypal: this.user.paypal,
                    bank_name: this.user.bank_name,
                    account_number: this.user.account_number,
                    routing_number: this.user.routing_number,
                    bio: this.user.profile.bio,
                })
                .then(response => {
                    console.log(response)
                    this.success  = "Profile Updated"
                    document.getElementById('success').scrollIntoView();
                })
                .catch(error => {
                    console.log(error);
                })
            },
        },
        mounted()
        {

        }
    }
</script>
