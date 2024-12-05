<!-- Wrapper.vue -->


<template>
    <SidebarNew />
    <div class="p-4 sm:ml-64">
        <div class="p-4 pr-6 pl-6 bg-white border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
            <slot></slot>
        </div>
    </div>

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

                <!-- <h2 class="text-lg font-bold text-green-600">Success</h2>
        <p class="mt-4 text-gray-700">{{ flashMessage }}</p>
        

                <svg class="mx-auto mb-4 text-green-400 w-12 h-12 dark:text-green-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg> -->
                <svg class="mx-auto mb-4 text-green-400 w-14 h-14 dark:text-green-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"  fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.5 11.5 11 14l4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>



                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">{{ flashMessage }}</h3>
                
                <!-- <button  @click="closeModal" data-modal-hide="popup-modal" type="button" class="w-full text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                    Close
                </button> -->
                <button
          class="w-full py-2 px-4 bg-green-500 text-white rounded-lg hover:bg-green-600 focus:outline-none"
          @click="closeModal"
        >
          Close
        </button>
                <!-- <button data-modal-hide="popup-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No, cancel</button> -->
            </div>
        </div>
    </div>
      </div>
    
  </div>


</template>

<script>
import SidebarNew from '@/Pages/Sidebarnew.vue';
import {  ref, watch } from 'vue'

const isModalOpen = ref(false);

// Access the Laravel flash message
// const successMessage = computed(() => props2.value?.flash?.success);

// Open modal automatically if a success message is present




export default {
    name: 'TableWrapper',
    components: {
        SidebarNew,
    },

    props: {
        flash: {
            type: Object,
            required: false,
        },
    },
    setup(props) {
        console.log('setup');
        console.log(props.flash);
        console.log('setup');
    },
    data() {
        return {
            isModalOpen: false,
        };
    },
    computed: {
        flashMessage() {
            if(this.flash!=undefined){
                return this.flash.message ;
            }
            
        },
    },
    
    watch: {
        flash: {
      handler(newFlash, oldFlash) {
        if (newFlash !== oldFlash) {
          // Update localFlash when flash prop changes
          this.localFlash = { ...newFlash }
          this.isModalOpen = true;

        if(this.localFlash!=undefined){
        if (this.localFlash.status === 'success') {
            this.isModalOpen = true;
        }
        }

          // Trigger any other necessary logic
          console.log('Flash updated:', this.localFlash)
        }
      },
    //   immediate: true // This makes sure the watcher is triggered on initial render
    }
    },
    methods: {
        closeModal() {
            this.isModalOpen = false;
        },
    },
    created() {
        console.log('test')
        console.log(this.flash);
        console.log('test');
        // Automatically open modal if the flash status is success on load
        if(this.flash!=undefined){
        if (this.flash.status === 'success') {
            this.isModalOpen = true;
        }
    }
    },


};
</script>
