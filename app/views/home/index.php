<?php
// Vista de Inicio (Landing Page)
?>

<div class="home-container">
    <section class="hero">
        <div class="hero-content">
            <h1>Sistema de Gestión de Ventas Benéficas</h1>
            <p>Organiza, vende y supervisa tus eventos de recaudación de fondos de manera profesional y eficiente.</p>
            <div class="hero-cta">
                <a href="/auth/login" class="btn btn-primary btn-lg">Entrar al Sistema</a>
                <a href="#features" class="btn btn-outline btn-lg">Saber más</a>
            </div>
        </div>
        <div class="hero-image">
            <div class="hero-card-floating">
                <div class="floating-header">
                    <span class="dot red"></span>
                    <span class="dot yellow"></span>
                    <span class="dot green"></span>
                </div>
                <div class="floating-content">
                    <div class="mock-stats">
                        <div class="mock-stat-bar" style="height: 60%"></div>
                        <div class="mock-stat-bar" style="height: 80%"></div>
                        <div class="mock-stat-bar" style="height: 45%"></div>
                        <div class="mock-stat-bar" style="height: 90%"></div>
                    </div>
                    <div class="mock-text">
                        <div class="line"></div>
                        <div class="line short"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="features" class="features-section">
        <div class="section-header">
            <h2>Características Principales</h2>
            <p>Todo lo que necesitas para que tu evento sea un éxito.</p>
        </div>
        <div class="features-grid">
            <div class="feature-card">
                <i class="fa-solid fa-calendar-check"></i>
                <h3>Gestión de Eventos</h3>
                <p>Crea y administra múltiples eventos benéficos de forma simultánea.</p>
            </div>
            <div class="feature-card">
                <i class="fa-solid fa-ticket"></i>
                <h3>Control de Boletos</h3>
                <p>Inventario digital, asignación a vendedores y seguimiento en tiempo real.</p>
            </div>
            <div class="feature-card">
                <i class="fa-solid fa-users"></i>
                <h3>Equipos de Venta</h3>
                <p>Organiza a tus colaboradores en equipos y mide su rendimiento.</p>
            </div>
            <div class="feature-card">
                <i class="fa-solid fa-chart-pie"></i>
                <h3>Analíticas Avanzadas</h3>
                <p>Visualiza tus ingresos y disponibilidad con gráficas interactivas.</p>
            </div>
        </div>
    </section>

    <footer class="home-footer">
        <p>&copy;
            <?php echo date('Y'); ?> Gestor de Ventas Benéficas. Todos los derechos reservados.
        </p>
    </footer>
</div>

<style>
    .home-container {
        padding: 0;
        font-family: 'Inter', sans-serif;
    }

    .hero {
        min-height: 80vh;
        display: flex;
        align-items: center;
        padding: 2rem 10%;
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        overflow: hidden;
    }

    .hero-content {
        flex: 1;
    }

    .hero-content h1 {
        font-size: 3.5rem;
        font-weight: 800;
        line-height: 1.1;
        color: #1e293b;
        margin-bottom: 1.5rem;
    }

    .hero-content p {
        font-size: 1.25rem;
        color: #64748b;
        margin-bottom: 2.5rem;
        max-width: 500px;
    }

    .hero-cta {
        display: flex;
        gap: 1rem;
    }

    .btn-lg {
        padding: 1rem 2rem;
        font-size: 1.1rem;
        font-weight: 600;
        border-radius: 50px;
    }

    .btn-outline {
        border: 2px solid #cbd5e1;
        background: transparent;
        color: #64748b;
    }

    .hero-image {
        flex: 1;
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .hero-card-floating {
        width: 350px;
        height: 250px;
        background: white;
        border-radius: 20px;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        padding: 1rem;
        animation: float 6s ease-in-out infinite;
    }

    @keyframes float {
        0% {
            transform: translateY(0px);
        }

        50% {
            transform: translateY(-20px);
        }

        100% {
            transform: translateY(0px);
        }
    }

    .floating-header {
        display: flex;
        gap: 6px;
        margin-bottom: 1.5rem;
    }

    .dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
    }

    .dot.red {
        background: #ff5f56;
    }

    .dot.yellow {
        background: #ffbd2e;
    }

    .dot.green {
        background: #27c93f;
    }

    .mock-stats {
        display: flex;
        align-items: flex-end;
        gap: 15px;
        height: 100px;
        margin-bottom: 1.5rem;
        padding: 0 20px;
    }

    .mock-stat-bar {
        flex: 1;
        background: #3b82f6;
        border-radius: 4px;
        opacity: 0.8;
    }

    .mock-text .line {
        height: 8px;
        background: #f1f5f9;
        border-radius: 4px;
        margin-bottom: 8px;
    }

    .mock-text .line.short {
        width: 60%;
    }

    .features-section {
        padding: 5rem 10%;
        background: white;
    }

    .section-header {
        text-align: center;
        margin-bottom: 4rem;
    }

    .section-header h2 {
        font-size: 2.5rem;
        color: #1e293b;
        margin-bottom: 1rem;
    }

    .features-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 2rem;
    }

    .feature-card {
        padding: 2.5rem;
        border-radius: 20px;
        background: #fdfdfd;
        border: 1px solid #f1f5f9;
        transition: all 0.3s ease;
        text-align: center;
    }

    .feature-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.1);
    }

    .feature-card i {
        font-size: 2.5rem;
        color: #3b82f6;
        margin-bottom: 1.5rem;
    }

    .feature-card h3 {
        margin-bottom: 1rem;
    }

    .home-footer {
        padding: 3rem;
        text-align: center;
        border-top: 1px solid #f1f5f9;
        color: #64748b;
    }

    @media (max-width: 1024px) {
        .hero {
            flex-direction: column;
            text-align: center;
            padding-top: 5rem;
        }

        .hero-content h1 {
            font-size: 2.5rem;
        }

        .hero-content p {
            margin: 0 auto 2.5rem auto;
        }

        .hero-cta {
            justify-content: center;
        }

        .hero-image {
            margin-top: 4rem;
        }
    }
</style>