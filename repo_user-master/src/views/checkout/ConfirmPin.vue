<template>
    <div class="form">
        <BackButton :value="'Enter Your PIN'"></BackButton>

        <p>Enter your PIN to confirm payment</p>
        <div class="pin">
            <input v-model="num" tabindex="1" type="number" pattern="/^-?\d+\.?\d*$/"
                onKeyPress="if(this.value.length==1) return false;" />
            <input v-model="num1" tabindex="2" type="number" pattern="/^-?\d+\.?\d*$/"
                onKeyPress="if(this.value.length==1) return false;" />
            <input v-model="num2" tabindex="3" type="number" pattern="/^-?\d+\.?\d*$/"
                onKeyPress="if(this.value.length==1) return false;" />
            <input v-model="num3" tabindex="4" type="number" pattern="/^-?\d+\.?\d*$/"
                onKeyPress="if(this.value.length==1) return false;" />
        </div>

        <ButtonVue :value="'Continue'" @onClick="onClick()"></ButtonVue>

        <OrderSuccess v-if="x"></OrderSuccess>
    </div>
</template>
  
<script>
import BackButton from "@/components/base/BackButton";
import ButtonVue from "@/components/base/Button";
import OrderSuccess from "@/components/popup/OrderSuccess.vue";

export default {
    components: {
        BackButton,
        ButtonVue,
        OrderSuccess
    },
    data() {
        return {
            x: false,
            num: '',
            num1: '',
            num2: '',
            num3: '',
        };
    },
    methods: {
        onClick: function () {
            if (this.num == '' || this.num1 == '' || this.num2 == '' || this.num3 == '') {
                alert('Enter PIN code');
            } else {
                this.x = !this.x;
            }
        },
    },
};
</script>
  
<style lang="scss" scoped>
.form {
    display: flex;
    flex-direction: column;
    margin: 0;
    width: 90%;
    margin: auto;
    letter-spacing: normal;

    p {
        margin-top: 150px;
        padding: 0 10px;
        text-align: center;
        font-size: 17px;
        font-family: system-ui;
        font-weight: 600;
    }

    .pin {
        display: flex;
        gap: 10px;
        margin-top: 100px;
        margin-bottom: 100px;

        input {
            font-family: system-ui;
            font-size: 17px;
            font-weight: 600;
            width: calc(60%);
            border: none;
            padding: 17px 0px;
            padding-left: 10%;
            background-color: #cccccc45;
            border-radius: 15px;

            &:focus-visible {
                outline: 2px solid #686565;
            }
        }
    }
}
</style>