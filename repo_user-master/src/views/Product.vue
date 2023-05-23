<template>
    <div class="product--detail">
        <Loading v-if="loading" />
        <template>
            <div class="back">
                <BackButton></BackButton>
            </div>

            <!-- Slider images -->
            <SliderImage :images="product.images" />

            <div class="product">

                <div class="intro">
                    <div class="intro__name">
                        <p>{{ product.name }}</p>
                        <font-awesome-icon icon="fa-regular fa-heart" />
                    </div>
                    <div class="intro__star">
                        <p class="sold">6,937 sold</p>
                        <font-awesome-icon icon="fa-regular fa-star-half-stroke" />
                        <p>{{ product.rating }} (6,573 reviews)</p>
                    </div>
                </div>

                <div class="des">
                    <div class="des__title">
                        <h3>Description</h3>
                        <p :class="{ line_clamp2: readmore }" @click="readmore = !readmore">
                            {{ product.description }}
                        </p>
                    </div>
                </div>

                <div class="choose">
                    <p class="choose__size--title">Size</p>
                    <div class="choose__size">
                        <div class="choose__size--number" v-for="(variant, index) in product.variants" :key="index"
                            :class="{ active: variantId == variant.id }" @click="variantId = variant.id">
                            <p>{{ variant.size }}</p>
                        </div>
                    </div>
                    <div class="choose__quantity">
                        <p>Quantity</p>
                        <div class="choose__quantity--icon">
                            <font-awesome-icon icon="fa-solid fa-minus"
                                @click="quantity <= 1 ? quantity = 1 : quantity--" />
                            <p>{{ quantity }}</p>
                            <font-awesome-icon icon="fa-solid fa-plus" @click="quantity++" />
                        </div>
                    </div>
                </div>

                <div class="total">
                    <div class="total__text">
                        <p>Total price</p>
                        <span>${{ product.price * quantity }}</span>
                    </div>
                    <div class="total__btn">
                        <button @click="addToCart()" :class="{ loadingButton: isActive }">
                            <font-awesome-icon icon="fa-solid fa-bag-shopping" v-if="!loadingButton" />
                            <LoadingButton v-else />
                            <span>Add to Cart</span>
                        </button>
                    </div>
                </div>
            </div>
        </template>
    </div>
</template>
  
<script>

import BackButton from '@/components/BackButton';
import SliderImage from '@/components/SliderImage';
import Loading from '@/components/Loading'
import LoadingButton from '@/components/LoadingButton.vue'

import { getProductById, addProductToCart } from "@/api";
import { mixin } from '@/mixin'

export default {
    mixins: [mixin],
    components: {
        BackButton,
        SliderImage,
        Loading,
        LoadingButton
    },
    data() {
        return {
            loading: true,
            readmore: true,
            isActive: false,
            quantity: 1,
            product: {},
            variantId: null,
            loadingButton: false
        }
    },
    created() {
        let productId = this.$route.params.id;

        // Get product by ID
        getProductById(productId).then((response) => {
            this.product = response.data.data;
            this.variantId = this.product.variants[0].id;
        }).catch((error) => {
            this.product = {};
        }).finally(() => {
            // Ẩn loading
            this.loading = false;
        })
    },
    methods: {
        addToCart: function () {
            // Hiện loading
            this.loadingButton = true;
            this.isActive = true;

            let data = {
                variant_id: this.variantId,
                quantity: this.quantity
            }

            // Them san pham
            addProductToCart(data).then((response) => {
                if (response.data.success) {
                    // Lưu data cart mới vào state vuex store
                    this.$store.commit('changeCartItems', response.data.data);

                    this.goToPage('cart');
                }
            }).catch(() => {
                console.log(response.data);
            }).finally(() => {
                // Ẩn loading
                this.loadingButton = false;
            })
        }
    }
}
</script>
  
<style lang="scss" scoped>
.product--detail {
    overflow: auto;

    .back {
        height: 60px;
        display: flex;
        align-items: center;
        padding-left: 20px;
        position: absolute;
        top: 0;
        left: 0;
        z-index: 1;
    }


    .product {
        width: 90%;
        margin: auto;
        letter-spacing: normal;
        font-family: system-ui;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        margin-bottom: 100px;
        gap: 5%;

        .intro {
            margin-top: 20px;
            width: 100%;

            &__name {
                display: flex;
                justify-content: space-between;
                margin-bottom: 15px;

                p {
                    font-weight: 500;
                    font-size: 24px;
                }

                svg {
                    width: 25px;
                    height: 25px;
                }
            }

            &__star {
                display: flex;
                align-items: center;
                padding-bottom: 15px;
                gap: 10px;
                border-bottom: 0.5px solid #6b666657;

                svg {
                    height: 18px;
                }

                p {
                    font-size: 15px;
                    color: #656060;
                }

                .sold {
                    font-size: 13px;
                    padding: 7px;
                    background-color: rgba(204, 204, 204, 0.2705882353);
                    color: #565252e8;
                    border-radius: 5px;
                    font-weight: bold;
                }
            }
        }

        .des {
            &__title {
                h3 {
                    font-size: 20px;
                    margin-top: 15px;
                    font-weight: 500;
                }

                p {
                    margin-top: 10px;
                    line-height: 20px;
                    font-size: 15px;
                    color: #656060;
                    text-overflow: ellipsis;
                    transition: all 2s ease-in;
                }

                .line_clamp2 {
                    display: -webkit-box;
                    -webkit-line-clamp: 2;
                    -webkit-box-orient: vertical;
                    overflow: hidden;
                }
            }
        }

        .choose {
            margin-top: 15px;


            &__size--title {
                font-size: 20px;
                font-weight: 500;
                margin-bottom: 15px;
            }

            &__size {
                display: flex;
                flex-wrap: wrap;
                gap: 10px;

                &--number {
                    display: flex;
                    gap: 10px;

                    p {
                        font-size: 18px;
                        padding: 10px;
                        border-radius: 50%;
                        border: 1px solid #000;
                    }
                }
            }

            .active {
                background-color: #000;
                color: #fff;
                border-radius: 50%;
            }

            &__color {
                width: 45%;

                &--title {
                    font-size: 20px;
                    font-weight: 500;
                }

                &--number {
                    margin-top: 15px;
                    display: flex;
                    overflow-x: scroll;
                    gap: 15px;
                    padding-bottom: 10px;

                    img {
                        width: 35px;
                    }
                }
            }

            &__quantity {
                display: flex;
                align-items: center;
                gap: 20px;
                padding: 20px 0;

                p {
                    font-size: 20px;
                    font-weight: 500;
                }

                &--icon {
                    display: flex;
                    gap: 25px;
                    padding: 15px 20px;
                    background-color: #cfcfcf3b;
                    border-radius: 30px;

                    svg {
                        width: 20px;
                        height: 20px;
                    }

                    p {
                        font-size: 18px;
                    }
                }
            }
        }

        .total {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 0.5px solid rgba(107, 102, 102, 0.3411764706);
            width: 90%;
            position: fixed;
            bottom: 0;
            background: #fff;
            height: 100px;
            margin: auto;

            &__text {
                p {
                    margin-bottom: 10px;
                }

                span {
                    font-size: 22px;
                    font-weight: 500;
                }
            }

            &__btn {
                width: 65%;

                button {
                    background-color: #000;
                    border: none;
                    border-radius: 30px;
                    width: 100%;
                    padding: 15px 30px;
                    font-size: 18px;
                    display: flex;
                    color: #fff;
                    box-shadow: 5px 10px 18px #888888;
                    align-items: center;
                    justify-content: space-evenly;

                    svg {
                        color: #fff;
                        padding-right: 10px;
                    }
                }
                .loadingButton {
                    background-color: #8b8b8b;
                }
            }
        }
    }

}
</style>