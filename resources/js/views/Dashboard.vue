<script setup>
import { ref } from "vue";
import { useUsersStore } from "../stores/users";

const store = useUsersStore();
</script>
<template>
    <div>
        <h1>Hello!!!, Vue 3!</h1>
        <p>{{ store.count }}</p>

        <button @click="store.increment">Increment</button>
    </div>
</template>
