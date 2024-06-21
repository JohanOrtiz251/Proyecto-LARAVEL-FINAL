<!-- resources/views/dashboard-empleado.blade.php -->

<x-emple-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white dark:text-gray-200 leading-tight">
            {{ __('Dashboard-empleado') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Bienvenido al Gestor de Inventarios</h1>
                
                <p class="text-gray-700 dark:text-gray-300 mb-4">
                    ¡Hola y bienvenido al Gestor de Inventarios! Estamos encantados de tenerte con nosotros. Aquí podrás gestionar y optimizar tu inventario de manera eficiente. A continuación, te presentamos las principales funciones y cómo puedes empezar a utilizarlas.
                </p>
                
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white mt-6">Funciones Principales</h2>
                <ul class="list-disc list-inside text-gray-700 dark:text-gray-300 mb-4">
                    <li><strong>Dashboard:</strong> Mantente al tanto de tu inventario con un resumen rápido de tus productos, niveles de stock, y alertas importantes.</li>
                    <li><strong>Gestión de Productos:</strong> Añade, edita y elimina productos de tu inventario. Mantén toda la información de tus productos actualizada y accesible.</li>
                    <li><strong>Control de Stock:</strong> Monitorea las entradas y salidas de productos en tiempo real. Establece niveles mínimos de stock para recibir alertas cuando sea necesario reabastecer.</li>
                    <li><strong>Reportes y Análisis:</strong> Genera reportes detallados sobre el rendimiento de tu inventario. Identifica tendencias y toma decisiones informadas para mejorar tu gestión.</li>
                    <li><strong>Alertas y Notificaciones:</strong> Configura alertas personalizadas para estar siempre informado sobre el estado de tu inventario.</li>
                    <li><strong>Integraciones:</strong> Conecta tu gestor de inventarios con otras aplicaciones y servicios para automatizar y simplificar tu trabajo diario.</li>
                </ul>
                
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white mt-6">Cómo Empezar</h2>
                <ol class="list-decimal list-inside text-gray-700 dark:text-gray-300 mb-4">
                    <li><strong>Configura tu Perfil:</strong> Personaliza tu perfil y ajusta las configuraciones iniciales para adaptar el gestor de inventarios a tus necesidades.</li>
                    <li><strong>Añade tus Productos:</strong> Comienza añadiendo los productos que tienes en tu inventario. Puedes hacerlo manualmente o importando una lista desde un archivo.</li>
                    <li><strong>Establece Niveles de Stock:</strong> Define los niveles mínimos y máximos de stock para cada producto para recibir alertas automáticas cuando sea necesario.</li>
                    <li><strong>Explora el Dashboard:</strong> Familiarízate con el dashboard y sus funcionalidades para obtener una visión general de tu inventario.</li>
                </ol>
                
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white mt-6">Recursos de Ayuda</h2>
                <ul class="list-disc list-inside text-gray-700 dark:text-gray-300 mb-4">
                    <li><strong>Guía de Usuario:</strong> Consulta nuestra guía detallada para aprender a utilizar todas las funciones del gestor de inventarios.</li>
                    <li><strong>Soporte Técnico:</strong> Si necesitas ayuda, nuestro equipo de soporte está disponible para asistirte.</li>
                    <li><strong>Preguntas Frecuentes:</strong> Encuentra respuestas a las preguntas más comunes sobre el uso del gestor de inventarios.</li>
                </ul>

                <h2 class="text-xl font-semibold text-gray-900 dark:text-white mt-6">Contacto</h2>
                <p class="text-gray-700 dark:text-gray-300 mb-4">
                    ¿Tienes alguna pregunta o sugerencia? No dudes en contactarnos a través de nuestro correo electrónico: soporte@gestorinventarios.com o llámanos al +123 456 7890.
                </p>

                <div class="mt-6">
                    <a href="#" class="bg-blue-500 text-white px-4 py-2 rounded shadow hover:bg-blue-700">
                        ¡Comienza Ahora!
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-emple-layout>
