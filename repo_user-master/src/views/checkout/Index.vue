<template>
    <div class="form">
        <BackButton :value="'Checkout'"></BackButton>
        <!-- Shipping address -->
        <div class="location">
            <h3>Shipping Address</h3>
            <div class="location__address">
                <div class="location__address--icon">
                    <font-awesome-icon icon="fa-solid fa-location-dot" />
                </div>
                <div class="location__address--text">
                    <p>Home</p>
                    <span>61480 Sunbrook Park, PC 5679</span>
                </div>
                <div class="location__address--edit">
                    <font-awesome-icon icon="fa-solid fa-pen" @click="$router.push('/shipping_address')" />
                </div>
            </div>
        </div>

        <!-- Order List -->
        <div class="list">
            <h3>Order List</h3>
            <CartItem :isShowTrash="false" :product="product" v-for="(product, index) in products" :key="index"></CartItem>
        </div>

        <!-- Choose Shipping Type -->
        <div class="shipping">
            <h3>Choose Shipping</h3>
            <div class="shipping__type">
                <div class="shipping__type--icon">
                    <font-awesome-icon icon="fa-solid fa-truck-fast" />
                </div>
                <div class="shipping__type--text">
                    <p>Choose Shipping Type</p>
                    <font-awesome-icon icon="fa-solid fa-angle-right" @click="$router.push('/choose_shipping')" />
                </div>
            </div>
        </div>

        <!-- Promo -->
        <div class="promo">
            <h3>Promo Code</h3>
            <div class="promo__code">
                <input type="text" placeholder="Enter Promo Code">
                <font-awesome-icon icon="fa-solid fa-plus" />
            </div>
        </div>

        <!-- Total -->
        <div class="price">
            <div class="total">
                <div class="total__amount">
                    <span>Amount</span>
                    <p>$585.00</p>
                </div>
                <div class="total__shipping">
                    <span>Shipping</span>
                    <p>$585.00</p>
                </div>
                <div class="total__promo">
                    <span>Promo</span>
                    <p>$585.00</p>
                </div>
                <div class="total__final">
                    <span>Total</span>
                    <p>$585.00</p>
                </div>
            </div>
        </div>


        <!-- Footer Btn -->
        <div class="footer">
            <ButtonVue :value="'Continue to Payment'" @onClick="$router.push('/payment_methods')"></ButtonVue>
        </div>
    </div>
</template>
  
<script>

import BackButton from '@/components/base/BackButton'
import CartItem from '@/components/base/CardItem';
import ButtonVue from '@/components/base/Button';

export default {
    components: {
        BackButton,
        CartItem,
        ButtonVue
    },
    data() {
        return {
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
    }
}
</script>
  
<style lang="scss" scoped>
html,
body {
    width: 100%;
    height: 100%;
}

.form {
    display: flex;
    flex-direction: column;
    padding-top: 80px;
    letter-spacing: normal;
    font-family: system-ui;
    background: #f5f5f5a6;
    width: 100%;
    min-height: 100vh;
    padding-bottom: 140px;

    .location {
        padding-left: 5%;
        padding-right: 5%;

        h3 {
            font-size: 20px;
            font-weight: 500;
        }

        &__address {
            display: flex;
            align-items: center;
            gap: 15px;
            margin: 25px 0;
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
        padding: 0 5%;

        h3 {
            font-size: 20px;
            font-weight: 500;
            padding: 25px 0;
            border-top: 0.5px solid #6b666657;
        }
    }

    .shipping {
        padding: 0 5%;

        h3 {
            font-size: 20px;
            font-weight: 500;
            padding: 25px 0;
            border-top: 0.5px solid #6b666657;
        }

        &__type {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 20px 20px;
            background-color: #fff;
            margin-bottom: 25px;
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

    .promo {
        padding: 0 5%;

        h3 {
            font-size: 20px;
            font-weight: 500;
            padding: 25px 0;
            border-top: 0.5px solid #6b666657;
        }

        &__code {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;

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
        padding-left: 5%;
        padding-right: 5%;

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

    .footer {
        position: fixed;
        height: 120px;
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
    }
}</style>