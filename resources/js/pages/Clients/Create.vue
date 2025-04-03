<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    phone: '',
    address: ''
});

const submit = () => {
    form.post(route('clients.store'));
};
</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Novo Cliente
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <form @submit.prevent="submit" class="bg-white p-6 rounded-md shadow-md">
                    <div class="mb-4">
                        <label class="block font-medium text-gray-700">Nome</label>
                        <input v-model="form.name" type="text" class="w-full border-gray-300 rounded-md shadow-sm" required />
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-gray-700">E-mail</label>
                        <input v-model="form.email" type="email" class="w-full border-gray-300 rounded-md shadow-sm" required />
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-gray-700">Telefone</label>
                        <input v-model="form.phone" type="text" class="w-full border-gray-300 rounded-md shadow-sm" required />
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-gray-700">Endereço</label>
                        <input v-model="form.address" type="text" class="w-full border-gray-300 rounded-md shadow-sm" />
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">
                            Salvar Cliente
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
