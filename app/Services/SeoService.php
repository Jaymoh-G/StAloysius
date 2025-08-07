<?php

namespace App\Services;

use App\Models\BlogPost;
use App\Models\EventModel;
use App\Models\TeamMember;
use App\Models\DepartmentModel;
use App\Models\JobVacancy;
use App\Models\FacilityModel;
use App\Models\StaticPage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class SeoService
{
    protected $defaultMeta = [
        'title' => 'St Aloysius Gonzaga Secondary School - Excellence in Education',
        'description' => 'St Aloysius Gonzaga Secondary School provides quality education with a focus on academic excellence, character formation, and holistic development. Join our community of learners.',
        'keywords' => 'St Aloysius, secondary school, education, Kenya, academic excellence, character formation',
        'author' => 'St Aloysius Gonzaga Secondary School',
        'robots' => 'index, follow',
        'og_type' => 'website',
        'twitter_card' => 'summary_large_image',
    ];

    public function getMetaTags($page = null, $model = null)
    {
        $meta = $this->defaultMeta;

        if ($page) {
            $meta = array_merge($meta, $this->getPageMeta($page));
        }

        if ($model) {
            $meta = array_merge($meta, $this->getModelMeta($model));
        }

        return $meta;
    }

    protected function getPageMeta($page)
    {
        $meta = [];

        switch ($page) {
            case 'home':
                $meta = [
                    'title' => 'St Aloysius Gonzaga Secondary School - Excellence in Education',
                    'description' => 'Welcome to St Aloysius Gonzaga Secondary School. We provide quality education with a focus on academic excellence, character formation, and holistic development.',
                    'og_type' => 'website',
                ];
                break;

            case 'about-us':
                $meta = [
                    'title' => 'About Us - St Aloysius Gonzaga Secondary School',
                    'description' => 'Learn about our rich history, mission, and values at St Aloysius Gonzaga Secondary School. Discover what makes us a leading educational institution.',
                    'og_type' => 'article',
                ];
                break;

            case 'departments':
                $meta = [
                    'title' => 'Academic Departments - St Aloysius Gonzaga Secondary School',
                    'description' => 'Explore our comprehensive academic departments offering diverse subjects and specialized programs designed for student success.',
                    'og_type' => 'article',
                ];
                break;

            case 'admission':
                $meta = [
                    'title' => 'Admission - St Aloysius Gonzaga Secondary School',
                    'description' => 'Apply to St Aloysius Gonzaga Secondary School. Learn about our admission process, requirements, and how to join our academic community.',
                    'og_type' => 'article',
                ];
                break;

            case 'events':
                $meta = [
                    'title' => 'School Events - St Aloysius Gonzaga Secondary School',
                    'description' => 'Stay updated with the latest events, activities, and happenings at St Aloysius Gonzaga Secondary School.',
                    'og_type' => 'article',
                ];
                break;

            case 'gallery':
                $meta = [
                    'title' => 'Photo Gallery - St Aloysius Gonzaga Secondary School',
                    'description' => 'Browse through our photo gallery showcasing school activities, events, facilities, and student life at St Aloysius Gonzaga.',
                    'og_type' => 'article',
                ];
                break;

            case 'contact':
                $meta = [
                    'title' => 'Contact Us - St Aloysius Gonzaga Secondary School',
                    'description' => 'Get in touch with St Aloysius Gonzaga Secondary School. Find our contact information, location, and office hours.',
                    'og_type' => 'article',
                ];
                break;
        }

        return $meta;
    }

    protected function getModelMeta($model)
    {
        $meta = [];

        if ($model instanceof BlogPost) {
            $meta = [
                'title' => $model->title . ' - St Aloysius Gonzaga Secondary School',
                'description' => Str::limit(strip_tags($model->content), 160),
                'og_type' => 'article',
                'og_image' => $model->featured_image ? asset('storage/' . $model->featured_image) : null,
                'article_published_time' => $model->created_at->toISOString(),
                'article_modified_time' => $model->updated_at->toISOString(),
            ];
        } elseif ($model instanceof EventModel) {
            $meta = [
                'title' => $model->title . ' - St Aloysius Gonzaga Secondary School',
                'description' => Str::limit(strip_tags($model->description), 160),
                'og_type' => 'event',
                'og_image' => $model->banner ? asset('storage/' . $model->banner) : null,
            ];
        } elseif ($model instanceof TeamMember) {
            $meta = [
                'title' => $model->name . ' - Team Member - St Aloysius Gonzaga Secondary School',
                'description' => Str::limit(strip_tags($model->bio), 160),
                'og_type' => 'profile',
                'og_image' => $model->photo ? asset('storage/' . $model->photo) : null,
            ];
        } elseif ($model instanceof DepartmentModel) {
            $meta = [
                'title' => $model->name . ' Department - St Aloysius Gonzaga Secondary School',
                'description' => Str::limit(strip_tags($model->description), 160),
                'og_type' => 'article',
                'og_image' => $model->image ? asset('storage/' . $model->image) : null,
            ];
        } elseif ($model instanceof JobVacancy) {
            $meta = [
                'title' => $model->title . ' - Career Opportunity - St Aloysius Gonzaga Secondary School',
                'description' => Str::limit(strip_tags($model->description), 160),
                'og_type' => 'article',
            ];
        } elseif ($model instanceof FacilityModel) {
            $meta = [
                'title' => $model->name . ' - Facility - St Aloysius Gonzaga Secondary School',
                'description' => Str::limit(strip_tags($model->description), 160),
                'og_type' => 'article',
                'og_image' => $model->image ? asset('storage/' . $model->image) : null,
            ];
        } elseif ($model instanceof StaticPage) {
            $meta = [
                'title' => $model->meta_title ?: $model->title . ' - St Aloysius Gonzaga Secondary School',
                'description' => $model->meta_description ?: Str::limit(strip_tags($model->content), 160),
                'og_type' => 'article',
                'og_image' => $model->banner_image ? asset('storage/' . $model->banner_image) : null,
            ];
        }

        return $meta;
    }

    public function generateStructuredData($type, $data = [])
    {
        switch ($type) {
            case 'organization':
                return $this->getOrganizationSchema();
            case 'school':
                return $this->getSchoolSchema();
            case 'article':
                return $this->getArticleSchema($data);
            case 'event':
                return $this->getEventSchema($data);
            case 'person':
                return $this->getPersonSchema($data);
            case 'breadcrumb':
                return $this->getBreadcrumbSchema($data);
            default:
                return null;
        }
    }

    protected function getOrganizationSchema()
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'EducationalOrganization',
            'name' => 'St Aloysius Gonzaga Secondary School',
            'url' => URL::to('/'),
            'logo' => asset('assets/img/logo/logo.png'),
            'description' => 'St Aloysius Gonzaga Secondary School provides quality education with a focus on academic excellence, character formation, and holistic development.',
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => setting('contact.address', 'School Address'),
                'addressLocality' => 'Nairobi',
                'addressRegion' => 'Nairobi',
                'addressCountry' => 'KE'
            ],
            'contactPoint' => [
                '@type' => 'ContactPoint',
                'telephone' => setting('contact.phone', '+254 XXX XXX XXX'),
                'contactType' => 'customer service',
                'email' => setting('contact.email', 'info@staloysius.com')
            ],
            'sameAs' => [
                setting('socials.facebook'),
                setting('socials.twitter'),
                setting('socials.instagram'),
                setting('socials.linkedin'),
                setting('socials.youtube')
            ]
        ];
    }

    protected function getSchoolSchema()
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'School',
            'name' => 'St Aloysius Gonzaga Secondary School',
            'url' => URL::to('/'),
            'description' => 'A leading secondary school in Kenya providing quality education and character formation.',
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => setting('contact.address', 'School Address'),
                'addressLocality' => 'Nairobi',
                'addressRegion' => 'Nairobi',
                'addressCountry' => 'KE'
            ],
            'telephone' => setting('contact.phone', '+254 XXX XXX XXX'),
            'email' => setting('contact.email', 'info@staloysius.com'),
            'openingHours' => setting('contact.office_hours', 'Monday-Friday 8:00-16:00'),
            'curriculum' => 'Kenya National Curriculum',
            'educationalLevel' => 'Secondary Education'
        ];
    }

    protected function getArticleSchema($data)
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'Article',
            'headline' => $data['title'] ?? '',
            'description' => $data['description'] ?? '',
            'image' => $data['image'] ?? null,
            'author' => [
                '@type' => 'Organization',
                'name' => 'St Aloysius Gonzaga Secondary School'
            ],
            'publisher' => [
                '@type' => 'Organization',
                'name' => 'St Aloysius Gonzaga Secondary School',
                'logo' => [
                    '@type' => 'ImageObject',
                    'url' => asset('assets/img/logo/logo.png')
                ]
            ],
            'datePublished' => $data['published_at'] ?? now()->toISOString(),
            'dateModified' => $data['updated_at'] ?? now()->toISOString(),
            'mainEntityOfPage' => [
                '@type' => 'WebPage',
                '@id' => $data['url'] ?? URL::current()
            ]
        ];
    }

    protected function getEventSchema($data)
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'Event',
            'name' => $data['title'] ?? '',
            'description' => $data['description'] ?? '',
            'startDate' => $data['start_date'] ?? '',
            'endDate' => $data['end_date'] ?? '',
            'location' => [
                '@type' => 'Place',
                'name' => 'St Aloysius Gonzaga Secondary School',
                'address' => [
                    '@type' => 'PostalAddress',
                    'streetAddress' => setting('contact.address', 'School Address'),
                    'addressLocality' => 'Nairobi',
                    'addressRegion' => 'Nairobi',
                    'addressCountry' => 'KE'
                ]
            ],
            'organizer' => [
                '@type' => 'Organization',
                'name' => 'St Aloysius Gonzaga Secondary School'
            ]
        ];
    }

    protected function getPersonSchema($data)
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'Person',
            'name' => $data['name'] ?? '',
            'jobTitle' => $data['position'] ?? '',
            'worksFor' => [
                '@type' => 'Organization',
                'name' => 'St Aloysius Gonzaga Secondary School'
            ],
            'description' => $data['bio'] ?? '',
            'image' => $data['photo'] ?? null
        ];
    }

    protected function getBreadcrumbSchema($breadcrumbs)
    {
        $items = [];
        $position = 1;

        foreach ($breadcrumbs as $breadcrumb) {
            $items[] = [
                '@type' => 'ListItem',
                'position' => $position,
                'name' => $breadcrumb['name'],
                'item' => $breadcrumb['url']
            ];
            $position++;
        }

        return [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => $items
        ];
    }

    public function generateSitemap()
    {
        $urls = [];

        // Static pages
        $urls[] = [
            'url' => config('app.url'),
            'lastmod' => now()->toISOString(),
            'changefreq' => 'daily',
            'priority' => '1.0'
        ];

        $urls[] = [
            'url' => config('app.url') . '/about-us',
            'lastmod' => now()->toISOString(),
            'changefreq' => 'monthly',
            'priority' => '0.8'
        ];

        $urls[] = [
            'url' => config('app.url') . '/departments',
            'lastmod' => now()->toISOString(),
            'changefreq' => 'monthly',
            'priority' => '0.8'
        ];

        $urls[] = [
            'url' => config('app.url') . '/events',
            'lastmod' => now()->toISOString(),
            'changefreq' => 'weekly',
            'priority' => '0.7'
        ];

        $urls[] = [
            'url' => config('app.url') . '/gallery',
            'lastmod' => now()->toISOString(),
            'changefreq' => 'weekly',
            'priority' => '0.6'
        ];

        $urls[] = [
            'url' => config('app.url') . '/contact-us',
            'lastmod' => now()->toISOString(),
            'changefreq' => 'monthly',
            'priority' => '0.7'
        ];

        // Dynamic content - Blog Posts (no status column, include all)
        $blogs = BlogPost::all();
        foreach ($blogs as $blog) {
            $urls[] = [
                'url' => config('app.url') . '/updates/' . $blog->slug,
                'lastmod' => $blog->updated_at->toISOString(),
                'changefreq' => 'monthly',
                'priority' => '0.6'
            ];
        }

        // Events (no status column, include all)
        $events = EventModel::all();
        foreach ($events as $event) {
            $urls[] = [
                'url' => config('app.url') . '/events/' . $event->slug,
                'lastmod' => $event->updated_at->toISOString(),
                'changefreq' => 'monthly',
                'priority' => '0.6'
            ];
        }

        // Departments (no status column, include all)
        $departments = DepartmentModel::all();
        foreach ($departments as $department) {
            $urls[] = [
                'url' => config('app.url') . '/department/' . $department->slug,
                'lastmod' => $department->updated_at->toISOString(),
                'changefreq' => 'monthly',
                'priority' => '0.7'
            ];
        }

        // Job Vacancies (use is_active column)
        $careers = JobVacancy::where('is_active', true)->get();
        foreach ($careers as $career) {
            $urls[] = [
                'url' => config('app.url') . '/careers/' . $career->slug,
                'lastmod' => $career->updated_at->toISOString(),
                'changefreq' => 'weekly',
                'priority' => '0.5'
            ];
        }

        return $urls;
    }
}
