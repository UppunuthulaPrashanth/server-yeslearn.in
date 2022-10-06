@extends('admin.layouts.app')


@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ trans('oraclepopupsignin/main.settings_navbar_links') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/oraclepopupsignin/">{{ trans('oraclepopupsignin/main.dashboard') }}</a></div>
                <div class="breadcrumb-item">{{ trans('oraclepopupsignin/main.settings_navbar_links') }}</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-12 col-md-8 col-lg-6">
                                    <form action="/oraclepopupsignin/additional_page/navbar_links/store" method="post">
                                        {{ csrf_field() }}

                                        <input type="hidden" name="navbar_link" value="{{ !empty($navbarLinkKey) ? $navbarLinkKey : 'newLink' }}">

                                        @if(!empty(getGeneralSettings('content_translate')))
                                            <div class="form-group">
                                                <label class="input-label">{{ trans('auth.language') }}</label>
                                                <select name="locale" class="form-control js-edit-content-locale">
                                                    @foreach($userLanguages as $lang => $language)
                                                        <option value="{{ $lang }}" @if(mb_strtolower(request()->get('locale', $selectedLocal)) == mb_strtolower($lang)) selected @endif>{{ $language }}</option>
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
                                            <input type="text" name="value[title]" value="{{ (!empty($navbar_link)) ? $navbar_link->title : old('value.title') }}" class="form-control  @error('value.title') is-invalid @enderror"/>
                                            @error('value.title')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label>{{ trans('public.link') }}</label>
                                            <input type="text" name="value[link]" value="{{ (!empty($navbar_link)) ? $navbar_link->link : old('value.link') }}" class="form-control  @error('value.link') is-invalid @enderror"/>
                                            @error('value.link')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label>{{ trans('oraclepopupsignin/main.order') }}</label>
                                            <input type="number" name="value[order]" value="{{ (!empty($navbar_link)) ? $navbar_link->order : old('value.order') }}" class="form-control  @error('value.order') is-invalid @enderror"/>
                                            @error('value.order')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                        <button type="submit" class="btn btn-primary mt-1">{{ trans('oraclepopupsignin/main.submit') }}</button>
                                    </form>
                                </div>
                            </div>

                            <div class="table-responsive mt-4">
                                <table class="table table-striped font-14">
                                    <tr>
                                        <th>{{ trans('oraclepopupsignin/main.title') }}</th>
                                        <th>{{ trans('oraclepopupsignin/main.link') }}</th>
                                        <th>{{ trans('oraclepopupsignin/main.order') }}</th>
                                        <th>{{ trans('oraclepopupsignin/main.actions') }}</th>
                                    </tr>

                                    @if(!empty($items))
                                        @foreach($items as $key => $val)
                                            <tr>
                                                <td>{{ $val['title'] }}</td>
                                                <td>{{ $val['link'] }}</td>
                                                <td>{{ $val['order'] }}</td>
                                                <td>
                                                    <a href="/oraclepopupsignin/additional_page/navbar_links/{{ $key }}/edit" class="btn-sm" data-toggle="tooltip" data-placement="top" title="{{ trans('oraclepopupsignin/main.edit') }}">
                                                        <i class="fa fa-edit"></i>
                                                    </a>

                                                    @include('admin.includes.delete_button',['url' => '/oraclepopupsignin/additional_page/navbar_links/'. $key .'/delete','btnClass' => 'btn-sm'])
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif

                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
