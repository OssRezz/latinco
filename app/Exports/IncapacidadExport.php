<?php

namespace App\Exports;

use App\Models\Incapacidad;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class IncapacidadExport implements FromArray, ShouldAutoSize, WithHeadings, WithEvents, WithColumnFormatting
{
    protected $Incapacidad;

    public function __construct(array $Incapacidad)
    {
        $this->Incapacidad = $Incapacidad;
    }

    public function array(): array
    {
        return $this->Incapacidad;
    }

    public function headings(): array
    {
        return ['Nombre', 'Estado', 'Valor Pendiente', 'Valor Recuperado'];
    }



    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getDelegate()->getStyle('A1:D1')
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('601c14');

                $event->sheet->getStyle('A1:D1')->getFont()
                    ->setSize(14)
                    ->setBold(true)
                    ->getColor()->setRGB('FFFFFF');

                $event->sheet->setAutoFilter('A1:D1');
            }
        ];
    }

    public function columnFormats(): array
    {
        return [
            'C' => '"$ "#,##0.000_-',
            'D' => '"$ "#,##0.000_-',
        ];
    }
}
