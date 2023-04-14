<template>
    <div class="banner">
        <div class="content">
            <div class="content--text">
                <h1>25%</h1>
                <h2>Today's Special!</h2>
                <p>Get discount for every order, only valid for today.</p>
            </div>
            <div class="content--img">
                <img src="@/assets/banner/product3-featured-img-removebg-preview 1.png" alt="">
            </div>
        </div>
    </div>
</template>
  
<script>
export default {

}
</script>
  
<style lang="scss" scoped>
.banner {
    display: flex;
    flex-direction: column;
    margin: 0;
    margin: auto;
    letter-spacing: normal;
    background-color: #d02828;
    border-radius: 35px;
    padding: 10px 20px;
    font-family: system-ui;

    .content {
        display: flex;

        &--text {
            width: 60%;
            color: #fff;

            h1 {
                margin-top: 15px;
                font-size: 40px;
                font-weight: 600;
            }

            h2 {
                margin: 10px 0;
                font-size: 22px;
                letter-spacing: -1px;
            }

            p {
                font-size: 13px;
                margin-bottom: 15px;
            }
        }

        &--img {
            display: flex;
            width: 40%;
            justify-content: flex-end;
            align-items: center;

            img {
                float: right;
                width: 100%;
            }
        }
    }
}
</style>