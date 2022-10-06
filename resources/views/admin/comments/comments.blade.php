@extends('admin.layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ $pageTitle }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/oraclepopupsignin/">{{trans('oraclepopupsignin/main.dashboard')}}</a>
                </div>
                <div class="breadcrumb-item">{{ trans('oraclepopupsignin/main.comments') }}</div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-comment"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{ trans('oraclepopupsignin/main.total_comments') }}</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalComments }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-eye"></i></div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{ trans('oraclepopupsignin/main.published_comments') }}</h4>
                        </div>
                        <div class="card-body">
                            {{ $publishedComments }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-hourglass-start"></i></div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{ trans('oraclepopupsignin/main.pending_comments') }}</h4>
                        </div>
                        <div class="card-body">
                            {{ $pendingComments }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="fas fa-flag"></i></div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{ trans('oraclepopupsignin/main.comments_reports') }}</h4>
                        </div>
                        <div class="card-body">
                            {{ $commentReports }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="section-body">

            <section class="card">
                <div class="card-body">
                    <form method="get" class="mb-0">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="input-label">{{ trans('oraclepopupsignin/main.search') }}</label>
                                    <input type="text" class="form-control" name="title" value="{{ request()->get('title') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="input-label">{{ trans('oraclepopupsignin/main.date') }}</label>
                                    <div class="input-group">
                                        <input type="date" id="fsdate" class="text-center form-control" name="date" value="{{ request()->get('date') }}" placeholder="Date">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="input-label">{{ trans('oraclepopupsignin/main.status') }}</label>
                                    <select name="status" data-plugin-selectTwo class="form-control populate">
                                        <option value="">{{ trans('oraclepopupsignin/main.all_status') }}</option>
                                        <option value="pending" @if(request()->get('status') == 'pending') selected @endif>{{ trans('oraclepopupsignin/main.pending') }}</option>
                                        <option value="active" @if(request()->get('status') == 'active') selected @endif>{{ trans('oraclepopupsignin/main.published') }}</option>
                                    </select>
                                </div>
                            </div>

                            @if($page == 'webinars')
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="input-label">{{ trans('oraclepopupsignin/main.class') }}</label>
                                        <select name="webinar_ids[]" multiple="multiple" class="form-control search-webinar-select2 " data-placeholder="{{ trans('oraclepopupsignin/main.search_webinar') }}">

                                            @if(!empty($webinars) and $webinars->count() > 0)
                                                @foreach($webinars as $webinar)
                                                    <option value="{{ $webinar->id }}" selected>{{ $webinar->title }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            @elseif($page == 'blog')
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="input-label">{{ trans('oraclepopupsignin/main.blog') }}</label>
                                        <select name="post_ids[]" multiple="multiple" class="form-control search-blog-select2 " data-placeholder="Search blog">

                                            @if(!empty($blog) and $blog->count() > 0)
                                                @foreach($blog as $post)
                                                    <option value="{{ $post->id }}" selected>{{ $post->title }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            @endif


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="input-label">{{ trans('oraclepopupsignin/main.user') }}</label>
                                    <select name="user_ids[]" multiple="multiple" class="form-control search-user-select2"
                                            data-placeholder="Search users">

                                        @if(!empty($users) and $users->count() > 0)
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}" selected>{{ $user->full_name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group mt-1">
                                    <label class="input-label mb-4"> </label>
                                    <input type="submit" class="text-center btn btn-primary w-100" value="{{ trans('oraclepopupsignin/main.show_results') }}">
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </section>


            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped font-14">
                                    <tr>
                                        <th>{{ trans('oraclepopupsignin/main.comment') }}</th>
                                        <th>{{ trans('oraclepopupsignin/main.created_date') }}</th>
                                        <th class="text-left">{{ trans('oraclepopupsignin/main.user') }}</th>
                                        @if($page == 'webinars')
                                            <th class="text-left">{{ trans('oraclepopupsignin/main.class') }}</th>
                                        @elseif($page == 'blog')
                                            <th class="text-left">{{ trans('oraclepopupsignin/main.blog') }}</th>
                                        @endif
                                        <th>{{ trans('oraclepopupsignin/main.type') }}</th>
                                        <th>{{ trans('oraclepopupsignin/main.status') }}</th>
                                        <th width="150">{{ trans('oraclepopupsignin/main.action') }}</th>
                                    </tr>
                                    @foreach($comments as $comment)
                                        <tr>
                                            <td>
                                                <button type="button" class="js-show-description btn btn-outline-primary">{{ trans('oraclepopupsignin/main.show') }}</button>
                                                <input type="hidden" value="{!! nl2br($comment->comment) !!}">
                                            </td>
                                            <td>{{ dateTimeFormat($comment->created_at, 'j M Y | H:i') }}</td>
                                            <td class="text-left">
                                                <a href="{{ $comment->user->getProfileUrl() }}" target="_blank" class="">{{ $comment->user->full_name }}</a>
                                            </td>

                                            <td class="text-left">
                                                <a href="{{ $comment->$itemRelation->getUrl() }}" target="_blank">
                                                    {{ $comment->$itemRelation->title }}
                                                </a>
                                            </td>

                                            <td>
                                                <span>
                                                    {{ (empty($comment->reply_id)) ? trans('oraclepopupsignin/main.main_comment') : trans('oraclepopupsignin/main.replied') }}
                                                </span>
                                            </td>

                                            <td>
                                                <span class="text-{{ ($comment->status == 'pending') ? 'warning' : 'success' }}">
                                                    {{ ($comment->status == 'pending') ? trans('oraclepopupsignin/main.pending') : trans('oraclepopupsignin/main.published') }}
                                                </span>
                                            </td>

                                            <td width="150px" class="text-center">

                                                @can('admin_'. $itemRelation .'_comments_status')
                                                    <a href="/oraclepopupsignin/comments/{{ $page }}/{{ $comment->id }}/toggle" class="btn-transparent text-primary" data-toggle="tooltip" data-placement="top" title="{{ trans('oraclepopupsignin/main.'.(($comment->status == 'pending') ? 'publish' : 'pending')) }}">
                                                        @if($comment->status == 'pending')
                                                            <i class="fa fa-eye"></i>
                                                        @else
                                                            <i class="fa fa-eye-slash"></i>
                                                        @endif
                                                    </a>
                                                @endcan

                                                @can('admin_'. $itemRelation .'_comments_reply')
                                                    <a href="/oraclepopupsignin/comments/{{ $page }}/{{ !empty($comment->reply_id) ? $comment->reply_id : $comment->id }}/reply" class="btn-transparent text-primary" data-toggle="tooltip" data-placement="top" title="{{ trans('oraclepopupsignin/main.reply') }}">
                                                        <i class="fa fa-reply"></i>
                                                    </a>
                                                @endcan

                                                @can('admin_'. $itemRelation .'_comments_edit')
                                                    <a href="/oraclepopupsignin/comments/{{ $page }}/{{ $comment->id }}/edit" class="btn-transparent text-primary" data-toggle="tooltip" data-placement="top" title="{{ trans('oraclepopupsignin/main.edit') }}">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                @endcan

                                                @can('admin_'. $itemRelation .'_comments_delete')
                                                    @include('admin.includes.delete_button',['url' => '/oraclepopupsignin/comments/'. $page .'/'.$comment->id.'/delete','btnClass' => ''])
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>

                        <div class="card-footer text-center">
                            {{ $comments->appends(request()->input())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="contactMessage" tabindex="-1" aria-labelledby="contactMessageLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="contactMessageLabel">{{ trans('oraclepopupsignin/main.message') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('oraclepopupsignin/main.close') }}</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts_bottom')
    <script src="/assets/default/js/admin/comments.min.js"></script>
@endpush
