<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Enrollment;
use App\Models\SchoolYear;
use App\Models\User;
use App\Models\Student;
use App\Models\Guardian;

class DashboardController extends Controller
{
    public function index()
    {
        $roleName = strtolower(Auth::user()->role?->role_name ?? '');

        $totalUsers     = User::count();
        $totalStudents  = Student::count();
        $totalGuardians = Guardian::count();
        $activeStudents = Student::where('status', 'active')->count();

        // Total Enrollees for current Academic Year
        $currentYear    = SchoolYear::current();
        $totalEnrollees = $currentYear
            ? Enrollment::where('school_year_id', $currentYear->school_year_id)
                ->whereNotIn('status', ['rejected', 'withdrawn'])
                ->count()
            : 0;

        $isTeacherOrStaff = in_array($roleName, ['teacher', 'staff']);

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalStudents',
            'totalGuardians',
            'activeStudents',
            'totalEnrollees',
            'isTeacherOrStaff'
        ));
    }
}