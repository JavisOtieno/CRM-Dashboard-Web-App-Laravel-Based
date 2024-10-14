<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

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
  <div class="flex h-screen flex-col justify-between border-e bg-white w-1/5"> <!-- 1/4 width -->
    <div class="px-4 py-6">
      <span class="grid h-10 w-32 place-content-center rounded-lg bg-gray-100 text-xs text-gray-600">
        Logo
      </span>

      <ul class="mt-6 space-y-1">
        <li>
          <a href="/dashboard" class="block rounded-lg bg-gray-100 px-4 py-2 text-sm font-medium text-gray-700">
            Dashboard
          </a>
        </li>

        <li>
          <details class="group [&_summary::-webkit-details-marker]:hidden">
            <summary class="flex cursor-pointer items-center justify-between rounded-lg px-4 py-2 text-gray-500 hover:bg-gray-100 hover:text-gray-700">
              <span class="text-sm font-medium"> Teams </span>

              <span class="shrink-0 transition duration-300 group-open:-rotate-180">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
              </span>
            </summary>

            <ul class="mt-2 space-y-1 px-4">
              <li>
                <a href="#" class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-700"> Banned Users </a>
              </li>

              <li>
                <a href="#" class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-700"> Calendar </a>
              </li>
            </ul>
          </details>
        </li>

        <li>
          <a href="/accounts" class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-700"> Accounts </a>
        </li>

        <li>
          <a href="#" class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-700"> Invoices </a>
        </li>

        <li>
          <details class="group [&_summary::-webkit-details-marker]:hidden">
            <summary class="flex cursor-pointer items-center justify-between rounded-lg px-4 py-2 text-gray-500 hover:bg-gray-100 hover:text-gray-700">
              <span class="text-sm font-medium"> Account </span>

              <span class="shrink-0 transition duration-300 group-open:-rotate-180">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
              </span>
            </summary>

            <ul class="mt-2 space-y-1 px-4">
              <li>
                <a href="#" class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-700"> Details </a>
              </li>

              <li>
                <a href="#" class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-700"> Security </a>
              </li>

              <li>
                <form action="#">
                  <button type="submit" class="w-full rounded-lg px-4 py-2 text-sm font-medium text-gray-500 [text-align:_inherit] hover:bg-gray-100 hover:text-gray-700"> Logout </button>
                </form>
              </li>
            </ul>
          </details>
        </li>
      </ul>
    </div>

    

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


