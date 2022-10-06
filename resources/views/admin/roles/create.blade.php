@extends('admin.layouts.app')

@push('libraries_top')


@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{!empty($role) ?trans('/oraclepopupsignin/main.edit'): trans('oraclepopupsignin/main.new') }} {{ trans('oraclepopupsignin/main.role') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/oraclepopupsignin/">{{ trans('oraclepopupsignin/main.dashboard') }}</a>
                </div>
                <div class="breadcrumb-item active"><a href="/oraclepopupsignin/roles">{{ trans('oraclepopupsignin/main.roles') }}</a>
                </div>
                <div class="breadcrumb-item">{{!empty($role) ?trans('/oraclepopupsignin/main.edit'): trans('oraclepopupsignin/main.new') }}</div>
            </div>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="/oraclepopupsignin/roles/{{ !empty($role) ? $role->id.'/update' : 'store' }}" method="Post">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <div class="row">
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group @error('name') is-invalid @enderror">
                                            @if(empty($role))
                                                <label>{{ trans('oraclepopupsignin/main.name') }}</label>
                                            @endif
                                            <input type="{{ !empty($role) ? 'hidden' : 'text' }}" name="name" class="form-control"
                                                   value="{{ !empty($role) ? $role->name : old('name') }}"
                                                   placeholder=""/>
                                        </div>

                                        @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror

                                        <div class="form-group @error('caption') is-invalid @enderror">
                                            <label>{{ trans('oraclepopupsignin/main.caption') }}</label>
                                            <input type="text" name="caption" class="form-control" value="{{ !empty($role) ? $role->caption : old('caption') }}"
                                                   placeholder="{{ trans('oraclepopupsignin/main.create_field_name_placeholder') }}"/>

                                            @error('caption')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                        @if(empty($role) or !$role->isDefaultRole())
                                            <div class="form-group mb-1">
                                                <label class="custom-switch pl-0">
                                                    <input id="isAdmin" type="checkbox" name="is_admin" class="custom-switch-input section-parent" {{ (!empty($role) && $role->is_admin) ? 'checked' : '' }}>
                                                    <span class="custom-switch-indicator"></span>
                                                    <span class="custom-switch-description">{{ trans('oraclepopupsignin/main.is_admin') }}</span>
                                                </label>
                                            </div>
                                            <div class="text-muted text-small mt-1">{{ trans('oraclepopupsignin/main.new_role_admin_access_hint') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group {{ (!empty($role) && $role->is_admin) ? '' :'d-none'}}" id="sections">

                                    <h2 class="section-title">{{ trans('oraclepopupsignin/main.permission') }}</h2>
                                    <p class="section-lead">
                                        {{ trans('oraclepopupsignin/main.permission_description') }}
                                    </p>

                                    <div class="row">
                                        @foreach($sections as $section)
                                            <div class="col-12 col-md-6 col-lg-4">
                                                <div class="card card-primary section-box">
                                                    <div class="card-header">
                                                        <input type="checkbox" name="permissions[]" id="permissions_{{ $section->id }}" value="{{ $section->id }}"
                                                               {{isset($permissions[$section->id]) ? 'checked' : ''}} class="form-check-input mt-0 section-parent">
                                                        <label class="form-check-label font-16 font-weight-bold cursor-pointer" for="permissions_{{ $section->id }}">
                                                            {{ $section->caption }}
                                                        </label>
                                                    </div>

                                                    @if(!empty($section->children))
                                                        <div class="card-body">

                                                            @foreach($section->children as $key => $child)
                                                                <div class="form-check mt-1">
                                                                    <input type="checkbox" name="permissions[]" id="permissions_{{ $child->id }}" value="{{ $child->id }}"
                                                                           {{ isset($permissions[$child->id]) ? 'checked' : '' }} class="form-check-input section-child">
                                                                    <label class="form-check-label cursor-pointer mt-0" for="permissions_{{ $child->id }}">
                                                                        {{ $child->caption }}
                                                                    </label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class=" mt-4">
                                    <button class="btn btn-primary">{{ trans('oraclepopupsignin/main.submit') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts_bottom')
    <script src="/assets/default/js/admin/roles.min.js"></script>
@endpush
