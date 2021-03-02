<!DOCTYPE html>
<html>
<head>
    <title>Izveštaj za poslednjih {{ $data['day_count'] }} dana</title>
</head>
<body>
    <h1>Izveštaj za poslednjih {{ $data['day_count'] }} dana</h1>
    <p>
        Spavao si {{ $data['avgs']['avg_sleep_duration'] }} u proseku u poslednjih {{ $data['day_count'] }} dana.
        U proseku si zaspao u {{ $data['avgs']['avg_sleep_start'] }}.
        U proseku si se probudio {{ $data['avgs']['avg_sleep_end'] }}.
    </p>
    <p>
        U proseku si klopnuo {{ $data['avgs']['avg_meal_number'] }} puta u poslednjih {{ $data['day_count'] }} dana.
    </p>
    <p>
        Vežbao si {{ $data['avgs']['avg_activity_duration'] }} sati dnevno u proseku u poslednjih {{ $data['day_count'] }} dana.
    </p>
</body>
</html>
