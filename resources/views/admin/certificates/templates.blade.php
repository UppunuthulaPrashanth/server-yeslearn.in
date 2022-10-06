@extends('admin.layouts.app')

@push('libraries_top')

@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ trans('oraclepopupsignin/main.certificates_templates') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/oraclepopupsignin/">{{trans('oraclepopupsignin/main.dashboard')}}</a>
                </div>
                <div class="breadcrumb-item">{{ trans('oraclepopupsignin/main.certificates_templates') }}</div>
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
                                        <th class="text-left">{{ trans('oraclepopupsignin/main.title') }}</th>
                                        <th>{{ trans('oraclepopupsignin/main.status') }}</th>
                                        <th>{{ trans('oraclepopupsignin/main.action') }}</th>
                                    </tr>

                                    @foreach($templates as $template)
                                        <tr>
                                            <td>
                                                <span>{{ $template->title }}</span>
                                            </td>

                                            <td>
                                                <span class="text-{{ ($template->status == 'publish') ? 'success' : '' }}">{{ trans('oraclepopupsignin/main.'.$template->status) }}</span>
                                            </td>

                                            <td>
                                                @can('admin_certificate_template_edit')
                                                    <a href="/oraclepopupsignin/certificates/templates/{{ $template->id }}/edit" class="btn-transparent text-primary" data-toggle="tooltip" data-placement="top" title="{{ trans('oraclepopupsignin/main.edit') }}">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                @endcan

                                                @can('admin_certificate_template_delete')
                                                    @include('admin.includes.delete_button',['url' => '/oraclepopupsignin/certificates/templates/'. $template->id .'/delete','btnClass' => ''])
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach

                                </table>
                            </div>
                        </div>

                        <div class="card-footer text-center">
                            {{ $templates->appends(request()->input())->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

