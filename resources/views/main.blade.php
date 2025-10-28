<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My App')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Reset & base styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            display: flex;
            flex-direction: column;
            height: 100vh;
            background: #f5f7fa;
        }

        /* Navbar */
        .navbar {
            height: 60px;
            background-color: #1f2937;
            color: white;
            display: flex;
            align-items: center;
            padding: 0 20px;
            font-weight: 500;
        }

        /* Layout container */
        .layout {
            flex: 1;
            display: flex;
            overflow: hidden;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background-color: #111827;
            color: white;
            transition: width 0.3s ease;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .sidebar.collapsed {
            width: 70px;
        }

        .sidebar .toggle-btn {
            padding: 15px;
            cursor: pointer;
            text-align: center;
            background-color: #1f2937;
        }

        .sidebar ul {
            list-style: none;
            padding: 10px;
        }

        .sidebar li {
            padding: 12px 20px;
            cursor: pointer;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            transition: background 0.2s ease;
        }

        .sidebar li:hover {
            background-color: #374151;
        }

        /* Content */
        .content {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
        }

        /* Bottom bar */
        .bottom-bar {
            height: 50px;
            background-color: #1f2937;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Sidebar toggle icon */
        .sidebar .toggle-btn span {
            display: inline-block;
            transition: transform 0.3s ease;
        }

        .sidebar.collapsed .toggle-btn span {
            transform: rotate(180deg);
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <div class="navbar">
        My Application
    </div>

    <!-- Layout -->
    <div class="layout">
        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <div class="toggle-btn" onclick="toggleSidebar()">
                <span>&#9776;</span>
            </div>
            <ul>
                <li>Dashboard</li>
                <li>Posts <ul>
                        <li>All Posts</li>
                        <li>Add New Post</li>
                    </ul>
                </li>
                <li>Settings</li>
                <li>Profile</li>
            </ul>
        </div>

        <!-- Content -->
        <div class="content">
            @yield('content')
        </div>
    </div>

    <!-- Bottom Bar -->
    <div class="bottom-bar">
        &copy; 2025 My App
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

    <script>
        const sidebar = document.getElementById('sidebar');

        function toggleSidebar() {
            sidebar.classList.toggle('collapsed');
        }
    </script>
</body>

</html>
