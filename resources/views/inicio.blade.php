<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-custom-white dark:text-custom-gray leading-tight">
            {{ __('Dashboard-admin') }}         
        </h2>


        

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-custom-white dark:bg-custom-dark overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold text-custom-dark dark:text-custom-white mb-6">Bienvenido al Panel de Administración</h1>
                
                <p class="text-custom-dark-gray dark:text-custom-gray mb-4">
                    ¡Hola y bienvenido al Panel de Administración del Gestor de Inventarios! Aquí podrás gestionar todos los aspectos del sistema de inventario. A continuación, se presentan las funciones principales y cómo puedes empezar a utilizarlas.
                </p>
                
                <h2 class="text-xl font-semibold text-custom-dark dark:text-custom-white mt-6">Funciones Principales</h2>
                <ul class="list-disc list-inside text-custom-dark-gray dark:text-custom-gray mb-4">
                    <li><strong>Dashboard:</strong> Acceso rápido a métricas clave, alertas y resúmenes de inventario.</li>
                    <li><strong>Gestión de Usuarios:</strong> Administra cuentas de usuarios y permisos.</li>
                    <li><strong>Gestión de Productos:</strong> Control completo sobre productos, categorías y proveedores.</li>
                    <li><strong>Reportes Avanzados:</strong> Genera reportes detallados y análisis para la toma de decisiones estratégicas.</li>
                    <li><strong>Configuraciones del Sistema:</strong> Ajusta configuraciones generales y de seguridad del sistema.</li>
                </ul>
                
                <h2 class="text-xl font-semibold text-custom-dark dark:text-custom-white mt-6">Cómo Empezar</h2>
                <ol class="list-decimal list-inside text-custom-dark-gray dark:text-custom-gray mb-4">
                    <li><strong>Explora el Dashboard:</strong> Familiarízate con las métricas y funciones disponibles.</li>
                    <li><strong>Administra Usuarios:</strong> Añade, edita y elimina cuentas de usuarios según sea necesario.</li>
                    <li><strong>Gestiona Productos:</strong> Controla inventarios, categorías y proveedores desde un solo lugar.</li>
                    <li><strong>Genera Reportes:</strong> Utiliza herramientas de análisis para mejorar la gestión y rendimiento del inventario.</li>
                </ol>
                
                <h2 class="text-xl font-semibold text-custom-dark dark:text-custom-white mt-6">Recursos de Ayuda</h2>
                <ul class="list-disc list-inside text-custom-dark-gray dark:text-custom-gray mb-4">
                    <li><strong>Documentación:</strong> Consulta la documentación detallada para aprender sobre todas las funciones administrativas.</li>
                    <li><strong>Soporte Técnico:</strong> Contacta al equipo de soporte para asistencia técnica adicional.</li>
                </ul>

                <h2 class="text-xl font-semibold text-custom-dark dark:text-custom-white mt-6">Contacto</h2>
                <p class="text-custom-dark-gray dark:text-custom-gray mb-4">
                    ¿Necesitas ayuda o tienes alguna pregunta? Contáctanos a través de nuestro correo electrónico: soporte@gestorinventarios.com o llámanos al +123 456 7890.
                </p>

                <div class="mt-6">
                    <a href="#" class="bg-blue-500 text-white px-4 py-2 rounded shadow hover:bg-blue-700">
                        ¡Acceder al Panel de Administración!
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
