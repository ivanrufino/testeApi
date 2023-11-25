<template>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Criar Empresa</a>
    
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
      empresaData: {},
       mensagensErro: [],
    };
  },
  computed: {
    codigo() {return this.empresaData ? this.empresaData.codigo : "";     },

    empresa() {return this.empresaData ? this.empresaData.empresa : "";     },
    sigla() {return this.empresaData ? this.empresaData.sigla : null;   },
    razao_social() {return this.empresaData ? this.empresaData.razao_social : null;    },
  },
 /* async mounted() {
    // Carregar os dados da empresa da API antes de renderizar o componente
    //await this.fetchEmpresaData();
  },*/
  methods: {
    
    atualizarForm(campo, valor) {
      // Atualize os dados do formulário quando o evento for recebido
      console.log(valor.target.value)
      this.empresaData[campo] = valor.target.value;
    },
    async salvar() {
      try {
        // Os dados já estão vinculados às propriedades do componente
       const dados =  await empresaService.create(this.empresaData);
        console.log(dados)
        console.log(dados.status)
        console.log('Empresa atualizada com sucesso!');
        if(dados.status==201){
            this.$router.push('/empresas');
        }
      } catch (error) {
        this.mensagensErro = error.response.data.errors || error.response.data || {'error':['Erro desconhecido. Tente novamente.']};
        console.error('Erro ao salvar empresas:', error.response.data.errors,error.response);
      }
    },
  },
};
</script>
