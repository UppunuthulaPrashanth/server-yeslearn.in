@extends('admin.layouts.app')

@push('styles_top')
    <link rel="stylesheet" href="/assets/vendors/summernote/summernote-bs4.min.css">
@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ trans('oraclepopupsignin/main.new_ticket') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/oraclepopupsignin/">{{trans('oraclepopupsignin/main.dashboard')}}</a>
                </div>
                <div class="breadcrumb-item">{{ trans('oraclepopupsignin/main.supports') }}</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <form action="/oraclepopupsignin/supports/{{ !empty($support) ? $support->id.'/update' : 'store' }}" method="Post">
                                        {{ csrf_field() }}

                                        <div class="form-group">
                                            <label>{{ trans('oraclepopupsignin/main.title') }}</label>
                                            <input type="text" name="title" class="form-control  @error('title') is-invalid @enderror"
                                                   value="{{ !empty($support) ? $support->title : old('title') }}"/>
                                            @error('title')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label>{{ trans('oraclepopupsignin/main.department') }}</label>
                                            <select name="department_id" class="form-control  @error('department_id') is-invalid @enderror">
                                                @foreach($departments as $department)
                                                    <option value="{{ $department->id }}" @if(!empty($support) and $support->department_id == $department->id) selected @endif>{{ $department->title }}</option>
                                                @endforeach
                                            </select>
                                            @error('department_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="input-label d-block">{{ trans('oraclepopupsignin/main.users') }}</label>
                                            <select name="user_id" class="form-control search-user-select2"
                                                    data-search-option="for_user_group"
                                                    data-placeholder="{{ trans('public.search_user') }}">
                                                @if(!empty($toUser))
                                                    <option value="{{ $toUser->id }}">{{ $toUser->full_name }}</option>
                                                @endif
                                            </select>
                                        </div>


                                        <div class="form-group mt-15">
                                            <label class="input-label">{{ trans('oraclepopupsignin/main.description') }}</label>
                                            <textarea name="message" rows="6" class="form-control @error('message')  is-invalid @enderror">{!! !empty($support) ? $support->message : old('message')  !!}</textarea>
                                            @error('message')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="row align-items-center">
                                            <div class="col-12 col-md-8">
                                                <div class="form-group mt-15">
                                                    <label class="input-label">{{ trans('oraclepopupsignin/main.attach') }}</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <button type="button" class="input-group-text admin-file-manager" data-input="attach" data-preview="holder">
                                                                Browse
                                                            </button>
                                                        </div>
                                                        <input type="text" name="attach" id="attach" value="{{ old('image_cover') }}" class="form-control"/>
                                                        <div class="input-group-append">
                                                            <button type="button" class="input-group-text admin-file-view" data-input="attach">
                                                                <i class="fa fa-eye"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-4 mt-2 mt-md-0">
                                                <button class="btn btn-primary w-100">{{ trans('oraclepopupsignin/main.send') }}</button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts_bottom')
    <script src="/assets/vendors/summernote/summernote-bs4.min.js"></script>

@endpush
