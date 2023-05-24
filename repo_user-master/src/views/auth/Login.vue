<template>
    <div class="form">
        <BackButton />

        <div class="form__logo">
            <img src="@/assets/picwish.png">
            <p>Login to Your Account</p>
        </div>

        <!-- Email -->
        <div class="input-group">
            <font-awesome-icon icon="fa-solid fa-envelope" />
            <input placeholder="Email" type="text" v-model="email" @focus="errorEmail = null"/>
        </div>
        <p class="error" v-if="errorEmail">{{ errorEmail }}</p>

        <!-- Password -->
        <div class="input-group">
            <font-awesome-icon icon="fa-solid fa-lock" />
            <input placeholder="Password" type="password" v-model="password" @focus="errorPassword = null" />
        </div>
        <p class="error" v-if="errorPassword">{{ errorPassword }}</p>

        <!-- Remember -->
        <div class="remember-group">
            <input type="checkbox" v-model="remember" />
            <p>Remember me</p>
        </div>

        <button @click="handleLogin()">Sign in</button>

        <a href="/forgot-password" class="form__reset">Forgot the password?</a>
        <OtherCnt :type="'signup'"></OtherCnt>
        <!-- Loading -->
        <Loading v-if="loading" />
    </div>
</template>
  
<script>
import BackButton from '@/components/BackButton'
import Loading from '@/components/Loading'
import OtherCnt from "@/components/OtherCnt";

import { login, getCart, getAddress } from "@/api";
import { mixin } from '@/mixin'

export default {
    mixins: [mixin],
    components: {
        BackButton,
        OtherCnt,
        Loading
    },
    data() {
        return {
            loading: false,
            email: null,
            password: null,
            remember: false,
            errorEmail: null,
            errorPassword: null,
        };
    },
    methods: {
        handleLogin: function () {
            // Hiện loading
            this.loading = true;

            let data = {
                email: this.email,
                password: this.password
            }

            login(data).then((response) => {

                if (response.data.success) {
                    // Lưu data user có chứa token vào localStorage
                    localStorage.setItem('user', JSON.stringify({ token: response.data.token }));

                    // Lưu thông tin user vào vuex store
                    this.$store.commit('changeUser', response.data.data);

                    Promise.all([getCart(), getAddress()])
                        .then((result) => {
                            this.$store.commit('changeCartItems', result[0].data.data);
                            this.$store.commit('changeAddress', result[1].data.data);
                        })
                        .catch((error) => {
                            console.log(error);
                        }).finally(() => {
                            // Redirect về lại trang home
                            this.goToPage('home');
                        });

                } else {
                    // Hiển thị lỗi khi đăng nhập [Validate]
                    console.log(response.data);
                    if (response.data.errors.email.length > 0) {
                        this.errorEmail = response.data.errors.email[0];
                    }

                    if (response.data.errors.password.length > 0) {
                        this.errorPassword = response.data.errors.password[0]; 
                    }
                }
            }).catch((error) => {
                // console.log(error.response.data);
            }).finally(() => {

                // Ẩn loading
                this.loading = false;
            })
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
    padding-top: 20px;

    &__logo {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-bottom: 30px;

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

    &__reset {
        font-family: system-ui;
        font-size: 14px;
        font-weight: 600;
        color: #000;
        text-decoration: none;
        padding-top: 20px;
        text-align: center;
    }

    .input-group {
        position: relative;
        width: 100%;
        margin-bottom: 20px;

        svg {
            left: 10px;
            top: 50%;
            position: absolute;
            transform: translateY(-50%);
        }

        input {
            font-family: system-ui;
            font-size: 17px;
            font-weight: 600;
            width: calc(100% - 32px);
            border: none;
            padding: 17px 0px;
            padding-left: 32px;
            background-color: #cccccc45;
            border-radius: 15px;

            &:focus-visible {
                outline: 2px solid #686565;
            }
        }
    }

    .remember-group {
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 25px 0;

        input {
            accent-color: #000;
            width: 17px;
        }

        p {
            font-size: 18px;
            font-weight: 600;
            padding-left: 15px;
            font-family: system-ui;
        }
    }

    button {
        background-color: #000;
        color: #fff;
        border-radius: 50px;
        border: none;
        padding: 15px 20px;
        width: 100%;
        box-shadow: 5px 10px 18px #888888;
        font-size: 20px;
        font-family: system-ui;
        font-weight: 500;
        transition: all .5s;
        cursor: pointer;

        &:hover,
        &:focus {
            background-color: #fff;
            color: #000;
            outline: 2px solid #000;
        }
    }

    .error {
        color: red;
        margin-bottom: 10px;
    }
}
</style>