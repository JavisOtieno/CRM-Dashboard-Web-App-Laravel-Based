<script setup>
import { DataTable } from "simple-datatables";
import { Link } from '@inertiajs/vue3';
import { onMounted, onBeforeUnmount, ref, computed } from 'vue'
import { useForm } from '@inertiajs/vue3'
import { usePage } from '@inertiajs/vue3'
import TableWrapper from '@/Pages/TableWrapper.vue';
import { 
    initAccordions, 
    initCarousels, 
    initCollapses, 
    initDials, 
    initDismisses, 
    initDrawers, 
    initDropdowns, 
    initModals, 
    Modal,
    initPopovers, 
    initTabs, 
    initTooltips } from 'flowbite'



import { useUserStore } from '../../store/user';
const userStore = useUserStore();
const user = userStore.user;

const form = useForm({});
const imageUrl = '/images/logo-dark.png';

// initialize components based on data attribute selectors
onMounted(() => {
    initAccordions();
    initCarousels();
    initCollapses();
    initDials();
    initDismisses();
    initDrawers();
    initDropdowns();
    initModals();
    initPopovers();
    initTabs();
    initTooltips();
    const tableElement = document.getElementById("search-table");
  if (tableElement && typeof DataTable !== "undefined") {
    dataTable = new DataTable(tableElement, {
      searchable: true,
      sortable: false,
    });
  }
})

const selectedLead = ref(null);

function openModal(lead) {
    // alert(lead.id)

  selectedLead.value = lead.id; // Set the selected product data
//   isModalVisible.value = true; // Show the modal
}



let dataTable;

// onMounted(() => {

// });

onBeforeUnmount(() => {
  if (dataTable) {
    dataTable.destroy();
    dataTable = null;
  }
});

const props = defineProps({
  leads: {
    type: Array,
    default: () => [],
  },

});

const deleteLead = () => {
    // alert(selectedLead.value);
//   if (confirm('Are you sure you want to delete this lead?')) {
    form.delete(`/deletelead/${selectedLead.value}`, {
      onSuccess: () => {
        // alert('Lead deleted successfully!');
        // window.location.reload(); // Reload the page on success
      },
    //   preserveState: true, 
    });
//   }
};


if (document.getElementById("search-table") && typeof simpleDatatables.DataTable !== 'undefined') {
    const dataTable = new simpleDatatables.DataTable("#search-table", {
        searchable: true,
        sortable: false
    });
}

const capitalizeFirstLetter= (string) => {
      if (!string) return '';
      return string.charAt(0).toUpperCase() + string.slice(1);
    }

    // Access the flash message from the Inertia props
    const page = usePage();
    const flash = computed(() => page.props.flash || null);

</script>
<template>

<TableWrapper :flash="flash">
        
        <!-- <div class="flex items-center justify-center h-48 mb-4 rounded bg-gray-50 dark:bg-gray-800">
           <p class="text-2xl text-gray-400 dark:text-gray-500">
              <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                 <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
              </svg>
           </p>
        </div> -->



        <h3 class="text-3xl font-bold dark:text-white mb-4">Leads</h3>
        

        <div class="flex items-center justify-center  mb-4 rounded">
           <!-- <p class="text-2xl text-gray-400 dark:text-gray-500">
              <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                 <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
              </svg>
           </p> -->

           <div class="container mx-auto mt-5">
        <!-- Add User button aligned to the right -->
        <div class="flex justify-between mb-4">
        <div  class="text-lg dark:text-white font-semibold">Leads Table</div>
        
        
        
        <Link :href="route('addlead')"  as="button"  class="bg-primary-600 text-white w-1/3 px-4 py-2 
            rounded hover:bg-primary-700">
                Add Lead

        </Link>
        
        </div>
           


           
<table id="search-table" class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
    <thead class="bg-gray-100 dark:bg-gray-800">
        <tr>
             <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">

                <span class="flex items-center">
                    ID
                </span>
            </th>
            <th  v-if="user.usertype === 'admin'">
                <span class="flex items-center">
                    Seller
                </span>
            </th>
             <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">

                <span class="flex items-center">
                    Lead Name
                </span>
            </th>
             <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">

                <span class="flex items-center">
                    Phone
                </span>
            </th>
            
             <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">

                <span class="flex items-center">
                    Account Name
                </span>
            </th>
             <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
<span class="flex items-center">Actions</span></th>
        </tr>
    </thead>
    <tbody>
        <tr class="hover:bg-gray-100 dark:hover:bg-gray-800" v-for="(lead, index) in leads" :key="index">
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                    {{ lead.id }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300"  v-if="user.usertype === 'admin'">{{ lead.user.name }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">{{ lead.contacts[0].name }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">{{ lead.contacts[0].phone }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">{{ lead.name }}</td>
                
                <td class="px-6 py-4 whitespace-nowrap text-sm">
                <div class="flex space-x-2">
                    <a :href="`/editlead/${lead.id}`" class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-blue-500 rounded-md hover:bg-blue-600">
                        Edit
                    </a>
                    <a :href="`/deletelead/${lead.id}`" class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-red-500 rounded-md hover:bg-red-600">
                        Delete
                    </a>
                </div>
            </td>
        </tr>
        
    </tbody>
</table>
</div>


        </div>

</TableWrapper>


<div id="popup-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-4 md:p-5 text-center">
                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this lead?</h3>
                <button @click="deleteLead()" data-modal-hide="popup-modal" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                    Yes, I'm sure
                </button>
                <button data-modal-hide="popup-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No, cancel</button>
            </div>
        </div>
    </div>
</div>
  




</template>