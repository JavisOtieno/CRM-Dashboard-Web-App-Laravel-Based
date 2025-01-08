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
    admin: {
      type: Object,
      required: true, // Ensure the admin data is passed as a prop
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

    const handleFileChange = (event) => {
      form.file = event.target.files[0]; // Assign the file to the form
    };
    // Initialize form state with useForm
    const form = useForm({
      name: props.admin.name || '',
      phone: props.admin.phone || '',
      email: props.admin.email || '',
      // password: '',
      status: props.admin.status || '',
      file: null,

    });

    const submitForm = () => {
      // Create a FormData object
      const formData = new FormData();
      formData.append('name', form.name);
      formData.append('phone', form.phone);
      formData.append('email', form.email);
      // formData.append('password', form.password);
      formData.append('status', form.status);
      formData.append('file', form.file);
      console.log('form' + form.name + ' ' + form.phone + ' ' + form.email + ' ' +  ' ' + form.status);

      form.put(`/submiteditadmin/${props.admin.id}`, formData, {
        onSuccess: () => {
          alert('Admin edited successfully!');
          form.reset(); // Optional: reset the form after submission
        },
        onError: (errors) => {
          // Display validation errors for each field, if available
          console.error("Form submission errors:", errors);
          Object.keys(errors).forEach(field => {
            alert(`Error in ${field}: ${errors[field]}`);

          });
        }
      });
    };

    return { form, submitForm, handleFileChange, };


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

    <h3 class="text-3xl font-bold dark:text-white mb-4">Admins</h3>

    <div class="flex items-center justify-center  mb-4 rounded">

      <div class="container mx-auto mt-5">
        <!-- Add User button aligned to the right -->
        <div class="flex justify-between mb-4">
          <div class="text-lg font-semibold dark:text-white">Are you sure you want to delete?</div>

          <!-- <button @click="openAddUserModal" 
          
            class="bg-blue-500 text-white w-1/3 px-4 py-2 
            rounded hover:bg-blue-600">
                Add Admin
            </button> -->

        </div>

        <form class="w-full bg-white dark:bg-gray-700 rounded" @submit.prevent="submitForm">
            <button type="submit" :disabled="form.processing" class="text-white bg-primary-600 hover:bg-primary-700 
  focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg
   text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-primary-500 
   dark:hover:bg-primary-600 dark:focus:ring-primary-700 mb-4">Confirm Delete</button>
          <div class="mb-5">
            <label for="name" class="block mb-2 text-sm 
    font-medium text-gray-900 dark:text-white">Name</label>
            <input type="text" id="name" v-model="form.name" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm 
     rounded-lg focus:ring-primary-600 focus:border-primary-600 block 
    w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 
    dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-600

     dark:focus:border-primary-600" placeholder="Name" required readonly />
            <div v-if="form.errors.name" class="error text-primary-600 dark:text-white">{{ form.errors.name }}</div>
          </div>

          <div class="mb-5">
            <label for="phone" class="block mb-2 text-sm 
    font-medium text-gray-900 dark:text-white">Phone</label>
            <input type="text" id="phone" v-model="form.phone" name="phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm 
     rounded-lg focus:ring-primary-600 focus:border-primary-600 block 
    w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 
    dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-600
     dark:focus:border-primary-600" placeholder="Phone" required readonly />
            <div v-if="form.errors.phone" class="error text-primary-600 dark:text-white">{{ form.errors.phone }}</div>
          </div>

          <!-- <div class="mb-5">
    <label for="image" class="block mb-2 text-sm 
    font-medium text-gray-900 dark:text-white">Image</label>
    <input type="file" @change="handleFileChange" name="file" accept="image/*" id="file" required />
      <div v-if="form.errors.file" class="error text-primary-600 dark:text-white">{{ form.errors.file }}</div>
    
  </div> -->

          <div class="mb-5">
            <label for="email" class="block mb-2 text-sm 
    font-medium text-gray-900 dark:text-white">Email</label>
            <input type="email" id="email" v-model="form.email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm 
     rounded-lg focus:ring-primary-600 focus:border-primary-600 block 
    w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 
    dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-600
     dark:focus:border-primary-600" placeholder="Email" required readonly/>
            <div v-if="form.errors.email" class="error text-primary-600 dark:text-white">{{ form.errors.email }}</div>
          </div>









          <div class="mb-5">
            <label for="status" class="block mb-2 text-sm 
               
          font-medium text-gray-900 dark:text-white">Status</label>

            <div class="mb-5">
              <select name="status" v-model="form.status" id="HeadlineAct"
                class="mt-1.5 bg-gray-50 dark:bg-gray-700 dark:text-white w-full rounded-lg border-gray-300  
                focus:ring-primary-600 focus:border-primary-600 
                dark:focus:ring-primary-600 focus:border-primary-600 
                pe-12  text-gray-700 sm:text-sm"
                placeholder="Status" disabled>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>

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

        </form>



      </div>
    </div>

  </FormWrapper>


</template>
