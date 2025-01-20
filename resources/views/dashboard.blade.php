<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __("履修登録アプリ") }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6">
            <div class="flex mb-2">
                <div class="items-center">
                    <x-primary-button class="m-2" onClick="location.href='{{route('register.getSubject')}}' ">
                        {{ __("履修登録") }}
                    </x-primary-button>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="font-semibold text-lg text-gray-800 mb-4">履修登録一覧</h3>
                    <table class="min-w-full table-auto border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="border border-gray-300 px-4 py-2 text-left">曜日</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">時間帯</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">科目名</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">担当教員</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">単位数</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($registrations as $registration)
                                <tr>
                                    <td class="border border-gray-300 px-4 py-2">{{ $registration->subject->detail->date }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $registration->subject->detail->time }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $registration->subject->name }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $registration->subject->teacher->name }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $registration->subject->detail->credit }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="border border-gray-300 px-4 py-2 text-center">履修登録データがありません。</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
