<template>
    <div>
        <template v-if="type == 'text'">
            <font-awesome-icon icon="fa-solid fa-envelope" />
        </template>

        <template v-if="type == 'password'">
            <font-awesome-icon icon="fa-solid fa-lock" />
        </template>

        <input :placeholder="placeholder" :type="type" v-model="value"
            onfocus="this.type == 'number' ? (this.type='date') : '' " @keyup.stop.prevent="$emit('keyPress', value)"
            @focus="$emit('onFocus', value)" />
    </div>
</template>
  
<script>
export default {
    props: {
        type: {
            type: String,
            required: true,
        },
        placeholder: {
            type: String,
        },
    },
    data() {
        return {
            value: null,
        };
    },
};
</script>
  
<style scoped lang="scss">
div {
    position: relative;
    width: 100%;

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
</style>