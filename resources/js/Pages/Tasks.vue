<script setup>
import DataTable from 'datatables.net-vue3';
import DataTablesCore from 'datatables.net';
import Sidebar from '@/Pages/Sidebar.vue';
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Link } from '@inertiajs/vue3';
import BaseTableComponent from './BaseTableComponent.vue';
import { useForm } from '@inertiajs/vue3'; 

 
DataTable.use(DataTablesCore);
const form = useForm({});
 
 
// const data = [
//   [1, 2],
//   [3, 4],
// ];

defineProps({
    tasks: {
      type: Array,
      default: () => [],
    },
  });




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
  <BaseTableComponent>
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
    <h1 class="text-2xl font-bold">Tasks</h1>
    <!-- <p class="mt-4">This is where you can add your main content.</p> -->



    <!--
  Heads up! 👋

  This component comes with some `rtl` classes. Please remove them if they are not needed in your project.
-->

<div class="rounded-lg border border-gray-200">
  <div class="overflow-x-auto rounded-t-lg">

    <Link :href="route('addtask')"  as="button"
    class="inline-block rounded border border-red-600 bg-red-600 px-12 py-3 text-sm font-medium text-white hover:bg-transparent hover:text-red-600 focus:outline-none focus:ring active:text-red-500"
    id="addbutton"

  >
    Add Taslk
</Link>
   

    <DataTable class="styled-table" id="dataTable">
        <thead>
            <tr>
                 <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
ID</th>
                 <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
Account</th>
                 <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
Contact</th>
                 <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
Task Name</th>
                 <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
Status</th>
                 <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
Actions</th>
                <!--  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
Address</th> -->
            </tr>
        </thead>
        <tbody>
            <tr v-for="(task, index) in tasks" :key="index">
                <td>{{ task.id }}</td>
                <td>{{ task.name }}</td>
                <td>{{ task.account.name }}</td>
                <td>{{ task.contact.name }}</td>
                <td>{{ task.status }}</td>
                <td>

<span class="inline-flex overflow-hidden rounded-md border bg-white shadow-sm">
<a
:href="`/edittask/${task.id}`"
class="inline-block border-e p-2 text-gray-700 hover:bg-gray-50 focus:relative"
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
class="inline-block p-2 text-gray-700 hover:bg-gray-50 focus:relative"
title="Delete Product"
@click="deleteAccount(call.id)" :disabled="form.processing"
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
                <!-- <td>{{ deal.address }}</td> -->
            </tr>
        </tbody>
    </DataTable>
  </div>


</div>
  </div>
</div>

        

    </AuthenticatedLayout>
  </BaseTableComponent>
</template>

