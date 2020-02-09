<template>
    <div class="full-container" style=" position: relative">
        <a v-if="viewSession" @click="viewSession = null" class="btn-back"><i class="fas fa-long-arrow-alt-left"></i></a>
        <full-loader v-if="loading" ></full-loader>
        <section v-if="viewSession" class="view-session">
            <div class="sess-header">
                <a v-if="authuser.type == 'student'" :href="url + '/user/' + viewSession.teacher.user.id" class="with">
                    <div class="avatar">
                        <img :src="avatar(viewSession.teacher.user)" alt="">
                    </div>
                    <div class="info">
                        <div class="name">{{viewSession.teacher.user.name}}</div>
                        <div class="status">{{viewSession.completed ? 'Completed' : 'Incomplete'}}</div>
                    </div>
                </a>
                <a v-if="authuser.type == 'teacher'" :href="url + '/user/' + viewSession.student.user.id" class="with">
                    <span class="t">With</span>
                    <div class="avatar">
                        <img :src="avatar(viewSession.student.user)" alt="">
                    </div>
                    <div class="info">
                        <div class="name">{{viewSession.student.user.name}}</div>
                    </div>
                </a>
                <div class="sess-info">
                    <div class="status"><span>{{viewSession.completed ? 'Completed' : 'Incomplete'}}</span></div>
                    <span class="dt">{{viewSession.created_at | moment('DD MMM, YYYY')}}</span>
                    <div class="val"><span>{{viewSession.level}}</span></div>
                    <div class="val"><span>{{viewSession.subject}}</span></div>
                </div>
            </div>
             <div class="rates">
                <div class="hours">
                    <span class="key">Hours</span>
                    <span class="value">{{viewSession.hours}}</span>
                </div>
                <div class="hours">
                    <span class="key">Rate</span>
                    <span class="value">${{viewSession.rate}}</span>
                </div>
                <div class="hours">
                    <span class="key">Total</span>
                    <span class="value">${{authuser.type == 'teacher' ? viewSession.total - viewSession.fee : viewSession.total}}</span>
                </div>
            </div>

            <div v-if="authuser.type == 'student' && !viewSession.completed" class="statusbar">
                <span class="val">Incomplete</span>
                <span class="txt">Please mark session as <b>completed</b> after it has taken place</span>
                <button @click="markComplete" class="btn btn-gradientb">Mark as completed</button> &nbsp; OR &nbsp; 
            </div>
            <button v-if="!viewSession.cancel_request && !viewSession.completed" @click="requestCancel" class="btn btn-danger" style="border-radius: 30px">Request To Cancel Session</button>
            
             

            <div v-if="viewSession.completed" class="review-section">
                <div class="heading">Session Reviews</div>
                <div v-if="!hasReviewed" class="add">
                    <p>Rate session {{authuser.type == 'student' ? 'tutor' : 'student'}} out of 5</p>
                    <div class="rating">
                        <i @click="rating = 1" class="far fa-star" :class="{fas: rating >= 1}"></i>
                        <i @click="rating = 2" class="far fa-star" :class="{fas: rating >= 2}"></i>
                        <i @click="rating = 3" class="far fa-star" :class="{fas: rating >= 3}"></i>
                        <i @click="rating = 4" class="far fa-star" :class="{fas: rating >= 4}"></i>
                        <i @click="rating = 5" class="far fa-star" :class="{fas: rating >= 5}"></i>
                    </div>
                    <div class="feedback">
                        <div class="input">
                            <label for="">Write Your Review</label>
                            <textarea v-model="review" cols="30" rows="5" placeholder="Excellent Session..."></textarea>
                        </div>
                    </div>
                    <div class="act">
                        <button @click="postReview()" class="btn btn-gradientb" :disabled="!is_ready || reviewing">Submit Review</button>
                    </div>
                </div>

                
                <div v-if="viewSession.tutor_rating || viewSession.tutor_review" class="review">
                    <div v-if="authuser.type == 'teacher'" class="avatar">
                        <img :src="avatar(viewSession.student.user)" alt="">
                        <div class="name">{{viewSession.student.user.name}}</div>
                    </div>
                    <div v-if="authuser.type == 'student'" class="avatar">
                        <img :src="avatar(authuser)" alt="">
                        <div class="name">{{authuser.name}}</div>
                    </div>
                    <div class="rating">
                        <i class="far fa-star" :class="{fas: viewSession.tutor_rating >= 1}"></i>
                        <i class="far fa-star" :class="{fas: viewSession.tutor_rating >= 2}"></i>
                        <i class="far fa-star" :class="{fas: viewSession.tutor_rating >= 3}"></i>
                        <i class="far fa-star" :class="{fas: viewSession.tutor_rating >= 4}"></i>
                        <i class="far fa-star" :class="{fas: viewSession.tutor_rating >= 5}"></i>
                    </div>
                    <div class="feedback">
                        <p>{{viewSession.tutor_review}}</p>
                    </div>
                </div>

                <div v-if="viewSession.student_rating || viewSession.student_review" class="review">
                    <div v-if="authuser.type == 'student'" class="avatar">
                        <img :src="avatar(viewSession.teacher.user)" alt="">
                        <div class="name">{{viewSession.teacher.user.name}}</div>
                    </div>
                    <div v-if="authuser.type == 'teacher'" class="avatar">
                        <img :src="avatar(authuser)" alt="">
                        <div class="name">{{authuser.name}}</div>
                    </div>
                    <div class="rating">
                        <i class="far fa-star" :class="{fas: viewSession.student_rating >= 1}"></i>
                        <i class="far fa-star" :class="{fas: viewSession.student_rating >= 2}"></i>
                        <i class="far fa-star" :class="{fas: viewSession.student_rating >= 3}"></i>
                        <i class="far fa-star" :class="{fas: viewSession.student_rating >= 4}"></i>
                        <i class="far fa-star" :class="{fas: viewSession.student_rating >= 5}"></i>
                    </div>
                    <div class="feedback">
                        <p>{{viewSession.student_review}}</p>
                    </div>
                </div>

            </div>

        </section>
        <div v-else class="else">
            <div class="title">My Sessions</div>
            <div v-if="sess.length" class="sessionsList">
                <div v-for="ses in sess" :key="ses.id" class="session">
                    <a v-if="authuser.type == 'student'" :href="url + '/user/' + ses.teacher.user.id" class="with">
                        <div class="avatar">
                            <img :src="avatar(ses.teacher.user)" alt="">
                        </div>
                        <div class="info">
                            <div class="name">{{ses.teacher.user.name}}</div>
                        </div>
                    </a>
                    <a v-if="authuser.type == 'teacher'" :href="url + '/user/' + ses.student.user.id" class="with">
                        <div class="avatar">
                            <img :src="avatar(ses.student.user)" alt="">
                        </div>
                        <div class="info">
                            <div class="name">{{ses.student.user.name}}</div>
                        </div>
                    </a>
                    <div class="info">
                        <span class="dt">{{ses.created_at | moment('DD MMM, YYYY')}}</span>
                        <div class="val"><span>{{ses.level}}</span></div>
                        <div class="val"><span>{{ses.subject}}</span></div>
                    </div>
                    <div class="actions">
                        <div class="status">{{ses.completed ? "Completed" : 'Incomplete'}}</div>
                        <button @click="viewSession = ses" class="btn btn-gradient">Open</button>
                    </div>
            </div>
            </div>
            <div v-else class="nothing">
                No Session
            </div>
        </div>
   </div>
</template>
<style lang="sass" scoped>
    .sess-header
        color: #fff
        margin: 0 -15px
        background: linear-gradient(45deg, #54a323, #6edb95)
        padding: 30px 15px
        display: flex
        align-items: center
        justify-content: space-between

        .with
            margin: 10px 20px 0
            color: #fff
            .t
                display: block
                width: 100%
                background: #00000014
                border-radius: 10px
                margin-bottom: 5px
                text-align: center
            .avatar
                width: 65px
                height: 65px
                margin: 0 auto
                img
                    max-width: 100%
                    border-radius: 50%
            .info
                text-align: center
        .sess-info
            text-align: center
            .status
                text-align: center
                span
                    padding: 2px 10px
                    border-radius: 20px
                    background: linear-gradient(30deg, #2273c0, #0661fb)

    .rates
        background: linear-gradient(45deg, #2575bc, #0b61ff)
        color: #fff
        margin: 0 -15px
        padding: 5px 0
        // margin: 10px -15px
        display: flex
        justify-content: space-around
        box-shadow: 0 1px 1px 0 #53a2216b
        .hours
            display: flex
            flex-direction: column
            text-align: center
            .key
                letter-spacing: 4px
            .value
                font-size: 20px
                font-weight: bold
    .btn-back
        position: absolute
        top: 10px
        left: 10px
        font-size: 25px
        border-radius: 04px
        text-align: center
        color: #fff

        display: flex
        justify-content: center
        align-items: center
        cursor: pointer
        font-weight: bold
    .review-section
        margin: 0 -15px
        padding: 10px
        
        .heading
            text-align: center
            font-size: 24px
        .review
            border: none
            .rating
                i
                    color: #5aae3a
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

        .add
            margin: 10px 0
            p
                margin-bottom: 0
            .rating
                i
                    color: #54a323
                    font-size: 20px
            .feedback
            .act
                text-align: right

    .view-session
        display: flex
        flex-direction: column
        .completed
            margin: 0 10px 10px
            font-size: 20px
            color: #e87037
        .statusbar
            margin: 0 -15px 10px
            padding: 5px 10px
            display: flex
            align-items: center
            background: linear-gradient(45deg, #54a323, #6edb95)
            color: #fff
            border-radius: 3px
            flex-wrap: wrap
            justify-content: center
            text-align: center

            .val
                font-size: 20px
                color: #ffffff
                font-weight: bold
                margin-right: 20px
            .txt
                font-size: 15px
                font-weight: bold
                margin-right: 15px
        .main-info
            display: flex
            // margin: 0 -15px
            padding: 10px
            background: #e4f3e4
            justify-content: space-between
            box-shadow: 0 1px 1px 0 #53a2216b
            align-items: center
            .with
                margin: 10px 0
                .avatar
                    width: 65px
                    height: 65px
                    margin: 0 auto
                    img
                        max-width: 100%
                        border-radius: 50%
                .info
                    text-align: center
        // .rates
        //     background: #e4f3e4
        //     padding: 5px 0
        //     // margin: 10px -15px
        //     display: flex
        //     justify-content: space-around
        //     box-shadow: 0 1px 1px 0 #53a2216b
        //     .hours
        //         display: flex
        //         flex-direction: column
        //         text-align: center
        //         .key
        //             letter-spacing: 4px
        //         .value
        //             font-size: 20px
        //             font-weight: bold

    .sessionsList
        .session
            display: flex
            background: #e4f3e4
            padding: 5px
            border-radius: 3px
            justify-content: space-between
            margin-bottom: 10px
            flex-wrap: wrap
            box-shadow: 0 1px 1px 0 #53a2216b
            .with
                margin: 10px 0
                .avatar
                    width: 65px
                    height: 65px
                    margin: 0 auto
                    img
                        max-width: 100%
                        border-radius: 50%
            
            .info
                padding: 0 5px
                margin: 5px 0
                display: flex
                flex-direction: column
                justify-content: center
                align-items: center 
            .actions
                margin: 10px 0
                padding: 0 5px
                display: flex
                flex-direction: column
                justify-content: center
                align-items: center
                .status
                    font-weight: bold
                    text-align: center
                    color: #2575bc
                    padding: 2px 5px
            
</style>
<script>
    export default {
        props: {
            url: {
                type: String
            },
            sessions: {
                type: Array
            },
            authuser: {
                type: Object
            },
        },
        data()
        {
           return{
                reviewing: false,
                rating: 0,
                review: '',
                loading: false,
                viewSession : null,
                sess: this.sessions
           }
        },
        computed: {
            is_ready()
            {
                if(this.rating && this.review)
                {
                    return true
                }else{
                    return false
                }
            },
            hasReviewed()
            {
                if(this.authuser.type == 'teacher')
                {
                    if(this.viewSession.student_rating && this.viewSession.student_review)
                    {
                        return true
                    }
                    else{
                        return false
                    }
                }
                if(this.authuser.type == 'student')
                {
                    if(this.viewSession.tutor_rating && this.viewSession.tutor_review)
                    {
                        return true
                    }
                    else{
                        return false
                    }
                }
            }
        },
       
        methods: {
            postReview()
            {
                let index = 
                axios.post(this.url +'/post/review', {
                    id: this.viewSession.id,
                    by: this.authuser.type,
                    rating: this.rating,
                    review: this.review,
                    
                })
                .then(response => {
                    if(response.data.msg == 'success')
                    {
                        this.sessions[this.sessions.indexOf(this.viewSession)] = response.data.session
                        this.viewSession.tutor_rating = response.data.session.tutor_rating
                        this.viewSession.tutor_review = response.data.session.tutor_review
                        this.viewSession.student_rating = response.data.session.student_rating
                        this.viewSession.student_review = response.data.session.student_review
                    }else{
                        alert('Oops Something Went Wrong. Please refresh the page')
                    }
                })
                .catch(error => {
                    console.log(error)
                })
            },
            markComplete()
            {
                confirm("Once your mark this session as completed. You won't be able to undo")
                axios.post(this.url +'/post/complete-session', {
                    id: this.viewSession.id
                })
                .then(response => {
                    if(response.data.msg == 'success')
                    {
                        this.viewSession.completed = true
                        this.$store.commit('decreseSessions', 1)
                    }else{
                        alert('Oops Something Went Wrong. Please refresh the page')
                    }
                })
                .catch(error => {
                    console.log(error)
                })
            },
            requestCancel()
            {
                confirm("Are you sure you want to cancel this session?")
                axios.post(this.url +'/post/cancel-session', {
                    id: this.viewSession.id
                })
                .then(response => {
                    this.viewSession.cancel_request = this.authuser.type
                    alert("You have successfully requested for session cancelation.")
                })
                .catch(error => {
                    console.log(error)
                })
            },
            
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
        },
        mounted()
        {
           
        }
    }
</script>
