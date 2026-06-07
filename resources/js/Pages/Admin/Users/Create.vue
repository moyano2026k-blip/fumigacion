<script setup>
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import { useForm, Link } from "@inertiajs/vue3";

const form = useForm({
  name: "",
  email: "",
  password: "",
  role: "usuario",
});

const submit = () => {
  form.post("/usuarios");
};
</script>

<template>
  <DashboardLayout title="Crear Usuario">
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
          <label class="font-bold text-gray-700"> Contraseña </label>

          <input
            v-model="form.password"
            type="password"
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
          class="bg-green-700 hover:bg-green-800 text-white px-6 py-3 rounded-2xl font-black"
        >
          Guardar Usuario
        </button>
      </form>
    </div>
  </DashboardLayout>
</template>
