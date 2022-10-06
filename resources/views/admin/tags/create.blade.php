@extends('admin.layouts.app')

@push('libraries_top')


@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{!empty($tag) ?trans('/oraclepopupsignin/main.edit'): trans('oraclepopupsignin/main.new') }} {{ trans('oraclepopupsignin/main.tag') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/oraclepopupsignin/">{{ trans('oraclepopupsignin/main.dashboard') }}</a>
                </div>
                <div class="breadcrumb-item active"><a href="/oraclepopupsignin/tags">{{ trans('oraclepopupsignin/main.tags') }}</a>
                </div>
                <div
                    class="breadcrumb-item">{{!empty($tag) ?trans('/oraclepopupsignin/main.edit'): trans('oraclepopupsignin/main.new') }}</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <form action="/oraclepopupsignin/tags/{{ !empty($tag) ? $tag->id.'/update' : 'store' }}"
                                  method="Post">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label>{{ trans('/oraclepopupsignin/main.title') }}</label>
                                    <input type="text" name="title"
                                           class="form-control  @error('title') is-invalid @enderror"
                                           value="{{ !empty($tag) ? $tag->title : old('title') }}"
                                           placeholder="{{ trans('oraclepopupsignin/main.create_field_title_placeholder') }}"/>
                                    @error('title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
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

@endpush
