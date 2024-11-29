<?php

namespace App\Http\Controllers;

use App\Models\Deal;
use App\Models\Lead;
use Inertia\Inertia;
use App\Models\Visit;
use App\Models\Account;
use App\Models\Contact;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index()
    {
        // $deals = Deal::all();
        // $deals = Deal::orderBy('id', 'desc')->take(5)->get();
        $deals = Deal::with('account')->orderBy('id', 'desc')->take(5)->get();
        $accounts = Account::orderBy('id', 'desc')->take(5)->get();

        // return $accounts;
        // return Inertia::render('Index',['deals' => $deals]);
        return Inertia::render('Dashboard', compact('deals', 'accounts'));
    }

    public function newindex()
    {
        // $deals = Deal::all();
        // $deals = Deal::orderBy('id', 'desc')->take(5)->get();
        $deals = Deal::with('account')->orderBy('id', 'desc')->take(5)->get();
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
        }
                //get months Jan Feb Mar...Dec
                for ($i = 0; $i <= 11; $i++) {
                    $months[] = date("M", strtotime( date( 'Y-m-01' )." -$i months"));
                    }
            $months=array_reverse($months);

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
            'percentageChange'
        ));
    }
}
