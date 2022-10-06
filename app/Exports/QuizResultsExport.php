<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class QuizResultsExport implements FromCollection, WithHeadings, WithMapping
{
    protected $results;

    public function __construct($results)
    {
        $this->results = $results;
    }

    /**
     * @return Collection
     */
    public function collection()
    {
        return $this->results;
    }

    /**
     * @inheritDoc
     */
    public function headings(): array
    {
        return [
            trans('oraclepopupsignin/main.id'),
            trans('oraclepopupsignin/pages/quiz.title'),
            trans('oraclepopupsignin/pages/webinars.webinar'),
            trans('quiz.student'),
            trans('oraclepopupsignin/pages/quiz.instructor'),
            trans('oraclepopupsignin/pages/quiz.grades'),
            trans('oraclepopupsignin/pages/quiz.grade_date'),
            trans('oraclepopupsignin/main.status'),
        ];
    }

    /**
     * @inheritDoc
     */
    public function map($result): array
    {
        return [
            $result->id,
            $result->quiz->title,
            $result->quiz->webinar->title,
            $result->user->full_name,
            $result->quiz->teacher->full_nam,
            $result->user_grade,
            dateTimeformat($result->created_at, 'j F Y'),
            $result->status,
        ];
    }
}
