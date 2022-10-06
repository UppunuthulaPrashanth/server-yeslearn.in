@extends('admin.layouts.app')

@push('libraries_top')

@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ trans('oraclepopupsignin/main.templates') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/oraclepopupsignin/">{{trans('oraclepopupsignin/main.dashboard')}}</a>
                </div>
                <div class="breadcrumb-item">{{ trans('oraclepopupsignin/main.templates') }}</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped font-14" id="datatable-basic">

                        <tr>
                            <th>{{ trans('oraclepopupsignin/main.title') }}</th>
                            <th>{{ trans('oraclepopupsignin/main.actions') }}</th>
                        </tr>

                        @foreach($templates as $template)
                            <tr>
                                <td>{{ $template->title }}</td>

                                <td width="100">
                                    @can('admin_notifications_template_edit')
                                        <a href="/oraclepopupsignin/notifications/templates/{{ $template->id }}/edit" class="btn-transparent btn-sm text-primary" data-toggle="tooltip" data-placement="top" title="{{ trans('oraclepopupsignin/main.edit') }}">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    @endcan

                                    @can('admin_notifications_template_delete')
                                        @include('admin.includes.delete_button',['url' => '/oraclepopupsignin/notifications/templates/'. $template->id.'/delete','btnClass' => 'btn-sm'])
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>

                <div class="card-footer text-center">
                    {{ $templates->appends(request()->input())->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection

