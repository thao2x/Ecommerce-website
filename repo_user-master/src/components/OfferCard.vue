<template>
    <div class="banner" :style="{ backgroundColor: color }">
        <div class="content">
            <div class="content--text">
                <h1>{{ promo.percentage }}%</h1>
                <h2>Today's Special!</h2>
                <p>{{ promo.description }}</p>
            </div>
            <div class="content--img">
                <img :src="image">
            </div>
        </div>
    </div>
</template>
  
<script>
export default {
    props: {
        promo: {
            type: Object,
            required: true,
        },

        color: {
            type: String,
            default: '#00a8ff'
        },

        image: {
            type: String,
            default: 'https://png.pngtree.com/png-clipart/20230414/original/pngtree-colorful-diorama-of-sneakers-png-image_9057177.png'
        }
    }
}
</script>
  
<style lang="scss" scoped>
.banner {
    display: flex;
    flex-direction: column;
    margin: 0;
    margin: auto;
    letter-spacing: normal;
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