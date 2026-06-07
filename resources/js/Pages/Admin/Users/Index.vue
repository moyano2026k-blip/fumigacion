<script setup>
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import { Link } from "@inertiajs/vue3";

import { Users, Plus, Pencil, Mail, ShieldCheck } from "lucide-vue-next";

defineProps({
  users: Array,
});
</script>

<template>
  <DashboardLayout title="Gestión de Usuarios">
    <!-- HEADER -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
      <div>
        <h2 class="text-3xl font-black text-green-900">Usuarios del Sistema</h2>

        <p class="text-gray-500 mt-2">Administración de usuarios y roles</p>
      </div>

      <!-- BUTTON -->
      <Link
        href="/usuarios/create"
        class="bg-green-700 hover:bg-green-800 transition text-white px-6 py-4 rounded-2xl font-black flex items-center gap-3 shadow-xl"
      >
        <Plus class="w-5 h-5" />

        Nuevo Usuario
      </Link>
    </div>

    <!-- TABLE CARD -->
    <div class="bg-white rounded-[30px] shadow-2xl overflow-hidden">
      <!-- TOP -->
      <div
        class="bg-gradient-to-r from-green-700 to-green-800 px-8 py-6 text-white flex items-center gap-4"
      >
        <div class="bg-white/20 p-3 rounded-2xl">
          <Users class="w-7 h-7" />
        </div>

        <div>
          <h3 class="text-2xl font-black">Lista de Usuarios</h3>

          <p class="text-green-100 text-sm mt-1">Usuarios registrados en el sistema</p>
        </div>
      </div>

      <!-- TABLE -->
      <div class="overflow-x-auto">
        <table class="w-full">
          <thead class="bg-green-50">
            <tr>
              <th class="text-left px-8 py-5 text-sm font-black text-green-900 uppercase">
                Usuario
              </th>

              <th class="text-left px-8 py-5 text-sm font-black text-green-900 uppercase">
                Correo
              </th>

              <th class="text-left px-8 py-5 text-sm font-black text-green-900 uppercase">
                Rol
              </th>

              <th
                class="text-center px-8 py-5 text-sm font-black text-green-900 uppercase"
              >
                Acciones
              </th>
            </tr>
          </thead>

          <tbody>
            <tr
              v-for="user in users"
              :key="user.id"
              class="border-b hover:bg-green-50 transition"
            >
              <!-- USER -->
              <td class="px-8 py-6">
                <div class="flex items-center gap-4">
                  <div
                    class="w-12 h-12 rounded-2xl bg-green-100 flex items-center justify-center"
                  >
                    <Users class="w-6 h-6 text-green-700" />
                  </div>

                  <div>
                    <p class="font-black text-gray-800">
                      {{ user.name }}
                    </p>

                    <p class="text-sm text-gray-500">ID: {{ user.id }}</p>
                  </div>
                </div>
              </td>

              <!-- EMAIL -->
              <td class="px-8 py-6">
                <div class="flex items-center gap-3">
                  <Mail class="w-5 h-5 text-gray-400" />

                  <span class="text-gray-700">
                    {{ user.email }}
                  </span>
                </div>
              </td>

              <!-- ROLE -->
              <td class="px-8 py-6">
                <span
                  class="inline-flex items-center gap-2 bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm font-black capitalize"
                >
                  <ShieldCheck class="w-4 h-4" />

                  {{ user.role }}
                </span>
              </td>

              <!-- ACTIONS -->
              <td class="px-8 py-6">
                <div class="flex items-center justify-center gap-3">
                  <!-- EDIT -->
                  <Link
                    :href="`/usuarios/${user.id}/edit`"
                    class="bg-blue-600 hover:bg-blue-700 transition text-white px-4 py-2 rounded-xl flex items-center gap-2 font-bold"
                  >
                    <Pencil class="w-4 h-4" />

                    Editar
                  </Link>
                </div>
              </td>
            </tr>

            <!-- EMPTY -->
            <tr v-if="users.length === 0">
              <td colspan="4" class="text-center py-16 text-gray-400">
                No existen usuarios registrados.
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </DashboardLayout>
</template>
