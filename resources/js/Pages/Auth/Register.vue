<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";

import { Head, Link, useForm } from "@inertiajs/vue3";

import { Leaf, User, Mail, Lock, CloudRain } from "lucide-vue-next";

const form = useForm({
  name: "",
  email: "",
  password: "",
  password_confirmation: "",
});

const submit = () => {
  form.post(route("register"), {
    onFinish: () => form.reset("password", "password_confirmation"),
  });
};
</script>

<template>
    <Head title="Registro" />

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

                <p class="text-green-100 mt-2">Plataforma Inteligente Agrícola</p>
              </div>
            </div>

            <div class="mt-16">
              <h2 class="text-5xl font-black leading-tight">
                Crea tu cuenta y monitorea el clima agrícola
              </h2>

              <p class="mt-6 text-lg text-green-100 leading-relaxed">
                Accede a información meteorológica en tiempo real y mejora las decisiones
                para tus cultivos.
              </p>
            </div>
          </div>

          <!-- CARD -->
          <div
            class="bg-white/10 backdrop-blur-md rounded-3xl p-6 border border-white/10"
          >
            <div class="flex items-center gap-4">
              <div class="bg-white/20 p-4 rounded-2xl">
                <CloudRain class="w-10 h-10 text-cyan-300" />
              </div>

              <div>
                <p class="text-green-100 text-sm">Sistema Climático</p>

                <h3 class="text-2xl font-black mt-1">Agricultura Inteligente</h3>
              </div>
            </div>
          </div>
        </div>

        <!-- RIGHT -->
        <div class="p-10 lg:p-16 flex items-center">
          <div class="w-full">
            <!-- TITLE -->
            <div class="mb-10">
              <h2 class="text-4xl font-black text-green-900">Registro</h2>

              <p class="text-gray-500 mt-3">Completa tus datos para crear una cuenta.</p>
            </div>

            <!-- FORM -->
            <form @submit.prevent="submit">
              <!-- NAME -->
              <div>
                <InputLabel for="name" value="Nombre Completo" class="text-gray-700" />

                <div class="relative mt-2">
                  <User class="w-5 h-5 absolute left-4 top-4 text-gray-400" />

                  <TextInput
                    id="name"
                    type="text"
                    class="block w-full rounded-2xl border-gray-200 pl-12 py-3 focus:border-green-500 focus:ring-green-500"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                  />
                </div>

                <InputError class="mt-2" :message="form.errors.name" />
              </div>

              <!-- EMAIL -->
              <div class="mt-6">
                <InputLabel
                  for="email"
                  value="Correo Electrónico"
                  class="text-gray-700"
                />

                <div class="relative mt-2">
                  <Mail class="w-5 h-5 absolute left-4 top-4 text-gray-400" />

                  <TextInput
                    id="email"
                    type="email"
                    class="block w-full rounded-2xl border-gray-200 pl-12 py-3 focus:border-green-500 focus:ring-green-500"
                    v-model="form.email"
                    required
                    autocomplete="username"
                  />
                </div>

                <InputError class="mt-2" :message="form.errors.email" />
              </div>

              <!-- PASSWORD -->
              <div class="mt-6">
                <InputLabel for="password" value="Contraseña" class="text-gray-700" />

                <div class="relative mt-2">
                  <Lock class="w-5 h-5 absolute left-4 top-4 text-gray-400" />

                  <TextInput
                    id="password"
                    type="password"
                    class="block w-full rounded-2xl border-gray-200 pl-12 py-3 focus:border-green-500 focus:ring-green-500"
                    v-model="form.password"
                    required
                    autocomplete="new-password"
                  />
                </div>

                <InputError class="mt-2" :message="form.errors.password" />
              </div>

              <!-- CONFIRM -->
              <div class="mt-6">
                <InputLabel
                  for="password_confirmation"
                  value="Confirmar Contraseña"
                  class="text-gray-700"
                />

                <div class="relative mt-2">
                  <Lock class="w-5 h-5 absolute left-4 top-4 text-gray-400" />

                  <TextInput
                    id="password_confirmation"
                    type="password"
                    class="block w-full rounded-2xl border-gray-200 pl-12 py-3 focus:border-green-500 focus:ring-green-500"
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password"
                  />
                </div>

                <InputError class="mt-2" :message="form.errors.password_confirmation" />
              </div>

              <!-- FOOTER -->
              <div
                class="mt-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4"
              >
                <Link
                  :href="route('login')"
                  class="text-sm text-green-700 hover:text-green-800 font-semibold"
                >
                  ¿Ya tienes cuenta? Inicia sesión
                </Link>

                <button
                  type="submit"
                  :disabled="form.processing"
                  class="bg-green-700 hover:bg-green-800 transition text-white px-8 py-4 rounded-2xl text-lg font-black shadow-xl"
                >
                  Crear Cuenta
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
</template>
