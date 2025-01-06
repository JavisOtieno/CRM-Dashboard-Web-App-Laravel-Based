<script setup>
import { DataTable } from "simple-datatables";
import { Link } from '@inertiajs/vue3';
import { onMounted, onBeforeUnmount, ref, computed, watch  } from 'vue'
import { useForm, usePage, router } from '@inertiajs/vue3'
// import SidebarNew from '@/Pages/Sidebarnew.vue';
import TableWrapper from '@/Pages/TableWrapper.vue';
import { useUserStore } from '../../store/user';

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



const form = useForm({});
const imageUrl = '/images/logo-dark.png';

// Access the Pinia store
const userStore = useUserStore();

// Reactive data from the store
const user = userStore.user;

console.log("user");
console.log(user);
console.log("user");





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

    function testAlert(accountId) {
    alert(accountId);

//   selectedAccount.value = account.id; // Set the selected product data
//   isModalVisible.value = true; // Show the modal
}
    const tableElement = document.getElementById("search-table");
  if (tableElement && typeof DataTable !== "undefined") {
    dataTable = new DataTable(tableElement, {
      searchable: true,
      sortable: true,
    //   order: [[3, 'desc']], 
    });
    // alert('yes');
    // $('#search-table').DataTable({
    //     order: [[0, 'desc']] // Sorting the first column (index 0) in descending order
    //   })
  }
})

const selectedAccount = ref(null);

function openModal(account) {
    alert(account.id);

  selectedAccount.value = account.id; // Set the selected product data
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
  accounts: {
    type: Object,
    default: () => [],
  },
  flash: {
    type: Object,
    default: () => [],
  },
  paginationInfo: {
    type: Object,
    default: () => []
  },
  filters: {
    type: Object,
    default: () => []
  }


});

const sortedAccounts = computed(() => {
  return props.accounts.slice().sort((a, b) => b.id - a.id);
});
console.log("accounts");
console.log(props.accounts);
console.log("accounts");

const { props2 } = usePage();

const isModalOpen = ref(false);
const modalMessage = ref(null);

const accountstest = ref(props.accounts);
const filters = ref(props.filters);

function updateSearch() {
    // console.log(filters.value);
  router.get(route('altaccounts'), {...filters.value} , 
  { preserveState: true }
);
}
// Function to handle the Enter key press
function handleKeydown(event) {
  if (event.key === 'Enter') {
    updateSearch();  // Call updateSearch when Enter is pressed
  }
}

function fetchPage(link) {
  router.get(link.url,  {...filters.value},
   { preserveState: true }

  );
}

// Watch for updates in props
watch(
  () => props.accounts,
  (newProps) => {
    // accounts.value = newProps.accounts;
    // filters.value = newProps.filters;

    console.log(props.accounts.value);
    console.log(filters.value);
  }
);


// Access the Laravel flash message
// const successMessage = computed(() => props2.value?.flash?.success);

// Open modal automatically if a success message is present


// Close modal function
const closeModal = () => {
  isModalOpen.value = false;
};

const flashStatus = props.flash.status;
const flashMessage = props.flash.message;
modalMessage.value = props.flash.message;
// alert(flashStatus);

if (flashStatus === 'success') {
  isModalOpen.value = true;
}

// console.log(flashStatus);
// const flashMessage = computed(() => props2.value?.flash?.message);

console.log(props.flash);

const deleteAccount = () => {
    // alert(selectedAccount.value);
//   if (confirm('Are you sure you want to delete this account?')) {
    form.delete(`/deleteaccount/${selectedAccount.value}`, {
      onSuccess: () => {
        isModalOpen.value = true;
        modalMessage.value = 'Account deleted successfully';
        // alert('Account deleted successfully!');
        // window.location.reload(); // Reload the page on success
      },
    //   preserveState: true, 
    });
//   }
};


if (document.getElementById("search-table") && typeof simpleDatatables.DataTable !== 'undefined') {
    const dataTable = new simpleDatatables.DataTable("#search-table", {
        searchable: true,
        sortable: true,
        // order: [[0, 'desc']], 
    });
}

const capitalizeFirstLetter= (string) => {
      if (!string) return '';
      return string.charAt(0).toUpperCase() + string.slice(1);
    }

</script>
<template>


  
  
<TableWrapper>

     <div>
  
        
        <!-- <div class="flex items-center justify-center h-48 mb-4 rounded bg-gray-50 dark:bg-gray-800">
           <p class="text-2xl text-gray-400 dark:text-gray-500">
              <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                 <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
              </svg>
           </p>
        </div> -->


        <h3 class="text-3xl font-bold dark:text-white mb-4">Accounts</h3>
        

        <div class="flex items-center justify-center  mb-4 rounded">
           <!-- <p class="text-2xl text-gray-400 dark:text-gray-500">
              <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                 <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
              </svg>
           </p> -->

           <div class="container mx-auto mt-5">
        <!-- Add User button aligned to the right -->
        <div class="flex justify-between mb-4">
        <div  class="text-lg dark:text-white font-semibold">Accounts Table</div>
        
        
        
        <Link :href="route('addaccount')"  as="button"  class="bg-primary-600 text-white w-1/3 px-4 py-2 
            rounded hover:bg-primary-700">
                Add Account

        </Link>
        
        </div>





        

<div class="relative overflow-x-auto sm:rounded-lg">
    
    <div class="flex flex-column sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-between pb-4 p-1">
        <div>
            <button id="dropdownRadioButton" data-dropdown-toggle="dropdownRadio" class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700 p-2" type="button">
                <!-- <svg class="w-3 h-3 text-gray-500 dark:text-gray-400 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm3.982 13.982a1 1 0 0 1-1.414 0l-3.274-3.274A1.012 1.012 0 0 1 9 10V6a1 1 0 0 1 2 0v3.586l2.982 2.982a1 1 0 0 1 0 1.414Z"/>
                    </svg> -->
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
  <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M5 7h14M5 12h14M5 17h14"/>
</svg>

                Show 10 entries
                <svg class="w-2.5 h-2.5 ms-2.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                </svg>
            </button>
            <!-- Dropdown menu -->
            <div id="dropdownRadio" class="z-10 hidden w-48 bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600" data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="top" style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate3d(522.5px, 3847.5px, 0px);">
                <ul class="p-3 space-y-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownRadioButton">
                    <li>
                        <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                            <input id="filter-radio-example-1" type="radio" value="" name="filter-radio" class="w-4 h-4 text-primary-600 bg-gray-100 border-gray-300 focus:ring-primary-600 dark:focus:ring-primary-700 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="filter-radio-example-1" class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">Show 10 entries</label>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                            <input checked="" id="filter-radio-example-2" type="radio" value="" name="filter-radio" class="w-4 h-4 text-primary-600 bg-gray-100 border-gray-300 focus:ring-primary-600 dark:focus:ring-primary-700 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="filter-radio-example-2" class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">Show 15 entries</label>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                            <input id="filter-radio-example-3" type="radio" value="" name="filter-radio" class="w-4 h-4 text-primary-600 bg-gray-100 border-gray-300 focus:ring-primary-600 dark:focus:ring-primary-700 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="filter-radio-example-3" class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">Show 20 entries</label>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                            <input id="filter-radio-example-4" type="radio" value="" name="filter-radio" class="w-4 h-4 text-primary-600 bg-gray-100 border-gray-300 focus:ring-primary-600 dark:focus:ring-primary-700 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="filter-radio-example-4" class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">Show 25 entries</label>
                        </div>
                    </li>
                   
                </ul>
            </div>
        </div>
        <label for="table-search" class="sr-only">Search</label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 rtl:inset-r-0 rtl:right-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
            </div>
            <!-- <input type="text" id="table-search" class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-primary-600 focus:border-primary-600 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-600 dark:focus:border-primary-600" placeholder="Search for items"> -->
           
            <!-- @keydown="handleKeydown"   -->
            <input
        type="text"
        v-model="filters.search"
        @input="updateSearch"
        

        id="table-search"
        class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-primary-600 focus:border-primary-600 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-600 dark:focus:border-primary-600"
        placeholder="Search for accounts"
      />
        </div>
    </div>
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <!-- <th scope="col" class="p-4">
                    <div class="flex items-center">
                        <input id="checkbox-all-search" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="checkbox-all-search" class="sr-only">checkbox</label>
                    </div>
                </th> -->
                <th scope="col" class="px-6 py-3">
                    ID
                </th>
                <th scope="col" class="px-6 py-3">
                    Account Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Phone
                </th>
                <th scope="col" class="px-6 py-3">
                    Website
                </th>
                <th scope="col" class="px-6 py-3">
                    Address
                </th>
                <th scope="col" class="px-6 py-3">
                    Actions
                </th>
            </tr>
        </thead>
        <tbody>
            <tr  v-for="(account, index) in accounts.data" :key="index" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <!-- <td class="w-4 p-4">
                    <div class="flex items-center">
                        <input id="checkbox-table-search-1" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                    </div>
                </td> -->
                <th scope="row"  class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ account.id }}
                </th>
                <td class="px-6 py-4">
                    {{ account.name }}
                </td>
                <td class="px-6 py-4">
                    {{ account.phone }}
                </td>
                <td class="px-6 py-4">
                    {{ account.website }}
                </td>
                <td class="px-6 py-4">
                    {{ account.address }}
                </td>
                <td class="px-6 py-4">
                    <a :href="`/editaccount/${account.id}`" class="font-medium text-primary-600 dark:text-primary-700 hover:underline">Edit</a>
                    <a :href="`/deleteaccount/${account.id}`" class="ml-2 font-medium text-primary-600 dark:text-primary-700 hover:underline">Delete</a>

                
                </td>
            </tr>

        </tbody>
    </table>
    <nav class="flex items-center flex-column flex-wrap md:flex-row justify-between pt-4" aria-label="Table navigation">
        <!-- <span class="text-sm font-normal text-gray-500 dark:text-gray-400 mb-4 md:mb-0 block md:inline w-auto">Showing <span class="font-semibold text-gray-900 dark:text-white">1-10</span> of <span class="font-semibold text-gray-900 dark:text-white">1000</span></span> -->
        <span
      v-if="paginationInfo"
      class="text-sm font-normal text-gray-500 dark:text-gray-400 mb-4 md:mb-0 block md:inline w-auto"
    >
      Showing
      <span class="font-semibold text-gray-900 dark:text-white">{{ paginationInfo.from }}</span>
      -
      <span class="font-semibold text-gray-900 dark:text-white">{{ paginationInfo.to }}</span>
      of
      <span class="font-semibold text-gray-900 dark:text-white">{{ paginationInfo.total }}</span>
    </span>
        <ul class="inline-flex -space-x-px rtl:space-x-reverse text-sm h-8">
    <!-- Previous Link -->
    <!-- <li>
      <a
        :href="accounts.prev_page_url ? accounts.prev_page_url : '#'"
        :class="[
          'flex items-center justify-center px-3 h-8 ms-0 leading-tight border',
          'text-gray-500 bg-white border-gray-300 hover:bg-gray-100 hover:text-gray-700' : 'text-gray-300 bg-gray-100 border-gray-200 cursor-not-allowed',
        ]"
        :aria-disabled="!accounts.prev_page_url"
      >
        Previous
      </a>
    </li> -->

    <!-- Page Links -->
     <!-- :href="link.url ? link.url : '#'" -->
    <li
      v-for="link in accounts.links"
      :key="link.label"
    >
      <a
      @click="fetchPage(link)"
        
        :class="[
          'flex items-center justify-center px-3 h-8 leading-tight border',
          link.active ? 'text-primary-600 bg-primary-50 border-primary-300' : 'text-gray-500 bg-white border-gray-300 hover:bg-gray-100 hover:text-gray-700',
        ]"
        :aria-current="link.active ? 'page' : null"
        class="cursor-pointer"
      >
        <span v-html="link.label"></span>
      </a>
    </li>

    <!-- Next Link -->
    <!-- <li>
      <a
        :href="accounts.next_page_url ? accounts.next_page_url : '#'"
        :class="[
          'flex items-center justify-center px-3 h-8 ms-0 leading-tight border',
          accounts.next_page_url ? 'text-gray-500 bg-white border-gray-300 hover:bg-gray-100 hover:text-gray-700' : 'text-gray-300 bg-gray-100 border-gray-200 cursor-not-allowed',
        ]"
        :aria-disabled="!accounts.next_page_url"
      >
        Next
      </a>
    </li> -->
  </ul>
    </nav>
</div>

           

</div>


        </div>
        <!-- <div class="grid grid-cols-2 gap-4">
           <div class="flex items-center justify-center rounded bg-gray-50 h-28 dark:bg-gray-800">
              <p class="text-2xl text-gray-400 dark:text-gray-500">
                 <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                 </svg>
              </p>
           </div>
           <div class="flex items-center justify-center rounded bg-gray-50 h-28 dark:bg-gray-800">
              <p class="text-2xl text-gray-400 dark:text-gray-500">
                 <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                 </svg>
              </p>
           </div>
           <div class="flex items-center justify-center rounded bg-gray-50 h-28 dark:bg-gray-800">
              <p class="text-2xl text-gray-400 dark:text-gray-500">
                 <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                 </svg>
              </p>
           </div>
           <div class="flex items-center justify-center rounded bg-gray-50 h-28 dark:bg-gray-800">
              <p class="text-2xl text-gray-400 dark:text-gray-500">
                 <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                 </svg>
              </p>
           </div>
        </div> -->
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
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this account?</h3>
                <button @click="deleteAccount()" data-modal-hide="popup-modal" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                    Yes, I'm sure
                </button>
                <button data-modal-hide="popup-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No, cancel</button>
            </div>
        </div>
    </div>
</div>

<!-- <div id="popup-modal-success" tabindex="-1" class="fixed overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">

</div> -->

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



                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">{{ modalMessage }}</h3>
                
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

<style scoped>
/* Ensure cursor is a pointer on pagination links */
.cursor-pointer {
  cursor: pointer;
}
</style>