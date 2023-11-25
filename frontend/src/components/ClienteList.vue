<template>
 <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Lista Cliente</a>
    
  </div>
</nav>
  
   <div class="container mt-2">
    <!-- Tabela de Clientes -->
    <router-link :to="{ name: 'cadastrarCliente'}" class="btn btn-info btn-sm">Cadastrar Cliente</router-link>
    <table class="table table-striped table-hover">
      <!-- Cabeçalho da Tabela -->
      <thead>
        <tr>
          <th scope="col">Código</th>
          <th scope="col">Razão Social</th>
           <th scope="col">Ações</th>
        </tr>
      </thead>
      <!-- Corpo da Tabela -->
      <tbody>
        <tr v-for="cliente in clientes" :key="cliente.renum">
          <td>{{ cliente.codigo }}</td>
          <td>{{ cliente.razao_social }}</td>
          <td><router-link :to="{ name: 'visualizarCliente', params: { codigoEmpresa: cliente.empresa, codigo:cliente.codigo } }" class="btn btn-info btn-sm me-1" >Visualizar</router-link>
           <router-link :to="{ name: 'editarCliente', params:{ codigoEmpresa: cliente.empresa, codigo:cliente.codigo }  }" class="btn btn-warning btn-sm me-1">Editar</router-link>
          <button @click="excluirCliente(cliente)" class="btn btn-danger btn-sm me-1">Excluir</button>
           </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import clienteService from '@/services/clienteService';

export default {
  props: {
    codigoEmpresa: {
      type: String,
      required: true,
    },
  },
  data() {
    return {
      clientes: [],
    };
  },
  mounted() {
    this.fetchClientes();
  },
  methods: {
    async fetchClientes() {
      try {
        const response = await clienteService.getByEmpresa(this.codigoEmpresa);
        this.clientes = response.data.clientes;
      } catch (error) {
        console.error('Erro ao buscar clientes:', error);
      }
    },
  
  async excluirCliente(cliente) {
      const confirmacao = confirm('Tem certeza que deseja excluir Este cliente?');
      if (confirmacao) {
        try {
          await clienteService.delete(cliente.empresa,cliente.codigo);
          // Atualize a lista de clientes após a exclusão
          this.fetchClientes();
        } catch (error) {
          console.error('Erro ao excluir Cliente:', error);
        }
      }
    },
    },
};
</script>
