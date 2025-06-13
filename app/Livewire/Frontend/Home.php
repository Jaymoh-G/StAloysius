<?php

namespace App\Livewire\Frontend;


use Livewire\Component;
use App\Models\BlogPost;
use App\Models\EventModel;
use Illuminate\Support\Carbon;
use App\Models\DepartmentModel;

class Home extends Component
{
  // show latest 3 blog posts
  public $latestPosts;
  public $departments;
  public $events;
    protected function limitContent($content, $lines = 3)
    {
        if (empty($content)) {
            return 'Department information coming soon.';
        }

        // Split content into lines
        $contentLines = explode("\n", strip_tags($content));

        // Take only first 3 lines
        $limitedLines = array_slice($contentLines, 0, $lines);

        // Join lines back together
        return implode("\n", $limitedLines);
    }
    public function render()
    {
        $now = Carbon::now();
        $this->latestPosts = BlogPost::latest()->take(3)->get();
        $this->departments = DepartmentModel::all()->map(function ($dept) {
            $dept->content = $this->limitContent($dept->content);
            return $dept;
        });;
        $this->events = EventModel::whereDate('end_date', '>=', $now)
            ->orderBy('start_date', 'desc')->get();
        return view('livewire.frontend.home', [
        'latestPosts' => $this->latestPosts,
          'departments' => $this->departments,
        'events' => $this->events
      ]);
    }
}
