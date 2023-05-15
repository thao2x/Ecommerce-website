<template>
    <div class="search">
        <Loading v-if="loading" />
        <template v-else>
            <!-- Btn back -->
            <BackButton :value="'Search'"></BackButton>

            <!-- Search -->
            <div class="input">
                <font-awesome-icon icon="fa-solid fa-magnifying-glass" />
                <input placeholder="Typing ..." type="text" v-model="value" @keyup.enter="handleSearch(value)" />
            </div>

            <div class="results" v-show="value">
                <p>Results for "{{ value }}"</p>
                <span>{{ products.length }} founds</span>
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

import { searchProduct } from "@/api";

export default {
    components: {
        Product,
        Loading,
        BackButton
    },
    data() {
        return {
            products: [],
            loading: true,
            value: ""
        }
    },
    created() {
        // Tìm kiếm
        this.value = this.keySearch;
        this.search(this.keySearch);
    },
    methods: {
        handleSearch: function (value) {
            // Lưu key search vào state vuex store
            this.$store.commit('changeKeySearch', value);

            // Tìm kiếm
            this.search(value);
        },

        search: function (key) {
            // Hiện loading
            this.loading = true;

            searchProduct(key).then((response) => {
                if (response.data.success) {
                    this.products = response.data.data;
                }
            }).catch((error) => {
                this.products = [];
            }).finally(() => {
                // Ẩn loading
                this.loading = false;
            })
        }
    },
    computed: {
        keySearch() {
            return this.$store.state.keySearch;
        }
    },
}
</script>
  
<style lang="scss" scoped>
.search {
    display: flex;
    flex-direction: column;
    padding-top: 20px;
    width: 90%;
    margin: auto;
    letter-spacing: normal;
    font-family: system-ui;

    .input {
        position: relative;
        width: 100%;
        margin-top: 20px;

        svg {
            left: 10px;
            top: 50%;
            position: absolute;
            transform: translateY(-50%);
        }

        input {
            font-family: system-ui;
            font-size: 17px;
            font-weight: 600;
            width: calc(100% - 32px);
            border: none;
            padding: 17px 0px;
            padding-left: 32px;
            background-color: #cccccc45;
            border-radius: 15px;

            &:focus-visible {
                outline: 2px solid #686565;
            }
        }
    }

    .results {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 25px 0;

        p {
            font-size: 20px;
            font-weight: 500;
        }

        span {
            font-size: 16px;
            font-weight: 500;
        }
    }

    .product {
        display: flex;
        flex-wrap: wrap;
        gap: 5%;
        justify-content: space-between;
        margin-top: 20px;

        &__cart {
            width: 47.5%;
            margin-bottom: 20px;
        }
    }
}
</style>