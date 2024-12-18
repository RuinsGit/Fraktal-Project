<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <!-- User details -->
        <div class="user-profile text-center mt-3">
            <div class="">
                <img src="{{ asset('back/assets/images/logo-eneraz.webp') }}" width="80" alt="">
            </div>
            <div class="mt-3">
                <h4 class="font-size-16 mb-1">{{ auth()->user()->name }}</h4>
                <span class="text-muted"><i class="ri-record-circle-line align-middle font-size-14 text-success"></i> Online</span>
            </div>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="{{ route('admin.dashboard') }}" class="waves-effect">
                        <i class="ri-dashboard-line"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-settings-2-line"></i>
                        <span>Ana Səhifə</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ route('admin.home.header.index') }}">
                                <i class="ri-information-line"></i>
                                Header
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.home.company.index') }}">
                                <i class="ri-contacts-line"></i>
                                Şirkət
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.home.partners.index') }}">
                                <i class="ri-team-line"></i>
                                Partnyorlar
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.home.study-programs.index') }}">
                                <i class="ri-book-line"></i>
                                Təhsil Proqramları
                            </a>
                        </li>
                        <li>
    <a href="{{ route('admin.study-content.index') }}" class="waves-effect">
        <i class="fas fa-graduation-cap"></i>
        <span>Təhsil Məzmunu</span>
    </a>
</li>
                        <li>
                            <a href="{{ route('admin.home.company-names.index') }}">
                                <i class="ri-building-line"></i>
                                Şirkət Haqqında
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.home.advantages.index') }}">
                                <i class="ri-award-line"></i>
                                Üstünlüklərimiz
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-team-line"></i>
                        <span>Haqqımızda</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ route('admin.about.company.index') }}">
                                <i class="ri-history-line"></i>
                                Şirkətimiz haqqında
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.about.vision.index') }}">
                                <i class="ri-eye-line"></i>
                                Vizyonumuz
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.history.index') }}">
                                <i class="ri-time-line"></i>
                                Tarixlərimiz
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-book-open-line"></i>
                        <span>Başlığ</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">

                    <li>
            <a href="{{ route('admin.home.title.index') }}">
                <i class="ri-text-spacing"></i>
                Başlıqlar
            </a>
        </li>
                        <li>
                            <a href="{{ route('admin.course.index') }}">
                                <i class="ri-book-open-line"></i>
                                Kurslar Başlığı
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.services-title.index') }}">
                                <i class="ri-service-line"></i>
                                Xidmətlər Başlığı
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.education-title.index') }}">
                                <i class="ri-book-read-line"></i>
                                Tədris Başlığı
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.digital-psychology-title.index') }}">
                                <i class="ri-user-heart-line"></i>
                                 Psixologiya Başlığı
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.gallery-title.index') }}">
                                <i class="ri-text-wrap"></i>
                                Qalereya Başlığı
                            </a>
                        </li>
                        <li>
            <a href="{{ route('admin.contact-title.index') }}">
                <i class="ri-text-wrap"></i>
                Əlaqə Başlıqları
            </a>
        </li>

                        <li>
            <a href="{{ route('admin.blog-title.index') }}">
                <i class="ri-text-wrap"></i>
                Blog Başlığı
            </a>
        </li>

        
                        
                    </ul>
                </li>

                <li>
                    <a href="{{ route('admin.psychology-text.index') }}" class="waves-effect">
                        <i class="ri-file-text-line"></i>
                        <span>Psixologiya Mətnləri</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.human-design.index') }}" class="waves-effect">
                        <i class="ri-user-heart-line"></i>
                        <span>İnsan Dizaynı</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.human-content.index') }}">
                        <i class="ri-user-heart-line"></i>
                        <span>İnsan Məzmunu</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.category.index') }}" class="waves-effect">
                        <i class="ri-list-check"></i>
                        <span>Kateqoriyalar</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.course-types.index') }}" class="waves-effect">
                        <i class="ri-book-mark-line"></i>
                        <span>Kurs Növləri</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.product.index') }}" class="waves-effect">
                        <i class="ri-shopping-cart-line"></i>
                        <span>Məhsullar</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.service.index') }}" class="waves-effect">
                        <i class="ri-customer-service-line"></i>
                        <span>Xidmətlər</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.blog.index') }}" class="waves-effect">
                        <i class="ri-article-line"></i>
                        <span>Xəbərlər</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.order.index') }}" class="waves-effect">
                        <i class="ri-shopping-basket-line"></i>
                        <span>Sifarişlər</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.comment.index') }}" class="waves-effect">
                        <i class="ri-chat-quote-line"></i>
                        <span>Rəylər</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.leader.index') }}" class="waves-effect">
                        <i class="ri-team-line"></i>
                        <span>Rəhbərlik</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.gallery.index') }}" class="waves-effect">
                        <i class="ri-gallery-line"></i>
                        <span>Qalereya</span>
                    </a>
                </li>

                <li>
            <a href="{{ route('admin.blog-types.index') }}" class="{{ Route::is('admin.blog-types.*') ? 'active' : '' }}">
                <i class="ri-list-check"></i>
                Blog Növləri
            </a>
        </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-gallery-line"></i>
                        <span>Qaleriya Content</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                       
                        <li>
            <a href="{{ route('admin.gallery-video.index') }}">
                <i class="ri-video-line"></i>
                Videolar
            </a>
        </li>
                        
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-settings-2-line"></i>
                        <span>Tənzimləmələr</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ route('admin.about') }}">
                                <i class="ri-information-line"></i>
                                Haqqımızda
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.contact') }}">
                                <i class="ri-contacts-line"></i>
                                Əlaqə
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.contact-message.index') }}">
                                <i class="ri-message-2-line"></i>
                                Əlaqə müraciətləri
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->