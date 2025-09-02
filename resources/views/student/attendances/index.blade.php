<x-student-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat Absensi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-xl font-semibold mb-4">Rekapitulasi Kehadiran</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Mata Pelajaran</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-green-500 uppercase">Hadir</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-yellow-500 uppercase">Izin</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-blue-500 uppercase">Sakit</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-red-500 uppercase">Alpha</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Total</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($recap as $subjectName => $data)
                                <tr>
                                    <td class="px-6 py-4">{{ $subjectName }}</td>
                                    <td class="px-6 py-4 text-center">{{ $data['Hadir'] }}</td>
                                    <td class="px-6 py-4 text-center">{{ $data['Izin'] }}</td>
                                    <td class="px-6 py-4 text-center">{{ $data['Sakit'] }}</td>
                                    <td class="px-6 py-4 text-center">{{ $data['Alpha'] }}</td>
                                    <td class="px-6 py-4 text-center">{{ $data['total'] }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">Belum ada riwayat absensi.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-student-layout>
