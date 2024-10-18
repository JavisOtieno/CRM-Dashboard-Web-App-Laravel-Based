<script setup>
import DataTable from 'datatables.net-vue3';
import DataTablesCore from 'datatables.net';
import Sidebar from '@/Pages/Sidebar.vue';
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Link } from '@inertiajs/vue3';
import BaseTableComponent from './BaseTableComponent.vue';
 
DataTable.use(DataTablesCore);
 
// const data = [
//   [1, 2],
//   [3, 4],
// ];

defineProps({
    meetings: {
      type: Array,
      default: () => [],
    },
  });

  




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
    <h1 class="text-2xl font-bold">Meetings</h1>
    <!-- <p class="mt-4">This is where you can add your main content.</p> -->



    <!--
  Heads up! 👋

  This component comes with some `rtl` classes. Please remove them if they are not needed in your project.
-->

<div class="rounded-lg border border-gray-200">
  <div class="overflow-x-auto rounded-t-lg">

    <Link :href="route('addmeeting')"  as="button"
    class="inline-block rounded border border-red-600 bg-red-600 px-12 py-3 text-sm font-medium text-white hover:bg-transparent hover:text-red-600 focus:outline-none focus:ring active:text-red-500"
    id="addbutton"

  >
    Add Meeting
</Link>
   

    <DataTable class="styled-table" id="dataTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Account Id</th>
                <th>Contact Id</th>
                <th>Description</th>
                <th>Status</th>
                <!-- <th>Address</th> -->
            </tr>
        </thead>
        <tbody>
            <tr v-for="(meeting, index) in meetings" :key="index">
                <td>{{ meeting.id }}</td>
                <td>{{ meeting.account_id }}</td>
                <td>{{ meeting.contact_id }}</td>
                <td>{{ meeting.description }}</td>
                <td>{{ meeting.status }}</td>
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
