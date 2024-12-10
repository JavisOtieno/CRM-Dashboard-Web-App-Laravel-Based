<script>
import Sidebar from '@/Pages/Sidebar.vue';
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useForm } from '@inertiajs/vue3'; // Make sure @inertiajs/vue3 is installed
import { ref, computed, watch } from 'vue';

export default {
  components: { Sidebar },
  props: {
    accounts: {
      type: Array,
      // required: true,
      default: () => [],
    },
    contacts: {
      type: Array,
      default: () => [],
    },
    task: {
      type: Object,
      required: true, // Ensure the account data is passed as a prop
    },
  },
  setup(props) {
    // Initialize form state with useForm
    const form = useForm({
      name: props.task.name || '',
      account_id: props.task.account_id || '',
      contact_id: props.task.contact_id || '',
      description: props.task.description || '',
      status: props.task.status || '',
    });

        
    // Compute filtered contacts based on selected account_id
    const filteredContacts = computed(() =>
      props.contacts.filter(contact => contact.account_id === form.account_id)
    );


    // Automatically select the first contact when account changes
    watch(() => form.account_id, (newAccountId) => {
      const firstContact = filteredContacts.value[0];
      form.contact_id = firstContact ? firstContact.id : ''; // Set contact_id to first available contact
    });

    const submitForm = () => {
      form.put(`/submitedittask/${props.task.id}`, {
        onSuccess: () => alert('Task edited successfully!'),
      });
    };

    return { form, submitForm, filteredContacts };
    
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
    <h1 class="text-2xl font-bold">Edit Task</h1>
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
        <p class="text-center text-lg font-medium" >Enter task details</p>

     
        <div>
          <label for="name" class="sr-only">Account</label>
  
          <div class="relative">
            <!-- <input
            name="name"
             v-model="form.account_id"
              type="text"
              class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
              placeholder="Enter name"
            /> -->
            <select
              name="account_id"
              v-model="form.account_id"
              id="HeadlineAct"
              class="mt-1.5 w-full rounded-lg border-gray-300  p-4 pe-12  text-gray-700 sm:text-sm"
              placeholder="Account Id"
              
            >


            <option disabled value="">Select account</option>
              <option  v-for="(account, index)  in accounts" :key="index" :value="account.id">{{ account.name }}</option>
            </select>
            <div v-if="form.errors.account_id" class="error text-primary-600 dark:text-white">{{ form.errors.account_id }}</div>
  
         
          </div>
        </div>
  
        <div>
          <label for="phone" class="sr-only">Contact</label>
  
          <div class="relative">
            <!-- <input
             v-model="form.contact_id"
              type="text"
              class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
              placeholder="Enter phone"
            /> -->
            <select
              name="contact_id"
              v-model="form.contact_id"
              id="HeadlineAct"
              class="mt-1.5 w-full rounded-lg border-gray-300  p-4 pe-12  text-gray-700 sm:text-sm"
              placeholder="Contact Id"
              
            >


            <option disabled value="">Select contact</option>
              <option  v-for="(contact, index)  in filteredContacts" :key="index" :value="contact.id">{{ contact.name }}</option>
            </select>
            <div v-if="form.errors.contact_id" class="error text-primary-600 dark:text-white">{{ form.errors.contact_id }}</div>
  
           
          </div>
        </div>
   

        <div>
          <label for="name" class="sr-only">Name</label>
  
          <div class="relative">
            <input
             v-model="form.name"
              type="text"
              class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
              placeholder="Name"
            />
            <div v-if="form.errors.name" class="error text-primary-600 dark:text-white">{{ form.errors.name }}</div>
  
         
          </div>
        </div>

        <div>
          <label for="description" class="sr-only">Description</label>
  
          <div class="relative">
            <input
             v-model="form.description"
              type="text"
              class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
              placeholder="Description"
            />
            <div v-if="form.errors.description" class="error text-primary-600 dark:text-white">{{ form.errors.description }}</div>
  
         
          </div>
        </div>

        <div>
          <label for="status" class="sr-only">Status</label>
  
          <div class="relative">
            <!-- <input
             v-model="form.status"
              type="text"
              class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
              placeholder="Status"
            /> -->
            <select
            name="status"
            v-model="form.status"
            id="HeadlineAct"
            class="mt-1.5 w-full rounded-lg border-gray-300  p-4 pe-12  text-gray-700 sm:text-sm"
            placeholder="Status"
            
          >
          <option disabled value="">Select status</option>
          <option value="complete">Complete</option>
            <option value="pending">Pending</option>
            <option value="cancelled">Cancelled</option> 

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
          No account?
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

