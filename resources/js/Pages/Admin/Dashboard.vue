<script setup>
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import { Link } from "@inertiajs/vue3";

import { Users, BarChart3, CloudRain } from "lucide-vue-next";
</script>

<template>
  <DashboardLayout title="Dashboard Administrador">
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
  </DashboardLayout>
</template>
