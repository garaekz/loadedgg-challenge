<script setup>
import { ref } from "vue";

const model = defineModel();

const trends = ref([
    { name: "—", value: null },
    { name: "Higher", value: "higher" },
    { name: "Lower", value: "lower" },
    { name: "Neutral", value: "neutral" },
]);
</script>
<template>
    <div>
        <label for="trend" class="block">Comment Activity Trend </label>
        <select
            v-model="model"
            name="trend"
            id="trend"
            class="w-full p-2 bg-slate-800 border border-slate-700 rounded-md"
        >
            <option
                v-for="trend in trends"
                :key="trend.value"
                :value="trend.value"
            >
                {{ trend.name }}
            </option>
        </select>
    </div>
</template>
