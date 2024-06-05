<?php

namespace App\Filament\Widgets;

use App\Models\Aysem;
use Filament\Widgets\ChartWidget;
use App\Models\Program;

class StudentPerPrograms extends ChartWidget
{
    protected static ?string $heading = 'Number of Students Enrolled per Program';
    protected static ?string $maxHeight = '300px';

    // Remove x and y axis, show the number of students per program
    protected static ?array $options = [
        'scales' => [
            'x' => [
                'display' => false,
            ],
            'y' => [
                'display' => false,
            ],
        ],
    ];

    public function getDescription(): ?string
    {
        return 'Number of students enrolled per program for the academic year and semester ' . Aysem::current()->academic_year_sem;
    }

    protected function getData(): array
    {
        // Retrieve programs and their respective student counts for the current academic semester
        $programs = Program::all();
        $labels = [];
        $data = [];

        foreach ($programs as $program) {
            $labels[] = $program->program_code;
            $data[] = $program->getStudentCountOnCurrentAysem();
        }

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Number of Students',
                    'data' => $data,
                    'backgroundColor' => [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(153, 102, 255)',
                        'rgb(255, 159, 64)',
                    ],
                    'hoverOffset' => 4,
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
