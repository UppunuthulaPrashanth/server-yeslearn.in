<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UsersExport implements FromCollection, WithHeadings, WithMapping
{
    protected $users;

    public function __construct($users)
    {
        $this->users = $users;
    }

    /**
     * @return Collection
     */
    public function collection()
    {
        return $this->users;
    }

    /**
     * @inheritDoc
     */
    public function headings(): array
    {
        return [
            trans('oraclepopupsignin/main.id'),
            trans('oraclepopupsignin/pages/users.full_name'),
            trans('oraclepopupsignin/main.email'),
            trans('public.mobile'),
            trans('oraclepopupsignin/pages/users.role_name'),
            trans('oraclepopupsignin/pages/financial.income'),
            trans('oraclepopupsignin/pages/users.status'),
            trans('oraclepopupsignin/main.created_at'),
        ];
    }

    /**
     * @inheritDoc
     */
    public function map($user): array
    {
        return [
            $user->id,
            $user->full_name,
            $user->email,
            $user->mobile,
            $user->role->name,
            20,
            $user->status,
            dateTimeFormat($user->created_at,'j M Y | H:i')
        ];
    }
}
