<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Sidebar from '@/Pages/Sidebar.vue';

defineProps({
    deals: {
      type: Array,
      default: () => [],
    },
    accounts: {
      type: Array,
      default: () => [],
    },
  });
</script>

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
    <h1 class="text-2xl font-bold">Recent Deals</h1>

    <!--
  Heads up! 👋

  This component comes with some `rtl` classes. Please remove them if they are not needed in your project.
-->

<div class="rounded-lg border border-gray-200">
  <div class="overflow-x-auto rounded-t-lg">
    <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
      <thead class="ltr:text-left rtl:text-right">
        <tr>
          <th style="text-align: left" class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Name</th>
          <th style="text-align: left" class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Account</th>
          <th style="text-align: left" class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Amount</th>
          <th style="text-align: left" class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Status</th>
        </tr>
      </thead>


      <tbody class="divide-y divide-gray-200">
        <tr v-for="(deal, index) in deals" :key="index">
                <td  class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{ deal.name }}</td>
                <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ deal.account.name }}</td>
                <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ deal.amount }}</td>
                <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ deal.status }}</td>
          
                <!-- <td>{{ deal.address }}</td> -->
            </tr>
     
      
      </tbody>
    </table>
  </div>


</div>

<br/>
<br/>

<h1 class="text-2xl font-bold">Recent Accounts</h1>
<div class="rounded-lg border border-gray-200">
  <div class="overflow-x-auto rounded-t-lg">
    <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
      <thead class="ltr:text-left rtl:text-right">
        <tr>
          <th style="text-align: left" class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Name</th>
          <th style="text-align: left" class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Phone</th>
          <th style="text-align: left" class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Website</th>
          <th style="text-align: left" class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Address</th>
        </tr>
      </thead>


      <tbody class="divide-y divide-gray-200">
        <tr v-for="(account, index) in accounts" :key="index">
                <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{ account.name }}</td>
                <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ account.phone }}</td>
                <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ account.website }}</td>
                <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ account.address }}</td>
          
                <!-- <td>{{ deal.address }}</td> -->
            </tr>
     
      
      </tbody>
    </table>
  </div>


</div>
  </div>
</div>

        

    </AuthenticatedLayout>
</template>



