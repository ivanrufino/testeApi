<template>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Cadastrar Cliente</a>
      
    </div>
  </nav>
  <div class="container mt-2">
    
    <clienteForm 
        :codigo="codigo" 
        :razao_social="razao_social"
        :tipo="tipo"
        :cpf_cnpj="cpf_cnpj"
        

        @atualizar-codigo="atualizarForm('codigo', $event)"
        @atualizar-razao_social="atualizarForm('razao_social', $event)"
        @atualizar-tipo="atualizarForm('tipo', $event)"
        @atualizar-cpf_cnpj="atualizarForm('cpf_cnpj', $event)"

        @salvar="salvar"
        :mensagensErro="mensagensErro"
        
    />
    
    
    
    
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
      clienteData: {},
       mensagensErro: [],
    };
  },
  computed: {
    // codigoEmpresa() {return this.$route.params.codigoEmpresa;    },
    codigo() {return this.clienteData ? this.clienteData.codigo : "";     },
    razao_social() {return this.clienteData ? this.clienteData.razao_social : null;    },

    tipo() {return this.clienteData ? this.clienteData.tipo : "";     },
    cpf_cnpj() {return this.clienteData ? this.clienteData.cpf_cnpj : null;   },
  },
  
  methods: {
    
    atualizarForm(campo, valor) {
      // Atualize os dados do formulário quando o evento for recebido
      
      const newval = campo =="tipo" ?valor : valor.target.value;
      this.clienteData[campo] = newval;
    },
    async salvar() {
      try {
        // Os dados já estão vinculados às propriedades do componente
        const codigoEmpresa = this.$route.params.codigoEmpresa;
       const dados =  await clienteService.create(codigoEmpresa,this.clienteData);
        console.log(dados)
        console.log(dados.status)
        console.log('Empresa atualizada com sucesso!');
        if(dados.status==201){
            
            this.$router.push({
            name: 'verClientes', 
            params: {
              codigoEmpresa: this.$route.params.codigoEmpresa,
              
            }
          });
        }
      } catch (error) {
        this.mensagensErro = error.response.data.errors || {'Error':['Erro desconhecido. Tente novamente.']};
        console.error('Erro ao salvar Cliente:', error.response.data.errors);
      }
    },
  },
};
</script>
