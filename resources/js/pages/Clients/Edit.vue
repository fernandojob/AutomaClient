<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    client: Object
});

const form = useForm({
    name: props.client.name,
    email: props.client.email,
    phone: props.client.phone,
    address: props.client.address
});

const submit = () => {
    form.patch(route('clients.update', props.client.id));
};
</script>

<template>
    <div>
        <h1 class="text-2xl font-bold">Editar Cliente</h1>

        <form @submit.prevent="submit">
            <div>
                <label>Nome:</label>
                <input v-model="form.name" type="text" class="border p-2 w-full">
            </div>

            <div>
                <label>Email:</label>
                <input v-model="form.email" type="email" class="border p-2 w-full">
            </div>

            <div>
                <label>Telefone:</label>
                <input v-model="form.phone" type="text" class="border p-2 w-full">
            </div>

            <div>
                <label>Endereço:</label>
                <input v-model="form.address" type="text" class="border p-2 w-full">
            </div>

            <button type="submit" class="bg-blue-500 text-white p-2 mt-4">Salvar</button>
        </form>
    </div>
</template>
