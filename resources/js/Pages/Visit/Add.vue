<script>
import FormWrapper from '@/Pages/FormWrapper.vue';
import { Head } from '@inertiajs/vue3';
import { useForm } from '@inertiajs/vue3'; // Make sure @inertiajs/vue3 is installed
import { onMounted, computed, watch } from 'vue';
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

    accounts: {
      type: Array,
      default: () => [],
    },
    locations: {
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
      status: '',
      type: '',
      account_id: '',
      location_id: '',
      date: '',
      time: '',

    });

    // Compute filtered locations based on selected account_id
    const filteredLocations = computed(() =>
      props.locations.filter(location => location.account_id === form.account_id)
    );


    // Automatically select the first location when account changes
    watch(() => form.account_id, (newAccountId) => {
      const firstLocation = filteredLocations.value[0];
      form.location_id = firstLocation ? firstLocation.id : ''; // Set location_id to first available location
    });

    const submitForm = () => {
      form.post('/submitaddvisit', {
        // onSuccess: () => alert('Visit created successfully!'),
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






<template>

  <FormWrapper>

    <h3 class="text-3xl font-bold dark:text-white mb-4">Visits</h3>


    <div class="flex items-center justify-center  mb-4 rounded">

      <div class="container mx-auto mt-5">
        <!-- Add User button aligned to the right -->
        <div class="flex justify-between mb-4">
          <div class="text-lg font-semibold">Add Visit</div>

          <!-- <button @click="openAddUserModal" 
          
            class="bg-blue-500 text-white w-1/3 px-4 py-2 
            rounded hover:bg-blue-600">
                Add Visit
            </button> -->

        </div>

        <form class="w-full bg-white dark:bg-gray-700 rounded" @submit.prevent="submitForm">





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
              <div v-if="form.errors.account_id" class="error">{{ form.errors.account_id }}</div>


            </div>
          </div>

          <div class="mb-5">
            <label for="account_id" class="block mb-2 text-sm 
          font-medium text-gray-900 dark:text-white">Location</label>

            <div class="relative">
              <!-- <input
             v-model="form.account_id"
              type="text"
              class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
              placeholder="Account Id"
            /> -->
              <select name="location_id" v-model="form.location_id" id="HeadlineAct"
                class="bg-gray-50 mt-1.5 w-full rounded-lg border-gray-300  pe-12  text-gray-700 sm:text-sm"
                placeholder="Location Id">


                <option disabled value="">Select location</option>
                <option v-for="(location, index)  in locations" :key="index" :value="location.id">{{ location.name }}
                </option>
              </select>
              <div v-if="form.errors.location_id" class="error">{{ form.errors.location_id }}</div>


            </div>
          </div>



          <div class="mb-5">
            <label for="status" class="block mb-2 text-sm 
          font-medium text-gray-900 dark:text-white">Status</label>

            <div class="mb-5">
              <select name="status" v-model="form.status" id="HeadlineAct"
                class="mt-1.5 bg-gray-50 w-full rounded-lg border-gray-300  pe-12  text-gray-700 sm:text-sm"
                placeholder="Status">
                <option disabled value="">Select status</option>
                <option value="complete">Complete</option>
                <option value="pending">Pending</option>
                <option value="cancelled">Cancelled</option>

              </select>
            </div>
          </div>

          <div class="mb-5">
            <label for="date" class="block mb-2 text-sm 
    font-medium text-gray-900 dark:text-white">Date</label>
            <input type="date" id="date" v-model="form.date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm 
     rounded-lg focus:ring-primary-600 focus:border-primary-600 block 
    w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 
    dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-600
     dark:focus:border-primary-600" placeholder="Date" required />
            <div v-if="form.errors.date" class="error">{{ form.errors.date }}</div>
          </div>

          <div class="mb-5">
            <label for="time" class="block mb-2 text-sm 
    font-medium text-gray-900 dark:text-white">Time</label>
            <input type="time" id="time" v-model="form.time" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm 
     rounded-lg focus:ring-primary-600 focus:border-primary-600 block 
    w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 
    dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-600
     dark:focus:border-primary-600" placeholder="Time" required />
            <div v-if="form.errors.time" class="error">{{ form.errors.time }}</div>
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
   text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-primary-500 
   dark:hover:bg-primary-600 dark:focus:ring-primary-700">Submit</button>
        </form>



      </div>
    </div>

  </FormWrapper>





</template>
