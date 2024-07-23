import { ref } from 'vue';
import { defineStore } from 'pinia'

export const useUsersStore = defineStore('users', () => {
    const users = ref([]);
    const count = ref(0);

    const increment = () => {
        count.value++;
    };

    return {
        users,
        count,
        increment,
    };
});