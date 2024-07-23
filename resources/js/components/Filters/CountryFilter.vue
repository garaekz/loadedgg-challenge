<script setup>
import { ref } from "vue";

const model = defineModel();

const countries = ref([
    { name: "—", value: null },
    { name: "United States of America", value: "US" },
    { name: "Canada", value: "CA" },
    { name: "Mexico", value: "MX" },
]);
</script>
<template>
    <div>
        <label for="country" class="block">Country</label>
        <select
            v-model="model"
            name="country"
            id="country"
            class="w-full p-2 bg-slate-800 border border-slate-700 rounded-md"
        >
            <option
                v-for="country in countries"
                :key="country.value"
                :value="country.value"
            >
                {{ country.name }}
            </option>
        </select>
    </div>
</template>
