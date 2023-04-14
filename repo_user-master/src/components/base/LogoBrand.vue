<template>
    <div class="brand" @click="goType()">
        <div class="logo" v-for="(item, index) in items" :key="index">
            <div class="logo--img">
                <img :src="item.url_img" alt="">
            </div>
            <div class="logo--text">
                <p>{{ item.name }}</p>
            </div>
        </div>
    </div>
</template>
  
<script>
export default {
    data() {
        return {
            items: [
                {
                    name: 'Nike',
                    url_img: require("@/assets/logo/nike_logo.png")
                },
                {
                    name: 'New Balance',
                    url_img: require("@/assets/logo/newbalance_logo.png")
                },
                {
                    name: 'Adidas',
                    url_img: require("@/assets/logo/adidas_logo.png")
                },
                {
                    name: 'Puma',
                    url_img: require("@/assets/logo/puma_logo.png")
                },
                {
                    name: 'Reebok',
                    url_img: require("@/assets/logo/reebok-logo.png")
                },
                {
                    name: 'Converse',
                    url_img: require("@/assets/logo/converse_logo.png")
                },
            ]
        }
    },
    methods: {
        goType() {
            this.$router.push('/type');
        }
    }
}
</script>
  
<style lang="scss" scoped>
.brand {
    display: flex;
    flex-wrap: wrap;
    font-family: system-ui;

    .logo {
        width: 25%;
        gap: 10px;

        &--img {
            background-color: rgba(204, 204, 204, 0.2705882353);
            border-radius: 50%;
            display: flex;
            width: 60px;
            height: 60px;
            justify-content: center;
            align-items: center;
            margin: auto;

            img {
                width: 50%;
                height: 35%;
            }
        }

        &--text {
            font-size: 16px;
            text-align: center;
            padding-top: 10px;
            font-weight: bold;
            margin-bottom: 20px;

            p {
                overflow: hidden;
                white-space: nowrap;
                text-overflow: ellipsis;
            }
        }
    }
}
</style>