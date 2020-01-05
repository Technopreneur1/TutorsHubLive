<template>
    <div class="reg-hero">
        <div class="text">I am a</div>
        <div class="reg-buttons">
            
            <button @click="openForm = 'teacher'" class="btn btn-type student">Teacher</button>
            <button @click="openForm = 'student'" class="btn btn-type teacher">Student</button>
        </div>


        <transition name="easy-appear" enter-active-class="animated slideInLeft" leave-active-class="animated slideOutLeft">
            <teacher-register v-show="openForm == 'teacher'" @closeForm="openForm = ''" :url="url"></teacher-register>
        </transition>
        <transition name="easy-appear" enter-active-class="animated slideInLeft" leave-active-class="animated slideOutLeft">
            <student-register v-show="openForm == 'student'" @closeForm="openForm = ''" :url="url"></student-register>
        </transition>
    </div>
</template>
<script>
    export default {
        props: ['url'],
        data()
        {
           return{
               openForm: '',
               books: []
           }
        },
        methods: {
           
        },
        mounted()
        {
            
        }
    }
</script>
