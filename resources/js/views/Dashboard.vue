<script setup>
import { ref } from "vue";
import { useUsersStore } from "../stores/users";
import { storeToRefs } from "pinia";
import Paginator from "../components/Paginator.vue";

const store = useUsersStore();
const { fetchUsers } = store;
const { users, page, loading } = storeToRefs(store);

const onPageChange = (newPage) => {
    page.value = newPage;
};
fetchUsers();
</script>
<template>
    <div class="w-full flex justify-center items-center">
        <div class="w-full max-w-screen-xl p-8 flex gap-4">
            <div class="w-2/6 flex flex-col gap-4 p-4 bg-slate-900 rounded-md">
                <h4 class="text-lg">Filters</h4>
                <div>
                    <label for="country" class="block">Country</label>
                    <select name="country" id="country" class="w-full p-2">
                        <option value="all">All</option>
                        <option value="usa">USA</option>
                        <option value="canada">Canada</option>
                        <option value="uk">UK</option>
                    </select>
                </div>
                <div class="whitespace-nowrap">
                    <label for="country" class="block"
                        >Comment Activity Trend</label
                    >
                    <select name="country" id="country" class="w-full p-2">
                        <option value="all">All</option>
                        <option value="usa">USA</option>
                        <option value="canada">Canada</option>
                        <option value="uk">UK</option>
                    </select>
                </div>
            </div>
            <div class="p-4 bg-slate-900 w-full rounded-md">
                <table class="w-full">
                    <thead class="border-b border-slate-700">
                        <tr class="text-left">
                            <th class="p-4 font-semibold">Full Name</th>
                            <th class="p-4 font-semibold">Country</th>
                            <th class="p-4 font-semibold">Comment Activity</th>
                        </tr>
                    </thead>
                    <tbody class="border-b border-slate-700">
                        <tr
                            v-for="(user, index) in users.data"
                            :key="user.id"
                            :class="{
                                'border-b border-slate-800':
                                    index !== users.data.length - 1,
                            }"
                        >
                            <td class="p-4">
                                <div class="flex items-center">
                                    <img
                                        :src="user.avatar"
                                        alt="avatar"
                                        class="w-6 h-6 rounded-md mr-4"
                                    />
                                    <div>{{ user.full_name }}</div>
                                </div>
                            </td>
                            <td class="p-4">{{ user.country.name }}</td>
                            <td class="p-4">{{ user.comment_activity }}</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="p-4">
                                <Paginator
                                    v-if="users.meta?.total > 0"
                                    :current-page="users.meta.current_page"
                                    :total-items="users.meta.total"
                                    :per-page="users.meta.per_page"
                                    @page-change="onPageChange"
                                />
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</template>
