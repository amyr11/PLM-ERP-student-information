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
        $studentCount = Student::getNotGraduatedStudentsCount();
        $manilanCount = Student::getManilanStudentsCount();
        $currentAysem = Aysem::current();

        return [
            Stat::make('Total students', $studentCount)
                ->icon('heroicon-o-chart-bar')
                ->description('Total number of undergraduate students in the system'),
            Stat::make('Enrolled students', StudentTerm::getEnrolledStudentCount($currentAysem))
                ->icon('heroicon-o-user-group')
                ->description('Number of students currently enrolled for the academic year and semester ' . $currentAysem->academic_year_sem)
                ->color('success'),
            Stat::make('Manila students (%)', number_format(($manilanCount / $studentCount * 100), 1) . '%')
                ->icon('heroicon-o-map-pin')
                ->description($manilanCount . ' out of ' . $studentCount . ' students are from Manila')
        ];
    }
}
