<script setup>
import { DataTable } from "simple-datatables";
import { Link } from '@inertiajs/vue3';
import { onMounted, onBeforeUnmount, ref, computed, toRefs } from 'vue'
import { useForm, usePage } from '@inertiajs/vue3'
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

    const people = ref([
  { name: "John Doe", age: 30, city: "New York" },
  { name: "Jane Smith", age: 25, city: "Los Angeles" },
  { name: "Sam Wilson", age: 40, city: "Chicago" },
]);
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

const selectedMeeting = ref(null);

function openModal(meeting) {
    // alert(account.id)

  selectedMeeting.value = meeting.id; // Set the selected product data
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
  meetings: {
    type: Array,
    default: () => [],
  },
  
});

const deleteMeeting = () => {
    // alert(selectedMeeting.value);
//   if (confirm('Are you sure you want to delete this meeting?')) {
    form.delete(`/deletemeeting/${selectedMeeting.value}`, {
      onSuccess: () => {
        // alert('Meeting deleted successfully!');
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

    import { useStore } from 'vuex';
    const store = useStore();
    const message = computed(() => store.state.message);
    const changeMessage = () => {
    var message = " textadd";
    store.dispatch('updateMessage', 'Updated message from Vuex!'+message);
    };


    // Access the flash message from the Inertia props
    const page = usePage();
    const flash = computed(() => page.props.flash || null);

</script>
<template>



<TableWrapper :flash="flash">

        <h3 class="text-3xl font-bold dark:text-white mb-4">Meetings</h3>
        

        <div class="flex items-center justify-center  mb-4 rounded">


            <div class="container mx-auto mt-5">
        <!-- Add User button aligned to the right -->
        <div class="flex justify-between mb-4">
        <div class="text-lg font-semibold">Meetings Table</div>
        
        
        
             <Link :href="route('addmeeting')"  as="button"  class="bg-primary-600 text-white w-1/3 px-4 py-2 
            rounded hover:bg-primary-700">
                Add Meeting

        </Link>
        
        </div>
           
           <!-- <p class="text-2xl text-gray-400 dark:text-gray-500">
              <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                 <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
              </svg>
           </p> -->
           


           
<table id="search-table">
    <thead>
        <tr>
            <th>
                <span class="flex items-center">
                    ID
                </span>
            </th>
            <th>
                <span class="flex items-center">
                 Account
                </span>
            </th>
            <th>
                <span class="flex items-center">
                 Contact
                </span>
            </th>
            <th>
                <span class="flex items-center">
                    Status
                </span>
            </th>
            <th><span class="flex items-center">Actions</span></th>
        </tr>
    </thead>
    <tbody>
        <tr v-for="(meeting, index) in meetings" :key="index">
                <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ meeting.id }}</td>
                <td>{{ meeting.account.name }}</td>
                <td>{{ meeting.contact.name }}</td>
                <td>{{ capitalizeFirstLetter(meeting.status) }}</td>
                
                
                <td>

<span class="inline-flex overflow-hidden rounded-md border bg-white shadow-sm">
<Link
:href="`/editmeeting/${meeting.id}`"
class="inline-block border-e p-2 text-primary-700 hover:bg-primary-50 focus:relative"
title="Edit Meeting"
>
<svg
xmlns="http://www.w3.org/2000/svg"
fill="none"
viewBox="0 0 24 24"
stroke-width="1.5"
stroke="currentColor"
class="size-4"
>
<path
stroke-linecap="round"
stroke-linejoin="round"
d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"
/>
</svg>
</Link>

<button
class="inline-block p-2 text-primary-700 hover:bg-primary-50 focus:relative"
title="Delete Meeting"
:disabled="form.processing"
@click="openModal(meeting)"
data-modal-target="popup-modal" data-modal-toggle="popup-modal"
>
<svg
xmlns="http://www.w3.org/2000/svg"
fill="none"
viewBox="0 0 24 24"
stroke-width="1.5"
stroke="currentColor"
class="size-4"
>
<path
stroke-linecap="round"
stroke-linejoin="round"
d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
/>
</svg>
</button>
</span>
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
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this meeting?</h3>
                <button @click="deleteMeeting()" data-modal-hide="popup-modal" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                    Yes, I'm sure
                </button>
                <button data-modal-hide="popup-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No, cancel</button>
            </div>
        </div>
    </div>
</div>

</template>