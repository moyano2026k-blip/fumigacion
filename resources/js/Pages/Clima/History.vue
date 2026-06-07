<script setup>
import DashboardLayout from "@/Layouts/DashboardLayout.vue";

import { CloudRain, Wind, Droplets, Thermometer } from "lucide-vue-next";

defineProps({
  histories: Array,
});
</script>

<template>
  <DashboardLayout title="Historial Climático">
    <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">
      <!-- HEADER -->
      <div class="bg-gradient-to-r from-green-700 to-green-800 p-6 text-white">
        <h2 class="text-3xl font-black">Consultas Climáticas</h2>

        <p class="text-green-100 mt-2">Historial de consultas realizadas</p>
      </div>

      <!-- TABLE -->
      <div class="overflow-x-auto">
        <table class="w-full">
          <thead class="bg-green-50">
            <tr>
              <th class="px-6 py-4 text-left">Usuario</th>

              <th class="px-6 py-4 text-left">Ciudad</th>

              <th class="px-6 py-4 text-left">Temperatura</th>

              <th class="px-6 py-4 text-left">Humedad</th>

              <th class="px-6 py-4 text-left">Viento</th>

              <th class="px-6 py-4 text-left">Estado</th>

              <th class="px-6 py-4 text-left">Recomendación</th>

              <th class="px-6 py-4 text-left">Fecha</th>
            </tr>
          </thead>

          <tbody>
            <tr
              v-for="history in histories"
              :key="history.id"
              class="border-b hover:bg-green-50"
            >
              <td class="px-6 py-4">
                {{ history.user?.name }}
              </td>

              <td class="px-6 py-4">
                {{ history.city }}
              </td>

              <td class="px-6 py-4">{{ history.temperature }}°C</td>

              <td class="px-6 py-4">{{ history.humidity }}%</td>

              <td class="px-6 py-4">
                {{ history.wind }}
              </td>

              <td class="px-6 py-4 capitalize">
                {{ history.description }}
              </td>

              <td class="px-6 py-4">
                <span
                  class="bg-green-100 text-green-700 px-4 py-2 rounded-full font-bold"
                >
                  {{ history.recommendation }}
                </span>
              </td>

              <td class="px-6 py-4">
                {{ history.created_at }}
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </DashboardLayout>
</template>
