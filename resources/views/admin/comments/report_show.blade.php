@extends('admin.layouts.app')


@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ trans('oraclepopupsignin/main.comments_reports') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/oraclepopupsignin/">{{trans('oraclepopupsignin/main.dashboard')}}</a>
                </div>
                <div class="breadcrumb-item">{{ trans('oraclepopupsignin/main.comments_reports') }}</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card">
                        <div class="card-header flex-column align-items-start">

                            @if(!empty($comment))
                                <div class="mt-1 w-100">
                                    <h4>{{ trans('oraclepopupsignin/main.reported_comment') }}</h4>

                                    <div class="table-responsive">
                                        <table class="table table-striped font-14">
                                            <tr>
                                                <th>{{ trans('oraclepopupsignin/main.user') }}</th>
                                                <th>{{ trans('oraclepopupsignin/main.comment') }}</th>
                                                <th>{{ trans('public.date') }}</th>
                                                <th>{{ trans('oraclepopupsignin/main.status') }}</th>
                                                <th>{{ trans('oraclepopupsignin/main.type') }}</th>
                                                <th>{{ trans('oraclepopupsignin/main.action') }}</th>
                                            </tr>

                                            <tr>
                                                <td>{{ $comment->user->id .' - '.$comment->user->full_name }}</td>
                                                <td width="30%">{!! nl2br($comment->comment) !!}</td>
                                                <td>{{ dateTimeFormat($comment->created_at, 'j M Y | H:i') }}</td>
                                                <td>
                                                    <span class="text-{{ ($comment->status == 'pending') ? 'warning' : 'success' }}">
                                                        {{ ($comment->status == 'pending') ? trans('oraclepopupsignin/main.pending') : trans('oraclepopupsignin/main.published') }}
                                                    </span>
                                                </td>

                                                <td>
                                                    <span class="text-{{ (empty($comment->reply_id)) ? 'info' : 'warning' }}">
                                                        {{ (empty($comment->reply_id)) ? trans('oraclepopupsignin/main.main_comment') : trans('oraclepopupsignin/main.replied') }}
                                                    </span>
                                                </td>

                                                <td>

                                                    @can('admin_'. $itemRelation .'_comments_status')
                                                        <a href="/oraclepopupsignin/{{ $page }}/comments/{{ $comment->id }}/toggle" class="btn btn-{{ (($comment->status == 'pending') ? 'success' : 'primary') }} btn-sm">{{ trans('oraclepopupsignin/main.'.(($comment->status == 'pending') ? 'publish' : 'pending')) }}</a>
                                                    @endcan

                                                    @can('admin_'. $itemRelation .'_comments_edit')
                                                        <a href="/oraclepopupsignin/{{ $page }}/comments/{{ $comment->id }}/edit" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="{{ trans('oraclepopupsignin/main.edit') }}">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                    @endcan

                                                    <br>

                                                    @can('admin_'. $itemRelation .'_comments_reply')
                                                        <a href="/oraclepopupsignin/{{ $page }}/comments/{{ !empty($comment->reply_id) ? $comment->reply_id : $comment->id }}/reply" class="btn btn-warning btn-sm mt-2">{{ trans('oraclepopupsignin/main.reply') }}</a>
                                                    @endcan

                                                    @can('admin_'. $itemRelation .'_comments_delete')
                                                        @include('admin.includes.delete_button',['url' => '/oraclepopupsignin/'. $page .'/comments/'.$comment->id.'/delete?redirect_to=/oraclepopupsignin/'. $page .'/comments/reports','btnClass' => 'btn-sm mt-2'])
                                                    @endcan
                                                </td>
                                            </tr>

                                        </table>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="card-body ">
                            <h4>{{ trans('oraclepopupsignin/main.report_message') }}</h4>
                            <p class="mt2">{!! nl2br($report->message) !!}</p>

                            <h4 class="mt-5">{{ trans('oraclepopupsignin/main.report_detail') }}</h4>
                            <div class="table-responsive">
                                <table class="table table-striped font-14">
                                    <tr>
                                        <th>{{ trans('oraclepopupsignin/main.user') }}</th>
                                        <th>{{ trans('oraclepopupsignin/main.post') }}</th>
                                        <th>{{ trans('site.message') }}</th>
                                        <th>{{ trans('public.date') }}</th>
                                        <th>{{ trans('oraclepopupsignin/main.action') }}</th>
                                    </tr>

                                    <tr>
                                        <td>{{ $report->user->id .' - '.$report->user->full_name }}</td>
                                        <td width="20%">{{ $report->$itemRelation->title }}</td>
                                        <td width="25%">{!! nl2br($report->message) !!}</td>
                                        <td>{{ dateTimeFormat($report->created_at, 'j M Y | H:i') }}</td>

                                        <td width="150px" class="text-right">

                                            @can('admin_'. $itemRelation .'_comments_reports')
                                                @include('admin.includes.delete_button',['url' => '/oraclepopupsignin/'. $page .'/comments/reports/'.$report->id.'/delete?redirect_to=/oraclepopupsignin/'. $page .'/comments/reports','btnClass' => 'btn-sm'])
                                            @endcan
                                        </td>
                                    </tr>

                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

