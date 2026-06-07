<script setup>
import DashboardLayout from "@/Layouts/DashboardLayout.vue";

import {
  FileSpreadsheet,
  FileText,
  CloudRain,
  Thermometer,
  Droplets,
  Wind,
  Activity,
  AlertTriangle,
  MapPinned,
} from "lucide-vue-next";

import { Bar, Doughnut, Line } from "vue-chartjs";

import {
  Chart as ChartJS,
  Title,
  Tooltip,
  Legend,
  BarElement,
  ArcElement,
  CategoryScale,
  LinearScale,
  PointElement,
  LineElement,
} from "chart.js";

ChartJS.register(
  Title,
  Tooltip,
  Legend,
  BarElement,
  ArcElement,
  CategoryScale,
  LinearScale,
  PointElement,
  LineElement
);

const props = defineProps({
  histories: Array,
  avgTemperature: Number,
  avgHumidity: Number,
  avgWind: Number,
  status: String,
});

/*
|--------------------------------------------------------------------------
| CHART DATA
|--------------------------------------------------------------------------
*/

const temperatureData = {
  labels: props.histories.map((h) => h.city),

  datasets: [
    {
      label: "Temperatura",
      data: props.histories.map((h) => h.temperature),
      backgroundColor: "#16a34a",
    },
  ],
};

const humidityData = {
  labels: props.histories.map((h) => h.city),

  datasets: [
    {
      label: "Humedad",
      data: props.histories.map((h) => h.humidity),
      backgroundColor: [
        "#2563eb",
        "#0891b2",
        "#16a34a",
        "#f59e0b",
        "#dc2626",
        "#7c3aed",
        "#0f766e",
        "#1d4ed8",
        "#15803d",
        "#9333ea",
      ],
    },
  ],
};

const windData = {
  labels: props.histories.map((h) => h.city),

  datasets: [
    {
      label: "Viento",
      data: props.histories.map((h) => h.wind),
      borderColor: "#0891b2",
      backgroundColor: "#0891b2",
    },
  ],
};
</script>

<template>
  <DashboardLayout title="Reportes Climáticos">
    <!-- HERO -->
    <div
      class="bg-gradient-to-r from-green-700 via-cyan-700 to-blue-700 rounded-[35px] p-10 text-white shadow-2xl mb-10"
    >
      <h2 class="text-5xl font-black">Panel de Reportes Climáticos</h2>

      <p class="mt-5 text-green-100 text-xl">
        Estadísticas generales y monitoreo climático del sistema.
      </p>
    </div>

    <!-- EXPORT -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
      <!-- EXCEL -->
      <a
        href="/reportes/usuarios/excel"
        class="bg-white p-8 rounded-3xl shadow-xl hover:-translate-y-1 transition block"
      >
        <FileSpreadsheet class="w-14 h-14 text-green-700 mb-6" />

        <h2 class="text-3xl font-black text-gray-800">Exportar Excel</h2>

        <p class="text-gray-500 mt-3">
          Descargar reporte completo de usuarios y consultas.
        </p>
      </a>

      <!-- PDF -->
      <a
        href="/reportes/usuarios/pdf"
        class="bg-white p-8 rounded-3xl shadow-xl hover:-translate-y-1 transition block"
      >
        <FileText class="w-14 h-14 text-red-700 mb-6" />

        <h2 class="text-3xl font-black text-gray-800">Exportar PDF</h2>

        <p class="text-gray-500 mt-3">Descargar reporte PDF del sistema climático.</p>
      </a>
    </div>

    <!-- STATS -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-10">
      <!-- TEMP -->
      <div class="bg-white p-6 rounded-3xl shadow-xl">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-gray-500 font-semibold">Temperatura Promedio</p>

            <h2 class="text-4xl font-black text-orange-600 mt-2">
              {{ avgTemperature }}°C
            </h2>
          </div>

          <div class="bg-orange-100 p-4 rounded-2xl">
            <Thermometer class="w-8 h-8 text-orange-600" />
          </div>
        </div>
      </div>

      <!-- HUMEDAD -->
      <div class="bg-white p-6 rounded-3xl shadow-xl">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-gray-500 font-semibold">Humedad Promedio</p>

            <h2 class="text-4xl font-black text-blue-700 mt-2">{{ avgHumidity }}%</h2>
          </div>

          <div class="bg-blue-100 p-4 rounded-2xl">
            <Droplets class="w-8 h-8 text-blue-700" />
          </div>
        </div>
      </div>

      <!-- VIENTO -->
      <div class="bg-white p-6 rounded-3xl shadow-xl">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-gray-500 font-semibold">Viento Promedio</p>

            <h2 class="text-4xl font-black text-cyan-700 mt-2">{{ avgWind }} km/h</h2>
          </div>

          <div class="bg-cyan-100 p-4 rounded-2xl">
            <Wind class="w-8 h-8 text-cyan-700" />
          </div>
        </div>
      </div>

      <!-- ESTADO -->
      <div class="bg-white p-6 rounded-3xl shadow-xl">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-gray-500 font-semibold">Estado General</p>

            <h2 class="text-4xl font-black text-green-700 mt-2">
              {{ status }}
            </h2>
          </div>

          <div class="bg-green-100 p-4 rounded-2xl">
            <CloudRain class="w-8 h-8 text-green-700" />
          </div>
        </div>
      </div>
    </div>

    <!-- CHARTS -->
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-8 mb-10">
      <!-- BAR -->
      <div class="bg-white p-8 rounded-3xl shadow-xl">
        <h2 class="text-2xl font-black text-gray-800 mb-6">Temperatura por Ciudad</h2>

        <Bar :data="temperatureData" />
      </div>

      <!-- DOUGHNUT -->
      <div class="bg-white p-8 rounded-3xl shadow-xl">
        <h2 class="text-2xl font-black text-gray-800 mb-6">Humedad Ambiental</h2>

        <Doughnut :data="humidityData" />
      </div>

      <!-- LINE -->
      <div class="bg-white p-8 rounded-3xl shadow-xl xl:col-span-2">
        <h2 class="text-2xl font-black text-gray-800 mb-6">Velocidad del Viento</h2>

        <Line :data="windData" />
      </div>
    </div>

    <!-- TABLE -->
    <div class="bg-white rounded-[35px] shadow-2xl overflow-hidden">
      <!-- HEADER -->
      <div class="bg-gradient-to-r from-green-700 to-cyan-700 p-8 text-white">
        <div class="flex items-center gap-5">
          <Activity class="w-12 h-12" />

          <div>
            <h2 class="text-4xl font-black">Historial General</h2>

            <p class="text-green-100 mt-2">Últimas consultas climáticas registradas.</p>
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
                <span> {{ history.temperature }}°C </span>
              </td>

              <!-- HUMEDAD -->
              <td class="px-6 py-5">
                <span> {{ history.humidity }}% </span>
              </td>

              <!-- VIENTO -->
              <td class="px-6 py-5">
                <span>
                  {{ history.wind }}
                </span>
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
  </DashboardLayout>
</template>
