<script setup>
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
  weather: Object,
});

const form = useForm({
  city: "",
});

const submit = () => {
  form.post("/clima");
};
</script>

<template>
  <DashboardLayout title="Consulta Climática">
    <div class="bg-white p-8 rounded-3xl shadow-xl">
      <form @submit.prevent="submit" class="flex gap-4">
        <input
          v-model="form.city"
          type="text"
          placeholder="Ingrese ciudad"
          class="flex-1 rounded-2xl border-gray-200"
        />

        <button class="bg-green-700 text-white px-6 py-3 rounded-2xl">Consultar</button>
      </form>
    </div>

    <div v-if="weather" class="mt-8 bg-white p-8 rounded-3xl shadow-xl">
      <h2 class="text-3xl font-black">
        {{ weather.city }}
      </h2>

      <p class="mt-4">
        Temperatura:
        {{ weather.temperature }}°C
      </p>

      <p>
        Humedad:
        {{ weather.humidity }}%
      </p>

      <p>
        Viento:
        {{ weather.wind }}
      </p>

      <p class="capitalize">
        Estado:
        {{ weather.description }}
      </p>

      <div class="mt-6 bg-green-100 p-4 rounded-2xl">
        <h3 class="text-2xl font-black text-green-700">
          {{ weather.recommendation }}
        </h3>
      </div>
    </div>
  </DashboardLayout>
</template>
