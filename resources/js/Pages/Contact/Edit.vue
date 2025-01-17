<script>
import FormWrapper from '@/Pages/FormWrapper.vue';
import { Head } from '@inertiajs/vue3';
import { useForm } from '@inertiajs/vue3'; // Make sure @inertiajs/vue3 is installed
import MapComponent from '@/Pages/MapComponent.vue';
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
  props: {
    contact: {
      type: Object,
      required: true, // Ensure the seller data is passed as a prop
    },
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

      user: props.contact.user.name || '',
      name: props.contact.name || '',
      phone: props.contact.phone || '',
      account_id: props.contact.account_id || '',


    });

    const submitForm = () => {
      form.put(`/submiteditcontact/${props.contact.id}`, {
        onSuccess: () => {
          // alert('Contact edited successfully!');
        },
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

    <!-- <div class="flex items-center justify-center h-48 mb-4 rounded bg-gray-50 dark:bg-gray-800">
               <p class="text-2xl text-gray-400 dark:text-gray-500">
                  <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                     <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                  </svg>
               </p>
            </div> -->


    <h3 class="text-3xl font-bold dark:text-white mb-4">Contacts</h3>


    <div class="flex items-center justify-center  mb-4 rounded">

      <div class="container mx-auto mt-5">
        <!-- Add User button aligned to the right -->
        <div class="flex justify-between mb-4">
          <div  class="text-lg dark:text-white font-semibold">Edit Contact</div>

          <!-- <button @click="openAddUserModal" 
          
            class="bg-blue-500 text-white w-1/3 px-4 py-2 
            rounded hover:bg-blue-600">
                Add Contact
            </button> -->

        </div>

        <form class="w-full bg-white dark:bg-gray-700 rounded" @submit.prevent="submitForm">
          <div class="mb-5">
              <label for="user" class="block mb-2 text-sm 
          font-medium text-gray-900 dark:text-white">Seller</label>
              <input type="text" id="user" v-model="form.user" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm 
          rounded-lg focus:ring-primary-600 focus:border-primary-600 block 
          w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 
          dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-600
          dark:focus:border-primary-600" placeholder="Seller" required readonly />
              <div v-if="form.errors.user" class="error text-primary-600 dark:text-white">{{ form.errors.user }}
              </div>
            </div>
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
            <label for="account_id" class="block mb-2 text-sm 
          font-medium text-gray-900 dark:text-white">Account</label>

            <div class="relative">
              <!-- <input
             v-model="form.account_id"
              type="text"
              class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
              placeholder="Account Id"
            /> -->
              <select name="account_id" v-model="form.account_id" id="HeadlineAct"
                class="bg-gray-50 mt-1.5 w-full rounded-lg border-gray-300  pe-12  text-gray-700 sm:text-sm"
                placeholder="Account Id">


                <option disabled value="">Select account</option>
                <option v-for="(account, index)  in accounts" :key="index" :value="account.id">{{ account.name }}
                </option>
              </select>
              <div v-if="form.errors.account_id" class="error text-primary-600 dark:text-white">{{ form.errors.account_id }}</div>


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
  class="text-white bg-primary-600 hover:bg-primary-700 
  focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg
   text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-primary-500 
   dark:hover:bg-primary-600 dark:focus:ring-primary-700">Submit</button>
        </form>






      </div>
    </div>


  </FormWrapper>





</template>
