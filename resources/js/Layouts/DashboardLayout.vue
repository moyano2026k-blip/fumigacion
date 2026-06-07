<script setup>
import { Link, usePage } from "@inertiajs/vue3";
import NavLink from "@/Components/NavLink.vue";

import { Leaf } from "lucide-vue-next";

defineProps({
  title: String,
});

const page = usePage();

const role = page.props.auth.user.role;

const dashboardRoute = route("dashboard");
</script>
<template>
  <div class="min-h-screen bg-gradient-to-br from-green-100 via-white to-yellow-100">
    <!-- NAVBAR -->
    <header
      class="border-b border-white/40 backdrop-blur-lg bg-white/60 sticky top-0 z-50"
    >
      <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
        <div class="flex items-center gap-4">
          <div class="bg-green-700 text-white p-3 rounded-2xl shadow-lg">
            <Leaf class="w-7 h-7" />
          </div>

          <div>
            <h1 class="text-2xl font-black text-green-900">AgroClimate</h1>

            <p class="text-sm text-gray-600">Sistema Inteligente Climático</p>
          </div>

          <!-- MENU -->
          <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
            <NavLink :href="dashboardRoute"> Dashboard </NavLink>
          </div>
        </div>

        <!-- USER -->
        <div class="flex items-center gap-4">
          <div class="text-right">
            <p class="font-bold text-gray-800">
              {{ $page.props.auth.user.name }}
            </p>

            <p class="text-sm text-gray-500 capitalize">
              {{ $page.props.auth.user.role }}
            </p>
          </div>

          <Link
            :href="route('logout')"
            method="post"
            as="button"
            class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-xl font-bold"
          >
            Salir
          </Link>
        </div>
      </div>
    </header>

    <!-- CONTENT -->
    <div class="max-w-7xl mx-auto p-6">
      <!-- TITLE -->
      <div class="mb-8">
        <h2 class="text-4xl font-black text-green-900">
          {{ title }}
        </h2>
      </div>

      <slot />
    </div>
  </div>
</template>
