<template>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Lista de Empresa</a>

    </div>
  </nav>
  <div class="container mt-2">
    <!-- Tabela de Empresas -->
    <router-link :to="{ name: 'CriarEmpresa' }" class="btn btn-info btn-sm">Criar Empresa</router-link>
    <table class="table table-striped table-hover table-responsive">
      <!-- Cabeçalho da Tabela -->
      <thead>
        <tr>
          <th scope="col">Código</th>
          <th scope="col">Empresa</th>
          <th scope="col">Sigla</th>
          <th scope="col">Ações</th>
        </tr>
      </thead>
      <!-- Corpo da Tabela -->
      <tbody>
        <tr v-for="empresa in empresas" :key="empresa.codigo">
          <td>{{ empresa.codigo }}</td>
          <td>{{ empresa.empresa }}</td>
          <td>{{ empresa.sigla }}</td>
          <td>
            <router-link :to="{ name: 'visualizarEmpresa', params: { codigo: empresa.codigo } }"
              class="btn btn-info btn-sm me-1">Visualizar</router-link>
            <router-link :to="{ name: 'editarEmpresa', params: { codigo: empresa.codigo } }"
              class="btn btn-warning btn-sm me-1">Editar</router-link>
            <button @click="excluirEmpresa(empresa)" class="btn btn-danger btn-sm me-1">Excluir</button>
            <router-link :to="{ name: 'verClientes', params: { codigoEmpresa: empresa.codigo } }"
              class="btn btn-info btn-sm me-1">Ver Clientes</router-link>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import empresaService from '@/services/empresaService';

export default {
  data() {
    return {
      empresas: [],
    };
  },
  mounted() {
    this.fetchEmpresas();
  },
  methods: {
    async fetchEmpresas() {
      try {
        const response = await empresaService.getAll();
        this.empresas = response.data.empresas;
      } catch (error) {
        console.error('Erro ao buscar empresas:', error);
      }
    },
    async excluirEmpresa(empresa) {
      const confirmacao = confirm('Tem certeza que deseja excluir esta empresa?');
      if (confirmacao) {
        try {
          await empresaService.delete(empresa.codigo);
          // Atualizando a lista de empresas após a exclusão
          this.fetchEmpresas();
        } catch (error) {
          console.error('Erro ao excluir empresa:', error);
        }
      }
    },
    
  },
};
</script>
