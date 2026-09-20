<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - PWL</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        
        .container {
            background: white;
            border-radius: 20px;
            padding: 40px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            text-align: center;
        }
        
        .avatar {
            width: 120px;
            height: 120px;
            background: linear-gradient(135deg, #d4d4d4 0%, #e8e8e8 100%);
            border-radius: 50%;
            margin: 0 auto 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 50px;
            color: #aaa;
            overflow: hidden;
            object-fit: cover;
        }
        
        .avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .profile-field {
            margin-bottom: 15px;
        }
        
        .field-label {
            background: linear-gradient(90deg, #d4d4d4 0%, #e8e8e8 100%);
            padding: 15px 20px;
            font-size: 16px;
            font-weight: 600;
            color: #333;
            border-radius: 8px;
            margin-bottom: 5px;
        }
        
        .field-value {
            background: #f8f8f8;
            padding: 15px 20px;
            font-size: 16px;
            color: #555;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="avatar">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTpf6jODjgevnw9MLf3xrp4yfgreuJF-xWAhXDwBVtq-u11rjCxgcK7AuQ&s=10" alt="Profile Photo">
        </div>
        
        <div class="profile-field">
            <div class="field-value">{{ $data['nama'] }}</div>
        </div>
        
        <div class="profile-field">
            <div class="field-value">{{ $data['kelas'] }}</div>
        </div>
        
        <div class="profile-field">
            <div class="field-value">{{ $data['npm'] }}</div>
        </div>
    </div>
</body>
</html>