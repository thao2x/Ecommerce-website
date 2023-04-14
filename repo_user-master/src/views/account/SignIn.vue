<template>
    <div class="form">
        <BackButton/>

        <div class="form__logo">
            <img src="@/assets/picwish.png" alt="" />
            <p>Login to Your Account</p>
        </div>

        <InputVue class="input-vue" :placeholder="'Email'" :type="'text'" @keyPress="email = $event" />
        <InputVue class="input-vue" :placeholder="'Password'" :type="'password'" @keyPress="passWord = $event" />

        <!-- // $event là gia tri khi emit -->
        <Remember class="checkbox" @onChecked="rememberMe = $event"></Remember>

        <ButtonVue :value="'Sign in'" @onClick="onClick($event)" />

        <a href="/forgot-password" class="form__reset">Forgot the password?</a>

        <OtherCnt :type="'signin'" />
    </div>
</template>
  
<script>
import BackButton from "@/components/base/BackButton";
import InputVue from "@/components/base/Input";
import ButtonVue from "@/components/base/Button";
import Remember from "@/components/base/Remember";
import OtherCnt from "@/components/base/OtherCnt";

export default {
    name: "SignIn",
    components: {
        BackButton,
        InputVue,
        Remember,
        ButtonVue,
        OtherCnt
    },
    data() {
        return {
            passWord: null,
            email: null,
            rememberMe: false,
        };
    },
    methods: {
        onClick: (data) => {
            console.log(data);
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

    &__logo {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin: 30px 0;

        img {
            max-width: 90px;
            margin: 35px 0;
        }

        p {
            font-size: 24px;
            font-family: system-ui;
            font-weight: 700;
        }
    }

    .input-vue {
        margin-bottom: 20px;
    }

    .checkbox {
        margin-top: 5px;
        margin-bottom: 25px;
    }

    &__reset {
        font-family: system-ui;
        font-size: 14px;
        font-weight: 600;
        color: #000;
        text-decoration: none;
        padding-top: 20px;
        text-align: center;
    }
}
</style>
  