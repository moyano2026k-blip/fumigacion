<script setup>
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
  user: Object,
});

const form = useForm({
  name: props.user.name,
  email: props.user.email,
  role: props.user.role,
});

const submit = () => {
  form.put(`/usuarios/${props.user.id}`);
};
</script>

<template>
  <DashboardLayout title="Editar Usuario">
    <div class="bg-white p-8 rounded-3xl shadow-xl max-w-2xl">
      <form @submit.prevent="submit">
        <div class="mb-5">
          <label class="font-bold text-gray-700"> Nombre </label>

          <input
            v-model="form.name"
            type="text"
            class="w-full mt-2 rounded-2xl border-gray-200"
          />
        </div>

        <div class="mb-5">
          <label class="font-bold text-gray-700"> Correo </label>

          <input
            v-model="form.email"
            type="email"
            class="w-full mt-2 rounded-2xl border-gray-200"
          />
        </div>

        <div class="mb-5">
          <label class="font-bold text-gray-700"> Rol </label>

          <select v-model="form.role" class="w-full mt-2 rounded-2xl border-gray-200">
            <option value="admin">Admin</option>

            <option value="tecnico">Técnico</option>

            <option value="usuario">Usuario</option>
          </select>
        </div>

        <button
          class="bg-blue-700 hover:bg-blue-800 text-white px-6 py-3 rounded-2xl font-black"
        >
          Actualizar Usuario
        </button>
      </form>
    </div>
  </DashboardLayout>
</template>
