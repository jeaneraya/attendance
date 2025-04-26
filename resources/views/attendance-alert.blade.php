<!DOCTYPE html>
<html>
<head>
    <title>Attendance</title>
</head>
<body>
    <script>
        alert("✅ Attendance Recorded for {{ $student->first_name }} {{ $student->middle_name }} {{ $student->last_name }}!");

        window.location.href = "about:blank";

        // Option 3: Try to close the tab (browser may block this)
        // window.close();
    </script>
</body>
</html>
