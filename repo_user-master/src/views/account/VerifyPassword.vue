<template>
    <div class="form">
        <BackButton :value="'Create New PIN'"></BackButton>

        <p>Code has been send to +11*******09</p>
        <div class="pin">
            <input tabindex="1" type="number" pattern="/^-?\d+\.?\d*$/"
                onKeyPress="if(this.value.length==1) return false;" />
            <input tabindex="2" type="number" pattern="/^-?\d+\.?\d*$/"
                onKeyPress="if(this.value.length==1) return false;" />
            <input tabindex="3" type="number" pattern="/^-?\d+\.?\d*$/"
                onKeyPress="if(this.value.length==1) return false;" />
            <input tabindex="4" type="number" pattern="/^-?\d+\.?\d*$/"
                onKeyPress="if(this.value.length==1) return false;" />
        </div>
        <p class="text">Resend code in {{ countDown }}s</p>

        <ButtonVue :value="'Verify'" @onClick="onClick()"></ButtonVue>
    </div>
</template>
  
<script>
import BackButton from "@/components/base/BackButton";
import ButtonVue from "@/components/base/Button";
import Congrats from "@/components/popup/Congrats";

export default {
    components: {
        BackButton,
        ButtonVue,
        Congrats
    },
    data() {
        return {
            countDown: 30
        };
    },
    computed: {
        timerCount() {
            return this.time--;
        }
    },
    methods: {
        countDownTimer() {
            if (this.countDown > 0) {
                setTimeout(() => {
                    this.countDown -= 1;
                    this.countDownTimer();
                }, 1000);
            };
        },
        onClick: function () {
            this.$router.push({ path: '/new-password' });
        },
    },
    created() {
        this.countDownTimer();
    }
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
        font-weight: 500;
    }

    .text {
        margin-top: 0px;
        margin-bottom: 100px;
    }

    .pin {
        display: flex;
        gap: 10px;
        margin-top: 60px;
        margin-bottom: 60px;

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
}</style>