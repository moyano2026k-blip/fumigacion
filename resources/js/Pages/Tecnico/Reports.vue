<script setup>
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import { computed } from "vue";

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

const props = defineProps({
  histories: Array,
  totalQueries: Number,
  alerts: Number,
  cities: Number,
});

const criticalAlerts = computed(() => {
  return props.histories.filter((item) => {
    return item.level === "PELIGROSO" || item.level === "MODERADO";
  });
});

const riskLevel = computed(() => {
  if (criticalAlerts.value.length > 10) return "ALTO";
  if (criticalAlerts.value.length > 3) return "MEDIO";
  return "BAJO";
});

const agriculturalStatus = computed(() => {
  if (criticalAlerts.value.length > 10) {
    return {
      title: "Estado Crítico",
      color: "red",
      message: "Las condiciones climáticas pueden afectar seriamente los cultivos.",
    };
  }

  if (criticalAlerts.value.length > 3) {
    return {
      title: "Monitoreo Preventivo",
      color: "yellow",
      message: "Se recomienda supervisar las condiciones agrícolas.",
    };
  }

  return {
    title: "Condiciones Favorables",
    color: "green",
    message: "Los cultivos presentan condiciones adecuadas para su desarrollo.",
  };
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
          {{ criticalAlerts.length }}
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
      <!-- ALERTAS DINAMICAS -->
      <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
        <!-- ALERTAS -->
        <div class="bg-white rounded-[35px] shadow-2xl p-8">
          <div class="flex items-center justify-between mb-8">
            <div class="flex items-center gap-4">
              <AlertTriangle class="w-10 h-10 text-red-600" />

              <h2 class="text-3xl font-black text-gray-800">Centro de Alertas</h2>
            </div>

            <!-- <span
              class="px-5 py-2 rounded-full text-white font-bold"
              :class="
                riskLevel === 'ALTO'
                  ? 'bg-red-600'
                  : riskLevel === 'MEDIO'
                  ? 'bg-yellow-500'
                  : 'bg-green-600'
              "
            >
              Riesgo {{ riskLevel }}
            </span> -->
          </div>

          <div class="space-y-4">
            <div
              v-if="criticalAlerts.length === 0"
              class="bg-green-50 border border-green-200 rounded-3xl p-6"
            >
              <h3 class="text-xl font-black text-green-700">✅ Sin alertas críticas</h3>

              <p class="mt-2 text-gray-600">
                Todas las ciudades presentan condiciones favorables.
              </p>
            </div>

            <div
              v-for="alert in criticalAlerts.slice(0, 5)"
              :key="alert.id"
              class="bg-red-50 border border-red-200 rounded-3xl p-6 hover:scale-105 transition"
            >
              <h3 class="text-xl font-black text-red-700">
                {{ alert.city }}
              </h3>

              <div class="mt-3 grid grid-cols-3 gap-3 text-sm">
                <div>🌡️ {{ alert.temperature }}°C</div>

                <div>💧 {{ alert.humidity }}%</div>

                <div>🌬️ {{ alert.wind }}</div>
              </div>

              <p class="mt-3 text-gray-700 font-medium">
                {{ alert.recommendation }}
              </p>
            </div>
          </div>
        </div>

        <!-- RESUMEN TECNICO -->
        <div class="bg-white rounded-[35px] shadow-2xl p-8">
          <div class="flex items-center gap-4 mb-8">
            <BarChart3 class="w-10 h-10 text-purple-700" />

            <h2 class="text-3xl font-black text-gray-800">Resumen Técnico</h2>
          </div>

          <div class="space-y-5">
            <div class="bg-blue-50 border border-blue-200 rounded-3xl p-6">
              <h3 class="text-xl font-black text-blue-700">Consultas Procesadas</h3>

              <p class="text-4xl font-black mt-3">
                {{ totalQueries }}
              </p>
            </div>

            <div class="bg-red-50 border border-red-200 rounded-3xl p-6">
              <h3 class="text-xl font-black text-red-700">Alertas Detectadas</h3>

              <p class="text-4xl font-black mt-3">
                {{ criticalAlerts.length }}
              </p>
            </div>

            <div class="bg-green-50 border border-green-200 rounded-3xl p-6">
              <h3 class="text-xl font-black text-green-700">Ciudades Monitoreadas</h3>

              <p class="text-4xl font-black mt-3">
                {{ cities }}
              </p>
            </div>
          </div>
        </div>
      </div>

      <!-- SYSTEM -->

      <!-- ESTADO AGRICOLA DINAMICO -->
      <div class="bg-white rounded-[35px] shadow-2xl p-8">
        <div class="flex items-center justify-between mb-6">
          <div class="flex items-center gap-4">
            <Leaf class="w-10 h-10 text-green-700" />

            <h2 class="text-3xl font-black text-gray-800">Estado Agrícola</h2>
          </div>

          <span
            class="px-4 py-2 rounded-full text-white font-bold"
            :class="
              agriculturalStatus.color === 'red'
                ? 'bg-red-600'
                : agriculturalStatus.color === 'yellow'
                ? 'bg-yellow-500'
                : 'bg-green-600'
            "
          >
            {{ agriculturalStatus.title }}
          </span>
        </div>

        <div class="space-y-5">
          <div
            class="rounded-3xl p-6 border"
            :class="
              agriculturalStatus.color === 'red'
                ? 'bg-red-50 border-red-200'
                : agriculturalStatus.color === 'yellow'
                ? 'bg-yellow-50 border-yellow-200'
                : 'bg-green-50 border-green-200'
            "
          >
            <h3
              class="text-2xl font-black"
              :class="
                agriculturalStatus.color === 'red'
                  ? 'text-red-700'
                  : agriculturalStatus.color === 'yellow'
                  ? 'text-yellow-700'
                  : 'text-green-700'
              "
            >
              {{ agriculturalStatus.title }}
            </h3>

            <p class="text-gray-600 mt-2">
              {{ agriculturalStatus.message }}
            </p>
          </div>

          <div class="bg-cyan-50 border border-cyan-200 rounded-3xl p-6">
            <h3 class="text-2xl font-black text-cyan-700">Indicadores Analizados</h3>

            <div class="mt-4 space-y-2">
              <div>🌡️ Temperatura</div>
              <div>💧 Humedad</div>
              <div>🌬️ Velocidad del viento</div>
              <div>🌱 Estado del cultivo</div>
            </div>
          </div>

          <div class="bg-purple-50 border border-purple-200 rounded-3xl p-6">
            <h3 class="text-2xl font-black text-purple-700">Riesgos Detectados</h3>

            <p class="text-4xl font-black mt-3">
              {{ criticalAlerts.length }}
            </p>
          </div>
        </div>
      </div>
    </div>
  </DashboardLayout>
</template>
