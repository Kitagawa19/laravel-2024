<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>履修登録授業一覧</title>
</head>
<body>
    <div class="container">
        <h1>履修登録授業一覧</h1>
        
        <form method="GET" action="{{ route('courses.show') }}">
            <div class="filter-section">
                <select name="term">
                    <option value="">学期を選択</option>
                    <option value="前期" {{ old('term', $term) == '前期' ? 'selected' : '' }}>前期</option>
                    <option value="後期" {{ old('term', $term) == '後期' ? 'selected' : '' }}>後期</option>
                </select>

                <select name="day">
                    <option value="">曜日を選択</option>
                    <option value="月" {{ old('day', $day) == '月' ? 'selected' : '' }}>月曜日</option>
                    <option value="火" {{ old('day', $day) == '火' ? 'selected' : '' }}>火曜日</option>
                    <option value="水" {{ old('day', $day) == '水' ? 'selected' : '' }}>水曜日</option>
                    <option value="木" {{ old('day', $day) == '木' ? 'selected' : '' }}>木曜日</option>
                    <option value="金" {{ old('day', $day) == '金' ? 'selected' : '' }}>金曜日</option>
                </select>

                <select name="period">
                    <option value="">時限を選択</option>
                    <option value="1" {{ old('period', $period) == '1' ? 'selected' : '' }}>1限</option>
                    <option value="2" {{ old('period', $period) == '2' ? 'selected' : '' }}>2限</option>
                </select>

                <input type="text" name="search" value="{{ old('search', $search) }}" placeholder="科目名で検索">
                <button type="submit">フィルタリング</button>
                <button type="reset" onclick="window.location.href='{{ route('courses.show') }}'">リセット</button>
            </div>
        </form>

        <div class="summary">
            <p>合計単位数: <span>{{ $totalCredits }}</span>単位</p>
            <p>登録科目数: <span>{{ $totalCourses }}</span>科目</p>
        </div>

        <table>
            <thead>
                <tr>
                    <th>科目コード</th>
                    <th>科目名</th>
                    <th>担当教員</th>
                    <th>開講期間</th>
                    <th>曜日・時限</th>
                    <th>単位数</th>
                    <th>履修状態</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($courses as $course)
                    <tr>
                        <td>{{ $course['code'] }}</td>
                        <td>{{ $course['name'] }}</td>
                        <td>{{ $course['teacher'] }}</td>
                        <td>{{ $course['term'] }}</td>
                        <td>{{ $course['day'] }} {{ $course['period'] }}限</td>
                        <td>{{ $course['credits'] }}</td>
                        <td>{{ $course['status'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
