<template>
    <div class="form">
        <Search/>

        <div class="results">
            <p>Results for "Running"</p>
            <span>12.749 founds</span>
        </div>

        <Product/>
    </div>
</template>
  
<script>
import Search from '@/components/base/Search';
import Product from '@/components/base/Product';

export default {
    components: {
        Search,
        Product
    }
}
</script>
  
<style lang="scss" scoped>
.form {
    display: flex;
    flex-direction: column;
    padding-top: 40px;
    width: 90%;
    margin: auto;
    letter-spacing: normal;
    font-family: system-ui;

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
}</style>