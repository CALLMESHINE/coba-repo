<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Page</title>
  <!-- Font Awesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-0u/43o2lsO2dJ1V+i9UxMW2odU9AStodX/Gn8uTpQ3HUPUqbu++R1LMT1J6WWs0Zl55fNsPIUcNJLH/fwtg3aQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <style>
    body {
      font-family: 'Arial', sans-serif;
      margin: 0;
      padding: 0;
      display: flex;
      flex-direction: column;
      height: 100vh;
    }

    header {
      background-color: #333;
      color: #fff;
      padding: 10px;
      box-sizing: border-box;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    header img {
      width: 200px;
      height: 40px;
      margin-right: 10px;
    }

    header .user-info {
      display: flex;
      align-items: center;
    }

    header .user-info img {
      width: 60px;
      height: 40px;
      border-radius: 50%;
      margin-right: 10px;
    }

    main {
      display: flex;
      flex-grow: 1;
    }

    nav {
      width: 200px;
      background-color: #333;
      color: #fff;
      padding: 20px;
      box-sizing: border-box;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    nav h2 {
      margin-bottom: 20px;
    }

    nav img {
      width: 110px;
      height: 90px;
      border-radius: 50%;
      margin-bottom: 10px;
    }

    nav a {
      text-decoration: none;
      color: #fff;
      display: flex;
      align-items: right;
      margin-bottom: 10px;
    }

    nav a i {
      margin-right: 10px;
    }

    .content {
      flex-grow: 1;
      padding: 20px;
    }

    .sidebar {
      width: 200px;
      background-color: #444;
      color: #fff;
      padding: 20px;
      box-sizing: border-box;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .sidebar a {
      text-decoration: none;
      color: #fff;
      display: flex;
      align-items: center;
      margin-bottom: 10px;
    }

    .sidebar a i {
      margin-right: 10px;
    }
    .infobox {
      background-color: #f5f5f5;
      border: 1px solid #ddd;
      padding: 20px;
      margin-bottom: 20px;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .infobox h3 {
      color: #333;
      margin-bottom: 10px;
    }

    .infobox p {
      color: #555;
    }
  </style>
</head>
<body>
  <header>
    <img src="img/logo.png" alt="Logo">
    <div class="user-info">
      <img src="img/motor.png" alt="User Avatar">
      <span>John Doe</span> <!-- Ganti dengan nama pengguna yang sesuai -->
    </div>
  </header>
  <main>
    <nav>
      <img src="img/wonosobo.png" alt="Logo">
      <h2>Admin Panel</h2>
      <a href="#"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
      <a href="#"><i class="fas fa-users"></i> Users</a>
      <a href="#"><i class="fas fa-box"></i> Products</a>
      <a href="#"><i class="fas fa-cogs"></i> Settings</a>
    </nav>
    <div class="content">
    <div class="infobox">
        <h3>Info Box Title</h3>
        <p>This is a simple info box with some information. You can customize the content and style as needed.</p>
      </div>
      <h1>Welcome to the Admin Panel</h1>
      <!-- Content of the admin page goes here -->
    </div>
    <div class="sidebar">
      <a href="#"><i class="fas fa-chart-bar"></i> Analytics</a>
      <a href="#"><i class="fas fa-envelope"></i> Messages</a>
      <a href="#"><i class="fas fa-calendar-alt"></i> Calendar</a>
      <!-- Add more sidebar items with icons as needed -->
    </div>
  </main>
</body>
</html>
