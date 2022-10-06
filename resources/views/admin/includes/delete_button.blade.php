<button class="@if(empty($hideDefaultClass) or !$hideDefaultClass) btn-transparent text-primary @endif {{ $btnClass ?? '' }}"
        data-confirm="{{ trans('oraclepopupsignin/main.delete_confirm_msg') }}"
        data-confirm-href="{{ $url }}"
        data-confirm-text-yes="{{ trans('oraclepopupsignin/main.yes') }}"
        data-confirm-text-cancel="{{ trans('oraclepopupsignin/main.cancel') }}"
        @if(empty($btnText))
        data-toggle="tooltip" data-placement="top" title="{{ !empty($tooltip) ? $tooltip : trans('oraclepopupsignin/main.delete') }}"
    @endif
>
    @if(!empty($btnText))
        {{ $btnText }}
    @else
        <i class="fa {{ !empty($btnIcon) ? $btnIcon : 'fa-times' }}" aria-hidden="true"></i>
    @endif
</button>
