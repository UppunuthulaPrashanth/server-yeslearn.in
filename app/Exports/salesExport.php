<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class salesExport implements FromCollection, WithHeadings, WithMapping
{
    protected $sales;

    public function __construct($sales)
    {
        $this->sales = $sales;
    }

    /**
     * @return Collection
     */
    public function collection()
    {
        return $this->sales;
    }

    /**
     * @inheritDoc
     */
    public function headings(): array
    {
        return [
            trans('oraclepopupsignin/main.id'),
            trans('oraclepopupsignin/main.student'),
            trans('oraclepopupsignin/main.student') . ' ' . trans('oraclepopupsignin/main.id'),
            trans('oraclepopupsignin/main.instructor'),
            trans('oraclepopupsignin/main.instructor') . ' ' . trans('oraclepopupsignin/main.id'),
            trans('oraclepopupsignin/main.paid_amount'),
            trans('oraclepopupsignin/main.item'),
            trans('oraclepopupsignin/main.item') . ' ' . trans('oraclepopupsignin/main.id'),
            trans('oraclepopupsignin/main.sale_type'),
            trans('oraclepopupsignin/main.date'),
            trans('oraclepopupsignin/main.status'),
        ];
    }

    /**
     * @inheritDoc
     */
    public function map($sale): array
    {

        if ($sale->payment_method == \App\Models\Sale::$subscribe) {
            $paidAmount = trans('oraclepopupsignin/main.subscribe');
        } else {
            if (!empty($sale->total_amount)) {
                $paidAmount = currencySign() . (handlePriceFormat($sale->total_amount));
            } else {
                $paidAmount = trans('public.free');
            }
        }

        $status = (!empty($sale->refund_at)) ? trans('oraclepopupsignin/main.refund') : trans('oraclepopupsignin/main.success');

        return [
            $sale->id,
            $sale->buyer->full_name,
            $sale->buyer->id,
            $sale->item_seller,
            $sale->seller_id,
            $paidAmount,
            $sale->item_title,
            $sale->item_id,
            trans('oraclepopupsignin/main.' . $sale->type),
            dateTimeFormat($sale->created_at, 'j M Y H:i'),
            $status
        ];
    }
}
