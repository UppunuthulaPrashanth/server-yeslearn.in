<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class WebinarsExport implements FromCollection, WithHeadings, WithMapping
{
    protected $webinars;

    public function __construct($webinars)
    {
        $this->webinars = $webinars;
    }

    /**
     * @return Collection
     */
    public function collection()
    {
        return $this->webinars;
    }

    /**
     * @inheritDoc
     */
    public function headings(): array
    {
        return [
            trans('oraclepopupsignin/main.id'),
            trans('oraclepopupsignin/pages/webinars.title'),
            trans('oraclepopupsignin/pages/webinars.course_type'),
            trans('oraclepopupsignin/pages/webinars.teacher_name'),
            trans('oraclepopupsignin/pages/webinars.sale_count'),
            trans('oraclepopupsignin/pages/webinars.price'),
            trans('oraclepopupsignin/main.created_at'),
            trans('oraclepopupsignin/main.status'),
        ];
    }

    /**
     * @inheritDoc
     */
    public function map($webinar): array
    {
        return [
            $webinar->id,
            $webinar->title,
            $webinar->type,
            $webinar->teacher->full_name,
            $webinar->sales->count(),
            $webinar->price,
            dateTimeFormat($webinar->created_at, 'j M Y | H:i'),
            $webinar->status,
        ];
    }
}
