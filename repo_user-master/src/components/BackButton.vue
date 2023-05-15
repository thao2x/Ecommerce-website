<template>
    <span>
        <font-awesome-icon icon="fa-solid fa-arrow-left" @click="$router.go(-1)" />
        {{ value }}
    </span>
</template>
  
<script>
export default {
    props: {
        value: {
            type: String
        },
    },
};
</script>
  
<style lang="scss" scoped>
span {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 22px;
    font-weight: 600;
    font-family: system-ui;

    svg {
        width: 25px;
        height: 25px;
        transition: all .5s;
        cursor: pointer;

        &:hover,
        &:focus {
            scale: (1.1);
        }
    }
}
</style>
  