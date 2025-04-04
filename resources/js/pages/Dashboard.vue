<script setup>
import AuthenticatedLayout from '@/layouts/AuthenticatedLayout.vue';
import { Head, usePage, router } from '@inertiajs/vue3';
import { watchEffect } from 'vue';
import { useToast } from 'vue-toastification';
import { toRaw } from 'vue';

const page = usePage();
const toast = useToast();


const sendClientsReport = () => {
    router.get('/send-clients-report', {}, {
        preserveScroll: true,
        onSuccess: () => {
            toast.success("📩 Relatório enviado por e-mail com sucesso!");
        },
        onError: () => {
            toast.error("❌ Erro ao enviar o relatório.");
        }
    });
};


const goToClients = () => {
    router.get('/clients');
};

watchEffect(() => {
    const flash = toRaw(page.props.flash);
    if (flash.success) {
        toast.success(flash.success);
        page.props.flash.success = null;
    }
});
</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                📊 Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        Você está logado!
                    </div>
                </div>

                <!-- Botões centralizados -->
                <div class="mt-4 flex justify-center space-x-4">
                    <button @click="sendClientsReport"
                        class="p-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
                        📩 Enviar Relatório por E-mail
                    </button>

                    <button @click="goToClients"
                        class="p-2 bg-green-500 text-white rounded hover:bg-green-600 transition">
                        👤 Gerenciar Clientes
                    </button>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
