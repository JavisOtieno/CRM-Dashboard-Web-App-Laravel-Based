<script>
import FormWrapper from '@/Pages/FormWrapper.vue';
// import SidebarNew from '@/Pages/Sidebarnew.vue';
// import Help from '@/Pages/Help.vue';
import { Head } from '@inertiajs/vue3';
import { useForm } from '@inertiajs/vue3'; // Make sure @inertiajs/vue3 is installed
import { onMounted } from 'vue'

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
  components: { FormWrapper },
  data() {
    return {
      isModalOpen: false,
    };
  },
  methods: {
    openModal() {
      this.isModalOpen = true;
    },
    closeModal() {
      this.isModalOpen = false;
    },
  },
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
      phone: '',
      website: '',
      address: '',

    });

    const submitForm = () => {
      form.post('/submitaddaccount', {
        onSuccess: () => { },
        onError: (errors) => {
          // Handle errors here
          // You can customize the error message as per your needs
          // const errorMessages = Object.values(errors).flat().join(', ');
          // alert(`Error(s): ${errorMessages}`);
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
                 <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
A</th>
                 <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
B</th>
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

  <FormWrapper>

    <div>



      <h3 class="text-3xl font-bold dark:text-white mb-4">Accounts</h3>


      <div class="flex items-center justify-center  mb-4 rounded">

        <div class="container mx-auto mt-5">
          <!-- Add User button aligned to the right -->
          <div class="flex justify-between mb-4">

            <div  class="text-lg dark:text-white font-semibold">Add Account</div>

            <!-- <button @click="openAddUserModal" 
          
            class="bg-blue-500 text-white w-1/3 px-4 py-2 
            rounded hover:bg-blue-600">
                Add Account
            </button> -->

          </div>

          <form class="w-full bg-white dark:bg-gray-700 rounded" @submit.prevent="submitForm">
            <div class="mb-5">
              <label for="name" class="block mb-2 text-sm 
    font-medium text-gray-900 dark:text-white">Name</label>
              <input type="text" id="name" v-model="form.name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm 
    rounded-lg focus:ring-primary-600 focus:border-primary-600 block 
    w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 
    dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-600
     dark:focus:border-primary-600" placeholder="Name" required />
              <div v-if="form.errors.name" class="error text-primary-600 dark:text-white">{{ form.errors.name }}</div>
            </div>

            <div class="mb-5">
              <label for="lat" class="block mb-2 text-sm 
    font-medium text-gray-900 dark:text-white">Phone</label>
              <input type="text" id="phone" v-model="form.phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm 
     rounded-lg focus:ring-primary-600 focus:border-primary-600 block 
    w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 
    dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-600
     dark:focus:border-primary-600" placeholder="Phone" required />
              <div v-if="form.errors.phone" class="error text-primary-600 dark:text-white">{{ form.errors.phone }}</div>
            </div>

            <div class="mb-5">
              <label for="lat" class="block mb-2 text-sm 
    font-medium text-gray-900 dark:text-white">Website</label>
              <input type="text" id="website" v-model="form.website" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm 
     rounded-lg focus:ring-primary-600 focus:border-primary-600 block 
    w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 
    dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-600
     dark:focus:border-primary-600" placeholder="Website" required />
              <div v-if="form.errors.website" class="error text-primary-600 dark:text-white">{{ form.errors.website }}</div>
            </div>

            <div class="mb-5">
              <label for="lat" class="block mb-2 text-sm 
    font-medium text-gray-900 dark:text-white">Address</label>
              <input type="text" id="address" v-model="form.address" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm 
     rounded-lg focus:ring-primary-600 focus:border-primary-600 block 
    w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 
    dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-600
     dark:focus:border-primary-600" placeholder="Address" required />
              <div v-if="form.errors.address" class="error text-primary-600 dark:text-white">{{ form.errors.address }}</div>
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

            <button type="submit" :disabled="form.processing" class="text-white bg-primary-600 hover:bg-primary-700 
  focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg
   text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-primary-600 
   dark:hover:bg-primary-700 dark:focus:ring-primary-800">Submit</button>
          </form>



        </div>
      </div>
    </div>

  </FormWrapper>






</template>
