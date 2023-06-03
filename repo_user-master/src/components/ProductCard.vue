<template>
    <div class="product__cart" @click="goToPageById('product', product.id)">
        <div class="product__cart--img">
            <img :src="getCurrentImage(product.images[0]?.src)" alt="">
            <div class="heart">
                <font-awesome-icon icon="fa-solid fa-heart" />
            </div>
        </div>
        <div class="product__cart--name">
            <p>{{ product?.name }}</p>
        </div>
        <div class="product__cart--star">
            <font-awesome-icon icon="fa-regular fa-star-half-stroke" />
            <p>{{ product?.rating }}</p>
            <p class="sold">6,937 sold</p>
        </div>
        <div class="product__cart--price">
            <font-awesome-icon icon="fa-solid fa-dollar-sign" />
            <p>{{ (product?.price).toLocaleString("en-IN") }}</p>
        </div>
    </div>
</template>
  
<script>
import {mixin} from '@/mixin'

export default {
    mixins: [ mixin ],
    props: {
        product: {
            type: Object,
            required: true,
        }
    }
}
</script>
  
<style lang="scss" scoped>
.product {
    display: flex;
    justify-content: space-between;
    margin-bottom: 80px;

    .product__cart {
        font-family: system-ui;
        width: 47.5%;
        margin-bottom: 20px;

        &--img {
            position: relative;

            img {
                border-radius: 30px;
                width: 100%;
                height: 190px;
                object-fit: cover;
            }

            .heart {
                position: absolute;
                top: 16px;
                right: 20px;
                padding: 10px;
                border-radius: 50%;
                background-color: #000;

                svg {
                    color: #fff;
                }
            }
        }

        &--name {
            p {
                font-size: 17px;
                font-weight: 500;
                padding: 10px 0;
                overflow: hidden;
                white-space: nowrap;
                text-overflow: ellipsis;
            }
        }

        &--star {
            display: flex;
            align-items: center;
            padding-bottom: 10px;
            gap: 7px;

            svg {
                height: 18px;
            }

            p {
                padding-top: 5px;
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
                margin-left: 5px;
            }
        }

        &--price {
            display: flex;
            align-items: center;

            svg {
                height: 16px;
            }

            p {
                font-size: 16px;
                font-weight: 500;
            }
        }
    }
}
</style>