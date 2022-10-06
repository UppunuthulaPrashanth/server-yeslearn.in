@extends('admin.layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ trans('oraclepopupsignin/main.new_subscribe') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/oraclepopupsignin/">{{trans('oraclepopupsignin/main.dashboard')}}</a>
                </div>
                <div class="breadcrumb-item">{{ trans('oraclepopupsignin/main.subscribes') }}</div>
            </div>
        </div>


        <div class="section-body card">

            <div class="d-flex align-items-center justify-content-between">
                <div class="">
                    <h2 class="section-title ml-4">{{ !empty($subscribe) ? trans('oraclepopupsignin/main.edit') : trans('oraclepopupsignin/main.create') }}</h2>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-md-8 col-lg-6">
                        <div class="card-body">
                            <form action="/oraclepopupsignin/financial/subscribes/{{ !empty($subscribe) ? $subscribe->id.'/update' : 'store' }}" method="Post">
                                {{ csrf_field() }}

                                @if(!empty(getGeneralSettings('content_translate')))
                                    <div class="form-group">
                                        <label class="input-label">{{ trans('auth.language') }}</label>
                                        <select name="locale" class="form-control {{ !empty($subscribe) ? 'js-edit-content-locale' : '' }}">
                                            @foreach($userLanguages as $lang => $language)
                                                <option value="{{ $lang }}" @if(mb_strtolower(request()->get('locale', app()->getLocale())) == mb_strtolower($lang)) selected @endif>{{ $language }}</option>
                                            @endforeach
                                        </select>
                                        @error('locale')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                @else
                                    <input type="hidden" name="locale" value="{{ getDefaultLocale() }}">
                                @endif


                                <div class="form-group">
                                    <label>{{ trans('oraclepopupsignin/main.title') }}</label>
                                    <input type="text" name="title"
                                           class="form-control  @error('title') is-invalid @enderror"
                                           value="{{ !empty($subscribe) ? $subscribe->title : old('title') }}"/>
                                    @error('title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>{{ trans('oraclepopupsignin/main.short_description') }} ({{ trans('oraclepopupsignin/main.optional') }})</label>
                                    <input type="text" name="description"
                                           class="form-control "
                                           value="{{ !empty($subscribe) ? $subscribe->description : old('description') }}"
                                           placeholder="{{ trans('oraclepopupsignin/main.short_description_placeholder') }}"
                                    />
                                </div>


                                <div class="form-group">
                                    <label>{{ trans('oraclepopupsignin/main.usable_count') }}</label>
                                    <input type="text" name="usable_count"
                                           class="form-control  @error('usable_count') is-invalid @enderror"
                                           value="{{ !empty($subscribe) ? $subscribe->usable_count : old('usable_count') }}"/>
                                    @error('usable_count')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>{{ trans('oraclepopupsignin/main.days') }}</label>
                                    <input type="text" name="days"
                                           class="form-control  @error('days') is-invalid @enderror"
                                           value="{{ !empty($subscribe) ? $subscribe->days : old('days') }}"/>
                                    @error('days')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label>{{ trans('oraclepopupsignin/main.price') }}</label>
                                    <input type="text" name="price"
                                           class="form-control  @error('price') is-invalid @enderror"
                                           value="{{ !empty($subscribe) ? $subscribe->price : old('price') }}"/>
                                    @error('price')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group mt-15">
                                    <label class="input-label">{{ trans('oraclepopupsignin/main.icon') }}</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <button type="button" class="input-group-text admin-file-manager" data-input="icon" data-preview="holder">
                                                <i class="fa fa-chevron-up"></i>
                                            </button>
                                        </div>
                                        <input type="text" name="icon" id="icon" value="{{ !empty($subscribe->icon) ? $subscribe->icon : old('icon') }}" class="form-control @error('icon') is-invalid @enderror"/>
                                        @error('icon')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                        <div class="input-group-append">
                                            <button type="button" class="input-group-text admin-file-view" data-input="icon">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group custom-switches-stacked">
                                    <label class="custom-switch pl-0">
                                        <input type="hidden" name="is_popular" value="0">
                                        <input type="checkbox" name="is_popular" id="isPopular" value="1" {{ (!empty($subscribe) and $subscribe->is_popular) ? 'checked="checked"' : '' }} class="custom-switch-input"/>
                                        <span class="custom-switch-indicator"></span>
                                        <label class="custom-switch-description mb-0 cursor-pointer" for="isPopular">{{ trans('oraclepopupsignin/pages/financial.is_popular') }}</label>
                                    </label>
                                </div>

                                <div class=" mt-4">
                                    <button class="btn btn-primary">{{ trans('oraclepopupsignin/main.submit') }}</button>
                                </div>
                            </form>
                        </div>
                </div>
            </div>
        </div>
    </section>
@endsection
