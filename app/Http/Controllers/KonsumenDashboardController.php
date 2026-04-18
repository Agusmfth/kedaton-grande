<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\View\View;

class KonsumenDashboardController extends Controller
{
    public function index(): View
    {
        $pengaduans = Pengaduan::where('user_id', auth()->id())->get();

        return view('konsumen.dashboard', compact('pengaduans'));
    }
}
