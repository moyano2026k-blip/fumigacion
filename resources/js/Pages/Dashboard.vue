```vue
<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";

import {
  Users,
  CloudRain,
  Thermometer,
  Droplets,
  Wind,
  AlertTriangle,
  BarChart3,
  Leaf,
  MapPinned,
  CalendarDays,
  ShieldAlert,
} from "lucide-vue-next";

const estadisticas = [
  {
    titulo: "Plantaciones Activas",
    valor: 24,
    icono: Leaf,
    color: "bg-green-100 text-green-700",
  },
  {
    titulo: "Alertas Climáticas",
    valor: 8,
    icono: AlertTriangle,
    color: "bg-red-100 text-red-700",
  },
  {
    titulo: "Usuarios Activos",
    valor: 125,
    icono: Users,
    color: "bg-blue-100 text-blue-700",
  },
  {
    titulo: "Predicciones Hoy",
    valor: 64,
    icono: CloudRain,
    color: "bg-cyan-100 text-cyan-700",
  },
];

const clima = {
  temperatura: 29,
  humedad: 81,
  viento: 14,
  lluvia: 75,
};

const alertas = [
  "Lluvias intensas detectadas en zona norte.",
  "Posible riesgo de hongos por humedad elevada.",
  "Temperatura alta en plantación sector sur.",
  "Recomendado revisar drenajes.",
];

const actividades = [
  {
    usuario: "Carlos Mendoza",
    accion: "Registró una nueva plantación",
    hora: "Hace 10 min",
  },
  {
    usuario: "María López",
    accion: "Actualizó predicciones climáticas",
    hora: "Hace 25 min",
  },
  {
    usuario: "Admin",
    accion: "Generó reporte agrícola",
    hora: "Hace 1 hora",
  },
];
</script>

<template>
  <Head title="Dashboard Administrador" />

  <AuthenticatedLayout>
    <template #header>
      <div class="flex items-center justify-between">
        <div>
          <h2 class="text-3xl font-black text-green-900">Dashboard Administrador</h2>

          <p class="text-gray-500 mt-1">
            Sistema de Predicción Climática para Banano
          </p>
        </div>

        <div
          class="hidden md:flex items-center gap-3 bg-green-100 text-green-800 px-5 py-3 rounded-2xl font-bold"
        >
          <CalendarDays class="w-5 h-5" />
          Hoy - 09:45 AM
        </div>
      </div>
    </template>

    <div class="py-8 bg-gradient-to-br from-green-50 via-white to-yellow-50 min-h-screen">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 space-y-6">
        <!-- HERO -->
        <div
          class="relative overflow-hidden rounded-[35px] bg-gradient-to-r from-green-700 via-green-800 to-green-900 p-10 shadow-2xl text-white"
        >
          <div class="absolute right-0 top-0 opacity-10">
            <CloudRain class="w-80 h-80" />
          </div>

          <div class="relative z-10">
            <div class="flex items-center gap-4 mb-4">
              <ShieldAlert class="w-12 h-12 text-yellow-300" />

              <h1 class="text-5xl font-black">Centro de Monitoreo Climático</h1>
            </div>

            <p class="text-xl text-green-100 max-w-3xl leading-relaxed">
              Administra plantaciones, monitorea alertas climáticas y analiza predicciones
              meteorológicas en tiempo real para optimizar la producción bananera.
            </p>

            <div class="mt-8 flex flex-wrap gap-4">
              <button
                class="bg-white text-green-800 px-6 py-3 rounded-2xl font-black shadow-lg hover:scale-105 transition"
              >
                Ver Reportes
              </button>

              <button
                class="border border-white/30 hover:bg-white/10 px-6 py-3 rounded-2xl font-bold transition"
              >
                Gestionar Usuarios
              </button>
            </div>
          </div>
        </div>

        <!-- ESTADISTICAS -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
          <div
            v-for="(item, index) in estadisticas"
            :key="index"
            class="bg-white rounded-3xl p-6 shadow-xl border border-gray-100 hover:-translate-y-1 transition"
          >
            <div class="flex items-center justify-between">
              <div>
                <p class="text-gray-500 text-sm">
                  {{ item.titulo }}
                </p>

                <h2 class="text-5xl font-black mt-3 text-gray-900">
                  {{ item.valor }}
                </h2>
              </div>

              <div class="p-4 rounded-2xl" :class="item.color">
                <component :is="item.icono" class="w-10 h-10" />
              </div>
            </div>
          </div>
        </div>

        <!-- CLIMA -->
        <div class="grid grid-cols-1 xl:grid-cols-4 gap-6">
          <div class="bg-white rounded-3xl p-6 shadow-xl">
            <div class="flex items-center justify-between">
              <div>
                <p class="text-gray-500">Temperatura</p>

                <h2 class="text-4xl font-black mt-2">{{ clima.temperatura }}°C</h2>
              </div>

              <div class="bg-orange-100 text-orange-700 p-4 rounded-2xl">
                <Thermometer class="w-10 h-10" />
              </div>
            </div>
          </div>

          <div class="bg-white rounded-3xl p-6 shadow-xl">
            <div class="flex items-center justify-between">
              <div>
                <p class="text-gray-500">Humedad</p>

                <h2 class="text-4xl font-black mt-2">{{ clima.humedad }}%</h2>
              </div>

              <div class="bg-blue-100 text-blue-700 p-4 rounded-2xl">
                <Droplets class="w-10 h-10" />
              </div>
            </div>
          </div>

          <div class="bg-white rounded-3xl p-6 shadow-xl">
            <div class="flex items-center justify-between">
              <div>
                <p class="text-gray-500">Viento</p>

                <h2 class="text-4xl font-black mt-2">{{ clima.viento }} km/h</h2>
              </div>

              <div class="bg-cyan-100 text-cyan-700 p-4 rounded-2xl">
                <Wind class="w-10 h-10" />
              </div>
            </div>
          </div>

          <div class="bg-white rounded-3xl p-6 shadow-xl">
            <div class="flex items-center justify-between">
              <div>
                <p class="text-gray-500">Lluvia</p>

                <h2 class="text-4xl font-black mt-2">{{ clima.lluvia }}%</h2>
              </div>

              <div class="bg-green-100 text-green-700 p-4 rounded-2xl">
                <CloudRain class="w-10 h-10" />
              </div>
            </div>
          </div>
        </div>

        <!-- GRID -->
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
          <!-- ALERTAS -->
          <div class="xl:col-span-2 bg-white rounded-3xl p-6 shadow-xl">
            <div class="flex items-center gap-3 mb-6">
              <AlertTriangle class="w-8 h-8 text-red-600" />

              <h2 class="text-2xl font-black text-gray-800">Alertas Climáticas</h2>
            </div>

            <div class="space-y-4">
              <div
                v-for="(alerta, index) in alertas"
                :key="index"
                class="bg-red-50 border border-red-100 rounded-2xl p-5"
              >
                <p class="font-semibold text-gray-700">
                  {{ alerta }}
                </p>
              </div>
            </div>
          </div>

          <!-- ACTIVIDAD -->
          <div class="bg-white rounded-3xl p-6 shadow-xl">
            <div class="flex items-center gap-3 mb-6">
              <BarChart3 class="w-8 h-8 text-green-700" />

              <h2 class="text-2xl font-black text-gray-800">Actividad Reciente</h2>
            </div>

            <div class="space-y-5">
              <div
                v-for="(actividad, index) in actividades"
                :key="index"
                class="border-b pb-4"
              >
                <h3 class="font-black text-gray-800">
                  {{ actividad.usuario }}
                </h3>

                <p class="text-gray-600 mt-1">
                  {{ actividad.accion }}
                </p>

                <span class="text-sm text-gray-400">
                  {{ actividad.hora }}
                </span>
              </div>
            </div>
          </div>
        </div>

        <!-- MAPA -->
        <div class="bg-white rounded-3xl p-6 shadow-xl">
          <div class="flex items-center gap-3 mb-6">
            <MapPinned class="w-8 h-8 text-green-700" />

            <h2 class="text-2xl font-black text-gray-800">Monitoreo de Plantaciones</h2>
          </div>

          <div
            class="h-80 rounded-3xl bg-gradient-to-br from-green-100 via-green-50 to-yellow-50 flex items-center justify-center border-2 border-dashed border-green-300"
          >
            <div class="text-center">
              <Leaf class="w-20 h-20 text-green-700 mx-auto mb-4" />

              <h3 class="text-3xl font-black text-green-900">Mapa Climático</h3>

              <p class="text-gray-600 mt-2">
                Aquí podrás integrar mapas, sensores IoT y monitoreo satelital.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
```
