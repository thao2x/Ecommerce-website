<template>
	<div class="form">
		<BackButton :value="'Most Popular'"></BackButton>
		<font-awesome-icon icon="fa-solid fa-magnifying-glass" @click="goSearch()" />
		<NameBrand class="nameBr"></NameBrand>
		<Product />
	</div>
</template>
  
<script>
import BackButton from '@/components/base/BackButton'
import NameBrand from '@/components/base/NameBrand';
import Product from '@/components/base/Product';

export default {
	components: {
		BackButton,
		NameBrand,
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

	svg {
		width: 22px;
		height: 22px;
		position: absolute;
		top: 25px;
		right: 5%;
	}

	.nameBr {
		margin-top: 70px;
	}
}
</style>