<script setup>
import DataTable from 'datatables.net-vue3';
import DataTablesCore from 'datatables.net';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Sidebar from '@/Pages/Sidebar.vue';
import { Head } from '@inertiajs/vue3';
import { useForm } from '@inertiajs/vue3'; // Make sure @inertiajs/vue3 is installed
import { Link } from '@inertiajs/vue3';

DataTable.use(DataTablesCore);

const props = defineProps({
  accounts: {
    type: Array,
    default: () => [],
  },
});

const form = useForm({});

const deleteAccount = (accountId) => {
  if (confirm('Are you sure you want to delete this account?')) {
    form.delete(`/deleteaccount/${accountId}`, {
      onSuccess: () => {
        alert('Account deleted successfully!');
        window.location.reload(); // Reload the page on success
      },
    //   preserveState: true, 
    });
  }
};

// If you need to return values to the template, do it here
// return { form, deleteUser, props };
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
        <!-- <template #header> -->
  <!-- <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
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
  </div> -->
<!-- </template> -->


        <div class="flex h-screen">
  <!-- Sidebar -->
  <div class="flex h-screen flex-col justify-between border-e bg-white w-1/5"> <!-- 1/4 width -->

    <Sidebar/>

    

    <div class="sticky inset-x-0 bottom-0 border-t border-gray-100">
      <a href="#" class="flex items-center gap-2 bg-white p-4 hover:bg-gray-50">
        <img alt="" src="https://images.unsplash.com/photo-1600486913747-55e5470d6f40?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1770&q=80" class="size-10 rounded-full object-cover" />

        <div>
          <p class="text-xs">
            <strong class="block font-medium">Eric Frusciante</strong>
            <span> eric@frusciante.com </span>
          </p>
        </div>
      </a>
    </div>
  </div>

  <!-- Main Content -->

  <div class="flex-1 p-6">
    <!-- Your main content goes here -->
    <h1 class="text-2xl font-bold">Accounts</h1>
    <!-- <p class="mt-4">This is where you can add your main content.</p> -->



    <!--
  Heads up! 👋

  This component comes with some `rtl` classes. Please remove them if they are not needed in your project.
-->

<div class="rounded-lg border border-gray-200">
  <div class="overflow-x-auto rounded-t-lg">


  <!-- Base -->

  
  <Link :href="route('addaccount')"  as="button"
    class="inline-block rounded border border-red-600 bg-red-600 px-12 py-3 text-sm font-medium text-white hover:bg-transparent hover:text-red-600 focus:outline-none focus:ring active:text-red-500"

  >
    Add Account
</Link>
  
  <!-- Border -->
  
   

    <DataTable class="styled-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Phone</th>
                <th>Website</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(account, index) in accounts" :key="index">
                <td>{{ account.name }}</td>
                <td>{{ account.phone }}</td>
                <td>{{ account.website }}</td>
                <td>{{ account.address }}</td>
                <td>

                <span class="inline-flex overflow-hidden rounded-md border bg-white shadow-sm">
    <a
    :href="`/editaccount/${account.id}`"
      class="inline-block border-e p-3 text-gray-700 hover:bg-gray-50 focus:relative"
      title="Edit Product"
    >
      <svg
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 24 24"
        stroke-width="1.5"
        stroke="currentColor"
        class="size-4"
      >
        <path
          stroke-linecap="round"
          stroke-linejoin="round"
          d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"
        />
      </svg>
    </a>
  
    <button
      class="inline-block p-3 text-gray-700 hover:bg-gray-50 focus:relative"
      title="Delete Product"
       @click="deleteAccount(account.id)" :disabled="form.processing"
    >
      <svg
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 24 24"
        stroke-width="1.5"
        stroke="currentColor"
        class="size-4"
      >
        <path
          stroke-linecap="round"
          stroke-linejoin="round"
          d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
        />
      </svg>
    </button>
  </span>
  </td>


            </tr>
        </tbody>
    </DataTable>
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
/* Move the search box to the right */
.dt-search {
    float: right; /* Aligns the search bar to the right */
}

.dt-search input {
    margin-left: 10px; /* Aligns the search bar to the right */
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
