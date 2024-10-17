<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Sidebar from '@/Pages/Sidebar.vue';
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
    <h1 class="text-2xl font-bold">Main Content Area</h1>
    <p class="mt-4">This is where you can add your main content.</p>



    <!--
  Heads up! 👋

  This component comes with some `rtl` classes. Please remove them if they are not needed in your project.
-->

<div class="rounded-lg border border-gray-200">
  <div class="overflow-x-auto rounded-t-lg">
    <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
      <thead class="ltr:text-left rtl:text-right">
        <tr>
          <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Name</th>
          <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Phone</th>
          <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Website</th>
          <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Address</th>
        </tr>
      </thead>


      <tbody class="divide-y divide-gray-200">
        <tr>
          <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">John Doe</td>
          <td class="whitespace-nowrap px-4 py-2 text-gray-700">24/05/1995</td>
          <td class="whitespace-nowrap px-4 py-2 text-gray-700">Web Developer</td>
          <td class="whitespace-nowrap px-4 py-2 text-gray-700">$120,000</td>
        </tr>

        <tr>
          <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Jane Doe</td>
          <td class="whitespace-nowrap px-4 py-2 text-gray-700">04/11/1980</td>
          <td class="whitespace-nowrap px-4 py-2 text-gray-700">Web Designer</td>
          <td class="whitespace-nowrap px-4 py-2 text-gray-700">$100,000</td>
        </tr>

        <tr>
          <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Gary Barlow</td>
          <td class="whitespace-nowrap px-4 py-2 text-gray-700">24/05/1995</td>
          <td class="whitespace-nowrap px-4 py-2 text-gray-700">Singer</td>
          <td class="whitespace-nowrap px-4 py-2 text-gray-700">$20,000</td>
        </tr>
      </tbody>
    </table>
  </div>

  <div class="rounded-b-lg border-t border-gray-200 px-4 py-2">
    <ol class="flex justify-end gap-1 text-xs font-medium">
      <li>
        <a
          href="#"
          class="inline-flex size-8 items-center justify-center rounded border border-gray-100 bg-white text-gray-900 rtl:rotate-180"
        >
          <span class="sr-only">Prev Page</span>
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="size-3"
            viewBox="0 0 20 20"
            fill="currentColor"
          >
            <path
              fill-rule="evenodd"
              d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
              clip-rule="evenodd"
            />
          </svg>
        </a>
      </li>

      <li>
        <a
          href="#"
          class="block size-8 rounded border border-gray-100 bg-white text-center leading-8 text-gray-900"
        >
          1
        </a>
      </li>

      <li class="block size-8 rounded border-blue-600 bg-blue-600 text-center leading-8 text-white">
        2
      </li>

      <li>
        <a
          href="#"
          class="block size-8 rounded border border-gray-100 bg-white text-center leading-8 text-gray-900"
        >
          3
        </a>
      </li>

      <li>
        <a
          href="#"
          class="block size-8 rounded border border-gray-100 bg-white text-center leading-8 text-gray-900"
        >
          4
        </a>
      </li>

      <li>
        <a
          href="#"
          class="inline-flex size-8 items-center justify-center rounded border border-gray-100 bg-white text-gray-900 rtl:rotate-180"
        >
          <span class="sr-only">Next Page</span>
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="size-3"
            viewBox="0 0 20 20"
            fill="currentColor"
          >
            <path
              fill-rule="evenodd"
              d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
              clip-rule="evenodd"
            />
          </svg>
        </a>
      </li>
    </ol>
  </div>
</div>
  </div>
</div>

        

    </AuthenticatedLayout>
</template>


