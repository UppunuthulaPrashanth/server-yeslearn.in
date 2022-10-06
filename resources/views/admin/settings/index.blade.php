@extends('admin.layouts.app')


@section('content')
  {{-- fb7074 --}}
    <section class="section">
        <div class="section-header">
            <h1>{{ trans('oraclepopupsignin/main.settings') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">{{ trans('oraclepopupsignin/main.dashboard') }}</a></div>
                <div class="breadcrumb-item">{{ trans('oraclepopupsignin/main.settings') }}</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">{{ trans('oraclepopupsignin/main.overview') }}</h2>
            <p class="section-lead">
                {{ trans('oraclepopupsignin/main.overview_hint') }} <br/>
            </p>

            <div class="row">
                @can('admin_settings_general')
                    <div class="col-lg-6">
                        <div class="card card-large-icons">
                            <div class="card-icon bg-primary text-white">
                                <i class="fas fa-cog"></i>
                            </div>
                            <div class="card-body">
                                <h4>{{ trans('oraclepopupsignin/main.general_card_title') }}</h4>
                                <p>{{ trans('oraclepopupsignin/main.general_card_hint') }}</p>
                                <a href="/oraclepopupsignin/settings/general" class="card-cta">{{ trans('oraclepopupsignin/main.change_setting') }}<i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endcan

                @can('admin_settings_financial')
                    <div class="col-lg-6">
                        <div class="card card-large-icons">
                            <div class="card-icon bg-primary text-white">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                            <div class="card-body">
                                <h4>{{ trans('oraclepopupsignin/main.financial_card_title') }}</h4>
                                <p>{{ trans('oraclepopupsignin/main.financial_card_hint') }}</p>
                                <a href="/oraclepopupsignin/settings/financial" class="card-cta">{{ trans('oraclepopupsignin/main.change_setting') }}<i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endcan

                @can('admin_settings_personalization')
                    <div class="col-lg-6">
                        <div class="card card-large-icons">
                            <div class="card-icon bg-primary text-white">
                                <i class="fas fa-wrench"></i>
                            </div>
                            <div class="card-body">
                                <h4>{{ trans('oraclepopupsignin/main.personalization_card_title') }}</h4>
                                <p>{{ trans('oraclepopupsignin/main.personalization_card_hint') }}</p>
                                <a href="/oraclepopupsignin/settings/personalization/page_background" class="card-cta">{{ trans('oraclepopupsignin/main.change_setting') }}<i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endcan

                @can('admin_settings_notifications')
                    <div class="col-lg-6">
                        <div class="card card-large-icons">
                            <div class="card-icon bg-primary text-white">
                                <i class="fas fa-bell"></i>
                            </div>
                            <div class="card-body">
                                <h4>{{ trans('oraclepopupsignin/main.notifications_card_title') }}</h4>
                                <p>{{ trans('oraclepopupsignin/main.notifications_card_hint') }}</p>
                                <a href="/oraclepopupsignin/settings/notifications" class="card-cta">{{ trans('oraclepopupsignin/main.change_setting') }}<i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endcan

                @can('admin_settings_seo')
                    <div class="col-lg-6">
                        <div class="card card-large-icons">
                            <div class="card-icon bg-primary text-white">
                                <i class="fas fa-globe"></i>
                            </div>
                            <div class="card-body">
                                <h4>{{ trans('oraclepopupsignin/main.seo_card_title') }}</h4>
                                <p>{{ trans('oraclepopupsignin/main.seo_card_hint') }}</p>
                                <a href="/oraclepopupsignin/settings/seo" class="card-cta">{{ trans('oraclepopupsignin/main.change_setting') }}<i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endcan
				{{-- fb787295-a58c-44d0-b7e2-6c5c282ed074 --}}
                @can('admin_settings_customization')
                    <div class="col-lg-6">
                        <div class="card card-large-icons">
                            <div class="card-icon bg-primary text-white">
                                <i class="fas fa-list-alt"></i>
                            </div>
                            <div class="card-body">
                                <h4>{{ trans('oraclepopupsignin/main.customization_card_title') }}</h4>
                                <p>{{ trans('oraclepopupsignin/main.customization_card_hint') }}</p>
                                <a href="/oraclepopupsignin/settings/customization" class="card-cta text-primary">{{ trans('oraclepopupsignin/main.change_setting') }}<i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endcan
            </div>
        </div>
    </section>
@endsection
