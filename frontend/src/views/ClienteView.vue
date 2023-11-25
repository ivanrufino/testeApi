<template>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Visualizar Cliente</a>

    </div>
  </nav>
  <div class="container mt-2">

    <clienteForm :codigo="codigo" :razao_social="razao_social" :tipo="tipo" :cpf_cnpj="cpf_cnpj"
      @atualizar-codigo="atualizarForm('codigo', $event)" @atualizar-razao_social="atualizarForm('razao_social', $event)"
      @atualizar-tipo="atualizarForm('tipo', $event)" @atualizar-cpf_cnpj="atualizarForm('cpf_cnpj', $event)"
      @salvar="salvar" :mensagensErro="mensagensErro" :modoVisualizacao=true />

  </div>
</template>

<script>
import clienteForm from '@/components/ClienteForm.vue';
import clienteService from '@/services/clienteService';



export default {
  components: {
    clienteForm,
  },
  data() {
    return {
      clienteData: null,
      mensagensErro: [],
    };
  },
  computed: {
    codigo() { return this.$route.params.codigo; },

    razao_social() { return this.clienteData ? this.clienteData.razao_social : null; },
    tipo() { return this.clienteData ? this.clienteData.tipo : ""; },
    cpf_cnpj() { return this.clienteData ? this.clienteData.cpf_cnpj : null; },

  },
  async mounted() {
    // Carregar os dados do Cliente da API antes de renderizar o componente
    await this.fetchClienteData();
  },
  methods: {
    async fetchClienteData() {
      try {
        const codigoEmpresa = this.$route.params.codigoEmpresa;
        const response = await await clienteService.get(codigoEmpresa, `${this.codigo}`);
        console.log(response.data.cliente)
        this.clienteData = response.data.cliente;
      } catch (error) {
        console.error('Erro ao buscar dados do Cliente:', error);
      }
    },

    async salvar() {

    }
  },
};
</script>
