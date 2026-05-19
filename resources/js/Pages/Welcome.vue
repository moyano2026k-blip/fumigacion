<script setup>
import { Head, Link } from '@inertiajs/vue3'
import {
    CloudRain,
    Thermometer,
    Wind,
    Droplets,
    Leaf,
    AlertTriangle,
    Sun,
    CalendarDays,
    BarChart3
} from 'lucide-vue-next'

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
})

const clima = {
    temperatura: 28,
    humedad: 82,
    viento: 12,
    lluvia: 78,
    estado: 'Condiciones Favorables',
    recomendacion:
        'Buen clima para fertilización y control preventivo del cultivo.'
}

const predicciones = [
    {
        dia: 'Lunes',
        temp: '27°C',
        lluvia: '80%',
        estado: 'Lluvioso'
    },
    {
        dia: 'Martes',
        temp: '29°C',
        lluvia: '40%',
        estado: 'Nublado'
    },
    {
        dia: 'Miércoles',
        temp: '31°C',
        lluvia: '20%',
        estado: 'Soleado'
    },
    {
        dia: 'Jueves',
        temp: '26°C',
        lluvia: '90%',
        estado: 'Tormenta'
    }
]
</script>

<template>
    <Head title="Predicción Climática Banano" />

    <div class="min-h-screen bg-gradient-to-br from-green-100 via-white to-yellow-100">

        <!-- NAVBAR -->
        <header class="border-b border-white/40 backdrop-blur-lg bg-white/60 sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

                <div class="flex items-center gap-4">
                    <div class="bg-green-700 text-white p-3 rounded-2xl shadow-lg">
                        <Leaf class="w-7 h-7" />
                    </div>

                    <div>
                        <h1 class="text-2xl font-black text-green-900">
                            AgroClimate
                        </h1>

                        <p class="text-sm text-gray-600">
                            Predicción para el cultivo de Banano
                        </p>
                    </div>
                </div>

                <nav v-if="canLogin" class="flex items-center gap-3">
                    <Link
                        v-if="$page.props.auth.user"
                        :href="route('dashboard')"
                        class="bg-green-700 hover:bg-green-800 transition text-white px-5 py-2 rounded-xl font-bold"
                    >
                        Dashboard
                    </Link>

                    <template v-else>
                        <Link
                            :href="route('login')"
                            class="bg-white border border-green-200 hover:bg-green-50 transition px-5 py-2 rounded-xl font-semibold"
                        >
                            Iniciar Sesión
                        </Link>

                        <Link
                            v-if="canRegister"
                            :href="route('register')"
                            class="bg-green-700 hover:bg-green-800 transition text-white px-5 py-2 rounded-xl font-bold"
                        >
                            Registrarse
                        </Link>
                    </template>
                </nav>

            </div>
        </header>

        <!-- CONTENIDO -->
        <div class="max-w-7xl mx-auto p-6 space-y-6">

            <!-- HERO -->
            <div class="relative overflow-hidden rounded-[35px] bg-gradient-to-r from-green-700 via-green-800 to-green-900 p-10 text-white shadow-2xl">

                <div class="absolute right-0 top-0 opacity-10">
                    <CloudRain class="w-72 h-72" />
                </div>

                <div class="relative z-10">
                    <div class="flex items-center gap-3 mb-4">
                        <Sun class="w-10 h-10 text-yellow-300" />

                        <h2 class="text-5xl font-black">
                            Monitoreo Climático
                        </h2>
                    </div>

                    <p class="text-xl text-green-100 max-w-3xl leading-relaxed">
                        Plataforma avanzada de predicción meteorológica para optimizar
                        el cultivo de banano mediante la api y el análisis climático.
                    </p>

                    <div class="mt-8 flex gap-4">
                        <button class="bg-white text-green-800 px-6 py-3 rounded-2xl font-black shadow-lg hover:scale-105 transition">
                            Ver Predicciones
                        </button>
                    </div>
                </div>
            </div>

            <!-- CARDS -->
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

                <div class="bg-white rounded-3xl p-6 shadow-xl border border-orange-100 hover:-translate-y-1 transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm">
                                Temperatura
                            </p>

                            <h2 class="text-4xl font-black mt-2 text-gray-900">
                                {{ clima.temperatura }}°C
                            </h2>
                        </div>

                        <div class="bg-orange-100 p-4 rounded-2xl">
                            <Thermometer class="w-10 h-10 text-orange-600" />
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-3xl p-6 shadow-xl border border-blue-100 hover:-translate-y-1 transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm">
                                Humedad
                            </p>

                            <h2 class="text-4xl font-black mt-2 text-gray-900">
                                {{ clima.humedad }}%
                            </h2>
                        </div>

                        <div class="bg-blue-100 p-4 rounded-2xl">
                            <Droplets class="w-10 h-10 text-blue-600" />
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-3xl p-6 shadow-xl border border-cyan-100 hover:-translate-y-1 transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm">
                                Viento
                            </p>

                            <h2 class="text-4xl font-black mt-2 text-gray-900">
                                {{ clima.viento }} km/h
                            </h2>
                        </div>

                        <div class="bg-cyan-100 p-4 rounded-2xl">
                            <Wind class="w-10 h-10 text-cyan-700" />
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-3xl p-6 shadow-xl border border-green-100 hover:-translate-y-1 transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm">
                                Lluvia
                            </p>

                            <h2 class="text-4xl font-black mt-2 text-gray-900">
                                {{ clima.lluvia }}%
                            </h2>
                        </div>

                        <div class="bg-green-100 p-4 rounded-2xl">
                            <CloudRain class="w-10 h-10 text-green-700" />
                        </div>
                    </div>
                </div>

            </div>

            <!-- GRID -->
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

                <!-- TABLA -->
                <div class="xl:col-span-2 bg-white rounded-3xl p-6 shadow-xl">

                    <div class="flex items-center gap-3 mb-6">
                        <BarChart3 class="w-8 h-8 text-green-700" />

                        <h2 class="text-2xl font-black text-gray-800">
                            Predicción Semanal
                        </h2>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full">

                            <thead>
                                <tr class="border-b">
                                    <th class="text-left py-4 text-gray-500">Día</th>
                                    <th class="text-left py-4 text-gray-500">Temperatura</th>
                                    <th class="text-left py-4 text-gray-500">Lluvia</th>
                                    <th class="text-left py-4 text-gray-500">Estado</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr
                                    v-for="item in predicciones"
                                    :key="item.dia"
                                    class="border-b hover:bg-green-50 transition"
                                >
                                    <td class="py-5 font-bold text-gray-800">
                                        {{ item.dia }}
                                    </td>

                                    <td class="py-5 text-gray-700">
                                        {{ item.temp }}
                                    </td>

                                    <td class="py-5 text-gray-700">
                                        {{ item.lluvia }}
                                    </td>

                                    <td class="py-5">
                                        <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm font-bold">
                                            {{ item.estado }}
                                        </span>
                                    </td>
                                </tr>
                            </tbody>

                        </table>
                    </div>
                </div>

                <!-- ALERTAS -->
                <div class="space-y-6">

                    <div class="bg-gradient-to-br from-green-700 to-green-900 rounded-3xl p-6 text-white shadow-2xl">

                        <div class="flex items-center gap-3 mb-5">
                            <Leaf class="w-8 h-8" />

                            <h2 class="text-2xl font-black">
                                Estado del Cultivo
                            </h2>
                        </div>

                        <div>
                            <p class="text-green-100 text-sm">
                                Estado Actual
                            </p>

                            <h3 class="text-3xl font-black mt-2">
                                {{ clima.estado }}
                            </h3>
                        </div>

                        <div class="mt-6">
                            <p class="text-green-100 text-sm">
                                Recomendación
                            </p>

                            <p class="mt-2 text-lg leading-relaxed">
                                {{ clima.recomendacion }}
                            </p>
                        </div>

                    </div>

                    <div class="bg-white rounded-3xl p-6 shadow-xl">

                        <div class="flex items-center gap-3 mb-5">
                            <AlertTriangle class="w-8 h-8 text-red-600" />

                            <h2 class="text-2xl font-black text-gray-800">
                                Alertas
                            </h2>
                        </div>

                        <div class="space-y-4">

                            <div class="bg-red-50 border border-red-100 rounded-2xl p-4">
                                <p class="font-semibold text-gray-700">
                                    Alta humedad detectada en zona norte del cultivo.
                                </p>
                            </div>

                            <div class="bg-yellow-50 border border-yellow-100 rounded-2xl p-4">
                                <p class="font-semibold text-gray-700">
                                    Posible aparición de hongos por lluvias intensas.
                                </p>
                            </div>

                            <div class="bg-blue-50 border border-blue-100 rounded-2xl p-4">
                                <p class="font-semibold text-gray-700">
                                    Recomendado revisar drenajes y fertilización.
                                </p>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
</template>