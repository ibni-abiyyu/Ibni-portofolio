@php
    $portfolio = $portfolio ?? null;
    $defaultSkills = collect(range(1, 4))->map(fn () => ['name' => '', 'icon' => '', 'percentage' => ''])->toArray();
    $savedSkills = $portfolio
        ? $portfolio->skills->map(fn ($skill) => [
            'name' => $skill->name,
            'icon' => $skill->icon,
            'percentage' => $skill->percentage,
        ])->toArray()
        : $defaultSkills;
    $skills = old('skills', !empty($savedSkills) ? $savedSkills : $defaultSkills);
@endphp

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
        <input type="text" name="name" id="name" value="{{ old('name', $portfolio->name ?? '') }}"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        @error('name')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
        <input type="email" name="email" id="email" value="{{ old('email', $portfolio->email ?? '') }}"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        @error('email')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
        <input type="text" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir', $portfolio->tanggal_lahir ?? '') }}"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        @error('tanggal_lahir')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
        <input type="text" name="jenis_kelamin" id="jenis_kelamin" value="{{ old('jenis_kelamin', $portfolio->jenis_kelamin ?? '') }}"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        @error('jenis_kelamin')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="nomortelp" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
        <input type="text" name="nomortelp" id="nomortelp" value="{{ old('nomortelp', $portfolio->nomortelp ?? '') }}"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        @error('nomortelp')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="lokasi" class="block text-sm font-medium text-gray-700">Lokasi</label>
        <input type="text" name="lokasi" id="lokasi" value="{{ old('lokasi', $portfolio->lokasi ?? '') }}"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        @error('lokasi')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="kewarganegaraan" class="block text-sm font-medium text-gray-700">Kewarganegaraan</label>
        <input type="text" name="kewarganegaraan" id="kewarganegaraan" value="{{ old('kewarganegaraan', $portfolio->kewarganegaraan ?? '') }}"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        @error('kewarganegaraan')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="pendidikan" class="block text-sm font-medium text-gray-700">Pendidikan</label>
        <input type="text" name="pendidikan" id="pendidikan" value="{{ old('pendidikan', $portfolio->pendidikan ?? '') }}"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        @error('pendidikan')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="fotoprofil" class="block text-sm font-medium text-gray-700">URL Foto Profil</label>
        <input type="url" name="fotoprofil" id="fotoprofil" value="{{ old('fotoprofil', $portfolio->fotoprofil ?? '') }}"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        @error('fotoprofil')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="github_url" class="block text-sm font-medium text-gray-700">URL GitHub</label>
        <input type="url" name="github_url" id="github_url" value="{{ old('github_url', $portfolio->github_url ?? '') }}"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        @error('github_url')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="tiktok_url" class="block text-sm font-medium text-gray-700">URL TikTok</label>
        <input type="url" name="tiktok_url" id="tiktok_url" value="{{ old('tiktok_url', $portfolio->tiktok_url ?? '') }}"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        @error('tiktok_url')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="mt-4">
    <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
    <textarea name="description" id="description" rows="5"
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $portfolio->description ?? '') }}</textarea>
    @error('description')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

<div class="mt-4">
    <label for="pengalaman" class="block text-sm font-medium text-gray-700">Pengalaman</label>
    <textarea name="pengalaman" id="pengalaman" rows="4"
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('pengalaman', $portfolio->pengalaman ?? '') }}</textarea>
    <p class="text-xs text-gray-500 mt-1">Tulis satu pengalaman per baris.</p>
    @error('pengalaman')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

<div class="mt-6">
    <h3 class="text-lg font-semibold text-gray-900 mb-3">Skill</h3>
    <div class="space-y-3">
        @foreach($skills as $index => $skill)
            <div class="grid grid-cols-1 md:grid-cols-12 gap-3 rounded-md border border-gray-200 p-3">
                <div class="md:col-span-5">
                    <label class="block text-sm font-medium text-gray-700">Nama Skill</label>
                    <input type="text" name="skills[{{ $index }}][name]" value="{{ $skill['name'] ?? '' }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error("skills.$index.name")
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-4">
                    <label class="block text-sm font-medium text-gray-700">Icon Font Awesome</label>
                    <input type="text" name="skills[{{ $index }}][icon]" value="{{ $skill['icon'] ?? '' }}" placeholder="fas fa-code"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error("skills.$index.icon")
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-3">
                    <label class="block text-sm font-medium text-gray-700">Persentase</label>
                    <input type="number" min="0" max="100" name="skills[{{ $index }}][percentage]" value="{{ $skill['percentage'] ?? '' }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error("skills.$index.percentage")
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        @endforeach
    </div>
    <p class="text-xs text-gray-500 mt-2">Kosongkan nama skill pada baris yang tidak dipakai.</p>
</div>

<div class="flex justify-end gap-2 mt-6">
    <a href="{{ route('admin.portfolios.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded shadow">
        Batal
    </a>
    <button type="submit" class="bg-blue-600 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded shadow">
        Simpan
    </button>
</div>
