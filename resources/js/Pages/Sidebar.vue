<script setup>
// import { ref } from 'vue';
// import ApplicationLogo from '@/Components/ApplicationLogo.vue';
// import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
// import NavLink from '@/Components/NavLink.vue';
import { Link } from '@inertiajs/vue3';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
</script>
<template>
<div class="px-4 py-6">
    <!-- <span class="grid h-10 w-32 place-content-center rounded-lg bg-gray-100 text-xs text-gray-600">
      Logo
    </span> -->
<!-- had mt-6 -->
    <ul class="space-y-1">
      <li>
        <a href="/dashboard" class="block rounded-lg bg-gray-100 px-4 py-2 text-sm font-medium text-gray-700">
          Dashboard
        </a>
      </li>

 

      <li>
        <a href="/customers" class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-700"> Customers </a>
      </li>

      <li>
        <a href="/accounts" class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-700"> Accounts </a>
      </li>

      <li>
        <a href="/deals" class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-700"> Deals </a>
      </li>
      <!-- <li>
        <a href="/addaccount" class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-700"> Add Account </a>
      </li> -->
      

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
            <!-- <li>
<Link :href="route('logout')" method="post" as="button">
                                            Test Log Out
                                        </Link>
                                      </li> -->

<li>
<DropdownLink :href="route('logout')" method="post" as="button">
                                            Log Out
                                        </DropdownLink>
                                      </li>

          </ul>
        </details>
      </li>
      <br/>
      
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
        <a href="#" class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-700"> Billing </a>
      </li>
    </ul>
  </div>
</template>