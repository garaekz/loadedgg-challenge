<script setup>
import { onMounted } from "vue";
import { storeToRefs } from "pinia";
import { useUsersStore } from "@/stores/users";
import UserTable from "@/components/User/Table.vue";
import CountryFilter from "@/components/Filters/CountryFilter.vue";
import TrendFilter from "@/components/Filters/TrendFilter.vue";
import SortByFilter from "../components/Filters/SortByFilter.vue";

const store = useUsersStore();
const { fetchUsers } = store;
const { filter, sortBy } = storeToRefs(store);

onMounted(fetchUsers);
</script>
<template>
    <div class="w-full flex justify-center items-center">
        <div class="w-full max-w-screen-xl p-8 flex flex-col lg:flex-row gap-4">
            <div
                class="lg:w-2/6 w-full flex flex-col gap-4 p-4 bg-slate-900 rounded-md"
            >
                <h4 class="text-lg">Filters</h4>
                <CountryFilter v-model="filter.country" />
                <TrendFilter v-model="filter.comment_activity_trend" />
            </div>
            <div class="p-4 bg-slate-900 w-full rounded-md">
                <div class="flex justify-end">
                    <SortByFilter v-model="sortBy" />
                </div>
                <UserTable />
            </div>
        </div>
    </div>
</template>
