<script setup>
import DashboardLayout from "@/Layouts/DashboardLayout.vue";

import { Link, useForm } from "@inertiajs/vue3";

import {
  CloudRain,
  History,
  AlertTriangle,
  MapPinned,
  Activity,
  ShieldCheck,
  Leaf,
  Thermometer,
  Wind,
  Droplets,
  Search,
  ClipboardCheck,
  BarChart3,
} from "lucide-vue-next";

defineProps({
  weather: Object,
  totalQueries: Number,
  cities: Number,
  alerts: Number,
});

const form = useForm({
  city: "",
});

const submit = () => {
  form.post("/clima", {
    preserveScroll: true,
  });
};
</script>

<template>
  <DashboardLayout title="Dashboard Técnico">
    <!-- HERO -->
    <div
      class="bg-gradient-to-r from-cyan-700 via-blue-700 to-green-700 rounded-[35px] p-10 text-white shadow-2xl mb-10"
    >
      <div class="flex flex-col xl:flex-row xl:items-center xl:justify-between gap-8">
        <div>
          <h2 class="text-5xl font-black">Centro de Monitoreo Climático</h2>

          <p class="mt-5 text-cyan-100 text-xl">
            Supervisión agrícola inteligente y monitoreo climático del Ecuador en tiempo
            real.
          </p>
        </div>

        <!-- LAST CITY -->
        <div class="bg-white/10 backdrop-blur-lg rounded-3xl p-8 min-w-[300px]">
          <div class="flex items-center gap-4">
            <div class="bg-white/20 p-5 rounded-3xl">
              <MapPinned class="w-10 h-10" />
            </div>

            <div>
              <p class="text-cyan-100">Última ciudad monitoreada</p>

              <h3 class="text-4xl font-black mt-2">
                {{ weather?.city ?? "Sin registros" }}
              </h3>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- SEARCH -->
    <div class="bg-white rounded-[35px] shadow-2xl p-8 mb-10">
      <form @submit.prevent="submit" class="flex flex-col xl:flex-row gap-5">
        <div class="flex-1 relative">
          <Search
            class="absolute left-5 top-1/2 -translate-y-1/2 w-6 h-6 text-gray-400"
          />

          <input
            v-model="form.city"
            type="text"
            placeholder="Buscar ciudad..."
            class="w-full rounded-2xl border-gray-200 text-xl p-5 pl-14"
          />
        </div>

        <button
          class="bg-gradient-to-r from-cyan-700 to-green-700 text-white px-10 py-5 rounded-2xl font-black text-lg"
        >
          Consultar Clima
        </button>
      </form>
    </div>

    <!-- GENERAL STATS -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-10">
      <!-- CONSULTAS -->
      <div class="bg-white p-7 rounded-3xl shadow-xl">
        <Activity class="w-12 h-12 text-cyan-700 mb-5" />

        <h2 class="text-5xl font-black text-gray-800">
          {{ totalQueries }}
        </h2>

        <p class="text-gray-500 mt-2">Consultas Climáticas</p>
      </div>

      <!-- CIUDADES -->
      <div class="bg-white p-7 rounded-3xl shadow-xl">
        <MapPinned class="w-12 h-12 text-green-700 mb-5" />

        <h2 class="text-5xl font-black text-gray-800">
          {{ cities }}
        </h2>

        <p class="text-gray-500 mt-2">Ciudades Monitoreadas</p>
      </div>

      <!-- ALERTAS -->
      <div class="bg-white p-7 rounded-3xl shadow-xl">
        <AlertTriangle class="w-12 h-12 text-red-600 mb-5" />

        <h2 class="text-5xl font-black text-gray-800">
          {{ alerts }}
        </h2>

        <p class="text-gray-500 mt-2">Alertas Detectadas</p>
      </div>

      <!-- SISTEMA -->
      <div class="bg-white p-7 rounded-3xl shadow-xl">
        <ShieldCheck class="w-12 h-12 text-emerald-700 mb-5" />

        <h2 class="text-3xl font-black text-emerald-700">ACTIVO</h2>

        <p class="text-gray-500 mt-2">Estado del Sistema</p>
      </div>
    </div>

    <!-- WEATHER INFO -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-10">
      <!-- TEMP -->
      <div class="bg-white p-7 rounded-3xl shadow-xl">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-gray-500">Temperatura</p>

            <h2 class="text-5xl font-black text-orange-600 mt-2">
              {{ weather?.temperature ?? "--" }}°C
            </h2>
          </div>

          <div class="bg-orange-100 p-5 rounded-3xl">
            <Thermometer class="w-10 h-10 text-orange-600" />
          </div>
        </div>
      </div>

      <!-- HUMEDAD -->
      <div class="bg-white p-7 rounded-3xl shadow-xl">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-gray-500">Humedad</p>

            <h2 class="text-5xl font-black text-blue-700 mt-2">
              {{ weather?.humidity ?? "--" }}%
            </h2>
          </div>

          <div class="bg-blue-100 p-5 rounded-3xl">
            <Droplets class="w-10 h-10 text-blue-700" />
          </div>
        </div>
      </div>

      <!-- VIENTO -->
      <div class="bg-white p-7 rounded-3xl shadow-xl">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-gray-500">Viento</p>

            <h2 class="text-5xl font-black text-cyan-700 mt-2">
              {{ weather?.wind ?? "--" }}
            </h2>
          </div>

          <div class="bg-cyan-100 p-5 rounded-3xl">
            <Wind class="w-10 h-10 text-cyan-700" />
          </div>
        </div>
      </div>

      <!-- CULTIVO -->
      <div class="bg-white p-7 rounded-3xl shadow-xl">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-gray-500">Cultivo</p>

            <h2 class="text-2xl font-black text-green-700 mt-2">
              {{ weather?.crop_status ?? "Sin datos" }}
            </h2>
          </div>

          <div class="bg-green-100 p-5 rounded-3xl">
            <Leaf class="w-10 h-10 text-green-700" />
          </div>
        </div>
      </div>
    </div>

    <!-- MODULES -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-10">
      <!-- HISTORIAL -->
      <Link
        href="/historial-climatico"
        class="bg-white p-8 rounded-3xl shadow-xl hover:-translate-y-1 transition block"
      >
        <History class="w-14 h-14 text-orange-600 mb-6" />

        <h3 class="text-3xl font-black text-gray-800">Historial</h3>

        <p class="text-gray-500 mt-3">Revisar monitoreos climáticos.</p>
      </Link>

      <!-- VARIABLES -->
      <div class="bg-white p-8 rounded-3xl shadow-xl">
        <CloudRain class="w-14 h-14 text-cyan-700 mb-6" />

        <h3 class="text-3xl font-black text-gray-800">Variables</h3>

        <p class="text-gray-500 mt-3 font-semibold">
          {{ weather?.temperature_status ?? "Sin datos" }}
        </p>
      </div>

      <!-- ANALISIS -->
      <div class="bg-white p-8 rounded-3xl shadow-xl">
        <ClipboardCheck class="w-14 h-14 text-green-700 mb-6" />

        <h3 class="text-3xl font-black text-gray-800">Recomendación</h3>

        <p class="text-gray-500 mt-3 font-semibold">
          {{ weather?.recommendation ?? "Sin análisis" }}
        </p>
      </div>

      <!-- REPORTES -->
      <!-- REPORTES TECNICOS -->
      <Link
        href="/reportes-tecnicos"
        class="bg-white p-8 rounded-3xl shadow-xl hover:-translate-y-1 transition block"
      >
        <BarChart3 class="w-14 h-14 text-purple-700 mb-6" />

        <h3 class="text-3xl font-black text-gray-800">Reportes Técnicos</h3>

        <p class="text-gray-500 mt-3">Estadísticas climáticas y agrícolas.</p>
      </Link>
    </div>

    <!-- MONITORED CITY -->
    <div class="bg-white rounded-[35px] shadow-2xl p-10 mb-10">
      <div class="flex items-center gap-4 mb-8">
        <MapPinned class="w-12 h-12 text-green-700" />

        <div>
          <h2 class="text-4xl font-black text-gray-800">Ciudad Monitoreada</h2>

          <p class="text-gray-500 mt-2">Última ciudad consultada en el sistema.</p>
        </div>
      </div>

      <div
        class="bg-gradient-to-r from-green-50 to-cyan-50 border border-green-100 rounded-3xl p-8"
      >
        <h3 class="text-4xl font-black text-green-700">
          {{ weather?.city ?? "Sin registros" }}
        </h3>

        <p class="text-gray-500 mt-3">Monitoreo climático activo.</p>
      </div>
    </div>

    <!-- ALERTS -->
    <!-- ALERTAS DINÁMICAS -->
    <div class="bg-white rounded-[35px] shadow-2xl overflow-hidden">
      <!-- HEADER -->
      <div
        class="p-8 text-white"
        :class="
          weather?.recommendation?.toLowerCase().includes('riesgo')
            ? 'bg-gradient-to-r from-red-600 to-orange-600'
            : 'bg-gradient-to-r from-green-600 to-emerald-600'
        "
      >
        <div class="flex items-center justify-between">
          <div class="flex items-center gap-5">
            <AlertTriangle class="w-12 h-12" />

            <div>
              <h2 class="text-4xl font-black">Centro de Alertas</h2>

              <p class="mt-2 opacity-90">
                Evaluación automática de condiciones agrícolas.
              </p>
            </div>
          </div>

          <div class="bg-white/20 px-5 py-2 rounded-full text-lg font-bold animate-pulse">
            {{
              weather?.recommendation?.toLowerCase().includes("riesgo")
                ? "RIESGO ALTO"
                : "ESTABLE"
            }}
          </div>
        </div>
      </div>

      <!-- CONTENT -->
      <div class="p-10">
        <div class="grid md:grid-cols-3 gap-6">
          <!-- RECOMENDACION -->
          <div
            class="rounded-3xl p-6 border transition hover:scale-105"
            :class="
              weather?.recommendation?.toLowerCase().includes('riesgo')
                ? 'bg-red-50 border-red-200'
                : 'bg-green-50 border-green-200'
            "
          >
            <h3
              class="text-2xl font-black"
              :class="
                weather?.recommendation?.toLowerCase().includes('riesgo')
                  ? 'text-red-700'
                  : 'text-green-700'
              "
            >
              Recomendación
            </h3>

            <p class="mt-4 text-gray-700 font-medium">
              {{ weather?.recommendation ?? "Sin recomendaciones disponibles" }}
            </p>
          </div>

          <!-- CULTIVO -->
          <div
            class="rounded-3xl p-6 border bg-blue-50 border-blue-200 transition hover:scale-105"
          >
            <h3 class="text-2xl font-black text-blue-700">Estado del Cultivo</h3>

            <p class="mt-4 text-gray-700 font-medium">
              {{ weather?.crop_status ?? "Sin monitoreo" }}
            </p>
          </div>

          <!-- LLUVIA -->
          <div
            class="rounded-3xl p-6 border bg-cyan-50 border-cyan-200 transition hover:scale-105"
          >
            <h3 class="text-2xl font-black text-cyan-700">Condición Climática</h3>

            <p class="mt-4 text-gray-700 font-medium">
              {{ weather?.rain_status ?? "Sin datos meteorológicos" }}
            </p>
          </div>
        </div>

        <!-- RESUMEN GENERAL -->
        <div
          class="mt-8 rounded-3xl p-8 border"
          :class="
            weather?.humidity > 80 ||
            weather?.temperature > 30 ||
            weather?.temperature < 5
              ? 'bg-red-50 border-red-200'
              : 'bg-green-50 border-green-200'
          "
        >
          <h3 class="text-3xl font-black mb-4">Diagnóstico General</h3>

          <div class="grid md:grid-cols-3 gap-4 text-lg">
            <div>
              🌡️ Temperatura:
              <strong>{{ weather?.temperature ?? "--" }}°C</strong>
            </div>

            <div>
              💧 Humedad:
              <strong>{{ weather?.humidity ?? "--" }}%</strong>
            </div>

            <div>
              🌬️ Viento:
              <strong>{{ weather?.wind ?? "--" }}</strong>
            </div>
          </div>

          <div class="mt-6">
            <span
              v-if="
                weather?.humidity > 80 ||
                weather?.temperature > 30 ||
                weather?.temperature < 5
              "
              class="inline-flex items-center gap-2 bg-red-600 text-white px-5 py-2 rounded-full font-bold animate-pulse"
            >
              ⚠️ Atención requerida
            </span>

            <span
              v-else
              class="inline-flex items-center gap-2 bg-green-600 text-white px-5 py-2 rounded-full font-bold"
            >
              ✅ Condiciones favorables
            </span>
          </div>
        </div>
      </div>
    </div>
  </DashboardLayout>
</template>
