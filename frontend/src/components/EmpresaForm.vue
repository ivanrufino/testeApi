<template>
  <div>
  
    <div v-if="hasErrors" class="alert alert-danger">
    <b>Erros encontrados</b>
     <ul>
      <li v-for="(erros, campo) in mensagensErroLocal" :key="campo">
        <b>{{ campo }}:</b>
        <ul>
          <li v-for="erro in erros" :key="erro">{{ erro }}</li>
        </ul>
      </li>
    </ul>
    </div>
    <div class="row">
      <!-- Código -->
      <div class="mb-3 col-md-2">
        <label for="codigo" class="form-label">Código:</label>
        <input :value="codigo" :readonly="modoVisualizacao" @input="atualizarCampo('codigo', $event)" class="form-control" id="codigo" />
      </div>

      <!-- Empresa -->
      <div class="mb-3 col-md-5">
        <label for="empresa" class="form-label">Empresa:</label>
        <input :value="empresa" :readonly="modoVisualizacao" @input="atualizarCampo('empresa', $event)" class="form-control" id="empresa" />
      </div>
    </div>
     <div class="row">
      <!-- Sigla -->
      <div class="mb-3 col-md-2">
        <label for="sigla" class="form-label">Sigla:</label>
        <input :value="sigla" :readonly="modoVisualizacao" @input="atualizarCampo('sigla', $event)" class="form-control" id="sigla" />
      </div>

      <!-- Razão Social -->
      <div class="mb-3 col-md-5">
        <label for="razao_social" class="form-label">Razão Social:</label>
        <input :value="razao_social" :readonly="modoVisualizacao" @input="atualizarCampo('razao_social', $event)" class="form-control" id="razao_social" />
      </div>
    </div>

    

  <div v-if="modoVisualizacao" >
    <button @click="voltar" class="btn btn-primary">Voltar</button>
</div>   
 <div v-if="!modoVisualizacao" >
    <button @click="salvar" class="btn btn-primary">Salvar</button>
</div>

  </div>

</template>

<script>
/*import empresaService from '@/services/empresaService';*/
export default {
  props: {
    codigo: {
      type: String,
      required: true,
    },
    empresa: {
      type: String,
      default: '',
    },
    sigla: {
      type: String,
      default: '',
    },
    razao_social: {
      type: String,
      default: '',
    },
    modoVisualizacao: {
      type: Boolean,
      default: false,
    },
     mensagensErro: {
      type: Object,
      default: () => {},
    },
    
  },
   computed: {
    hasErrors() {
      return (
        this.mensagensErroLocal &&
        Object.keys(this.mensagensErroLocal).length > 0
      );
    },
  },
data() {
    console.log(this.mensagensErro)
    return {
      mensagensErroLocal: this.mensagensErro,
    };
  },
  watch: {
    mensagensErro(newVal) {
      this.mensagensErroLocal = newVal;
    },
  },
  methods: {
    atualizarCampo(campo, valor) {
        
       this.$emit(`atualizar-${campo}`, valor);
    },
    voltar(){
        this.$router.push('/empresas');
    },
   salvar() {
      // Lógica para salvar a empresa
      this.$emit('salvar');
    },
   /* async salvar() {
      try {
        const empresaData = {
          empresa: this.empresa,
          sigla: this.sigla,
          razao_social: this.razao_social,
          // Adicione outros campos conforme necessário
        };

        await empresaService.update(this.codigo, empresaData);

        console.log('Empresa atualizada com sucesso!');
      } catch (error) {
        console.error('Erro ao salvar empresa:', error);
      }
    },*/
  },
};
</script>
