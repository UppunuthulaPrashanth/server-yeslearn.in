@extends('admin.layouts.app')

@push('styles_top')
    <link rel="stylesheet" href="/assets/default/vendors/select2/select2.min.css">
@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ trans('oraclepopupsignin/main.financial_settings') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/oraclepopupsignin/">{{ trans('oraclepopupsignin/main.dashboard') }}</a></div>
                <div class="breadcrumb-item active"><a href="/oraclepopupsignin/settings">{{ trans('oraclepopupsignin/main.settings') }}</a></div>
                <div class="breadcrumb-item ">{{ trans('oraclepopupsignin/main.financial') }}</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <ul class="nav nav-pills" id="myTab3" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link  @if(empty(request()->get('page'))) active @endif" id="basic-tab" data-toggle="tab" href="#basic" role="tab" aria-controls="basic" aria-selected="true">{{ trans('oraclepopupsignin/main.basic') }}</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link " id="offline_banks_credits-tab" data-toggle="tab" href="#offline_banks_credits" role="tab" aria-controls="offline_banks_credits" aria-selected="true">{{ trans('oraclepopupsignin/main.offline_banks_credits') }}</a>
                                </li>

                                @can('admin_payment_channel')
                                    <li class="nav-item">
                                        <a class="nav-link @if(!empty(request()->get('page'))) active @endif" id="payment_channels-tab" data-toggle="tab" href="#payment_channels" role="tab" aria-controls="payment_channels" aria-selected="true">{{ trans('oraclepopupsignin/main.payment_channels') }}</a>
                                    </li>
                                @endcan

                                <li class="nav-item">
                                    <a class="nav-link " id="referral-tab" data-toggle="tab" href="#referral" role="tab" aria-controls="referral" aria-selected="true">{{ trans('oraclepopupsignin/main.referral') }}</a>
                                </li>
                            </ul>

                            <div class="tab-content" id="myTabContent2">
                                @include('admin.settings.financial.basic',['itemValue' => (!empty($settings) and !empty($settings['financial'])) ? $settings['financial']->value : ''])
                                @include('admin.settings.financial.site_bank_accounts',['itemValue' => (!empty($settings) and !empty($settings['site_bank_accounts'])) ? $settings['site_bank_accounts']->value : ''])

                                @can('admin_payment_channel')
                                    @include('admin.settings.financial.payment_channel.lists')
                                @endcan

                                @include('admin.settings.financial.referral',['itemValue' => (!empty($settings) and !empty($settings['referral'])) ? $settings['referral']->value : ''])
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
