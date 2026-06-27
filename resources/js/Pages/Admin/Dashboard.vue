<script setup>
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import { Link } from "@inertiajs/vue3";

import {
  Users,
  BarChart3,
  CloudRain,
  ShieldCheck,
  Activity,
  MapPinned,
  Database,
  ArrowRight,
  Leaf,
  Sparkles,
} from "lucide-vue-next";

const props = defineProps({
  users: Number,

  queries: Number,

  cities: Number,

  alerts: Number,

  lastQuery: Object,
});
</script>

<template>
  <DashboardLayout title="Dashboard Administrador">
    <div class="space-y-8">
      <!-- HERO -->

      <div
        class="rounded-[35px] overflow-hidden bg-gradient-to-r from-green-700 via-emerald-700 to-cyan-700 text-white shadow-2xl"
      >
        <div class="p-10 flex justify-between items-center">
          <div>
            <div
              class="inline-flex items-center gap-3 bg-white/20 px-5 py-2 rounded-full mb-6"
            >
              <Sparkles class="w-5 h-5" />

              <span class="font-semibold"> Panel Administrativo </span>
            </div>

            <h1 class="text-5xl font-black">AgroClimate</h1>

            <p class="text-xl text-green-100 mt-4 max-w-3xl">
              Administración completa del sistema inteligente de monitoreo climático
              agrícola del Ecuador.
            </p>
          </div>

          <div
            class="hidden xl:flex w-40 h-40 rounded-full bg-white/10 items-center justify-center"
          >
            <Leaf class="w-24 h-24" />
          </div>
        </div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
        <!-- Usuarios -->
        <div class="bg-white rounded-3xl shadow-xl p-8">
          <Users class="w-12 h-12 text-green-700 mb-4" />

          <p class="text-gray-500">Usuarios Registrados</p>

          <h2 class="text-5xl font-black text-green-700 mt-3">
            {{ users }}
          </h2>
        </div>

        <!-- Consultas -->
        <div class="bg-white rounded-3xl shadow-xl p-8">
          <CloudRain class="w-12 h-12 text-blue-700 mb-4" />

          <p class="text-gray-500">Consultas Climáticas</p>

          <h2 class="text-5xl font-black text-blue-700 mt-3">
            {{ queries }}
          </h2>
        </div>

        <!-- Ciudades -->
        <div class="bg-white rounded-3xl shadow-xl p-8">
          <MapPinned class="w-12 h-12 text-cyan-700 mb-4" />

          <p class="text-gray-500">Ciudades</p>

          <h2 class="text-5xl font-black text-cyan-700 mt-3">
            {{ cities }}
          </h2>
        </div>

        <!-- Alertas -->
        <div class="bg-white rounded-3xl shadow-xl p-8">
          <ShieldCheck class="w-12 h-12 text-red-600 mb-4" />

          <p class="text-gray-500">Alertas</p>

          <h2 class="text-5xl font-black text-red-600 mt-3">
            {{ alerts }}
          </h2>
        </div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- USUARIOS -->
        <Link
          href="/usuarios"
          class="bg-white p-6 rounded-3xl shadow-xl hover:-translate-y-1 transition block"
        >
          <Users class="w-12 h-12 text-green-700 mb-4" />

          <h3 class="text-2xl font-black text-gray-800">Usuarios</h3>

          <p class="text-gray-500 mt-2">Gestión de usuarios</p>
        </Link>

        <!-- REPORTES -->
        <Link
          href="/reportes"
          class="bg-white p-6 rounded-3xl shadow-xl hover:-translate-y-1 transition block"
        >
          <BarChart3 class="w-12 h-12 text-blue-700 mb-4" />

          <h3 class="text-2xl font-black text-gray-800">Reportes</h3>

          <p class="text-gray-500 mt-2">Estadísticas climáticas</p>
        </Link>

        <!-- HISTORIAL -->
        <Link
          href="/historial-climatico"
          class="bg-white p-6 rounded-3xl shadow-xl hover:-translate-y-1 transition block"
        >
          <CloudRain class="w-12 h-12 text-cyan-700 mb-4" />

          <h3 class="text-2xl font-black text-gray-800">Historial</h3>

          <p class="text-gray-500 mt-2">Consultas realizadas</p>
        </Link>
      </div>
    </div>

    <div v-if="lastQuery" class="bg-white rounded-[35px] shadow-xl p-8 mt-8">
      <h2 class="text-3xl font-black mb-8">Última Consulta Climática</h2>

      <div class="grid md:grid-cols-2 xl:grid-cols-5 gap-6">
        <div>
          <p class="text-gray-500">Ciudad</p>

          <h3 class="text-2xl font-black">
            {{ lastQuery.city }}
          </h3>
        </div>

        <div>
          <p class="text-gray-500">Temperatura</p>

          <h3 class="text-2xl font-black text-orange-600">
            {{ lastQuery.temperature }} °C
          </h3>
        </div>

        <div>
          <p class="text-gray-500">Humedad</p>

          <h3 class="text-2xl font-black text-blue-600">{{ lastQuery.humidity }} %</h3>
        </div>

        <div>
          <p class="text-gray-500">Nivel</p>

          <h3
            class="text-2xl font-black"
            :class="{
              'text-red-600': lastQuery.level === 'PELIGROSO',
              'text-yellow-600': lastQuery.level === 'MODERADO',
              'text-green-600': lastQuery.level === 'EXCELENTE',
            }"
          >
            {{ lastQuery.level }}
          </h3>
        </div>

        <div>
          <p class="text-gray-500">Recomendación</p>

          <h3 class="font-bold text-green-700">
            {{ lastQuery.recommendation }}
          </h3>
        </div>
      </div>
    </div>
  </DashboardLayout>
</template>
