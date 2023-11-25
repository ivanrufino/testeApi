<template>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Editar Empresa</a>
    
  </div>
</nav>
  
   <div class="container mt-2">
    
    <EmpresaForm 
        :codigo="codigo" 
        :empresa="empresa"
        :sigla="sigla"
        :razao_social="razao_social"
        @atualizar-codigo="atualizarForm('codigo', $event)"
        @atualizar-empresa="atualizarForm('empresa', $event)"
        @atualizar-sigla="atualizarForm('sigla', $event)"
        @atualizar-razao_social="atualizarForm('razao_social', $event)"
        @salvar="salvar"
        :mensagensErro="mensagensErro"
    />
    
    
    
    
  </div>
</template>

<script>
import EmpresaForm from '@/components/EmpresaForm.vue';
import empresaService from '@/services/empresaService';

export default {
  components: {
    EmpresaForm,
  },
  data() {
    return {
      empresaData: null,
      mensagensErro: [],
    };
  },
  computed: {
    codigo() {return this.$route.params.codigo;    },

    empresa() {return this.empresaData ? this.empresaData.empresa : null;     },
    sigla() {return this.empresaData ? this.empresaData.sigla : null;   },
    razao_social() {return this.empresaData ? this.empresaData.razao_social : null;    },
  },
  async mounted() {
    // Carregar os dados da empresa da API antes de renderizar o componente
    await this.fetchEmpresaData();
  },
  methods: {
    async fetchEmpresaData() {
      try {
        const response = await  await empresaService.get(`${this.codigo}`);
        console.log(response.data.empresa)
        this.empresaData = response.data.empresa;
      } catch (error) {
        console.error('Erro ao buscar dados da empresa:', error);
      }
    },
    atualizarForm(campo, valor) {
      // Atualize os dados do formulário quando o evento for recebido
      console.log(valor.target.value)
      this.empresaData[campo] = valor.target.value;
    },
    async salvar() {
      try {
        // Os dados já estão vinculados às propriedades do componente
        const dados = await empresaService.update(this.codigo, this.empresaData);
        
        
        console.log('Empresa atualizada com sucesso!');
        if(dados.status==200){
            this.$router.push('/empresas');
        }
      } catch (error) {
        this.mensagensErro = error.response.data.errors || ['Erro desconhecido. Tente novamente.'];
        console.error('Erro ao salvar empresa:', error.response.data.errors);
      }
    },
  },
};
</script>
