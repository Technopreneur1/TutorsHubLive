<template>
    <div class="editPlans">
       <span v-if="type != 'page'" id="success" @click="cancel()" class="btn-cancel"><i class="fas fa-long-arrow-alt-left"></i></span>
       <div id="edp"></div>
       <div v-if="success" class="success">{{success}}</div>
        <section class="addWrap">
            <div class="optbtn">
                <div v-if="!addNew" @click="addNewPlan" class="gradient-btn">
                    <button><i class="fas fa-plus"></i> Add New Plan</button>
                </div>
                <div v-else @click="addNew = false" class="gradient-btn">
                    <button><i class="fas fa-times"></i> Cancel</button>
                </div>
            </div>
            <transition  name="easy-appear" enter-active-class="animated fadeIn" leave-active-class="animated fadeOut faster">
                <div v-if="addNew" class="create">
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
                        <input type="number" min="20" max="1000" value="20" v-model="rate" placeholder="Rate">
                    </div>
                    <div v-if="error" class="error">{{error}}</div>
                    <div class="text-right">
                        <button @click="post" class="btn btn-gradient">Save</button>
                    </div>
                </div>
            </transition>
            <transition name="easy-appear" enter-active-class="animated fadeIn" leave-active-class="animated fadeOut faster">
                <div v-if="editPlan" class="create">
                    <div class="input">
                        <label for="">Discipline</label>
                        <select v-model="editPlan.discipline_id" id="">
                            <option value="">-- Discipline --</option>
                            <option v-for="discipline in disciplines" :value="discipline.id" :key="discipline.id">{{discipline.name}}</option>
                        </select>
                    </div>
                    <div class="input">
                        <label for="">Level</label>
                        <select v-model="editPlan.level_id" id="">
                            <option value="">-- Level --</option>
                            <option v-for="level in levels" :value="level.id" :key="level.id">{{level.name}}</option>
                        </select>
                    </div>
                    <div class="input">
                        <label for="">Hourly Rate - $$</label>
                        <input type="number" min="20" max="1000" value="20" v-model="editPlan.rate" placeholder="Rate">
                    </div>
                    <div v-if="error" class="error">{{error}}</div>
                    <div class="text-right">
                        <button @click="update" class="btn btn-gradient">Save</button>
                    </div>
                </div>
            </transition>
        </section>
        <div class="allWrap">
            <div class="newrow">
                <span style="background: #fff">My Active Plans</span>
            </div>
            <table class="my-plans">
                <tr class="plan ph">
                    <th>Subject</th>
                    <th>Level</th>
                    <th>Hourly Rate</th>
                    <th>Action</th>
                </tr>
                <tr v-for="plan in plans" :key="plan.id" class="plan">
                    <td class="subject">{{plan.discipline.name}}</td>
                    <td class="level">{{plan.level.name}}</td>
                    <td class="rate">${{plan.rate}}</td>
                    <td class="act">
                        <span @click="editThis(plan)" class="edit"><i class="fas fa-edit"></i></span>
                        <span @click="deletePlan(plan)" class="del"><i class="fas fa-trash"></i></span>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</template>
<script>
    export default {

        props: {
            url: {
                type: String
            },
            user: {
                type: Object
            },
            type: {
                user: String
            }
        },
        data()
        {
           return{
                addNew: false,
                plans: [],
                disciplines: [],
                levels: [],
                discipline: '',
                level: '',
                rate: 20,
                success: '',
                editPlan: '',
                error: ''
           }
        },
        methods: {
            addNewPlan()
            {
                this.editPlan = ''
                this.addNew = true
            },
            cancel()
            {
                this.$emit('cancel')
            },
            editThis(plan){
                this.addNew = false
                this.editPlan = plan
                document.getElementById('edp').scrollIntoView();
            },
            deletePlan(plan)
            {
                this.success = ""
                axios.post(this.url +'/delete/plan',
                    {
                        id: plan.id
                    })
                    .then(response => {
                        console.log(response)
                        this.success  = "Plan Deleted"
                        this.plans.splice(this.plans.indexOf(plan), 1)
                    })
                    .catch(error => {
                        console.log(error);
                    })
            },
            post()
            {
                this.success = ""
                if(this.rate && this.discipline && this.level)
                {
                    if(this.rate >= 20)
                    {
                        this.error = ''
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
                            this.discipline = '',
                            this.level = '',
                            this.rate = ''
                        })
                        .catch(error => {
                            console.log(error);
                        })
                    } else{
                        this.error = "Hourly rate must be at-least $20"
                    }
                } else{
                    this.error = "Please Complete The Form To Save"
                }
            },
            update()
            {
                this.success = ""
                if(this.editPlan.rate && this.editPlan.discipline && this.editPlan.level)
                {
                    this.error = ''
                    if(this.editPlan.rate >= 20)
                    {
                        this.error = ''
                        axios.post(this.url +'/update/plan',
                        {
                            discipline: this.editPlan.discipline_id,
                            level: this.editPlan.level_id,
                            rate: this.editPlan.rate,
                            id: this.editPlan.id,
                        })
                        .then(response => {
                            console.log(response)
                            this.success  = "Plan Updated"
                            this.editPlan = ''
                        })
                        .catch(error => {
                            console.log(error);
                        })
                    } else{
                        this.error = "Hourly rate must be at-least $20"
                    }

                }else{
                    this.error = "Please Complete The Form To Update"
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
