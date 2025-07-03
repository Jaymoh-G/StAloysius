<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\BlogPost;
use App\Models\EventModel;
use App\Models\YoutubeVideo;
use App\Models\Album;
use App\Models\TeamMember;
use App\Models\Testimonial;
use App\Models\JobVacancy;
use App\Models\DepartmentModel;
use App\Models\FacilityModel;
use App\Models\User;
use App\Models\StaticPage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class Index extends Component
{
    public function render()
    {
        // Recent items
        $recentBlogs = BlogPost::latest()->take(3)->get();
        $recentEvents = EventModel::latest()->take(3)->get();
        $recentVideos = YoutubeVideo::latest()->take(3)->get();
        $recentAlbums = Album::latest()->take(3)->get();
        $recentCareers = JobVacancy::latest()->take(3)->get();
        $recentTestimonials = Testimonial::latest()->take(3)->get();
        $today = now()->startOfDay();
        $upcomingEventCount = EventModel::where('start_date', '>=', $today)->count();
        $pastEventCount = EventModel::where('start_date', '<', $today)->count();
        $recentUpcomingEvents = EventModel::where('start_date', '>=', $today)->orderBy('start_date', 'asc')->take(3)->get();
        $recentPastEvents = EventModel::where('start_date', '<', $today)->orderBy('start_date', 'desc')->take(3)->get();
        $recentDepartments = DepartmentModel::latest()->take(3)->get();

        // Trends for last 6 months
        $months = collect(range(0, 5))->map(function ($i) {
            return Carbon::now()->subMonths($i)->format('Y-m');
        })->reverse()->values();

        $trends = [
            'blogs' => $this->getMonthlyCounts(BlogPost::class, $months),
            'events' => $this->getMonthlyCounts(EventModel::class, $months),
            'videos' => $this->getMonthlyCounts(YoutubeVideo::class, $months),
            'albums' => $this->getMonthlyCounts(Album::class, $months),
            'careers' => $this->getMonthlyCounts(JobVacancy::class, $months),
            'departments' => $this->getMonthlyCounts(DepartmentModel::class, $months),
            'facilities' => $this->getMonthlyCounts(FacilityModel::class, $months),
            'users' => $this->getMonthlyCounts(User::class, $months),
            'pages' => $this->getMonthlyCounts(StaticPage::class, $months),
            'testimonials' => $this->getMonthlyCounts(Testimonial::class, $months),
            'labels' => $months->map(function ($m) {
                return Carbon::createFromFormat('Y-m', $m)->format('M Y');
            })->toArray(),
        ];

        return view('livewire.dashboard.index', [
            'blogCount' => BlogPost::count(),
            'eventCount' => EventModel::count(),
            'videoCount' => YoutubeVideo::count(),
            'albumCount' => Album::count(),
            'teamCount' => TeamMember::count(),
            'testimonialCount' => Testimonial::count(),
            'careerCount' => JobVacancy::count(),
            'departmentCount' => DepartmentModel::count(),
            'facilityCount' => FacilityModel::count(),
            'userCount' => User::count(),
            'pageCount' => StaticPage::count(),
            'recentBlogs' => $recentBlogs,
            'recentEvents' => $recentEvents,
            'recentUpcomingEvents' => $recentUpcomingEvents,
            'recentPastEvents' => $recentPastEvents,
            'recentVideos' => $recentVideos,
            'recentAlbums' => $recentAlbums,
            'recentCareers' => $recentCareers,
            'recentDepartments' => $recentDepartments,
            'recentTestimonials' => $recentTestimonials,
            'trends' => $trends,
            'upcomingEventCount' => $upcomingEventCount,
            'pastEventCount' => $pastEventCount,
        ])->layout('components.layouts.dashboard');
    }

    private function getMonthlyCounts($modelClass, $months)
    {
        $table = (new $modelClass)->getTable();
        $raw = DB::table($table)
            ->selectRaw("DATE_FORMAT(created_at, '%Y-%m') as ym, COUNT(*) as count")
            ->where('created_at', '>=', $months->first() . '-01')
            ->groupBy('ym')
            ->pluck('count', 'ym');
        return $months->map(fn($m) => $raw[$m] ?? 0)->toArray();
    }
}
