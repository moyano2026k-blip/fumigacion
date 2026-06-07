<script setup>
import { Head, Link } from "@inertiajs/vue3";

import {
  CloudRain,
  Thermometer,
  Droplets,
  Wind,
  Leaf,
  ShieldCheck,
  BarChart3,
  Sun,
  Activity,
  MapPinned,
} from "lucide-vue-next";

defineProps({
  canLogin: Boolean,
  canRegister: Boolean,
  clima: Object,
});
</script>

<template>
  <Head title="AgroClimate" />

  <div class="min-h-screen bg-gradient-to-br from-green-100 via-white to-cyan-100">
    <!-- NAVBAR -->
    <header
      class="sticky top-0 z-50 backdrop-blur-lg bg-white/70 border-b border-white/30"
    >
      <div class="max-w-7xl mx-auto px-6 py-5 flex items-center justify-between">
        <!-- LOGO -->
        <div class="flex items-center gap-4">
          <div
            class="bg-gradient-to-r from-green-700 to-cyan-700 p-4 rounded-3xl shadow-xl"
          >
            <Leaf class="w-8 h-8 text-white" />
          </div>

          <div>
            <h1 class="text-3xl font-black text-green-900">AgroClimate</h1>

            <p class="text-gray-500">Sistema Inteligente Climático</p>
          </div>
        </div>

        <!-- BUTTONS -->
        <div class="flex items-center gap-4">
          <Link
            v-if="canLogin"
            href="/login"
            class="bg-white border border-green-200 text-green-700 px-6 py-3 rounded-2xl font-black hover:bg-green-50 transition"
          >
            Iniciar Sesión
          </Link>

          <Link
            v-if="canRegister"
            href="/register"
            class="bg-gradient-to-r from-green-700 to-cyan-700 text-white px-6 py-3 rounded-2xl font-black shadow-lg hover:scale-105 transition"
          >
            Registrarse
          </Link>
        </div>
      </div>
    </header>

    <!-- HERO -->
    <section class="max-w-7xl mx-auto px-6 py-20">
      <div class="grid grid-cols-1 xl:grid-cols-2 gap-12 items-center">
        <!-- LEFT -->
        <div>
          <div
            class="inline-flex items-center gap-3 bg-green-100 text-green-700 px-5 py-3 rounded-full font-bold mb-8"
          >
            <ShieldCheck class="w-5 h-5" />

            Monitoreo Climático Inteligente
          </div>

          <h1 class="text-6xl xl:text-7xl font-black text-gray-900 leading-tight">
            Agricultura Inteligente para el Ecuador
          </h1>

          <p class="mt-8 text-2xl text-gray-600 leading-relaxed">
            Plataforma avanzada de monitoreo climático agrícola con análisis en tiempo
            real, recomendaciones y supervisión ambiental.
          </p>

          <div class="flex flex-wrap gap-5 mt-10">
            <Link
              href="/login"
              class="bg-gradient-to-r from-green-700 to-cyan-700 text-white px-8 py-5 rounded-3xl font-black text-lg shadow-2xl hover:scale-105 transition"
            >
              Ingresar al Sistema
            </Link>

            <Link
              href="/register"
              class="bg-white border border-gray-200 px-8 py-5 rounded-3xl font-black text-lg hover:bg-gray-50 transition"
            >
              Crear Cuenta
            </Link>
          </div>
        </div>

        <!-- RIGHT -->
        <div class="bg-white rounded-[40px] shadow-2xl overflow-hidden">
          <!-- HEADER -->
          <div class="bg-gradient-to-r from-green-700 to-cyan-700 p-8 text-white">
            <div class="flex items-center gap-4">
              <CloudRain class="w-12 h-12" />

              <div>
                <h2 class="text-4xl font-black">Clima Ecuador</h2>

                <p class="text-green-100 mt-2">Monitoreo climático nacional</p>
              </div>
            </div>
          </div>

          <!-- BODY -->
          <div class="p-10">
            <!-- CITY -->
            <div class="bg-gradient-to-r from-green-50 to-cyan-50 rounded-3xl p-8 mb-8">
              <div class="flex items-center gap-4">
                <div class="bg-green-100 p-5 rounded-3xl">
                  <MapPinned class="w-10 h-10 text-green-700" />
                </div>

                <div>
                  <p class="text-gray-500">Ciudad monitoreada</p>

                  <h2 class="text-5xl font-black text-green-700 mt-2">
                    {{ clima?.ciudad }}
                  </h2>
                </div>
              </div>
            </div>

            <!-- STATS -->
            <div class="grid grid-cols-2 gap-5">
              <!-- TEMP -->
              <div class="bg-orange-50 p-6 rounded-3xl">
                <Thermometer class="w-10 h-10 text-orange-600 mb-4" />

                <p class="text-gray-500">Temperatura</p>

                <h3 class="text-4xl font-black text-orange-600 mt-2">
                  {{ clima?.temperatura }}°C
                </h3>
              </div>

              <!-- HUMEDAD -->
              <div class="bg-blue-50 p-6 rounded-3xl">
                <Droplets class="w-10 h-10 text-blue-700 mb-4" />

                <p class="text-gray-500">Humedad</p>

                <h3 class="text-4xl font-black text-blue-700 mt-2">
                  {{ clima?.humedad }}%
                </h3>
              </div>

              <!-- VIENTO -->
              <div class="bg-cyan-50 p-6 rounded-3xl">
                <Wind class="w-10 h-10 text-cyan-700 mb-4" />

                <p class="text-gray-500">Viento</p>

                <h3 class="text-4xl font-black text-cyan-700 mt-2">
                  {{ clima?.viento }}
                </h3>
              </div>

              <!-- LLUVIA -->
              <div class="bg-green-50 p-6 rounded-3xl">
                <CloudRain class="w-10 h-10 text-green-700 mb-4" />

                <p class="text-gray-500">Lluvia</p>

                <h3 class="text-4xl font-black text-green-700 mt-2">
                  {{ clima?.lluvia }}%
                </h3>
              </div>
            </div>

            <!-- STATUS -->
            <div
              class="bg-gradient-to-r from-green-700 to-cyan-700 rounded-3xl p-8 mt-8 text-white"
            >
              <div class="flex items-center gap-4">
                <Activity class="w-10 h-10" />

                <div>
                  <p class="text-green-100">Estado Agrícola</p>

                  <h3 class="text-3xl font-black mt-2">
                    {{ clima?.estado }}
                  </h3>
                </div>
              </div>

              <p class="mt-5 text-lg">
                {{ clima?.recomendacion }}
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- FEATURES -->
    <section class="max-w-7xl mx-auto px-6 pb-20">
      <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
        <!-- FEATURE -->
        <div class="bg-white p-8 rounded-3xl shadow-xl">
          <CloudRain class="w-14 h-14 text-cyan-700 mb-6" />

          <h3 class="text-3xl font-black text-gray-800">Clima en Tiempo Real</h3>

          <p class="text-gray-500 mt-4">
            Monitoreo climático actualizado automáticamente.
          </p>
        </div>

        <!-- FEATURE -->
        <div class="bg-white p-8 rounded-3xl shadow-xl">
          <Leaf class="w-14 h-14 text-green-700 mb-6" />

          <h3 class="text-3xl font-black text-gray-800">Agricultura Inteligente</h3>

          <p class="text-gray-500 mt-4">
            Recomendaciones agrícolas basadas en variables ambientales.
          </p>
        </div>

        <!-- FEATURE -->
        <div class="bg-white p-8 rounded-3xl shadow-xl">
          <BarChart3 class="w-14 h-14 text-purple-700 mb-6" />

          <h3 class="text-3xl font-black text-gray-800">Reportes Climáticos</h3>

          <p class="text-gray-500 mt-4">
            Estadísticas y monitoreo histórico del sistema.
          </p>
        </div>

        <!-- FEATURE -->
        <div class="bg-white p-8 rounded-3xl shadow-xl">
          <Sun class="w-14 h-14 text-yellow-500 mb-6" />

          <h3 class="text-3xl font-black text-gray-800">Predicción Ambiental</h3>

          <p class="text-gray-500 mt-4">Supervisión preventiva de riesgos climáticos.</p>
        </div>
      </div>
    </section>
  </div>
</template>
