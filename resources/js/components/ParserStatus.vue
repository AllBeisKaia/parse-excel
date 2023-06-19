<template>
    <h2>{{ user.name }}</h2>
    <div v-if="status" class="w-full bg-gray-200 rounded-full dark:bg-gray-700 mb-4">
        <div class="bg-blue-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full" :style="`width: ${status}%`">{{ status }}%</div>
    </div>
</template>

<script setup>
    import {io} from "socket.io-client";
    import {ref} from "vue";

    const props = defineProps({
      user: {}
    })

    const status = ref(0);

    const socket = io("http://localhost:5000", {
        withCredentials: true,
    });

    socket.on(props.user.id + ':parser', (message) => {
        status.value = message;
    });
</script>

<style scoped>

</style>
