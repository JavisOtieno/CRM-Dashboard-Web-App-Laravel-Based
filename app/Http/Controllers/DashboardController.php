<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Deal;
use App\Models\Lead;
use Inertia\Inertia;
use App\Models\Visit;
use App\Models\Account;
use App\Models\Contact;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //
    public function index()
    {
        // $deals = Deal::all();
        // $deals = Deal::orderBy('id', 'desc')->take(5)->get();
        $deals = Deal::with('account','product')->orderBy('id', 'desc')->take(5)->get();
        $accounts = Account::orderBy('id', 'desc')->take(5)->get();

        // return $accounts;
        // return Inertia::render('Index',['deals' => $deals]);
        return Inertia::render('Dashboard', compact('deals', 'accounts'));
    }

    public function newindex()
    {
        // $deals = Deal::all();
        // $deals = Deal::orderBy('id', 'desc')->take(5)->get();



        $dealsThisWeek = Deal::with('account', 'product')
        ->whereBetween('created_at', [
            Carbon::now()->subDays(6)->startOfDay(), // Start of 7 days ago
            Carbon::now()->endOfDay()               // End of today
        ])
        ->orderBy('created_at', 'desc') // Optional: Order by newest first
        ->count();


        $dealsLastWeek =  Deal::with('account', 'product')
        ->whereBetween('created_at', [
            Carbon::now()->subDays(14)->startOfDay(), // Start of 14 days ago
            Carbon::now()->subDays(7)->endOfDay()     // End of 7 days ago
        ])
        ->orderBy('created_at', 'desc') // Optional: order by newest first
        ->count();

        // $dealsLast7Days = Deal::select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as count'))
        // ->whereBetween('created_at', [Carbon::now()->subDays(6)->startOfDay(), Carbon::now()->endOfDay()])
        // ->groupBy('date')
        // ->orderBy('date', 'asc')
        // ->get()
        // ->pluck('count')
        // ->toArray();

        $dealsLast7Days = Deal::select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as count'))
    ->whereBetween('created_at', [
        Carbon::now()->subDays(6)->startOfDay(), // Start of 7 days ago
        Carbon::now()->endOfDay(),               // End of today
    ])
    ->groupBy(DB::raw('DATE(created_at)')) // Group by date
    ->orderBy('date', 'asc')
    ->get()
    ->pluck('count')
    ->toArray();

 
    
    $dates = collect();
    for ($i = 6; $i >= 0; $i--) {
        $dates->push(Carbon::now()->subDays($i)->toDateString());
    }
    
    $dealsLast7Days = Deal::select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as count'))
        ->whereBetween('created_at', [
            Carbon::now()->subDays(6)->startOfDay(),
            Carbon::now()->endOfDay(),
        ])
        ->groupBy(DB::raw('DATE(created_at)'))
        ->orderBy('date', 'asc')
        ->get()
        ->pluck('count', 'date')
        ->toArray();
    
    // Fill in missing dates with zero count and return as a simple array
    $dealsLast7Days = $dates->map(function ($date) use ($dealsLast7Days) {
        return $dealsLast7Days[$date] ?? 0;
    })->toArray();
    
    // return $dealsLast7Days;

        $leadsLast7Days = Lead::select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as count'))
        ->whereBetween('created_at', [Carbon::now()->subDays(6)->startOfDay(), Carbon::now()->endOfDay()])
        ->groupBy('date')
        ->orderBy('date', 'asc')
        ->get()
        ->map(function ($lead) {
            // Format the day of the week as short (Mon, Tue, etc.)
            $dayOfWeek = Carbon::parse($lead->date)->format('D');
            return [
                'x' => $dayOfWeek,
                'y' => $lead->count,
            ];
        })
        ->values()
        ->toArray();

        $accountsLeadsLast7Days = Account::select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as count'))
        ->whereBetween('created_at', [Carbon::now()->subDays(6)->startOfDay(), Carbon::now()->endOfDay()])
        ->groupBy('date')
        ->orderBy('date', 'asc')
        ->get()
        ->map(function ($lead) {
            // Format the day of the week as short (Mon, Tue, etc.)
            $dayOfWeek = Carbon::parse($lead->date)->format('D');
            return [
                'x' => $dayOfWeek,
                'y' => $lead->count,
            ];
        })
        ->values()
        ->toArray();

        $accountsLast7Days = Account::select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as count'))
        ->whereBetween('created_at', [Carbon::now()->subDays(6)->startOfDay(), Carbon::now()->endOfDay()])
        ->groupBy('date')
        ->orderBy('date', 'asc')
        ->get()
        ->pluck('count')
        ->toArray();

        if ($dealsLastWeek == 0) {
            $percentageChangeDeals = $dealsThisWeek > 0 ? 100 : 0; // Avoid division by zero
        } else {
            $percentageChangeDeals = (($dealsThisWeek - $dealsLastWeek) / $dealsLastWeek) * 100;
        }
        $percentageChangeDeals = round($percentageChangeDeals, 2);

        $deals = Deal::with('account','product')->orderBy('id', 'desc')->take(5)->get();
        $accounts = Account::orderBy('id', 'desc')->take(5)->get();
        $visits = Visit::with('account', 'location')->take(5)->get();
        $contacts = Contact::with('account')->take(5)->get();
        $dealsCount = Deal::count();
        $accountsCount = Account::count();
        $leadsCount = Lead::count();
        $contactsCount = Contact::count();
        $dealsPerMonth = array();
        // for ($i = 0; $i <= 11; $i++) {
        //     $dealsPerMonth[$i] = Deal::whereMonth(
        //         'created_at',
        //         date('m', strtotime('-' . $i . ' month'))
        //     )->count();
        // }
        for ($i = 0; $i <= 11; $i++) {
            // Calculate the month to query for, starting from current month and going back up to 11 months before
            $month = now()->subMonths($i)->month; // Use Carbon's subMonths() to go back
            $dealsPerMonth[$i] = Deal::whereMonth('created_at', $month)->count();
        }
        $dealsPerMonth=array_reverse($dealsPerMonth);
        // $dealsPerMonth[$i] = Deal::whereMonth(
        //     'created_at',
        //     date('m', strtotime('-' . $i . ' month'))
        // )->count();

        // Get the current date, month, and year
        $currentDate = now()->day;
        $currentMonth = now()->month;
        $currentYear = now()->year;

        // Get the last month and year
        $lastMonth = now()->subMonth()->month;
        $lastMonthYear = now()->subMonth()->year;

        // Define date ranges
        $currentMonthStart = now()->startOfMonth();
        $currentMonthEnd = now()->startOfMonth()->addDays($currentDate - 1);

        $lastMonthStart = now()->subMonth()->startOfMonth();
        $lastMonthEnd = now()->subMonth()->startOfMonth()->addDays($currentDate - 1);

        // Fetch deal counts
        $currentMonthDeals = Deal::whereBetween('created_at', [$currentMonthStart, $currentMonthEnd])->count();

        $lastMonthDeals = Deal::whereBetween('created_at', [$lastMonthStart, $lastMonthEnd])->count();

        // Calculate percentage change
        if ($lastMonthDeals == 0) {
            $percentageChange = $currentMonthDeals > 0 ? 100 : 0; // Avoid division by zero
        } else {
            $percentageChange = (($currentMonthDeals - $lastMonthDeals) / $lastMonthDeals) * 100;
            $percentageChange = round($percentageChange, 2);
        }
                //get months Jan Feb Mar...Dec
                for ($i = 0; $i <= 11; $i++) {
                    $months[] = date("M", strtotime( date( 'Y-m-01' )." -$i months"));
                    }
            $months=array_reverse($months);


        $accountsThisMonth = Account::whereMonth('created_at', now()->month)  // Filter by current month
        ->whereYear('created_at', now()->year)    // Filter by current year
        ->count();

        $leadsThisMonth = Lead::whereMonth('created_at', now()->month)  // Filter by current month
        ->whereYear('created_at', now()->year)    // Filter by current year
        ->count();
       

        if($leadsThisMonth==0){
            $conversionRate=0;
        }else{
            $conversionRate = $accountsThisMonth/$leadsThisMonth*100;
            $conversionRate = round($conversionRate, 2);
        }
        

        $productData = Product::select('id', 'name') // Select the product ID and name
        ->withCount(['deals' => function ($query) {
            $query->whereMonth('created_at', now()->month)  // Filter by current month
                ->whereYear('created_at', now()->year);   // Filter by current year
        }])
        ->get();

        // Get product names and deals count separately
        $productNamesPieChart = $productData->pluck('name')->toArray();  // Array of product names
        $totalSoldPieChart = $productData->pluck('deals_count')->toArray();  // Array of total deals for each product

        $baseColors = ["#C71A20", "#6C5FFC", "#05C3FB", "#09AD95",'#FDFD96','#DA70D6','#FFBF00',
        '#89CFF0', '#9ACD32','#964B00'];

        // Number of products
        $numProducts =count($productNamesPieChart);  // Replace this with the actual number of products

        // Generate the palette based on the number of products
        $palettePieChart = [];
        $baseColorCount = count($baseColors);

        // If there are fewer base colors than products, cycle through the base colors
        for ($i = 0; $i < $numProducts; $i++) {
            $palettePieChart[] = $baseColors[$i % $baseColorCount];
        }

        // $productNamesPieChart = $productsSoldThisMonth->pluck('name')->toArray();
        // $totalSoldPieChart = $productsSoldThisMonth->pluck('total_sold')->toArray();


        // return $lastMonthDeals." ".$currentMonthDeals." ".$percentageChange;

        // return $dealsCount;
        // return count($months);
        // return count($dealsPerMonth);

        // return $accounts;
        // return Inertia::render('Index',['deals' => $deals]);
        return Inertia::render('Newdashboard', compact(
            'deals',
            'accounts',
            'visits',
            'contacts',
            'dealsCount',
            'accountsCount',
            'leadsCount',
            'contactsCount',
            'dealsPerMonth',
            'months',
            'percentageChange',
            'dealsThisWeek',
            'percentageChangeDeals',
            'dealsLast7Days',
            'leadsLast7Days',
            'accountsLast7Days',
            'accountsThisMonth',
            'leadsThisMonth',
            'conversionRate',
            'accountsLeadsLast7Days',
            'productNamesPieChart',
            'totalSoldPieChart',
            'palettePieChart'

        ));
    }
}
