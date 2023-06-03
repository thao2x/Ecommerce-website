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
    letter-spacing: normal;
    font-family: system-ui;
    height: 100vh;

    .back {
        height: 60px;
        display: flex;
        align-items: center;
        top: 0;
        background-color: #fff;
        z-index: 1;
        padding: 0 5%;
    }

    .product {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        padding: 0 5%;
        height: calc(100% - 60px);
        overflow: auto;
        padding-top: 5px;

        &__cart {
            width: 47.5%;
            margin-bottom: 20px;
        }
    }
}
</style>