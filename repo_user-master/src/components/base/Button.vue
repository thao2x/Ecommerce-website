<template>
    <button @click="$emit('onClick', true)">{{ value }}</button>
</template>
  
<script>
export default {
    props: {
        value: {
            type: String,
            required: true,
        },
    },
};
</script>
  
<style scoped lang="scss">
button {
    background-color: #000;
    color: #fff;
    border-radius: 50px;
    border: none;
    padding: 15px 20px;
    width: 100%;
    box-shadow: 5px 10px 18px #888888;
    font-size: 20px;
    font-family: system-ui;
    font-weight: 500;
    transition: all .5s;
    cursor: pointer;

    &:hover,
    &:focus {
        background-color: #fff;
        color: #000;
        outline: 2px solid #000;
    }
}
</style>