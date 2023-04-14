<template>
	<div class="form">
		<BackButton :value="'Notificantion'"></BackButton>
		<div class="ctn">
			<div class="ctn__text">
				<p>Today</p>
			</div>
			<div class="ctn__content">
				<font-awesome-icon icon="fa-solid fa-gears" />
				<div class="ctn__content--text">
					<p>
						30% Specials Discount!
					</p>
					<span>
						Special promotion only valid today
					</span>
				</div>
			</div>
		</div>
		<NavFooter />
	</div>
</template>
  
<script>
import BackButton from '@/components/base/BackButton'
import NavFooter from '@/components/base/NavFooter';

export default {
	components: {
		BackButton,
		NavFooter
	}

}

</script>
  
<style lang="scss" scoped>
.form {
	background: #f5f5f5a6;
	width: 100%;
	min-height: 100vh;
	background-attachment: fixed;

	.ctn {
		display: flex;
		flex-direction: column;
		padding-top: 80px;
		width: 90%;
		margin: auto;
		letter-spacing: normal;
		font-family: system-ui;

		&__text {
			padding-bottom: 25px;

			p {
				font-size: 20px;
				font-weight: 500;
			}
		}

		&__content {
			display: flex;
			align-items: center;
			gap: 15px;
			background-color: #fff;
			border-radius: 20px;
			padding: 15px;

			svg {
				border-radius: 50%;
				background-color: #000;
				color: #fff;
				width: 40px;
				height: 40px;
				padding: 15px;
			}

			&--text {
				p {
					font-size: 20px;
					margin-bottom: 10px;
					font-weight: 500;
				}

				span {
					font-size: 14px;
					color: #6b6464e0;
				}
			}
		}
	}
}
</style>