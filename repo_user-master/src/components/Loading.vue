<template>
    <div class="loader ">
        <div class="loader-inner loading">
            <div class="loading-box">
                <div class="circular-loader">
                </div>
                <div class="error-cross"></div>
                <div class="loader-message">Loading...</div>
            </div>
        </div>
    </div>
</template>

<style scoped>
/* loader css starts from here */
.loader {
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    background-color: #34323280;
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 999;
}

.loader .loader-inner {
    position: relative;
    width: 100%;
    height: 100%;
    background-color: #34323280;
    display: flex;
    justify-content: center;
    align-items: center;
    -webkit-transition: width .5s, height 1s;
    /* For Safari 3.1 to 6.0 */
    transition: width .5s, height 1s;
}

.loader.success .loader-inner,
.loader.error .loader-inner {
    width: 300px;
    height: 210px;
    border-radius: 5px;
}

.loader .loader-inner .loading-box {
    text-align: center;
    width: 100%;
    padding: 2em;
}

.loader .loader-inner .loading-box .loader-message {
    padding: 1em 0;
    color: white;
}

.loader .loader-inner .loading-box .circular-loader {
    border: 3px solid #f3f3f3;
    /* Light grey */
    border-top: 3px solid #444;
    /* Blue */
    border-radius: 50%;
    width: 50px;
    height: 50px;
    animation: spin 2s linear infinite;
    margin: 0 auto;
    transition: all .5s ease-out;
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
}


.loader.error .loader-inner .loading-box .circular-loader {
    border-top: 3px solid #f3f3f3;
    animation: none;
}

.loader .loader-inner .loading-box .circular-loader:before,
.loader .loader-inner .loading-box .circular-loader:after {
    content: '';
    height: 0px;
    width: 0px;
    background-color: white;
    position: absolute;
    -webkit-transition: height .5s;
    /* For Safari 3.1 to 6.0 */
    transition: height .5s;
}

/* for error */
.loader.error .loader-inner .loading-box .circular-loader:before,
.loader.error .loader-inner .loading-box .circular-loader:after,
.loader.success .loader-inner .loading-box .circular-loader:before,
.loader.success .loader-inner .loading-box .circular-loader:after {
    height: 30px;
    width: 3px;
    border-radius: 3px;
}

.loader.error .loader-inner .loading-box .circular-loader:before {
    transform: rotate(50deg);
}

.loader.error .loader-inner .loading-box .circular-loader:after {
    transform: rotate(130deg);
}

/* for success */
.loader.success .loader-inner .loading-box .circular-loader {
    border: 3px solid #aff5b2;
    animation: none;
}

.loader.success .loader-inner .loading-box .circular-loader:before {
    transform: rotate(38deg);
}

.loader.success .loader-inner .loading-box .circular-loader:after {
    transform: rotate(130deg);
}

.loader.success .loader-inner .loading-box .circular-loader:before,
.loader.success .loader-inner .loading-box .circular-loader:after {
    background-color: #aff5b2;
}

.loader.success .loader-inner .loading-box .circular-loader:after {
    left: 11px;
    height: 10px;
    bottom: 12px
}

@keyframes spin {
    0% {
        transform: rotate(0deg);
    }

    100% {
        transform: rotate(360deg);
    }
}
</style>