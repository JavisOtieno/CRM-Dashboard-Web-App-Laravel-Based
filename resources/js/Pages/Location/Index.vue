<script setup>
import { DataTable } from "simple-datatables";
import { Link } from '@inertiajs/vue3';
import { onMounted, onBeforeUnmount, ref, computed, toRefs } from 'vue'
import { useForm } from '@inertiajs/vue3'
import { usePage } from '@inertiajs/vue3'
import TableWrapper from '@/Pages/TableWrapper.vue';
// import MapComponent from '@/Pages/MapComponent.vue';
import { 
    initAccordions, 
    initCarousels, 
    initCollapses, 
    initDials, 
    initDismisses, 
    initDrawers, 
    initDropdowns, 
    initModals, 
    Modal,
    initPopovers, 
    initTabs, 
    initTooltips } from 'flowbite'

import { useUserStore } from '../../store/user';
const userStore = useUserStore();
const user = userStore.user;

const form = useForm({});
const imageUrl = '/images/logo-dark.png';




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

      // Check if mapRef is not null before calling initMap
  if (mapRef.value) {
    initMap();
  } else {
    console.error("mapRef is null");
  }

    const tableElement = document.getElementById("search-table");
  if (tableElement && typeof DataTable !== "undefined") {
    dataTable = new DataTable(tableElement, {
      searchable: true,
      sortable: false,
      order: [[0, 'desc']],
      ordering: true, 
    });
  }
})

const selectedLocation = ref(null);
const locationLat = ref(0);
const locationLong = ref(0);

function openModal(location) {
  updateMap(location);
    // alert(account.id)

  selectedLocation.value = location.id; // Set the selected product data
//   isModalVisible.value = true; // Show the modal
locationLat.value = location.lat; // Set dynamic latitude
locationLong.value = location.lng; // Set dynamic longitude

// alert(locationLat.value);
}

const mapLocation = computed(() => {
  return { lat: locationLat.value, lng: locationLong.value };
});




let dataTable;

// onMounted(() => {

// });

onBeforeUnmount(() => {
  if (dataTable) {
    dataTable.destroy();
    dataTable = null;
  }
});

const props = defineProps({
  locations: {
    type: Array,
    default: () => [],
  },
  apiKey: String, // Google Maps API key
  location: {
    type: Object,
    default: () => ({ lat: 37.7749, lng: -122.4194 }), // Default location
  },
  
});


const deleteLocation = () => {
    // alert(selectedLocation.value);
//   if (confirm('Are you sure you want to delete this location?')) {
    form.delete(`/deletelocation/${selectedLocation.value}`, {
      onSuccess: () => {
        // alert('Location deleted successfully!');
        // window.location.reload(); // Reload the page on success
      },
      onError: (errors) => {
            // Handle errors here
            // You can customize the error message as per your needs
            const errorMessages = Object.values(errors).flat().join(', ');
            alert(`Error(s): ${errorMessages}`);
        },
    //   preserveState: true,] 
    });
//   }
};


if (document.getElementById("search-table") && typeof simpleDatatables.DataTable !== 'undefined') {
    const dataTable = new simpleDatatables.DataTable("#search-table", {
        searchable: true,
        sortable: true,
        order: [[0, 'desc']],
        ordering: true, 
    });
}


// Reactive reference for the map
const mapRef = ref(null);

const { location } = toRefs(props);
const map = ref(null); // Reference to the Google Maps instance

// Initial location for demonstration
const newLocation = { lat: -1.3, lng: 36.8 };
 // Example: Los Angeles



function initMap() {
  const location2 = { lat: Number(location.value.lat), lng: Number(location.value.lng) };

  // Create the map
  map.value = new google.maps.Map(mapRef.value, {
    zoom: 10,
    center: location2,
  });

  

  // alert(location.value.lat + " L " + location.value.lng);
  // alert(location2.lat + " - " + location2.lng);

  // Create a marker
  new google.maps.Marker({
    position: location2,
    map: map,
    title: 'Hello San Francisco!', // Optional title
  });
}

function updateMap(newLocation2) {
  // alert("test");
  console.log("newLocation");
  console.log(newLocation2);
  console.log("newLocation");

  const location2 = { lat: Number(newLocation2.lat), lng: Number(newLocation2.long) };

  // alert(newLocation2.lat + " - " + newLocation2.long);

  if (map.value) {
    // Update the map's center to the new location
    map.value.setCenter(location2);

    // Optionally, create or move a marker to the new location
    new google.maps.Marker({
      position: location2,
      map: map.value,
      title: 'Updated Location',
    });

    // alert(`Map updated to: ${newLocation2.lat}, ${newLocation2.lng}`);
  } else {
    // alert('not initialized');
    console.error("Map is not initialized");
  }

}

    // Access the flash message from the Inertia props
    const page = usePage();
    const flash = computed(() => page.props.flash || null);


</script>
<template>


<TableWrapper :flash="flash">

        <h3 class="text-3xl font-bold dark:text-white mb-4">Locations</h3>
        

        <div class="flex items-center justify-center  mb-4 rounded">

           <!-- <p class="text-2xl text-gray-400 dark:text-gray-500">
              <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                 <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
              </svg>
           </p> -->
           <div class="container mx-auto mt-5">
        <!-- Add User button aligned to the right -->
        <div class="flex justify-between mb-4">
        <div  class="text-lg dark:text-white font-semibold">Locations Table</div>
        
        
        
             <Link :href="route('addnewlocation')"  as="button"  class="bg-primary-600 text-white w-1/3 px-4 py-2 
            rounded hover:bg-primary-700">
                Add Location

        </Link>
        
        </div>
           


           
<table id="search-table" class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
    <thead class="bg-gray-100 dark:bg-gray-800">
        <tr>
             <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">

                <span class="flex items-center">
                    ID
                </span>
            </th>
            <th  v-if="user.usertype === 'admin'">
                <span class="flex items-center">
                    Seller
                </span>
            </th>
             <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">

                <span class="flex items-center">
                    Location Name
                </span>
            </th>
             <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">

                <span class="flex items-center">
                 Latitude
                </span>
            </th>
             <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">

                <span class="flex items-center">
                 Longitude
                </span>
            </th>
             <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">

                <span class="flex items-center">
                    Account
                </span>
            </th>
             <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
<span class="flex items-center">Actions</span></th>
        </tr>
    </thead>
    <tbody>
        <tr class="font-medium text-gray-900 whitespace-nowrap dark:text-white"
        v-for="(location, index) in locations" :key="index">
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                    {{ location.id }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300" v-if="user.usertype === 'admin'">{{ location.user.name }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">{{ location.name }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">{{ location.lat }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">{{ location.long }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">{{ location.account.name }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">
                <div class="flex space-x-2">
                    <a :href="`/editlocation/${location.id}`" class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-blue-500 rounded-md hover:bg-blue-600">
                        Edit
                    </a>
                    <a :href="`/deletelocation/${location.id}`" class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-red-500 rounded-md hover:bg-red-600">
                        Delete
                    </a>
                </div>
            </td>
        </tr>
        
    </tbody>
</table>

</div>


        </div>
      
     </TableWrapper>
  


<div id="popup-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-4 md:p-5 text-center">
                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this location?</h3>
                <button @click="deleteLocation()" data-modal-hide="popup-modal" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                    Yes, I'm sure
                </button>
                <button data-modal-hide="popup-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No, cancel</button>
            </div>
        </div>
    </div>
</div>

<div id="map-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="map-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-4 md:p-5 text-center">
                
               
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Location Map</h3>

  <div>
    <div ref="mapRef" style="height: 300px; width: 100%;"></div>
  </div>

           </div>
        </div>
    </div>
</div>

</template>