<template>
    <div class="changePassword">
         <span id="success" @click="$emit('cancel')" class="btn-cancel"><i class="fas fa-long-arrow-alt-left"></i></span>
        <div class="ttl">Change Password</div>
        <div class="chform">
            <div class="input">
                <label for="">Current Password</label>
                <input type="password" v-model="current" placeholder="Current Password">
            </div>
            <div class="input">
                <label for="">New Password</label>
                <input type="password" v-model="password" placeholder="New Password">
            </div>
            <div class="input">
                <label for="">Confirm New Password</label>
                <input type="password" v-model="password_confirmation" placeholder="Confirm New Password">
            </div>
            <div v-if="error" class="error-bar" style="margin-bottom: 15px">{{error}}</div>
            <div v-if="success" class="success-bar" style="margin-bottom: 15px">{{success}}</div>
            <div class="input">
                <button @click="validatePass()" class="btn btn-update">Update Password</button>
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
                error: '',
                success: '',
                current: '',
                password: '',
                password_confirmation: '',
           }
        },
        methods: {
            postReset()
            {
                axios.post(this.url +'/update/password', {
                    current: this.current,
                    password: this.password
                })
                .then(response => {
                    if(response.data.message == 'success')
                    {
                        this.error = ''
                        this.success = "Password Updated"
                        this.current = '',
                        this.password = '',
                        this.password_confirmation = ''
                    }else{
                        this.error = response.data.message
                    }
                })
                .catch(error => {
                    console.log(error);
                })
            },
            validatePass()
            {
                this.error = ""
                if(this.password != this.password_confirmation)
                {
                    this.error = "Password confirmation did not match";
                }else
                {
                    if(this.password.length < 8)
                    {
                         this.error = "New password must be at-least 8 charecters long";
                    }else
                    {
                        if(this.current == this.password)
                        {
                            this.error = "You can not set same password, Try a new password";
                        }else
                        {
                            this.postReset()
                        }
                    }
                }
            },
        },
        mounted()
        {
            
        }
    }
</script>
