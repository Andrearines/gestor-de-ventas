<div class="min-h-screen flex items-center justify-center p-4">
    <!-- Componente oficial de alertas -->
    <?php \components\ComponentManager::make('alert/alertas', ['alertas' => $alertas ?? []])->echo(); ?>

    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl overflow-hidden">
        <div class="p-8">
            <div class="text-center mb-10">
                <div
                    class="inline-flex items-center justify-center w-20 h-20 bg-primary/10 rounded-2xl text-primary mb-6">
                    <i class="fa-solid fa-burger text-4xl"></i>
                </div>
                <h1 class="text-3xl font-bold text-gray-900">Bienvenido</h1>
                <p class="text-gray-500 mt-2">Ingresa tus credenciales para continuar</p>
            </div>

            <form action="/auth/login" method="POST" class="space-y-6">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Correo Electrónico</label>
                    <div class="relative">
                        <i class="fa-solid fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input type="email" id="email" name="email" required
                            class="w-full pl-12 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition-all"
                            placeholder="tu@correo.com">
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Contraseña</label>
                    <div class="relative">
                        <i class="fa-solid fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input type="password" id="password" name="password" required
                            class="w-full pl-12 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition-all"
                            placeholder="••••••••">
                    </div>
                </div>

                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" class="rounded border-gray-300 text-primary focus:ring-primary">
                        <span class="text-gray-600">Recordarme</span>
                    </label>
                    <a href="#" class="font-medium text-primary hover:text-primary-dark transition-colors">¿Olvidaste tu
                        contraseña?</a>
                </div>

                <button type="submit"
                    class="w-full py-4 bg-primary text-white font-bold rounded-xl shadow-lg shadow-primary/20 hover:bg-primary-dark transform active:scale-[0.98] transition-all">
                    Iniciar Sesión
                </button>
            </form>
        </div>

        <div class="p-6 bg-gray-50 border-t border-gray-100 text-center">
            <p class="text-sm text-gray-600">
                ¿No tienes cuenta? <span class="text-primary font-medium">Contacta al administrador</span>
            </p>
        </div>
    </div>
</div>