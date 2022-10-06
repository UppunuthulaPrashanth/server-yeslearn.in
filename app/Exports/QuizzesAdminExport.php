<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class QuizzesAdminExport implements FromCollection, WithHeadings, WithMapping
{
    protected $sheets;

    public function __construct($sheets)
    {
        $this->sheets = $sheets;
    }

    public function collection()
    {
        return $this->sheets;
    }

    public function headings(): array
    {
        return [
            '#',
            trans('oraclepopupsignin/pages/quiz.title'),
            trans('oraclepopupsignin/pages/quiz.instructor'),
            trans('oraclepopupsignin/pages/quiz.question_count'),
            trans('oraclepopupsignin/pages/quiz.students_count'),
            trans('oraclepopupsignin/pages/quiz.average_grade'),
            trans('oraclepopupsignin/pages/quiz.certificate'),
            trans('oraclepopupsignin/main.status'),
        ];
    }

    public function map($quiz): array
    {
        $quiz_name = $quiz->title;
        if (!empty($quiz->webinar)) {
            $quiz_name .= ' (' . $quiz->webinar->title . ') ';
        }

        $certificate = ($quiz->certificate) ? trans('oraclepopupsignin/main.yes') : trans('oraclepopupsignin/main.no');
        $status = ($quiz->status == 'active') ? trans('oraclepopupsignin/main.active') : trans('oraclepopupsignin/main.inactive');

        return [
            $quiz->id,
            $quiz_name,
            $quiz->teacher->full_name,
            $quiz->quizQuestions->count(),
            $quiz->quizResults->pluck('user_id')->count(),
            $quiz->quizResults->avg('user_grade'),
            $certificate,
            $status
        ];
    }

}
