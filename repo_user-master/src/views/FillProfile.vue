<template>
    <div class="form">
        <template v-if="loading">
            <Loading />
        </template>
        <div class="back">
            <BackButton :value="'Fill Your Profile'"></BackButton>
        </div>
        <div class="content">
            <div class="profile-pic">
                <div class="pic--upload">
                    <img :src="!srcImg ? getCurrentImage(user?.avatar) : srcImg" id="photo" />
                    <input type="file" id="file" @change="changeImg($event)" />
                    <label for="file" id="uploadBtn">Choose Photo</label>
                </div>
            </div>

            <div class="input-group">
                <input placeholder="Full Name" type="text" v-model="user.full_name" />
            </div>

            <div class="input-group">
                <input placeholder="Nickname" type="text" v-model="user.nick_name" />
            </div>

            <div class="input-group">
                <input placeholder="Email" type="text" v-model="user.email" />
            </div>

            <div class="input-group">
                <input type="text" placeholder="Date of Birth" onfocus="(this.type='date')" v-model="user.dob">
            </div>

            <div class="input-group">
                <input placeholder="Phone Number" v-model="user.phone" type="number" />
            </div>

            <div class="select-group">
                <select class="select-custom" v-model="user.gender">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>

            <button @click="changeProfile()">Continue</button>
        </div>
    </div>
</template>
  
<script>
import BackButton from "@/components/BackButton";
import Loading from '@/components/Loading'
import { updateUser } from "@/api";
import { mixin } from '@/mixin'

export default {
    name: "FillProfile",
    mixins: [mixin],
    components: {
        BackButton,
        Loading
    },
    data() {
        return {
            srcImg: '',
            url_default: '',
            loading: false,
        };
    },
    computed: {
        user() {
            return this.$store.state.user;
        }
    },
    methods: {
        // when we choose a foto to upload
        changeImg: function (e) {
            const self = this;
            const choosedFile = e.target.files[0]; //this refers to file
            if (choosedFile) {
                const reader = new FileReader(); //FileReader is a predefined function of JS
                reader.addEventListener("load", function () {
                    self.srcImg = reader.result;
                });
                reader.readAsDataURL(choosedFile);
            }

            // Lưu avatar đã chọn
            this.user.image = choosedFile;
        },
        changeProfile: function () {
            // Hiện loading
            this.loading = true;

            updateUser(this.user).then((response) => {

                if (response.data.success) {
                    // Lưu thông tin user vào vuex store
                    this.$store.commit('changeUser', response.data.data);

                    // Redirect về lại trang profile
                    this.goToPage('profile');
                } else {
                    // Hiển thị lỗi khi đăng nhập [Validate]
                    console.log(response.data);
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
    letter-spacing: normal;
    font-family: system-ui;
    height: 100vh;

    .back {
        height: 60px;
        display: flex;
        align-items: center;
        top: 0;
        background-color: #fff;
        z-index: 1;
        padding: 0 5%;
    }

    .content {
        padding: 0 5%;
        height: calc(100% - 60px);
        overflow: auto;

        .profile-pic {
            height: 140px;
            display: flex;
            align-items: center;
            justify-content: center;

            .pic--upload {
                border-radius: 50%;
                border: 1px solid grey;
                overflow: hidden;
                position: relative;

                #photo {
                    height: 120px;
                    width: 120px;
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
        }

        .input-group {
            width: 100%;
            margin-bottom: 20px;

            input {
                font-family: system-ui;
                font-size: 17px;
                font-weight: 400;
                width: calc(100% - 20px);
                border: none;
                padding: 17px 0px;
                padding-left: 20px;
                background-color: #cccccc45;
                border-radius: 15px;

                &:focus-visible {
                    outline: 2px solid #686565;
                }
            }
        }

        .select-group {
            width: 100%;
            margin-bottom: 20px;

            .select-custom {
                font-family: system-ui;
                font-size: 17px;
                font-weight: 400;
                width: calc(100% - 0px);
                border: none;
                padding: 17px 0px;
                padding-left: 20px;
                background-color: #cccccc45;
                border-radius: 15px;
                appearance: none;
                background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
                background-repeat: no-repeat;
                background-position: right 1rem center;
                background-size: 1em;


                &:focus-visible {
                    outline: 2px solid #686565;
                }
            }
        }

        button {
            background-color: #000;
            color: #fff;
            border-radius: 50px;
            border: none;
            padding: 15px 20px;
            margin: 40px 0;
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
</style>