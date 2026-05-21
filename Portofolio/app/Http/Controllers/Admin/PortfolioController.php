<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PortfolioController extends Controller
{
    public function index()
    {
        $this->authorizeAdmin();

        $portfolios = Portfolio::withCount('skills')->latest()->paginate(10);

        return view('admin.portfolios.index', compact('portfolios'));
    }

    public function show(Portfolio $portfolio)
    {
        $this->authorizeAdmin();

        $portfolio->load('skills');

        return view('admin.portfolios.show', compact('portfolio'));
    }

    public function edit(Portfolio $portfolio)
    {
        $this->authorizeAdmin();

        $portfolio->load('skills');

        return view('admin.portfolios.edit', compact('portfolio'));
    }

    public function update(Request $request, Portfolio $portfolio)
    {
        $this->authorizeAdmin();

        $validated = $this->validatedData($request);

        DB::transaction(function () use ($portfolio, $validated) {
            $portfolio->update($validated['portfolio']);
            $this->syncSkills($portfolio, $validated['skills']);
        });

        return redirect()
            ->route('admin.portfolios.index')
            ->with('success', 'Data portofolio berhasil diperbarui.');
    }

    public function destroy(Portfolio $portfolio)
    {
        $this->authorizeAdmin();

        $portfolio->delete();

        return redirect()
            ->route('admin.portfolios.index')
            ->with('success', 'Data portofolio berhasil dihapus.');
    }

    private function authorizeAdmin(): void
    {
        $user = Auth::user();

        abort_unless(
            $user && ($user->email === 'admin@example.com' || $user->role === 'admin'),
            403,
            'Akses ditolak. Hanya admin yang bisa mengelola portofolio.'
        );
    }

    private function validatedData(Request $request): array
    {
        $validated = $request->validate([
            'fotoprofil' => ['nullable', 'url', 'max:2048'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'tanggal_lahir' => ['nullable', 'string', 'max:255'],
            'jenis_kelamin' => ['nullable', 'string', 'max:255'],
            'kewarganegaraan' => ['nullable', 'string', 'max:255'],
            'github_url' => ['nullable', 'url', 'max:2048'],
            'tiktok_url' => ['nullable', 'url', 'max:2048'],
            'email' => ['nullable', 'email', 'max:255'],
            'nomortelp' => ['nullable', 'string', 'max:50'],
            'lokasi' => ['nullable', 'string', 'max:255'],
            'pendidikan' => ['nullable', 'string', 'max:255'],
            'pengalaman' => ['nullable', 'string'],
            'skills' => ['nullable', 'array'],
            'skills.*.name' => ['nullable', 'string', 'max:255'],
            'skills.*.icon' => ['nullable', 'string', 'max:255'],
            'skills.*.percentage' => ['nullable', 'integer', 'min:0', 'max:100'],
        ]);

        return [
            'portfolio' => collect($validated)->only([
                'fotoprofil',
                'name',
                'description',
                'tanggal_lahir',
                'jenis_kelamin',
                'kewarganegaraan',
                'github_url',
                'tiktok_url',
                'email',
                'nomortelp',
                'lokasi',
                'pendidikan',
                'pengalaman',
            ])->toArray(),
            'skills' => $validated['skills'] ?? [],
        ];
    }

    private function syncSkills(Portfolio $portfolio, array $skills): void
    {
        $portfolio->skills()->delete();

        foreach (array_values($skills) as $index => $skill) {
            if (empty($skill['name'])) {
                continue;
            }

            $portfolio->skills()->create([
                'name' => $skill['name'],
                'icon' => $skill['icon'] ?? $this->getDefaultIcon($skill['name']),
                'percentage' => (int) ($skill['percentage'] ?? 0),
                'delay' => 0.1 * ($index + 1),
            ]);
        }
    }

    private function getDefaultIcon(string $skillName): string
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
            'html' => 'fab fa-html5',
            'css' => 'fab fa-css3-alt',
            'git' => 'fab fa-git-alt',
        ];

        $skillName = strtolower($skillName);

        foreach ($icons as $key => $icon) {
            if (str_contains($skillName, $key)) {
                return $icon;
            }
        }

        return 'fas fa-code';
    }
}
