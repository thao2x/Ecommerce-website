<template>
    <div class="form">
        <BackButton :value="'Creat New Password'"></BackButton>
        <img class="form__img" src="@/assets/new-pass.jpg" alt="">
        <p>Create Your New Password</p>
        <InputVue :value="password" class="input-vue" :placeholder="'Password'" :type="'password'"
            @keyPress="password = $event" />
        <InputVue :value="confirmPassword" class="input-vue" :placeholder="'Confirm password'" :type="'password'"
            @keyPress="confirmPassword = $event" />
        <Remember class="checkbox" @onChecked="rememberMe = $event"></Remember>
        <ButtonVue :value="'Continue'" @onClick="onClick($event)" />
        <Congrats v-if="show"></Congrats>
    </div>
</template>
  
<script>
import BackButton from "@/components/base/BackButton";
import InputVue from "@/components/base/Input";
import ButtonVue from "@/components/base/Button";
import Remember from "@/components/base/Remember";
import Congrats from "@/components/popup/Congrats";

export default {
    components: {
        BackButton,
        InputVue,
        Remember,
        ButtonVue,
        Congrats
    },
    data() {
        return {
            show: false,
            password: '',
            confirmPassword: ''
        }
    },
    methods: {
        onClick: function () {
            console.log(this.password);
            console.log(this.confirmPassword);
            if (this.password == "" || this.confirmPassword == "") {
                alert("Vui long nhap");
                return;
            }
            if (this.password !== this.confirmPassword) {
                alert("Nhập sai");
                return;
            }

            this.show = !this.show;
        },
    },
}
</script>
  
<style lang="scss" scoped>
.form {
    display: flex;
    flex-direction: column;
    margin: 0;
    width: 90%;
    margin: auto;
    letter-spacing: normal;

    &__img {
        width: 80%;
        margin-top: 85px;
        margin-left: auto;
        margin-right: auto;
    }

    p {
        margin-top: 50px;
        margin-bottom: 20px;
        font-size: 17px;
        font-family: system-ui;
        font-weight: 400;
    }

    .input-vue {
        margin-bottom: 20px;
    }

    .checkbox {
        margin-top: 5px;
        margin-bottom: 50px;
    }
}
</style>