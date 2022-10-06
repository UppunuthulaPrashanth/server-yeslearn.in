@extends('admin.layouts.app')

@push('styles_top')
    <link rel="stylesheet" href="/assets/default/vendors/select2/select2.min.css">
@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ trans('oraclepopupsignin/main.main_general') }} {{ trans('oraclepopupsignin/main.settings') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/oraclepopupsignin/">{{ trans('oraclepopupsignin/main.dashboard') }}</a></div>
                <div class="breadcrumb-item active"><a href="/oraclepopupsignin/settings">{{ trans('oraclepopupsignin/main.settings') }}</a></div>
                <div class="breadcrumb-item ">{{ trans('oraclepopupsignin/main.main_general') }}</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <ul class="nav nav-pills" id="myTab3" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link @if(empty($social)) active @endif" id="basic-tab" data-toggle="tab" href="#basic" role="tab" aria-controls="basic" aria-selected="true">{{ trans('oraclepopupsignin/main.basic') }}</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link @if(!empty($social)) active @endif" id="socials-tab" data-toggle="tab" href="#socials" role="tab" aria-controls="socials" aria-selected="true">{{ trans('oraclepopupsignin/main.socials') }}</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="socials-tab" data-toggle="tab" href="#features" role="tab" aria-controls="features" aria-selected="true">{{ trans('update.features') }}</a>
                                </li>
                            </ul>

                            <div class="tab-content" id="myTabContent2">
                                @include('admin.settings.general.basic',['itemValue' => (!empty($settings) and !empty($settings['general'])) ? $settings['general']->value : ''])
                                @include('admin.settings.general.socials',['itemValue' => (!empty($settings) and !empty($settings['socials'])) ? $settings['socials']->value : ''])
                                @include('admin.settings.general.features',['itemValue' => (!empty($settings) and !empty($settings['features'])) ? $settings['features']->value : ''])
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts_bottom')
    <script src="/assets/default/vendors/select2/select2.min.js"></script>
@endpush