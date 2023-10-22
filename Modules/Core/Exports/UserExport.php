<?php

namespace Modules\Core\Exports;

use Modules\Core\Entities\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class UserExport implements FromCollection, WithMapping, WithHeadings, WithColumnFormatting
{
    public function collection()
    {
        return User::all();
    }

    /**
     * @var User $user
     */
    public function map($user): array
    {
        return [
            $user->id,
            $user->name,
            $user->email,
            Date::dateTimeToExcel($user->created_at)
        ];
    }

    public function headings(): array
    {
        return [
            '#',
            'Nom',
            'E-mail',
            'Inscription'
        ];
    }

    /**
     * @return array
     */
    public function columnFormats(): array
    {
        return [
            'D' => 'dd/mm/yyyy hh:mm:ss'
        ];
    }
}
