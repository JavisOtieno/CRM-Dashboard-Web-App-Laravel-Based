<template>
    
    <section class="bg-defaultbackground-50 dark:bg-defaultbackground-900" >
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <Link href="/dashboard" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                <img class="w-40 h-8 mr-2" src="/images/logo-rtms.png" alt="logo">
            </Link>
            <slot></slot>
        </div>
    </section>

    <div>
        <!-- Modal -->
        <div v-if="isModalOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-50" @click="closeModal">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <button type="button" @click="closeModal" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                        
                        
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="p-4 md:p-5 text-center">
                        
                        <svg v-if="alertStatus === 'success'" class="mx-auto mb-4 text-green-400 w-14 h-14 dark:text-green-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.5 11.5 11 14l4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                        </svg>
                        <svg v-else class="mx-auto w-14 h-14 text-red-400 w-14 h-14 dark:text-red-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 13V8m0 8h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                        </svg>


                        
                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">{{ alertMessage }}</h3>
                        <button
                        :class="buttonClass"
                            class="w-full py-2 px-4 text-white rounded-lg hover:bg-green-600 focus:outline-none"
                            @click="closeModal">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import SidebarNew from '@/Pages/Sidebarnew.vue';
import { Link } from '@inertiajs/vue3';

export default {
    name: 'TableWrapper',
    components: {
        SidebarNew, Link
    },
    props: {
        alertMessage: {
            type: String,
            default: '',
        },
        alertStatus: {
            type: String,
            default: '',
        },
    },
    data() {
        return {
            isModalOpen: false,
        };
    },
    watch: {
        alertMessage: {
        handler(newMessage) {
            if (newMessage) {
                this.isModalOpen = true;
            }
        },
        immediate: true,
    },
        

    },
    computed: {
    buttonClass() {
        return this.alertStatus === 'success'
            ? 'bg-green-500 hover:bg-green-600'
            : 'bg-red-500 hover:bg-red-600';
    },
},
    methods: {
        closeModal() {
            this.isModalOpen = false;
            this.$emit('reset-alerts'); // Add this if parent handles resetting
        },
    },
};
</script>
