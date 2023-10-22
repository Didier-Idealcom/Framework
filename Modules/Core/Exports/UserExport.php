<?php

namespace Modules\Core\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Modules\Core\Entities\User;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class UserExport implements FromCollection, WithColumnFormatting, WithHeadings, WithMapping
{
    public function collection()
    {
        return User::all();
    }

    /**
     * @var User
     */
    public function map($user): array
    {
        return [
            $user->id,
            $user->name,
            $user->email,
            Date::dateTimeToExcel($user->created_at),
        ];
    }

    public function headings(): array
    {
        return [
            '#',
            'Nom',
            'E-mail',
            'Inscription',
        ];
    }

    public function columnFormats(): array
    {
        return [
            'D' => 'dd/mm/yyyy hh:mm:ss',
        ];
    }
}
