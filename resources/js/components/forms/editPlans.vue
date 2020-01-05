<template>
    <div class="editPlans">
        <div class="create">
            <div class="input">
                <label for="">Discipline</label>
                <select v-model="discipline" id="">
                    <option value="">-- Discipline --</option>
                    <option v-for="discipline in disciplines" :value="discipline.id" :key="discipline.id">{{discipline.name}}</option>
                </select>
            </div>
            <div class="input">
                <label for="">Level</label>
                <select v-model="level" id="">
                    <option value="">-- Level --</option>
                    <option v-for="level in levels" :value="level.id" :key="level.id">{{level.name}}</option>
                </select>
            </div>
            <div class="input">
                <label for="">Hourly Rate - $$</label>
                <input type="number" v-model="rate" placeholder="Rate">
            </div>
            <button @click="post" class="btn btn-de">Save</button>
        </div>
        <div class="newrow">
            <span style="background: #fff">My Plans</span>
        </div>
        <div class="my-plans">
            <div v-for="plan in plans" :key="plan.id" class="plan">
                <div class="subject">{{plan.discipline.name}}</div>
                <div class="level">{{plan.level.name}}</div>
                <div class="rate">${{plan.rate}}</div>
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
                plans: [],
                disciplines: [],
                levels: [],
                discipline: '',
                level: '',
                rate: '',
                success: ''
           }
        },
        methods: {
            post()
            {
                if(this.rate && this.discipline && this.level)
                {
                    axios.post(this.url +'/post/plan', 
                    {
                        discipline: this.discipline,
                        level: this.level,
                        rate: this.rate,
                    })
                    .then(response => {
                        console.log(response)
                        this.success  = "New Plan Added"
                        this.plans.push(response.data.plan)
                    })
                    .catch(error => {
                        console.log(error);
                    })
                }else{
                    alert ("Please Complete The Form To Save")
                }
            },
           getPlans()
            {
                axios.post(this.url +'/get/plans')
                .then(response => {
                    console.log(response.data.plans)
                    this.plans = response.data.plans
                })
                .catch(error => {
                    console.log(error);
                })
            },
           getLevels()
            {
                axios.post(this.url +'/get/levels')
                .then(response => {
                    this.levels = response.data.levels
                })
                .catch(error => {
                    console.log(error);
                })
            },
            getDisciplines()
            {
                axios.post(this.url +'/get/disciplines')
                .then(response => {
                    this.disciplines = response.data.disciplines
                })
                .catch(error => {
                    console.log(error);
                })
            },
        },
        mounted()
        {
            this.getPlans()
            this.getLevels()
            this.getDisciplines()
        }
    }
</script>
