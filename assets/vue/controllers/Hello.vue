<template>
    <div>Hola {{ name }}!</div>
</template>

<script setup>
    defineProps({
        name: String
    });
</script>
