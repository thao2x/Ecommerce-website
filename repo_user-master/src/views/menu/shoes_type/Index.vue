<template>
	<div class="form">
		<BackButton :value="'Nike'"></BackButton>
		<div class="form__search">
			<font-awesome-icon icon="fa-solid fa-magnifying-glass" @click="goSearch()" />
		</div>
		<Product class="product"></Product>
	</div>
</template>
  
<script>
import BackButton from '@/components/base/BackButton';
import Product from '@/components/base/Product';

export default {
	components: {
		BackButton,
		Product
	},
	methods: {
		goSearch() {
			this.$router.push('/search');
		}
	}
}
</script>
  
<style lang="scss" scoped>
.form {
	display: flex;
	flex-direction: column;
	padding-top: 10px;
	width: 90%;
	margin: auto;
	letter-spacing: normal;
	font-family: system-ui;

	&__search {
		position: absolute;
		top: 25px;
		right: 5%;

		svg {
			width: 25px;
			height: 25px;
		}
	}

	.product {
		margin-top: 70px;
	}
}
</style>