<script>
import FormWrapper from '@/Pages/FormWrapper.vue';
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
      lat: '',
      long: '',
      account_id: '',
      description: ''

    });

    const submitForm = () => {
      form.post('/submitaddlocation', {
        // onSuccess: () => alert('Location created successfully!'),
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

  <FormWrapper>




    <h3 class="text-3xl font-bold dark:text-white mb-4">Locations</h3>


    <div class="flex items-center justify-center  mb-4 rounded">

      <div class="container mx-auto mt-5">
        <!-- Add User button aligned to the right -->
        <div class="flex justify-between mb-4">
          <div class="text-lg font-semibold">Add Location</div>

          <!-- <button @click="openAddUserModal" 
          
            class="bg-blue-500 text-white w-1/3 px-4 py-2 
            rounded hover:bg-blue-600">
                Add Location
            </button> -->

        </div>

        <form class="w-full bg-white rounded" @submit.prevent="submitForm">
          <div class="mb-5">
            <label for="name" class="block mb-2 text-sm 
    font-medium text-gray-900 dark:text-white">Name</label>
            <input type="text" id="name" v-model="form.name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm 
     rounded-lg focus:ring-primary-600 focus:border-primary-600 block 
    w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 
    dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-600
     dark:focus:border-primary-600" placeholder="Name" required />
            <div v-if="form.errors.name" class="error">{{ form.errors.name }}</div>
          </div>

          <div class="mb-5">
            <label for="lat" class="block mb-2 text-sm 
    font-medium text-gray-900 dark:text-white">Lat</label>
            <input type="text" id="lat" v-model="form.lat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm 
     rounded-lg focus:ring-primary-600 focus:border-primary-600 block 
    w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 
    dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-600
     dark:focus:border-primary-600" placeholder="Lat" required />
            <div v-if="form.errors.lat" class="error">{{ form.errors.lat }}</div>
          </div>

          <div class="mb-5">
            <label for="long" class="block mb-2 text-sm 
    font-medium text-gray-900 dark:text-white">Long</label>
            <input type="text" id="long" v-model="form.long" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm 
     rounded-lg focus:ring-primary-600 focus:border-primary-600 block 
    w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 
    dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-600
     dark:focus:border-primary-600" placeholder="Long" required />
            <div v-if="form.errors.long" class="error">{{ form.errors.long }}</div>
          </div>

          <!-- <div class="mb-5">
            <label for="account_id" class="block mb-2 text-sm 
    font-medium text-gray-900 dark:text-white">Account Id</label>
            <input type="text" id="account_id" v-model="form.account_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm 
     rounded-lg focus:ring-primary-600 focus:border-primary-600 block 
    w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 
    dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-600
     dark:focus:border-primary-600" placeholder="Account Id" required />
            <div v-if="form.errors.account_id" class="error"> {{ form.errors.account_id }} </div>
          </div> -->

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
            <label for="description" class="block mb-2 text-sm 
    font-medium text-gray-900 dark:text-white">Description</label>
            <textarea id="description" rows="4" v-model="form.description" class="block p-2.5 w-full text-sm text-gray-900 
    bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-600 
    focus:border-primary-600 dark:bg-gray-700 dark:border-gray-600 
    dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-600 
    dark:focus:border-primary-600" placeholder="Description"></textarea>

            <!-- <input type="text" id="description" 
    v-model="form.description"
    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm 
     rounded-lg focus:ring-primary-600 focus:border-primary-600 block 
    w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 
    dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-600
     dark:focus:border-primary-600" placeholder="Description" required /> -->
            <div v-if="form.errors.description" class="error"> {{ form.errors.description }} </div>
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
