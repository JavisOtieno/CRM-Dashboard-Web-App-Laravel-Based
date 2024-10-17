<template>
    <div>
      <slot></slot>
    </div>
  </template>
  
  <script setup>
  // You can import your common styles or scripts here
  import 'datatables.net';
  import 'datatables.net-vue3';
  import { onMounted, ref } from 'vue';
  import $ from 'jquery';
  // import any global styles here

  
  onMounted(() => {
  // Ensure jQuery is loaded to avoid issues
  if (typeof $ === 'undefined') {
    throw new Error('jQuery is required for DataTables');
    
  }

  const table = $('#dataTable').DataTable();

// Add input elements to the footer for column search
var index=0;
$('#dataTable thead th').each(function (index) {
  if (index < $('#dataTable thead th').length - 1) {
  const title = $(this).text();
  $(this).html(`${title}<br/><input type="text" placeholder="Search ${title}"  style="color: black;" />`);
  }
  // index++;
  
});

// Attach event listeners to the footer inputs for column-wise search
table.columns().every(function () {
  const column = this;
  $('input', this.header()).on('keyup change clear', function () {
    if (column.search() !== this.value) {
      column.search(this.value).draw();
    }
  });
  
});

});

// Initialize DataTable with column search inputs
const onInitComplete = () => {
  // alert("we get here");


};

  </script>
  
  <style scoped>
  .styled-table {
      width: 100%;
      border-collapse: collapse; /* Ensures borders are collapsed */
  }
  
  .styled-table th,
  .styled-table td {
      /*padding: 12px;  Space around text */
      padding-left: 12px; /* Space around text */
      padding-right: 12px;
      padding-top: 3px;
      padding-bottom: 3px;
      text-align: left; /* Align text to the left */
      border: 1px solid #dddddd; /* Light gray border */
  }
  
  .styled-table th {
      background-color: #4CAF50; /* Green background for header */
      color: white; /* White text color */
  }
  
  .styled-table tr:nth-child(even) {
      background-color: #f2f2f2; /* Light gray for even rows */
  }
  /* Move the search box to the right */
  .dt-search {
      float: right; /* Aligns the search bar to the right */
      margin-bottom: 10px;
  }
  .dt-length{
    margin-top: 10px;
  }
  #addbutton{
    float: right;
    border-radius: 12px;
  }
  
  .dt-search input {
      margin-left: 10px; /* Aligns the search bar to the right */
  }
  
  .styled-table tr:hover {
      background-color: #ddd; /* Darker gray on hover */
  }
  
  .styled-table td {
      font-size: 14px; /* Font size for table cells */
      color: #333; /* Text color */
  }
  
  .styled-table th {
      font-size: 16px; /* Font size for header */
      font-weight: bold; /* Bold header text */
  }
  </style>
  
  