<template>
    <div class="category">
        <Loading v-if="loading" />
        <template v-else>
            <!-- Btn back -->
            <div class="back">
                <BackButton :value="title"></BackButton>
            </div>
            <!-- Product list -->
            <div class="product">
                <Product class="product__card" :product="product" v-for="(product, index) in products" :key="index" />
            </div>
        </template>
    </div>
</template>
  
<script>
import Product from '@/components/ProductCard'
import Loading from '@/components/Loading'
import BackButton from '@/components/BackButton'

import { searchProductByCategoryId } from "@/api";

export default {
    data() {
        return {
            products: [],
            title: "",
            loading: true
        }
    },
    components: {
        BackButton,
        Product,
        Loading
    },
    created() {
        // Lấy categoryId từ URL
        let categoryId = this.$route.params.id;

        // Lấy tên category từ vuex theo ID
        let categories = this.$store.state.categories;
        let category = categories.filter(item => item.id == categoryId);
        this.title = category[0].name;

        // Lấy dánh sách products theo categoryId
        searchProductByCategoryId(categoryId).then((response) => {
            if (response.data.success) {
                this.products = response.data.data;
            }
        }).catch(() => {
            this.products = [];
        }).finally(() => {
            // Ẩn loading
            this.loading = false;
        })

    }
}
</script>
  
<style lang="scss" scoped>
.category {
    display: flex;
    flex-direction: column;
    width: 90%;
    margin: auto;
    letter-spacing: normal;
    font-family: system-ui;

    .back {
        height: 60px;
        display: flex;
        align-items: center;
        position: fixed;
        top: 0;
        background-color: #fff;
        width: 100%;
        z-index: 1;
    }

    .product {
        display: flex;
        flex-wrap: wrap;
        gap: 5%;
        justify-content: space-between;
        margin-top: 65px;

        &__cart {
            width: 47.5%;
            margin-bottom: 20px;
        }
    }
}
</style>