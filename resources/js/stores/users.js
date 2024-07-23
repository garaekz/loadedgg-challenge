import { ref, watch } from 'vue';
import { defineStore } from 'pinia'

export const useUsersStore = defineStore('users', () => {
    const loading = ref(false);
    const users = ref({});
    const page = ref(1);

    const fetchUsers = async () => {
        try {
            loading.value = true;
            const { data } = await axios.get(`/api/users?page=${page.value}`);
            users.value = data;
        } catch (error) {
            console.error(error);
        } finally {
            loading.value = false;
        }
    }

    watch(page, fetchUsers);

    return {
        users,
        page,
        fetchUsers,
        loading,
    };
});