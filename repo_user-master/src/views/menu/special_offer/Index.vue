<template>
	<div class="form">
		<BackButton :value="'Special Offers'"></BackButton>
		<BannerOffer class="banner"></BannerOffer>
		<BannerOffer class="banner"></BannerOffer>
		<BannerOffer class="banner"></BannerOffer>
		<BannerOffer class="banner"></BannerOffer>
		<BannerOffer class="banner"></BannerOffer>
	</div>
</template>
  
<script>
import BackButton from '@/components/base/BackButton'
import BannerOffer from '@/components/base/BannerOffer'

export default {
	components: {
		BackButton,
		BannerOffer
	}
}
</script>
  
<style lang="scss" scoped>
.form {
	display: flex;
	flex-direction: column;
	padding-top: 80px;
	width: 90%;
	margin: auto;
	letter-spacing: normal;
	font-family: system-ui;

	.banner {
		margin-bottom: 20px;

		&:nth-child(3) {
			background-color: #4e5e75;
		}

		&:nth-child(4) {
			background-color: #633f3fde;
		}

		&:nth-child(5) {
			background-color: #10907e;
		}

		&:nth-child(6) {
			background-color: #132c85de;
		}

		&:last-child {
			margin-bottom: 50px;
		}
	}
}
</style>