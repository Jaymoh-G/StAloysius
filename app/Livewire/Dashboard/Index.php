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
use App\Models\Project;
use App\Models\VolunteerApplication;
use App\Models\Donation;
use App\Models\DepartmentModel;
use App\Models\FacilityModel;
use App\Models\User;
use App\Models\StaticPage;
use App\Models\Comment;
use App\Traits\HasModulePermissions;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class Index extends Component
{
    use HasModulePermissions;

    public function render()
    {
        // Recent items - only show if user has permission to view
        $recentBlogs = $this->canView('blog') ? BlogPost::latest()->take(2)->get() : collect();
        $recentEvents = $this->canView('events') ? EventModel::latest()->take(2)->get() : collect();
        $recentVideos = $this->canView('youtube') ? YoutubeVideo::latest()->take(2)->get() : collect();
        $recentAlbums = $this->canView('gallery') ? Album::latest()->take(2)->get() : collect();
        $recentProjects = $this->canView('projects') ? Project::latest()->take(2)->get() : collect();
        $recentVolunteers = $this->canView('volunteer_applications') ? VolunteerApplication::latest()->take(2)->get() : collect();
        $recentDonations = $this->canView('donations') ? Donation::latest()->take(2)->get() : collect();
        $recentTestimonials = $this->canView('testimonials') ? Testimonial::latest()->take(2)->get() : collect();

        $today = now()->startOfDay();
        $upcomingEventCount = $this->canView('events') ? EventModel::where('start_date', '>=', $today)->count() : 0;
        $pastEventCount = $this->canView('events') ? EventModel::where('start_date', '<', $today)->count() : 0;
        $recentUpcomingEvents = $this->canView('events') ? EventModel::where('start_date', '>=', $today)->orderBy('start_date', 'asc')->take(3)->get() : collect();
        $recentPastEvents = $this->canView('events') ? EventModel::where('start_date', '<', $today)->orderBy('start_date', 'desc')->take(3)->get() : collect();
        $recentDepartments = $this->canView('departments') ? DepartmentModel::latest()->take(3)->get() : collect();

        // Trends for last 6 months - only include modules user can view
        $months = collect(range(0, 5))->map(function ($i) {
            return Carbon::now()->subMonths($i)->format('Y-m');
        })->reverse()->values();

        $trends = [
            'labels' => $months->map(function ($m) {
                return Carbon::createFromFormat('Y-m', $m)->format('M Y');
            })->toArray(),
        ];

        // Only add trends for modules user can view
        if ($this->canView('blog')) {
            $trends['blogs'] = $this->getMonthlyCounts(BlogPost::class, $months);
        }
        if ($this->canView('events')) {
            $trends['events'] = $this->getMonthlyCounts(EventModel::class, $months);
        }
        if ($this->canView('youtube')) {
            $trends['videos'] = $this->getMonthlyCounts(YoutubeVideo::class, $months);
        }
        if ($this->canView('gallery')) {
            $trends['albums'] = $this->getMonthlyCounts(Album::class, $months);
        }
        if ($this->canView('projects')) {
            $trends['projects'] = $this->getMonthlyCounts(Project::class, $months);
        }
        if ($this->canView('departments')) {
            $trends['departments'] = $this->getMonthlyCounts(DepartmentModel::class, $months);
        }
        if ($this->canView('facilities')) {
            $trends['facilities'] = $this->getMonthlyCounts(FacilityModel::class, $months);
        }
        if ($this->canView('users')) {
            $trends['users'] = $this->getMonthlyCounts(User::class, $months);
        }
        if ($this->canView('static_pages')) {
            $trends['pages'] = $this->getMonthlyCounts(StaticPage::class, $months);
        }
        if ($this->canView('testimonials')) {
            $trends['testimonials'] = $this->getMonthlyCounts(Testimonial::class, $months);
        }
        if ($this->canView('volunteer_applications')) {
            $trends['volunteers'] = $this->getMonthlyCounts(VolunteerApplication::class, $months);
        }
        if ($this->canView('donations')) {
            $trends['donations'] = $this->getMonthlyCounts(Donation::class, $months);
        }

        // Build chart datasets array
        $chartDatasets = [];

        if ($this->canView('blog') && isset($trends['blogs'])) {
            $chartDatasets[] = [
                'label' => 'News',
                'data' => $trends['blogs'],
                'borderColor' => '#0d6efd',
                'backgroundColor' => 'rgba(13,110,253,0.1)',
                'fill' => true,
                'tension' => 0.4
            ];
        }

        if ($this->canView('events') && isset($trends['events'])) {
            $chartDatasets[] = [
                'label' => 'Events',
                'data' => $trends['events'],
                'borderColor' => '#198754',
                'backgroundColor' => 'rgba(25,135,84,0.1)',
                'fill' => true,
                'tension' => 0.4
            ];
        }

        if ($this->canView('youtube') && isset($trends['videos'])) {
            $chartDatasets[] = [
                'label' => 'Videos',
                'data' => $trends['videos'],
                'borderColor' => '#dc3545',
                'backgroundColor' => 'rgba(220,53,69,0.1)',
                'fill' => true,
                'tension' => 0.4
            ];
        }

        if ($this->canView('gallery') && isset($trends['albums'])) {
            $chartDatasets[] = [
                'label' => 'Albums',
                'data' => $trends['albums'],
                'borderColor' => '#0dcaf0',
                'backgroundColor' => 'rgba(13,202,240,0.1)',
                'fill' => true,
                'tension' => 0.4
            ];
        }

        if ($this->canView('testimonials') && isset($trends['testimonials'])) {
            $chartDatasets[] = [
                'label' => 'Testimonials',
                'data' => $trends['testimonials'],
                'borderColor' => '#adb5bd',
                'backgroundColor' => 'rgba(173,181,189,0.1)',
                'fill' => true,
                'tension' => 0.4
            ];
        }

        return view('livewire.dashboard.index', [
            'blogCount' => $this->canView('blog') ? BlogPost::count() : 0,
            'eventCount' => $this->canView('events') ? EventModel::count() : 0,
            'videoCount' => $this->canView('youtube') ? YoutubeVideo::count() : 0,
            'albumCount' => $this->canView('gallery') ? Album::count() : 0,
            'teamCount' => $this->canView('team') ? TeamMember::count() : 0,
            'testimonialCount' => $this->canView('testimonials') ? Testimonial::count() : 0,
            'projectCount' => $this->canView('projects') ? Project::count() : 0,
            'volunteerCount' => $this->canView('volunteer_applications') ? VolunteerApplication::count() : 0,
            'donationCount' => $this->canView('donations') ? Donation::count() : 0,
            'totalDonationAmount' => $this->canView('donations') ? Donation::sum('amount') : 0,
            'departmentCount' => $this->canView('departments') ? DepartmentModel::count() : 0,
            'facilityCount' => $this->canView('facilities') ? FacilityModel::count() : 0,
            'userCount' => $this->canView('users') ? User::count() : 0,
            'pageCount' => $this->canView('static_pages') ? StaticPage::count() : 0,
            'recentBlogs' => $recentBlogs,
            'recentEvents' => $recentEvents,
            'recentUpcomingEvents' => $recentUpcomingEvents,
            'recentPastEvents' => $recentPastEvents,
            'recentVideos' => $recentVideos,
            'recentAlbums' => $recentAlbums,
            'recentProjects' => $recentProjects,
            'recentVolunteers' => $recentVolunteers,
            'recentDonations' => $recentDonations,
            'recentDepartments' => $recentDepartments,
            'recentTestimonials' => $recentTestimonials,
            'trends' => $trends,
            'chartDatasets' => $chartDatasets,
            'upcomingEventCount' => $upcomingEventCount,
            'pastEventCount' => $pastEventCount,
            'pendingCommentsCount' => $this->canView('blog') ? Comment::where('is_approved', false)->count() : 0,
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
