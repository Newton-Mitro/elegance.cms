<?php

namespace App\Http\Controllers;

use App\Infrastructure\Models\Career;
use App\Infrastructure\Models\Contact;
use App\Infrastructure\Models\ContactMessage;
use App\Infrastructure\Models\JobApplication;
use App\Infrastructure\Models\Media;
use App\Infrastructure\Models\Notice;
use App\Infrastructure\Models\Page;
use App\Infrastructure\Models\Project;
use App\Infrastructure\Models\RouteVisitLog;
use App\Infrastructure\Models\Student;
use App\Infrastructure\Models\Product;
use App\Infrastructure\Models\Service;
use App\Infrastructure\Models\Event;
use App\Infrastructure\Models\User;
use App\Infrastructure\Models\Visitor;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        // Top KPIs
        $stats = [
            'users' => User::count(),
            'pages' => Page::count(),
            'products' => Product::count(),
            'orders' => Product::count(),
            'payments' => Product::count(),
            'services' => Service::count(),
            'appointments' => Service::count(),
            'officeLocations' => Contact::count(),
            'teams' => Event::count(),
            'jobCirculars' => Career::count(),
            'students' => Student::count(),
            'projects' => Project::count(),
        ];

        // ------------------------
        // Monthly Visitors (last 6 months)
        // ------------------------
        $startDate = now()->startOfMonth()->subMonths(5);

        $visitorCounts = Visitor::where('created_at', '>=', $startDate)
            ->get()
            ->groupBy(function ($visitor) {
                return $visitor->created_at->format('Y-m'); // group by year-month
            })
            ->map->count();

        // Fill empty months with 0
        $monthlyVisitors = collect();
        for ($i = 0; $i < 6; $i++) {
            $month = now()->startOfMonth()->subMonths(5 - $i);
            $key = $month->format('Y-m');
            $monthlyVisitors[$month->format('M')] = $visitorCounts->get($key, 0);
        }

        // ------------------------
        // Route Visits (Top 16)
        // ------------------------
        $routeVisits = RouteVisitLog::selectRaw('route, COUNT(*) as total')
            ->groupBy('route')
            ->orderByDesc('total')
            ->limit(16)
            ->pluck('total', 'route');

        // ------------------------
        // Latest Blogs
        // ------------------------
        $latestNotices = Notice::latest()->take(7)->get(['id', 'title', 'created_at']);

        // ------------------------
        // Job Applications
        // ------------------------
        $applications = JobApplication::latest()->take(3)->get(['id', 'name', 'position']);

        // ------------------------
        // Recent Media
        // ------------------------
        $media = Media::latest()->take(6)->get();

        return Inertia::render('dashboard', [
            'stats' => $stats,
            'monthlyVisitors' => $monthlyVisitors,
            'routeVisits' => $routeVisits,
            'latestNotices' => $latestNotices,
            'applications' => $applications,
            'media' => $media,
        ]);
    }
}
