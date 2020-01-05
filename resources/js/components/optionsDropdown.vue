<template>
       <div class="ilink options">
            <i @click="toggleShow" class="fa fa-caret-down"></i>
            <div v-if="show" class="optionsDropbox">
                <ul>
                    <li><a :href="url + '/settings'">Profile Settings</a></li>
                    <li><a :href="url + '/settings/manage/videos'">Manage Videos</a></li>
                    <li><a :href="url + '/review/fights'">Review Fights</a></li>
                    <li>
                        <button @click="logout">Logout</button>
                    </li>
                </ul>
            </div>
        </div>
</template>

<script>
    export default {
        props: {
           
        },
        data(){
            return {
                show: false,
                loadingBtn: false
            }
        },
        methods: {
            toggleShow()
            {
                this.show ? this.show = false : this.show = true
            },
            logout()
            {
                this.loadingBtn = true
                axios.post(this.url + '/logout')
                .then(response => {
                    window.location = this.url
                    this.loadingBtn = false
                })
                .catch(error => {
                    console.log(error);
                })
            }
        },
        
        created()
        {
            let self = this;
            window.addEventListener('click', function(e){
                // close dropdown when clicked outside
                if (!self.$el.contains(e.target)){
                self.show = false
                } 
            })

        }
    }
</script>

<style lang="sass" scoped>
.options
    position: relative
    .optionsDropbox
        background: #ffffff
        z-index: 11
        box-shadow: 0 2px 6px 1px #00000059
        position: absolute
        top: 40px
        right: -4px
        max-width: 350px

        
    
        ul
            margin: 0
            padding: 0
            list-style: none
            li
                button
                    border: none
                    outline: none
                    width: 100%
                    
                a, button
                    background: #fff
                    color: #000000
                    padding: 2px 30px
                    white-space: nowrap
                    overflow: hidden
                    text-overflow: ellipsis
                    border-bottom: 1px solid #0000002e
                    display: block
                    font-size: 15px

                    &:hover
                        background: blue
                        color: #ffffff
        &::before
            content: ''
            position: absolute
            width: 17px
            height: 10px
            background: white
            right: 0
            transform: translate(0, -100%)
            clip-path: polygon(50% 0%, 0% 100%, 100% 100%)
</style>