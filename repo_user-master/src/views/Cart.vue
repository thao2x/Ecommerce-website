<template>
    <div class="cart">
        <!-- Hiển thị loading khi đang xử lý -->
        <template v-if="loading">
            <Loading />
        </template>

        <template v-else>
            <!-- Header -->
            <div class="header">
                <div class="header__title">
                    <img src="@/assets/picwish.png" alt="picwish">
                    <p>My Cart</p>
                </div>
            </div>

            <!-- List item -->
            <div class="cart__card" >
                <template v-for="(item, index) in items">
                    <div class="cart" :key="index">
                        <div class="cart__img" @click="goToPageById('product', item.variant.product.id)">
                            <img :src="item.variant.product.images[0]?.src" />
                        </div>
                        <div class="cart__info">
                            <div class="cart__info--title">
                                <p @click="goToPageById('product', item.variant.product.id)">{{ item.variant.product.name }}</p>
                                <font-awesome-icon icon="fa-solid fa-trash-can" @click="showPupupDelete(item)" />
                            </div>
                            <div class="cart__info--size">
                                <p>Size: {{ item.variant.size }}</p>
                            </div>
                            <div class="cart__info--price">
                                <p>${{ (item.variant.product.price * item.quantity).toLocaleString("en-IN") }}</p>
                                <div class="icon">
                                    <font-awesome-icon icon="fa-solid fa-minus" @click="giam(item)" />
                                    <p>{{ item.quantity }}</p>
                                    <font-awesome-icon icon="fa-solid fa-plus" @click="tang(item)" />
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
            </div>

            <!-- Checkout -->
            <div class="total">
                <div class="total__text">
                    <p>Total price</p>
                    <span>${{ total.toLocaleString("en-IN") }} </span>
                </div>
                <div class="total__btn">
                    <button @click="goToPage('checkout')" :class="{ 'disabled': items.length == 0 }">
                        Checkout
                        <font-awesome-icon icon="fa-regular fa-hand-point-right" />
                    </button>
                </div>
            </div>


            <!-- Popup delete -->
            <div class="bg-popup" v-show="showPopup" @click="showPopup = !showPopup"></div>
            <div class="delete" :class="{ 'is-hiden': !showPopup }">
                <div class="delete__content">
                    <div class="delete__content--title">
                        <h3>Remove From Cart?</h3>
                    </div>
                    <div class="delete__content--card">
                        <div class="item">
                            <div class="item__img">
                                <img :src="itemDelete?.variant.product.images[0]?.src" />
                            </div>
                            <div class="item__info">
                                <div class="item__info--title">
                                    <p>{{ itemDelete?.variant.product.name }}</p>
                                </div>
                                <div class="item__info--size">
                                    <p>Size: {{ itemDelete?.variant.size }}</p>
                                </div>
                                <div class="item__info--price">
                                    <p>${{ (itemDelete?.variant.product.price *
                                        itemDelete?.quantity).toLocaleString("en-IN") }}</p>
                                    <div class="icon">
                                        <p>{{ itemDelete?.quantity }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="delete__content--btn">
                        <button class="btn--cancel" @click="showPopup = !showPopup">Cancel</button>
                        <button class="btn--remove" @click="deleteItem(itemDelete.id)">Yes, Remove</button>
                    </div>
                </div>
            </div>
        </template>
    </div>
</template>
  
<script>
import { mixin } from '@/mixin'
import { updateQuantity, deleteItemCart } from "@/api"

import Loading from '@/components/Loading'

export default {
    mixins: [mixin],
    data() {
        return {
            loading: false,
            showPopup: false,
            itemDelete: null
        }
    },
    components: {
        Loading
    },
    computed: {
        total() {
            return this.items.reduce((total, item) => total + (item.variant.product.price * item.quantity), 0);
        },
        items() {
            return this.$store.state.cartItems;
        },
    },
    methods: {
        giam: function (item) {
            if (item.quantity != 1) {
                let quantity = item.quantity - 1;
                this.changeQuantity(item.id, quantity);
            }
        },

        tang: function (item) {
            let quantity = item.quantity + 1;
            this.changeQuantity(item.id, quantity);
        },

        showPupupDelete: function (item) {
            this.itemDelete = item;
            this.showPopup = true;
        },

        deleteItem: function (itemId) {
            // Hiện loading
            this.loading = true;

            // Xóa item trong giỏ hàng
            deleteItemCart(itemId).then((response) => {
                if (response.data.success) {
                    // Lưu data cart mới vào state vuex store
                    this.$store.commit('changeCartItems', response.data.data);
                }
            }).catch(() => {
                this.items = [];
            }).finally(() => {
                // Ẩn loading
                this.loading = false;

                // Ẩn popup
                this.itemDelete = null;
                this.showPopup = false;
            })
        },

        changeQuantity: function (itemId, quantity) {
            // Hiện loading
            this.loading = true;

            // Update quantity của item trong giỏ hàng
            updateQuantity(itemId, { quantity: quantity }).then((response) => {
                if (response.data.success) {
                    // Lưu data cart mới vào state vuex store
                    this.$store.commit('changeCartItems', response.data.data);
                }
            }).catch(() => {
                this.items = [];
            }).finally(() => {
                // Ẩn loading
                this.loading = false;
            })
        }
    }
}
</script>
  
<style lang="scss" scoped>
.cart {
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

    &__card {
        height: calc(100% - (7vh + 110px));
        overflow: auto;
        background-color: inherit;
        padding: 0 5%;


        .cart {
            display: flex;
            align-items: center;
            gap: 10px;
            height: 12vh;
            padding: 15px;
            margin-bottom: 20px;
            background-color: #fff;
            border-radius: 35px;

            &__img {
                width: 40%;
                height: 100%;
                margin: auto;

                img {
                    width: 80%;
                    height: 100%;
                    border-radius: 35px;
                    object-fit: cover;
                }
            }

            &__info {
                width: 60%;
                display: flex;
                flex-direction: column;
                height: 100%;
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

                    .icon {
                        display: flex;
                        gap: 15px;
                        padding: 10px 15px;
                        background-color: #cfcfcf3b;
                        border-radius: 30px;

                        svg {
                            width: 15px;
                            height: 15px;
                        }

                        p {
                            font-size: 16px;
                        }
                    }

                }
            }

        }
    }

    .total {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 25px 0;
        width: 100%;
        border-top: 0.5px solid rgba(107, 102, 102, 0.3411764706);
        background-color: #fff;
        border-top-left-radius: 30px;
        border-top-right-radius: 30px;
        height: 50px;

        &__text {
            padding-left: 5%;

            p {
                margin-bottom: 10px;
            }

            span {
                font-size: 22px;
                font-weight: 500;
            }
        }

        &__btn {
            padding-right: 5%;
            width: 60%;

            button {
                background-color: #000;
                border: none;
                border-radius: 30px;
                width: 100%;
                padding: 15px 30px;
                font-size: 18px;
                color: #fff;
                box-shadow: 5px 10px 18px #888888;

                svg {
                    color: #fff;
                    padding-left: 10px;
                }                

                &.disabled {
                    background-color: #888888;
                    cursor: not-allowed;
                }
            }
        }
    }

    .bg-popup {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        z-index: 1;
    }

    .delete {
        position: fixed;
        z-index: 2;
        transition: all ease 0.8s;
        width: 100%;
        bottom: 0;

        &.is-hiden {
            transform: translateY(500px);
        }

        &__content {
            border-top-right-radius: 40px;
            border-top-left-radius: 40px;
            background-color: #fff;
            width: 100%;
            margin: auto;
            -webkit-animation-duration: 1s;
            animation-duration: 0.7s;
            background-color: #f5f5f5;

            &--title {
                width: 90%;
                margin: auto;

                h3 {
                    padding: 25px 0;
                    font-size: 22px;
                    font-weight: 500;
                    text-align: center;
                }
            }

            &--card {
                width: 90%;
                margin: auto;

                .item {
                    display: flex;
                    align-items: center;
                    gap: 10px;
                    height: 12vh;
                    padding: 15px;
                    margin-bottom: 20px;
                    background-color: #fff;
                    border-radius: 35px;

                    &__img {
                        width: 40%;
                        height: 100%;
                        margin: auto;

                        img {
                            width: 80%;
                            height: 100%;
                            border-radius: 35px;
                        }
                    }

                    &__info {
                        width: 60%;
                        display: flex;
                        flex-direction: column;
                        height: 100%;
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

                            .icon {
                                display: flex;
                                gap: 15px;
                                padding: 10px 15px;
                                background-color: #cfcfcf3b;
                                border-radius: 30px;

                                svg {
                                    width: 15px;
                                    height: 15px;
                                }

                                p {
                                    font-size: 16px;
                                }
                            }

                        }
                    }

                }
            }

            &--btn {
                width: 90%;
                margin: auto;
                display: flex;
                gap: 10px;
                padding: 20px 0 40px 0;

                .btn--cancel {
                    background-color: #cfcfcf8a;
                    box-shadow: none;
                    color: #000;
                    font-size: 18px;
                    font-weight: 500;
                }

                .btn--remove {
                    font-size: 18px;
                    font-weight: 500;
                    box-shadow: 5px 5px 15px #888888;
                }

                button {
                    background-color: #000;
                    color: #fff;
                    border-radius: 50px;
                    border: none;
                    padding: 15px 20px;
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
    }
}
</style>