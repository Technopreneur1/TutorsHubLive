<template>
    <div class="profile-page">
         <full-loader v-if="loading" ></full-loader>
         <transition  name="easy-appear" enter-active-class="animated slideInLeft" leave-active-class="animated slideOutLeft">
            <!-- <start-chat v-if="chatWith = id" :url="url" :to="chatWith = id" @cancelChat="chatWith = id = null"></start-chat> -->
             <start-chat v-if="chatWith" :url="url" :to="chatWith" @cancelChat="chatWith = null"></start-chat>
         </transition>
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
                    <button class="btn btn-crop" @click="reset()" style="margin-right: 10px">Cancel</button>
                    <button class="btn btn-crop" @click="crop">Crop &amp; Continue</button>
                </div>
                <div class="imgu" v-else>
                    <img :src="image" alt="">
                    <button v-if="!loading" @click="uploadAvatar()" class="btn btn-crop ">Save &amp; Continue</button>
                    <button v-else class="btn btn-crop ">Please Wait .. <i class="fas fa-spinner fa-spin"></i></button>
                </div>
            </div>
        </transition>
        <div class="full-container">
            <div class="wr">
                <div v-if="isUser" @click="editing = true" class="editprofilebtn">Edit Profile</div>
                <div class="who">
                    <div @click="selectAvatar()" class="avatar">
                        <div v-if="isUser" class="overlay"><i class="fas fa-camera"></i></div>
                        <img :src="avatar" alt="">
                        <input style="display: none" id="avatarInput" type="file" @change="avatarSelected">
                    </div>
                    <div class="namenrole">
                        <div v-if="!isUser" class="name">{{firstname(user.name)}}</div>
                        <div v-else class="name">{{user.name}}</div>
                        <div class="role">{{user.type == 'teacher' ? 'Tutor' : user.type}} {{user.gender ? ' | ' + user.gender : ''}}</div>
                        <div class="rating">
                        <i class="fas fa-star"></i><span> {{rating}} / 5</span> 
                        </div>
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
            <div class="actions-bar">
                <div v-if="!isUser" @click="addToFav()" class="fav">
                    <button  @click="addToFav()" v-if="is_fav"><i class="fas fa-heart"></i> Remove</button>
                    <button  v-else><i class="far fa-heart"></i> Save Profile</button>
                </div>
                <div  v-if="!isUser && user.can_contact" class="msg">
                    <button @click="contact(user.id)" class="btn"><i class="fas fa-comment"></i> Message</button>
                </div>
            </div>
           
            <div v-if="user.profile.bio" class="bio">
                {{outputBio(user.profile.bio)}}
            </div>
            
            <div v-if="user.type == 'teacher'" class="plans-section">
                <div class="newrow" style="background: #fff"><span>My Plans</span></div>
                <plans v-if="user.profile.plans.length" :url="url" :plans="user.profile.plans" :authuser="authuser"  @book="bookNow" :user="user"></plans>   
                <div class="text-center" v-else >No Plan Available. <span v-if="!isUser"> please contact the tutor</span></div>
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
                    <span v-if="user.profile && !user.profile.can_contact" class="val"><i class="fas fa-check"></i></span>
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

            <div class="reviews-section">
                <div class="title">Reviews</div>
                <div v-if="!user.profile.completed_sessions.length" class="nothing">No Reviews</div>
                <div  v-for="session in user.profile.completed_sessions" :key="session.id"  class="review">
                    <a :href="url+ '/user/' + session.student.user.id" v-if="user.type == 'teacher'" class="avatar">
                        <img :src="avatarF(session.student.user)" alt="">
                        <div class="name">{{session.student.user.name}}</div>
                    </a>
                    <a :href="url+ '/user/' + session.teacher.user.id" v-if="user.type == 'student'" class="avatar">
                        <img :src="avatarF(session.teacher.user.name)" alt="">
                        <div class="name">{{session.teacher.user.name}}</div>
                    </a>
                    <div v-if="user.type == 'student'" class="rating">
                        <i class="far fa-star" :class="{fas: session.student_rating >= 1}"></i>
                        <i class="far fa-star" :class="{fas: session.student_rating >= 2}"></i>
                        <i class="far fa-star" :class="{fas: session.student_rating >= 3}"></i>
                        <i class="far fa-star" :class="{fas: session.student_rating >= 4}"></i>
                        <i class="far fa-star" :class="{fas: session.student_rating >= 5}"></i>
                    </div>
                    <div v-if="user.type == 'teacher'" class="rating">
                        <i class="far fa-star" :class="{fas: session.tutor_rating >= 1}"></i>
                        <i class="far fa-star" :class="{fas: session.tutor_rating >= 2}"></i>
                        <i class="far fa-star" :class="{fas: session.tutor_rating >= 3}"></i>
                        <i class="far fa-star" :class="{fas: session.tutor_rating >= 4}"></i>
                        <i class="far fa-star" :class="{fas: session.tutor_rating >= 5}"></i>
                    </div>
                    <div v-if="user.type == 'student'" class="feedback">
                        <p>{{session.student_review}}</p>
                    </div>
                    <div v-if="user.type == 'teacher'" class="feedback">
                        <p>{{session.tutor_review}}</p>
                    </div>
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
            rating: {
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
               books: [],
               openForm: '',
               chatWith: null,
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
            
            type()
            {
                if(this.user.type == 'teacher')
                {
                    return 'tutor'
                }
                if(this.user.type == 'student')
                {
                    return 'student'
                }
            },
            avatar()
            {
                if(!this.image)
                {
                    if(this.user.avatar){
                        return this.url + '/storage/images/' + this.user.avatar
                    }else{
                        if(this.user.gender)
                        {
                            return this.url + '/img/' + this.user.gender.toLowerCase() + '.jpg'
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
            outputBio(message)
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
            extractPhones (text)
            {
                return text.match(/(((\d{2})(\s)){4}(\d){2})|(\((\d){4}\)(\s)(\d){6})/g);
            },
            firstname(name){
                return name.split(" ")[0]
            },
            reset()
            {
                this.editAvatar = false
                this.img = null
                this.image = null
                document.getElementById("avatarInput").click()
            },
             avatarF(user)
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
            contact(id)
            {
                    this.loading = true
                    axios.post(this.url +'/check/hasConversation', {
                        id: id
                    })
                    .then(response => {
                        this.loading = false
                        if(response.data.has)
                        {
                            window.location = this.url + "/messages?u=" + id;
                        }else{
                            this.chatWith = id
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    })
            },
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
<style lang="sass">
.reviews-section
    .title
        font-size: 30px
        color: #2575bc
        text-align: center
.review
    border-bottom: 1px solid #00000012
    margin-bottom: 20px
    .rating
        i
            color: #e76a36
            font-size: 18px
    .avatar
        display: flex
        align-items: center
        font-weight: bold
        font-size: 14px
        margin-bottom: 8px
        img
            width: 40px
            border-radius: 50%
            margin-right: 10px
</style>