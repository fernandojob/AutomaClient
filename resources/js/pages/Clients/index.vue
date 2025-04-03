<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Link, useForm } from '@inertiajs/vue3';

defineProps({
    clients: Array
});

// Função para deletar cliente
const deleteClient = (id: number) => {
    if (confirm("Tem certeza que deseja excluir este cliente?")) {
        useForm({}).delete(route('clients.destroy', id));
    }
};
</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Clientes
                </h2>
                <div class="flex gap-2">
                    <Link :href="route('clients.create')" class="bg-green-500 text-white px-4 py-2 rounded-md">
                        + Novo Cliente
                    </Link>
                    <a :href="route('clients.pdf')" class="bg-blue-500 text-white px-4 py-2 rounded-md">
                        Baixar PDF
                    </a>
                </div>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border p-2 text-left">Nome</th>
                            <th class="border p-2 text-left">Email</th>
                            <th class="border p-2 text-left">Telefone</th>
                            <th class="border p-2 text-left">Endereço</th>
                            <th class="border p-2 text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="client in clients" :key="client.id">
                            <td class="border p-2">{{ client.name }}</td>
                            <td class="border p-2">{{ client.email }}</td>
                            <td class="border p-2">{{ client.phone }}</td>
                            <td class="border p-2">{{ client.address }}</td>
                            <td class="border p-2 text-center flex gap-2 justify-center">
                                <Link :href="route('clients.edit', client.id)" class="bg-yellow-500 text-white px-3 py-1 rounded-md">
                                    Editar
                                </Link>
                                <button @click="deleteClient(client.id)" class="bg-red-500 text-white px-3 py-1 rounded-md">
                                    Excluir
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
