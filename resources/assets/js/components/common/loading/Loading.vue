<template>
	<div id="appLoading" class="bet-loading" style="position: fixed; width: 100%; top: 200px; text-align: center; z-index: 3000; display: block;">
		<div class="spinner">
			<div class="three-bounce">
				<div class="one"></div>
				<div class="two"></div>
				<div class="three"></div>
			</div>
		</div>
	</div>
</template>
<style scoped>
	.bet-loading {
		margin: 10px auto;
	}
	.spinner {
		width: 62px;
		height: 30px;
		display: inline-block;
		/*background: rgba(255, 255, 255, 0.85);*/
		background: rgba(255, 255, 255, 0);
		padding: 10px 50px 0;
	}
	.spinner .three-bounce {
		position: relative;
		text-align: center;
		top: 50%;
		bottom: 50%;
		margin-top: -9px;
	}
	.spinner .three-bounce .one {
		-webkit-animation-delay: -.32s;
		animation-delay: -.32s;
		background: rgb(55,137,250);
	}
	.spinner .three-bounce>div {
		display: inline-block;
		width: 18px;
		height: 18px;
		border-radius: 100%;
		top: 50%;
		margin-top: -9px;
		background: #aeadba;
		-webkit-animation: bouncedelay 1.4s infinite ease-in-out;
		animation: bouncedelay 1.4s infinite ease-in-out;
		-webkit-animation-fill-mode: both;
		animation-fill-mode: both;
	}
	@keyframes bouncedelay {
		0%, 100%, 80% {
			transform: scale(0);
			-webkit-transform: scale(0);
		}
		40% {
			transform: scale(1);
			-webkit-transform: scale(1);
		}
	}

	.spinner .three-bounce .two {
		-webkit-animation-delay: -.16s;
		animation-delay: -.16s;
		background: rgb(99,99,99)
	}
	.spinner .three-bounce .three {
		background: rgb(235,67,70);
	}
</style>