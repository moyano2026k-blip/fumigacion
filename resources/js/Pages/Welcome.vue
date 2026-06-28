<script setup>
import { Head, Link } from "@inertiajs/vue3";

import {
  CloudRain,
  Thermometer,
  Droplets,
  Wind,
  Leaf,
  ShieldCheck,
  Activity,
  MapPinned,
  Eye,
  Gauge,
  Sunrise,
  Sunset,
  Cloud,
} from "lucide-vue-next";

defineProps({
  canLogin: Boolean,
  canRegister: Boolean,
  clima: Object,
  pronostico: Array,
});
</script>

<template>
  <Head title="" />

  <div class="min-h-screen bg-gradient-to-br from-green-100 via-white to-cyan-100">
    <!-- NAVBAR -->

    <header class="sticky top-0 z-50 bg-white/80 backdrop-blur-lg border-b">
      <div class="max-w-7xl mx-auto px-6 py-5 flex justify-between items-center">
        <div class="flex items-center gap-4">
          <div class="bg-gradient-to-r from-green-700 to-cyan-700 p-4 rounded-3xl">
            <Leaf class="w-8 h-8 text-white" />
          </div>

          <div>
            <h1 class="text-3xl font-black text-green-800">AgroClimate</h1>

            <p class="text-gray-500">Sistema Inteligente Climático</p>
          </div>
        </div>

        <div class="flex gap-4">
          <Link
            v-if="canLogin"
            href="/login"
            class="px-6 py-3 rounded-2xl border font-bold hover:bg-green-50"
          >
            Iniciar Sesión
          </Link>

          <Link
            v-if="canRegister"
            href="/register"
            class="px-6 py-3 rounded-2xl bg-green-700 text-white font-bold"
          >
            Registrarse
          </Link>
        </div>
      </div>
    </header>

    <!-- HERO -->

    <section class="max-w-7xl mx-auto px-6 py-16">
      <div class="grid lg:grid-cols-2 gap-10 items-center">
        <div>
          <div
            class="inline-flex gap-3 items-center bg-green-100 px-5 py-3 rounded-full font-bold text-green-700"
          >
            <ShieldCheck class="w-5 h-5" />

            Monitoreo Climático Inteligente
          </div>

          <h1 class="mt-8 text-6xl font-black text-gray-900 leading-tight">
            Agricultura Inteligente para el Ecuador
          </h1>

          <p class="mt-8 text-xl text-gray-600">
            Consulte en tiempo real las condiciones meteorológicas, obtenga
            recomendaciones agrícolas y visualice el estado ambiental de la ciudad de
            Quito, Ecuador.
          </p>
        </div>

        <!-- TARJETA PRINCIPAL -->

        <div class="bg-white rounded-[40px] shadow-2xl overflow-hidden">
          <div class="bg-gradient-to-r from-green-700 to-cyan-700 text-white p-8">
            <div class="flex justify-between items-center">
              <div>
                <h2 class="text-4xl font-black">
                  {{ clima.ciudad }}
                </h2>

                <p class="mt-2">
                  {{ clima.descripcion }}
                </p>
              </div>

              <img
                :src="`https://openweathermap.org/img/wn/${clima.icono}@4x.png`"
                class="w-28 h-28"
              />
            </div>
          </div>

          <div class="p-8">
            <div class="grid grid-cols-2 gap-5">
              <div class="bg-orange-50 rounded-3xl p-5">
                <Thermometer class="text-orange-600 w-10 h-10" />

                <p class="mt-3 text-gray-500">Temperatura</p>

                <h3 class="text-4xl font-black text-orange-600">
                  {{ clima.temperatura }} °C
                </h3>
              </div>

              <div class="bg-red-50 rounded-3xl p-5">
                <Activity class="text-red-600 w-10 h-10" />

                <p class="mt-3 text-gray-500">Sensación</p>

                <h3 class="text-4xl font-black text-red-600">{{ clima.sensacion }} °C</h3>
              </div>

              <div class="bg-blue-50 rounded-3xl p-5">
                <Droplets class="text-blue-700 w-10 h-10" />

                <p class="mt-3">Humedad</p>

                <h3 class="text-4xl font-black text-blue-700">{{ clima.humedad }} %</h3>
              </div>

              <div class="bg-cyan-50 rounded-3xl p-5">
                <Wind class="text-cyan-700 w-10 h-10" />

                <p class="mt-3">Viento</p>

                <h3 class="text-4xl font-black text-cyan-700">{{ clima.viento }} km/h</h3>
              </div>

              <div class="bg-green-50 rounded-3xl p-5">
                <CloudRain class="text-green-700 w-10 h-10" />

                <p class="mt-3">Lluvia</p>

                <h3 class="text-4xl font-black text-green-700">{{ clima.lluvia }} mm</h3>
              </div>

              <div class="bg-indigo-50 rounded-3xl p-5">
                <Gauge class="text-indigo-700 w-10 h-10" />

                <p class="mt-3">Presión</p>

                <h3 class="text-4xl font-black text-indigo-700">
                  {{ clima.presion }} hPa
                </h3>
              </div>
            </div>
            <!-- INFORMACIÓN ADICIONAL -->

            <div class="grid grid-cols-2 gap-5 mt-6">
              <div class="bg-gray-50 rounded-3xl p-5">
                <Cloud class="w-8 h-8 text-gray-600" />

                <p class="text-gray-500 mt-3">Nubosidad</p>

                <h3 class="text-3xl font-black text-gray-700">{{ clima.nubosidad }} %</h3>
              </div>

              <div class="bg-sky-50 rounded-3xl p-5">
                <Eye class="w-8 h-8 text-sky-700" />

                <p class="text-gray-500 mt-3">Visibilidad</p>

                <h3 class="text-3xl font-black text-sky-700">
                  {{ clima.visibilidad }} km
                </h3>
              </div>

              <div class="bg-yellow-50 rounded-3xl p-5">
                <Sunrise class="w-8 h-8 text-yellow-600" />

                <p class="text-gray-500 mt-3">Amanecer</p>

                <h3 class="text-3xl font-black text-yellow-600">
                  {{ clima.amanecer }}
                </h3>
              </div>

              <div class="bg-orange-50 rounded-3xl p-5">
                <Sunset class="w-8 h-8 text-orange-600" />

                <p class="text-gray-500 mt-3">Atardecer</p>

                <h3 class="text-3xl font-black text-orange-600">
                  {{ clima.atardecer }}
                </h3>
              </div>
            </div>

            <!-- RECOMENDACIÓN -->

            <div
              class="mt-8 bg-gradient-to-r from-green-700 to-cyan-700 rounded-3xl p-8 text-white"
            >
              <div class="flex items-center gap-4">
                <Activity class="w-10 h-10" />

                <div>
                  <p class="text-green-100">Estado Agrícola</p>

                  <h2 class="text-3xl font-black">
                    {{ clima.estado }}
                  </h2>
                </div>
              </div>

              <p class="mt-5 text-lg">
                {{ clima.recomendacion }}
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- PRONÓSTICO -->

    <section class="max-w-7xl mx-auto px-6 pb-16">
      <h2 class="text-4xl font-black text-gray-800 mb-10">
        Pronóstico de los próximos días
      </h2>

      <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-5 gap-6">
        <div
          v-for="dia in pronostico"
          :key="dia.fecha"
          class="bg-white rounded-3xl shadow-xl p-6 text-center"
        >
          <h3 class="font-black text-xl">
            {{ dia.dia }}
          </h3>

          <p class="text-gray-500">
            {{ dia.fecha }}
          </p>

          <img
            :src="`https://openweathermap.org/img/wn/${dia.icono}@2x.png`"
            class="mx-auto w-20 h-20"
          />

          <h2 class="text-4xl font-black text-green-700">{{ dia.temperatura }}°</h2>

          <p class="capitalize text-gray-600">
            {{ dia.descripcion }}
          </p>
        </div>
      </div>
    </section>

    <!-- BENEFICIOS -->

    <section class="bg-white py-20">
      <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-5xl font-black text-center text-gray-900">
          ¿Qué ofrece AgroClimate?
        </h2>

        <p class="text-center text-gray-500 text-xl mt-5">
          Plataforma inteligente para apoyar la toma de decisiones agrícolas.
        </p>

        <div class="grid md:grid-cols-2 xl:grid-cols-4 gap-8 mt-14">
          <div class="rounded-3xl bg-green-50 p-8">
            <CloudRain class="w-14 h-14 text-green-700" />

            <h3 class="text-2xl font-black mt-6">Clima en Tiempo Real</h3>

            <p class="mt-3 text-gray-600">
              Información meteorológica actualizada automáticamente desde OpenWeather.
            </p>
          </div>

          <div class="rounded-3xl bg-cyan-50 p-8">
            <Leaf class="w-14 h-14 text-cyan-700" />

            <h3 class="text-2xl font-black mt-6">Agricultura Inteligente</h3>

            <p class="mt-3 text-gray-600">
              Recomendaciones para fumigación y manejo agrícola.
            </p>
          </div>

          <div class="rounded-3xl bg-purple-50 p-8">
            <Gauge class="w-14 h-14 text-purple-700" />

            <h3 class="text-2xl font-black mt-6">Variables Ambientales</h3>

            <p class="mt-3 text-gray-600">
              Temperatura, humedad, viento, presión y visibilidad.
            </p>
          </div>

          <div class="rounded-3xl bg-yellow-50 p-8">
            <MapPinned class="w-14 h-14 text-yellow-600" />

            <h3 class="text-2xl font-black mt-6">Monitoreo para Ecuador</h3>

            <p class="mt-3 text-gray-600">
              Información climática orientada al territorio ecuatoriano.
            </p>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>
