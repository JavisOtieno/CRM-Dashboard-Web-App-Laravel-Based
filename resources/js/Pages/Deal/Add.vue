<script>
import SidebarNew from '@/Pages/Sidebarnew.vue';
import { Head } from '@inertiajs/vue3';
import { useForm } from '@inertiajs/vue3'; // Make sure @inertiajs/vue3 is installed
import { onMounted  } from 'vue'
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
    initTooltips
 } from 'flowbite'

export default {
  components: { SidebarNew },
  props: {

    accounts: {
      type: Array,
      default: () => [],
    },
  },
  setup(props) {

    onMounted(() => {
      // Initialization code for the profile pop-up
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
    });
    // Initialize form state with useForm

    const form = useForm({
      name: '',
      amount: '',
      status: 'pending',
      account_id: '',

    });
    
    const submitForm = () => {
      form.post('/submitadddeal', {
        // onSuccess: () => alert('Deal created successfully!'),
        onError: (errors) => {
            // Handle errors here
            // You can customize the error message as per your needs
            const errorMessages = Object.values(errors).flat().join(', ');
            alert(`Error(s): ${errorMessages}`);
        },
      });
    };

    return { form, submitForm };


    
  },
};
</script>

 
<!-- <template>

    <DataTable :data="data" class="display">
        <thead>
            <tr>
                <th>A</th>
                <th>B</th>
            </tr>
        </thead>
    </DataTable>

</template> -->

<!-- <template>
            <Head title="Dashboard" />

<AuthenticatedLayout>

</AuthenticatedLayout>
</template> -->



<template>

    <SidebarNew/>
      
      
      <div class="p-4 sm:ml-64">
         <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg 
         dark:border-gray-700 mt-14">
            
            <!-- <div class="flex items-center justify-center h-48 mb-4 rounded bg-gray-50 dark:bg-gray-800">
               <p class="text-2xl text-gray-400 dark:text-gray-500">
                  <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                     <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                  </svg>
               </p>
            </div> -->
    
    
    
    
    
    
    
    
    
    
    
            <h3 class="text-3xl font-bold dark:text-white mb-4">Deals</h3>
            
    
            <div class="flex items-center justify-center  mb-4 rounded">
                
                <div class="container mx-auto mt-5">
        <!-- Add User button aligned to the right -->
        <div class="flex justify-between mb-4">
        <div class="text-lg font-semibold">Add Deal</div>
        
            <!-- <button @click="openAddUserModal" 
          
            class="bg-blue-500 text-white w-1/3 px-4 py-2 
            rounded hover:bg-blue-600">
                Add Deal
            </button> -->
        
        </div>

<form class="w-full md:w-3/4 lg:w-2/3  bg-white rounded"
@submit.prevent="submitForm" >
  <div class="mb-5">
    <label for="name" class="block mb-2 text-sm 
    font-medium text-gray-900 dark:text-white">Name</label>
    <input type="text" id="name" 
    v-model="form.name"
    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm 
    rounded-lg focus:ring-blue-500 focus:border-blue-500 block 
    w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 
    dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500
     dark:focus:border-blue-500" placeholder="Name" required />
     <div v-if="form.errors.name" class="error">{{ form.errors.name }}</div>
  </div>

  <div class="mb-5">
    <label for="lat" class="block mb-2 text-sm 
    font-medium text-gray-900 dark:text-white">Amount</label>
    <input type="text" id="amount" 
    v-model="form.amount"
    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm 
    rounded-lg focus:ring-blue-500 focus:border-blue-500 block 
    w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 
    dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500
     dark:focus:border-blue-500" placeholder="Amount" required />
     <div v-if="form.errors.amount" class="error">{{ form.errors.amount }}</div>
  </div>




  <div class="mb-5">
          <label for="account_id" class="block mb-2 text-sm 
          font-medium text-gray-900 dark:text-white">Account</label>
  
          <div class="relative">
            <!-- <input
             v-model="form.account_id"
              type="text"
              class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
              placeholder="Account Id"
            /> -->
            <select
    name="account_id"
    v-model="form.account_id"
    id="HeadlineAct"
    class="bg-gray-50 mt-1.5 w-full rounded-lg border-gray-300  pe-12  text-gray-700 sm:text-sm"
    placeholder="Account Id"
    
  >


  <option disabled value="">Select account</option>
    <option  v-for="(account, index)  in accounts" :key="index" :value="account.id">{{ account.name }}</option>
  </select>
            <div v-if="form.errors.account_id" class="error">{{ form.errors.account_id }}</div>
  
            
          </div>
        </div>

  

        <div class="mb-5">
          <label for="status" class="block mb-2 text-sm 
          font-medium text-gray-900 dark:text-white">Status</label>
  
          <div class="mb-5">
        <select
    name="status"
    v-model="form.status"
    id="HeadlineAct"
    class="mt-1.5 bg-gray-50 w-full rounded-lg border-gray-300  pe-12  text-gray-700 sm:text-sm"
    placeholder="Status"
    
  >
  <option disabled value="">Select status</option>
   <option value="complete">Complete</option>
    <option value="pending">Pending</option>
    <option value="cancelled">Cancelled</option> 

  </select>
  </div>
  </div>

 

            
  <!-- <div class="mb-5">
    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
    <input type="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
  </div> -->
  <!-- <div class="flex items-start mb-5">
    <div class="flex items-center h-5">
      <input id="remember" type="checkbox" value="" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800" required />
    </div>
    <label for="remember" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Remember me</label>
  </div> -->
  <button type="submit" 
  :disabled="form.processing"
  class="text-white bg-blue-700 hover:bg-blue-800 
  focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg
   text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 
   dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
</form>

    
    
            </div>
           </div>
         </div>
      </div>
      
    
    

    
    </template>
