<template>
    <div class="form">
        <!-- Header -->
        <div class="header">
            <div class="header__title">
                <img src="@/assets/picwish.png" alt="picwish">
                <p>My Cart</p>
            </div>
            <font-awesome-icon icon="fa-solid fa-magnifying-glass" />
        </div>

        <!-- List Item -->
        <div class="form__card">
            <CartItem :product="product" :isShowTrash="true" @updateQuantity="updateQuantity($event)"
                @removeProduct="showPopupRemove($event)" v-for="(product, index) in products" :key="index">
            </CartItem>
        </div>

        <!-- Checkout -->
        <div class="total">
            <div class="total__text">
                <p>Total price</p>
                <span>${{ getTotal(products) }}.00 </span>
            </div>
            <div class="total__btn">
                <button @click="$router.push('/checkout')">
                    Checkout
                    <font-awesome-icon icon="fa-regular fa-hand-point-right" />
                </button>
            </div>
        </div>

        <!-- Footer -->
        <NavFooter/>

        <!-- Popup delete -->
        <div class="bg-popup" v-show="showPopup"></div>
        <div class="delete" :class="[{ 'is-hiden': !showPopup }]">
            <div class="delete__content">
                <div class="delete__content--title">
                    <h3>Remove From Cart?</h3>
                </div>
                <div class="delete__content--card">
                    <cartItem :product="productHandle" :isShowTrash="false"></cartItem>
                </div>
                <div class="delete__content--btn">
                    <ButtonVue :value="'Cancel'" class="btn--cancel" @onClick="showPopup = !showPopup"/>
                    <ButtonVue :value="'Yes, Remove'" class="btn--remove" @onClick="delProduct(productHandle?.id)"/>
                </div>
            </div>
        </div>          
    </div>
</template>
  
<script>

import NavFooter from '@/components/base/NavFooter';
import CartItem from '@/components/base/CardItem';
import ButtonVue from '@/components/base/Button';

export default {
    components: {
        NavFooter,
        CartItem,
        ButtonVue
    },
    data() {
        return {
            showPopup: false,
            productHandle: {},
            products: [
                {
                    id: '_p-001',
                    name: 'Air Jordan 3 Retro',
                    size: 42,
                    price: 110,
                    url_img: require("@/assets/shoes/nike/Nike Air Force 1 '07 LV8/1.png"),
                    quantity: 1
                },
                {
                    id: '_p-002',
                    name: 'Air Jordan 1 Mid',
                    size: 40,
                    price: 150,
                    url_img: require("@/assets/shoes/nike/Air Jordan 1 Mid/1.png"),
                    quantity: 1
                }
            ]
        }
    },
    methods: {
        delProduct(productId) {
            // Xử lý xóa product bằng ID

            // Tìm số chỉ mục
            const index = this.products.findIndex(item => item.id == productId);
            if (index >= 0) {
                this.products.splice(index, 1);
            }

            this.showPopup = !this.showPopup;
        },

        // Get total
        getTotal(products) {
            return products.reduce((total, product) => total + (product.price * product.quantity), 0);
        },

        showPopupRemove(data) {
            this.productHandle = data;
            this.showPopup = !this.showPopup;
        },

        updateQuantity(data) {
            console.log(data);

            // Tìm số chỉ mục
            const index = this.products.findIndex(item => item.id == data.productId);
            if (index >= 0) {
                this.products[index].quantity = data.quantity;
            }
        }
    }
}
</script>
  
<style lang="scss" scoped>
.bg-popup {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7);
    z-index: 1;
}

.form {
    display: flex;
    flex-direction: column;
    padding-top: 40px;
    letter-spacing: normal;
    font-family: system-ui;
    background: #f5f5f5a6;
    width: 100%;
    min-height: 100vh;
    background-attachment: fixed;
    padding-bottom: 170px;
    z-index: 0;

    .header {
        display: flex;
        justify-content: space-between;
        padding-bottom: 35px;
        width: 90%;
        padding-left: 5%;
        padding-right: 5%;

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
        margin-left: 5%;
        margin-right: 5%;
        margin-bottom: 20px;
    }

    .total {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 25px 0;
        position: fixed;
        width: 100%;
        border-top: 0.5px solid rgba(107, 102, 102, 0.3411764706);
        background-color: #fff;
        border-top-left-radius: 30px;
        border-top-right-radius: 30px;
        bottom: 70px;

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
            }
        }
    }
}

.is-hiden {
    transform: translateY(500px);
}

.delete {
    position: fixed;
    z-index: 2;
    transition: all ease 0.8s;
    width: 100%;
    bottom: 0;

    &__content {
        border-top-right-radius: 40px;
        border-top-left-radius: 40px;
        background-color: #fff;
        width: 100%;
        // height: 55%;
        margin: auto;
        a-webkit-animation-name: example;
        -webkit-animation-duration: 1s;
        animation-name: example;
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
                border-bottom: 0.5px solid #6b666657;
            }
        }

        &--card {
            width: 90%;
            margin: auto;
            padding: 20px 0;
            border-bottom: 0.5px solid #6b666657;
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
        }
    }
}
</style>