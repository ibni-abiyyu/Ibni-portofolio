@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold">Detail Portofolio</h2>
                    <div class="flex gap-2">
                        <a href="{{ route('admin.portfolios.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded shadow">Kembali</a>
                        <a href="{{ route('admin.portfolios.edit', $portfolio) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded shadow">Edit</a>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        @if($portfolio->fotoprofil)
                            <img src="{{ $portfolio->fotoprofil }}" alt="{{ $portfolio->name }}" class="w-full max-w-xs aspect-square object-cover rounded border">
                        @else
                            <div class="w-full max-w-xs aspect-square rounded border bg-gray-100 flex items-center justify-center text-gray-400">Tidak ada foto</div>
                        @endif
                    </div>

                    <div class="md:col-span-2 space-y-3">
                        <h3 class="text-xl font-semibold">{{ $portfolio->name }}</h3>
                        <p class="text-gray-700">{{ $portfolio->description }}</p>
                        <p><span class="font-semibold">Tanggal Lahir:</span> {{ $portfolio->tanggal_lahir ?? '-' }}</p>
                        <p><span class="font-semibold">Jenis Kelamin:</span> {{ $portfolio->jenis_kelamin ?? '-' }}</p>
                        <p><span class="font-semibold">Email:</span> {{ $portfolio->email ?? '-' }}</p>
                        <p><span class="font-semibold">Telepon:</span> {{ $portfolio->nomortelp ?? '-' }}</p>
                        <p><span class="font-semibold">Lokasi:</span> {{ $portfolio->lokasi ?? '-' }}</p>
                        <p><span class="font-semibold">Kewarganegaraan:</span> {{ $portfolio->kewarganegaraan ?? '-' }}</p>
                        <p><span class="font-semibold">Pendidikan:</span> {{ $portfolio->pendidikan ?? '-' }}</p>
                        <p><span class="font-semibold">GitHub:</span> {{ $portfolio->github_url ?? '-' }}</p>
                        <p><span class="font-semibold">TikTok:</span> {{ $portfolio->tiktok_url ?? '-' }}</p>
                    </div>
                </div>

                <div class="mt-8">
                    <h3 class="text-lg font-semibold mb-3">Pengalaman</h3>
                    <ul class="list-disc pl-5 text-gray-700">
                        @forelse(preg_split('/\r\n|\r|\n/', $portfolio->pengalaman ?? '') as $pengalaman)
                            @if(trim($pengalaman) !== '')
                                <li>{{ $pengalaman }}</li>
                            @endif
                        @empty
                            <li>Belum ada pengalaman.</li>
                        @endforelse
                    </ul>
                </div>

                <div class="mt-8">
                    <h3 class="text-lg font-semibold mb-3">Skill</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Icon</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Persentase</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($portfolio->skills as $skill)
                                    <tr>
                                        <td class="px-4 py-2">{{ $skill->name }}</td>
                                        <td class="px-4 py-2">{{ $skill->icon ?? '-' }}</td>
                                        <td class="px-4 py-2">{{ $skill->percentage }}%</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-4 py-2 text-center text-gray-500">Belum ada skill.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
