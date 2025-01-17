<script>
import Sidebar from '@/Pages/Sidebar.vue';
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useForm } from '@inertiajs/vue3'; // Make sure @inertiajs/vue3 is installed
import { 
    // initAccordions, 
    // initCarousels, 
    // initCollapses, 
    // initDials, 
    // initDismisses, 
    // initDrawers, 
    // initDropdowns, 
    // initModals, 
    // Modal,
    // initPopovers, 
    // initTabs, 
    // initTooltips
 } from 'flowbite'

export default {
  components: { Sidebar,AuthenticatedLayout },
  setup() {
    const handleFileChange = (event) => {
      form.file = event.target.files[0]; // Assign the file to the form
    };
    // Initialize form state with useForm
    const form = useForm({
      name: '',
      phone: '',
      email: '',
      password: '',
      status: 'active',
      file: null,

    });

    // const submitForm = () => {
    //   form.post('/submitaddseller', {
    //     onSuccess: () => alert('Seller created successfully!'),
    //   });
    // };

    const submitForm = () => {
      // Create a FormData object
      const formData = new FormData();
      formData.append('name', form.name);
      formData.append('phone', form.phone);
      formData.append('email', form.email);
      formData.append('password', form.password);
      formData.append('status', form.status);
      formData.append('file', form.file);

      form.post('/submitaddseller', formData, {
        onSuccess: () => {
          alert('Seller created successfully!');
          form.reset(); // Optional: reset the form after submission
        },
        onError: () => {
          // Handle errors if needed
        },
      });
    };

    return { form, submitForm,handleFileChange, };
    
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
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <!-- <template #header>
  <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
  <div class="flex justify-between items-start mt-4"> 
    <label for="HeadlineAct" class="block text-sm font-medium text-gray-900"> Headliner </label>
    
    <select
      name="HeadlineAct"
      id="HeadlineAct"
      class="mt-1.5 rounded-lg border-gray-300 text-gray-700 sm:text-sm"
    >
      <option value="">Please select</option>
      <option value="JM">John Mayer</option>
    </select>
  </div>
</template> -->


        <div class="flex h-screen">
  <!-- Sidebar -->

    <Sidebar/>

    

   

  <!-- Main Content -->

  <div class="flex-1 p-6">
    <!-- Your main content goes here -->
    <h1 class="text-2xl font-bold">Add Seller</h1>
    <!-- <p class="mt-4">This is where you can add your main content.</p> -->



    <!--
  Heads up! 👋

  This component comes with some `rtl` classes. Please remove them if they are not needed in your project.
-->

<div class="rounded-lg border border-gray-200">
  <div class="overflow-x-auto rounded-t-lg">
   



 
<!--
  Heads up! 👋

  Plugins:
    - @tailwindcss/forms
-->
<div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-lg">
      <!-- <h1 class="text-center text-2xl font-bold text-indigo-600 sm:text-3xl">Get started today</h1> -->
  
      <!-- <p class="mx-auto mt-4 max-w-md text-center text-gray-500">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Obcaecati sunt dolores deleniti
        inventore quaerat mollitia?
      </p> -->
  
      <form @submit.prevent="submitForm" class="mb-0 mt-6 space-y-4 rounded-lg p-4 shadow-lg sm:p-6 lg:p-8">
        <p class="text-center text-lg font-medium" >Enter customer details</p>
        
        <div>
          <label for="email" class="sr-only">Name</label>
  
          <div class="relative">
            <input
            name="name"
             v-model="form.name"
              type="text"
              class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
              placeholder="Enter name"
            />
            <div v-if="form.errors.name" class="error text-primary-600 dark:text-white">{{ form.errors.name }}</div>
  
          
          </div>
        </div>
  
        <div>
          <label for="phone" class="sr-only">Phone</label>
  
          <div class="relative">
            <input
             v-model="form.phone"
              type="text"
              class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
              placeholder="Enter phone"
            />
            <div v-if="form.errors.phone" class="error text-primary-600 dark:text-white">{{ form.errors.phone }}</div>
  
           
          </div>
        </div>

        
        <div>
          <label for="file">Upload Image:</label>
      <input type="file" @change="handleFileChange" name="file" accept="image/*" id="file" required />
      <div v-if="form.errors.file" class="error text-primary-600 dark:text-white">{{ form.errors.file }}</div>
  
           
        
        </div>

        

        <div>
          <label for="email" class="sr-only">Email</label>
  
          <div class="relative">
            <input
             v-model="form.email"
              type="text"
              class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
              placeholder="Email"
            />
            <div v-if="form.errors.email" class="error text-primary-600 dark:text-white">{{ form.errors.email }}</div>
  
           
          </div>
        </div>

        <div>
          <label for="password" class="sr-only">Password</label>
  
          <div class="relative">
            <input
             v-model="form.password"
              type="password"
              class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
              placeholder="Password"
            />
            <div v-if="form.errors.password" class="error text-primary-600 dark:text-white">{{ form.errors.password }}</div>
  
           
          </div>
        </div>

        <div>
          <label for="address" class="sr-only">Status</label>
  
          <div class="relative">
            <select
    name="status"
    v-model="form.status"
    id="HeadlineAct"
    class="mt-1.5 w-full rounded-lg border-gray-300  p-4 pe-12  text-gray-700 sm:text-sm"
    placeholder="Status"
    
  >
  <!-- <option disabled value="">Select status</option> -->
   <option value="active">Active</option>
    <option value="inactive">Inactive</option>

  </select>
            <div v-if="form.errors.status" class="error text-primary-600 dark:text-white">{{ form.errors.status }}</div>
  
            
          </div>
        </div>
  
        <button
          type="submit"
          :disabled="form.processing"
          class="block w-full rounded-lg bg-indigo-600 px-5 py-3 text-sm font-medium text-white"
        >
          Submit
        </button>
  
        <!-- <p class="text-center text-sm text-gray-500">
          No seller?
          <a class="underline" href="#">Sign up</a>
        </p> -->
      </form>
    </div>
  </div>

</div>


</div>
  </div>
</div>

        

    </AuthenticatedLayout>
</template>





<style scoped>
.styled-table {
    width: 100%;
    border-collapse: collapse; /* Ensures borders are collapsed */
}

.styled-table th,
.styled-table td {
    padding: 12px; /* Space around text */
    text-align: left; /* Align text to the left */
    border: 1px solid #dddddd; /* Light gray border */
}

.styled-table th {
    background-color: #4CAF50; /* Green background for header */
    color: white; /* White text color */
}

.styled-table tr:nth-child(even) {
    background-color: #f2f2f2; /* Light gray for even rows */
}

.styled-table tr:hover {
    background-color: #ddd; /* Darker gray on hover */
}

.styled-table td {
    font-size: 14px; /* Font size for table cells */
    color: #333; /* Text color */
}

.styled-table th {
    font-size: 16px; /* Font size for header */
    font-weight: bold; /* Bold header text */
}
</style>

