<template>
    <div class="title">
        <input type="checkbox" @change="$emit('onChecked', value)" v-model="value" />
        <p>Remember me</p>
    </div>
</template>
  
<script>
export default {
    data() {
        return {
            value: null,
        };
    },
};
</script>
  
<style lang="scss" scoped>
.title {
    display: flex;
    align-items: center;
    justify-content: center;

    input {
        accent-color: #000;
        width: 17px;
    }

    p {
        font-size: 18px;
        font-weight: 600;
        padding-left: 15px;
        font-family: system-ui;
    }
}
</style>
  