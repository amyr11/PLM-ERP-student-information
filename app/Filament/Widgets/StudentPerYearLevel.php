<?php

namespace App\Filament\Widgets;

use App\Models\Aysem;
use Filament\Widgets\ChartWidget;
use App\Models\StudentTerm;

class StudentPerYearLevel extends ChartWidget
{
    protected static ?string $heading = 'Number of Students Enrolled Per Year Level';
    protected static ?string $maxHeight = '300px';

    public function getDescription(): ?string
    {
        return 'Number of students enrolled per year level for the academic year and semester ' . Aysem::current()->academic_year_sem;
    }

    protected function getData(): array
    {
        $uniqueYearLevels = StudentTerm::select('year_level')
            ->distinct()
            ->pluck('year_level')
            ->sort()
            ->values();

        $data = $uniqueYearLevels->mapWithKeys(function ($yearLevel) {
            return [
                $yearLevel => StudentTerm::getStudentCountByYearLevel($yearLevel, Aysem::current()),
            ];
        })->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Number of Students',
                    'data' => array_values($data),
                ],
            ],
            'labels' => array_keys($data),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
