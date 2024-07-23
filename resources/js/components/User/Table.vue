<script setup>
import { useUsersStore } from "@/stores/users";
import { storeToRefs } from "pinia";
import Paginator from "@/components/Paginator.vue";
import UpTrend from "@/components/Icons/UpTrend.vue";
import DownTrend from "@/components/Icons/DownTrend.vue";
import Minus from "@/components/Icons/Minus.vue";

const store = useUsersStore();
const { users, page, loading } = storeToRefs(store);

const onPageChange = (newPage) => {
    page.value = newPage;
};
</script>
<template>
    <div
        v-if="!users.meta && loading"
        class="w-full flex justify-center items-center p-12 text-slate-500"
    >
        Loading...
    </div>
    <table v-else class="w-full">
        <thead class="border-b border-slate-700">
            <tr class="text-left">
                <th class="p-4 font-semibold">Full Name</th>
                <th class="p-4 font-semibold">Country</th>
                <th class="p-4 font-semibold">Comment Activity</th>
            </tr>
        </thead>
        <tbody class="border-b border-slate-700">
            <tr v-if="!users.meta?.total">
                <td colspan="3">
                    <div class="p-8 flex justify-center w-full">
                        No users found for the selected filters.
                    </div>
                </td>
            </tr>
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
                <td class="py-3">
                    <div
                        class="w-full bg-slate-950/30 py-2 flex justify-center items-center gap-3"
                        :class="{
                            'text-emerald-500':
                                user.comment_activity.trend === 'higher',
                            'text-red-700':
                                user.comment_activity.trend === 'lower',
                        }"
                    >
                        <UpTrend
                            v-if="user.comment_activity.trend === 'higher'"
                        />
                        <DownTrend
                            v-else-if="user.comment_activity.trend === 'lower'"
                        />
                        <Minus v-else />
                        <span class="text-lg">{{
                            user.comment_activity.comments_today
                        }}</span>
                    </div>
                </td>
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
</template>
