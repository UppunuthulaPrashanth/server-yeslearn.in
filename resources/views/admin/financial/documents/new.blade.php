@extends('admin.layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ trans('oraclepopupsignin/main.new_document') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/oraclepopupsignin/">{{trans('oraclepopupsignin/main.dashboard')}}</a>
                </div>
                <div class="breadcrumb-item">{{ trans('oraclepopupsignin/main.new_document') }}</div>
            </div>
        </div>


        <div class="section-body card">



            <div class="row">
                <div class="col-12 col-md-6">
                        <div class="card-body">

                            <form action="/oraclepopupsignin/financial/documents/store" method="post">
                                {{ csrf_field() }}

                                <div class="form-group">
                                    <label class="control-label">{{ trans('oraclepopupsignin/main.amount') }}({{ $currency }})</label>
                                    <input type="text" name="amount" class="form-control @error('amount') is-invalid @enderror" >

                                    @error('amount')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label class="input-label d-block">{{ trans('oraclepopupsignin/main.type') }}</label>
                                    <select name="type" class="form-control @error('type') is-invalid @enderror">
                                        <option value="addiction">{{ trans('oraclepopupsignin/main.addiction') }}</option>
                                        <option value="deduction">{{ trans('oraclepopupsignin/main.deduction') }}</option>
                                    </select>

                                    @error('type')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="input-label d-block">{{ trans('oraclepopupsignin/main.user') }}</label>
                                    <select name="user_id" class="form-control search-user-select2 @error('user_id') is-invalid @enderror" data-placeholder="{{ trans('public.search_user') }}">

                                    </select>

                                    @error('user_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="control-label">{{ trans('oraclepopupsignin/main.description') }}</label>
                                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="6"></textarea>
                                    @error('description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">{{ trans('oraclepopupsignin/main.submit') }}</button>
                            </form>
                        </div>
                    </div>
            </div>
        </div>
    </section>
@endsection

