<template>
    <div class="form">
        <BackButton :value="'Fill Your Profile'"></BackButton>

        <div class="profile-pic">
            <img :src="!srcImg ? url_default : srcImg" id="photo" />
            <input type="file" id="file" @change="changeImg($event)" />
            <label for="file" id="uploadBtn">Choose Photo</label>
        </div>

        <InputVue class="input-vue" :placeholder="'Full name'" :type="'text'" @keyPress="name = $event"></InputVue>
        <InputVue class="input-vue" :placeholder="'Nick name'" :type="'text'" @keyPress="name = $event"></InputVue>
        <InputVue class="input-vue" :placeholder="'Email'" :type="'text'" @keyPress="mail = $event"></InputVue>
        <InputVue class="input-vue" :placeholder="'getDateStr()'" :type="inputType" @onFocus="inputType = 'date'"
            @keyPress="date = $event"></InputVue>
        <InputVue class="input-vue" :placeholder="getDateStr()" :type="'text'" @focus="(this.type = 'date')"
            @keyPress="date = $event"></InputVue>
        <InputVue class="input-vue" :placeholder="getDateStr()" :type="'text'" @focus="(this.type = 'date')"
            @keyPress="date = $event"></InputVue>
        <ButtonVue :value="'Continue'" @onClick="onClick($event)" class="buttonVue"></ButtonVue>
    </div>
</template>
  
<script>
import BackButton from "@/components/base/BackButton";
import ButtonVue from "@/components/base/Button";
import InputVue from "@/components/base/Input";

export default {
    name: "FillProfile",
    components: {
        BackButton,
        InputVue,
        ButtonVue
    },
    data() {
        return {
            url_default: require("@/assets/avatar.png"),
            srcImg: null,
            name: null,
            date: null,
            inputType: 'text'
        };
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
        },
        getDateStr() {
            let s = new Date().toLocaleDateString();
            return s
        },
        onClick: function (data) {
            console.log(data);
            this.$router.push({ name: 'new-pin' });
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

    .profile-pic {
        height: 120px;
        width: 120px;
        display: flex;
        align-items: center;
        margin-top: 65px;
        margin-right: auto;
        margin-left: auto;
        margin-bottom: 30px;
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

    .input-vue {
        margin-bottom: 20px;
    }

    .buttonVue {
        margin: 30px 0;
    }
}
</style>