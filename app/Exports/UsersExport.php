<?php

namespace ProjectApp\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use ProjectApp\User;
use Maatwebsite\Excel\Concerns\FromView;

class UsersExport implements FromView
{
    use Exportable;

    public function view(): View
    {
        return view('reports.users', [
            'users' => User::get()
        ]);
    }

    // public function collection()
    // {
    //     return User::all();
    // }
}
