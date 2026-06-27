<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";

import {
  CloudRain,
  Thermometer,
  Wind,
  Droplets,
  Leaf,
  AlertTriangle,
  CalendarDays,
  Sprout,
  Tractor,
  BarChart3,
  MapPinned,
  Clock,
  ShieldAlert,
} from "lucide-vue-next";

const props = defineProps({
  weather: Object,

  forecast: Array,

  recommendedTime: String,
});

const getRiskColor = (level) => {
  switch (level) {
    case "PELIGROSO":
      return "bg-red-100 text-red-700";

    case "MODERADO":
      return "bg-yellow-100 text-yellow-700";

    default:
      return "bg-green-100 text-green-700";
  }
};

const getRiskBorder = (level) => {
  switch (level) {
    case "PELIGROSO":
      return "border-red-200";

    case "MODERADO":
      return "border-yellow-200";

    default:
      return "border-green-200";
  }
};
</script>

<template>
  <Head title="Dashboard Usuario" />

  <AuthenticatedLayout>
    <template #header>
      <div class="flex items-center justify-between">
        <div>
          <h2 class="text-3xl font-black text-green-900">Dashboard Agrícola</h2>

          <p class="text-gray-500 mt-1">
            Monitoreo climático inteligente para cultivo de banano
          </p>
        </div>

        <div
          class="hidden md:flex items-center gap-3 bg-green-100 text-green-800 px-5 py-3 rounded-2xl font-bold"
        >
          <CalendarDays class="w-5 h-5" />
          Hoy - 10:15 AM
        </div>
      </div>
    </template>

    <div class="py-8 bg-gradient-to-br from-green-50 via-white to-yellow-50 min-h-screen">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 space-y-6">
        <!-- HERO -->
        <div
          class="relative overflow-hidden rounded-[35px] bg-gradient-to-r from-green-700 via-green-800 to-green-900 p-10 text-white shadow-2xl"
        >
          <div class="absolute right-0 top-0 opacity-10">
            <CloudRain class="w-80 h-80" />
          </div>

          <div class="relative z-10">
            <div class="flex items-center gap-4 mb-5">
              <Leaf class="w-12 h-12 text-yellow-300" />

              <h1 class="text-5xl font-black">Predicción Climática Inteligente</h1>
            </div>

            <p class="text-xl text-green-100 max-w-3xl leading-relaxed">
              Consulta el estado climático de tus plantaciones y recibe recomendaciones
              automáticas para optimizar la producción de banano.
            </p>

            <div class="mt-8 flex flex-wrap gap-4">
              <button
                class="bg-white text-green-800 px-6 py-3 rounded-2xl font-black shadow-lg hover:scale-105 transition"
              >
                Ver Pronóstico
              </button>

              <button
                class="border border-white/30 hover:bg-white/10 px-6 py-3 rounded-2xl font-bold transition"
              >
                Mis Cultivos
              </button>
            </div>
          </div>
        </div>

        <!-- CLIMA -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
          <div
            class="bg-white rounded-3xl p-6 shadow-xl border border-orange-100 hover:-translate-y-1 transition"
          >
            <div class="flex items-center justify-between">
              <div>
                <p class="text-gray-500">Temperatura</p>

                <h2 class="text-4xl font-black mt-2 text-gray-900">
                  {{ weather?.temperature ?? "--" }}°C
                </h2>
              </div>

              <div class="bg-orange-100 p-4 rounded-2xl">
                <Thermometer class="w-10 h-10 text-orange-600" />
              </div>
            </div>
          </div>

          <div
            class="bg-white rounded-3xl p-6 shadow-xl border border-blue-100 hover:-translate-y-1 transition"
          >
            <div class="flex items-center justify-between">
              <div>
                <p class="text-gray-500">Humedad</p>

                <h2 class="text-4xl font-black mt-2 text-gray-900">
                  {{ weather?.humidity ?? "--" }}%
                </h2>
              </div>

              <div class="bg-blue-100 p-4 rounded-2xl">
                <Droplets class="w-10 h-10 text-blue-600" />
              </div>
            </div>
          </div>

          <div
            class="bg-white rounded-3xl p-6 shadow-xl border border-cyan-100 hover:-translate-y-1 transition"
          >
            <div class="flex items-center justify-between">
              <div>
                <p class="text-gray-500">Viento</p>

                <h2 class="text-4xl font-black mt-2 text-gray-900">
                  {{ weather?.wind ?? "--" }}km/h
                </h2>
              </div>

              <div class="bg-cyan-100 p-4 rounded-2xl">
                <Wind class="w-10 h-10 text-cyan-700" />
              </div>
            </div>
          </div>

          <div
            class="bg-white rounded-3xl p-6 shadow-xl border border-green-100 hover:-translate-y-1 transition"
          >
            <div class="flex items-center justify-between">
              <div>
                <p class="text-gray-500">Estado de lluvia</p>

                <h2 class="text-4xl font-black mt-2 text-gray-900">
                  {{ weather?.rain_status ?? "SIN DATOS" }}%
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
          <!-- PREDICCION -->
          <div class="xl:col-span-2 bg-white rounded-3xl p-6 shadow-xl">
            <div class="flex items-center gap-3 mb-6">
              <BarChart3 class="w-8 h-8 text-green-700" />

              <h2 class="text-2xl font-black text-gray-800">Pronóstico Semanal</h2>
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
                      <span
                        class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm font-bold"
                      >
                        {{ item.estado }}
                      </span>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

          <!-- RECOMENDACIONES -->
          <div class="space-y-6">
            <div
              class="bg-gradient-to-br from-green-700 to-green-900 rounded-3xl p-6 text-white shadow-2xl"
            >
              <div class="flex items-center gap-3 mb-5">
                <Sprout class="w-8 h-8" />

                <h2 class="text-2xl font-black">Estado del Cultivo</h2>
              </div>

              <div>
                <p class="text-green-100 text-sm">Estado actual</p>

                <h3 class="text-3xl font-black mt-2">
                  {{ weather?.crop_status }}
                </h3>
              </div>

              <div class="mt-6">
                <p class="text-green-100 text-sm">Recomendación IA</p>

                <p class="mt-2 text-lg leading-relaxed">
                  {{ weather?.recommendation }}
                </p>
              </div>
            </div>

            <div class="bg-white rounded-3xl p-6 shadow-xl">
              <div class="flex items-center gap-3 mb-6">
                <AlertTriangle class="w-8 h-8 text-yellow-600" />

                <h2 class="text-2xl font-black text-gray-800">Recomendaciones</h2>
              </div>

              <div class="space-y-4">
                <div
                  v-for="(item, index) in recomendaciones"
                  :key="index"
                  class="bg-yellow-50 border border-yellow-100 rounded-2xl p-4"
                >
                  <p class="font-semibold text-gray-700">
                    {{ item }}
                  </p>
                </div>
              </div>

              <p class="text-gray-500">Horario recomendado</p>

              <h2 class="text-3xl font-black text-green-700">
                {{ recommendedTime }}
              </h2>

              <div class="mt-6 border-t pt-5">
                <p class="text-gray-500">Ciudad consultada</p>

                <div class="flex items-center gap-2 mt-2">
                  <MapPinned class="w-5 h-5 text-green-700" />

                  <span class="font-bold">
                    {{ weather?.city }}
                  </span>

                  <div class="mt-5">
                    <p class="text-gray-500">Nivel de fumigación</p>

                    <span
                      class="inline-flex mt-2 px-4 py-2 rounded-full font-bold"
                      :class="getRiskColor(weather?.level)"
                    >
                      {{ weather?.level }}
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- CULTIVOS -->
        <div class="bg-white rounded-3xl p-6 shadow-xl">
          <div class="flex items-center gap-3 mb-6">
            <Tractor class="w-8 h-8 text-green-700" />

            <h2 class="text-2xl font-black text-gray-800">Mis Plantaciones</h2>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div
              v-for="(cultivo, index) in cultivos"
              :key="index"
              class="border border-green-100 rounded-3xl p-6 bg-green-50"
            >
              <div class="flex items-center justify-between mb-4">
                <div>
                  <h3 class="text-xl font-black text-green-900">
                    {{ cultivo.nombre }}
                  </h3>

                  <p class="text-gray-600 mt-1">
                    {{ cultivo.estado }}
                  </p>
                </div>

                <Leaf class="w-10 h-10 text-green-700" />
              </div>

              <div>
                <div class="flex justify-between mb-2">
                  <span class="text-sm font-semibold text-gray-600">
                    Salud del cultivo
                  </span>

                  <span class="text-sm font-black text-green-700">
                    {{ cultivo.progreso }}
                  </span>
                </div>

                <div class="w-full bg-green-100 rounded-full h-3">
                  <div
                    class="bg-green-700 h-3 rounded-full"
                    :style="{ width: cultivo.progreso }"
                  ></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
