<template>
    <div class="profile-page">
         <full-loader v-if="loading" ></full-loader>
        <transition name="easy-appear" enter-active-class="animated slideInLeft" leave-active-class="animated slideOutLeft">
            <edit-profile v-if="editing" @cancel="editing = false" :url="url" :user="user"></edit-profile>
        </transition>
        <transition name="easy-appear" enter-active-class="animated slideInLeft" leave-active-class="animated slideOutLeft">
            <book-plan v-if="bookPlan" @cancel="bookPlan = null" :url="url" :user="user" :plan="bookPlan"></book-plan>
        </transition>
        <transition name="easy-appear" enter-active-class="animated slideInLeft" leave-active-class="animated slideOutLeft">
            <div v-if="editAvatar" class="cropbox">
                <div class="title">Update Profile Picture</div>
                <div v-if="!cropped" class="canv">
                    <cropper 
                        classname="cropper"
                        :src="img"
                        :stencil-props="{
                            aspectRatio: 1/1
                        }"
                        @change="change"
                        ref="cropper"
                    ></cropper>
                    <button class="btn btn-crop" @click="crop">Crop &amp; Continue</button>
                </div>
                <div class="imgu" v-else>
                    <img :src="image" alt="">
                    <button @click="uploadAvatar()" class="btn btn-crop">Save &amp; Continue</button>
                </div>
            </div>
        </transition>
        <div class="full-container">
            <div class="wr">
                <div v-if="isUser" @click="editing = true" class="editprofilebtn">Edit Profile</div>
                <span v-if="!isUser" @click="addToFav()" class="favbtn"><i  :class="[is_fav ? 'fas' : 'far']" class="fa-heart"></i></span>
                <div class="who">
                    <div @click="selectAvatar()" class="avatar">
                        <div v-if="isUser" class="overlay"><i class="fas fa-camera"></i></div>
                        <img :src="avatar" alt="">
                        <input style="display: none" id="avatarInput" type="file" @change="avatarSelected">
                    </div>
                    <div class="namenrole">
                        <div class="name">{{user.name}}</div>
                        <div class="role">{{user.type == 'teacher' ? 'Tutor' : user.type}} {{user.gender ? ' | ' + user.gender : ''}}</div>
                    </div>
                </div>
                <div class="location">
                    <span class="icon"><i class="fas fa-map-marker-alt"></i></span>
                    {{user.neighborhood ?user.neighborhood.name + ', ': ''}}
                    {{user.city ?user.city.name + ', ': ''}}
                    {{user.state ?user.state.name + ', ': ''}}
                    {{user.country ?user.country.name: ''}}
                </div>
            </div>
           
            <div v-if="user.profile.bio" class="bio">
                {{user.profile.bio}}
            </div>
            
            <div v-if="user.type == 'teacher'" class="plans-section">
                <div class="newrow" style="background: #fff"><span>Book a Session</span></div>
                <plans v-if="user.profile.plans.length" :url="url" :plans="user.profile.plans" :authuser="authuser"  @book="bookNow" :user="user"></plans>   
                <div v-else class="newrow" style="background: #fff">No Plan Available. <span v-if="!isUser"> please contact the tutor</span></div>
            </div>

            <div v-if="isUser" class="newrow">
                <span style="font-weight: bold">Profile Details</span>
            </div>
            <div v-if="isUser" class="details">
                <div class="info">
                    <span class="key">Email: </span>
                    <span class="value">{{user.email}}</span>
                    <span class="privacy"><i class="fas fa-lock"></i></span>
                </div>
                <div class="info">
                    <span class="key">Phone: </span>
                    <span class="value">{{user.phone}}</span>
                    <span class="privacy"><i class="fas fa-lock"></i></span>
                </div>
                <div class="info">
                    <span class="key">Gender: </span>
                    <span class="value">{{user.gender}}</span>
                    <span class="privacy"><i class="fas fa-unlock-alt"></i></span>
                </div>
                <div class="info">
                    <span class="key">Gender Preference: </span>
                    <span class="value">{{user.profile && user.profile.gender_preference ? user.profile.gender_preference : 'None'}}</span>
                    <span class="privacy"><i class="fas fa-unlock-alt"></i></span>
                </div>
                <div v-if="user.type == 'student'" class="info">
                    <span class="key">Level: </span>
                    <span class="value">{{user.profile && user.profile.level ?  user.profile.level.name: ''}}</span>
                    <span class="privacy"><i class="fas fa-unlock-alt"></i></span>
                </div>
                <div  v-if="user.type == 'student'" class="info">
                    <span class="key">Subject: </span>
                    <span class="value">{{user.profile && user.profile.discipline ?  user.profile.discipline.name: ''}}</span>
                    <span class="privacy"><i class="fas fa-unlock-alt"></i></span>
                </div>
            </div>
            <div v-if="isUser" class="newrow">
                <span style="font-weight: bold">Privacy Settings</span>
            </div>
            <div v-if="isUser" class="privacy-settings">
                <div class="option">
                    <span class="key">{{user.type == 'teacher' ? "Student" : "Tutor"}} can contact me</span>
                    <span v-if="user.profile && user.profile.can_contact" class="val"><i class="fas fa-check"></i></span>
                    <span v-else class="nval"><i class="fas fa-times"></i></span>
                </div>
                <div class="option">
                    <span class="key">Hidden Profile</span>
                    <span v-if="!user.is_hidden" class="val"><i class="fas fa-times"></i></span>
                    <span v-else class="nval"><i class="fas fa-check"></i></span>
                </div>
                <div class="option">
                    <span @click="deleteProfile()" class="key del">Delete Profile</span>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { type } from 'os'
    export default {
        // props: ['url', {user}],
        props: {
            authuser: {
                type: Object
            },
            url: {
                type: String
            },
            user: {
                type: Object
            },
            likes: {
                type: Number
            }
        },
        data()
        {
           return{
               loading: false,
               cropped: false,
               editAvatar: false,
               is_fav: this.likes,
               editing: false,
               openForm: '',
               books: [],
               img: null,
               bookPlan: null,
               coordinates: {
                    width: 0,
                    height: 0,
                    left: 0,
                    top: 0
                },
            image: null

            //    user: {}
           }
        },
        computed: {
            
            avatar()
            {
                if(!this.image)
                {
                    if(this.user.avatar){
                        return this.url + '/storage/images/' + this.user.avatar
                    }else{
                        if(this.user.gender)
                        {
                            return this.url + '/img/' + this.user.gender + '.jpg'
                        }else{
                            return this.url + '/img/male.jpg'
                        }
                    }
                }else{
                    return this.image
                }
            },
            isUser()
            {
                if(this.authuser.id == this.user.id)
                {
                    return true
                }else{
                    return false
                }
            }
        },
        methods: {
            selectAvatar()
            {
                this.image = null
                document.getElementById("avatarInput").click();
            },
            avatarSelected(e)
            {
                let file = e.target.files[0]
                this.img = URL.createObjectURL(file)
                this.editAvatar = true
            },
            uploadAvatar()
            {
                this.loading = true
                axios.post(this.url +'/post/avatar', {
                    image: this.image
                })
                .then(response => {
                    this.editAvatar = false
                    this.loading = false
                    this.image.avatar = response.data.avatar
                })
                .catch(error => {
                    console.log(error);
                })
            },
            crop(){
                this.cropped = true
            },
            change({coordinates, canvas}) {
            console.log(coordinates, canvas)
            this.image = canvas.toDataURL()
		    },
            addToFav()
            {
                this.loading = true
                axios.post(this.url +'/post/favorite', {
                    id: this.user.id
                })
                .then(response => {
                    if(response.data.status == 'liked')
                    {
                        this.is_fav = true
                    }else{
                        this.is_fav = false
                    }
                    this.loading = false
                })
                .catch(error => {
                    console.log(error);
                })
            },
            bookNow(plan)
            {
                this.bookPlan = plan
            },
            editPlan(){
                this.editing = true
            },
        //    getUserInfo(){
        //         axios.post(this.url +'/get/userinfo')
        //         .then(response => {
        //             console.log(response)
        //             this.user = response.data.user
                    
        //         })
        //         .catch(error => {
        //             console.log(error);
        //         })
        //     },
            deleteProfile()
            {
                alert("You will able to delete profile when website is public")
            }
        },
        
        mounted()
        {
            // this.getUserInfo()
                
        },
    }
</script>
