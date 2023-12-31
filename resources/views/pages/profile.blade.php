@extends('../layout/' . $layout)

@section('subhead')
    <title>Profile - Rocketman - Tailwind HTML Admin Template</title>
@endsection

@section('subcontent')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="flex items-center text-lg font-medium mr-auto">
            Profile
        </h2>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            <button class="btn btn-primary shadow-md mr-2">
                <i class="w-4 h-4 mr-2" data-lucide="pencil"></i> Update Profile
            </button>
            <button class="btn btn-outline-secondary shadow-md">
                <i class="w-4 h-4 mr-2" data-lucide="download"></i> View Profile
            </button>
        </div>
    </div>
    <div class="grid grid-cols-12 gap-5 mt-5">
        <!-- BEGIN: Profile Cover -->
        <div class="col-span-12">
            <div class="box intro-y px-3 pt-3 pb-5">
                <div class="image-fit h-80 before:content-[''] before:absolute before:w-full before:h-full before:bg-gradient-to-b from-black/20 to-black before:rounded-md before:z-10 ">
                    <img alt="Rocketman - HTML Admin Templateate" class="rounded-md md:object-[0px_-170px]" src="{{ asset('build/assets/images/preview-16.jpg') }}">
                </div>
                <div class="flex flex-col 2xl:flex-row items-center justify-center text-center 2xl:text-left">
                    <div class="-mt-20 2xl:-mt-10 2xl:ml-10 z-20">
                        <div class="image-fit w-40 h-40 rounded-full border-4 border-white shadow-md overflow-hidden">
                            <img alt="Rocketman - HTML Admin Templateate" src="{{ asset('build/assets/images/profile-12.jpg') }}">
                        </div>
                    </div>
                    <div class="2xl:ml-5">
                        <h2 class="text-2xl mt-5 font-medium">{{ $fakers[0]['users'][0]['name'] }}</h2>
                        <div class="mt-2 text-slate-500 flex items-center justify-center 2xl:justify-start">
                            <i data-lucide="briefcase" class="w-4 h-4 mr-2"></i> Frontend Engineer at Left4code Express
                        </div>
                        <div class="mt-2 text-slate-500 flex items-center justify-center 2xl:justify-start">
                            <i data-lucide="map-pin" class="w-4 h-4 mr-2"></i> New York, USA
                        </div>
                    </div>
                    <div class="mx-auto grid grid-cols-2 gap-y-2 md:gap-y-0 gap-x-5 h-20 mt-5 2xl:border-l 2xl:border-r border-dashed border-slate-200 px-10 mb-6 2xl:mb-0">
                        <div class="col-span-2 md:col-span-1 flex items-center justify-center 2xl:justify-start">
                            <i data-lucide="mail" class="w-4 h-4 mr-2"></i> johnnydepp@left4code.com
                        </div>
                        <div class="col-span-2 md:col-span-1 flex items-center justify-center 2xl:justify-start">
                            <i data-lucide="instagram" class="w-4 h-4 mr-2"></i> @johnnydepp
                        </div>
                        <div class="col-span-2 md:col-span-1 flex items-center justify-center 2xl:justify-start">
                            <i data-lucide="twitter" class="w-4 h-4 mr-2"></i> Johnny Depp
                        </div>
                        <div class="col-span-2 md:col-span-1 flex items-center justify-center 2xl:justify-start">
                            <i data-lucide="linkedin" class="w-4 h-4 mr-2"></i> Johnny Depp
                        </div>
                    </div>
                    <div class="flex 2xl:mr-10 mt-5">
                        <button class="btn btn-primary mr-2 w-32">
                            <i class="w-4 h-4 mr-2" data-lucide="user-plus"></i> Following
                        </button>
                        <button class="btn btn-outline-secondary w-32">
                            <i class="w-4 h-4 mr-2" data-lucide="user-check"></i> Add Friend
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Profile Cover -->
        <!-- BEGIN: Profile Content -->
        <div class="col-span-12 xl:col-span-8">
            <div class="box intro-y p-5">
                <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5">
                    <div class="font-medium truncate text-base">Profile</div>
                    <i data-lucide="edit" class="w-4 h-4 text-slate-500 ml-auto"></i>
                </div>
                <div class="leading-relaxed">
                    <p class="mt-5">{{ $fakers[0]['news'][0]['content'] }}</p>
                    <p class="mt-5">{{ $fakers[0]['news'][1]['content'] }}</p>
                    <button class="btn btn-outline-secondary border-slate-200/60 w-full flex mt-5">
                        <i class="w-4 h-4 mr-2" data-lucide="chevron-down"></i> View More
                    </button>
                </div>
            </div>
            <div class="box intro-y p-5 mt-5">
                <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5">
                    <div class="font-medium truncate text-base">Experience</div>
                    <i data-lucide="edit" class="w-4 h-4 text-slate-500 ml-auto"></i>
                </div>
                <div>
                    <div class="flex border-b border-slate-200 border-dashed pb-5 mb-5 last:border-b-0 last:pb-0 last:mb-0">
                        <div class="mr-5">
                            <div class="w-16 h-16 rounded-full bg-slate-200 dark:bg-darkmode-400 flex items-center justify-center text-base font-medium">SU</div>
                        </div>
                        <div>
                            <div class="font-medium text-base">Left4code Express</div>
                            <div class="mt-1 text-slate-500">Senior Frontend Engineer</div>
                            <div class="mt-1">2005 - 2009 • 4 yrs</div>
                            <ul class="mt-5 sm:mt-3 list-disc -ml-16 sm:ml-3">
                                <li class="mb-1 last:mb-0">Work across the full stack, building highly scalable distributed solutions that enable positive user experiences and measurable business growth.</li>
                                <li class="mb-1 last:mb-0">Develop new features and infrastructure development in support of rapidly emerging business and project requirements.</li>
                                <li class="mb-1 last:mb-0">Assume leadership of new projects from conceptualization to deployment.</li>
                                <li class="mb-1 last:mb-0">Ensure application performance, uptime, and scale, maintaining high standards of code quality and thoughtful application design.</li>
                                <li class="mb-1 last:mb-0">Work with agile development methodologies, adhering to best practices and pursuing continued learning opportunities.</li>
                            </ul>
                        </div>
                    </div>
                    <div class="flex border-b border-slate-200 border-dashed pb-5 mb-5 last:border-b-0 last:pb-0 last:mb-0">
                        <div class="mr-5">
                            <div class="w-16 h-16 rounded-full bg-slate-200 dark:bg-darkmode-400 flex items-center justify-center text-base font-medium">UO</div>
                        </div>
                        <div>
                            <div class="font-medium text-base">Freelancer</div>
                            <div class="mt-1 text-slate-500">Fullstack Engineer</div>
                            <div class="mt-1">2010 - 2014 • 4 yrs</div>
                            <ul class="mt-5 sm:mt-3 list-disc -ml-16 sm:ml-3">
                                <li class="mb-1 last:mb-0">Participate in all aspects of agile software development including design, implementation, and deployment</li>
                                <li class="mb-1 last:mb-0">Architect and provide guidance on building end-to-end systems optimized for speed and scale</li>
                                <li class="mb-1 last:mb-0">Work primarily in Ruby, Java/JRuby, React, and JavaScript</li>
                                <li class="mb-1 last:mb-0">Engage with inspiring designers and front end engineers, and collaborate with leading back end engineers as we create reliable APIs</li>
                                <li class="mb-1 last:mb-0">Collaborate across time zones via Slack, GitHub comments, documents, and frequent video conferences</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <button class="btn btn-outline-secondary border-slate-200/60 w-full flex mt-5">
                    <i class="w-4 h-4 mr-2" data-lucide="chevron-down"></i> View More
                </button>
            </div>
            <div class="box intro-y p-5 mt-5">
                <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5">
                    <div class="font-medium truncate text-base">Skills</div>
                    <i data-lucide="edit" class="w-4 h-4 text-slate-500 ml-auto"></i>
                </div>
                <div class="flex flex-wrap">
                    <div class="px-3 py-1 bg-primary/10 border border-primary/10 rounded-full mr-2 mb-2">Ruby</div>
                    <div class="px-3 py-1 bg-primary/10 border border-primary/10 rounded-full mr-2 mb-2">Java/JRuby</div>
                    <div class="px-3 py-1 bg-primary/10 border border-primary/10 rounded-full mr-2 mb-2">React</div>
                    <div class="px-3 py-1 bg-primary/10 border border-primary/10 rounded-full mr-2 mb-2">JavaScript</div>
                    <div class="px-3 py-1 bg-primary/10 border border-primary/10 rounded-full mr-2 mb-2">Typescript</div>
                    <div class="px-3 py-1 bg-primary/10 border border-primary/10 rounded-full mr-2 mb-2">Bootstrap 5</div>
                    <div class="px-3 py-1 bg-primary/10 border border-primary/10 rounded-full mr-2 mb-2">TailwindCSS 3</div>
                    <div class="px-3 py-1 bg-primary/10 border border-primary/10 rounded-full mr-2 mb-2">Vuejs</div>
                    <div class="px-3 py-1 bg-primary/10 border border-primary/10 rounded-full mr-2 mb-2">Ruby</div>
                    <div class="px-3 py-1 bg-primary/10 border border-primary/10 rounded-full mr-2 mb-2">Java/JRuby</div>
                    <div class="px-3 py-1 bg-primary/10 border border-primary/10 rounded-full mr-2 mb-2">React</div>
                    <div class="px-3 py-1 bg-primary/10 border border-primary/10 rounded-full mr-2 mb-2">JavaScript</div>
                    <div class="px-3 py-1 bg-primary/10 border border-primary/10 rounded-full mr-2 mb-2">Typescript</div>
                    <div class="px-3 py-1 bg-primary/10 border border-primary/10 rounded-full mr-2 mb-2">Bootstrap 5</div>
                    <div class="px-3 py-1 bg-primary/10 border border-primary/10 rounded-full mr-2 mb-2">TailwindCSS 3</div>
                    <div class="px-3 py-1 bg-primary/10 border border-primary/10 rounded-full mr-2 mb-2">Vuejs</div>
                </div>
            </div>
            <div class="box intro-y p-5 mt-5">
                <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5">
                    <div class="font-medium truncate text-base">Interests</div>
                    <i data-lucide="edit" class="w-4 h-4 text-slate-500 ml-auto"></i>
                </div>
                <div class="grid grid-cols-12 gap-y-7">
                    <div class="col-span-12 sm:col-span-6 2xl:col-span-4 flex">
                        <div class="w-16 h-16 rounded-full bg-slate-200 dark:bg-darkmode-400 flex items-center justify-center text-base font-medium">SV</div>
                        <div class="ml-5">
                            <div class="font-medium text-base">Svelte</div>
                            <div class="mt-1 text-slate-500">4,468,655 followers</div>
                            <button class="btn btn-outline-secondary btn-rounded py-1 px-3 mt-2">
                                <i class="w-4 h-4 mr-1" data-lucide="plus"></i> Follow
                            </button>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 2xl:col-span-4 flex">
                        <div class="w-16 h-16 rounded-full bg-slate-200 dark:bg-darkmode-400 flex items-center justify-center text-base font-medium">AN</div>
                        <div class="ml-5">
                            <div class="font-medium text-base">Angular</div>
                            <div class="mt-1 text-slate-500">1,468,655 followers</div>
                            <button class="btn btn-outline-secondary btn-rounded py-1 px-3 mt-2">
                                <i class="w-4 h-4 mr-1" data-lucide="plus"></i> Follow
                            </button>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 2xl:col-span-4 flex">
                        <div class="w-16 h-16 rounded-full bg-slate-200 dark:bg-darkmode-400 flex items-center justify-center text-base font-medium">TW</div>
                        <div class="ml-5">
                            <div class="font-medium text-base">TailwindCSS</div>
                            <div class="mt-1 text-slate-500">45,468,655 followers</div>
                            <button class="btn btn-outline-secondary btn-rounded py-1 px-3 mt-2">
                                <i class="w-4 h-4 mr-1" data-lucide="plus"></i> Follow
                            </button>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 2xl:col-span-4 flex">
                        <div class="w-16 h-16 rounded-full bg-slate-200 dark:bg-darkmode-400 flex items-center justify-center text-base font-medium">LV</div>
                        <div class="ml-5">
                            <div class="font-medium text-base">Laravel</div>
                            <div class="mt-1 text-slate-500">4,468,655 followers</div>
                            <button class="btn btn-outline-secondary btn-rounded py-1 px-3 mt-2">
                                <i class="w-4 h-4 mr-1" data-lucide="plus"></i> Follow
                            </button>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 2xl:col-span-4 flex">
                        <div class="w-16 h-16 rounded-full bg-slate-200 dark:bg-darkmode-400 flex items-center justify-center text-base font-medium">RT</div>
                        <div class="ml-5">
                            <div class="font-medium text-base">React</div>
                            <div class="mt-1 text-slate-500">1,468,655 followers</div>
                            <button class="btn btn-outline-secondary btn-rounded py-1 px-3 mt-2">
                                <i class="w-4 h-4 mr-1" data-lucide="plus"></i> Follow
                            </button>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 2xl:col-span-4 flex">
                        <div class="w-16 h-16 rounded-full bg-slate-200 dark:bg-darkmode-400 flex items-center justify-center text-base font-medium">BS</div>
                        <div class="ml-5">
                            <div class="font-medium text-base">Bootstrap</div>
                            <div class="mt-1 text-slate-500">45,468,655 followers</div>
                            <button class="btn btn-outline-secondary btn-rounded py-1 px-3 mt-2">
                                <i class="w-4 h-4 mr-1" data-lucide="plus"></i> Follow
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Profile Content -->
        <!-- BEGIN: Profile Side Menu -->
        <div class="col-span-12 xl:col-span-4">
            <div class="box intro-y p-5">
                <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5">
                    <div class="font-medium truncate text-base">Education</div>
                    <i data-lucide="edit" class="w-4 h-4 text-slate-500 ml-auto"></i>
                </div>
                <div>
                    <div class="flex border-b border-slate-200 border-dashed pb-5 mb-5 last:border-b-0 last:pb-0 last:mb-0">
                        <div class="w-16 h-16 rounded-full bg-slate-200 dark:bg-darkmode-400 flex items-center justify-center text-base font-medium">SU</div>
                        <div class="ml-5">
                            <div class="font-medium text-base">Stanford University</div>
                            <div class="mt-1 text-slate-500">Computer Science and Engineering</div>
                            <div class="mt-1">2005 - 2009 • 4 yrs</div>
                            <div class="mt-1">California, USA</div>
                        </div>
                    </div>
                    <div class="flex border-b border-slate-200 border-dashed pb-5 mb-5 last:border-b-0 last:pb-0 last:mb-0">
                        <div class="w-16 h-16 rounded-full bg-slate-200 dark:bg-darkmode-400 flex items-center justify-center text-base font-medium">UO</div>
                        <div class="ml-5">
                            <div class="font-medium text-base">University of Oxford</div>
                            <div class="mt-1 text-slate-500">Computer Science and Engineering</div>
                            <div class="mt-1">2010 - 2014 • 4 yrs</div>
                            <div class="mt-1">Oxford, England</div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-outline-secondary border-slate-200/60 w-full flex mt-5">
                    <i class="w-4 h-4 mr-2" data-lucide="chevron-down"></i> View More
                </button>
            </div>
            <div class="box intro-y p-5 mt-5">
                <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5">
                    <div class="font-medium truncate text-base">Followers (102)</div>
                </div>
                <div>
                    @foreach (array_slice($fakers, 0, 5) as $faker)
                        <div class="flex items-center border-b border-slate-200 border-dashed pb-5 mb-5 last:border-b-0 last:pb-0 last:mb-0">
                            <div>
                                <div class="w-16 h-16 image-fit">
                                    <img alt="Rocketman - HTML Admin Templateate" class="rounded-full" src="{{ asset('build/assets/images/' . $faker['photos'][0]) }}">
                                </div>
                            </div>
                            <div class="w-full ml-5 flex 2xl:items-center gap-y-3 flex-col 2xl:flex-row">
                                <div class="mr-auto">
                                    <div class="font-medium text-base flex items-center">
                                        <div class="whitespace-nowrap">{{ $faker['users'][0]['name'] }}</div>
                                        <div class="mx-1.5">•</div>
                                        <a href="" class="text-success text-xs">Follow</a>
                                    </div>
                                    <div class="mt-1 text-slate-500">{{ $faker['users'][0]['username'] }}</div>
                                </div>
                                <div class="flex">
                                    <button class="btn btn-outline-secondary py-1 px-2">
                                        <i class="w-4 h-4 mr-2" data-lucide="user-check"></i> Friends
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <button class="btn btn-outline-secondary border-slate-200/60 w-full flex mt-5">
                    <i class="w-4 h-4 mr-2" data-lucide="chevron-down"></i> View More
                </button>
            </div>
        </div>
        <!-- END: Profile Side Menu -->
    </div>
@endsection
