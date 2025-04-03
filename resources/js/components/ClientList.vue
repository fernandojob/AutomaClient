<template>
  <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <input
      v-model="search"
      placeholder="Buscar cliente..."
      class="mb-4 p-2 border rounded w-full focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
    >

    <ul class="divide-y divide-gray-200">
      <li
        v-for="client in filteredClients"
        :key="client.id"
        class="p-4 hover:bg-gray-50 transition-colors duration-200"
      >
        <div class="flex justify-between items-start">
          <div>
            <div class="font-medium text-gray-900">{{ client.name }}</div>
            <div class="text-gray-600">{{ client.email }}</div>
            <div class="text-sm text-gray-500">{{ client.phone }}</div>
          </div>
          <div v-if="client.address" class="text-xs text-gray-400 max-w-xs truncate">
            {{ client.address }}
          </div>
        </div>
      </li>
    </ul>
  </div>
</template>

<script setup lang="ts">
import { ref, computed, onMounted } from 'vue';

interface Client {
  id: number;
  name: string;
  email: string;
  phone?: string;
  address?: string;
}

const props = defineProps<{
  clients?: Client[]; // Recebendo via prop ou busca interna
}>();

const search = ref('');
const localClients = ref<Client[]>([]);

// Se não receber clients por prop, busca da API
onMounted(async () => {
  if (!props.clients) {
    try {
      const response = await fetch('/api/clients');
      localClients.value = await response.json();
    } catch (error) {
      console.error('Erro ao buscar clientes:', error);
    }
  }
});

const clientList = computed(() => props.clients || localClients.value);

const filteredClients = computed(() => {
  const searchTerm = search.value.toLowerCase();
  return clientList.value.filter(c =>
    c.name.toLowerCase().includes(searchTerm) ||
    c.email.toLowerCase().includes(searchTerm) ||
    (c.phone && c.phone.includes(searchTerm))
  );
});
</script>

<style scoped>
/* Estilos otimizados do Tailwind */
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.3s ease;
}
.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>