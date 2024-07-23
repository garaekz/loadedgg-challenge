import { ref, watch } from 'vue';
import { defineStore } from 'pinia'

export const useUsersStore = defineStore('users', () => {
    const loading = ref(false);
    const users = ref({});
    const page = ref(1);
    const sortBy = ref({ field: "created_at", direction: "desc" });
    const filter = ref({
        country: null,
        comment_activity_trend: null,
    });

    const fetchUsers = async () => {
        try {
            loading.value = true;
            const { data } = await axios.get(`/api/users`, {
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