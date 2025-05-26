<div>
    @section('content')
    <!-- breadcrumb -->
        <div class="site-breadcrumb" style="background: url(assets/img/breadcrumb/01.jpg)">
            <div class="container">
                <h2 class="breadcrumb-title">{{ $member->name }}</h2>
                <ul class="breadcrumb-menu">
                    <li><a href="index.html">Home</a></li>
                    <li class="active">{{ $member->name }}</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->


        <!-- team single -->
        <div class="team-single pt-120 pb-80">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-4">
                            @if ($member->image)
                        <div class="team-single-img">
                            <img src="{{ Storage::url($member->image) }}" alt="{{ $member->name }}">
                        </div>
                         @endif
                         <div class="biography">
                         <p> Madam Beatrice Maina, <span><strong>{{ $member->position }}</strong></span></p></div>
                    </div>
                    <div class="col-md-8">

                            <h3>A MESSAGE FROM THE PRINCIPAL</h3>
                            <!-- <strong>{{ $member->position }}</strong> -->
                            <p class="mt-3">
                              {{ $member->description }}
                            </p>
                            <p class="mt-3">St. Aloysius Gonzaga Secondary School has always been a place of learning, we have taken great strides in building on our strong foundation, embracing new opportunities, and overcoming the challenges that come with living and learning. Despite the many obstacles faced by our community, we have remained steadfast in our commitment to providing quality education and nurturing well-rounded individuals who are ready to make a positive impact on the world.</p>
                            <div class="team-details-info">
                                <ul>
                                    <li><a href="#"><i class="far fa-phone"></i>  +254 715 409 166</a></li>
                                </ul>
                            </div>
                             @if ($member->socials)
                            <div class="team-details-social">
                                  @foreach ($member->socials as $platform => $link)
                                <a href="{{ $link }}"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-whatsapp"></i></a>
                                <a href="#"><i class="fab fa-x"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                @endforeach
                            </div>
@endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- team single end -->

                <!-- biography & skill -->
        <div class="biography-skil pb-120">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="biography">
                            <h4 class="mb-3">Our School</h4>
                            <p class="mb-10">
                              Last year, we made significant strides in improving academic performance, student welfare, and extracurricular opportunities. Our dedicated teaching staff continues to inspire excellence in the classroom, ensuring that each student not only receives a solid academic foundation but is also encouraged to explore their potential in various fields, from the sciences to the arts, sports, and leadership. I am particularly proud of the way our students have responded to the changes and challenges of the past year, demonstrating resilience, determination, and a willingness to learn. The good academic performance posted by our candidate class 2024, is a true reflection of what we stand for.
                            </p> <p class="mb-10">
                              One of the key highlights of this year has been the integration of technology into our learning processes. Through the use of digital platforms, we have been able to enhance the learning experience, making education more interactive and accessible. This technological advancement has helped us bridge the gap between traditional classroom learning and the growing need for digital literacy in today’s world. It has been rewarding to see our students excel not just in their textbooks but also in their ability to navigate and leverage technology for academic and personal growth. We have seen our students do more in-depth research and well-informed presentations especially on weekly themes. Though technological integration and research one of our students has developed an, AI powered Financial Management application which received a National Recognition at the Kenya School`s Engineering Fair.
                            </p> <p class="mb-10">
                            In addition to academics, we have placed a strong emphasis on character development. All our students are made aware of what is expected of them by the time they graduate form school. Each St. Aloysius graduate is expected to be Open to Growth, Be Intellectually competent, Be Religious, Loving and be committed to doing justice to all. Our school ethos is built on the values of integrity, respect, responsibility, and service to others. Through programs that focus on moral and ethical development, we continue to encourage our students to be responsible citizens who understand the importance of giving back to their communities. This year, our students have been actively involved in community service initiatives, supporting local projects like tree planting activities, and raising awareness about various social issues affecting Kibera slums and beyond
                            </p> <p class="mb-10">
                           Our co-curricular activities have also played an important role in the holistic development of our students. Whether it is in sports, music, drama, or clubs, our students have continue to shine. Our athletics team did us proud after they emerged among the best in the Nairobi region competitions. Our drama team has also been doing very well at the zonal and regional level.  I am thrilled with the passion and dedication they have shown, not only in competitions and events but also in fostering teamwork, discipline, and creativity. These activities provide a platform for students to discover their hidden talents, develop leadership skills, and build lifelong friendships.
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- biography & skill end -->

{{--
        <!-- biography & skill -->
        <div class="biography-skil pb-120">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="biography">
                            <h4 class="mb-3">Experience</h4>
                            <p class="mb-10">
                               {{ $member->experience }}
                            </p>
                        </div>
                    </div>
                         @if ($member->professional_skills)
                    <div class="col-md-6">
                        <div class="team-skill">
                            <h4 class="mb-3">Professional Skills</h4>
  @foreach ($member->professional_skills as $skill => $percent)

                            <div class="skills-section">
                                <div class="progress-box">
                                    <h5>{{ $skill }} <span class="pull-right">{{ $percent }}%</span></h5>
                                    <div class="progress" data-value="{{ $percent }}">
                                       <div class="progress-bar" role="progressbar" style="width: {{ $percent }}%;"></div>
                                    </div>
                                </div>

                            </div>
                        @endforeach

                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <!-- biography & skill end -->

--}}
    </main>
    @endsection

