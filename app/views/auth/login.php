<div class="h-screen w-full flex overflow-hidden bg-white">
    <!-- Componente oficial de alertas (Flotante) -->
    <?php \components\ComponentManager::make('alert/alertas', ['alertas' => $alertas ?? ["hola"]])->echo(); ?>

    <div class="login-layout">
        <!-- Visual Branding Section (Left) -->
        <div class="login-visual">
            <div class="visual-content">
                <div class="brand-badge">
                    <i class="fa-solid fa-layer-group"></i>
                    <span>Gestor de Ventas</span>
                </div>

                <div class="hero-text">
                    <h1>Gestión Inteligente para<br>Tus Eventos</h1>
                    <p>Administra ventas, controla inventarios y visualiza métricas en tiempo real con nuestra
                        plataforma premium.</p>
                </div>

                <!-- Testimonial/Trust Indicator -->
                <div class="trust-indicator">
                    <div class="avatars">
                        <div class="avatar" style="background-image: url('https://i.pravatar.cc/100?img=33');"></div>
                        <div class="avatar" style="background-image: url('https://i.pravatar.cc/100?img=47');"></div>
                        <div class="avatar" style="background-image: url('https://i.pravatar.cc/100?img=12');"></div>
                    </div>
                    <div class="trust-text">
                        <div class="stars">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                        <p>Confiado por +500 organizaciones</p>
                    </div>
                </div>
            </div>

            <!-- Background Pattern/Overlay -->
            <div class="visual-overlay"></div>
        </div>

        <!-- Login Form Section (Right) -->
        <div class="login-form-wrapper">
            <div class="login-container">
                <div class="form-header">
                    <div class="logo-icon">
                        <i class="fa-solid fa-fingerprint"></i>
                    </div>
                    <h2>Bienvenido de nuevo</h2>
                    <p>Ingresa tus credenciales para acceder al panel.</p>
                </div>

                <form method="POST" action="/" class="auth-form">

                    <div class="form-group">
                        <label for="email">Correo Electrónico</label>
                        <div class="input-wrapper">
                            <i class="input-icon fa-regular fa-envelope"></i>
                            <input type="email" id="email" name="email" required placeholder="nombre@ejemplo.com">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <div class="input-wrapper">
                            <i class="input-icon fa-regular fa-lock"></i>
                            <input type="password" id="password" name="password" required placeholder="••••••••">
                        </div>
                    </div>

                    <div class="form-actions">
                        <div class="remember-me">
                            <input type="checkbox" id="remember" name="remember">
                            <label for="remember">Recordar dispositivo</label>
                        </div>
                        <a href="#" class="forgot-password">¿Olvidaste tu contraseña?</a>
                    </div>

                    <button type="submit" class="btn-login">
                        Iniciar Sesión
                        <i class="fa-solid fa-arrow-right"></i>
                    </button>
                </form>

                <div class="form-footer">
                    <p>¿No tienes una cuenta? <a href="#">Contactar soporte</a></p>
                </div>
            </div>
        </div>
    </div>
</div>