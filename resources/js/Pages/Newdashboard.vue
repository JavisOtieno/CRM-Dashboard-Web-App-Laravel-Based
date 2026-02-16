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
  leadsThisWeek: {
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

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">

            <div class=" w-full bg-white rounded-lg shadow dark:bg-gray-800">
  <div class="flex justify-between p-4 md:p-6 pb-0 ">
    <div class="mx-auto">
      <h5 class="text-center leading-none text-3xl font-bold text-gray-900 dark:text-white pb-2">{{ dealsCount }}</h5>
      <p class="text-center font-normal text-gray-500 dark:text-gray-400">Total Payments</p>
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

<!-- <div class=" w-full bg-white rounded-lg shadow dark:bg-gray-800">
  <div class="flex justify-between p-4 md:p-6 pb-0 ">
    <div class="mx-auto">
      <h5 class="text-center leading-none text-3xl font-bold text-gray-900 dark:text-white pb-2">{{ leadsCount }}</h5>
      <p class="text-center font-normal text-gray-500 dark:text-gray-400">Total Leads</p>
    </div>
   
  </div>

</div> -->

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

<!-- <div class=" w-full bg-white rounded-lg shadow dark:bg-gray-800">
  <div class="flex justify-between p-4 md:p-6 pb-0 md:pb-0">
    <div class="mx-auto">
      <h5 class="text-center leading-none text-3xl font-bold text-gray-900 dark:text-white pb-2">{{ contactsCount }}</h5>
      <p class="text-center font-normal text-gray-500 dark:text-gray-400">Total Contacts</p>
    </div>

  </div>

</div> -->










           


                

           
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
      <p class="text-base font-normal text-gray-500 dark:text-gray-400">Payments</p>
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
        Payments
        <svg class="w-2.5 h-2.5 ms-1.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
        </svg>
      </Link>
    </div>
  </div>
</div>

        <div class="grid grid-cols-1 md:grid-cols-1 gap-4 mb-4">




<div class=" w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">




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
  
          




<div class="w-full relative overflow-x-auto shadow-md sm:rounded-lg   gap-4 mb-4 bg-white dark:bg-gray-800" >
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400" >
        <caption class=" pl-6 pt-3 text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400" style="text-align:left;font-weight:bold;">Recent Payments</caption>
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    ID
                </th>
                <th scope="col" class="px-6 py-3">
                    Payment Option
                </th>
                <th scope="col" class="px-6 py-3">
                    Merchant Account
                </th>
                <th scope="col" class="px-6 py-3">
                    Amount
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
                <td  class="px-6 py-4">{{ deal.amount }}</td>
       
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
     
</div> </div> </div>  </template>