<template>
    <div class="external-link">
        <p class="text">or continue with</p>
        <div class="icon">
            <div class="icon__detail">
                <font-awesome-icon icon="fa-brands fa-facebook" style="color: #2b78e2" />
            </div>
            <div class="icon__detail">
                <font-awesome-icon icon="fa-brands fa-google" />
            </div>
            <div class="icon__detail">
                <font-awesome-icon icon="fa-brands fa-apple" />
            </div>
        </div>
        <div class="other">
            <p>{{ description }}</p>
            <span @click="goToPage()">{{ text }}</span>
        </div>
    </div>
</template>
  
<script>
import VueRouter from 'vue-router'
const { isNavigationFailure, NavigationFailureType } = VueRouter

export default {
    props: {
        type: {
            type: String,
            required: true
        },
    },
    computed: {
        text() {
            return this.type == 'signin' ? 'Sign In' : 'Sign Up';
        },
        description() {
            return this.type == 'signup' ? 'Don\'t have an account ?' : 'Already have an account ?';
        }
    },
    methods: {
        goToPage: function () {
            const routerName = this.type == 'signin' ? 'login' : 'register';
            this.$router.push({ name: routerName }).catch((error) => {
                if (!isNavigationFailure(error, NavigationFailureType.redirected)) {
                    Promise.reject(error)
                }
            });
        }
    }
}
</script>
  
<style lang="scss" scoped>
.external-link {
    font-family: system-ui;
    padding-top: 40px;

    .text {
        font-size: 12px;
        font-weight: 600;
        color: #6b6666;
        text-decoration: none;
        text-align: center;
    }

    .icon {
        display: flex;
        justify-content: center;
        gap: 20px;
        padding-top: 20px;

        &__detail {
            svg {
                width: 24px;
                height: 24px;
                padding: 10px 20px;
                outline: 2px solid rgba(167, 158, 158, 0.2588235294);
                border-radius: 12px;
                cursor: pointer;
                transition: all 0.5s;

                &:hover,
                &:focus {
                    outline: 2px solid #000;
                }
            }
        }
    }

    .other {
        padding: 20px 0;
        display: flex;
        justify-content: center;
        font-weight: 600;
        gap: 10px;
        font-size: 12px;
        cursor: pointer;

        p {
            color: #a79e9ee0;
            transition: all .5s;

            &:hover,
            &:focus {
                color: #000;
            }
        }

        span {
            color: #000;
            transition: all .5s;

            &:hover,
            &:focus {
                color: #a79e9ee0;
            }
        }
    }
}
</style>