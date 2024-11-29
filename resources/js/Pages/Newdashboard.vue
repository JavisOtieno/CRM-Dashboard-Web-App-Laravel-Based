<script setup>
import { onMounted } from 'vue'
import SidebarNew from '@/Pages/Sidebarnew.vue';
import { mapState, mapGetters } from 'vuex';
import { computed, toRefs } from 'vue';
import { ref, watch } from "vue"; 
import { useStore } from 'vuex';
import VueApexCharts from "vue3-apexcharts";
import { Link } from '@inertiajs/vue3';

const store = useStore();

const message = computed(() => store.state.message);

const changeMessage = () => {
  store.dispatch('updateMessage', 'Updated message from Vuex!');
};

// Access the user state and isAuthenticated getter from the store
const { user } = toRefs(store.state);
const isAuthenticated = computed(() => store.getters.isAuthenticated);

// console.log("test"+user.name);

import { 
    initAccordions, 
    initCarousels, 
    initCollapses, 
    initDials, 
    initDismisses, 
    initDrawers, 
    initDropdowns, 
    initModals, 
    initPopovers, 
    initTabs, 
    initTooltips } from 'flowbite'

// initialize components based on data attribute selectors
onMounted(() => {
    initAccordions();
    initCarousels();
    initCollapses();
    initDials();
    initDismisses();
    initDrawers();
    initDropdowns();
    initModals();
    initPopovers();
    initTabs();
    initTooltips();
})

const props = defineProps({
    leadsCount: {
    type: Number, // Define the type as String
    default: 0,  // Provide an empty string as the default value
  },
  contactsCount: {
    type: Number, // Define the type as String
    default: 0,  // Provide an empty string as the default value
  },
  dealsCount: {
    type: Number, // Define the type as String
    default: '',  // Provide an empty string as the default value
  },
  accountsCount: {
    type: Number, // Define the type as String
    default: 0,  // Provide an empty string as the default value
  },
  percentageChange: {
    type: Number, // Define the type as String
    default: 0,  // Provide an empty string as the default value
  },
  accounts: {
    type: Array,
    default: () => [],
  },
  dealsPerMonth: {
    type: Array,
    default: () => [],
  },
  months: {
    type: Array,
    default: () => [],
  },
  deals: {
    type: Array,
    default: () => [],
  },
  visits: {
    type: Array,
    default: () => [],
  },
  contacts: {
    type: Array,
    default: () => [],
  },
  
});


const chartOptions = ref({
  chart: {
    height: "100%",
    maxWidth: "100%",
    type: "area",
    fontFamily: "Inter, sans-serif",
    dropShadow: {
      enabled: false,
    },
    toolbar: {
      show: false,
    },
  },
  tooltip: {
    enabled: true,
    x: {
      show: false,
    },
  },
  fill: {
    type: "gradient",
    gradient: {
      opacityFrom: 0.55,
      opacityTo: 0,
      shade: "#EC1F27",
      gradientToColors: ["#EC1F27"],
    },
  },
  dataLabels: {
    enabled: false,
  },
  stroke: {
    width: 6,
  },
  margin: {
      top: 30,  // Add margin space to the top to prevent cutting off the stroke
      bottom: 30,  // Add margin space to the bottom
    },
  grid: {
    show: false,
    strokeDashArray: 4,
    padding: {
      left: 20,
      right: 20,
      top: 20, // Add space for the stroke at the top
      bottom: 20, // Add space for the stroke at the bottom
    },
  },
  series: [
    {
      name: "Deals",
      data: [], // Placeholder for `dealsPerMonth`
      color: "#EC1F27",
    },
  ],
  xaxis: {
    categories: props.months,
    labels: {
      show: true,
    },
    axisBorder: {
      show: false,
    },
    axisTicks: {
      show: false,
    },
  },
  yaxis: {
    min: -0.1, 
    max: Math.max(...props.dealsPerMonth) + 1, 
    show: false,
  },
});

// Update chartOptions.series.data with dealsPerMonth
watch(
  () => props.dealsPerMonth, // Watching the prop
  (newValue) => {
    chartOptions.value.series[0].data = newValue; // Update chart data
  },
  { immediate: true } // Run immediately on mount
);



// Register VueApexCharts component
VueApexCharts;


</script>
<template>

<SidebarNew/>

  
  
  <div class="p-4 sm:ml-64">
     <div class="p-4 border-gray-200 border-dashed rounded-lg
      dark:border-gray-700 mt-14">

  <!-- <div>
    <h1>{{ message }}</h1>
    <button @click="changeMessage">Change Message</button>
  </div> -->

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">

            <div class=" w-full bg-white rounded-lg shadow dark:bg-gray-800">
  <div class="flex justify-between p-4 md:p-6 pb-0 ">
    <div class="mx-auto">
      <h5 class="text-center leading-none text-3xl font-bold text-gray-900 dark:text-white pb-2">{{ dealsCount }}</h5>
      <p class="text-center font-normal text-gray-500 dark:text-gray-400">Total Deals</p>
    </div>
    <!-- <div
      class="flex items-center px-2.5 py-0.5 text-base font-semibold text-green-500 dark:text-green-500 text-center">
      23%
      <svg class="w-3 h-3 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 14">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13V1m0 0L1 5m4-4 4 4"/>
      </svg>
    </div> -->
  </div>

</div>

<div class=" w-full bg-white rounded-lg shadow dark:bg-gray-800">
  <div class="flex justify-between p-4 md:p-6 pb-0 ">
    <div class="mx-auto">
      <h5 class="text-center leading-none text-3xl font-bold text-gray-900 dark:text-white pb-2">{{ leadsCount }}</h5>
      <p class="text-center font-normal text-gray-500 dark:text-gray-400">Total Leads</p>
    </div>
    <!-- <div
      class="flex items-center px-2.5 py-0.5 text-base font-semibold text-green-500 dark:text-green-500 text-center">
      23%
      <svg class="w-3 h-3 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 14">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13V1m0 0L1 5m4-4 4 4"/>
      </svg>
    </div> -->
  </div>

</div>

<div class=" w-full bg-white rounded-lg shadow dark:bg-gray-800">
  <div class="flex justify-between p-4 md:p-6 pb-0 md:pb-0">
    <div class="mx-auto">
      <h5 class="text-center leading-none text-3xl font-bold text-gray-900 dark:text-white pb-2">{{ accountsCount }}</h5>
      <p class="text-center font-normal text-gray-500 dark:text-gray-400">Total Accounts</p>
    </div>
    <!-- <div
      class="flex items-center px-2.5 py-0.5 text-base font-semibold text-green-500 dark:text-green-500 text-center">
      23%
      <svg class="w-3 h-3 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 14">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13V1m0 0L1 5m4-4 4 4"/>
      </svg>
    </div> -->
  </div>

</div>

<div class=" w-full bg-white rounded-lg shadow dark:bg-gray-800">
  <div class="flex justify-between p-4 md:p-6 pb-0 md:pb-0">
    <div class="mx-auto">
      <h5 class="text-center leading-none text-3xl font-bold text-gray-900 dark:text-white pb-2">{{ contactsCount }}</h5>
      <p class="text-center font-normal text-gray-500 dark:text-gray-400">Total Contacts</p>
    </div>
    <!-- <div
      class="flex items-center px-2.5 py-0.5 text-base font-semibold text-green-500 dark:text-green-500 text-center">
      23%
      <svg class="w-3 h-3 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 14">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13V1m0 0L1 5m4-4 4 4"/>
      </svg>
    </div> -->
  </div>

</div>










           


                

           
        </div> 
        <!-- <div class="flex items-center justify-center h-48 mb-4 rounded bg-gray-50 dark:bg-gray-800">
           <p class="text-2xl text-gray-400 dark:text-gray-500">
              <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                 <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
              </svg>
           </p>
        </div> -->


        <div class=" w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6 mb-4">
  <div class="flex justify-between">
    <div>
      <!-- <h5 class="leading-none text-3xl font-bold text-gray-900 dark:text-white pb-2">{{ dealsCount }}</h5> -->
      <p class="text-base font-normal text-gray-500 dark:text-gray-400">Deals</p>
      <!-- today -->
    </div>
    <div v-if="percentageChange > 0 || percentageChange == 0"
      class="flex items-center px-2.5 py-0.5 text-base font-semibold text-green-500 dark:text-green-500 text-center">
      {{ Math.abs(percentageChange) }}%
      <svg class="w-3 h-3 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 14">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13V1m0 0L1 5m4-4 4 4"/>
      </svg> 
    </div>
    <div v-if="percentageChange < 0 "
      class="flex items-center px-2.5 py-0.5 text-base font-semibold text-red-500 dark:text-red-500 text-center">
      {{ Math.abs(percentageChange) }}%
      <svg class="w-3 h-3 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 14">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13V1m0 0L1 5m4-4 4 4"/>
      </svg> 
    </div>
  </div>
  <!-- <div id="area-chart"></div> -->
  <div>
    <!-- This div will hold the chart -->
    <apexchart type="area" height="300px" :options="chartOptions" :series="chartOptions.series" />
  </div>
  <div class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between">
    <div class="flex justify-between items-center pt-5">
      <!-- Button -->
       <!-- data-dropdown-toggle="lastDaysdropdown"
        data-dropdown-placement="bottom" -->
      <button
        id="dropdownDefaultButton"
        
        class="text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-900 text-center inline-flex items-center dark:hover:text-white"
        type="button">
        Last 12 Months
        <!-- <svg class="w-2.5 m-2.5 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
        </svg> -->
      </button>
      <!-- Dropdown menu -->
      <div id="lastDaysdropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
          <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
            <li>
              <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Yesterday</a>
            </li>
            <li>
              <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Today</a>
            </li>
            <li>
              <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last 7 days</a>
            </li>
            <li>
              <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last 30 days</a>
            </li>
            <li>
              <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last 90 days</a>
            </li>
          </ul>
      </div>
      <Link
      :href="route('newdeals')" 
        class="uppercase text-sm font-semibold inline-flex items-center rounded-lg text-black-600 hover:text-black-700 dark:hover:text-black-500  hover:bg-gray-100 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 px-3 py-2">
        Deals
        <svg class="w-2.5 h-2.5 ms-1.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
        </svg>
      </Link>
    </div>
  </div>
</div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg   gap-4 mb-4" style="background:#ffffff">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <caption class=" pl-6 pt-3 text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400" style="text-align:left;font-weight:bold;">Recent Accounts</caption>
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    ID
                </th>
                <th scope="col" class="px-6 py-3">
                    Customer Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Phone
                </th>
               
       
            </tr>
        </thead>
        <tbody>

            <tr class="bg-white dark:bg-gray-800" v-for="(account, index) in accounts" :key="index">
                <th scope="row" 
                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                >{{ account.id }}</th>
                <td  class="px-6 py-4">{{ account.name }}</td>
                <td  class="px-6 py-4">{{account.phone }}</td>
                <!-- <td>{{  }}</td> -->
                <!-- <td>{{ account.address }}</td> -->
                
                    </tr>

                    <tr v-if="accounts.length==0">
                <td  class="px-6 py-4" colspan="3" style="text-align:center">No accounts at the moment</td>
                
            </tr>

            
            
            <!-- <tr class="bg-white dark:bg-gray-800">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    Magic Mouse 2
                </th>
                <td class="px-6 py-4">
                    Black
                </td>
                <td class="px-6 py-4">
                    Accessories
                </td>
                

                
            </tr> -->
        </tbody>
    </table>
</div>
<div class="relative overflow-x-auto shadow-md sm:rounded-lg   gap-4 mb-4" style="background:#ffffff">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400" >
        <caption class=" pl-6 pt-3 text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400" style="text-align:left;font-weight:bold;">Recent Deals</caption>
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    ID
                </th>
                <th scope="col" class="px-6 py-3">
                    Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Account
                </th>
                </tr>

      
        </thead>
        <tbody>

            <tr class="bg-white dark:bg-gray-800" v-for="(deal, index) in deals" :key="index">
                <th scope="row" 
                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                >{{ deal.id }}</th>
                <td  class="px-6 py-4">{{ deal.name }}</td>
                <td  class="px-6 py-4">{{ deal.account.name }}</td>
       
            </tr>

            <tr v-if="deals.length==0">
                <td  class="px-6 py-4" colspan="3" style="text-align:center">No deals at the moment</td>
                
            </tr>
            
            
            <!-- <tr class="bg-white dark:bg-gray-800">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    Magic Mouse 2
                </th>
                <td class="px-6 py-4">
                    Black
                </td>
                <td class="px-6 py-4">
                    Accessories
                </td>
                <td class="px-6 py-4">
                    $99
                </td>
                
            </tr> -->
        </tbody>
    </table>
</div>

<div class="relative overflow-x-auto shadow-md sm:rounded-lg   gap-4 mb-4" style="background:#ffffff">
    
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <caption class=" pl-6 pt-3 text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400" style="text-align:left;font-weight:bold;">Recent Visits</caption>
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Id
                </th>
                <th scope="col" class="px-6 py-3">
                    Customer
                </th>
                <th scope="col" class="px-6 py-3">
                    Location
                </th>
                </tr>

      
        </thead>
        <tbody>

            <tr class="bg-white dark:bg-gray-800" v-for="(visit, index) in visits" :key="visit">
                <th scope="row" 
                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                >{{ visit.id }}</th>
                <td  class="px-6 py-4">{{ visit.account.name }}</td>
                <td  class="px-6 py-4">{{ visit.location.name }}</td>
       
            </tr>

            <tr v-if="visits.length==0">
                <td  class="px-6 py-4" colspan="3" style="text-align:center">No visits at the moment</td>
                
            </tr>
            
            
            <!-- <tr class="bg-white dark:bg-gray-800">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    Magic Mouse 2
                </th>
                <td class="px-6 py-4">
                    Black
                </td>
                <td class="px-6 py-4">
                    Accessories
                </td>
                <td class="px-6 py-4">
                    $99
                </td>
                
            </tr> -->
        </tbody>
    </table>
</div>
<div class="relative overflow-x-auto shadow-md sm:rounded-lg   gap-4 mb-4" style="background:#ffffff">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <caption class=" pl-6 pt-3 text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400" style="text-align:left;font-weight:bold;">Recent Contacts</caption>
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    ID
                </th>
                <th scope="col" class="px-6 py-3">
                    Contact
                </th>
                <th scope="col" class="px-6 py-3">
                    Account
                </th>
                </tr>

      
        </thead>
        <tbody>

            <tr class="bg-white dark:bg-gray-800" v-for="(contact, index) in contacts" :key="index">
                <th scope="row" 
                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                >{{ contact.id }}</th>
                <td  class="px-6 py-4">{{ contact.name }}</td>
                <td  class="px-6 py-4">{{ contact.account.name }}</td>
       
            </tr>

            <tr v-if="contacts.length==0">
                <td  class="px-6 py-4" colspan="3" style="text-align:center">No contacts at the moment</td>
                
            </tr>
            
            
            <!-- <tr class="bg-white dark:bg-gray-800">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    Magic Mouse 2
                </th>
                <td class="px-6 py-4">
                    Black
                </td>
                <td class="px-6 py-4">
                    Accessories
                </td>
                <td class="px-6 py-4">
                    $99
                </td>
                
            </tr> -->
        </tbody>
    </table>
</div>
</div>
















    
        <!-- <div class="flex items-center justify-center h-48 mb-4 rounded bg-gray-50 dark:bg-gray-800">
           <p class="text-2xl text-gray-400 dark:text-gray-500">
              <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                 <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
              </svg>
           </p>
        </div> -->
        <!-- <div class="grid grid-cols-2 gap-4">
           <div class="flex items-center justify-center rounded bg-gray-50 h-28 dark:bg-gray-800">
              <p class="text-2xl text-gray-400 dark:text-gray-500">
                 <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                 </svg>
              </p>
           </div>
           <div class="flex items-center justify-center rounded bg-gray-50 h-28 dark:bg-gray-800">
              <p class="text-2xl text-gray-400 dark:text-gray-500">
                 <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                 </svg>
              </p>
           </div>
           <div class="flex items-center justify-center rounded bg-gray-50 h-28 dark:bg-gray-800">
              <p class="text-2xl text-gray-400 dark:text-gray-500">
                 <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                 </svg>
              </p>
           </div>
           <div class="flex items-center justify-center rounded bg-gray-50 h-28 dark:bg-gray-800">
              <p class="text-2xl text-gray-400 dark:text-gray-500">
                 <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                 </svg>
              </p>
           </div>
        </div> -->
     </div>
  </div>
</template>