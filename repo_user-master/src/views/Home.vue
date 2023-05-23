<template>
    <div class="home">
        <!-- Header -->
        <div class="header">
            <div class="header__intro">
                <div class="header__intro--img" @click="goToPage('profile')">
                    <template v-if="user?.avatar">
                        <img :src="getCurrentImage(user?.avatar)" />
                    </template>
                    <template v-else>
                        <img :src="avatar" />
                    </template>
                </div>
                <div class="header__intro--text" @click="goToPage('profile')">
                    <p>{{ greet }}<font-awesome-icon icon="fa-solid fa-hand-peace" /></p>
                    <span>{{ user?.nick_name }}</span>
                </div>
            </div>
            <div class="header__btn">
                <font-awesome-icon icon="fa-regular fa-bell" @click="goToPage('notification')" />
                <font-awesome-icon icon="fa-regular fa-heart" />
            </div>
        </div>

        <!-- Search -->
        <div class="search">
            <font-awesome-icon icon="fa-solid fa-magnifying-glass" />
            <input placeholder="Search" type="text" v-model="searchKey" @keyup.enter="handleSearch(searchKey)" />
        </div>

        <!-- Intro -->
        <div class="intro">
            <h2>Special Offers</h2>
            <button @click="goToPage('offer')">See All</button>
        </div>

        <!-- BannerOffer -->
        <div class="banner" :style="{ backgroundColor: colors[Math.floor(Math.random() * 6)] }">
            <div class="content">
                <div class="content--text">
                    <h1>{{ promos[0]?.percentage }}%</h1>
                    <h2>Today's Special!</h2>
                    <p>{{ promos[0]?.description }}</p>
                </div>
                <div class="content--img">
                    <img :src="images[Math.floor(Math.random() * 6)]">
                </div>
            </div>
        </div>

        <!-- Logo brand -->
        <div class="logo-brand">
            <div class="logo" v-for="(category, index) in categories" :key="index"
                @click="goToPageById('category', category.id)">
                <div class="logo--img">
                    <img :src="getCurrentImage(category.image)">
                </div>
                <div class="logo--text">
                    <p>{{ category.name }}</p>
                </div>
            </div>
        </div>

        <!-- Intro -->
        <div class="intro">
            <h2>Most Popular</h2>
        </div>

        <!-- Popular brand -->
        <div class="popular-brand">
            <div class="popular-brand__item" v-for="(item, index) in popularsTab" :key="index"
                :class="{ active: activePopular == item.id }" @click="setActive(item.id)">
                <p>{{ item.name }}</p>
            </div>
        </div>

        <!-- Products popular -->
        <div class="product">
            <Product class="product__card" :product="product" v-for="(product, index) in populars" :key="index" />
        </div>

        <!-- Loading -->
        <Loading v-if="loading" />
    </div>
</template>
  
<script>
import { mixin } from '@/mixin'

import Loading from '@/components/Loading'
import Product from '@/components/ProductCard'

import { getPopularById, getPopulars } from "@/api"

export default {
    mixins: [mixin],
    data() {
        return {
            avatar: require("@/assets/avatar.png"),
            loading: false,
            searchKey: "",
            activePopular: 99,
            colors: [
                '#4e5e75',
                '#633f3fde',
                '#10907e',
                '#132c85de',
                '#d02828'
            ],
            images: [
                'https://png.pngtree.com/png-clipart/20230414/original/pngtree-colorful-diorama-of-sneakers-png-image_9057177.png',
                'https://png.pngtree.com/png-vector/20230328/ourmid/pngtree-childrens-model-flat-shoes-png-image_6670735.png',
                'https://png.pngtree.com/png-vector/20230328/ourmid/pngtree-casual-shoes-kids-model-png-image_6670734.png',
                'https://png.pngtree.com/png-vector/20230328/ourmid/pngtree-childrens-model-of-sneakers-png-image_6670732.png',
                'https://png.pngtree.com/png-vector/20230414/ourmid/pngtree-colorful-cloud-gradient-creative-png-image_6698081.png',
                'https://png.pngtree.com/png-vector/20230413/ourmid/pngtree-musical-note-color-creative-png-image_6698127.png',
                'https://png.pngtree.com/png-vector/20230328/ourmid/pngtree-sneakers-color-model-png-image_6670733.png'
            ]
        }
    },
    components: {
        Loading,
        Product
    },
    computed: {
        user() {
            return this.$store.state.user;
        },

        categories() {
            return this.$store.state.categories
        },

        popularsTab() {
            return [{ id: 99, name: 'ALL' }, ...this.$store.state.categories];
        },

        promos() {
            return this.$store.state.promos;
        },

        populars() {
            return this.$store.state.populars;
        },

        greet() {
            return new Date().getHours() >= 12 ? 'Good Afternoon' : 'Good Morning';
        }
    },
    watch: {
        activePopular(newVal) {
            // Hiện loading
            this.loading = true;

            // Trường hợp chọn [ALL]
            if (newVal == 99) {
                getPopulars().then((response) => {
                    if (response.data.success) {
                        // Lưu data popular mới vào state vuex store
                        this.$store.commit('changePupulars', response.data.data);
                    }
                }).catch((error) => {
                    console.log(error.response.data.message);
                }).finally(() => {
                    // Ẩn loading
                    this.loading = false;
                })
            } else {
                getPopularById(newVal).then((response) => {
                    if (response.data.success) {
                        // Lưu data popular mới vào state vuex store
                        this.$store.commit('changePupulars', response.data.data);
                    }
                }).catch((error) => {
                    console.log(error.response.data.message);
                }).finally(() => {
                    // Ẩn loading
                    this.loading = false;
                })
            }
        }
    },
    methods: {
        handleSearch: function (key) {
            // Lưu key search vào state store
            this.$store.commit('changeKeySearch', key);

            // Di chuyển tới trang Search
            this.goToPage('search');
        },

        setActive: function (popularId) {
            this.activePopular = popularId;
        },
    }
}
</script>
  
<style lang="scss" scoped>
.home {
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
        height: 15vh;

        &__intro {
            display: flex;
            width: 80%;
            justify-content: space-between;

            &--img {
                width: 40%;
                margin: 0 auto;
                display: flex;
                align-items: center;

                img {
                    width: 100%;
                    border-radius: 50%;
                    height: 100%;
                    object-fit: cover;
                }
            }

            &--text {
                display: flex;
                flex-direction: column;
                justify-content: center;
                width: 60%;
                padding: 0 20px;

                p {
                    font-size: 16px;
                    color: rgb(123, 123, 123);
                }

                svg {
                    color: rgb(239 162 68);
                }

                span {
                    margin-top: 20px;
                    font-size: 18px;
                    font-weight: 400;
                }
            }
        }

        &__btn {
            display: flex;
            width: 20%;
            justify-content: space-evenly;
            align-items: center;

            svg {
                height: 24px;
            }
        }
    }

    .search {
        position: relative;
        width: 100%;

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

    .intro {
        display: flex;
        margin-bottom: 20px;
        margin-top: 20px;
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

    .banner {
        display: flex;
        flex-direction: column;
        margin: 0;
        margin: auto;
        letter-spacing: normal;
        box-shadow: rgba(0, 0, 0, 0.45) 0px 25px 20px -20px;
        margin-bottom: 20px;
        border-radius: 35px;
        padding: 10px 20px;
        font-family: system-ui;

        .content {
            display: flex;

            &--text {
                width: 60%;
                color: #000;

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

    .logo-brand {
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
                font-weight: 500;
                margin-bottom: 20px;

                p {
                    overflow: hidden;
                    white-space: nowrap;
                    text-overflow: ellipsis;
                }
            }
        }
    }

    .popular-brand {
        display: flex;
        overflow-x: scroll;
        gap: 12px;
        margin-bottom: 20px;
        padding-bottom: 15px;

        &__item {
            padding: 12px;
            border: 2px solid #000;
            border-radius: 30px;

            p {
                font-size: 16px;
                font-weight: 500;
                white-space: nowrap;
            }
        }

        .active {
            background-color: #000;

            p {
                color: #fff;
            }
        }
    }

    .product {
        display: flex;
        flex-wrap: wrap;
        gap: 5%;
        justify-content: space-between;
        margin-bottom: 70px;

        &__cart {
            width: 47.5%;
            margin-bottom: 20px;
        }
    }
}
</style>