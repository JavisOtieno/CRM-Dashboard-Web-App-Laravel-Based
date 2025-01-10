<template>
    <div>
      <!-- <h1>Map</h1> -->
      <div ref="map" style="height: 500px; width:98%;margin: 1%;"></div>
    </div>
  </template>
  
  <script>
  export default {
    props: {
    apiKey: String,          // Google Maps API key
    location: {
      type: Object,
      default: () => ({ lat: 37.7749, lng: -122.4194 }), // Default location
    },
  },
    mounted() {
      this.initMap();
    },
    methods: {
      initMap() {
        // Specify the location (latitude and longitude)
        // const location2 = { lat: 37.7749, lng: -122.4194 }; // Example: San Francisco
        const location2 = { lat: Number(this.location.lat), lng: Number(this.location.long) };
        // alert(this.location.lat);
        // alert(this.location.long);
  
        // Create the map
        const map = new google.maps.Map(this.$refs.map, {
          zoom: 10,
          center: location2,
        });

        // alert(this.location.lat+" L "+this.location.lng);
        // alert(location2.lat+" - "+location2.lng);

        
  
        // Create a marker
        new google.maps.Marker({
          position: location2,
          map: map,
          title: 'Hello San Francisco!', // Optional title
        });
      },
    },
  };
  </script>
  
  <style scoped>
  /* Optional styling */
  </style>
  