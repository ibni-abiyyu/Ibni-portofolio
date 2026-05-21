@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold">Kelola Portofolio</h2>
                </div>

                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Foto</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Skill</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($portfolios as $index => $portfolio)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $portfolios->firstItem() + $index }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($portfolio->fotoprofil)
                                            <img src="{{ $portfolio->fotoprofil }}" alt="{{ $portfolio->name }}" class="w-14 h-14 object-cover rounded">
                                        @else
                                            <span class="text-gray-400">Tidak ada foto</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap font-medium">{{ $portfolio->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $portfolio->email ?? '-' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $portfolio->skills_count }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('admin.portfolios.show', $portfolio) }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded text-sm mr-1">Detail</a>
                                        <a href="{{ route('admin.portfolios.edit', $portfolio) }}" class="inline-block bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-3 rounded text-sm mr-1">Edit</a>
                                        <form action="{{ route('admin.portfolios.destroy', $portfolio) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded text-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus portofolio ini?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                        Belum ada data portofolio.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $portfolios->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
