<script setup>
// import { ref } from 'vue';
// import ApplicationLogo from '@/Components/ApplicationLogo.vue';
// import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
// import NavLink from '@/Components/NavLink.vue';
import { Link } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3'; 
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
const { component } = usePage(); // Get the current component name
</script>
<template>
    <div class="flex h-screen flex-col justify-between border-e bg-white w-1/5"> <!-- 1/4 width -->
<div class="px-4 py-6">
    <!-- <span class="grid h-10 w-32 place-content-ce nter rounded-lg bg-gray-100 text-xs text-gray-600">
      Logo
    </span> -->
<!-- had mt-6 -->
    <ul class="space-y-1">
      <li>
        <!-- {{ component }} -->
        <Link :href="route('dashboard')" :class="{'bg-gray-100 text-gray-700': component === 'Dashboard'}" class="block rounded-lg  px-4 py-2 text-sm font-medium text-gray-500">
          Dashboard
        </Link>
      </li>
      <li>
        <!-- {{ component }} -->
        <Link :href="route('newdashboard')" :class="{'bg-gray-100 text-gray-700': component === 'Dashboard'}" class="block rounded-lg  px-4 py-2 text-sm font-medium text-gray-500">
          New Dashboard
        </Link>
      </li>

 

      <!-- <li>
        <a href="/customers" class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-700"> Customers </a>
      </li> -->

      <li>
        <Link :href="route('accounts')" :class="{'bg-gray-100 text-gray-700': component === 'Accounts'}"   class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-700"> Accounts </Link>
      </li>

      <li>
        <Link :href="route('deals')"  :class="{'bg-gray-100 text-gray-700': component === 'Deals'}"  class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-700"> Deals </Link>
      </li>
      <li>
        <Link :href="route('contacts')" :class="{'bg-gray-100 text-gray-700': component === 'Contacts'}"  class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-700"> Contacts </Link>
      </li>
      <li>
        <Link :href="route('locations')" :class="{'bg-gray-100 text-gray-700': component === 'Locations'}"  class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-700"> Locations </Link>
      </li>
      <li>
        <Link :href="route('calls')" :class="{'bg-gray-100 text-gray-700': component === 'Calls'}"   class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-700"> Calls </Link>
      </li>
      <li>
        <Link :href="route('meetings')" :class="{'bg-gray-100 text-gray-700': component === 'Meetings'}"  class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-700"> Meetings </Link>
      </li>
      <li>
        <Link :href="route('visits')"  :class="{'bg-gray-100 text-gray-700': component === 'Visits'}" class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-700"> Visits </Link>
      </li>
      <li>
        <Link :href="route('tasks')"  :class="{'bg-gray-100 text-gray-700': component === 'Tasks'}" class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-700"> Tasks </Link>
      </li>
      <li>
        <Link :href="route('sellers')"  :class="{'bg-gray-100 text-gray-700': component === 'Sellers'}" class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-700"> Sellers </Link>
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
              <Link :href="route('profile.edit')" href="#" class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-700"> Profile </Link>
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
      

    </ul>
  </div>
  <!-- <div class="sticky inset-x-0 bottom-0 border-t border-gray-100">
      <a href="#" class="flex items-center gap-2 bg-white p-4 hover:bg-gray-50">
        <img alt="" src="https://images.unsplash.com/photo-1600486913747-55e5470d6f40?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1770&q=80" class="size-10 rounded-full object-cover" />

        <div>
          <p class="text-xs">
            <strong class="block font-medium">Eric Frusciante</strong>
            <span> eric@frusciante.com </span>
          </p>
        </div>
      </a>
    </div> -->
  </div>
</template>