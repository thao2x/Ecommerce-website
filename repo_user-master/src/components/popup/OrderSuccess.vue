<template>
    <div class="form">
        <div class="cnt" id="qr1">
            <div class="ctn_content">
                <img src="@/assets/orderSuccess.png" alt="" />
                <p>Order Successfull!</p>
                <span>You have successfully made order.</span>
                <button @click="$router.push('/')">OK</button>
            </div>
        </div>
    </div>
</template>
  
<script>
export default {
    // mounted() {
    //     const self = this; // Phải định nghĩa như này bởi vì this trong function của js nó đang trùng với this trong vue
    //     setTimeout(function () {
    //         self.$router.push({ path: '/home' });
    //     }, 5000);
    // }
};
</script>
  
<style lang="scss" scope>
.cnt {
    overflow: hidden;
    position: fixed;
    left: 0;
    right: 0;
    background-color: rgba(0, 0, 0, 0);
    z-index: 9999;
    transition: 0.8s;
    font-family: system-ui;
    display: flex;
    width: auto;
    height: auto;
    top: 0;
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.7);
}

.ctn_content {
    font-family: system-ui;
    border-radius: 36px;
    background-color: #fff;
    width: 80%;
    height: 50%;
    margin: auto;
    a-webkit-animation-name: example;
    -webkit-animation-duration: 1s;
    animation-name: example;
    animation-duration: 0.5s;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;

    img {
        width: 60%;
        height: 40%;
    }

    p {
        width: 85%;
        text-align: center;
        font-size: 22px;
        font-weight: bold;
        margin: 20px 0;
    }

    button {
        background-color: #000;
        color: #fff;
        border-radius: 50px;
        border: none;
        padding: 15px 20px;
        width: 80%;
        box-shadow: 5px 10px 18px #888888;
        font-size: 20px;
        font-family: system-ui;
        font-weight: 500;
        transition: all 0.5s;
        cursor: pointer;
        margin: 30px 0;

        &:hover,
        &:focus {
            background-color: #fff;
            color: #000;
            outline: 2px solid #000;
        }
    }
}
</style>