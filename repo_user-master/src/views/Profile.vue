<template v-if="isLoading">
    <div>
        <div class="form">
            <!-- Header -->
            <div class="header">
                <img src="@/assets/picwish.png" alt="picwish">
                <p>Profile</p>
            </div>

            <!-- upload Pic -->
            <div class="profile-pic">
                <img :src="!srcImg ? user?.avatar : srcImg" id="photo" />
            </div>

            <!-- infor -->
            <div class="infor">
                <p>{{ user?.full_name }}</p>
                <span>{{ user?.phone }}</span>
            </div>

            <!-- content -->
            <div class="content" @click="$router.push('/fill-profile')">
                <div class="content__icon">
                    <font-awesome-icon icon="fa-regular fa-user" />
                </div>
                <div class="content__text">
                    <p>Edit Profile</p>
                    <font-awesome-icon icon="fa-solid fa-chevron-right" />
                </div>
            </div>
            <div class="content">
                <div class="content__icon">
                    <font-awesome-icon icon="fa-solid fa-location-dot" />
                </div>
                <div class="content__text">
                    <p>Address</p>
                    <font-awesome-icon icon="fa-solid fa-chevron-right" />
                </div>
            </div>
            <div class="content">
                <div class="content__icon">
                    <font-awesome-icon icon="fa-solid fa-bell" />
                </div>
                <div class="content__text">
                    <p>Notification</p>
                    <font-awesome-icon icon="fa-solid fa-chevron-right" />
                </div>
            </div>
            <div class="content">
                <div class="content__icon">
                    <font-awesome-icon icon="fa-solid fa-headphones" />
                </div>
                <div class="content__text">
                    <p>Customer Service</p>
                    <font-awesome-icon icon="fa-solid fa-chevron-right" />
                </div>
            </div>
            <div class="content">
                <div class="content__icon">
                    <font-awesome-icon icon="fa-solid fa-earth-americas" />
                </div>
                <div class="content__text">
                    <p>Language</p>
                    <font-awesome-icon icon="fa-solid fa-chevron-right" />
                </div>
            </div>
            <div class="content" @click="showPopup = !showPopup">
                <div class="content__icon">
                    <font-awesome-icon icon="fa-solid fa-right-from-bracket" class="svg" />
                </div>
                <div class="content__text">
                    <p>Logout</p>
                </div>
            </div>

        </div>
        <!-- popup Logout -->
        <div class="bg-popup" v-show="showPopup"></div>
        <div class="delete" :class="[{ 'is-hiden': !showPopup }]">
            <div class="delete__content">
                <div class="delete__content--title">
                    <h3>Logout</h3>
                </div>
                <div class="delete__content--card">
                    <p>Are you sure you want to log out?</p>
                </div>
                <div class="delete__content--btn">
					<button class="btn--cancel" @click="showPopup = !showPopup">Cancel</button>
                    <button class="btn--remove" @click="removeUser()">Yes, Logout</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    components: {
    },
    data() {
        return {
            srcImg: null,
            name: null,
            date: null,
            inputType: 'text',
            showPopup: false,
            isLoading: false
        };
    },
    computed: {
        user() {
            return this.$store.state.user;
        },
    },
    methods: {
        removeUser() {
            localStorage.removeItem('user');
            this.$router.push('/home');
            this.$store.commit('changeUser', {});
            this.$store.commit('changeCartItems', {});
            this.$store.commit('changeAddress', {});
        }
    },
}
</script>

<style lang="scss" scoped>
.bg-popup {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7);
    z-index: 1;
}

.form {
    display: flex;
    flex-direction: column;
    margin: 0;
    width: 90%;
    margin: auto;
    padding-top: 25px;
    letter-spacing: normal;
    font-family: system-ui;
    z-index: 0;

    .header {
        display: flex;
        gap: 20px;

        img {
            width: 25px;
            height: 25px;
        }

        p {
            font-size: 22px;
            font-weight: 500;
        }
    }

    .profile-pic {
        height: 120px;
        width: 120px;
        display: flex;
        align-items: center;
        margin-top: 30px;
        margin-right: auto;
        margin-left: auto;
        margin-bottom: 15px;
        overflow: hidden;
        border-radius: 50%;
        border: 1px solid grey;
        position: relative;

        #photo {
            height: 100%;
            width: 100%;
            object-fit: cover;
        }

        #file {
            display: none;
        }

        #uploadBtn {
            height: 30px;
            width: 100%;
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            text-align: center;
            background: rgba(0, 0, 0, 0.7);
            color: #fff;
            line-height: 25px;
            font-family: sans-serif;
            font-size: 12px;
            cursor: pointer;
        }
    }

    .infor {
        display: flex;
        gap: 12px;
        flex-direction: column;
        align-items: center;
        padding-bottom: 25px;
        border-bottom: 0.5px solid #6b666657;

        p {
            text-transform: capitalize;
            font-size: 22px;
            font-weight: 500;
        }

        span {
            font-size: 16px;
            font-weight: 500;
            color: #6e6e6e;
        }
    }

    .content {
        display: flex;
        align-items: center;
        padding-top: 25px;

        &__icon {
            width: 10%;

            svg {
                width: 20px;
                height: 25px;
            }

            .svg {
                color: red;
            }
        }

        &__text {
            width: 90%;
            display: flex;
            justify-content: space-between;

            p {
                font-size: 18px;
                font-weight: 500;

                &:last-child {
                    color: red;
                }
            }
        }
    }
}

.is-hiden {
    transform: translateY(500px);
}

.delete {
    position: fixed;
    z-index: 2;
    transition: all ease 0.8s;
    width: 100%;
    bottom: 0;

    &__content {
        border-top-right-radius: 40px;
        border-top-left-radius: 40px;
        background-color: #fff;
        width: 100%;
        // height: 55%;
        margin: auto;
        a-webkit-animation-name: example;
        -webkit-animation-duration: 1s;
        animation-name: example;
        animation-duration: 0.7s;
        background-color: #f5f5f5;

        &--title {
            width: 90%;
            margin: auto;

            h3 {
                padding: 25px 0;
                font-size: 22px;
                font-weight: 500;
                text-align: center;
                border-bottom: 0.5px solid #6b666657;
                color: red;
            }
        }

        &--card {
            p {
                font-size: 20px;
                font-weight: 500;
                text-align: center;
                padding: 20px 0;
            }
        }

        &--btn {
            width: 90%;
            margin: auto;
            display: flex;
            gap: 10px;
            padding: 20px 0 40px 0;

            .btn--cancel {
				font-size: 18px;
                font-weight: 500;
				box-shadow: none;
				background-color: #cfcfcf8a;
				color: #000;
                border-radius: 50px;
                border: none;
                padding: 15px 20px;
                width: 100%;
                box-shadow: 5px 10px 18px #888888;
                font-size: 20px;
                font-family: system-ui;
                font-weight: 500;
                transition: all .5s;
            }

            .btn--remove {
                font-size: 18px;
                font-weight: 500;
                box-shadow: 5px 5px 15px #888888;
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
        }
    }
}
</style>