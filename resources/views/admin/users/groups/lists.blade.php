@extends('admin.layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ trans('oraclepopupsignin/main.users_groups') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/oraclepopupsignin/">{{trans('oraclepopupsignin/main.dashboard')}}</a>
                </div>
                <div class="breadcrumb-item">{{ trans('oraclepopupsignin/main.users_groups') }}</div>
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
                                        <th class="text-left">{{ trans('oraclepopupsignin/main.name') }}</th>
                                        <th>{{ trans('oraclepopupsignin/main.users') }}</th>
                                        <th>{{ trans('oraclepopupsignin/main.commission') }}</th>
                                        <th>{{ trans('oraclepopupsignin/main.discount') }}</th>
                                        <th>{{ trans('oraclepopupsignin/main.status') }}</th>
                                        <th>{{ trans('oraclepopupsignin/main.actions') }}</th>
                                    </tr>

                                    @foreach($groups as $group)
                                        <tr>
                                            <td>{{ $group->id }}</td>
                                            <td class="text-left">
                                                <span>{{ $group->name }}</span>
                                            </td>
                                            <td>{{ $group->groupUsers->count() }}</td>
                                            <td>{{ $group->commission ?? 0 }}%</td>
                                            <td>{{ $group->discount ?? 0 }}%</td>
                                            <td>
                                                <span class="{{ $group->status == 'active' ? 'text-success' : 'text-danger' }}">{{ trans('oraclepopupsignin/main.'.$group->status) }}</span>
                                            </td>
                                            <td>
                                                @can('admin_group_edit')
                                                    <a href="/oraclepopupsignin/users/groups/{{ $group->id }}/edit" class="btn-transparent text-primary" data-toggle="tooltip" data-placement="top" title="{{ trans('oraclepopupsignin/main.edit') }}">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                @endcan

                                                @can('admin_group_delete')
                                                    @include('admin.includes.delete_button',['url' => '/oraclepopupsignin/users/groups/'. $group->id.'/delete','btnClass' => ''])
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach

                                </table>
                            </div>
                        </div>

                        <div class="card-footer text-center">
                            {{ $groups->appends(request()->input())->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts_bottom')

@endpush
