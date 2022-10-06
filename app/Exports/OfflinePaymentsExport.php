<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class OfflinePaymentsExport implements FromCollection, WithHeadings, WithMapping
{
    protected $offlinePayments;
    protected $currency;

    public function __construct($offlinePayments)
    {
        $this->offlinePayments = $offlinePayments;
        $this->currency = currencySign();
    }

    /**
     * @return Collection
     */
    public function collection()
    {
        return $this->offlinePayments;
    }

    /**
     * @inheritDoc
     */
    public function headings(): array
    {
        return [
            trans('oraclepopupsignin/main.user'),
            trans('oraclepopupsignin/main.role'),
            trans('oraclepopupsignin/main.amount'),
            trans('oraclepopupsignin/main.bank'),
            trans('oraclepopupsignin/main.referral_code'),
            trans('oraclepopupsignin/main.phone'),
            trans('oraclepopupsignin/main.transaction_time'),
            trans('oraclepopupsignin/main.status')
        ];
    }

    /**
     * @inheritDoc
     */
    public function map($offlinePayment): array
    {
        return [
            $offlinePayment->user->full_name,
            $offlinePayment->user->role->caption,
            $this->currency . '' . $offlinePayment->amount,
            $offlinePayment->bank,
            $offlinePayment->reference_number,
            $offlinePayment->user->mobile,
            dateTimeFormat($offlinePayment->pay_date, 'j M Y H:i'),
            ($offlinePayment->status == 'approved') ? trans('financial.approved') : ($offlinePayment->status == 'waiting' ? trans('public.waiting') : trans('public.rejected'))
        ];
    }
}
