@extends('admin.layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ trans('oraclepopupsignin/main.subscribe_packages') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/oraclepopupsignin/">{{trans('oraclepopupsignin/main.dashboard')}}</a>
                </div>
                <div class="breadcrumb-item">{{ trans('oraclepopupsignin/main.subscribe_packages') }}</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped font-14">
                                    <tr>
                                        <th>#</th>
                                        <th class="text-left">{{ trans('oraclepopupsignin/main.title') }}</th>
                                        <th class="text-center">{{ trans('oraclepopupsignin/main.price') }}</th>
                                        <th class="text-center">{{ trans('oraclepopupsignin/main.usable_count') }}</th>
                                        <th class="text-center">{{ trans('public.days') }}</th>
                                        <th class="text-center">{{ trans('oraclepopupsignin/main.sale_count') }}</th>
                                        <th class="text-center">{{ trans('oraclepopupsignin/main.is_popular') }}</th>
                                        <th class="text-center">{{ trans('oraclepopupsignin/main.created_at') }}</th>
                                        <th>{{ trans('oraclepopupsignin/main.actions') }}</th>
                                    </tr>

                                    @foreach($subscribes as $subscribe)
                                        <tr>
                                            <td>
                                                <img src="{{ $subscribe->icon }}" width="50" height="50" alt="">
                                            </td>
                                            <td class="text-left">{{ $subscribe->title }}</td>
                                            <td class="text-center">{{ addCurrencyToPrice($subscribe->price) }}</td>
                                            <td class="text-center">{{ $subscribe->usable_count }}</td>
                                            <td class="text-center">{{ $subscribe->days }}</td>
                                            <td class="text-center">{{ $subscribe->sales->count() }}</td>
                                            <td class="text-center">
                                                @if($subscribe->is_popular)
                                                    <span class="text-success">{{ trans('oraclepopupsignin/main.yes') }}</span>
                                                @else
                                                    <span class="">{{ trans('oraclepopupsignin/main.no') }}</span>
                                                @endif
                                            </td>
                                            <td class="text-center">{{ dateTimeFormat($subscribe->created_at, 'Y M j | H:i') }}</td>
                                            <td>
                                                @can('admin_subscribe_edit')
                                                    <a href="/oraclepopupsignin/financial/subscribes/{{ $subscribe->id }}/edit" class="btn-sm" data-toggle="tooltip" data-placement="top" title="{{ trans('oraclepopupsignin/main.edit') }}">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                @endcan

                                                @can('admin_subscribe_delete')
                                                    @include('admin.includes.delete_button',['url' => '/oraclepopupsignin/financial/subscribes/'. $subscribe->id.'/delete','btnClass' => 'btn-sm'])
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach

                                </table>
                            </div>
                        </div>

                        <div class="card-footer text-center">
                            {{ $subscribes->appends(request()->input())->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="card">
        <div class="card-body">
            <div class="section-title ml-0 mt-0 mb-3"><h5>{{trans('oraclepopupsignin/main.hints')}}</h5></div>
            <div class="row">
                <div class="col-md-6">
                    <div class="media-body">
                        <div class="text-primary mt-0 mb-1 font-weight-bold">{{trans('oraclepopupsignin/main.subscribes_list_hint_title_1')}}</div>
                        <div class=" text-small font-600-bold">{{trans('oraclepopupsignin/main.subscribes_list_hint_description_1')}}</div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="media-body">
                        <div class="text-primary mt-0 mb-1 font-weight-bold">{{trans('oraclepopupsignin/main.subscribes_list_hint_title_2')}}</div>
                        <div class=" text-small font-600-bold">{{trans('oraclepopupsignin/main.subscribes_list_hint_description_2')}}</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

