<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }
    
    body {
      background: linear-gradient(135deg, #0047AB 0%, #000000 100%);
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    
    .login-container {
      background-color: white;
      border-radius: 20px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
      width: 100%;
      max-width: 420px;
      padding: 40px 30px;
      position: relative;
      overflow: hidden;
    }
    
    .login-container::before {
      content: "";
      position: absolute;
      top: -50px;
      left: -50px;
      width: 150px;
      height: 150px;
      background-color: rgba(0, 71, 171, 0.1);
      border-radius: 50%;
      z-index: 0;
    }
    
    .login-container::after {
      content: "";
      position: absolute;
      bottom: -70px;
      right: -70px;
      width: 200px;
      height: 200px;
      background-color: rgba(0, 0, 0, 0.05);
      border-radius: 50%;
      z-index: 0;
    }
    
    .login-header {
      text-align: center;
      margin-bottom: 30px;
      position: relative;
      z-index: 1;
    }
    
    .login-header h1 {
      color: #111;
      font-size: 28px;
      font-weight: 600;
    }
    
    .login-header p {
      color: #666;
      font-size: 14px;
      margin-top: 5px;
    }
    
    .input-group {
      margin-bottom: 25px;
      position: relative;
      z-index: 1;
    }
    
    .input-group label {
      display: block;
      color: #333;
      font-size: 16px;
      font-weight: 500;
      margin-bottom: 8px;
    }
    
    .input-field {
      position: relative;
    }
    
    .input-field input {
      width: 100%;
      padding: 15px;
      border: 2px solid #ddd;
      border-radius: 12px;
      font-size: 15px;
      transition: all 0.3s;
      background-color: #f9f9f9;
    }
    
    .input-field input:focus {
      border-color: #0047AB;
      box-shadow: 0 0 10px rgba(0, 71, 171, 0.1);
      outline: none;
      background-color: #fff;
    }
    
    .input-field input::placeholder {
      color: #aaa;
    }

    .toggle-password {
      position: absolute;
      right: 15px;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
      color: #666;
      transition: all 0.3s;
    }

    .toggle-password:hover {
      color: #0047AB;
    }
    
    .password-toggle-wrap {
      display: flex;
      align-items: center;
      justify-content: flex-end;
      margin-bottom: 20px;
    }

    .password-toggle-wrap label {
      user-select: none;
      cursor: pointer;
      font-size: 14px;
      color: #0047AB;
      display: flex;
      align-items: center;
    }

    .password-toggle-wrap input[type="checkbox"] {
      margin-right: 5px;
    }
    
    .submit-btn {
      width: 100%;
      background: linear-gradient(to right, #0047AB, #001F3F);
      color: white;
      border: none;
      padding: 15px;
      border-radius: 12px;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s;
      box-shadow: 0 5px 15px rgba(0, 71, 171, 0.2);
      position: relative;
      z-index: 1;
    }
    
    .submit-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(0, 71, 171, 0.3);
    }
    
    .submit-btn:active {
      transform: translateY(1px);
    }
    
    .register-link {
      text-align: center;
      margin-top: 25px;
      font-size: 14px;
      color: #666;
      position: relative;
      z-index: 1;
    }
    
    .register-link a {
      color: #0047AB;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.3s;
    }
    
    .register-link a:hover {
      text-decoration: underline;
    }
    
    .error-message {
      color: #e53935;
      font-size: 13px;
      margin-top: 5px;
      display: block;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <div class="login-header">
      <h1>Selamat Datang</h1>
      <p>Silakan masuk untuk melanjutkan</p>
    </div>
    
    <form action="{{ route('login') }}" method="POST">
      @csrf
      <div class="input-group">
        <label for="email">Email</label>
        <div class="input-field">
          <input type="email" id="email" name="email" placeholder="Masukkan email Anda" value="{{ old('email') }}" required>
          @error('email')
            <span class="error-message">{{ $message }}</span>
          @enderror
        </div>
      </div>
      
      <div class="input-group">
        <label for="password">Password</label>
        <div class="input-field">
          <input type="password" id="password" name="password" placeholder="Masukkan password Anda" required>
          <i class="toggle-password fa fa-eye-slash" onclick="togglePassword()"></i>
          @error('password')
            <span class="error-message">{{ $message }}</span>
          @enderror
        </div>
      </div>
      
      <button type="submit" class="submit-btn">Masuk</button>
    </form>
  </div>

  <script>
    function togglePassword() {
      const passwordInput = document.getElementById('password');
      const toggleIcon = document.querySelector('.toggle-password');
      const showPasswordCheckbox = document.getElementById('show-password');
      
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye');
        showPasswordCheckbox.checked = true;
      } else {
        passwordInput.type = 'password';
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash');
        showPasswordCheckbox.checked = false;
      }
    }
  </script>
</body>
</html>