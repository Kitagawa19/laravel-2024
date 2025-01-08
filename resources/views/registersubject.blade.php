<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>履修登録</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    <style>
        .schedule-table td {
            min-width: 80px;
            height: 40px;
        }

        .schedule-table select {
            width: 100%;
            height: 35px;
            font-size: 14px;
            padding: 2px;
            box-sizing: border-box;
        }

        .scrollable {
            max-height: 400px;
            overflow-y: auto;
        }

        .subject-item {
            cursor: pointer;
        }

        .subject-item:active {
            cursor: grabbing;
        }

        .schedule-table-wrapper {
            overflow-x: auto;
        }

        .container {
            max-width: 1200px;
            margin: auto;
            padding: 16px;
        }

        .register-button {
            display: block;
            width: 100%;
            max-width: 300px;
            margin: 16px auto;
            padding: 12px;
            text-align: center;
            background-color: #4CAF50;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        .register-button:hover {
            background-color: #45a049;
        }

        /* レスポンシブ対応 */
        @media (max-width: 768px) {
            .schedule-table {
                font-size: 12px;
                border-collapse: collapse;
            }

            .schedule-table th, .schedule-table td {
                padding: 2px;
                min-width: 70px;
                height: 35px;
            }

            .schedule-table select {
                font-size: 12px;
                height: 30px;
            }

            .schedule-table-wrapper {
                overflow-x: scroll;
                -webkit-overflow-scrolling: touch;
            }

            .subject-item {
                font-size: 14px;
                padding: 8px;
            }

            .register-button {
                font-size: 14px;
                padding: 10px;
            }
        }

        .remove-button {
            background-color: #f44336;
            color: black;
            font-size: 12px;
            padding: 4px 8px;
            border-radius: 4px;
            cursor: pointer;
            border: none;
        }

        .remove-button:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body class="bg-gray-100">

    <div class="container">
        <div class="p-4 bg-white rounded-lg shadow-lg">
            <div class="schedule-table-wrapper">
                <table class="schedule-table min-w-full border-collapse">
                    <thead>
                        <tr>
                            <th class="border p-2 text-center bg-gray-200"></th>
                            @foreach (['月', '火', '水', '木', '金', '土'] as $day)
                                <th class="border p-2 text-center bg-gray-200">{{ $day }}</th>
                            @endforeach
                        </tr>
                    </thead>

                    <tbody>
                        @foreach (range(1, 6) as $period)
                            <tr>
                                <td class="border p-2 text-center bg-gray-200 font-semibold">第{{ $period }}限</td>
                                @foreach (['月', '火', '水', '木', '金', '土'] as $day)
                                    <td id="slot-{{ $day }}-{{ $period }}"
                                        class="border p-2 text-center bg-gray-50 h-24">
                                        <select id="subject-select-{{ $day }}-{{ $period }}" class="subject-select" onchange="updateSchedule(event, '{{ $day }}', {{ $period }})">
                                            <option value="">選択してください</option>
                                            @foreach ($subject as $item)
                                                @if (in_array($period, explode(',', $item->detail->time)) && $item->detail->date == $day)
                                                    <option value="{{ $item->id }}">{{ $item->name }} ({{ $item->teacher->name }})</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="p-4 bg-white rounded-lg shadow-lg mt-4">
            <h2 class="text-xl font-semibold mb-4">履修登録可能科目</h2>
            <div class="scrollable space-y-4">
                @foreach ($subject as $item)
                    <div id="subject-{{ $item->id }}" class="subject-item bg-blue-500 p-4 rounded-lg cursor-pointer shadow-md">
                        <div class="font-bold text-lg">{{ $item->name }}</div>
                        <div class="text-sm">{{ $item->teacher->name }}</div>
                        <div class="text-sm">{{ $item->detail->date }} | {{ $item->detail->time }}</div>
                        <div class="text-sm">単位: {{ $item->detail->credit }}</div>
                    </div>
                @endforeach
            </div>
        </div>

        <button onclick="registerSchedule()" class="register-button">登録</button>
    </div>

    <script>
        function updateSchedule(event, day, period) {
            const subjectId = event.target.value;
            const selectElement = event.target;

            if (subjectId !== "") {
                const selectedSubject = document.querySelector(`#subject-${subjectId}`);
                const subjectName = selectedSubject.querySelector('.font-bold').textContent;
                const teacherName = selectedSubject.querySelector('.text-sm').textContent.split(' | ')[0];

                selectElement.setAttribute('data-selected-name', subjectName);
                selectElement.setAttribute('data-selected-teacher', teacherName);
            } else {
                selectElement.removeAttribute('data-selected-name');
                selectElement.removeAttribute('data-selected-teacher');
            }
        }

        function registerSchedule() {
            const selectedSubjects = [];
            const selectElements = document.querySelectorAll('.subject-select');

            selectElements.forEach(select => {
                if (select.value !== "") {
                    selectedSubjects.push({
                        subjectId: select.value,
                        subjectName: select.getAttribute('data-selected-name'),
                        teacherName: select.getAttribute('data-selected-teacher')
                    });
                }
            });

            console.log("登録される科目:", selectedSubjects);
            alert("選択した科目が登録されました。");
        }
    </script>

</body>
</html>
