<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="/oraclepopupsignin">
                @if(!empty($generalSettings['site_name']))
                    {{ strtoupper($generalSettings['site_name']) }}
                @else
                    Platform Title
                @endif
            </a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="/oraclepopupsignin">
                @if(!empty($generalSettings['site_name']))
                    {{ strtoupper(substr($generalSettings['site_name'],0,2)) }}
                @endif
            </a>
        </div>

        <ul class="sidebar-menu">
            @can('admin_general_dashboard_show')
                <li class="{{ (request()->is('oraclepopupsignin/')) ? 'active' : '' }}">
                    <a href="/oraclepopupsignin" class="nav-link">
                        <i class="fas fa-fire"></i>
                        <span>{{ trans('oraclepopupsignin/main.dashboard') }}</span>
                    </a>
                </li>
            @endcan

            @can('admin_marketing_dashboard')
                <li class="{{ (request()->is('oraclepopupsignin/marketing')) ? 'active' : '' }}">
                    <a href="/oraclepopupsignin/marketing" class="nav-link">
                        <i class="fas fa-chart-pie"></i>
                        <span>{{ trans('oraclepopupsignin/main.marketing_dashboard_title') }}</span>
                    </a>
                </li>
            @endcan

            @if($authUser->can('admin_webinars') or
                $authUser->can('admin_categories') or
                $authUser->can('admin_filters') or
                $authUser->can('admin_quizzes') or
                $authUser->can('admin_certificate') or
                $authUser->can('admin_reviews_lists')
            )
                <li class="menu-header">{{ trans('site.education') }}</li>
            @endif

            @can('admin_webinars')
                <li class="nav-item dropdown {{ (request()->is('oraclepopupsignin/webinars*') and !request()->is('oraclepopupsignin/webinars/comments*')) ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <i class="fas fa-graduation-cap"></i>
                        <span>{{ trans('panel.classes') }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        @can('admin_webinars_list')
                            <li class="{{ (request()->is('oraclepopupsignin/webinars') and request()->get('type') == 'course') ? 'active' : '' }}">
                                <a class="nav-link @if(!empty($sidebarBeeps['courses']) and $sidebarBeeps['courses']) beep beep-sidebar @endif" href="/oraclepopupsignin/webinars?type=course">{{ trans('oraclepopupsignin/main.courses') }}</a>
                            </li>

                            <li class="{{ (request()->is('oraclepopupsignin/webinars') and request()->get('type') == 'webinar') ? 'active' : '' }}">
                                <a class="nav-link @if(!empty($sidebarBeeps['webinars']) and $sidebarBeeps['webinars']) beep beep-sidebar @endif" href="/oraclepopupsignin/webinars?type=webinar">{{ trans('oraclepopupsignin/main.live_classes') }}</a>
                            </li>

                            <li class="{{ (request()->is('oraclepopupsignin/webinars') and request()->get('type') == 'text_lesson') ? 'active' : '' }}">
                                <a class="nav-link @if(!empty($sidebarBeeps['textLessons']) and $sidebarBeeps['textLessons']) beep beep-sidebar @endif" href="/oraclepopupsignin/webinars?type=text_lesson">{{ trans('oraclepopupsignin/main.text_courses') }}</a>
                            </li>
                        @endcan()

                        @can('admin_webinars_create')
                            <li class="{{ (request()->is('oraclepopupsignin/webinars/create')) ? 'active' : '' }}">
                                <a class="nav-link" href="/oraclepopupsignin/webinars/create">{{ trans('oraclepopupsignin/main.new') }}</a>
                            </li>
                        @endcan()


                        @can('admin_agora_history_list')

                             <li class="{{ (request()->is('oraclepopupsignin/agora_history')) ? 'active' : '' }}">
                                <a class="nav-link" href="/oraclepopupsignin/agora_history">{{ trans('update.agora_history') }}</a>
                            </li>
                         @endcan






                    </ul>
                </li>
            @endcan()

            @can('admin_categories')
                <li class="nav-item dropdown {{ (request()->is('oraclepopupsignin/categories*')) ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <i class="fas fa-th"></i>
                        <span>{{ trans('oraclepopupsignin/main.categories') }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        @can('admin_categories_list')
                            <li class="{{ (request()->is('oraclepopupsignin/categories')) ? 'active' : '' }}">
                                <a class="nav-link" href="/oraclepopupsignin/categories">{{ trans('oraclepopupsignin/main.lists') }}</a>
                            </li>
                        @endcan()
                        @can('admin_categories_create')
                            <li class="{{ (request()->is('oraclepopupsignin/categories/create')) ? 'active' : '' }}">
                                <a class="nav-link" href="/oraclepopupsignin/categories/create">{{ trans('oraclepopupsignin/main.new') }}</a>
                            </li>
                        @endcan()
                        @can('admin_trending_categories')
                            <li class="{{ (request()->is('oraclepopupsignin/categories/trends')) ? 'active' : '' }}">
                                <a class="nav-link" href="/oraclepopupsignin/categories/trends">{{ trans('oraclepopupsignin/main.trends') }}</a>
                            </li>
                        @endcan()
                    </ul>
                </li>
            @endcan()

            @can('admin_filters')
                <li class="nav-item dropdown {{ (request()->is('oraclepopupsignin/filters*')) ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <i class="fas fa-filter"></i>
                        <span>{{ trans('oraclepopupsignin/main.filters') }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        @can('admin_filters_list')
                            <li class="{{ (request()->is('oraclepopupsignin/filters')) ? 'active' : '' }}">
                                <a class="nav-link" href="/oraclepopupsignin/filters">{{ trans('oraclepopupsignin/main.lists') }}</a>
                            </li>
                        @endcan()
                        @can('admin_filters_create')
                            <li class="{{ (request()->is('oraclepopupsignin/filters/create')) ? 'active' : '' }}">
                                <a class="nav-link" href="/oraclepopupsignin/filters/create">{{ trans('oraclepopupsignin/main.new') }}</a>
                            </li>
                        @endcan()
                    </ul>
                </li>
            @endcan()

            @can('admin_quizzes')
                <li class="{{ (request()->is('oraclepopupsignin/quizzes*')) ? 'active' : '' }}">
                    <a class="nav-link " href="/oraclepopupsignin/quizzes">
                        <i class="fas fa-file"></i>
                        <span>{{ trans('oraclepopupsignin/main.quizzes') }}</span>
                    </a>
                </li>
            @endcan()

            @can('admin_certificate')
                <li class="nav-item dropdown {{ (request()->is('oraclepopupsignin/certificates*')) ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <i class="fas fa-newspaper"></i>
                        <span>{{ trans('oraclepopupsignin/main.certificates') }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        @can('admin_certificate_list')
                            <li class="{{ (request()->is('oraclepopupsignin/certificates')) ? 'active' : '' }}">
                                <a class="nav-link" href="/oraclepopupsignin/certificates">{{ trans('oraclepopupsignin/main.lists') }}</a>
                            </li>
                        @endcan

                        @can('admin_certificate_template_list')
                            <li class="{{ (request()->is('oraclepopupsignin/certificates/templates')) ? 'active' : '' }}">
                                <a class="nav-link"
                                   href="/oraclepopupsignin/certificates/templates">{{ trans('oraclepopupsignin/main.templates') }}</a>
                            </li>
                        @endcan

                        @can('admin_certificate_template_create')
                            <li class="{{ (request()->is('oraclepopupsignin/certificates/templates/new')) ? 'active' : '' }}">
                                <a class="nav-link"
                                   href="/oraclepopupsignin/certificates/templates/new">{{ trans('oraclepopupsignin/main.new_template') }}</a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan

            @can('admin_reviews_lists')
                <li class="{{ (request()->is('oraclepopupsignin/reviews')) ? 'active' : '' }}">
                    <a href="/oraclepopupsignin/reviews" class="nav-link @if(!empty($sidebarBeeps['reviews']) and $sidebarBeeps['reviews']) beep beep-sidebar @endif">
                        <i class="fas fa-star"></i>
                        <span>{{ trans('oraclepopupsignin/main.reviews') }}</span>
                    </a>
                </li>
            @endcan


            @if($authUser->can('admin_consultants_lists') or
                $authUser->can('admin_appointments_lists')
            )
                <li class="menu-header">{{ trans('site.appointments') }}</li>
            @endif

            @can('admin_consultants_lists')
                <li class="{{ (request()->is('oraclepopupsignin/consultants')) ? 'active' : '' }}">
                    <a href="/oraclepopupsignin/consultants" class="nav-link">
                        <i class="fas fa-id-card"></i>
                        <span>{{ trans('oraclepopupsignin/main.consultants') }}</span>
                    </a>
                </li>
            @endcan

            @can('admin_appointments_lists')
                <li class="{{ (request()->is('oraclepopupsignin/appointments')) ? 'active' : '' }}">
                    <a class="nav-link" href="/oraclepopupsignin/appointments">
                        <i class="fas fa-address-book"></i>
                        <span>{{ trans('oraclepopupsignin/main.appointments') }}</span>
                    </a>
                </li>
            @endcan

            @if($authUser->can('admin_users') or
                $authUser->can('admin_roles') or
                $authUser->can('admin_group') or
                $authUser->can('admin_users_badges') or
                $authUser->can('admin_become_instructors_list')
            )
                <li class="menu-header">{{ trans('panel.users') }}</li>
            @endif

            @can('admin_users')
                <li class="nav-item dropdown {{ (request()->is('oraclepopupsignin/staffs') or request()->is('oraclepopupsignin/students') or request()->is('oraclepopupsignin/instructors') or request()->is('oraclepopupsignin/organizations')) ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <i class="fas fa-users"></i>
                        <span>{{ trans('oraclepopupsignin/main.users_list') }}</span>
                    </a>

                    <ul class="dropdown-menu">
                        @can('admin_staffs_list')
                            <li class="{{ (request()->is('oraclepopupsignin/staffs')) ? 'active' : '' }}">
                                <a class="nav-link" href="/oraclepopupsignin/staffs">{{ trans('oraclepopupsignin/main.staff') }}</a>
                            </li>
                        @endcan()

                        @can('admin_users_list')
                            <li class="{{ (request()->is('oraclepopupsignin/students')) ? 'active' : '' }}">
                                <a class="nav-link" href="/oraclepopupsignin/students">{{ trans('public.students') }}</a>
                            </li>
                        @endcan()

                        @can('admin_instructors_list')
                            <li class="{{ (request()->is('oraclepopupsignin/instructors')) ? 'active' : '' }}">
                                <a class="nav-link" href="/oraclepopupsignin/instructors">{{ trans('home.instructors') }}</a>
                            </li>
                        @endcan()

                        @can('admin_organizations_list')
                            <li class="{{ (request()->is('oraclepopupsignin/organizations')) ? 'active' : '' }}">
                                <a class="nav-link" href="/oraclepopupsignin/organizations">{{ trans('oraclepopupsignin/main.organizations') }}</a>
                            </li>
                        @endcan()

                        @can('admin_users_create')
                            <li class="{{ (request()->is('oraclepopupsignin/users/create')) ? 'active' : '' }}">
                                <a class="nav-link" href="/oraclepopupsignin/users/create">{{ trans('oraclepopupsignin/main.new') }}</a>
                            </li>
                        @endcan()
                    </ul>
                </li>
            @endcan

            @can('admin_roles')
                <li class="nav-item dropdown {{ (request()->is('oraclepopupsignin/roles*')) ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <i class="fas fa-user-circle"></i> <span>{{ trans('oraclepopupsignin/main.roles') }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        @can('admin_roles_list')
                            <li class="{{ (request()->is('oraclepopupsignin/roles')) ? 'active' : '' }}">
                                <a class="nav-link active" href="/oraclepopupsignin/roles">{{ trans('oraclepopupsignin/main.lists') }}</a>
                            </li>
                        @endcan()
                        @can('admin_roles_create')
                            <li class="{{ (request()->is('oraclepopupsignin/roles/create')) ? 'active' : '' }}">
                                <a class="nav-link" href="/oraclepopupsignin/roles/create">{{ trans('oraclepopupsignin/main.new') }}</a>
                            </li>
                        @endcan()
                    </ul>
                </li>
            @endcan()

            @can('admin_group')
                <li class="nav-item dropdown {{ (request()->is('oraclepopupsignin/users/groups*')) ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <i class="fas fa-sitemap"></i>
                        <span>{{ trans('oraclepopupsignin/main.groups') }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        @can('admin_group_list')
                            <li class="{{ (request()->is('oraclepopupsignin/users/groups')) ? 'active' : '' }}">
                                <a class="nav-link" href="/oraclepopupsignin/users/groups">{{ trans('oraclepopupsignin/main.lists') }}</a>
                            </li>
                        @endcan
                        @can('admin_group_create')
                            <li class="{{ (request()->is('oraclepopupsignin/users/groups/create')) ? 'active' : '' }}">
                                <a class="nav-link" href="/oraclepopupsignin/users/groups/create">{{ trans('oraclepopupsignin/main.new') }}</a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan

            @can('admin_users_badges')
                <li class="{{ (request()->is('oraclepopupsignin/users/badges')) ? 'active' : '' }}">
                    <a class="nav-link" href="/oraclepopupsignin/users/badges">
                        <i class="fas fa-trophy"></i>
                        <span>{{ trans('oraclepopupsignin/main.badges') }}</span>
                    </a>
                </li>
            @endcan()



            @can('admin_become_instructors_list')
                <li class="nav-item dropdown {{ (request()->is('oraclepopupsignin/users/become-instructors*')) ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <i class="fas fa-list-alt"></i>
                        <span>{{ trans('oraclepopupsignin/main.instructor_requests') }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="{{ (request()->is('oraclepopupsignin/users/become-instructors/instructors')) ? 'active' : '' }}">
                            <a class="nav-link" href="/oraclepopupsignin/users/become-instructors/instructors"><i class="fas fa-list-alt"></i>
                                <span>{{ trans('oraclepopupsignin/main.instructors') }}</span>
                            </a>
                        </li>

                        <li class="{{ (request()->is('oraclepopupsignin/users/become-instructors/organizations')) ? 'active' : '' }}">
                            <a class="nav-link" href="/oraclepopupsignin/users/become-instructors/organizations"><i class="fas fa-list-alt"></i>
                                <span>{{ trans('oraclepopupsignin/main.organizations') }}</span>
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan()

            @if($authUser->can('admin_supports') or
                $authUser->can('admin_comments') or
                $authUser->can('admin_reports') or
                $authUser->can('admin_contacts') or
                $authUser->can('admin_noticeboards') or
                $authUser->can('admin_notifications')
            )
                <li class="menu-header">{{ trans('oraclepopupsignin/main.crm') }}</li>
            @endif

            @can('admin_supports')
                <li class="nav-item dropdown {{ (request()->is('oraclepopupsignin/supports*') and request()->get('type') != 'course_conversations') ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <i class="fas fa-headphones"></i>
                        <span>{{ trans('oraclepopupsignin/main.supports') }}</span>
                    </a>

                    <ul class="dropdown-menu">
                        @can('admin_supports_list')
                            <li class="{{ (request()->is('oraclepopupsignin/supports')) ? 'active' : '' }}">
                                <a class="nav-link" href="/oraclepopupsignin/supports">{{ trans('public.tickets') }}</a>
                            </li>
                        @endcan

                        @can('admin_support_send')
                            <li class="{{ (request()->is('oraclepopupsignin/supports/create')) ? 'active' : '' }}">
                                <a class="nav-link" href="/oraclepopupsignin/supports/create">{{ trans('oraclepopupsignin/main.new_ticket') }}</a>
                            </li>
                        @endcan

                        @can('admin_support_departments')
                            <li class="{{ (request()->is('oraclepopupsignin/supports/departments')) ? 'active' : '' }}">
                                <a class="nav-link" href="/oraclepopupsignin/supports/departments">{{ trans('oraclepopupsignin/main.departments') }}</a>
                            </li>
                        @endcan
                    </ul>
                </li>

                @can('admin_support_course_conversations')
                    <li class="{{ (request()->is('oraclepopupsignin/supports*') and request()->get('type') == 'course_conversations') ? 'active' : '' }}">
                        <a class="nav-link" href="/oraclepopupsignin/supports?type=course_conversations">
                            <i class="fas fa-envelope-square"></i>
                            <span>{{ trans('oraclepopupsignin/main.classes_conversations') }}</span>
                        </a>
                    </li>
                @endcan
            @endcan

            @can('admin_comments')
                <li class="nav-item dropdown {{ (request()->is('oraclepopupsignin/comments*') and !request()->is('oraclepopupsignin/comments/webinars/reports')) ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-comments"></i> <span>{{ trans('oraclepopupsignin/main.comments') }}</span></a>
                    <ul class="dropdown-menu">
                        @can('admin_webinar_comments')
                            <li class="{{ (request()->is('oraclepopupsignin/comments/webinars')) ? 'active' : '' }}">
                                <a class="nav-link @if(!empty($sidebarBeeps['classesComments']) and $sidebarBeeps['classesComments']) beep beep-sidebar @endif" href="/oraclepopupsignin/comments/webinars">{{ trans('oraclepopupsignin/main.classes_comments') }}</a>
                            </li>
                        @endcan

                        @can('admin_blog_comments')
                            <li class="{{ (request()->is('oraclepopupsignin/comments/blog')) ? 'active' : '' }}">
                                <a class="nav-link @if(!empty($sidebarBeeps['blogComments']) and $sidebarBeeps['blogComments']) beep beep-sidebar @endif" href="/oraclepopupsignin/comments/blog">{{ trans('oraclepopupsignin/main.blog_comments') }}</a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan

            @can('admin_reports')
                <li class="nav-item dropdown {{ (request()->is('oraclepopupsignin/reports*') or request()->is('oraclepopupsignin/comments/webinars/reports') or request()->is('oraclepopupsignin/comments/blog/reports')) ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-info-circle"></i> <span>{{ trans('oraclepopupsignin/main.reports') }}</span></a>

                    <ul class="dropdown-menu">
                        @can('admin_webinar_reports')
                            <li class="{{ (request()->is('oraclepopupsignin/reports/webinars')) ? 'active' : '' }}">
                                <a class="nav-link" href="/oraclepopupsignin/reports/webinars">{{ trans('panel.classes') }}</a>
                            </li>
                        @endcan

                        @can('admin_webinar_comments_reports')
                            <li class="{{ (request()->is('oraclepopupsignin/comments/webinars/reports')) ? 'active' : '' }}">
                                <a class="nav-link" href="/oraclepopupsignin/comments/webinars/reports">{{ trans('oraclepopupsignin/main.classes_comments_reports') }}</a>
                            </li>
                        @endcan

                        @can('admin_blog_comments_reports')
                            <li class="{{ (request()->is('oraclepopupsignin/comments/blog/reports')) ? 'active' : '' }}">
                                <a class="nav-link" href="/oraclepopupsignin/comments/blog/reports">{{ trans('oraclepopupsignin/main.blog_comments_reports') }}</a>
                            </li>
                        @endcan

                        @can('admin_report_reasons')
                            <li class="{{ (request()->is('oraclepopupsignin/reports/reasons')) ? 'active' : '' }}">
                                <a class="nav-link" href="/oraclepopupsignin/reports/reasons">{{ trans('oraclepopupsignin/main.report_reasons') }}</a>
                            </li>
                        @endcan()
                    </ul>
                </li>
            @endcan

            @can('admin_contacts')
                <li class="{{ (request()->is('oraclepopupsignin/contacts*')) ? 'active' : '' }}">
                    <a class="nav-link" href="/oraclepopupsignin/contacts">
                        <i class="fas fa-phone-square"></i>
                        <span>{{ trans('oraclepopupsignin/main.contacts') }}</span>
                    </a>
                </li>
            @endcan

            @can('admin_noticeboards')
                <li class="nav-item dropdown {{ (request()->is('oraclepopupsignin/noticeboards*')) ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-sticky-note"></i> <span>{{ trans('oraclepopupsignin/main.noticeboard') }}</span></a>
                    <ul class="dropdown-menu">
                        @can('admin_noticeboards_list')
                            <li class="{{ (request()->is('oraclepopupsignin/noticeboards')) ? 'active' : '' }}">
                                <a class="nav-link" href="/oraclepopupsignin/noticeboards">{{ trans('oraclepopupsignin/main.notices_list_title') }}</a>
                            </li>
                        @endcan

                        @can('admin_noticeboards_send')
                            <li class="{{ (request()->is('oraclepopupsignin/noticeboards/send')) ? 'active' : '' }}">
                                <a class="nav-link" href="/oraclepopupsignin/noticeboards/send">{{ trans('oraclepopupsignin/main.new_notice_title') }}</a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan

            @can('admin_notifications')
                <li class="nav-item dropdown {{ (request()->is('oraclepopupsignin/notifications*')) ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <i class="fas fa-bell"></i>
                        <span>{{ trans('oraclepopupsignin/main.notifications') }}</span>
                    </a>

                    <ul class="dropdown-menu">
                        @can('admin_notifications_list')
                            <li class="{{ (request()->is('oraclepopupsignin/notifications')) ? 'active' : '' }}">
                                <a class="nav-link" href="/oraclepopupsignin/notifications">{{ trans('public.history') }}</a>
                            </li>
                        @endcan

                        @can('admin_notifications_posted_list')
                            <li class="{{ (request()->is('oraclepopupsignin/notifications/posted')) ? 'active' : '' }}">
                                <a class="nav-link" href="/oraclepopupsignin/notifications/posted">{{ trans('oraclepopupsignin/main.posted') }}</a>
                            </li>
                        @endcan

                        @can('admin_notifications_send')
                            <li class="{{ (request()->is('oraclepopupsignin/notifications/send')) ? 'active' : '' }}">
                                <a class="nav-link" href="/oraclepopupsignin/notifications/send">{{ trans('oraclepopupsignin/main.new') }}</a>
                            </li>
                        @endcan

                        @can('admin_notifications_templates')
                            <li class="{{ (request()->is('oraclepopupsignin/notifications/templates')) ? 'active' : '' }}">
                                <a class="nav-link" href="/oraclepopupsignin/notifications/templates">{{ trans('oraclepopupsignin/main.templates') }}</a>
                            </li>
                        @endcan

                        @can('admin_notifications_template_create')
                            <li class="{{ (request()->is('oraclepopupsignin/notifications/templates/create')) ? 'active' : '' }}">
                                <a class="nav-link" href="/oraclepopupsignin/notifications/templates/create">{{ trans('oraclepopupsignin/main.new_template') }}</a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan

            @if($authUser->can('admin_blog') or
                $authUser->can('admin_pages') or
                $authUser->can('admin_additional_pages') or
                $authUser->can('admin_testimonials') or
                $authUser->can('admin_tags') or
                $authUser->can('admin_regions')
            )
                <li class="menu-header">{{ trans('oraclepopupsignin/main.content') }}</li>
            @endif

            @can('admin_blog')
                <li class="nav-item dropdown {{ (request()->is('oraclepopupsignin/blog*') and !request()->is('oraclepopupsignin/blog/comments')) ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <i class="fas fa-rss-square"></i>
                        <span>{{ trans('oraclepopupsignin/main.blog') }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        @can('admin_blog_lists')
                            <li class="{{ (request()->is('oraclepopupsignin/blog')) ? 'active' : '' }}">
                                <a class="nav-link" href="/oraclepopupsignin/blog">{{ trans('site.posts') }}</a>
                            </li>
                        @endcan

                        @can('admin_blog_create')
                            <li class="{{ (request()->is('oraclepopupsignin/blog/create')) ? 'active' : '' }}">
                                <a class="nav-link" href="/oraclepopupsignin/blog/create">{{ trans('oraclepopupsignin/main.new_post') }}</a>
                            </li>
                        @endcan

                        @can('admin_blog_categories')
                            <li class="{{ (request()->is('oraclepopupsignin/blog/categories')) ? 'active' : '' }}">
                                <a class="nav-link" href="/oraclepopupsignin/blog/categories">{{ trans('oraclepopupsignin/main.categories') }}</a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan()

            @can('admin_pages')
                <li class="nav-item dropdown {{ (request()->is('oraclepopupsignin/pages*')) ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <i class="fas fa-pager"></i>
                        <span>{{ trans('oraclepopupsignin/main.pages') }}</span>
                    </a>

                    <ul class="dropdown-menu">
                        @can('admin_pages_list')
                            <li class="{{ (request()->is('oraclepopupsignin/pages')) ? 'active' : '' }}">
                                <a class="nav-link" href="/oraclepopupsignin/pages">{{ trans('oraclepopupsignin/main.lists') }}</a>
                            </li>
                        @endcan()

                        @can('admin_pages_create')
                            <li class="{{ (request()->is('oraclepopupsignin/pages/create')) ? 'active' : '' }}">
                                <a class="nav-link" href="/oraclepopupsignin/pages/create">{{ trans('oraclepopupsignin/main.new_page') }}</a>
                            </li>
                        @endcan()
                    </ul>
                </li>
            @endcan

            @can('admin_additional_pages')
                <li class="nav-item dropdown {{ (request()->is('oraclepopupsignin/additional_page*')) ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-plus-circle"></i> <span>{{ trans('oraclepopupsignin/main.additional_pages_title') }}</span></a>
                    <ul class="dropdown-menu">

                        @can('admin_additional_pages_404')
                            <li class="{{ (request()->is('oraclepopupsignin/additional_page/404')) ? 'active' : '' }}">
                                <a class="nav-link" href="/oraclepopupsignin/additional_page/404">{{ trans('oraclepopupsignin/main.error_404') }}</a>
                            </li>
                        @endcan()

                        @can('admin_additional_pages_contact_us')
                            <li class="{{ (request()->is('oraclepopupsignin/additional_page/contact_us')) ? 'active' : '' }}">
                                <a class="nav-link" href="/oraclepopupsignin/additional_page/contact_us">{{ trans('oraclepopupsignin/main.contact_us') }}</a>
                            </li>
                        @endcan()

                        @can('admin_additional_pages_footer')
                            <li class="{{ (request()->is('oraclepopupsignin/additional_page/footer')) ? 'active' : '' }}">
                                <a class="nav-link" href="/oraclepopupsignin/additional_page/footer">{{ trans('oraclepopupsignin/main.footer') }}</a>
                            </li>
                        @endcan()

                        @can('admin_additional_pages_navbar_links')
                            <li class="{{ (request()->is('oraclepopupsignin/additional_page/navbar_links')) ? 'active' : '' }}">
                                <a class="nav-link" href="/oraclepopupsignin/additional_page/navbar_links">{{ trans('oraclepopupsignin/main.top_navbar') }}</a>
                            </li>
                        @endcan()
                    </ul>
                </li>
            @endcan

            @can('admin_testimonials')
                <li class="nav-item dropdown {{ (request()->is('oraclepopupsignin/testimonials*')) ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <i class="fas fa-address-card"></i>
                        <span>{{ trans('oraclepopupsignin/main.testimonials') }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        @can('admin_testimonials_list')
                            <li class="{{ (request()->is('oraclepopupsignin/testimonials')) ? 'active' : '' }}">
                                <a class="nav-link" href="/oraclepopupsignin/testimonials">{{ trans('oraclepopupsignin/main.lists') }}</a>
                            </li>
                        @endcan()

                        @can('admin_testimonials_create')
                            <li class="{{ (request()->is('oraclepopupsignin/testimonials/create')) ? 'active' : '' }}">
                                <a class="nav-link" href="/oraclepopupsignin/testimonials/create">{{ trans('oraclepopupsignin/main.new') }}</a>
                            </li>
                        @endcan()
                    </ul>
                </li>
            @endcan

            @can('admin_tags')
                <li class="{{ (request()->is('oraclepopupsignin/tags')) ? 'active' : '' }}">
                    <a href="/oraclepopupsignin/tags" class="nav-link">
                        <i class="fas fa-tags"></i>
                        <span>{{ trans('oraclepopupsignin/main.tags') }}</span>
                    </a>
                </li>
            @endcan()

            @can('admin_regions')
                <li class="nav-item dropdown {{ (request()->is('oraclepopupsignin/regions*')) ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <i class="fas fa-map-marked"></i>
                        <span>{{ trans('update.regions') }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        @can('admin_regions_countries')
                            <li class="{{ (request()->is('oraclepopupsignin/regions/countries')) ? 'active' : '' }}">
                                <a class="nav-link" href="/oraclepopupsignin/regions/countries">{{ trans('update.countries') }}</a>
                            </li>
                        @endcan()

                        @can('admin_regions_provinces')
                            <li class="{{ (request()->is('oraclepopupsignin/regions/provinces')) ? 'active' : '' }}">
                                <a class="nav-link" href="/oraclepopupsignin/regions/provinces">{{ trans('update.provinces') }}</a>
                            </li>
                        @endcan()

                        @can('admin_regions_cities')
                            <li class="{{ (request()->is('oraclepopupsignin/regions/cities')) ? 'active' : '' }}">
                                <a class="nav-link" href="/oraclepopupsignin/regions/cities">{{ trans('update.cities') }}</a>
                            </li>
                        @endcan()

                        @can('admin_regions_districts')
                            <li class="{{ (request()->is('oraclepopupsignin/regions/districts')) ? 'active' : '' }}">
                                <a class="nav-link" href="/oraclepopupsignin/regions/districts">{{ trans('update.districts') }}</a>
                            </li>
                        @endcan()
                    </ul>
                </li>
            @endcan

            @if($authUser->can('admin_documents') or
                $authUser->can('admin_sales_list') or
                $authUser->can('admin_payouts') or
                $authUser->can('admin_offline_payments_list') or
                $authUser->can('admin_subscribe') or
                $authUser->can('admin_registration_packages')
            )
                <li class="menu-header">{{ trans('oraclepopupsignin/main.financial') }}</li>
            @endif

            @can('admin_documents')
                <li class="nav-item dropdown {{ (request()->is('oraclepopupsignin/financial/documents*')) ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <i class="fas fa-file-invoice-dollar"></i>
                        <span>{{ trans('oraclepopupsignin/main.balances') }}</span>
                    </a>
                    <ul class="dropdown-menu">

                        @can('admin_documents_list')
                            <li class="{{ (request()->is('oraclepopupsignin/financial/documents')) ? 'active' : '' }}">
                                <a class="nav-link" href="/oraclepopupsignin/financial/documents">{{ trans('oraclepopupsignin/main.list') }}</a>
                            </li>
                        @endcan

                        @can('admin_documents_create')
                            <li class="{{ (request()->is('oraclepopupsignin/financial/documents/new')) ? 'active' : '' }}">
                                <a class="nav-link" href="/oraclepopupsignin/financial/documents/new">{{ trans('oraclepopupsignin/main.new') }}</a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan

            @can('admin_sales_list')
                <li class="{{ (request()->is('oraclepopupsignin/financial/sales*')) ? 'active' : '' }}">
                    <a href="/oraclepopupsignin/financial/sales" class="nav-link">
                        <i class="fas fa-list-ul"></i>
                        <span>{{ trans('oraclepopupsignin/main.sales_list') }}</span>
                    </a>
                </li>
            @endcan

            @can('admin_payouts')
                <li class="nav-item dropdown {{ (request()->is('oraclepopupsignin/financial/payouts*')) ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-credit-card"></i> <span>{{ trans('oraclepopupsignin/main.payout') }}</span></a>
                    <ul class="dropdown-menu">
                        @can('admin_payouts_list')
                            <li class="{{ (request()->is('oraclepopupsignin/financial/payouts') and request()->get('payout') == 'requests') ? 'active' : '' }}">
                                <a href="/oraclepopupsignin/financial/payouts?payout=requests" class="nav-link @if(!empty($sidebarBeeps['payoutRequest']) and $sidebarBeeps['payoutRequest']) beep beep-sidebar @endif">
                                    <span>{{ trans('panel.requests') }}</span>
                                </a>
                            </li>
                        @endcan

                        @can('admin_payouts_list')
                            <li class="{{ (request()->is('oraclepopupsignin/financial/payouts') and request()->get('payout') == 'history') ? 'active' : '' }}">
                                <a href="/oraclepopupsignin/financial/payouts?payout=history" class="nav-link">
                                    <span>{{ trans('public.history') }}</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan

            @can('admin_offline_payments_list')
                <li class="nav-item dropdown {{ (request()->is('oraclepopupsignin/financial/offline_payments*')) ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-university"></i> <span>{{ trans('oraclepopupsignin/main.offline_payments') }}</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ (request()->is('oraclepopupsignin/financial/offline_payments') and request()->get('page_type') == 'requests') ? 'active' : '' }}">
                            <a href="/oraclepopupsignin/financial/offline_payments?page_type=requests" class="nav-link @if(!empty($sidebarBeeps['offlinePayments']) and $sidebarBeeps['offlinePayments']) beep beep-sidebar @endif">
                                <span>{{ trans('panel.requests') }}</span>
                            </a>
                        </li>

                        <li class="{{ (request()->is('oraclepopupsignin/financial/offline_payments') and request()->get('page_type') == 'history') ? 'active' : '' }}">
                            <a href="/oraclepopupsignin/financial/offline_payments?page_type=history" class="nav-link">
                                <span>{{ trans('public.history') }}</span>
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan

            @can('admin_subscribe')
                <li class="nav-item dropdown {{ (request()->is('oraclepopupsignin/financial/subscribes*')) ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <i class="fas fa-cart-plus"></i>
                        <span>{{ trans('oraclepopupsignin/main.subscribes') }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        @can('admin_subscribe_list')
                            <li class="{{ (request()->is('oraclepopupsignin/financial/subscribes')) ? 'active' : '' }}">
                                <a class="nav-link" href="/oraclepopupsignin/financial/subscribes">{{ trans('oraclepopupsignin/main.packages') }}</a>
                            </li>
                        @endcan

                        @can('admin_subscribe_create')
                            <li class="{{ (request()->is('oraclepopupsignin/financial/subscribes/new')) ? 'active' : '' }}">
                                <a class="nav-link" href="/oraclepopupsignin/financial/subscribes/new">{{ trans('oraclepopupsignin/main.new_package') }}</a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan


              @can('admin_rewards')
                <li class="nav-item dropdown {{ (request()->is('oraclepopupsignin/rewards*')) ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <i class="fa fa-gift"></i>
                        <span>{{ trans('update.rewards') }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        @can('admin_rewards_history')
                            <li class="{{ (request()->is('oraclepopupsignin/rewards')) ? 'active' : '' }}">
                                <a class="nav-link" href="/oraclepopupsignin/rewards">{{ trans('public.history') }}</a>
                            </li>
                        @endcan
                        @can('admin_rewards_items')
                            <li class="{{ (request()->is('oraclepopupsignin/rewards/items')) ? 'active' : '' }}">
                                <a class="nav-link" href="/oraclepopupsignin/rewards/items">{{ trans('oraclepopupsignin/main.items') }}</a>
                            </li>
                        @endcan
                        @can('admin_rewards_settings')
                            <li class="{{ (request()->is('oraclepopupsignin/rewards/settings')) ? 'active' : '' }}">
                                <a class="nav-link" href="/oraclepopupsignin/rewards/settings">{{ trans('oraclepopupsignin/main.settings') }}</a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan

            @can('admin_registration_packages')
                <li class="nav-item dropdown {{ (request()->is('oraclepopupsignin/financial/registration-packages*')) ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <i class="fa fa-gem"></i>
                        <span>{{ trans('update.saas') }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        @can('admin_registration_packages_lists')
                            <li class="{{ (request()->is('oraclepopupsignin/financial/registration-packages')) ? 'active' : '' }}">
                                <a class="nav-link" href="/oraclepopupsignin/financial/registration-packages">{{ trans('oraclepopupsignin/main.packages') }}</a>
                            </li>
                        @endcan

                        @can('admin_registration_packages_new')
                            <li class="{{ (request()->is('oraclepopupsignin/financial/registration-packages/new')) ? 'active' : '' }}">
                                <a class="nav-link" href="/oraclepopupsignin/financial/registration-packages/new">{{ trans('oraclepopupsignin/main.new_package') }}</a>
                            </li>
                        @endcan

                        @can('admin_registration_packages_reports')
                            <li class="{{ (request()->is('oraclepopupsignin/financial/registration-packages/reports')) ? 'active' : '' }}">
                                <a class="nav-link" href="/oraclepopupsignin/financial/registration-packages/reports">{{ trans('oraclepopupsignin/main.reports') }}</a>
                            </li>
                        @endcan

                        @can('admin_registration_packages_settings')
                            <li class="{{ (request()->is('oraclepopupsignin/financial/registration-packages/settings')) ? 'active' : '' }}">
                                <a class="nav-link" href="/oraclepopupsignin/financial/registration-packages/settings">{{ trans('oraclepopupsignin/main.settings') }}</a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan

            @if($authUser->can('admin_discount_codes') or
                $authUser->can('admin_product_discount') or
                $authUser->can('admin_feature_webinars') or
                $authUser->can('admin_promotion') or
                $authUser->can('admin_advertising') or
                $authUser->can('admin_newsletters')
            )
                <li class="menu-header">{{ trans('oraclepopupsignin/main.marketing') }}</li>
            @endif

            @can('admin_discount_codes')
                <li class="nav-item dropdown {{ (request()->is('oraclepopupsignin/financial/discounts*')) ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <i class="fas fa-percent"></i>
                        <span>{{ trans('oraclepopupsignin/main.discount_codes_title') }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        @can('admin_discount_codes_list')
                            <li class="{{ (request()->is('oraclepopupsignin/financial/discounts')) ? 'active' : '' }}">
                                <a class="nav-link" href="/oraclepopupsignin/financial/discounts">{{ trans('oraclepopupsignin/main.lists') }}</a>
                            </li>
                        @endcan

                        @can('admin_discount_codes_create')
                            <li class="{{ (request()->is('oraclepopupsignin/financial/discounts/new')) ? 'active' : '' }}">
                                <a class="nav-link" href="/oraclepopupsignin/financial/discounts/new">{{ trans('oraclepopupsignin/main.new') }}</a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan

            @can('admin_product_discount')
                <li class="nav-item dropdown {{ (request()->is('oraclepopupsignin/financial/special_offers*')) ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <i class="fa fa-fire"></i>
                        <span>{{ trans('oraclepopupsignin/main.special_offers') }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        @can('admin_product_discount_list')
                            <li class="{{ (request()->is('oraclepopupsignin/financial/special_offers')) ? 'active' : '' }}">
                                <a class="nav-link" href="/oraclepopupsignin/financial/special_offers">{{ trans('oraclepopupsignin/main.lists') }}</a>
                            </li>
                        @endcan

                        @can('admin_product_discount_create')
                            <li class="{{ (request()->is('oraclepopupsignin/financial/special_offers/new')) ? 'active' : '' }}">
                                <a class="nav-link" href="/oraclepopupsignin/financial/special_offers/new">{{ trans('oraclepopupsignin/main.new') }}</a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan

            @can('admin_feature_webinars')
                <li class="nav-item dropdown {{ (request()->is('oraclepopupsignin/webinars/features*')) ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <i class="fas fa-star"></i>
                        <span>{{ trans('oraclepopupsignin/main.feature_webinars') }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        @can('admin_feature_webinars')
                            <li class="{{ (request()->is('oraclepopupsignin/webinars/features')) ? 'active' : '' }}">
                                <a class="nav-link" href="/oraclepopupsignin/webinars/features">{{ trans('oraclepopupsignin/main.lists') }}</a>
                            </li>
                        @endcan()

                        @can('admin_feature_webinars_create')
                            <li class="{{ (request()->is('oraclepopupsignin/webinars/features/create')) ? 'active' : '' }}">
                                <a class="nav-link" href="/oraclepopupsignin/webinars/features/create">{{ trans('oraclepopupsignin/main.new') }}</a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan

            @can('admin_promotion')
                <li class="nav-item dropdown {{ (request()->is('oraclepopupsignin/financial/promotions*')) ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <i class="fas fa-rocket"></i>
                        <span>{{ trans('oraclepopupsignin/main.content_promotion') }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        @can('admin_promotion_list')
                            <li class="{{ (request()->is('oraclepopupsignin/financial/promotions')) ? 'active' : '' }}">
                                <a class="nav-link" href="/oraclepopupsignin/financial/promotions">{{ trans('oraclepopupsignin/main.plans') }}</a>
                            </li>
                        @endcan
                        @can('admin_promotion_list')
                            <li class="{{ (request()->is('oraclepopupsignin/financial/promotions/sales')) ? 'active' : '' }}">
                                <a class="nav-link" href="/oraclepopupsignin/financial/promotions/sales">{{ trans('oraclepopupsignin/main.promotion_sales') }}</a>
                            </li>
                        @endcan

                        @can('admin_promotion_create')
                            <li class="{{ (request()->is('oraclepopupsignin/financial/promotions/new')) ? 'active' : '' }}">
                                <a class="nav-link" href="/oraclepopupsignin/financial/promotions/new">{{ trans('oraclepopupsignin/main.new_plan') }}</a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan

            @can('admin_advertising')
                <li class="nav-item dropdown {{ (request()->is('oraclepopupsignin/advertising*')) ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <i class="fas fa-file-image"></i>
                        <span>{{ trans('oraclepopupsignin/main.ad_banners') }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        @can('admin_advertising_banners')
                            <li class="{{ (request()->is('oraclepopupsignin/advertising/banners')) ? 'active' : '' }}">
                                <a class="nav-link" href="/oraclepopupsignin/advertising/banners">{{ trans('oraclepopupsignin/main.list') }}</a>
                            </li>
                        @endcan

                        @can('admin_advertising_banners_create')
                            <li class="{{ (request()->is('oraclepopupsignin/advertising/banners/new')) ? 'active' : '' }}">
                                <a class="nav-link" href="/oraclepopupsignin/advertising/banners/new">{{ trans('oraclepopupsignin/main.new') }}</a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan

            @can('admin_newsletters')
                <li class="nav-item dropdown {{ (request()->is('oraclepopupsignin/newsletters*')) ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <i class="fas fa-newspaper"></i>
                        <span>{{ trans('oraclepopupsignin/main.newsletters') }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        @can('admin_newsletters_lists')
                            <li class="{{ (request()->is('oraclepopupsignin/newsletters')) ? 'active' : '' }}">
                                <a class="nav-link" href="/oraclepopupsignin/newsletters">{{ trans('oraclepopupsignin/main.list') }}</a>
                            </li>
                        @endcan

                        @can('admin_newsletters_send')
                            <li class="{{ (request()->is('oraclepopupsignin/newsletters/send')) ? 'active' : '' }}">
                                <a class="nav-link" href="/oraclepopupsignin/newsletters/send">{{ trans('oraclepopupsignin/main.send') }}</a>
                            </li>
                        @endcan

                        @can('admin_newsletters_history')
                            <li class="{{ (request()->is('oraclepopupsignin/newsletters/history')) ? 'active' : '' }}">
                                <a class="nav-link" href="/oraclepopupsignin/newsletters/history">{{ trans('public.history') }}</a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan

            @can('admin_referrals')
                <li class="nav-item dropdown {{ (request()->is('oraclepopupsignin/referrals*')) ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <i class="fa fa-bullhorn"></i>
                        <span>{{ trans('oraclepopupsignin/main.affiliate') }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        @can('admin_referrals_history')
                            <li class="{{ (request()->is('oraclepopupsignin/referrals/history')) ? 'active' : '' }}">
                                <a class="nav-link" href="/oraclepopupsignin/referrals/history">{{ trans('public.history') }}</a>
                            </li>
                        @endcan

                        @can('admin_referrals_users')
                            <li class="{{ (request()->is('oraclepopupsignin/referrals/users')) ? 'active' : '' }}">
                                <a class="nav-link" href="/oraclepopupsignin/referrals/users">{{ trans('oraclepopupsignin/main.affiliate_users') }}</a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan

            @if($authUser->can('admin_settings'))
                <li class="menu-header">{{ trans('oraclepopupsignin/main.settings') }}</li>
            @endif

            @can('admin_settings')
                @php
                    $settingClass ='';

                    if (request()->is('oraclepopupsignin/settings*') and
                            !(
                                request()->is('oraclepopupsignin/settings/404') or
                                request()->is('oraclepopupsignin/settings/contact_us') or
                                request()->is('oraclepopupsignin/settings/footer') or
                                request()->is('oraclepopupsignin/settings/navbar_links')
                            )
                        ) {
                            $settingClass = 'active';
                        }
                @endphp

                <li class="{{ $settingClass ?? '' }}">
                    <a href="/oraclepopupsignin/settings" class="nav-link">
                        <i class="fas fa-cogs"></i>
                        <span>{{ trans('oraclepopupsignin/main.settings') }}</span>
                    </a>
                </li>
            @endcan()


            <li>
                <a class="nav-link" href="/oraclepopupsignin/logout">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </li>

        </ul>
        <br><br><br>
    </aside>
</div>
