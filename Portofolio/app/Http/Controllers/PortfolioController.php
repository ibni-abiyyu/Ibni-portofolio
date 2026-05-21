<?php
// app/Http/Controllers/PortfolioController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Portfolio;
use App\Models\Skill;

class PortfolioController extends Controller
{
    // Data default portofolio (untuk fallback jika database kosong)
    private $defaultData = [
        'fotoprofil' => 'https://cdn.discordapp.com/attachments/1256123329505660938/1460886503625592924/Screenshot_2025-06-08_002525.png?ex=699feb14&is=699e9994&hm=d343de924bd89500ab705f42c386dcfd8448ffd0b0ab1453061d43ab71905b51',
        'name' => 'Ibni Abiyyu',
        'description' => 'Saya adalah seorang Programmer yang memiliki minat dan kemampuan di bidang pengembangan perangkat lunak dengan belajar dan praktik kurang lebih 2 tahun. Menguasai Python, PHP, dan JavaScript.',
        'tanggal_lahir' => '23 Mei 2009',
        'jenis_kelamin' => 'Laki-laki',
        'kewarganegaraan' => 'Indonesia',
        'github_url' => 'https://github.com/PPLG-SMKTI-27/uuk-ganjil-ibni-abiyyu',
        'tiktok_url' => 'https://www.tiktok.com/@meidoragon_',
        'email' => 'iabiyyu76@gmail.com',
        'nomortelp' => '0851-5666-4819',
        'lokasi' => 'Perumahan Sempaja Lestari Indah Korpri Blok B.10',
        'pendidikan' => 'SDIT Cordova, SMPIT Cordova, SMKTI Airlangga',
        'pengalaman' => "Final Proyek Semester 1 Kelas 11: Aplikasi Perpustakaan\nFinal Proyek Semester 2 Kelas 11: Aplikasi Pelacakan Gerobak Kopi",
        'skills' => [
            [
                'name' => 'PHP',
                'icon' => 'fab fa-php',
                'percentage' => 80,
                'delay' => 0.1
            ],
            [
                'name' => 'JavaScript',
                'icon' => 'fab fa-js',
                'percentage' => 75,
                'delay' => 0.2
            ],
            [
                'name' => 'Python',
                'icon' => 'fab fa-python',
                'percentage' => 70,
                'delay' => 0.3
            ],
            [
                'name' => 'Penguasaan Bahasa Program',
                'icon' => 'fas fa-code',
                'percentage' => 75,
                'delay' => 0.4
            ]
        ]
    ];

    /**
     * Menampilkan halaman utama portofolio
     */
    public function index(Request $request)
    {
        // Gunakan Auth bawaan Laravel
        $isLoggedIn = Auth::check();
        $isAdmin = false;
        $loggedInUser = null;
        
        if ($isLoggedIn) {
            $user = Auth::user();
            $loggedInUser = [
                'username' => $user->name,
                'email' => $user->email,
                'role' => $user->role ?? 'user' // Pastikan ada kolom role di users table
            ];
            // Cek apakah admin (berdasarkan email atau role)
            $isAdmin = ($user->email === 'admin@example.com') || ($user->role === 'admin');
        }
        
        // Load portfolio dengan skills-nya
        $portfolio = Portfolio::with('skills')->first();

        if (!$portfolio) {
            return view('portofolio', [
                'fotoprofil' => $this->defaultData['fotoprofil'],
                'name' => $this->defaultData['name'],
                'description' => $this->defaultData['description'],
                'tanggal_lahir' => $this->defaultData['tanggal_lahir'],
                'jenis_kelamin' => $this->defaultData['jenis_kelamin'],
                'kewarganegaraan' => $this->defaultData['kewarganegaraan'],
                'github_url' => $this->defaultData['github_url'],
                'tiktok_url' => $this->defaultData['tiktok_url'],
                'email' => $this->defaultData['email'],
                'nomortelp' => $this->defaultData['nomortelp'],
                'lokasi' => $this->defaultData['lokasi'],
                'pendidikan' => $this->defaultData['pendidikan'],
                'pengalaman' => $this->defaultData['pengalaman'],
                'skills' => $this->defaultData['skills'],
                'isLoggedIn' => $isLoggedIn,
                'isAdmin' => $isAdmin,
                'loggedInUser' => $loggedInUser,
                'editMode' => $request->session()->get('editMode', false),
                'usingDefaultData' => true
            ]);
        }

        // Konversi skills collection ke array
        $skills = $portfolio->skills->map(function($skill) {
            return [
                'name' => $skill->name,
                'icon' => $skill->icon ?? $this->getDefaultIcon($skill->name),
                'percentage' => $skill->percentage,
                'delay' => $skill->delay ?? 0.1
            ];
        })->toArray();

        return view('portofolio', [
            'fotoprofil' => $portfolio->fotoprofil ?? $this->defaultData['fotoprofil'],
            'name' => $portfolio->name ?? $this->defaultData['name'],
            'description' => $portfolio->description ?? $this->defaultData['description'],
            'tanggal_lahir' => $portfolio->tanggal_lahir ?? $this->defaultData['tanggal_lahir'],
            'jenis_kelamin' => $portfolio->jenis_kelamin ?? $this->defaultData['jenis_kelamin'],
            'kewarganegaraan' => $portfolio->kewarganegaraan ?? $this->defaultData['kewarganegaraan'],
            'github_url' => $portfolio->github_url ?? $this->defaultData['github_url'],
            'tiktok_url' => $portfolio->tiktok_url ?? $this->defaultData['tiktok_url'],
            'email' => $portfolio->email ?? $this->defaultData['email'],
            'nomortelp' => $portfolio->nomortelp ?? $this->defaultData['nomortelp'],
            'lokasi' => $portfolio->lokasi ?? $this->defaultData['lokasi'],
            'pendidikan' => $portfolio->pendidikan ?? $this->defaultData['pendidikan'],
            'pengalaman' => $portfolio->pengalaman ?? $this->defaultData['pengalaman'],
            'skills' => !empty($skills) ? $skills : $this->defaultData['skills'],
            'isLoggedIn' => $isLoggedIn,
            'isAdmin' => $isAdmin,
            'loggedInUser' => $loggedInUser,
            'editMode' => $request->session()->get('editMode', false),
            'usingDefaultData' => false
        ]);
    }

    /**
     * Toggle edit mode (admin only)
     */
    public function toggleEdit(Request $request)
    {
        // Cek apakah user login dan admin
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu');
        }
        
        $user = Auth::user();
        $isAdmin = ($user->email === 'admin@example.com') || ($user->role === 'admin');
        
        if (!$isAdmin) {
            return redirect('/')->with('error', 'Akses ditolak! Hanya admin yang bisa mengedit.');
        }
        
        $editMode = !$request->session()->get('editMode', false);
        $request->session()->put('editMode', $editMode);
        
        $message = $editMode ? 'Mode edit diaktifkan!' : 'Mode edit dinonaktifkan!';
        return redirect('/')->with('success', $message);
    }

    /**
     * Update data portofolio (admin only)
     */
    public function updatePortfolio(Request $request)
    {
        // Cek apakah user login dan admin
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu');
        }
        
        $user = Auth::user();
        $isAdmin = ($user->email === 'admin@example.com') || ($user->role === 'admin');
        
        if (!$isAdmin) {
            return redirect('/')->with('error', 'Akses ditolak! Hanya admin yang bisa mengupdate.');
        }

        // Validasi input
        $request->validate([
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'tanggal_lahir' => 'nullable|string',
            'jenis_kelamin' => 'nullable|string',
            'kewarganegaraan' => 'nullable|string',
            'email' => 'nullable|email',
            'nomortelp' => 'nullable|string',
            'lokasi' => 'nullable|string',
            'pendidikan' => 'nullable|string',
            'pengalaman' => 'nullable|string',
            'github_url' => 'nullable|url',
            'tiktok_url' => 'nullable|url',
            'fotoprofil_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'skills.name.*' => 'nullable|string',
            'skills.percentage.*' => 'nullable|integer|min:0|max:100'
        ]);

        // Cari atau buat portfolio baru
        $portfolio = Portfolio::first();
        
        $data = [
            'name' => $this->valueOrDefault($request->input('name'), 'name'),
            'description' => $this->valueOrDefault($request->input('description'), 'description'),
            'tanggal_lahir' => $this->valueOrDefault($request->input('tanggal_lahir'), 'tanggal_lahir'),
            'jenis_kelamin' => $this->valueOrDefault($request->input('jenis_kelamin'), 'jenis_kelamin'),
            'kewarganegaraan' => $this->valueOrDefault($request->input('kewarganegaraan'), 'kewarganegaraan'),
            'email' => $this->valueOrDefault($request->input('email'), 'email'),
            'nomortelp' => $this->valueOrDefault($request->input('nomortelp'), 'nomortelp'),
            'lokasi' => $this->valueOrDefault($request->input('lokasi'), 'lokasi'),
            'pendidikan' => $this->valueOrDefault($request->input('pendidikan'), 'pendidikan'),
            'pengalaman' => $this->valueOrDefault($request->input('pengalaman'), 'pengalaman'),
            'github_url' => $this->valueOrDefault($request->input('github_url'), 'github_url'),
            'tiktok_url' => $this->valueOrDefault($request->input('tiktok_url'), 'tiktok_url'),
            'fotoprofil' => $portfolio?->fotoprofil ?? $this->defaultData['fotoprofil']
        ];

        if ($request->hasFile('fotoprofil_file')) {
            if ($portfolio) {
                $this->deleteLocalProfilePhoto($portfolio->fotoprofil);
            }

            $data['fotoprofil'] = $this->storeProfilePhoto($request);
        }

        if (!$portfolio) {
            $portfolio = Portfolio::create($data);
            $message = 'Data portofolio berhasil dibuat!';
        } else {
            $portfolio->update($data);
            $message = 'Data portofolio berhasil diupdate!';
        }

        // Hapus skill lama
        $portfolio->skills()->delete();

        $hasSavedSkills = false;

        // Simpan skill baru
        if ($request->has('skills.name') && $request->has('skills.percentage')) {
            $skillNames = $request->input('skills.name', []);
            $skillPercentages = $request->input('skills.percentage', []);
            
            foreach ($skillNames as $index => $name) {
                if (!empty($name)) {
                    $icon = $this->getDefaultIcon($name);
                    $delay = 0.1 * ($index + 1);
                    
                    Skill::create([
                        'portfolio_id' => $portfolio->id,
                        'name' => $name,
                        'icon' => $icon,
                        'percentage' => intval($skillPercentages[$index] ?? 0),
                        'delay' => $delay
                    ]);

                    $hasSavedSkills = true;
                }
            }
        }

        if (!$hasSavedSkills) {
            foreach ($this->defaultData['skills'] as $skillData) {
                Skill::create([
                    'portfolio_id' => $portfolio->id,
                    'name' => $skillData['name'],
                    'icon' => $skillData['icon'],
                    'percentage' => $skillData['percentage'],
                    'delay' => $skillData['delay']
                ]);
            }
        }

        // Nonaktifkan edit mode setelah menyimpan
        $request->session()->put('editMode', false);

        return redirect('/')->with('success', $message . ' Data tersimpan di database.');
    }

    /**
     * Reset ke data default (admin only)
     */
    public function resetPortfolio(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu');
        }
        
        $user = Auth::user();
        $isAdmin = ($user->email === 'admin@example.com') || ($user->role === 'admin');
        
        if (!$isAdmin) {
            return redirect('/')->with('error', 'Akses ditolak!');
        }
        
        $portfolio = Portfolio::first();
        if ($portfolio) {
            $this->deleteLocalProfilePhoto($portfolio->fotoprofil);
            $portfolio->skills()->delete();
            $portfolio->delete();
        }
        
        $request->session()->put('editMode', false);
        
        return redirect('/')->with('success', 'Data berhasil direset ke default!');
    }

    /**
     * Import data default ke database (admin only)
     */
    public function importDefaultData(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu');
        }
        
        $user = Auth::user();
        $isAdmin = ($user->email === 'admin@example.com') || ($user->role === 'admin');
        
        if (!$isAdmin) {
            return redirect('/')->with('error', 'Akses ditolak!');
        }

        $oldPortfolio = Portfolio::first();
        if ($oldPortfolio) {
            $this->deleteLocalProfilePhoto($oldPortfolio->fotoprofil);
            $oldPortfolio->skills()->delete();
            $oldPortfolio->delete();
        }

        $portfolio = Portfolio::create([
            'fotoprofil' => $this->defaultData['fotoprofil'],
            'name' => $this->defaultData['name'],
            'description' => $this->defaultData['description'],
            'tanggal_lahir' => $this->defaultData['tanggal_lahir'],
            'jenis_kelamin' => $this->defaultData['jenis_kelamin'],
            'kewarganegaraan' => $this->defaultData['kewarganegaraan'],
            'github_url' => $this->defaultData['github_url'],
            'tiktok_url' => $this->defaultData['tiktok_url'],
            'email' => $this->defaultData['email'],
            'nomortelp' => $this->defaultData['nomortelp'],
            'lokasi' => $this->defaultData['lokasi'],
            'pendidikan' => $this->defaultData['pendidikan'],
            'pengalaman' => $this->defaultData['pengalaman'],
        ]);

        foreach ($this->defaultData['skills'] as $skillData) {
            Skill::create([
                'portfolio_id' => $portfolio->id,
                'name' => $skillData['name'],
                'icon' => $skillData['icon'],
                'percentage' => $skillData['percentage'],
                'delay' => $skillData['delay']
            ]);
        }

        return redirect('/')->with('success', 'Data default berhasil diimpor ke database!');
    }

    // ========== HELPER METHODS ==========
    
    /**
     * Mendapatkan icon default berdasarkan nama skill
     */
    private function getDefaultIcon($skillName)
    {
        $icons = [
            'frontend' => 'fas fa-code',
            'backend' => 'fas fa-server',
            'mobile' => 'fas fa-mobile-alt',
            'database' => 'fas fa-database',
            'laravel' => 'fab fa-laravel',
            'php' => 'fab fa-php',
            'javascript' => 'fab fa-js',
            'python' => 'fab fa-python',
            'react' => 'fab fa-react',
            'vue' => 'fab fa-vuejs',
            'angular' => 'fab fa-angular',
            'html' => 'fab fa-html5',
            'css' => 'fab fa-css3-alt',
            'git' => 'fab fa-git-alt',
            'docker' => 'fab fa-docker',
            'aws' => 'fab fa-aws',
            'wordpress' => 'fab fa-wordpress',
        ];

        $skillNameLower = strtolower($skillName);
        
        foreach ($icons as $key => $icon) {
            if (strpos($skillNameLower, $key) !== false) {
                return $icon;
            }
        }
        
        return 'fas fa-code';
    }

    private function valueOrDefault(?string $value, string $key): string
    {
        $value = trim((string) $value);

        return $value !== '' ? $value : $this->defaultData[$key];
    }

    private function deleteLocalProfilePhoto(?string $photoPath): void
    {
        if (!$photoPath) {
            return;
        }

        $relativePath = ltrim(parse_url($photoPath, PHP_URL_PATH) ?? $photoPath, '/');

        if (str_starts_with($relativePath, 'profile-photos/')) {
            $fullPath = public_path($relativePath);

            if (is_file($fullPath)) {
                unlink($fullPath);
            }

            return;
        }

        if (str_starts_with($relativePath, 'storage/profile-photos/')) {
            $fullPath = storage_path('app/public/'.substr($relativePath, strlen('storage/')));

            if (is_file($fullPath)) {
                unlink($fullPath);
            }
        }
    }

    private function storeProfilePhoto(Request $request): string
    {
        $file = $request->file('fotoprofil_file');
        $directory = public_path('profile-photos');

        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        $filename = uniqid('profile_', true).'.'.$file->getClientOriginalExtension();
        $file->move($directory, $filename);

        return '/profile-photos/'.$filename;
    }
}
