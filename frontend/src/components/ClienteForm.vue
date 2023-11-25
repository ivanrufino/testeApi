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
        <input :value="codigo" :readonly="modoVisualizacao" @input="atualizarCampo('codigo', $event)" class="form-control"
          id="codigo" />
      </div>

      <!-- Razão Social -->
      <div class="mb-3 col-md-6">
        <label for="razao_social" class="form-label">Razão Social:</label>
        <input :value="razao_social" :readonly="modoVisualizacao" @input="atualizarCampo('razao_social', $event)"
          class="form-control" id="razao_social" />
      </div>
    </div>
    <div class="row">
      <!-- tipo -->
      <!-- <div class="mb-3 col-md-2">
        <label for="empresa" class="form-label">Tipo:</label>
        <input :value="tipo" :readonly="modoVisualizacao" @input="atualizarCampo('tipo', $event)" class="form-control" id="tipo" />
      </div> -->

      <div class="mb-3 row">
        <label for="tipo" class="form-label">Tipo:</label>
        <div class="form-check col-md-3">
          <input type="radio" id="tipoPJ" name="tipo" :checked="tipo === 'PJ'" :disabled="modoVisualizacao"
            @change="atualizarCampo('tipo', 'PJ')">
          <label class="form-check-label" for="tipoPJ">Pessao Juridica</label>
        </div>
        <div class="form-check col-md-3">
          <input type="radio" id="tipoPF" name="tipo" :checked="tipo === 'PF'" :disabled="modoVisualizacao"
            @change="atualizarCampo('tipo', 'PF')">
          <label class="form-check-label" for="tipoPF">Pessoa Fisica</label>
        </div>
      </div>

      <!-- cpf_cnpj -->
      <div class="mb-3 col-md-6">
        <label for="cpf_cnpj" class="form-label">CPF/CNPJ:</label>
        <input :value="cpf_cnpj" :readonly="modoVisualizacao" @input="atualizarCampo('cpf_cnpj', $event)"
          class="form-control" id="cpf_cnpj" maxlength=14 />
      </div>
    </div>




    <div class="row">
      <div class="col-md-2">
        <button @click="voltar" class="btn btn-info">Voltar</button>
      </div>
      <div class="col-md-2" v-if="!modoVisualizacao">
        <button @click="salvar" class="btn btn-primary">Salvar</button>
      </div>
    </div>

  </div>
</template>

<script>

export default {
  props: {
    codigo: {
      type: String,
      required: true,
    },
    razao_social: {
      type: String,
      default: '',
    },
    tipo: {
      type: String,
      default: '',
    },
    cpf_cnpj: {
      type: String,
      default: '',
    },
    modoVisualizacao: {
      type: Boolean,
      default: false,
    },
    mensagensErro: {
      type: Object,
      default: () => { },
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
    voltar() {
      this.$router.push({
        name: 'verClientes',
        params: {
          codigoEmpresa: this.$route.params.codigoEmpresa,

        }
      });


    },
    salvar() {
      // Lógica para salvar a Cliente
      this.$emit('salvar');
    },

  },
};
</script>
