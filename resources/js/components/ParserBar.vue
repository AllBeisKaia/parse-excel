<template>
    <div class="relative">
        <div v-if="status !== 0 && status < 100">
            <div class="inline-block h-8 w-8 animate-spin rounded-full border-4 border-solid border-current border-r-transparent align-[-0.125em] motion-reduce:animate-[spin_1.5s_linear_infinite]">
                  <span class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]">Loading...</span>
            </div>
        </div>
        <div v-if="status == 100">
            <div class="svg-container">
                <svg class="ft-green-tick" xmlns="http://www.w3.org/2000/svg" height="29" width="29" viewBox="0 0 48 48" aria-hidden="true">
                    <circle class="circle" fill="#5bb543" cx="24" cy="24" r="22"/>
                    <path class="tick" fill="none" stroke="#FFF" stroke-width="6" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M14 27l5.917 4.917L34 17"/>
                </svg>
            </div>
        </div>
    </div>
</template>

<script setup>
    import {io} from "socket.io-client";
    import {ref} from "vue";

    const status = ref(0);

    const socket = io("http://localhost:5000", {
        withCredentials: true,
    });

    socket.on('parser', (message) => {
        status.value = message;
    });
</script>

<style scoped>
@supports (animation: grow .5s cubic-bezier(.25, .25, .25, 1) forwards) {
    .tick {
        stroke-opacity: 0;
        stroke-dasharray: 29px;
        stroke-dashoffset: 29px;
        animation: draw .5s cubic-bezier(.25, .25, .25, 1) forwards;
        animation-delay: .6s
    }
    .circle {
        fill-opacity: 0;
        stroke: #219a00;
        stroke-width: 16px;
        transform-origin: center;
        transform: scale(0);
        animation: grow 1s cubic-bezier(.25, .25, .25, 1.25) forwards;
    }
}
@keyframes grow {
    60% {
        transform: scale(.8);
        stroke-width: 4px;
        fill-opacity: 0;
    }
    100% {
        transform: scale(.9);
        stroke-width: 8px;
        fill-opacity: 1;
        fill: #219a00;
    }
}
@keyframes draw {
    0%, 100% { stroke-opacity: 1; }
    100% { stroke-dashoffset: 0; }
}
</style>
