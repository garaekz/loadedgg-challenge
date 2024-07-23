<script setup>
import { ref } from "vue";

const model = defineModel();

const fields = ref([
    { name: "Member Since", value: { field: "created_at", direction: "desc" } },
    {
        name: "Comment Activity Trend",
        value: { field: "comments_count", direction: "desc" },
    },
]);
</script>
<template>
    <div>
        <select
            v-model="model"
            name="trend"
            id="trend"
            class="w-full p-2 bg-slate-800 border border-slate-700 rounded-md"
        >
            <option
                v-for="field in fields"
                :key="field.value"
                :value="field.value"
            >
                {{ field.name }}
            </option>
        </select>
    </div>
</template>
