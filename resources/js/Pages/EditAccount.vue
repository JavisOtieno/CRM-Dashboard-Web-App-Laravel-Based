<script>
import Sidebar from '@/Pages/Sidebar.vue';
import { Head } from '@inertiajs/vue3';
import { useForm } from '@inertiajs/vue3'; // Make sure @inertiajs/vue3 is installed

export default {
  components: { Sidebar },
  props: {
    account: {
      type: Object,
      required: true, // Ensure the account data is passed as a prop
    },
  },
  setup(props) {
    // Initialize form state with useForm
    const form = useForm({
      name: props.account.name || '',
      phone: props.account.phone || '',
      website: props.account.website || '',
      address: props.account.address || '',

    });

    const submitForm = () => {
      form.put(`/submiteditaccount/${props.account.id}`, {
        onSuccess: () => alert('Account edited successfully!'),
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
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
  <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
  <div class="flex justify-between items-start mt-4"> <!-- Added justify-between -->
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
</template>


        <div class="flex h-screen">
  <!-- Sidebar -->

    <Sidebar/>

    



  <!-- Main Content -->

  <div class="flex-1 p-6">
    <!-- Your main content goes here -->
    <h1 class="text-2xl font-bold">Edit Account</h1>
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
        <p class="text-center text-lg font-medium" >Change customer details</p>
        
        <div>
          <label for="name" class="sr-only">Name</label>
  
          <div class="relative">
            <input
            name="name"
             v-model="form.name"
              type="text"
              class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
              placeholder="Enter name"
            />
            <div v-if="form.errors.name" class="error text-primary-600 dark:text-white">{{ form.errors.name }}</div>
  
            <span class="absolute inset-y-0 end-0 grid place-content-center px-4">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="size-4 text-gray-400"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"
                />
              </svg>
            </span>
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
  
            <span class="absolute inset-y-0 end-0 grid place-content-center px-4">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="size-4 text-gray-400"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                />
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                />
              </svg>
            </span>
          </div>
        </div>

        <div>
          <label for="website" class="sr-only">Website</label>
  
          <div class="relative">
            <input
             v-model="form.website"
              type="text"
              class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
              placeholder="Website"
            />
            <div v-if="form.errors.website" class="error text-primary-600 dark:text-white">{{ form.errors.website }}</div>
  
            <span class="absolute inset-y-0 end-0 grid place-content-center px-4">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="size-4 text-gray-400"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                />
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                />
              </svg>
            </span>
          </div>
        </div>

        <div>
          <label for="address" class="sr-only">Address</label>
  
          <div class="relative">
            <input
             v-model="form.address"
              type="text"
              class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
              placeholder="Address"
            />
            <div v-if="form.errors.address" class="error text-primary-600 dark:text-white">{{ form.errors.address }}</div>
  
            <span class="absolute inset-y-0 end-0 grid place-content-center px-4">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="size-4 text-gray-400"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                />
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                />
              </svg>
            </span>
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

