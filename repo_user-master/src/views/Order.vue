<template>
    <div class="order">
        <!-- Hiển thị loading khi đang xử lý -->
        <template v-if="loading">
            <Loading />
        </template>

        <template v-else>
            <!-- Header -->
            <div class="header">
                <div class="header__title">
                    <img src="@/assets/picwish.png" alt="picwish">
                    <p>My Orders</p>
                </div>
            </div>

            <div class="content">
                <!-- Items -->
                <div class="list">
                    <h3>Order Active</h3>
                    <template v-for="(item, index) in items">
                        <div class="list__content" :key="index">
                            <div class="cart">
                                <div class="cart__img">
                                    <img :src="getCurrentImage(item?.order_items[0]?.variant?.product?.images[0]?.src)" />
                                </div>
                                <div class="cart__info">
                                    <div class="cart__info--title">
                                        <p>#{{ item?.code }}</p>
                                    </div>
                                    <div class="cart__info--price">
                                        <span>{{ item?.order_items.length }} products</span>
                                        <span>${{ (total(item?.order_items) - shipping(item.shipping.price)).toLocaleString("en-IN")}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="icon">
                                <p class="btn-success" v-if="item?.status == 1">Delivery</p>
                                <p class="btn-danger" v-if="item?.status == 2">Canceled</p>
                                <p class="btn-gray" v-if="item?.status == 0">Processing</p>
                                <p class="btn-outline-secondary" @click="goToPageById('order-detail', item?.id)">See more</p>
                            </div>
                        </div>
                    </template>

                </div>
            </div>
        </template>
    </div>
</template>

<script>
import Loading from '@/components/Loading'
import { getOrder } from "@/api";
import { mixin } from '@/mixin'

export default {
    mixins: [mixin],
    components: {
        Loading
    },
    data() {
        return {
            items: [],
            loading: true,
            value: "",
            sum: 0
        }
    },
    computed: {

    },
    created() {
        this.listOrders();
    },
    methods: {
        listOrders: function () {
            // Hiện loading
            this.loading = true;

            getOrder().then((response) => {
                if (response.data.success) {
                    this.items = response.data.data;
                }
            }).catch(() => {
            }).finally(() => {
                // Ẩn loading
                this.loading = false;
            })
        },
        total: function (data) {
            return data.reduce((total, item) => total + (item.variant.product.price * item.quantity), 0);
        },
        shipping: function (data) {
            return data;
        },
        promo: function (data) {
            // return this.total()*data/100;
        }

    }
}
</script>

<style lang="scss" scoped>
.order {
    background-color: #f5f5f5a6;
    height: calc(100vh - 70px);

    .header {
        height: 9vh;
        display: flex;
        align-items: center;
        padding: 0 5%;

        &__title {
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

        svg {
            width: 25px;
            height: 25px;
        }
    }

    .content {
        height: calc(100% - 9vh);
        overflow: auto;
        background-color: inherit;
        padding: 0 20px;

        .list {
            h3 {
                font-size: 20px;
                font-weight: 500;
                margin-bottom: 20px;
            }

            &__content {
                padding-top: 10px;
                // height: 12vh;
                padding: 15px;
                margin-bottom: 20px;
                background-color: #fff;
                border-radius: 35px;

                .cart {
                    display: flex;
                    align-items: center;
                    margin-bottom: 15px;

                    &__img {
                        width: 40%;
                        height: 100%;
                        margin: auto;

                        img {
                            width: 80%;
                            height: 12vh;
                            border-radius: 35px;
                        }
                    }

                    &__info {
                        width: 60%;
                        display: flex;
                        flex-direction: column;
                        height: 12vh;
                        justify-content: space-evenly;

                        &--title {
                            display: flex;
                            justify-content: space-between;

                            p {
                                font-size: 18px;
                                font-weight: 500;
                            }

                            svg {
                                width: 15px;
                                height: 15px;
                            }
                        }

                        &--size {

                            p {
                                font-size: 14px;
                            }
                        }

                        &--price {
                            justify-content: space-between;
                            display: flex;
                            align-items: center;
                            gap: 10px;

                            p {
                                font-size: 18px;
                                font-weight: 500;
                            }

                        }
                    }

                    &:last-child {
                        margin-bottom: 0;
                    }

                }

                .more {
                    padding: 10px 0;
                    border-bottom: 0.5px solid #6b666657;
                    border-top: 0.5px solid #6b666657;
                    text-align: center;

                    a {
                        color: #6b666657;
                        text-decoration: none;
                    }
                }

                .total {
                    padding: 10px 0;
                    border-bottom: 0.5px solid #6b666657;
                    display: flex;
                    justify-content: space-between;

                    a {
                        color: #6b666657;
                        text-decoration: none;
                    }
                }

                .icon {
                    display: flex;
                    justify-content: space-between;

                    p {
                        padding: 10px 20px;
                        background-color: #000;
                        border-radius: 20px;
                        font-size: 14px;
                        color: #fff;

                        &.btn-outline-secondary {
                            background-color: transparent;
                            color: gray;
                            border: 1px solid gray;
                        }

                        &.btn-success {
                            background-color: #2ecc71;
                        }

                        &.btn-danger {
                            background-color: #EA2027;
                        }

                        &.btn-gray {
                            background-color: #a5b1c2;
                        }
                    }
                }
            }
        }
    }
}
</style>
