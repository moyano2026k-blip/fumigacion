<script setup>
import DashboardLayout from "@/Layouts/DashboardLayout.vue";

import { useForm, Link } from "@inertiajs/vue3";

import {
  CloudRain,
  Thermometer,
  Droplets,
  Wind,
  Leaf,
  Sun,
  Activity,
  MapPin,
  Search,
} from "lucide-vue-next";

defineProps({
  weather: Object,
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
  <DashboardLayout title="Dashboard Usuario">
    <!-- HERO -->
    <div
      class="bg-gradient-to-r from-green-700 via-green-800 to-emerald-700 rounded-[35px] p-10 text-white shadow-2xl mb-10"
    >
      <div class="flex flex-col xl:flex-row xl:items-center xl:justify-between gap-10">
        <!-- INFO -->
        <div class="flex-1">
          <h2 class="text-5xl font-black leading-tight">Sistema Inteligente Climático</h2>

          <p class="mt-5 text-green-100 text-xl max-w-3xl">
            Consulta condiciones climáticas en tiempo real y obtén recomendaciones
            agrícolas inteligentes para fumigación y monitoreo de cultivos.
          </p>

          <!-- SEARCH -->
          <div class="mt-8 bg-white/10 backdrop-blur-lg rounded-3xl p-5">
            <form @submit.prevent="submit" class="flex flex-col md:flex-row gap-4">
              <div class="flex-1 relative">
                <Search
                  class="absolute left-5 top-1/2 -translate-y-1/2 w-6 h-6 text-green-200"
                />

                <input
                  v-model="form.city"
                  type="text"
                  placeholder="Ingrese ciudad..."
                  class="w-full rounded-2xl border-0 bg-white/20 text-white placeholder:text-green-100 pl-14 py-4 focus:ring-2 focus:ring-white"
                />
              </div>

              <button
                class="bg-white text-green-800 hover:bg-green-100 px-8 py-4 rounded-2xl font-black transition"
              >
                Consultar Clima
              </button>
            </form>
          </div>
        </div>

        <!-- CITY -->
        <div class="bg-white/10 backdrop-blur-lg rounded-3xl p-8 min-w-[300px]">
          <div class="flex items-center gap-4">
            <div class="bg-white/20 p-5 rounded-3xl">
              <MapPin class="w-10 h-10" />
            </div>

            <div>
              <p class="text-green-100">Última consulta</p>

              <h3 class="text-4xl font-black mt-2">
                {{ weather?.city ?? "Sin datos" }}
              </h3>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- WEATHER STATS -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-10">
      <!-- TEMPERATURE -->
      <div class="bg-white p-7 rounded-3xl shadow-xl hover:-translate-y-1 transition">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-gray-500 font-semibold">Temperatura</p>

            <h2 class="text-5xl font-black text-orange-600 mt-3">
              {{ weather?.temperature ?? "--" }}°C
            </h2>
          </div>

          <div class="bg-orange-100 p-5 rounded-3xl">
            <Thermometer class="w-10 h-10 text-orange-600" />
          </div>
        </div>
      </div>

      <!-- HUMIDITY -->
      <div class="bg-white p-7 rounded-3xl shadow-xl hover:-translate-y-1 transition">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-gray-500 font-semibold">Humedad</p>

            <h2 class="text-5xl font-black text-blue-700 mt-3">
              {{ weather?.humidity ?? "--" }}%
            </h2>
          </div>

          <div class="bg-blue-100 p-5 rounded-3xl">
            <Droplets class="w-10 h-10 text-blue-700" />
          </div>
        </div>
      </div>

      <!-- WIND -->
      <div class="bg-white p-7 rounded-3xl shadow-xl hover:-translate-y-1 transition">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-gray-500 font-semibold">Viento</p>

            <h2 class="text-5xl font-black text-cyan-700 mt-3">
              {{ weather?.wind ?? "--" }}
            </h2>
          </div>

          <div class="bg-cyan-100 p-5 rounded-3xl">
            <Wind class="w-10 h-10 text-cyan-700" />
          </div>
        </div>
      </div>

      <!-- RAIN -->
      <div class="bg-white p-7 rounded-3xl shadow-xl hover:-translate-y-1 transition">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-gray-500 font-semibold">Estado</p>

            <h2 class="text-2xl font-black text-green-700 mt-3">
              {{ weather?.rain_status ?? "Sin datos" }}
            </h2>
          </div>

          <div class="bg-green-100 p-5 rounded-3xl">
            <CloudRain class="w-10 h-10 text-green-700" />
          </div>
        </div>
      </div>
    </div>

    <!-- MODULES -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 mb-10">
      <!-- HISTORIAL -->
      <Link
        href="/historial-climatico"
        class="bg-white p-8 rounded-3xl shadow-xl hover:-translate-y-1 transition block"
      >
        <Activity class="w-14 h-14 text-green-700 mb-6" />

        <h3 class="text-3xl font-black text-gray-800">Historial</h3>

        <p class="text-gray-500 mt-3">Revisar consultas climáticas realizadas.</p>
      </Link>

      <!-- CULTIVO -->
      <div class="bg-white p-8 rounded-3xl shadow-xl">
        <Leaf class="w-14 h-14 text-green-700 mb-6" />

        <h3 class="text-3xl font-black text-gray-800">Estado Cultivo</h3>

        <p class="text-gray-500 mt-3 text-lg font-semibold">
          {{ weather?.crop_status ?? "Sin análisis" }}
        </p>
      </div>

      <!-- TEMPERATURE STATUS -->
      <div class="bg-white p-8 rounded-3xl shadow-xl">
        <Sun class="w-14 h-14 text-yellow-500 mb-6" />

        <h3 class="text-3xl font-black text-gray-800">Temperatura</h3>

        <p class="text-gray-500 mt-3 text-lg font-semibold">
          {{ weather?.temperature_status ?? "Sin datos" }}
        </p>
      </div>
    </div>

    <!-- SMART RECOMMENDATION -->
    <div class="bg-white rounded-[35px] shadow-2xl overflow-hidden">
      <!-- HEADER -->
      <div class="bg-gradient-to-r from-green-700 to-green-800 p-8 text-white">
        <div class="flex items-center gap-5">
          <div class="bg-white/20 p-5 rounded-3xl">
            <Leaf class="w-10 h-10" />
          </div>

          <div>
            <h2 class="text-4xl font-black">Recomendación Inteligente</h2>

            <p class="text-green-100 mt-2">Análisis automático basado en clima</p>
          </div>
        </div>
      </div>

      <!-- CONTENT -->
      <div class="p-10">
        <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">
          <!-- RECOMMENDATION -->
          <div>
            <h3 class="text-3xl font-black text-gray-800 mb-6">Resultado</h3>

            <div class="bg-green-100 border border-green-200 rounded-3xl p-8">
              <h2 class="text-3xl font-black text-green-800">
                {{ weather?.recommendation ?? "Sin recomendación" }}
              </h2>
            </div>
          </div>

          <!-- DETAILS -->
          <div class="space-y-5">
            <div class="bg-gray-50 p-6 rounded-3xl">
              <p class="text-gray-500 font-semibold">Estado Climático</p>

              <h3 class="text-2xl font-black text-gray-800 mt-2 capitalize">
                {{ weather?.description ?? "Sin datos" }}
              </h3>
            </div>

            <div class="bg-gray-50 p-6 rounded-3xl">
              <p class="text-gray-500 font-semibold">Nivel Fumigación</p>

              <h3 class="text-2xl font-black text-gray-800 mt-2">
                {{ weather?.level ?? "Sin datos" }}
              </h3>
            </div>

            <div class="bg-gray-50 p-6 rounded-3xl">
              <p class="text-gray-500 font-semibold">Ciudad Consultada</p>

              <h3 class="text-2xl font-black text-gray-800 mt-2">
                {{ weather?.city ?? "Sin datos" }}
              </h3>
            </div>
          </div>
        </div>
      </div>
    </div>
  </DashboardLayout>
</template>
