<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ trans('oraclepopupsignin/main.print') }} {{ $document->title }}</title>
    <link rel="stylesheet" href="/assets/admin/vendor/bootstrap/bootstrap.min.css"/>
    <link rel="stylesheet" href="/assets/admin/css/print.css">
</head>
<body>
<div class="main-box">
    <div class="print-1"></div>
    <div class="factor-logo-container">
        <img src="{{ getGeneralSettings('logo') }}" class=""/>
        <br>
        <h3 class="mt-1">{{ trans('financial.financial_documents') }}</h3>
    </div>
    <div class="print-2">
        <div>
            <span>{{ trans('oraclepopupsignin/main.document_number') }}:</span>&nbsp;<label>{{ $document->id }}</label>
        </div>
        <div class="mt-2">
            <span>{{ trans('oraclepopupsignin/main.created_at') }}:</span>&nbsp;<label>{{ dateTimeFormat($document->created_at,'d F Y - H:i') }}</label>
        </div>
    </div>
    <div class="w-100 clear-both"></div>
    <table>

        <th>{{ trans('oraclepopupsignin/main.email') }}</th>
        <th>{{ trans('oraclepopupsignin/main.mobile') }}</th>
        <th>{{ trans('oraclepopupsignin/main.title') }}</th>
        <th>{{ trans('oraclepopupsignin/main.type') }}</th>
        <th>{{ trans('oraclepopupsignin/main.amount') }}({{ $currency }})</th>

        <tr>
            <th>{{ $document->user->email ?? '-' }}</th>
            <th>{{ $document->user->mobile ?? '-' }}</th>
            <th>
                @if(!empty($document->webinar_id))
                    <span class="d-block font-weight-bold">{{ trans('oraclepopupsignin/main.item_purchased') }}</span>
                    <span class="d-block font-weight-bold">#{{ $document->webinar_id }}-{{ $document->webinar->title }}</span>
                @elseif(!empty($document->meeting_time_id))
                    <span class="d-block font-weight-bold">{{ trans('oraclepopupsignin/main.item_purchased') }}</span>
                    <span class="d-block font-weight-bold">{{ trans('oraclepopupsignin/main.meeting') }}</span>
                @elseif(!empty($document->subscribe_id))
                    <span class="d-block font-weight-bold">{{ trans('oraclepopupsignin/main.purchased_subscribe') }}</span>
                @elseif(!empty($document->promotion_id))
                    <span class="d-block font-weight-bold">{{ trans('oraclepopupsignin/main.purchased_promotion') }}</span>
                @endif
            </th>
            <th>
                @switch($document->type)
                    @case(\App\Models\Accounting::$addiction)
                    <span class="text-success">{{ trans('oraclepopupsignin/main.addiction') }}</span>
                    @break
                    @case(\App\Models\Accounting::$deduction)
                    <span class="text-danger">{{ trans('oraclepopupsignin/main.deduction') }}</span>
                    @break
                @endswitch
            </th>
            <th>{{ $document->amount }}</th>
        </tr>

    </table>

    <table>

        <tr>
            <th class="th-1">
                {{ !empty($document->description) ? $document->description : 'Description' }}
            </th>
        </tr>

    </table>

    <div class="print-3"></div>

    <div class="print-4">

        <div class="print-5">
            <span>{{ trans('public.created_by') }}:</span>&nbsp;
            <label>{{ !empty($document->creator_id) ? $document->creator->full_name : 'Automatic' }}</label>
        </div>
    </div>

    <div class="print-6"></div>
</div>
</body>
</html>
