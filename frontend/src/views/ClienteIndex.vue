<template>
  <div>
    
    <ClienteList :codigoEmpresa="codigoEmpresa" />
  </div>
</template>

<script>
import ClienteList from '@/components/ClienteList.vue';

export default {
  components: {
    ClienteList,
  },
  computed: {
    codigoEmpresa() {
      // Lógica para obter o código da empresa da rota (this.$route.params.codigoEmpresa)
      return this.$route.params.codigoEmpresa;
    }
  }
};
</script>
