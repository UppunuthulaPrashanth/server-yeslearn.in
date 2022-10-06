<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class FeatureWebinarsExport implements FromCollection, WithHeadings, WithMapping
{
    protected $features;

    public function __construct($features)
    {
        $this->features = $features;
    }

    /**
     * @return Collection
     */
    public function collection()
    {
        return $this->features;
    }

    /**
     * @inheritDoc
     */
    public function headings(): array
    {
        return [
            trans('oraclepopupsignin/main.id'),
            trans('oraclepopupsignin/pages/webinars.webinar_title'),
            trans('oraclepopupsignin/pages/webinars.webinar_status'),
            trans('public.date'),
            trans('oraclepopupsignin/pages/webinars.teacher_name'),
            trans('oraclepopupsignin/main.category'),
            trans('oraclepopupsignin/pages/webinars.page'),
            trans('oraclepopupsignin/main.status'),
        ];
    }

    /**
     * @inheritDoc
     */
    public function map($feature): array
    {
        return [
            $feature->id,
            $feature->webinar->title,
            $feature->webinar->status,
            dateTimeFormat($feature->updated_at, 'Y M j | H:i'),
            $feature->webinar->teacher->full_name,
            $feature->webinar->category->title,
            trans('oraclepopupsignin/pages/webinars.page_' . $feature->page),
            ($feature->status == 'publish') ? trans('oraclepopupsignin/main.published') : trans('oraclepopupsignin/main.pending'),
        ];
    }
}
