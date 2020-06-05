<template>
    <table class="plans">
        <tr>
            <th>Subject</th>
            <th>Level</th>
            <th>Hourly Rate</th>
            <th  v-if="authuser.id != user.id" >Book</th>
        </tr>
        <tr v-for="plan in plans" :key="plan.id" class="plan">
            <td class="subject">{{plan.discipline.name}}</td>
            <td class="level">{{plan.level.name}}</td>
            <td class="level">${{plan.rate}}</td>
            <td v-if="authuser.id != user.id" class="level"><button @click="bookNow(plan)" class="btn-book">Book Now</button></td>
        </tr>
    </table>
</template>
<script>
    export default {
        // props: ['url', 'plans', 'authuser', 'user'],
        props: {
            url: 
            {
              type: String
            },    
            plans: 
            {
              type: Array
            },    
            authuser: 
            {
              type: Object
            },    
            user: 
            {
              type: Object
            },    
        },
        data()
        {
           return{
                
           }
        },
        methods: {
            bookNow(plan)
            {
                if(this.authuser.type == 'student')
                {
                    this.$emit('book', plan)
                }else{
                    alert("You should have a student account to book");
                }
            },
            editPlan()
            {
                this.$emit('editPlan')
            },
            contact(id)
           {
                axios.post(this.url +'/check/hasConversation', {
                    id: id
                })
                .then(response => {
                    if(response.data.has)
                    {
                        window.location = this.url + "/messages?u=" + id;
                    }else{
                        this.$emit('startConversation')
                    }
                })
                .catch(error => {
                    console.log(error);
                })
           },
           deleteMyAd(id)
            {
                axios.post(this.url +'/delete/my-ad', {
                    'id': id
                })
                .then(response => {
                    console.log(response.data)
                    window.location = this.url + '/my-ads'
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
