<template>
    <div class="form">
        <div class="header">
            <div class="header__intro">
                <div class="header__intro--img">
                    <img src="@/assets/avatar.png" alt="">
                </div>
                <div class="header__intro--text">
                    <p>{{ greet }}<font-awesome-icon icon="fa-solid fa-hand-peace" /></p>
                    <span>andrem</span>
                </div>
            </div>
            <div class="header__btn">
                <font-awesome-icon icon="fa-regular fa-bell" @click="goNotification()" />
                <font-awesome-icon icon="fa-regular fa-heart" @click="goMyWishlist()" />
            </div>
        </div>

        <Search class="input-vue" value=“Redirect”></Search>

        <div class="intro">
            <h2>Special Offers</h2>
            <button @click="goBanner()">See All</button>
        </div>

        <BannerOffer class="boxshadow"></BannerOffer>

        <LogoBrand/>

        <div class="intro">
            <h2>Most Popular</h2>
            <button @click="goPopular()">See All</button>
        </div>

        <NameBrand/>

        <Product/>

        <NavFooter/>
    </div>
</template>
  
<script>
import BannerOffer from '@/components/base/BannerOffer'
import Search from '@/components/base/Search'
import LogoBrand from '@/components/base/LogoBrand'
import NavFooter from '@/components/base/NavFooter'
import Product from '@/components/base/Product'
import NameBrand from '@/components/base/NameBrand'

export default {
    components: {
        BannerOffer,
        Search,
        LogoBrand,
        NavFooter,
        Product,
        NameBrand
    },
    computed: {
        greet() {
            return new Date().getHours() >= 12 ? 'Good Afternoon' : 'Good Morning';
        }
    },
    methods: {
        goBanner() {
            this.$router.push('/offers');
        },
        goPopular() {
            this.$router.push('/popular');
        },
        goNotification() {
            this.$router.push('/notifications');
        },
        goMyWishlist() {
            this.$router.push('/wishlist');
        }
    }
}
</script>
  
<style lang="scss" scoped>
.form {
    display: flex;
    flex-direction: column;
    padding-top: 10px;
    width: 90%;
    margin: auto;
    letter-spacing: normal;
    font-family: system-ui;

    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding-top: 15px;

        &__intro {
            display: flex;

            &--img {
                width: 30%;

                img {
                    width: 80%;
                    border-radius: 50%;
                }
            }

            &--text {
                display: flex;
                flex-direction: column;
                justify-content: space-around;

                p {
                    font-size: 16px;
                    color: rgb(123, 123, 123);
                }

                svg {
                    color: rgb(239 162 68);
                }

                span {
                    font-size: 18px;
                    font-size: 18px;
                    font-weight: 600;
                }
            }
        }

        &__btn {
            display: flex;
            width: 30%;
            gap: 20px;

            svg {
                height: 24px;
            }
        }
    }

    .input-vue {
        margin-bottom: 20px;
    }

    .intro {
        display: flex;
        margin-bottom: 20px;
        justify-content: space-between;

        h2 {
            letter-spacing: -0.5px;
            font-size: 20px;
            font-weight: 600;
        }

        button {
            font-size: 16px;
            border: navajowhite;
            background-color: #fff;
            font-weight: 600;
            text-decoration: underline;
        }
    }

    .boxshadow {
        box-shadow: rgba(0, 0, 0, 0.45) 0px 25px 20px -20px;
        margin-bottom: 20px;
    }
}
</style>