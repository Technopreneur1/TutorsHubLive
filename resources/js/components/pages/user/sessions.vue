<template>
    <div class="full-container" style=" position: relative">
        <a v-if="viewSession" @click="viewSession = null" class="btn-back"><i class="fas fa-long-arrow-alt-left"></i></a>
        <full-loader v-if="loading" ></full-loader>
        <div v-if="showThanks" class="showThanks">
            <div class="thnaku">Thanks</div>
            <div class="pleaced">Your session has successfuly been Paid</div>
            <div class="links">
                <div class="gradient-btn"><a :href="sessions"><i class="fas fa-Home"></i> Back To Session</a></div>
            </div>
        </div>
        <section v-if="viewSession" class="view-session">
            <div class="sess-header">
                <a v-if="authuser.type == 'student'" :href="url + '/user/' + viewSession.teacher.user.id" class="with">
                    <div class="avatar">
                        <img :src="avatar(viewSession.teacher.user)" alt="">
                    </div>
                    <div class="info">
                        <div class="name">{{viewSession.teacher.user.name}}</div>
                        <div class="status">{{viewSession.completed ? 'Completed' : 'Pending'}}</div>
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
                    <div v-if="viewSession.payment_status != 1 && viewSession.accept != '1' && viewSession.class_status == 0" class="status"><span>Requested</span></div>
                    <div v-if="viewSession.payment_status != 1 && viewSession.accept == '1' && viewSession.class_status == 0" class="status"><span>Pending</span></div>
                    <div v-if="viewSession.payment_status == 1 && viewSession.accept == '1' && viewSession.class_status == 0"  class="status"><span>Upcoming</span></div>
                    <div v-if="viewSession.payment_status == 1 && viewSession.accept == '1' && viewSession.class_status == 1"  class="status"><span>Completed</span></div>
                    <span class="dt">{{viewSession.created_at | moment('DD MMM, YYYY')}}</span>
                    <div class="val"><span>Start Session: {{viewSession.startsession}}</span></div>
                    <div class="val"><span>End Session: {{viewSession.endsession}}</span></div>
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

            <div v-if="authuser.type == 'student' && !viewSession.completed && viewSession.class_status == 1" class="statusbar">
                <span class="val">Pending</span>
                <span class="txt">Please mark session as <b>completed</b> after it has taken place</span>
                <button @click="markComplete" class="btn btn-gradientb">Mark as completed</button> &nbsp; OR &nbsp;
            </div>
            <button v-if="!viewSession.cancel_request && !viewSession.completed" @click="requestCancel" class="btn btn-danger" style="border-radius: 30px;     text-align: center;
    display: block;">Request To Cancel Session</button>
            <button v-if="viewSession.accept != '1' && !viewSession.completed && authuser.type != 'student'" @click="requestaccept" class="btn btn-success" style="border-radius: 30px">Accept Session Request</button>
            <button v-if="viewSession.payment_status == '1' && viewSession.accept == '1' && viewSession.class_status == '0' && !viewSession.cancel_request && authuser.type != 'student'" @click="startsession" class="btn btn-success" style="border-radius: 30px">Start Session</button>
            <button v-if="viewSession.payment_status == 1 && viewSession.accept == '1' && viewSession.class_status == 0 && !viewSession.cancel_request && authuser.type == 'student'" @click="startsession" class="btn btn-success" style="border-radius: 30px">Join Session</button>
            <div v-if="viewSession.payment_status != 1  && viewSession.accept == '1' && authuser.type == 'student'" class="rates" >
                Please Pay to confirm this Session
            </div>
            <div  v-if="viewSession.payment_status != 1  && viewSession.accept == '1' && authuser.type == 'student'" ref="paypal">PayPal</div>
            <div v-if="viewSession.payment_status == 1 && viewSession.accept == '1' && viewSession.class_status == 1"  class="status">
                <div id="record" ></div>
            </div>
<!--            <button @click="requestpayment()" value="add task" class="btn btn-gradient">PayPal</button>-->


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

            <ul class="nav nav-tabs green-bg flex justify-content-around bg-gray session-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="requested-tab" data-toggle="tab" href="#requested" role="tab" aria-controls="home" aria-selected="true">Requested</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pending-tab" data-toggle="tab" href="#pending" role="tab" aria-controls="profile" aria-selected="false">Pending</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="upcoming-tab" data-toggle="tab" href="#upcoming" role="tab" aria-controls="contact" aria-selected="false">Upcoming</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" id="completed-tab" data-toggle="tab" href="#completed" role="tab" aria-controls="contact" aria-selected="false">Completed</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="cancelled-tab" data-toggle="tab" href="#cancelled" role="tab" aria-controls="contact" aria-selected="false">Cancelled</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="requested" role="tabpanel" aria-labelledby="home-tab">
                    <div v-if="requestedSessions.length" class="sessionsList">
                        <div v-for="ses in requestedSessions" :key="ses.id" class="session">
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
                                    <span class="dt">{{ses.date | moment('DD MMM, YYYY')}}</span>
                                    <div class="val"><span>{{ses.level}}</span></div>
                                    <div class="val"><span>{{ses.subject}}</span></div>
                                </div>
                                <div class="info">
                                    <span class="dt">Session Type{{ses.sessiontype}}</span>
                                    <div class="val"><span>Start Session: {{ses.startsession}}</span></div>
                                    <div class="val"><span>End Session: {{ses.endsession}}</span></div>
                                </div>
                                <div class="info">
                                    <span class="dt">Hours: {{ses.hours}}</span>
                                </div>
                                <div class="actions">
                                    <div v-if="ses.payment_status != 1 && ses.accept != '1' && ses.class_status == 0" class="status">
                                        <div v-if="!ses.cancel_request" class="status">
                                        Requested</div>

                                        <div v-if="ses.cancel_request" class="status">
                                        Cancelled</div>
                                    </div>
                                    <div v-if="ses.payment_status != 1 && ses.accept == '1' && ses.class_status == 0" class="status">Pending</div>

                                    <div v-if="ses.payment_status == 1 && ses.accept == '1' && ses.class_status == 1"  class="status">Completed</div>

                                    <button @click="showSession(ses)" class="btn btn-gradient">Open</button>
                                </div>

                        </div>

                    </div>

                    <div v-else class="nothing">
                        No Session
                    </div>
                </div>
                <div class="tab-pane fade" id="pending" role="tabpanel" aria-labelledby="profile-tab">
                    <div v-if="pendingSessions.length" class="sessionsList">
                        <div v-for="ses in pendingSessions" :key="ses.id" class="session">
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
                                    <span class="dt">{{ses.date | moment('DD MMM, YYYY')}}</span>
                                    <div class="val"><span>{{ses.level}}</span></div>
                                    <div class="val"><span>{{ses.subject}}</span></div>
                                </div>
                                <div class="info">
                                    <span class="dt">Session Type{{ses.sessiontype}}</span>
                                    <div class="val"><span>Start Session: {{ses.startsession}}</span></div>
                                    <div class="val"><span>End Session: {{ses.endsession}}</span></div>
                                </div>
                                <div class="info">
                                    <span class="dt">Hours: {{ses.hours}}</span>
                                </div>
                                <div class="actions">
                                    <div v-if="ses.payment_status != 1 && ses.accept != '1' && ses.class_status == 0" class="status">Requested</div>
                                    <div v-if="ses.payment_status != 1 && ses.accept == '1' && ses.class_status == 0" class="status">Pending</div>
                                    <div v-if="ses.payment_status == 1 && ses.accept == '1' && ses.class_status == 0"  class="status">Upcoming</div>
                                    <div v-if="ses.payment_status == 1 && ses.accept == '1' && ses.class_status == 1"  class="status">Completed</div>

                                    <button @click="showSession(ses)" class="btn btn-gradient">Open</button>
                                </div>
                        </div>

                    </div>

                    <div v-else class="nothing">
                        No Session
                    </div>
                </div>
                <div class="tab-pane fade" id="upcoming" role="tabpanel" aria-labelledby="contact-tab">
                    <div v-if="upcomingSessions.length" class="sessionsList">
                        <div v-for="ses in upcomingSessions" :key="ses.id" class="session">
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
                                    <span class="dt">{{ses.date | moment('DD MMM, YYYY')}}</span>
                                    <div class="val"><span>{{ses.level}}</span></div>
                                    <div class="val"><span>{{ses.subject}}</span></div>
                                </div>
                                <div class="info">
                                    <span class="dt">Session Type{{ses.sessiontype}}</span>
                                    <div class="val"><span>Start Session: {{ses.startsession}}</span></div>
                                    <div class="val"><span>End Session: {{ses.endsession}}</span></div>
                                </div>
                                <div class="info">
                                    <span class="dt">Hours: {{ses.hours}}</span>
                                </div>
                                <div class="actions">

                                    <div v-if="ses.payment_status != 1 && ses.accept != '1' && ses.class_status == 0" class="status">Requested</div>
                                    <div v-if="ses.payment_status != 1 && ses.accept == '1' && ses.class_status == 0" class="status">Pending</div>
<!--                                    <div v-if="ses.payment_status == 1 && ses.accept == '1' && ses.class_status == 0"  class="status">Upcoming</div>-->
                                    <div v-if="ses.payment_status == 1 && ses.accept == '1' && ses.class_status == 0"  class="status">
                                        <div v-if="!ses.cancel_request" class="status">
                                            Upcoming</div>
                                        <div v-if="ses.cancel_request" class="status">
                                            <div class="status" >Cancelled</div>
                                            <div style="font-size: 10px">Please rise a ticket in <br> Support Center for refund!.</div>
                                        </div>
                                    </div>
                                    <div v-if="ses.payment_status == 1 && ses.accept == '1' && ses.class_status == 1"  class="status">Completed</div>

                                    <button @click="showSession(ses)" class="btn btn-gradient">Open</button>
                                </div>
                            </div>

                    </div>

                    <div v-else class="nothing">
                        No Session
                    </div>
                </div>
                <div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="contact-tab">
                    <div v-if="completedsessions.length " class="sessionsList">
                        <div v-for="ses in completedsessions" :key="ses.id" class="session" >
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
                                    <span class="dt">{{ses.date | moment('DD MMM, YYYY')}}</span>
                                    <div class="val"><span>{{ses.level}}</span></div>
                                    <div class="val"><span>{{ses.subject}}</span></div>
                                </div>
                                <div class="info">
                                    <span class="dt">Session Type{{ses.sessiontype}}</span>
                                    <div class="val"><span>Start Session: {{ses.startsession}}</span></div>
                                    <div class="val"><span>End Session: {{ses.endsession}}</span></div>
                                </div>
                                <div class="info">
                                    <span class="dt">Hours: {{ses.hours}}</span>
                                </div>
                                <div class="actions">
                                    <div v-if="ses.payment_status != 1 && ses.accept != '1' && ses.class_status == 0" class="status">Requested</div>
                                    <div v-if="ses.payment_status != 1 && ses.accept == '1' && ses.class_status == 0" class="status">Pending</div>
                                    <div v-if="ses.payment_status == 1 && ses.accept == '1' && ses.class_status == 0"  class="status">Upcoming</div>
                                    <div v-if="ses.payment_status == 1 && ses.accept == '1' && ses.class_status == 1"  class="status">Completed</div>

                                    <button @click="showSession(ses)" class="btn btn-gradient">Open</button>
                                </div>
                            </div>
                        </div>


                    <div v-else class="nothing">
                        No Session
                    </div>
                </div>
                <div class="tab-pane fade" id="cancelled" role="tabpanel" aria-labelledby="contact-tab">
                    <div v-if="cancelledsessions.length" class="sessionsList">
                        <div v-for="ses in cancelledsessions" :key="ses.id" class="session">
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
                                <span class="dt">{{ses.date | moment('DD MMM, YYYY')}}</span>
                                <div class="val"><span>{{ses.level}}</span></div>
                                <div class="val"><span>{{ses.subject}}</span></div>
                            </div>
                            <div class="info">
                                <span class="dt">Session Type{{ses.sessiontype}}</span>
                                <div class="val"><span>Start Session: {{ses.startsession}}</span></div>
                                <div class="val"><span>End Session: {{ses.endsession}}</span></div>
                            </div>
                            <div class="info">
                                <span class="dt">Hours: {{ses.hours}}</span>
                            </div>
                            <div class="actions">

                                <div v-if="ses.payment_status != 1 && ses.accept != '1' && ses.class_status == 0" class="status">Requested</div>
                                <div v-if="ses.payment_status != 1 && ses.accept == '1' && ses.class_status == 0" class="status">Pending</div>
                                <!--                                    <div v-if="ses.payment_status == 1 && ses.accept == '1' && ses.class_status == 0"  class="status">Upcoming</div>-->
                                <div v-if="ses.payment_status == 1 && ses.accept == '1' && ses.class_status == 0"  class="status">
                                    <div v-if="!ses.cancel_request" class="status">
                                        Upcoming</div>
                                    <div v-if="ses.cancel_request" class="status">
                                        <div class="status" >Cancelled</div>
                                        <div style="font-size: 10px">Please rise a ticket in Support Center for refund!.</div>
                                    </div>
                                </div>
                                <div v-if="ses.payment_status == 1 && ses.accept == '1' && ses.class_status == 1"  class="status">Completed</div>

                                <button @click="showSession(ses)" class="btn btn-gradient">Open</button>
                            </div>
                        </div>

                    </div>

                    <div v-else class="nothing">
                        No Session
                    </div>
                </div>

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
            showThanks: false,
            reviewing: false,
            rating: 0,
            review: '',
            loading: false,
            viewSession : null,
            sess: this.sessions
        }
    },
    computed: {
        requestedSessions(){
            
            var session;
            var requests = [];
            for (var i = 0; i < this.sessions.length; i++) {
                session = this.sessions[i];
                if (session.cancel_request == null && session.payment_status != 1 && session.accept != '1' && session.class_status == 0) {
                    requests.push(session);
                }
            }
            return requests;
        },
        pendingSessions(){
            var session;
            var requests = [];
            for (var i = 0; i < this.sessions.length; i++) {
                session = this.sessions[i];
                console.log((session.class_status))
                if (session.cancel_request== null && session.payment_status != 1 && session.accept == '1' && session.class_status == 0) { 
                        requests.push(session);
                }
            }
            return requests;
        },

        upcomingSessions(){
            var session;
            var requests = [];
            for (var i = 0; i < this.sessions.length; i++) {
                session = this.sessions[i];
                if (session.cancel_request== null && session.payment_status == 1 && session.accept == '1' && session.class_status == 0) 
                {
                    requests.push(session);
                }
            }
            return requests;
        },

        completedsessions(){
            var session;
            var requests = [];
            for (var i = 0; i < this.sessions.length; i++) {
                session = this.sessions[i];
                if (session.cancel_request== null && session.payment_status == 1 && session.accept == '1' && session.class_status == 1) {
                    requests.push(session);

                }
            }
            return requests;
        }, cancelledsessions(){
            var session;
            var requests = [];
            for (var i = 0; i < this.sessions.length; i++) {
                session = this.sessions[i];
                if (session.cancel_request ) {
                    requests.push(session);

                }
            }
            return requests;
        },
        currency()
        {
            if (this.viewSession.teacher.user.currency) {
                return this.viewSession.teacher.user.currency;
            }else {
                return "USD";
            }
            //
            // if (this.authuser.country == 1) {
            //     return "USD";
            // } else {
            //     return "CAD";
            // }
        },
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
        setLoaded: function() {

            this.loaded = true;
            console.log(window.paypal)
            let vob = this
            window.paypal.Buttons({

                createOrder: (data, actions) => {
                    return actions.order.create({

                        purchase_units: [
                            {
                                amount: {
                                    currency_code: this.currency,
                                    value: this.viewSession.total
                                }
                            }
                        ],
                        application_context: {
                            shipping_preference: 'NO_SHIPPING'
                        }
                    })
                },
                onApprove: function(data, actions) {
                    //vob.loading = true
                    // This function captures the funds from the transaction.
                    return actions.order.capture().then(function(details) {

                        axios.post('https://tutors-hub.com/complete/bookingpay',
                            {
                                sessionpid:vob.viewSession.id
                            })
                            .then(response => {
                                vob.showThanks = true;
                                vob.loading = false
                                location.reload();
                            })
                            .catch(error => {
                                console.log(error);
                            })
                    });
                    // This function shows a transaction success message to your buyer.

                    // });
                },
                style: {
                    layout:  'vertical',
                    color:   'blue',
                    shape:   'rect',
                    label:   'paypal'
                }
            }).render(this.$refs.paypal)
        },
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
        requestaccept()
        {
            confirm("Are you sure you want to accept this session?")
            axios.post(this.url +'/post/accept-session', {
                id: this.viewSession.id
            })
                .then(response => {
                    this.viewSession.accept = '1'
                    alert("You have successfully accepted for session.")
                })
                .catch(error => {
                    console.log(error)
                })
        },
        requestpayment()
        {
            confirm("Are you sure you want to accept this session?")
            axios.post(this.url +'/post/accept-payment', {
                id: this.viewSession.id

            })

        },
        showSession(ses) {
            this.viewSession = ses;
            axios.get(this.url +'/getrecording/'+ses.id, )
                .then(response => {
                    if(response.data.result) {
                        // data = JSON.parse(data);


                        if (response.data.result) {
                            var html = '<a class="btn btn-gradient"  target="_blank" href="' + response.data.url[0] + '" > View Recorded Session </a>';
                            $('#record').append(html);
                        }
                    }
                })
                .catch(error => {
                    console.log(error)
                })

        },
        startsession()
        {
            window.location = "/start-online-class/" + this.viewSession.id;
            // this.loading = true
            // confirm("Are you sure you want to start this session?")
            // axios.post(this.url +'/post/start-session', {
            //     id: this.viewSession.id
            // })
            //     .then(response => {
            //         console.log(response)
            //         this.viewSession.startsession = this.authuser.type
            //         if(this.authuser.type == 'teacher')
            //         {
            //
            //             window.open("https://connect.tutors-hub.com#/?teacherid="+this.viewSession.agora_session, "_blank");
            //
            //         }else{
            //
            //             window.open("https://connect.tutors-hub.com#/?studentid="+this.viewSession.agora_session, "_blank");
            //
            //         }
            //         //alert("You have successfully started for session.")
            //     })
            //     .catch(error => {
            //         console.log(error)
            //     })
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
    updated()
    {

        const script = document.createElement("script");
        //script.src = "https://www.paypal.com/sdk/js?client-id=AYSq3RDGsmBLJE-otTkBtM-jBRd1TCQwFf9RGfwddNXWz0uFU9ztymylOhRS&currency=" + this.currency;
        script.src = "https://www.paypal.com/sdk/js?client-id=AU1qSrl-VvM9r15F6lhSITnPRtJvJwFJfd__J5cMP8FvpXCDcEloTOysg8exK1DZN8rMCsgBXCOUbPFd&currency=" + this.currency;
        // script.src = "https://www.paypal.com/sdk/js?client-id=AVAo9E3s-xN1GwGOPf7WuRsfUz67-urBxeAwRp_3xYboyF0_oW9E4MnLh0mgcbBqAYzmD3LoGD7a8oRP&currency=" + this.currency;
        script.addEventListener("load", this.setLoaded);
        document.body.appendChild(script);
    }
}
</script>
