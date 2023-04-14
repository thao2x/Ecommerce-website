<template>
    <div class="form">
        <BackButton/>

        <div class="form__logo">
            <img src="@/assets/letsin.png" alt="" />
            <p>Let's you in</p>
        </div>

        <div class="form__continue" v-for="(item, index) in items" :key="index">
            <a href="">
                <template v-if="item.type == 'facebook'">
                    <font-awesome-icon icon="fa-brands fa-facebook" style="color: #2b78e2" />
                </template>

                <template v-if="item.type == 'google'">
                    <font-awesome-icon icon="fa-brands fa-google" style="color: #000" />
                </template>

                <template v-if="item.type == 'apple'">
                    <font-awesome-icon icon="fa-brands fa-apple" style="color: #000" />
                </template>

                <p>{{ item.text }}</p>
            </a>
        </div>

        <div class="form__line">
            <p class="form__line--row"></p>
            <p class="form__line--text">or</p>
            <p class="form__line--row"></p>
        </div>

        <router-link :to="'/sign-in'">
            <ButtonVue :value="'Sign in with password'"></ButtonVue>
        </router-link>

        <p class="form__signup">
            Don't have an acccount? <a href="/sign-up">Sign up</a>
        </p>
    </div>
</template>
  
<script>
import BackButton from "@/components/base/BackButton";
import ButtonVue from "@/components/base/Button";
export default {
    components: {
        BackButton,
        ButtonVue,
    },
    data() {
        return {
            items: [
                { text: "Continue with Facebook", type: "facebook" },
                { text: "Continue with Google", type: "google" },
                { text: "Continue with Apple", type: "apple" },
            ],
        };
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
            max-width: 200px;
            margin: 35px 0;
        }

        p {
            font-size: 32px;
            font-family: system-ui;
            font-weight: 1000;
        }
    }

    &__continue {
        font-family: system-ui;
        font-size: 17px;
        font-weight: 600;
        border: none;
        padding: 12px 0px;
        margin-bottom: 20px;
        border: 1px solid#cccccc45;
        border-radius: 15px;

        &:focus-visible {
            outline: 2px solid #686565;
        }

        a {
            display: flex;
            justify-content: center;
            align-items: center;
            text-decoration: none;

            svg {
                width: 24px;
                height: 24px;
                padding-right: 10px;
            }

            p {
                color: #000;
                font-size: 14px;
            }
        }
    }

    &__line {
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;

        &--text {
            font-size: 15px;
            font-weight: 600;
            color: #6b6666;
        }

        &--row {
            width: 100%;
            height: 1px;
            background-color: #cccccc45;
        }
    }

    &__signup {
        margin-top: 30px;
        color: rgba(167, 158, 158, 0.8784313725);
        text-align: center;

        a {
            text-decoration: none;
            color: #000;
        }
    }
}
</style>