<script setup>
import Checkbox from "@/Components/Checkbox.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";

import { Head, Link, useForm } from "@inertiajs/vue3";

import { Leaf, CloudRain, Droplets, Wind, Thermometer } from "lucide-vue-next";

defineProps({
  canResetPassword: {
    type: Boolean,
  },
  status: {
    type: String,
  },
});

const form = useForm({
  email: "",
  password: "",
  remember: false,
});

const submit = () => {
  form.post(route("login"), {
    onFinish: () => form.reset("password"),
  });
};
</script>

<template>
    <Head title="Iniciar Sesión" />

    <div
      class="min-h-screen bg-gradient-to-br from-green-100 via-white to-yellow-100 flex items-center justify-center p-6"
    >
      <div
        class="w-full max-w-6xl grid grid-cols-1 lg:grid-cols-2 overflow-hidden rounded-[35px] shadow-2xl bg-white"
      >
        <!-- LEFT -->
        <div
          class="relative bg-gradient-to-br from-green-700 via-green-800 to-green-900 p-12 text-white hidden lg:flex flex-col justify-between"
        >
          <div>
            <div class="flex items-center gap-4">
              <div class="bg-white/20 p-4 rounded-3xl">
                <Leaf class="w-10 h-10" />
              </div>

              <div>
                <h1 class="text-4xl font-black">AgroClimate</h1>

                <p class="text-green-100 mt-2">
                  Sistema Inteligente de Predicción Climática
                </p>
              </div>
            </div>

            <div class="mt-16">
              <h2 class="text-5xl font-black leading-tight">
                Optimiza las jornadas de fumigación agrícola
              </h2>

              <p class="mt-6 text-lg text-green-100 leading-relaxed">
                Consulta variables climáticas en tiempo real y mejora la toma de
                decisiones en cultivos de banano.
              </p>
            </div>
          </div>

          <!-- ICONOS -->
          <div class="grid grid-cols-2 gap-4 mt-12">
            <div class="bg-white/10 backdrop-blur-md p-5 rounded-3xl">
              <CloudRain class="w-10 h-10 mb-3 text-cyan-300" />

              <p class="font-bold">Predicción Climática</p>
            </div>

            <div class="bg-white/10 backdrop-blur-md p-5 rounded-3xl">
              <Thermometer class="w-10 h-10 mb-3 text-orange-300" />

              <p class="font-bold">Temperatura</p>
            </div>

            <div class="bg-white/10 backdrop-blur-md p-5 rounded-3xl">
              <Droplets class="w-10 h-10 mb-3 text-blue-300" />

              <p class="font-bold">Humedad</p>
            </div>

            <div class="bg-white/10 backdrop-blur-md p-5 rounded-3xl">
              <Wind class="w-10 h-10 mb-3 text-gray-200" />

              <p class="font-bold">Velocidad del viento</p>
            </div>
          </div>
        </div>

        <!-- RIGHT -->
        <div class="p-10 lg:p-16 flex items-center">
          <div class="w-full">
            <div class="mb-10">
              <h2 class="text-4xl font-black text-green-900">Bienvenido</h2>

              <p class="text-gray-500 mt-3">
                Inicia sesión para acceder al sistema climático.
              </p>
            </div>

            <div
              v-if="status"
              class="mb-6 rounded-2xl bg-green-100 border border-green-200 p-4 text-green-700 font-semibold"
            >
              {{ status }}
            </div>

            <form @submit.prevent="submit">
              <!-- EMAIL -->
              <div>
                <InputLabel
                  for="email"
                  value="Correo Electrónico"
                  class="text-gray-700"
                />

                <TextInput
                  id="email"
                  type="email"
                  class="mt-2 block w-full rounded-2xl border-gray-200 focus:border-green-500 focus:ring-green-500"
                  v-model="form.email"
                  required
                  autofocus
                  autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
              </div>

              <!-- PASSWORD -->
              <div class="mt-6">
                <InputLabel for="password" value="Contraseña" class="text-gray-700" />

                <TextInput
                  id="password"
                  type="password"
                  class="mt-2 block w-full rounded-2xl border-gray-200 focus:border-green-500 focus:ring-green-500"
                  v-model="form.password"
                  required
                  autocomplete="current-password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
              </div>

              <!-- REMEMBER -->
              <div class="mt-6 flex items-center justify-between">
                <label class="flex items-center">
                  <Checkbox name="remember" v-model:checked="form.remember" />

                  <span class="ms-2 text-sm text-gray-600"> Recordarme </span>
                </label>

                <Link
                  v-if="canResetPassword"
                  :href="route('password.request')"
                  class="text-sm text-green-700 hover:text-green-800 font-semibold"
                >
                  ¿Olvidaste tu contraseña?
                </Link>
              </div>

              <!-- BUTTON -->
              <div class="mt-10">
                <button
                  type="submit"
                  :disabled="form.processing"
                  class="w-full bg-green-700 hover:bg-green-800 transition text-white py-4 rounded-2xl text-lg font-black shadow-xl"
                >
                  Ingresar al Sistema
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
</template>
