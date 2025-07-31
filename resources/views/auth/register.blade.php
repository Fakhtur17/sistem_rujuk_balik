<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Register Form</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="register-container">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10 col-xl-8">
                    <div class="register-card">
                        <!-- Header -->
                        <div class="register-header">
                            <div class="register-icon">
                                <i class="fas fa-user-plus"></i>
                            </div>
                            <h2 class="register-title">Create Your Account</h2>
                            <p class="register-subtitle">Join us and get started today</p>
                        </div>

                        <!-- Form -->
                        <div class="register-body">
                            <form method="POST" action="{{ route('register') }}" class="register-form">
                                @csrf
                                <div class="form-grid">
                                    <!-- Left Column -->
                                    <div class="form-column">
                                        <!-- Name -->
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-icon">
                                                    <i class="fas fa-user"></i>
                                                </div>
                                                <div class="input-wrapper">
                                                    <label for="name" class="form-label">Full Name</label>
                                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                        id="name" name="name" value="{{ old('name') }}" required autofocus placeholder="Enter your full name">
                                                    @error('name')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Email -->
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-icon">
                                                    <i class="fas fa-envelope"></i>
                                                </div>
                                                <div class="input-wrapper">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                        id="email" name="email" value="{{ old('email') }}" required placeholder="Enter your email address">
                                                    @error('email')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Phone Number -->
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-icon">
                                                    <i class="fas fa-phone"></i>
                                                </div>
                                                <div class="input-wrapper">
                                                    <label for="no_hp" class="form-label">No HP</label>
                                                    <input type="text" class="form-control @error('no_hp') is-invalid @enderror"
                                                        id="no_hp" name="no_hp" value="{{ old('no_hp') }}" required placeholder="08xxxxxxxxxx">
                                                    @error('no_hp')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Right Column -->
                                    <div class="form-column">
                                        <!-- Role -->
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-icon">
                                                    <i class="fas fa-user-tag"></i>
                                                </div>
                                                <div class="input-wrapper">
                                                    <label for="role" class="form-label">Role</label>
                                                    <select name="role" id="role" class="form-select @error('role') is-invalid @enderror" required>
                                                        <option value="">Pilih Role</option>
                                                        <option value="fktp" {{ old('role') == 'fktp' ? 'selected' : '' }}>FKTP</option>
                                                        <option value="fkrtl" {{ old('role') == 'fkrtl' ? 'selected' : '' }}>FKRTL</option>
                                                        <option value="apotek" {{ old('role') == 'apotek' ? 'selected' : '' }}>Apotek</option>
                                                    </select>
                                                    @error('role')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Password -->
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-icon">
                                                    <i class="fas fa-lock"></i>
                                                </div>
                                                <div class="input-wrapper">
                                                    <label for="password" class="form-label">Password</label>
                                                    <input type="password" 
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    id="password" name="password" required
                                                    minlength="8"
                                                    pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}"
                                                    title="Minimal 8 karakter dengan huruf besar, huruf kecil, angka, dan simbol"
                                                    placeholder="Create a strong password">

                                                    @error('password')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Confirm Password -->
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-icon">
                                                    <i class="fas fa-lock"></i>
                                                </div>
                                                <div class="input-wrapper">
                                                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                                    <input type="password" class="form-control"
                                                        id="password_confirmation" name="password_confirmation" required placeholder="Confirm your password">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="form-actions">
                                    <a href="{{ route('login') }}" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left"></i> Back to Login
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-user-plus"></i>
                                        Create Account
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Reset and Base Styles */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            min-height: 100vh;
            padding: 0;
            margin: 0;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 20% 80%, rgba(120, 119, 198, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255, 119, 198, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(120, 219, 255, 0.2) 0%, transparent 50%);
            z-index: -1;
        }

        /* Container */
        .register-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 20px 0;
        }

        .container-fluid {
            width: 100%;
            padding: 0 15px;
        }

        .row {
            display: flex;
            justify-content: center;
            margin: 0;
        }

        .col-12, .col-lg-10, .col-xl-8 {
            width: 100%;
            max-width: 900px;
            padding: 0 15px;
        }

        /* Card - Enhanced with better shadow and border */
        .register-card {
            background: rgba(255, 255, 255, 0.98);
            border-radius: 20px;
            box-shadow: 
                0 32px 64px rgba(0, 0, 0, 0.15),
                0 16px 32px rgba(102, 126, 234, 0.1),
                0 0 0 1px rgba(255, 255, 255, 0.3);
            overflow: hidden;
            backdrop-filter: blur(25px);
            border: 1px solid rgba(255, 255, 255, 0.4);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }

        .register-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #667eea, #764ba2, #f093fb, #667eea);
            background-size: 200% 100%;
            animation: gradientMove 3s ease-in-out infinite;
        }

        @keyframes gradientMove {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        .register-card:hover {
            transform: translateY(-8px);
            box-shadow: 
                0 40px 80px rgba(0, 0, 0, 0.2),
                0 20px 40px rgba(102, 126, 234, 0.15),
                0 0 0 1px rgba(255, 255, 255, 0.4);
        }

        /* Header - Enhanced with better gradients */
        .register-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #8b5fbf 100%);
            color: white;
            padding: 45px 35px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .register-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 25% 25%, rgba(255, 255, 255, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 75% 75%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
                linear-gradient(45deg, transparent 30%, rgba(255, 255, 255, 0.05) 50%, transparent 70%);
            pointer-events: none;
            animation: shimmer 4s ease-in-out infinite;
        }

        @keyframes shimmer {
            0%, 100% { opacity: 0.8; }
            50% { opacity: 1; }
        }

        .register-icon {
            position: relative;
            z-index: 2;
            width: 70px;
            height: 70px;
            background: rgba(255, 255, 255, 0.25);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            backdrop-filter: blur(15px);
            border: 2px solid rgba(255, 255, 255, 0.4);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        .register-icon:hover {
            transform: scale(1.15) rotate(10deg);
            box-shadow: 0 12px 48px rgba(0, 0, 0, 0.15);
        }

        .register-icon i {
            font-size: 1.8rem;
            color: white;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }

        .register-title {
            position: relative;
            z-index: 2;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 12px;
            letter-spacing: -0.025em;
            text-shadow: 0 2px 16px rgba(0, 0, 0, 0.1);
        }

        .register-subtitle {
            position: relative;
            z-index: 2;
            font-size: 1.1rem;
            opacity: 0.95;
            font-weight: 400;
            text-shadow: 0 1px 8px rgba(0, 0, 0, 0.1);
        }

        /* Form Body */
        .register-body {
            padding: 45px 35px;
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.02) 0%, transparent 100%);
        }

        /* Form Grid - Better spacing */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 35px;
            margin-bottom: 35px;
        }

        .form-column {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        /* Form Groups */
        .form-group {
            position: relative;
        }

        .input-group {
            display: flex;
            align-items: flex-start;
            gap: 14px;
        }

        /* Enhanced Icons */
        .input-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            margin-top: 26px;
            box-shadow: 
                0 6px 20px rgba(102, 126, 234, 0.35),
                0 2px 8px rgba(102, 126, 234, 0.2);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .input-icon::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s;
        }

        .input-icon:hover::before {
            left: 100%;
        }

        .input-icon:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 
                0 10px 30px rgba(102, 126, 234, 0.45),
                0 4px 16px rgba(102, 126, 234, 0.3);
        }

        .input-icon i {
            color: white;
            font-size: 1rem;
            text-shadow: 0 1px 4px rgba(0, 0, 0, 0.2);
            position: relative;
            z-index: 1;
        }

        .input-wrapper {
            flex: 1;
        }

        /* Enhanced Labels */
        .form-label {
            display: block;
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
            font-size: 0.95rem;
            letter-spacing: 0.025em;
            transition: color 0.3s ease;
        }

        .form-group:hover .form-label {
            color: #667eea;
        }

        /* Enhanced Inputs */
        .form-control, .form-select {
            width: 100%;
            padding: 14px 18px;
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            font-size: 0.95rem;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            background: #f9fafb;
            color: #374151;
            font-family: inherit;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .form-control:focus, .form-select:focus {
            outline: none;
            border-color: #667eea;
            background: white;
            box-shadow: 
                0 0 0 4px rgba(102, 126, 234, 0.15),
                0 4px 16px rgba(102, 126, 234, 0.1);
            transform: translateY(-2px);
        }

        .form-control::placeholder {
            color: #9ca3af;
            font-size: 0.9rem;
            transition: opacity 0.3s ease;
        }

        .form-control:focus::placeholder {
            opacity: 0.7;
        }

        .form-select {
            cursor: pointer;
            appearance: none;
            background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="%23667eea" stroke-width="2"><polyline points="6,9 12,15 18,9"/></svg>');
            background-repeat: no-repeat;
            background-position: right 18px center;
            background-size: 1rem;
            padding-right: 3.5rem;
        }

        /* Error Messages */
        .invalid-feedback {
            color: #ef4444;
            font-size: 0.85rem;
            margin-top: 6px;
            font-weight: 500;
            margin-left: 54px;
            opacity: 0.9;
        }

        /* Enhanced Action Buttons */
        .form-actions {
            display: flex;
            gap: 20px;
            margin-top: 45px;
            justify-content: center;
        }

        .btn {
            padding: 16px 36px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.95rem;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            display: inline-flex;
            align-items: center;
            gap: 10px;
            min-width: 160px;
            justify-content: center;
            font-family: inherit;
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            box-shadow: 
                0 8px 25px rgba(102, 126, 234, 0.4),
                0 4px 12px rgba(102, 126, 234, 0.2);
        }

        .btn-primary:hover {
            transform: translateY(-4px);
            box-shadow: 
                0 12px 35px rgba(102, 126, 234, 0.5),
                0 6px 20px rgba(102, 126, 234, 0.3);
            color: white;
            text-decoration: none;
        }

        .btn-secondary {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            color: #64748b;
            border: 2px solid #e2e8f0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .btn-secondary:hover {
            background: linear-gradient(135deg, #e2e8f0 0%, #cbd5e1 100%);
            color: #475569;
            transform: translateY(-3px);
            text-decoration: none;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .register-body {
                padding: 30px 25px;
            }

            .register-header {
                padding: 35px 25px;
            }

            .register-title {
                font-size: 1.6rem;
            }

            .form-actions {
                flex-direction: column;
                align-items: stretch;
            }

            .btn {
                width: 100%;
            }

            .input-group {
                align-items: center;
            }

            .input-icon {
                margin-top: 0;
            }
        }

        @media (max-width: 480px) {
            .register-container {
                padding: 15px 0;
            }

            .col-12 {
                padding: 0 15px;
            }

            .register-body {
                padding: 25px 20px;
            }

            .register-header {
                padding: 30px 20px;
            }

            .input-group {
                flex-direction: column;
                gap: 10px;
                align-items: flex-start;
            }

            .input-icon {
                align-self: flex-start;
            }

            .invalid-feedback {
                margin-left: 0;
            }
        }

        /* Enhanced validation states */
        .form-control:valid:not(:placeholder-shown) {
            border-color: #10b981;
            background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="%2310b981" stroke-width="2"><polyline points="20,6 9,17 4,12"/></svg>');
            background-repeat: no-repeat;
            background-position: right 18px center;
            background-size: 1rem;
        }

        .form-control:invalid:not(:placeholder-shown) {
            border-color: #ef4444;
            background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="%23ef4444" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>');
            background-repeat: no-repeat;
            background-position: right 18px center;
            background-size: 1rem;
        }

        .form-select:valid {
            border-color: #10b981;
        }

        /* Loading state */
        .btn:active {
            transform: translateY(-1px);
        }

        /* Enhanced hover effects */
        .form-group:hover .input-icon {
            transform: translateY(-3px) scale(1.05);
        }

        /* Subtle animations */
        .register-card {
            animation: cardFloat 6s ease-in-out infinite;
        }

        @keyframes cardFloat {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-5px); }
        }
    </style>
</body>
<script>
    document.querySelector('.register-form').addEventListener('submit', function (e) {
        const password = document.getElementById('password').value;
        const confirm = document.getElementById('password_confirmation').value;
        const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/;

        if (!passwordRegex.test(password)) {
            alert('Password harus minimal 8 karakter, mengandung huruf besar, huruf kecil, angka, dan simbol.');
            e.preventDefault();
            return;
        }

        if (password !== confirm) {
            alert('Konfirmasi password tidak cocok.');
            e.preventDefault();
        }
    });
</script>

</html>