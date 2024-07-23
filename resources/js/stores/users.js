import { ref, watch } from 'vue';
import { defineStore } from 'pinia'
import { useStorage } from '@vueuse/core'

export const useUsersStore = defineStore('users', () => {
    const loading = ref(false);
    const users = ref({});
    const page = useStorage('users-page', 1);
    const sortBy = useStorage('users-sortBy', { field: "created_at", direction: "desc" });
    const filter = useStorage('users-filter', {
        country: null,
        comment_activity_trend: null,
    });

    const fetchUsers = async () => {
        try {
            loading.value = true;
            const { data } = await axios.get(`/api/dashboard`, {
                params: {
                    page: page.value,
                    filter: filter.value,
                    sort: sortBy.value,
                },
            });
            users.value = data;
        } catch (error) {
            console.error(error);
        } finally {
            loading.value = false;
        }
    }

    watch(page, fetchUsers);
    watch(filter, fetchUsers, { deep: true });
    watch(sortBy, fetchUsers);

    return {
        users,
        page,
        filter,
        fetchUsers,
        loading,
        sortBy,
    };
});