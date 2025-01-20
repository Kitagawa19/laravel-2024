<x-app-layout>
    <div class="container mx-auto mp-5">
        <div class="min-w-screen-lg mx-auto ">
            <form method="POST" action="{{ route('register.store') }}">
                @csrf
                <table class="border-collapase w-full table-auto">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">時間割</th>
                            @foreach (['月', '火', '水', '木', '金', '土'] as $day)
                                <th class="px-4 py-2">{{ $day }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (range(1, 6) as $period)
                            <tr>
                                <td class="px-4 py-2">第{{ $period }}限</td>
                                @foreach (['月', '火', '水', '木', '金', '土'] as $day)
                                    <td class="px-4 py-2">
                                        <select name="schedule[{{ $day }}][{{ $period }}]" class="w-full h-10 border border-gray-300 rounded-lg">
                                            <option value="">選択してください</option>
                                            @foreach ($subject as $item)
                                                @if (in_array($period, explode(',', $item->detail->time)) && $item->detail->date == $day)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <button class="register-button" type="submit">登録</button>
            </form>
            <div class="p-4 bg-white rounded-lg shadow-lg mt-4">
                <h2 class="text-xl font-semibold mb-4">履修登録可能科目</h2>
                <div class="scrollable">
                    @foreach ($subject as $item)
                        <div id="subject-{{ $item->id }}" class="subject-item">
                            <div class="font-bold">{{ $item->name }}</div>
                            <div class="text-sm">{{ $item->teacher->name }}</div>
                            <div class="text-sm">{{ $item->detail->date }} | {{ $item->detail->time }}</div>
                            <div class="text-sm">単位: {{ $item->detail->credit }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<style>
    .scrollable {
            max-height: 400px;
            overflow-y: auto;
        }
        
        .subject-item {
            color: black;
            padding: 16px;
            margin-bottom: 8px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            cursor: pointer;
        }

        .subject-item .font-bold {
            font-size: 16px;
            margin-bottom: 4px;
        }

        .subject-item .text-sm {
            font-size: 14px;
        }
        .register-button {
            margin: 20px 0;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        .register-button:hover {
            background-color: #45a049;
        }

</style>
