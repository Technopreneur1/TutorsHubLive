<template>
    <div class="composer">
        <textarea type="text" v-model="message" @keydown.enter="send" placeholder="Message..."></textarea>
        <button @click="send"><i class="fas fa-paper-plane"></i></button>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                message: ''
            };
        },
        methods: {
            send(e) {
                e.preventDefault();
                
                if (this.message == '') {
                    return;
                }
                
                this.$emit('send', this.message);
                this.message = '';
            }
        }
    }
</script>

<style lang="scss" scoped>
.composer{
    background: #2575bc;
    display: flex;
    justify-content: center;
    align-items: stretch;
    padding: 14px 10px;
    button{
        background: #53a221;
        display: flex;
        border-radius: 0 4px 4px 0;
        border: none;
        color: #fff;
        font-weight: bold;
        font-size: 17px;
    }
}
.composer textarea {
    flex-grow: 1;
    background: #ffffff;
    border-radius: 4px 0 0 4px;
    border: none;
    padding: 7px;
    height: 40px;
}
</style>

