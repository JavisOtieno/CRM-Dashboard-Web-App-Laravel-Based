<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Deal;
use App\Models\Lead;
use App\Models\User;
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
        $accounts = Account::where('status','account')->orderBy('id', 'desc')->take(5)->get();

        // return $accounts;
        // return Inertia::render('Index',['deals' => $deals]);
        return Inertia::render('Dashboard', compact('deals', 'accounts'));
    }

    public function newindex()
    {
        // $deals = Deal::all();
        // $deals = Deal::orderBy('id', 'desc')->take(5)->get();

        $auth = [
            'user' => auth()->user(),
        ];



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

        $leadsLast7Days =  Account::where('status','lead')
        ->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as count'))
        ->whereBetween('created_at', [Carbon::now()->subDays(6)->startOfDay(), Carbon::now()->endOfDay()])
        ->groupBy('date')
        ->orderBy('date', 'asc')
        ->get()
        ->map(function ($lead) {
            // Format the day of the week as short (Mon, Tue, etc.)
            $dayOfWeek = Carbon::parse($lead->date)->format('D');
            return [
                'x' => $dayOfWeek,
                'y' => $lead->count ?? 0,
            ];
        })
        ->values()
        ->toArray();

        // return $leadsLast7Days;
        // Add missing days of the week with a count of 0
        $allDays = collect(range(0, 6))->map(function ($i) {
            return Carbon::now()->subDays(6 - $i)->format('D');
        });

        $leadsLast7Days = $allDays->map(function ($day) use ($leadsLast7Days) {
            $lead = collect($leadsLast7Days)->firstWhere('x', $day);
            return [
                'x' => $day,
                'y' => $lead['y'] ?? 0,
            ];
        })->toArray();
        
        

        $accountsLeadsLast7Days = Account::where('status','account')
        ->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as count'))
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


        $allDays = collect(range(0, 6))->map(function ($i) {
            return Carbon::now()->subDays(6 - $i)->format('D');
        });

        $accountsLeadsLast7Days = $allDays->map(function ($day) use ($accountsLeadsLast7Days) {
            $lead = collect($accountsLeadsLast7Days)->firstWhere('x', $day);
            return [
                'x' => $day,
                'y' => $lead['y'] ?? 0,
            ];
        })->toArray();

        // return $accountsLeadsLast7Days;

        $accountsLast7Days = Account::where('status','account')
        ->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as count'))
        ->whereBetween('created_at', [Carbon::now()->subDays(6)->startOfDay(), Carbon::now()->endOfDay()])
        ->groupBy('date')
        ->orderBy('date', 'asc')
        ->get()
        ->pluck('count')
        ->toArray();
        // Add missing days of the week with a count of 0


        if ($dealsLastWeek == 0) {
            $percentageChangeDeals = $dealsThisWeek > 0 ? 100 : 0; // Avoid division by zero
        } else {
            $percentageChangeDeals = (($dealsThisWeek - $dealsLastWeek) / $dealsLastWeek) * 100;
        }
        $percentageChangeDeals = round($percentageChangeDeals, 2);

        $deals = Deal::with('account','product')->orderBy('id', 'desc')->take(5)->get();
        $accounts = Account::where('status','account')->orderBy('id', 'desc')->take(5)->get();
        $visits = Visit::with('account', 'location')->take(5)->get();
        $contacts = Contact::with('account')->take(5)->get();
        $dealsCount = Deal::count();
        $accountsCount = Account::where('status','account')->count();
        $leadsCount = Account::where('status','lead')->count();
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


        // Fetch deal counts
        $currentMonthLeads = Account::where('status','lead')->whereBetween('created_at', [$currentMonthStart, $currentMonthEnd])->count();

        $lastMonthLeads = Account::where('status','lead')->whereBetween('created_at', [$lastMonthStart, $lastMonthEnd])->count();

        // Calculate percentage change
        if ($lastMonthLeads == 0) {
            $percentageChangeLeads = $currentMonthLeads > 0 ? 100 : 0; // Avoid division by zero
        } else {
            $percentageChangeLeads = (($currentMonthLeads - $lastMonthLeads) / $lastMonthLeads) * 100;
            $percentageChangeLeads = round($percentageChangeLeads, 2);
        }
                //get months Jan Feb Mar...Dec
                for ($i = 0; $i <= 11; $i++) {
                    $months[] = date("M", strtotime( date( 'Y-m-01' )." -$i months"));
                    }
            $months=array_reverse($months);


        $accountsThisMonth = Account::where('status','account')->whereMonth('created_at', now()->month)  // Filter by current month
        ->whereYear('created_at', now()->year)    // Filter by current year
        ->count();

        $leadsThisMonth =  Account::where('status','lead')->whereMonth('created_at', now()->month)  // Filter by current month
        ->whereYear('created_at', now()->year)    // Filter by current year
        ->count();

        $leadsThisWeek = Account::where('status', 'lead')
        ->whereBetween('created_at', [Carbon::now()->subWeek(), Carbon::now()]) // From this time last week to now
        ->count();
       

        if($leadsThisMonth==0){
            $conversionRate=0;
        }else{
            $conversionRate = $accountsThisMonth/$leadsThisMonth*100;
            $conversionRate = round($conversionRate, 2);
        }

        $numberOfSellers = User::where('usertype', 'seller')->count();
      
        $productTargets = Product::select('id', 'name', 'target_amount')
        // ->withCount('sellers') // Assuming you have a relationship called 'sellers' in the Product model
        //scope limits depending on user
        ->withCount(['deals' => function ($query) {
            $query->whereMonth('created_at', now()->month)  // Filter by current month
                ->whereYear('created_at', now()->year);   // Filter by current year
        }])
        ->withSum(['deals as total_amount' => function ($query) {
            $query->whereMonth('created_at', now()->month)  // Filter by current month
                ->whereYear('created_at', now()->year);   // Filter by current year
        }], 'amount') // Sum the 'amount' field for each product
        ->get()
        ->map(function ($product) use ($numberOfSellers) {
            // Calculate the percentage of amount achieved compared to the target amount
            if(auth()->user()->usertype=='seller'){
                if ($product->target_amount > 0) {
                    $product->percentage_achieved = ($product->total_amount / $product->target_amount) * 100;  
                } else {
                    $product->percentage_achieved = 0;
                }
            }else{
                // Multiply target_amount by the number of sellers
                $adjustedTargetAmount = $product->target_amount * $numberOfSellers;
                // Calculate the percentage of amount achieved compared to the adjusted target amount
                if ($adjustedTargetAmount > 0) {
                    $product->percentage_achieved = ($product->total_amount / $adjustedTargetAmount) * 100;
                } else {
                    $product->percentage_achieved = 0;
                }
            }




            return $product;
        })
        ->sortByDesc(function ($product) {
            return $product->percentage_achieved;
        }) // Sort by percentage_achieved in descending order // Sort by the calculated percentage in descending order
        ->take(4)
        ->values(); // Get the top 4 products
        // $productTargets = array_values($productTargets);

        return $productTargets;

        

        $productData = Product::select('id', 'name') // Select the product ID and name
        ->withCount(['deals' => function ($query) {
            $query->whereMonth('created_at', now()->month)  // Filter by current month
                ->whereYear('created_at', now()->year);   // Filter by current year
        }])
        ->get();

        // Filter out products with zero deal count
        $productData = $productData->filter(function ($product) {
            return $product->deals_count > 0;
        });

        // Get product names and deals count separately
        $productNamesPieChart = $productData->pluck('name')->toArray();  // Array of product names
        $totalSoldPieChart = $productData->pluck('deals_count')->toArray();  // Array of total deals for each product

        $baseColors = ["#C71A20", "#6C5FFC", "#05C3FB", "#09AD95",'#DA70D6','#FFBF00',
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
            'percentageChangeLeads',
            'percentageChangeDeals',
            'dealsLast7Days',
            'leadsLast7Days',
            'accountsLast7Days',
            'accountsThisMonth',
            'leadsThisWeek',
            'leadsThisMonth',
            'conversionRate',
            'accountsLeadsLast7Days',
            'productNamesPieChart',
            'totalSoldPieChart',
            'palettePieChart',
            'productTargets',
            'auth'

        ));
    }
}
