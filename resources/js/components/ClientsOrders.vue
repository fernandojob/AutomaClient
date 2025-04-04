<template>
    <div>
        <h2>Clientes e Pedidos</h2>
        <div v-if="loading">Carregando...</div>
        <div v-else>
            <div v-for="client in clients" :key="client.id" class="client">
                <h3>{{ client.name }} ({{ client.email }})</h3>
                <p><strong>Telefone:</strong> {{ client.phone }}</p>
                <p><strong>Endereço:</strong> {{ client.address }}</p>

                <h4>Pedidos:</h4>
                <ul>
                    <li v-for="order in client.orders" :key="order.id">
                        {{ order.product }} - Quantidade: {{ order.quantity }} - R$ {{ order.price }}
                    </li>
                </ul>
                <hr />
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            clients: [],
            loading: true
        };
    },
    mounted() {
        axios.get('/clients-with-orders')
            .then(response => {
                this.clients = response.data;
            })
            .catch(error => {
                console.error("Erro ao buscar dados:", error);
            })
            .finally(() => {
                this.loading = false;
            });
    }
};
</script>

<style scoped>
.client {
    border: 1px solid #ccc;
    padding: 10px;
    margin-bottom: 20px;
    border-radius: 5px;
}
</style>