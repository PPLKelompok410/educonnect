<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>EduConnect Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background-color: #f9f9f9;
    }
    .navbar {
      background-color: #2563EB;
      padding: 16px;
      color: white;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .navbar .welcome {
      margin-left: 16px;
      font-size: 18px;
    }
    .navbar .logo {
      margin-right: 16px;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <div class="navbar">
    <div class="welcome">Welcome, {{ session('user')->full_name }}</span>!</div>
    <div class="logo">EduConnect</div>
  </div>

</body>
</html>
