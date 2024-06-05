<?php

namespace App\Filament\Widgets;

use App\Models\Aysem;
use App\Models\City;
use App\Models\Student;
use App\Models\StudentTerm;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $currentAysem = Aysem::current();
        return [
            Stat::make('Total students', Student::getNotGraduatedStudentsCount())
                ->icon('heroicon-o-chart-bar')
                ->description('Total number of undergraduate students in the system'),
            Stat::make('Enrolled students', StudentTerm::getEnrolledStudentCount($currentAysem))
                ->icon('heroicon-o-user-group')
                ->description('Number of students currently enrolled for the academic year and semester ' . $currentAysem->academic_year_sem)
                ->color('success'),
            Stat::make('Manila students (%)', number_format((Student::getManilanStudentsCount() / Student::count() * 100), 1) . '%')
                ->icon('heroicon-o-map-pin')
                ->description(Student::getManilanStudentsCount() . ' out of ' . Student::count() . ' students are from Manila')
        ];
    }
}
