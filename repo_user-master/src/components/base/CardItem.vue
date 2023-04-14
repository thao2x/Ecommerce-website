<template>
    <div class="cart">
        <img :src="product?.url_img" alt="">
        <div class="cart__info">
            <div class="cart__info--title">
                <p>{{ product?.name }}</p>
                <font-awesome-icon icon="fa-solid fa-trash-can" v-show="isShowTrash"
                    @click="$emit('removeProduct', product)" v-if="showTrash" />
            </div>
            <div class="cart__info--size">
                <p>Size = {{ product?.size }}</p>
            </div>
            <div class="cart__info--price">
                <p>${{ product?.price * product?.quantity }}.00</p>
                <div class="icon">
                    <font-awesome-icon icon="fa-solid fa-minus" @click="$emit('updateQuantity', giam(product))" />
                    <p>{{ quantity }}</p>
                    <font-awesome-icon icon="fa-solid fa-plus" @click="$emit('updateQuantity', tang(product))" />
                </div>
            </div>
        </div>
    </div>
</template>
  
<script>
export default {
    props: {
        product: {
            type: Object,
            required: true,
        },
        isShowTrash: {
            type: Boolean,
            required: true
        }
    },
    data() {
        return {
            quantity: this.product?.quantity,
            showTrash: true
        }
    },
    methods: {
        tang(product) {
            this.quantity = this.quantity + 1;
            return {
                productId: product.id,
                quantity: this.quantity
            }
        },

        giam(product) {
            this.quantity = this.quantity == 1 ? 1 : this.quantity - 1;
            return {
                productId: product.id,
                quantity: this.quantity
            }
        }
    }
}
</script>
  
<style lang="scss" scoped>
.cart {
    display: flex;
    align-items: center;
    gap: 10px;
    height: 135px;
    padding: 15px;
    margin-bottom: 20px;
    background-color: #fff;
    border-radius: 35px;

    img {
        width: 40%;
        height: 100%;
        border-radius: 35px;
    }

    &__info {
        width: 60%;

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
            padding: 20px 0;

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
</style>