<script setup>
import { onMounted } from 'vue'
import SidebarNew from '@/Pages/Sidebarnew.vue';
import { mapState, mapGetters } from 'vuex';
import { computed, toRefs } from 'vue';
import { ref, watch } from "vue"; 
import { useStore } from 'vuex';
import VueApexCharts from "vue3-apexcharts";
import { Link } from '@inertiajs/vue3';
import { useUserStore } from '../store/user';

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
  auth: Object,
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
  percentageChangeDeals: {
    type: Number, // Define the type as String
    default: 0,  // Provide an empty string as the default value
  },
  percentageChangeLeads: {
    type: Number, // Define the type as String
    default: 0,  // Provide an empty string as the default value
  },
  dealsThisWeek: {
    type: Number, // Define the type as String
    default: 0,  // Provide an empty string as the default value
  },
  accountsThisMonth: {
    type: Number, // Define the type as String
    default: 0,  // Provide an empty string as the default value
  },
  leadsThisMonth: {
    type: Number, // Define the type as String
    default: 0,  // Provide an empty string as the default value
  },
  conversionRate: {
    type: Number, // Define the type as String
    default: 0,  // Provide an empty string as the default value
  },
  accounts: {
    type: Array,
    default: () => [],
  },
  productTargets: {
    type: Array,
    default: () => [],
  },
  dealsPerMonth: {
    type: Array,
    default: () => [],
  },
  dealsLast7Days: {
    type: Array,
    default: () => [],
  },
  leadsLast7Days: {
    type: Array,
    default: () => [],
  },
  accountsLast7Days: {
    type: Array,
    default: () => [],
  },
  accountsLeadsLast7Days: {
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
  productNamesPieChart: {
    type: Array,
    default: () => [],
  },
  totalSoldPieChart: {
    type: Array,
    default: () => [],
  },
  palettePieChart: {
    type: Array,
    default: () => [],
  },
  
});


// Access the Pinia store
const userStore = useUserStore();

// Initialize the Pinia store with Inertia data
userStore.setUser(props.auth.user);

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






// Chart options
const chartOptionsLeads = {
  chart: {
    type: "bar",
    height: "320px",
    fontFamily: "Inter, sans-serif",
    toolbar: {
      show: false,
    },
  },
  colors: ["#1A56DB", "#FDBA8C"],
  plotOptions: {
    bar: {
      horizontal: false,
      columnWidth: "70%",
      borderRadiusApplication: "end",
      borderRadius: 8,
    },
  },
  tooltip: {
    shared: true,
    intersect: false,
    style: {
      fontFamily: "Inter, sans-serif",
    },
  },
  states: {
    hover: {
      filter: {
        type: "darken",
        value: 1,
      },
    },
  },
  stroke: {
    show: true,
    width: 0,
    colors: ["transparent"],
  },
  grid: {
    show: false,
    strokeDashArray: 4,
    padding: {
      left: 2,
      right: 2,
      top: -14,
    },
  },
  dataLabels: {
    enabled: false,
  },
  legend: {
    show: false,
  },
  xaxis: {
    floating: false,
    labels: {
      show: true,
      style: {
        fontFamily: "Inter, sans-serif",
        cssClass: "text-xs font-normal fill-gray-500 dark:fill-gray-400",
      },
    },
    axisBorder: {
      show: false,
    },
    axisTicks: {
      show: false,
    },
  },
  yaxis: {
    show: false,
  },
  fill: {
    opacity: 1,
  },
};

console.log('leads');
console.log(props.leadsLast7Days);
console.log('leads');

// Chart series data
const chartSeries = [
  {
    name: "Leads",
    color: "#C71A20",
    data: props.leadsLast7Days
  },
  {
    name: "Accounts",
    color: "#05C3FB",
    data: props.accountsLeadsLast7Days,
  },
];

if(document.getElementById("column-chart") && typeof ApexCharts !== 'undefined') {
  const chart = new ApexCharts(document.getElementById("column-chart"), options);
  chart.render();
}

// Pie chart options
const chartOptionsPie = {
  chart: {
    type: "pie",
    height: "320px",
    fontFamily: "Inter, sans-serif",
  },
  labels: props.productNamesPieChart,
  legend: {
    // show: false, // Disables the legend
    position: "bottom",
    labels: {
      colors: ["#000"], // Adjust for light/dark themes
      useSeriesColors: false,
    },
    fontFamily: "Inter, sans-serif",
  },
  tooltip: {
    style: {
      fontFamily: "Inter, sans-serif",
    },
  },
  dataLabels: {
    enabled: false,
    formatter: function (val) {
        return Math.round(val); // Rounds to the nearest whole number
    },
    style: {
      fontFamily: "Inter, sans-serif",
      fontSize: "14px",
      colors: ["#fff"], // Adjust for themes
    },
    borderWidth: 0 // Removes border shadows if they exist
  },
  fill: {
    colors: props.palettePieChart, // Pie chart slice colors
  },
};

// Pie chart series data
const chartSeriesPie = props.totalSoldPieChart; // Represents values for each label


const chartOptionsDealsWeek = {
  chart: {
    type: "bar",
    toolbar: { show: false },
  },
  plotOptions: {
    bar: {
      columnWidth: "50%",
      borderRadiusApplication: "end",
      borderRadius: 2,

    },
  },
  colors: ["#C71A20"],


  xaxis: {
    show: false, // Disable x-axis
    labels: {
      show: false // Hide x-axis labels (numbers)
    },
    lines: {
      show: false // Hide the line under the x-axis
    },
  },
  yaxis: {
    show: false // Disable y-axis
  },
  grid: {
    show: false // Disable grid lines
  },
  dataLabels: {
    enabled: false // Disable data labels
  },
  tooltip: {
    enabled: false // Disable tooltips
  },
  legend: {
    show: false // Disable the legend
  },
  title: {
    text: undefined // Disable chart title
  },
  fill: {
    opacity: 1 // Set fill opacity (keep bars visible)
  },
  stroke: {
    show: false // Disable stroke around bars
  }
};

const chartSeriesDealsWeek = [
  {
    name: "Quantity",
    data: props.dealsLast7Days,
  },
];


// Register VueApexCharts component
VueApexCharts;


</script>
<template>

<SidebarNew/>

  
  
  <div class="p-4 sm:ml-64 bg-defaultbackground-50 dark:bg-gray-900">
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
      :href="route('deals')" 
        class="uppercase text-sm font-semibold inline-flex items-center rounded-lg text-blue-600 hover:text-blue-700 dark:hover:text-blue-500  hover:bg-gray-100 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 px-3 py-2">
        Deals
        <svg class="w-2.5 h-2.5 ms-1.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
        </svg>
      </Link>
    </div>
  </div>
</div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">

          <div class="w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
  <div class="flex justify-between pb-4 mb-4 border-b border-gray-200 dark:border-gray-700">
    <div class="flex items-center">
      <div class="w-12 h-12 rounded-lg bg-gray-100 dark:bg-gray-700 flex items-center justify-center me-3">
        <svg class="w-6 h-6 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 19">
          <path d="M14.5 0A3.987 3.987 0 0 0 11 2.1a4.977 4.977 0 0 1 3.9 5.858A3.989 3.989 0 0 0 14.5 0ZM9 13h2a4 4 0 0 1 4 4v2H5v-2a4 4 0 0 1 4-4Z"/>
          <path d="M5 19h10v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2ZM5 7a5.008 5.008 0 0 1 4-4.9 3.988 3.988 0 1 0-3.9 5.859A4.974 4.974 0 0 1 5 7Zm5 3a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm5-1h-.424a5.016 5.016 0 0 1-1.942 2.232A6.007 6.007 0 0 1 17 17h2a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5ZM5.424 9H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h2a6.007 6.007 0 0 1 4.366-5.768A5.016 5.016 0 0 1 5.424 9Z"/>
        </svg>
      </div>
      <div>
        <h5 class="leading-none text-2xl font-bold text-gray-900 dark:text-white pb-1">{{ leadsThisMonth }}</h5>
        <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Leads generated this month</p>
      </div>
    </div>
    <div>
      <span v-if="percentageChange > 0 || percentageChange == 0" class="bg-green-100 text-green-800 text-xs font-medium inline-flex items-center px-2.5 py-1 rounded-md dark:bg-green-900 dark:text-green-300">
        <svg class="w-2.5 h-2.5 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 14">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13V1m0 0L1 5m4-4 4 4"/>
        </svg>
        {{ Math.abs(percentageChangeLeads) }} %
      </span>
      <span v-else class="bg-red-100 text-red-800 text-xs font-medium inline-flex items-center px-2.5 py-1 rounded-md dark:bg-red-900 dark:text-red-300">
  <svg class="w-2.5 h-2.5 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 14">
    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1v12m0 0l4-4m-4 4l-4-4"/>
  </svg>
  {{ Math.abs(percentageChangeLeads) }} %
</span>
    </div>
  </div>

  <div class="grid grid-cols-2">
    <dl class="flex items-center">
        <dt class="text-gray-500 dark:text-gray-400 text-sm font-normal me-1">Leads Converted:</dt>
        <dd class="text-gray-900 text-sm dark:text-white font-semibold">{{ accountsThisMonth }}</dd>
    </dl>
    <dl class="flex items-center justify-end">
        <dt class="text-gray-500 dark:text-gray-400 text-sm font-normal me-1">Conversion rate:</dt>
        <dd class="text-gray-900 text-sm dark:text-white font-semibold">{{conversionRate}}%</dd>
    </dl>
  </div>

  <div id="column-chart"></div>
  <div style="max-height:320px;">
  <apexchart 
      type="bar" 
      :options="chartOptionsLeads" 
      :series="chartSeries" 
      height="320px"
    />
    </div>
    
    <div class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between">
      <div class="flex justify-between items-center pt-5">
        <!-- Button -->
        <!-- id="dropdownDefaultButton"
          data-dropdown-toggle="lastDaysdropdown"
          data-dropdown-placement="bottom" -->
        <button
         
          class="text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-900 text-center inline-flex items-center dark:hover:text-white"
          type="button">
          Last 7 days
          <!-- <svg class="w-2.5 m-2.5 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
          </svg> -->
        </button>


  
        <!-- Dropdown menu -->
        <!-- <div id="lastDaysdropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
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
        </div> -->
        <Link
          :href="route('leads')"
          class="uppercase text-sm font-semibold inline-flex items-center rounded-lg text-blue-600 hover:text-blue-700 dark:hover:text-blue-500  hover:bg-gray-100 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 px-3 py-2">
          Leads
          <svg class="w-2.5 h-2.5 ms-1.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
          </svg>
        </Link>
      </div>
    </div>
</div>


<div class=" w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">

<div class="flex justify-between pb-4 mb-4 border-b border-gray-200 dark:border-gray-700 items-start w-full">
    <div class="flex-col items-center">
      <div class="flex items-center mb-1">
          <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white me-1">Products Sold</h5>
          <svg data-popover-target="chart-info" data-popover-placement="bottom" class="w-3.5 h-3.5 text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white cursor-pointer ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm0 16a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3Zm1-5.034V12a1 1 0 0 1-2 0v-1.418a1 1 0 0 1 1.038-.999 1.436 1.436 0 0 0 1.488-1.441 1.501 1.501 0 1 0-3-.116.986.986 0 0 1-1.037.961 1 1 0 0 1-.96-1.037A3.5 3.5 0 1 1 11 11.466Z"/>
          </svg>
          <div data-popover id="chart-info" role="tooltip" class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 w-72 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400">
              <div class="p-3 space-y-2">
                  <h3 class="font-semibold text-gray-900 dark:text-white">Activity growth - Incremental</h3>
                  <p>Report helps navigate cumulative growth of community activities. Ideally, the chart should have a growing trend, as stagnating chart signifies a significant decrease of community activity.</p>
                  <h3 class="font-semibold text-gray-900 dark:text-white">Calculation</h3>
                  <p>For each date bucket, the all-time volume of activities is calculated. This means that activities in period n contain all activities up to period n, plus the activities generated by your community in period.</p>
                  <a href="#" class="flex items-center font-medium text-blue-600 dark:text-blue-500 dark:hover:text-blue-600 hover:text-blue-700 hover:underline">Read more <svg class="w-2 h-2 ms-1.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
            </svg></a>
          </div>
          <div data-popper-arrow></div>
      </div>
    </div>
    <button id="dateRangeButton" data-dropdown-toggle="dateRangeDropdown" data-dropdown-ignore-click-outside-class="datepicker" type="button" class="inline-flex items-center text-blue-700 dark:text-blue-600 font-medium hover:underline">This Month <svg class="w-3 h-3 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
      </svg>
    </button>
    <div id="dateRangeDropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-80 lg:w-96 dark:bg-gray-700 dark:divide-gray-600">
        <div class="p-3" aria-labelledby="dateRangeButton">
          <div date-rangepicker datepicker-autohide class="flex items-center">
              <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                      <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                    </svg>
                </div>
                <input name="start" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Start date">
              </div>
              <span class="mx-2 text-gray-500 dark:text-gray-400">to</span>
              <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                      <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                    </svg>
                </div>
                <input name="end" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="End date">
            </div>
          </div>
        </div>
    </div>
  </div>
  <div class="flex justify-end items-center">
    <button id="widgetDropdownButton" data-dropdown-toggle="widgetDropdown" data-dropdown-placement="bottom" type="button"  class="inline-flex items-center justify-center text-gray-500 w-8 h-8 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm"><svg class="w-3.5 h-3.5 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 3">
        <path d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z"/>
      </svg><span class="sr-only">Open dropdown</span>
    </button>
    <div id="widgetDropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="widgetDropdownButton">
          <li>
            <a href="#" class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"><svg class="w-3 h-3 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 21 21">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7.418 17.861 1 20l2.139-6.418m4.279 4.279 10.7-10.7a3.027 3.027 0 0 0-2.14-5.165c-.802 0-1.571.319-2.139.886l-10.7 10.7m4.279 4.279-4.279-4.279m2.139 2.14 7.844-7.844m-1.426-2.853 4.279 4.279"/>
              </svg>Edit widget
            </a>
          </li>
          <li>
            <a href="#" class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"><svg class="w-3 h-3 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z"/>
                <path d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z"/>
              </svg>Download data
            </a>
          </li>
          <li>
            <a href="#" class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"><svg class="w-3 h-3 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m5.953 7.467 6.094-2.612m.096 8.114L5.857 9.676m.305-1.192a2.581 2.581 0 1 1-5.162 0 2.581 2.581 0 0 1 5.162 0ZM17 3.84a2.581 2.581 0 1 1-5.162 0 2.581 2.581 0 0 1 5.162 0Zm0 10.322a2.581 2.581 0 1 1-5.162 0 2.581 2.581 0 0 1 5.162 0Z"/>
              </svg>Add to repository
            </a>
          </li>
          <li>
            <a href="#" class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"><svg class="w-3 h-3 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                <path d="M17 4h-4V2a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v2H1a1 1 0 0 0 0 2h1v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6h1a1 1 0 1 0 0-2ZM7 2h4v2H7V2Zm1 14a1 1 0 1 1-2 0V8a1 1 0 0 1 2 0v8Zm4 0a1 1 0 0 1-2 0V8a1 1 0 0 1 2 0v8Z"/>
              </svg>Delete widget
            </a>
          </li>
        </ul>
  </div>
</div>
</div>



<!-- Line Chart -->
<div class="py-6" id="pie-chart"></div>
<div style="max-height:320px;">
<apexchart 
      type="pie" 
      :options="chartOptionsPie" 
      :series="chartSeriesPie" 
      height="320px"
      
    />
    </div>

    <div class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between">
      <div class="flex justify-between items-center pt-5">
        <!-- Button -->
        <!-- id="dropdownDefaultButton"
          data-dropdown-toggle="lastDaysdropdown"
          data-dropdown-placement="bottom" -->
        <button
         
          class="text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-900 text-center inline-flex items-center dark:hover:text-white"
          type="button">
          Last Month
          <!-- <svg class="w-2.5 m-2.5 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
          </svg> -->
        </button>


  
        <!-- Dropdown menu -->
        <!-- <div id="lastDaysdropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
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
        </div> -->
        <Link
          :href="route('products')"
          class="uppercase text-sm font-semibold inline-flex items-center rounded-lg text-blue-600 hover:text-blue-700 dark:hover:text-blue-500  hover:bg-gray-100 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 px-3 py-2">
          Products 
          <svg class="w-2.5 h-2.5 ms-1.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
          </svg>
        </Link>
      </div>
    </div>
</div>

<div class="items-center justify-between p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:flex dark:border-gray-700 sm:p-6 dark:bg-gray-800">
        <div class="w-full">
          <h3 class="text-base font-normal text-gray-500 dark:text-gray-400">Deals this week</h3>
          <span class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl dark:text-white">{{ dealsThisWeek }}</span>
          <p class="flex items-center text-base font-normal text-gray-500 dark:text-gray-400">
            <span v-if="percentageChangeDeals >= 0" class="flex items-center mr-1.5 text-sm text-green-500 dark:text-green-400">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
              <path clip-rule="evenodd" fill-rule="evenodd" d="M10 17a.75.75 0 01-.75-.75V5.612L5.29 9.77a.75.75 0 01-1.08-1.04l5.25-5.5a.75.75 0 011.08 0l5.25 5.5a.75.75 0 11-1.08 1.04l-3.96-4.158V16.25A.75.75 0 0110 17z"></path>
            </svg>
            {{ Math.abs(percentageChangeDeals) }}% 
          </span>

          <span v-else class="flex items-center mr-1.5 text-sm text-red-500 dark:text-red-400">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
              <path clip-rule="evenodd" fill-rule="evenodd" d="M10 17a.75.75 0 01-.75-.75V5.612L5.29 9.77a.75.75 0 01-1.08-1.04l5.25-5.5a.75.75 0 011.08 0l5.25 5.5a.75.75 0 11-1.08 1.04l-3.96-4.158V16.25A.75.75 0 0110 17z"></path>
            </svg>
            {{ Math.abs(percentageChangeDeals) }}% 
          </span>

            Since last week
          </p>
        </div>
        <div class="w-full" id="new-products-chart" style="min-height: 155px;">
          <div id="apexcharts27ioayty" class="apexcharts-canvas apexcharts27ioayty apexcharts-theme-light" style="width: 215px; height: 140px;">
            <!-- <svg id="SvgjsSvg1488" width="215" height="140" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;"><g id="SvgjsG1490" class="apexcharts-inner apexcharts-graphical" transform="translate(12, 30)"><defs id="SvgjsDefs1489"><linearGradient id="SvgjsLinearGradient1494" x1="0" y1="0" x2="0" y2="1"><stop id="SvgjsStop1495" stop-opacity="0.4" stop-color="rgba(216,227,240,0.4)" offset="0"></stop><stop id="SvgjsStop1496" stop-opacity="0.5" stop-color="rgba(190,209,230,0.5)" offset="1"></stop><stop id="SvgjsStop1497" stop-opacity="0.5" stop-color="rgba(190,209,230,0.5)" offset="1"></stop></linearGradient><clipPath id="gridRectMask27ioayty"><rect id="SvgjsRect1499" width="202" height="83" x="-4.5" y="-2.5" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="forecastMask27ioayty"></clipPath><clipPath id="nonForecastMask27ioayty"></clipPath><clipPath id="gridRectMarkerMask27ioayty"><rect id="SvgjsRect1500" width="197" height="82" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath></defs><rect id="SvgjsRect1498" width="24.814285714285717" height="78" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke-dasharray="3" fill="url(#SvgjsLinearGradient1494)" class="apexcharts-xcrosshairs" y2="78" filter="none" fill-opacity="0.9"></rect><g id="SvgjsG1519" class="apexcharts-xaxis" transform="translate(0, 0)"><g id="SvgjsG1520" class="apexcharts-xaxis-texts-g" transform="translate(0, 4)"></g></g><g id="SvgjsG1529" class="apexcharts-grid"><g id="SvgjsG1530" class="apexcharts-gridlines-horizontal" style="display: none;"><line id="SvgjsLine1532" x1="0" y1="0" x2="193" y2="0" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1533" x1="0" y1="19.5" x2="193" y2="19.5" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1534" x1="0" y1="39" x2="193" y2="39" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1535" x1="0" y1="58.5" x2="193" y2="58.5" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1536" x1="0" y1="78" x2="193" y2="78" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line></g><g id="SvgjsG1531" class="apexcharts-gridlines-vertical" style="display: none;"></g><line id="SvgjsLine1538" x1="0" y1="78" x2="193" y2="78" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line><line id="SvgjsLine1537" x1="0" y1="1" x2="0" y2="78" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line></g><g id="SvgjsG1501" class="apexcharts-bar-series apexcharts-plot-series"><g id="SvgjsG1502" class="apexcharts-series" rel="1" seriesName="Quantity" data:realIndex="0"><path id="SvgjsPath1506" d="M 1.3785714285714281 78L 1.3785714285714281 14.700000000000003Q 1.3785714285714281 11.700000000000003 4.378571428571428 11.700000000000003L 18.192857142857143 11.700000000000003Q 21.192857142857143 11.700000000000003 21.192857142857143 14.700000000000003L 21.192857142857143 14.700000000000003L 21.192857142857143 78L 21.192857142857143 78z" fill="rgba(26,86,219,1)" fill-opacity="1" stroke="transparent" stroke-opacity="1" stroke-linecap="round" stroke-width="5" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMask27ioayty)" pathTo="M 1.3785714285714281 78L 1.3785714285714281 14.700000000000003Q 1.3785714285714281 11.700000000000003 4.378571428571428 11.700000000000003L 18.192857142857143 11.700000000000003Q 21.192857142857143 11.700000000000003 21.192857142857143 14.700000000000003L 21.192857142857143 14.700000000000003L 21.192857142857143 78L 21.192857142857143 78z" pathFrom="M 1.3785714285714281 78L 1.3785714285714281 78L 21.192857142857143 78L 21.192857142857143 78L 21.192857142857143 78L 21.192857142857143 78L 21.192857142857143 78L 1.3785714285714281 78" cy="11.700000000000003" cx="26.450000000000003" j="0" val="170" barHeight="66.3" barWidth="24.814285714285717"></path><path id="SvgjsPath1508" d="M 28.950000000000003 78L 28.950000000000003 10.800000000000011Q 28.950000000000003 7.800000000000011 31.950000000000003 7.800000000000011L 45.76428571428572 7.800000000000011Q 48.76428571428572 7.800000000000011 48.76428571428572 10.800000000000011L 48.76428571428572 10.800000000000011L 48.76428571428572 78L 48.76428571428572 78z" fill="rgba(26,86,219,1)" fill-opacity="1" stroke="transparent" stroke-opacity="1" stroke-linecap="round" stroke-width="5" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMask27ioayty)" pathTo="M 28.950000000000003 78L 28.950000000000003 10.800000000000011Q 28.950000000000003 7.800000000000011 31.950000000000003 7.800000000000011L 45.76428571428572 7.800000000000011Q 48.76428571428572 7.800000000000011 48.76428571428572 10.800000000000011L 48.76428571428572 10.800000000000011L 48.76428571428572 78L 48.76428571428572 78z" pathFrom="M 28.950000000000003 78L 28.950000000000003 78L 48.76428571428572 78L 48.76428571428572 78L 48.76428571428572 78L 48.76428571428572 78L 48.76428571428572 78L 28.950000000000003 78" cy="7.800000000000011" cx="54.02142857142857" j="1" val="180" barHeight="70.19999999999999" barWidth="24.814285714285717"></path><path id="SvgjsPath1510" d="M 56.52142857142857 78L 56.52142857142857 17.040000000000006Q 56.52142857142857 14.040000000000006 59.52142857142857 14.040000000000006L 73.33571428571429 14.040000000000006Q 76.33571428571429 14.040000000000006 76.33571428571429 17.040000000000006L 76.33571428571429 17.040000000000006L 76.33571428571429 78L 76.33571428571429 78z" fill="rgba(26,86,219,1)" fill-opacity="1" stroke="transparent" stroke-opacity="1" stroke-linecap="round" stroke-width="5" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMask27ioayty)" pathTo="M 56.52142857142857 78L 56.52142857142857 17.040000000000006Q 56.52142857142857 14.040000000000006 59.52142857142857 14.040000000000006L 73.33571428571429 14.040000000000006Q 76.33571428571429 14.040000000000006 76.33571428571429 17.040000000000006L 76.33571428571429 17.040000000000006L 76.33571428571429 78L 76.33571428571429 78z" pathFrom="M 56.52142857142857 78L 56.52142857142857 78L 76.33571428571429 78L 76.33571428571429 78L 76.33571428571429 78L 76.33571428571429 78L 76.33571428571429 78L 56.52142857142857 78" cy="14.040000000000006" cx="81.59285714285714" j="2" val="164" barHeight="63.959999999999994" barWidth="24.814285714285717"></path><path id="SvgjsPath1512" d="M 84.09285714285714 78L 84.09285714285714 24.450000000000003Q 84.09285714285714 21.450000000000003 87.09285714285714 21.450000000000003L 100.90714285714286 21.450000000000003Q 103.90714285714286 21.450000000000003 103.90714285714286 24.450000000000003L 103.90714285714286 24.450000000000003L 103.90714285714286 78L 103.90714285714286 78z" fill="rgba(26,86,219,1)" fill-opacity="1" stroke="transparent" stroke-opacity="1" stroke-linecap="round" stroke-width="5" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMask27ioayty)" pathTo="M 84.09285714285714 78L 84.09285714285714 24.450000000000003Q 84.09285714285714 21.450000000000003 87.09285714285714 21.450000000000003L 100.90714285714286 21.450000000000003Q 103.90714285714286 21.450000000000003 103.90714285714286 24.450000000000003L 103.90714285714286 24.450000000000003L 103.90714285714286 78L 103.90714285714286 78z" pathFrom="M 84.09285714285714 78L 84.09285714285714 78L 103.90714285714286 78L 103.90714285714286 78L 103.90714285714286 78L 103.90714285714286 78L 103.90714285714286 78L 84.09285714285714 78" cy="21.450000000000003" cx="109.16428571428571" j="3" val="145" barHeight="56.55" barWidth="24.814285714285717"></path><path id="SvgjsPath1514" d="M 111.66428571428571 78L 111.66428571428571 5.340000000000003Q 111.66428571428571 2.3400000000000034 114.66428571428571 2.3400000000000034L 128.47857142857143 2.3400000000000034Q 131.47857142857143 2.3400000000000034 131.47857142857143 5.340000000000003L 131.47857142857143 5.340000000000003L 131.47857142857143 78L 131.47857142857143 78z" fill="rgba(26,86,219,1)" fill-opacity="1" stroke="transparent" stroke-opacity="1" stroke-linecap="round" stroke-width="5" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMask27ioayty)" pathTo="M 111.66428571428571 78L 111.66428571428571 5.340000000000003Q 111.66428571428571 2.3400000000000034 114.66428571428571 2.3400000000000034L 128.47857142857143 2.3400000000000034Q 131.47857142857143 2.3400000000000034 131.47857142857143 5.340000000000003L 131.47857142857143 5.340000000000003L 131.47857142857143 78L 131.47857142857143 78z" pathFrom="M 111.66428571428571 78L 111.66428571428571 78L 131.47857142857143 78L 131.47857142857143 78L 131.47857142857143 78L 131.47857142857143 78L 131.47857142857143 78L 111.66428571428571 78" cy="2.3400000000000034" cx="136.7357142857143" j="4" val="194" barHeight="75.66" barWidth="24.814285714285717"></path><path id="SvgjsPath1516" d="M 139.2357142857143 78L 139.2357142857143 14.700000000000003Q 139.2357142857143 11.700000000000003 142.2357142857143 11.700000000000003L 156.05 11.700000000000003Q 159.05 11.700000000000003 159.05 14.700000000000003L 159.05 14.700000000000003L 159.05 78L 159.05 78z" fill="rgba(26,86,219,1)" fill-opacity="1" stroke="transparent" stroke-opacity="1" stroke-linecap="round" stroke-width="5" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMask27ioayty)" pathTo="M 139.2357142857143 78L 139.2357142857143 14.700000000000003Q 139.2357142857143 11.700000000000003 142.2357142857143 11.700000000000003L 156.05 11.700000000000003Q 159.05 11.700000000000003 159.05 14.700000000000003L 159.05 14.700000000000003L 159.05 78L 159.05 78z" pathFrom="M 139.2357142857143 78L 139.2357142857143 78L 159.05 78L 159.05 78L 159.05 78L 159.05 78L 159.05 78L 139.2357142857143 78" cy="11.700000000000003" cx="164.30714285714288" j="5" val="170" barHeight="66.3" barWidth="24.814285714285717"></path><path id="SvgjsPath1518" d="M 166.80714285714288 78L 166.80714285714288 20.550000000000004Q 166.80714285714288 17.550000000000004 169.80714285714288 17.550000000000004L 183.6214285714286 17.550000000000004Q 186.6214285714286 17.550000000000004 186.6214285714286 20.550000000000004L 186.6214285714286 20.550000000000004L 186.6214285714286 78L 186.6214285714286 78z" fill="rgba(26,86,219,1)" fill-opacity="1" stroke="transparent" stroke-opacity="1" stroke-linecap="round" stroke-width="5" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMask27ioayty)" pathTo="M 166.80714285714288 78L 166.80714285714288 20.550000000000004Q 166.80714285714288 17.550000000000004 169.80714285714288 17.550000000000004L 183.6214285714286 17.550000000000004Q 186.6214285714286 17.550000000000004 186.6214285714286 20.550000000000004L 186.6214285714286 20.550000000000004L 186.6214285714286 78L 186.6214285714286 78z" pathFrom="M 166.80714285714288 78L 166.80714285714288 78L 186.6214285714286 78L 186.6214285714286 78L 186.6214285714286 78L 186.6214285714286 78L 186.6214285714286 78L 166.80714285714288 78" cy="17.550000000000004" cx="191.87857142857146" j="6" val="155" barHeight="60.449999999999996" barWidth="24.814285714285717"></path><g id="SvgjsG1504" class="apexcharts-bar-goals-markers" style="pointer-events: none"><g id="SvgjsG1505" className="apexcharts-bar-goals-groups"></g><g id="SvgjsG1507" className="apexcharts-bar-goals-groups"></g><g id="SvgjsG1509" className="apexcharts-bar-goals-groups"></g><g id="SvgjsG1511" className="apexcharts-bar-goals-groups"></g><g id="SvgjsG1513" className="apexcharts-bar-goals-groups"></g><g id="SvgjsG1515" className="apexcharts-bar-goals-groups"></g><g id="SvgjsG1517" className="apexcharts-bar-goals-groups"></g></g></g><g id="SvgjsG1503" class="apexcharts-datalabels" data:realIndex="0"></g></g><line id="SvgjsLine1539" x1="0" y1="0" x2="193" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine1540" x1="0" y1="0" x2="193" y2="0" stroke-dasharray="0" stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line><g id="SvgjsG1541" class="apexcharts-yaxis-annotations"></g><g id="SvgjsG1542" class="apexcharts-xaxis-annotations"></g><g id="SvgjsG1543" class="apexcharts-point-annotations"></g></g><g id="SvgjsG1528" class="apexcharts-yaxis" rel="0" transform="translate(-18, 0)"></g><g id="SvgjsG1491" class="apexcharts-annotations"></g></svg><div class="apexcharts-legend" style="max-height: 70px;"></div><div class="apexcharts-tooltip apexcharts-theme-light"><div class="apexcharts-tooltip-title" style="font-family: Inter, sans-serif; font-size: 14px;"></div><div class="apexcharts-tooltip-series-group" style="order: 1;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(26, 86, 219);"></span><div class="apexcharts-tooltip-text" style="font-family: Inter, sans-serif; font-size: 14px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div><div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div></div> -->
            <apexchart
        :options="chartOptionsDealsWeek"
        :series="chartSeriesDealsWeek"
        type="bar"
        height="155"
      ></apexchart>
            <div class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light">
              <div class="apexcharts-yaxistooltip-text"></div>
        </div>
      </div>
      </div>
      </div>
      <!-- <div class="items-center justify-between p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:flex dark:border-gray-700 sm:p-6 dark:bg-gray-800">
        <div class="w-full">
          <h3 class="text-base font-normal text-gray-500 dark:text-gray-400">Users</h3>
          <span class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl dark:text-white">2,340</span>
          <p class="flex items-center text-base font-normal text-gray-500 dark:text-gray-400">
            <span class="flex items-center mr-1.5 text-sm text-green-500 dark:text-green-400">
              <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <path clip-rule="evenodd" fill-rule="evenodd" d="M10 17a.75.75 0 01-.75-.75V5.612L5.29 9.77a.75.75 0 01-1.08-1.04l5.25-5.5a.75.75 0 011.08 0l5.25 5.5a.75.75 0 11-1.08 1.04l-3.96-4.158V16.25A.75.75 0 0110 17z"></path>
              </svg>
              3,4% 
            </span>
            Since last month
          </p>
        </div>
        <div class="w-full" id="week-signups-chart" style="min-height: 155px;"><div id="apexchartsa49wjz84" class="apexcharts-canvas apexchartsa49wjz84 apexcharts-theme-light" style="width: 215px; height: 140px;"><svg id="SvgjsSvg1634" width="215" height="140" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;"><g id="SvgjsG1636" class="apexcharts-inner apexcharts-graphical" transform="translate(12, 30)"><defs id="SvgjsDefs1635"><linearGradient id="SvgjsLinearGradient1640" x1="0" y1="0" x2="0" y2="1"><stop id="SvgjsStop1641" stop-opacity="0.4" stop-color="rgba(216,227,240,0.4)" offset="0"></stop><stop id="SvgjsStop1642" stop-opacity="0.5" stop-color="rgba(190,209,230,0.5)" offset="1"></stop><stop id="SvgjsStop1643" stop-opacity="0.5" stop-color="rgba(190,209,230,0.5)" offset="1"></stop></linearGradient><clipPath id="gridRectMaska49wjz84"><rect id="SvgjsRect1645" width="197" height="78" x="-2" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="forecastMaska49wjz84"></clipPath><clipPath id="nonForecastMaska49wjz84"></clipPath><clipPath id="gridRectMarkerMaska49wjz84"><rect id="SvgjsRect1646" width="197" height="82" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath></defs><rect id="SvgjsRect1644" width="6.892857142857143" height="78" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke-dasharray="3" fill="url(#SvgjsLinearGradient1640)" class="apexcharts-xcrosshairs" y2="78" filter="none" fill-opacity="0.9"></rect><g id="SvgjsG1672" class="apexcharts-xaxis" transform="translate(0, 0)"><g id="SvgjsG1673" class="apexcharts-xaxis-texts-g" transform="translate(0, 4)"></g></g><g id="SvgjsG1682" class="apexcharts-grid"><g id="SvgjsG1683" class="apexcharts-gridlines-horizontal" style="display: none;"><line id="SvgjsLine1685" x1="0" y1="0" x2="193" y2="0" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1686" x1="0" y1="15.6" x2="193" y2="15.6" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1687" x1="0" y1="31.2" x2="193" y2="31.2" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1688" x1="0" y1="46.8" x2="193" y2="46.8" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1689" x1="0" y1="62.4" x2="193" y2="62.4" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1690" x1="0" y1="78" x2="193" y2="78" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line></g><g id="SvgjsG1684" class="apexcharts-gridlines-vertical" style="display: none;"></g><line id="SvgjsLine1692" x1="0" y1="78" x2="193" y2="78" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line><line id="SvgjsLine1691" x1="0" y1="1" x2="0" y2="78" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line></g><g id="SvgjsG1647" class="apexcharts-bar-series apexcharts-plot-series"><g id="SvgjsG1648" class="apexcharts-series" rel="1" seriesName="Users" data:realIndex="0"><rect id="SvgjsRect1651" width="6.892857142857143" height="78" x="10.339285714285715" y="0" rx="3" ry="3" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#E5E7EB" class="apexcharts-backgroundBar"></rect><path id="SvgjsPath1653" d="M 10.339285714285715 78L 10.339285714285715 46.315999999999995Q 10.339285714285715 43.315999999999995 13.339285714285715 43.315999999999995L 14.232142857142858 43.315999999999995Q 17.232142857142858 43.315999999999995 17.232142857142858 46.315999999999995L 17.232142857142858 46.315999999999995L 17.232142857142858 78L 17.232142857142858 78z" fill="rgba(26,86,219,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaska49wjz84)" pathTo="M 10.339285714285715 78L 10.339285714285715 46.315999999999995Q 10.339285714285715 43.315999999999995 13.339285714285715 43.315999999999995L 14.232142857142858 43.315999999999995Q 17.232142857142858 43.315999999999995 17.232142857142858 46.315999999999995L 17.232142857142858 46.315999999999995L 17.232142857142858 78L 17.232142857142858 78z" pathFrom="M 10.339285714285715 78L 10.339285714285715 78L 17.232142857142858 78L 17.232142857142858 78L 17.232142857142858 78L 17.232142857142858 78L 17.232142857142858 78L 10.339285714285715 78" cy="43.315999999999995" cx="37.91071428571429" j="0" val="1334" barHeight="34.684000000000005" barWidth="6.892857142857143"></path><rect id="SvgjsRect1654" width="6.892857142857143" height="78" x="37.91071428571429" y="0" rx="3" ry="3" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#E5E7EB" class="apexcharts-backgroundBar"></rect><path id="SvgjsPath1656" d="M 37.91071428571429 78L 37.91071428571429 17.689999999999998Q 37.91071428571429 14.689999999999998 40.91071428571429 14.689999999999998L 41.80357142857144 14.689999999999998Q 44.80357142857144 14.689999999999998 44.80357142857144 17.689999999999998L 44.80357142857144 17.689999999999998L 44.80357142857144 78L 44.80357142857144 78z" fill="rgba(26,86,219,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaska49wjz84)" pathTo="M 37.91071428571429 78L 37.91071428571429 17.689999999999998Q 37.91071428571429 14.689999999999998 40.91071428571429 14.689999999999998L 41.80357142857144 14.689999999999998Q 44.80357142857144 14.689999999999998 44.80357142857144 17.689999999999998L 44.80357142857144 17.689999999999998L 44.80357142857144 78L 44.80357142857144 78z" pathFrom="M 37.91071428571429 78L 37.91071428571429 78L 44.80357142857144 78L 44.80357142857144 78L 44.80357142857144 78L 44.80357142857144 78L 44.80357142857144 78L 37.91071428571429 78" cy="14.689999999999998" cx="65.48214285714286" j="1" val="2435" barHeight="63.31" barWidth="6.892857142857143"></path><rect id="SvgjsRect1657" width="6.892857142857143" height="78" x="65.48214285714286" y="0" rx="3" ry="3" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#E5E7EB" class="apexcharts-backgroundBar"></rect><path id="SvgjsPath1659" d="M 65.48214285714286 78L 65.48214285714286 35.422Q 65.48214285714286 32.422 68.48214285714286 32.422L 69.375 32.422Q 72.375 32.422 72.375 35.422L 72.375 35.422L 72.375 78L 72.375 78z" fill="rgba(26,86,219,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaska49wjz84)" pathTo="M 65.48214285714286 78L 65.48214285714286 35.422Q 65.48214285714286 32.422 68.48214285714286 32.422L 69.375 32.422Q 72.375 32.422 72.375 35.422L 72.375 35.422L 72.375 78L 72.375 78z" pathFrom="M 65.48214285714286 78L 65.48214285714286 78L 72.375 78L 72.375 78L 72.375 78L 72.375 78L 72.375 78L 65.48214285714286 78" cy="32.422" cx="93.05357142857143" j="2" val="1753" barHeight="45.578" barWidth="6.892857142857143"></path><rect id="SvgjsRect1660" width="6.892857142857143" height="78" x="93.05357142857143" y="0" rx="3" ry="3" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#E5E7EB" class="apexcharts-backgroundBar"></rect><path id="SvgjsPath1662" d="M 93.05357142857143 78L 93.05357142857143 46.472Q 93.05357142857143 43.472 96.05357142857143 43.472L 96.94642857142857 43.472Q 99.94642857142857 43.472 99.94642857142857 46.472L 99.94642857142857 46.472L 99.94642857142857 78L 99.94642857142857 78z" fill="rgba(26,86,219,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaska49wjz84)" pathTo="M 93.05357142857143 78L 93.05357142857143 46.472Q 93.05357142857143 43.472 96.05357142857143 43.472L 96.94642857142857 43.472Q 99.94642857142857 43.472 99.94642857142857 46.472L 99.94642857142857 46.472L 99.94642857142857 78L 99.94642857142857 78z" pathFrom="M 93.05357142857143 78L 93.05357142857143 78L 99.94642857142857 78L 99.94642857142857 78L 99.94642857142857 78L 99.94642857142857 78L 99.94642857142857 78L 93.05357142857143 78" cy="43.472" cx="120.625" j="3" val="1328" barHeight="34.528" barWidth="6.892857142857143"></path><rect id="SvgjsRect1663" width="6.892857142857143" height="78" x="120.625" y="0" rx="3" ry="3" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#E5E7EB" class="apexcharts-backgroundBar"></rect><path id="SvgjsPath1665" d="M 120.625 78L 120.625 50.97Q 120.625 47.97 123.625 47.97L 124.51785714285714 47.97Q 127.51785714285714 47.97 127.51785714285714 50.97L 127.51785714285714 50.97L 127.51785714285714 78L 127.51785714285714 78z" fill="rgba(26,86,219,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaska49wjz84)" pathTo="M 120.625 78L 120.625 50.97Q 120.625 47.97 123.625 47.97L 124.51785714285714 47.97Q 127.51785714285714 47.97 127.51785714285714 50.97L 127.51785714285714 50.97L 127.51785714285714 78L 127.51785714285714 78z" pathFrom="M 120.625 78L 120.625 78L 127.51785714285714 78L 127.51785714285714 78L 127.51785714285714 78L 127.51785714285714 78L 127.51785714285714 78L 120.625 78" cy="47.97" cx="148.19642857142858" j="4" val="1155" barHeight="30.03" barWidth="6.892857142857143"></path><rect id="SvgjsRect1666" width="6.892857142857143" height="78" x="148.19642857142858" y="0" rx="3" ry="3" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#E5E7EB" class="apexcharts-backgroundBar"></rect><path id="SvgjsPath1668" d="M 148.19642857142858 78L 148.19642857142858 38.568Q 148.19642857142858 35.568 151.19642857142858 35.568L 152.08928571428572 35.568Q 155.08928571428572 35.568 155.08928571428572 38.568L 155.08928571428572 38.568L 155.08928571428572 78L 155.08928571428572 78z" fill="rgba(26,86,219,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaska49wjz84)" pathTo="M 148.19642857142858 78L 148.19642857142858 38.568Q 148.19642857142858 35.568 151.19642857142858 35.568L 152.08928571428572 35.568Q 155.08928571428572 35.568 155.08928571428572 38.568L 155.08928571428572 38.568L 155.08928571428572 78L 155.08928571428572 78z" pathFrom="M 148.19642857142858 78L 148.19642857142858 78L 155.08928571428572 78L 155.08928571428572 78L 155.08928571428572 78L 155.08928571428572 78L 155.08928571428572 78L 148.19642857142858 78" cy="35.568" cx="175.76785714285717" j="5" val="1632" barHeight="42.432" barWidth="6.892857142857143"></path><rect id="SvgjsRect1669" width="6.892857142857143" height="78" x="175.76785714285717" y="0" rx="3" ry="3" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#E5E7EB" class="apexcharts-backgroundBar"></rect><path id="SvgjsPath1671" d="M 175.76785714285717 78L 175.76785714285717 46.263999999999996Q 175.76785714285717 43.263999999999996 178.76785714285717 43.263999999999996L 179.6607142857143 43.263999999999996Q 182.6607142857143 43.263999999999996 182.6607142857143 46.263999999999996L 182.6607142857143 46.263999999999996L 182.6607142857143 78L 182.6607142857143 78z" fill="rgba(26,86,219,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaska49wjz84)" pathTo="M 175.76785714285717 78L 175.76785714285717 46.263999999999996Q 175.76785714285717 43.263999999999996 178.76785714285717 43.263999999999996L 179.6607142857143 43.263999999999996Q 182.6607142857143 43.263999999999996 182.6607142857143 46.263999999999996L 182.6607142857143 46.263999999999996L 182.6607142857143 78L 182.6607142857143 78z" pathFrom="M 175.76785714285717 78L 175.76785714285717 78L 182.6607142857143 78L 182.6607142857143 78L 182.6607142857143 78L 182.6607142857143 78L 182.6607142857143 78L 175.76785714285717 78" cy="43.263999999999996" cx="203.33928571428575" j="6" val="1336" barHeight="34.736000000000004" barWidth="6.892857142857143"></path><g id="SvgjsG1650" class="apexcharts-bar-goals-markers" style="pointer-events: none"><g id="SvgjsG1652" className="apexcharts-bar-goals-groups"></g><g id="SvgjsG1655" className="apexcharts-bar-goals-groups"></g><g id="SvgjsG1658" className="apexcharts-bar-goals-groups"></g><g id="SvgjsG1661" className="apexcharts-bar-goals-groups"></g><g id="SvgjsG1664" className="apexcharts-bar-goals-groups"></g><g id="SvgjsG1667" className="apexcharts-bar-goals-groups"></g><g id="SvgjsG1670" className="apexcharts-bar-goals-groups"></g></g></g><g id="SvgjsG1649" class="apexcharts-datalabels" data:realIndex="0"></g></g><line id="SvgjsLine1693" x1="0" y1="0" x2="193" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine1694" x1="0" y1="0" x2="193" y2="0" stroke-dasharray="0" stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line><g id="SvgjsG1695" class="apexcharts-yaxis-annotations"></g><g id="SvgjsG1696" class="apexcharts-xaxis-annotations"></g><g id="SvgjsG1697" class="apexcharts-point-annotations"></g></g><g id="SvgjsG1681" class="apexcharts-yaxis" rel="0" transform="translate(-18, 0)"></g><g id="SvgjsG1637" class="apexcharts-annotations"></g></svg><div class="apexcharts-legend" style="max-height: 70px;"></div><div class="apexcharts-tooltip apexcharts-theme-light"><div class="apexcharts-tooltip-title" style="font-family: Inter, sans-serif; font-size: 14px;"></div><div class="apexcharts-tooltip-series-group" style="order: 1;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(26, 86, 219);"></span><div class="apexcharts-tooltip-text" style="font-family: Inter, sans-serif; font-size: 14px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div><div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div></div><div class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light"><div class="apexcharts-yaxistooltip-text"></div></div></div></div>
      </div> -->
      <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
        <div class="w-full">
          <h3 class="mb-2 text-base font-normal text-gray-500 dark:text-gray-400">Top Product Targets</h3>
          <div class="flex items-center mb-2" v-for="(target, index) in productTargets" :key="index">
            <div class="w-1/4 text-sm font-medium dark:text-white">{{ target.name }} </div>
            <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
              <div class="bg-primary-600 h-2.5 rounded-full dark:bg-primary-500" :style="{ width: Math.min(target.percentage_achieved, 100) + '%' }"></div>
            </div>
          </div>
          <!-- <div class="flex items-center mb-2">
            <div class="w-16 text-sm font-medium dark:text-white">KSh </div>
            <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
              <div class="bg-primary-600 h-2.5 rounded-full dark:bg-primary-500" style="width: 15%"></div>
            </div>
          </div> -->
          <!-- <div class="flex items-center mb-2">
            <div class="w-16 text-sm font-medium dark:text-white">Calls</div>
            <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
              <div class="bg-primary-600 h-2.5 rounded-full dark:bg-primary-500" style="width: 60%"></div>
            </div>
          </div>
          <div class="flex items-center mb-2">
            <div class="w-16 text-sm font-medium dark:text-white">Visits</div>
            <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
              <div class="bg-primary-600 h-2.5 rounded-full dark:bg-primary-500" style="width: 30%"></div>
            </div>
          </div> -->
        </div>
        <div id="traffic-channels-chart" class="w-full"></div>
      </div>
          
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg   gap-4 mb-4 bg-white dark:bg-gray-800" 
        >
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400
    bg-white dark:bg-gray-800">
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
                <td  class="px-6 py-4 " colspan="3" style="text-align:center">No accounts at the moment</td>
                
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



<div class="relative overflow-x-auto shadow-md sm:rounded-lg   gap-4 mb-4 bg-white dark:bg-gray-800" >
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400" >
        <caption class=" pl-6 pt-3 text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400" style="text-align:left;font-weight:bold;">Recent Deals</caption>
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    ID
                </th>
                <th scope="col" class="px-6 py-3">
                    Product Name
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
                <td  class="px-6 py-4">{{ deal.product.name }}</td>
                <td  class="px-6 py-4">{{ deal.account.name }}</td>
       
            </tr>

            <tr v-if="deals.length==0">
                <td  class="px-6 py-4 " colspan="3" style="text-align:center">No deals at the moment</td>
                
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

<div class="relative overflow-x-auto shadow-md sm:rounded-lg   gap-4 mb-4 bg-white dark:bg-gray-800"
 >
    
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
                <td  class="px-6 py-4 " colspan="3" style="text-align:center">No visits at the moment</td>
                
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
<div class="relative overflow-x-auto shadow-md sm:rounded-lg   gap-4 mb-4 bg-white dark:bg-gray-800" >
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
               ] </td>
                <td class="px-6 py-4">
                    $99
                </td>
                
            </tr> -->
        </tbody>
    </table>
</div>







</div>




    <div class="grid w-full grid-cols-1 gap-4 mt-4 xl:grid-cols-2 2xl:grid-cols-2">

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