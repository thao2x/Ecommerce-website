<template>
    <div class="form">
        <div class="cnt" id="qr1">
            <div class="ctn_content">
                <img src="@/assets/congrats.png" alt="" />
                <p>Congratulations!</p>
                <span>Your account is ready to use. You will be redirected to Home page in
                    a few seconds.</span>
                <div class="loader">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>
    </div>
</template>
  
<script>
export default {
    mounted() {
        const self = this; // Phải định nghĩa như này bởi vì this trong function của js nó đang trùng với this trong vue
        setTimeout(function () {
            self.$router.push({ path: '/home' });
        }, 5000);
    }
};
</script>
  
<style lang="scss" scope>
.cnt {
    overflow: hidden;
    position: fixed;
    left: 0;
    right: 0;
    background-color: rgba(0, 0, 0, 0);
    z-index: 9999;
    transition: 0.8s;
    font-family: system-ui;
    display: flex;
    width: auto;
    height: auto;
    top: 0;
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.7);
}

.ctn_content {
    font-family: system-ui;
    border-radius: 36px;
    background-color: #fff;
    width: 80%;
    height: 55%;
    margin: auto;
    a-webkit-animation-name: example;
    -webkit-animation-duration: 1s;
    animation-name: example;
    animation-duration: 0.5s;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;

    img {
        width: 50%;
        height: 35%;
    }

    p {
        width: 85%;
        text-align: center;
        font-size: 18px;
        font-weight: 800;
        margin: 20px 0;
    }

    span {
        width: 85%;
        text-align: center;
        font-size: 15px;
    }
}

/*animasi*/
@-webkit-keyframes example {
    from {
        top: -100px;
        opacity: 0;
    }

    to {
        top: 0px;
        opacity: 1;
    }
}

/* Add animation (Standard syntax) */
@keyframes example {
    from {
        top: -100px;
        opacity: 0;
    }

    to {
        top: 0px;
        opacity: 1;
    }
}

// looding 
:root {
    --color-bg: #eaeaea;
    --color-loader: #222;
    --loader-size: 100px;
    --loader-speed: 500ms;
}

.loader {
    margin-top: 35px;
    --loader-height: calc(var(--loader-size) / 7);
    display: flex;
    position: relative;
}

.loader::before {
    content: '';
    position: absolute;
}

.loader::before,
.loader>span {
    display: block;
    width: var(--loader-height);
    height: var(--loader-height);
    border-radius: 50%;
    background: var(--color-loader);

    animation-name: to-right;
    animation-duration: var(--loader-speed);
    animation-iteration-count: infinite;
    animation-timing-function: linear;
}

.loader>span:nth-child(even) {
    visibility: hidden;
}

.loader>span:first-child {
    animation-name: scale-up;
}

.loader>span:last-child {
    animation-name: scale-up;
    animation-direction: reverse;
}

@keyframes to-right {
    to {
        transform: translateX(200%);
    }
}

@keyframes scale-up {
    from {
        transform: scale(0);
    }

    to {
        transform: scale(1);
    }
}
</style>