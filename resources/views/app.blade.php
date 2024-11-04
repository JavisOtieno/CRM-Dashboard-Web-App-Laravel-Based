<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyALLsNWwOC09xsRAqrK0S7dINi6BpNc7iw"></script>

        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @inertia
    </body>
</html>
{{-- <style>
.dt-search {
    float: right;
}
</style> --}}

{{-- <style>
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
    </style> --}}
