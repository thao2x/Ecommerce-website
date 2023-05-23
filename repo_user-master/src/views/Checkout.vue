<template>
    <div class="checkout">
        <!-- Hiển thị loading khi đang xử lý -->
        <template v-if="loading">
            <Loading />
        </template>

        <template v-else>
            <!-- Header -->
            <div class="header">
                <BackButton :value="'Checkout'"></BackButton>
            </div>

            <!-- Content -->
            <div class="content">
                <!-- Shipping address -->
                <div class="location">
                    <h3>Shipping Address</h3>
                    <div class="location__address">
                        <div class="location__address--icon">
                            <font-awesome-icon icon="fa-solid fa-location-dot" />
                        </div>
                        <div class="location__address--text">
                            <p>{{ address?.name }}</p>
                            <span>{{ address?.details }}</span>
                        </div>
                        <div class="location__address--edit">
                            <font-awesome-icon icon="fa-solid fa-pen" @click="showEditAddress = !showEditAddress" />
                        </div>
                    </div>
                </div>

                <!-- Items -->
                <div class="list">
                    <h3>Order List</h3>

                    <div class="list__content">
                        <template v-for="(item, index) in items">
                            <div class="cart" :key="index">
                                <div class="cart__img">
                                    <img :src="getCurrentImage(item?.variant?.product?.images[0]?.src)" />
                                </div>
                                <div class="cart__info">
                                    <div class="cart__info--title">
                                        <p>{{ item?.variant?.product?.name }}</p>
                                    </div>
                                    <div class="cart__info--size">
                                        <p>Size: {{ item?.variant?.size }}</p>
                                    </div>
                                    <div class="cart__info--price">
                                        <p>${{ (item?.variant?.product?.price * item?.quantity).toLocaleString("en-IN") }}
                                        </p>
                                        <div class="icon">
                                            <p>{{ item?.quantity }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>

                <!-- Choose Shipping Type -->
                <div class="shipping">
                    <h3>Choose Shipping</h3>
                    <div class="shipping__type">
                        <select class="select-custom" v-model="shipping">
                            <option :value="item.id" v-for="(item, index) in shippings" :key="index">{{ item?.name }}
                            </option>
                        </select>
                    </div>
                </div>

                <!-- Promo -->
                <div class="promo">
                    <h3>Promo Code</h3>
                    <div class="promo__code">
                        <select class="select-custom" v-model="promo">
                            <option :value="item.id" v-for="(item, index) in promos" :key="index">{{ item?.name }}</option>
                        </select>
                    </div>
                </div>


                <!-- Total -->
                <div class="price">
                    <div class="total">
                        <div class="total__amount">
                            <span>Amount</span>
                            <p>${{ amount?.toLocaleString("en-IN") }}</p>
                        </div>
                        <div class="total__shipping">
                            <span>Shipping</span>
                            <p>${{ shippingFee?.toLocaleString("en-IN") }}</p>
                        </div>
                        <div class="total__promo">
                            <span>Promo</span>
                            <p>${{ promoFee?.toLocaleString("en-IN") }}</p>
                        </div>
                        <div class="total__final">
                            <span>Total</span>
                            <p>${{ total?.toLocaleString("en-IN") }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="footer">
                <button @click="complete()">
                    <font-awesome-icon :icon="['fas', 'gift']" />
                    Order</button>
            </div>
        </template>

        <!-- Popup edit address -->
        <div class="content-x" v-if="showEditAddress"></div>
        <div class="table" :class="[{ 'is-hiden': !showEditAddress }]">
            <h2>Edit Address</h2>
            <div class="input-group">
                <input placeholder="City" type="text" v-model="address.name" />
            </div>
            <div class="input-group">
                <input placeholder="Detail" type="text" v-model="address.details" />
            </div>
            <div class="edit--btn">
                <button class="btn--cancel" @click="showEditAddress = !showEditAddress">Cancel</button>
                <button class="btn--remove" @click="handleUpdateAddress()">Ok</button>
            </div>
        </div>

        <!-- Popup order success -->
        <div class="cnt" id="qr1" v-if="success">
            <div class="ctn_content">
                <img src="@/assets/orderSuccess.png" alt="" />
                <p>Order Successfull!</p>
                <span>You have successfully made order.</span>
                <button @click="nextPage()" :class="{ loadingButton: isActive }">
                    <LoadingButton v-if="isActive == false" />
                    OK
                </button>
            </div>
        </div>
    </div>
</template>
  
<script>
import { mixin } from '@/mixin'
import Loading from '@/components/Loading'
import BackButton from '@/components/BackButton'
import LoadingButton from '@/components/LoadingButton.vue'

import { updateAddress, getPromos, getShippings, addOrder } from "@/api";

export default {
    mixins: [mixin],

    data() {
        return {
            showEditAddress: false,
            success: false,
            isActive: false,
            promos: [],
            shippings: [],
            loading: false,
            promo: null,
            shipping: null
        }
    },

    components: {
        BackButton,
        Loading,
        LoadingButton
    },

    created() {
        this.init();
    },

    computed: {
        items() {
            return this.$store.state.cartItems;
        },

        address() {
            return this.$store.state.address;
        },

        amount() {
            if (this.items && this.items.length > 0) {
                return this.items.reduce((total, item) => total + (item.variant.product.price * item.quantity), 0);
            }

            return 0;
        },

        shippingFee() {
            if (this.shipping && this.shippings.length > 0) {
                let shippings = this.shippings.filter(item => item.id == this.shipping);
                return shippings[0]?.price;
            }

            return 0;
        },

        promoFee() {
            if (this.promo && this.promos.length > 0) {
                let promos = this.promos.filter(item => item.id == this.promo);
                let percentage = promos[0]?.percentage;
                return percentage / 100 * this.amount;
            }

            return 0;
        },

        total() {
            return this.amount + this.shippingFee - this.promoFee;
        },
    },

    methods: {
        init: function () {
            const self = this;

            // Hiện loading
            self.loading = false;

            Promise.all([getPromos(), getShippings()])
                .then((result) => {
                    self.promos = result[0].data.data;
                    self.shippings = result[1].data.data;

                    self.shipping = result[1].data.data[0].id;
                })
                .catch((error) => {
                    console.log(error);
                }).finally(() => {
                    // Ẩn loading
                    self.loading = false;
                });
        },

        handleUpdateAddress: function () {
            // Hiện loading
            this.loading = true;
            let data = {
                name: this.address.name,
                details: this.address.details
            }
            // Update quantity của item trong giỏ hàng
            updateAddress(data, this.address.id).then((response) => {
                if (response.data.success) {
                    // Lưu data cart mới vào state vuex store
                    this.$store.commit('changeAddress', response.data.data);
                }
            }).catch(() => {
            }).finally(() => {
                // Ẩn loading
                this.loading = false;
                this.showEditAddress = false;
            })
        },

        complete() {
            // Hiện popup
            this.success = true;
            let data = {
                shiping_address_id: this.address.id,
                shipping_id: this.shipping,
                promo_id: this.promo,
                variants: this.items
            }
            // Update quantity của item trong giỏ hàng
            addOrder(data).then((response) => {
                if (response.data.success) {
                    // Xóa sản phẩm tron giỏ hàng
                    this.$store.commit('changeCartItems', []);
                }
            }).catch(() => {
            }).finally(() => {
                this.isActive = true;
            })
        },

        nextPage() {
            this.goToPage('order');
        }
    }
}
</script>
  
<style lang="scss" scoped>
.checkout {
    background-color: #f5f5f5a6;
    height: 100vh;
    position: relative;

    .header {
        height: 7vh;
        display: flex;
        align-items: center;
        padding: 0 5%;
    }

    .content {
        height: calc(100% - (7vh + 100px));
        overflow: auto;
        background-color: inherit;
        padding: 0 20px;

        .location {
            border-bottom: 0.5px solid #6b666657;
            padding: 20px 0;

            h3 {
                font-size: 20px;
                font-weight: 500;
            }

            &__address {
                display: flex;
                align-items: center;
                gap: 15px;
                margin-top: 15px;
                padding: 20px 10px;
                background-color: #fff;
                border-radius: 25px;

                &--icon {
                    padding: 10px;
                    background-color: #ccc;
                    border-radius: 50%;

                    svg {
                        color: #fff;
                        background-color: #000;
                        padding: 12px;
                        border-radius: 50%;
                        width: 20px;
                        height: 20px;
                    }
                }

                &--text {
                    p {
                        font-size: 18px;
                        font-weight: 500;
                        padding-bottom: 10px;
                    }

                    span {
                        font-size: 15px;
                        color: #656060;
                    }
                }
            }
        }

        .list {
            border-bottom: 0.5px solid #6b666657;
            padding: 20px 0;

            h3 {
                font-size: 20px;
                font-weight: 500;
            }

            &__content {
                padding-top: 10px;

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

                    &:last-child {
                        margin-bottom: 0;
                    }

                }
            }
        }

        .shipping {
            border-bottom: 0.5px solid #6b666657;
            padding: 20px 0;

            h3 {
                font-size: 20px;
                font-weight: 500;
            }

            &__type {
                display: flex;
                align-items: center;
                gap: 15px;
                background-color: #fff;
                margin-top: 15px;
                border-radius: 20px;

                &--icon {
                    svg {
                        width: 25px;
                        height: 25px;
                    }
                }

                &--text {
                    display: flex;
                    width: 90%;
                    align-items: center;
                    justify-content: space-between;

                    p {
                        font-size: 18px;
                        font-weight: 500;
                    }
                }
            }
        }

        .select-custom {
            font-family: system-ui;
            font-size: 15px;
            font-weight: 500;
            width: 100%;
            border: none;
            padding: 15px 20px;
            padding-left: 32px;
            background-color: #ffffff;
            border-radius: 15px;
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 1em;
        }

        .promo {
            border-bottom: 0.5px solid #6b666657;
            padding: 20px 0;

            h3 {
                font-size: 20px;
                font-weight: 500;
            }

            &__code {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-top: 15px;

                input {
                    font-family: system-ui;
                    font-size: 15px;
                    font-weight: 500;
                    width: 70%;
                    border: none;
                    padding: 17px 0px;
                    padding-left: 32px;
                    background-color: #cccccc4d;
                    border-radius: 15px;

                    &:focus-visible {
                        outline: 2px solid #686565;
                    }
                }

                svg {
                    color: #fff;
                    padding: 15px;
                    background-color: #000;
                    border-radius: 50%;
                    width: 20px;
                    height: 20px;
                }
            }
        }

        .price {
            padding: 20px 0;

            .total {
                padding: 20px;
                background-color: #fff;
                border-radius: 25px;

                span {
                    font-size: 17px;
                    color: #656060;
                }

                p {
                    font-size: 18px;
                    color: #000;
                    font-weight: 500;
                }

                &__amount {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    padding: 10px 0 20px 0;
                }

                &__shipping {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    padding: 10px 0 15px 0;
                }

                &__promo {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    padding: 15px 0 30px 0;
                    border-bottom: 0.5px solid #6b666657;
                }

                &__final {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    padding: 25px 0 10px 0;
                }
            }
        }
    }

    .footer {
        position: fixed;
        height: 100px;
        bottom: 0px;
        left: 0px;
        right: 0px;
        margin-bottom: 0px;
        display: flex;
        padding-left: 5%;
        padding-right: 5%;
        align-items: center;
        justify-content: space-around;
        border-top-left-radius: 30px;
        border-top-right-radius: 30px;
        border-top: 0.5px solid #6b666657;
        background: #f5f5f5;

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

            svg {
                margin-right: 10px;
            }
        }
    }
}

.content-x {
    background-color: #4e4a4a99;
    position: absolute;
    top: 0;
    height: 100vh;
    width: 100%;
    z-index: 1;
}

.is-hiden {
    transform: translateY(-500px);
}

.table {
    transition: all ease 0.8s;
    background-color: #fff;
    width: 90%;
    height: auto;
    position: absolute;
    top: 5%;
    left: 5%;
    margin-top: 20px;
    border-radius: 20px;
    z-index: 2;

    h2 {
        font-size: 20px;
        font-weight: 500;
        text-align: center;
        margin: 30px;
    }

    .input-group {
        position: relative;
        width: 90%;
        margin: auto;
        margin-bottom: 20px;

        input {
            font-family: system-ui;
            font-size: 17px;
            font-weight: 400;
            width: calc(100% - 20px);
            border: none;
            padding: 17px 0px;
            padding-left: 20px;
            background-color: rgb(204 204 204 / 21%);
            outline: 2px solid #ccc;
            border-radius: 15px;

            &:focus-visible {
                outline: 2px solid #1d9ce5c2;
            }
        }
    }

    .edit--btn {
        width: 90%;
        margin: auto;
        display: flex;
        gap: 10px;
        padding: 20px 0 40px 0;
        font-size: 15px;
        font-weight: 400;

        .btn--cancel {
            box-shadow: none;
            background-color: #cfcfcf8a;
            color: #000;
            border-radius: 50px;
            border: none;
            padding: 5px 10px;
            width: 100%;
            box-shadow: 5px 10px 18px #888888;
            font-family: system-ui;
            transition: all .5s;
        }

        .btn--remove {
            box-shadow: 5px 5px 15px #888888;
            background-color: #000;
            color: #fff;
            border-radius: 50px;
            border: none;
            padding: 15px 10px;
            width: 100%;
            box-shadow: 5px 10px 18px #888888;
            font-family: system-ui;
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
        background-color: #8b8b8b;
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

    .loadingButton {
        background-color: #000;
    }
}
</style>