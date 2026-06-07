<script setup>
import DashboardLayout from "@/Layouts/DashboardLayout.vue";

import {
  BarChart3,
  AlertTriangle,
  MapPinned,
  Activity,
  Thermometer,
  Droplets,
  Wind,
  Leaf,
} from "lucide-vue-next";

defineProps({
  histories: Array,
  totalQueries: Number,
  alerts: Number,
  cities: Number,
});
</script>

<template>
  <DashboardLayout title="Reportes Técnicos">
    <!-- HERO -->
    <div
      class="bg-gradient-to-r from-purple-700 via-blue-700 to-cyan-700 rounded-[35px] p-10 text-white shadow-2xl mb-10"
    >
      <h2 class="text-5xl font-black">Reportes Climáticos Técnicos</h2>

      <p class="mt-5 text-purple-100 text-xl">
        Estadísticas agrícolas y monitoreo climático en tiempo real.
      </p>
    </div>

    <!-- STATS -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-10">
      <!-- CONSULTAS -->
      <div class="bg-white p-7 rounded-3xl shadow-xl">
        <Activity class="w-12 h-12 text-cyan-700 mb-5" />

        <h2 class="text-5xl font-black text-gray-800">
          {{ totalQueries }}
        </h2>

        <p class="text-gray-500 mt-2">Consultas Climáticas</p>
      </div>

      <!-- ALERTAS -->
      <div class="bg-white p-7 rounded-3xl shadow-xl">
        <AlertTriangle class="w-12 h-12 text-red-600 mb-5" />

        <h2 class="text-5xl font-black text-gray-800">
          {{ alerts }}
        </h2>

        <p class="text-gray-500 mt-2">Alertas Detectadas</p>
      </div>

      <!-- CIUDADES -->
      <div class="bg-white p-7 rounded-3xl shadow-xl">
        <MapPinned class="w-12 h-12 text-green-700 mb-5" />

        <h2 class="text-5xl font-black text-gray-800">
          {{ cities }}
        </h2>

        <p class="text-gray-500 mt-2">Ciudades Monitoreadas</p>
      </div>

      <!-- CULTIVOS -->
      <div class="bg-white p-7 rounded-3xl shadow-xl">
        <Leaf class="w-12 h-12 text-emerald-700 mb-5" />

        <h2 class="text-3xl font-black text-emerald-700">ACTIVO</h2>

        <p class="text-gray-500 mt-2">Monitoreo Agrícola</p>
      </div>
    </div>

    <!-- LAST ANALYSIS -->
    <div class="bg-white rounded-[35px] shadow-2xl overflow-hidden mb-10">
      <!-- HEADER -->
      <div class="bg-gradient-to-r from-cyan-700 to-blue-700 p-8 text-white">
        <div class="flex items-center gap-5">
          <BarChart3 class="w-12 h-12" />

          <div>
            <h2 class="text-4xl font-black">Últimos Monitoreos</h2>

            <p class="text-cyan-100 mt-2">Consultas climáticas recientes del sistema.</p>
          </div>
        </div>
      </div>

      <!-- TABLE -->
      <div class="overflow-x-auto">
        <table class="w-full">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-6 py-5 text-left">Ciudad</th>

              <th class="px-6 py-5 text-left">Temperatura</th>

              <th class="px-6 py-5 text-left">Humedad</th>

              <th class="px-6 py-5 text-left">Viento</th>

              <th class="px-6 py-5 text-left">Cultivo</th>

              <th class="px-6 py-5 text-left">Recomendación</th>
            </tr>
          </thead>

          <tbody>
            <tr
              v-for="history in histories"
              :key="history.id"
              class="border-b hover:bg-cyan-50"
            >
              <!-- CITY -->
              <td class="px-6 py-5">
                <div class="flex items-center gap-3">
                  <MapPinned class="w-5 h-5 text-green-700" />

                  <span class="font-bold">
                    {{ history.city }}
                  </span>
                </div>
              </td>

              <!-- TEMP -->
              <td class="px-6 py-5">
                <div class="flex items-center gap-3">
                  <Thermometer class="w-5 h-5 text-orange-600" />

                  <span> {{ history.temperature }}°C </span>
                </div>
              </td>

              <!-- HUMEDAD -->
              <td class="px-6 py-5">
                <div class="flex items-center gap-3">
                  <Droplets class="w-5 h-5 text-blue-700" />

                  <span> {{ history.humidity }}% </span>
                </div>
              </td>

              <!-- VIENTO -->
              <td class="px-6 py-5">
                <div class="flex items-center gap-3">
                  <Wind class="w-5 h-5 text-cyan-700" />

                  <span>
                    {{ history.wind }}
                  </span>
                </div>
              </td>

              <!-- CULTIVO -->
              <td class="px-6 py-5">
                <span
                  class="bg-green-100 text-green-700 px-4 py-2 rounded-full font-bold"
                >
                  {{ history.crop_status }}
                </span>
              </td>

              <!-- RECOMENDACION -->
              <td class="px-6 py-5">
                <span class="bg-blue-100 text-blue-700 px-4 py-2 rounded-full font-bold">
                  {{ history.recommendation }}
                </span>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- ALERTS -->
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
      <!-- ALERT -->
      <div class="bg-white rounded-[35px] shadow-2xl p-8">
        <div class="flex items-center gap-4 mb-6">
          <AlertTriangle class="w-10 h-10 text-red-600" />

          <h2 class="text-3xl font-black text-gray-800">Alertas Climáticas</h2>
        </div>

        <div class="space-y-5">
          <div class="bg-red-50 border border-red-100 rounded-3xl p-6">
            <h3 class="text-2xl font-black text-red-700">Riesgo climático detectado</h3>

            <p class="text-gray-600 mt-2">
              Algunas consultas presentan condiciones no recomendables para fumigación.
            </p>
          </div>

          <div class="bg-yellow-50 border border-yellow-100 rounded-3xl p-6">
            <h3 class="text-2xl font-black text-yellow-700">Monitoreo activo</h3>

            <p class="text-gray-600 mt-2">
              El sistema continúa supervisando variables climáticas.
            </p>
          </div>
        </div>
      </div>

      <!-- SYSTEM -->
      <div class="bg-white rounded-[35px] shadow-2xl p-8">
        <div class="flex items-center gap-4 mb-6">
          <Leaf class="w-10 h-10 text-green-700" />

          <h2 class="text-3xl font-black text-gray-800">Estado Agrícola</h2>
        </div>

        <div class="space-y-5">
          <div class="bg-green-50 border border-green-100 rounded-3xl p-6">
            <h3 class="text-2xl font-black text-green-700">Sistema operativo</h3>

            <p class="text-gray-600 mt-2">
              Monitoreo agrícola funcionando correctamente.
            </p>
          </div>

          <div class="bg-cyan-50 border border-cyan-100 rounded-3xl p-6">
            <h3 class="text-2xl font-black text-cyan-700">Variables actualizadas</h3>

            <p class="text-gray-600 mt-2">
              Temperatura, humedad y viento actualizados automáticamente.
            </p>
          </div>
        </div>
      </div>
    </div>
  </DashboardLayout>
</template>
