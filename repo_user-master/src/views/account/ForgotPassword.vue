<template>
    <div class="form">
        <BackButton :value="'Forgot Password'"></BackButton>

        <img class="form__img" src="@/assets/forgotPass.jpg" alt="">
        <p>Select which contact details should we use to reset your password</p>
        <div class="form__contact">
            <div class="form__contact--icon">
                <font-awesome-icon icon="fas fa-comment-dots" />
            </div>
            <div class="form__contact--content">
                <p>via SMS:</p>
                <span>+11*****09</span>
            </div>
        </div>
        <div class="form__contact">
            <div class="form__contact--icon">
                <font-awesome-icon icon="fas fa-envelope" />
            </div>
            <div class="form__contact--content">
                <p>via Email:</p>
                <span>your*****@email.com</span>
            </div>
        </div>

        <ButtonVue :value="'Continue'" @onClick="onClick()"></ButtonVue>
    </div>
</template>
  
<script>
import BackButton from "@/components/base/BackButton";
import ButtonVue from "@/components/base/Button";

export default {
    components: {
        BackButton,
        ButtonVue
    },
    methods: {
        onClick: function () {
            this.$router.push({ path: '/verify-password' });
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
        margin-top: 65px;
        margin-left: auto;
        margin-right: auto;
    }

    p {
        margin: 20px 0;
        font-size: 17px;
        font-family: system-ui;
        font-weight: 500;
        line-height: 24px;
    }

    &__contact {
        display: flex;
        align-items: center;
        border-radius: 25px;
        outline: 2px solid rgba(167, 158, 158, 0.2588235294);
        margin-bottom: 20px;

        &--icon {
            margin: 20px;
            height: 70px;
            width: 20%;
            border-radius: 50%;
            background-color: rgba(167, 158, 158, 0.2588235294);
            display: flex;
            align-items: center;
            justify-content: center;

            svg {
                width: 26px;
                height: 26px;
            }
        }

        &--content {
            p {
                margin-top: 0;
                margin-bottom: 6px;
                color: rgb(123, 123, 123);
            }

            span {
                font-size: 18px;
                font-weight: 600;
            }
        }

        &:hover,
        &:focus {
            outline: 2px solid #000;
        }
    }
}
</style>