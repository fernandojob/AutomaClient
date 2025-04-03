<template>
    <div class="client-list">
      <input 
        v-model="search" 
        placeholder="Buscar cliente..." 
        class="search-input"
      />
      <ul class="client-ul">
        <li 
          v-for="client in filteredClients" 
          :key="client.id"
          class="client-item"
        >
          {{ client.name }} - {{ client.email }}
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
  
  const search = ref('');
  const clients = ref<Client[]>([]);
  
  // Busca dados da API Laravel
  const fetchClients = async () => {
    try {
      const response = await fetch('/api/clients');
      clients.value = await response.json();
    } catch (error) {
      console.error('Erro ao buscar clientes:', error);
    }
  };
  
  onMounted(fetchClients);
  
  const filteredClients = computed(() => 
    clients.value.filter(c => 
      c.name.toLowerCase().includes(search.value.toLowerCase()) ||
      c.email.toLowerCase().includes(search.value.toLowerCase())
    )
  );
  </script>
  
  <style scoped>
  .client-list {
    max-width: 800px;
    margin: 0 auto;
  }
  .search-input {
    padding: 8px;
    width: 100%;
    margin-bottom: 16px;
  }
  .client-ul {
    list-style: none;
    padding: 0;
  }
  .client-item {
    padding: 8px;
    border-bottom: 1px solid #eee;
  }
  </style>