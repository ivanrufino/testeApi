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
      return this.$route.params.codigoEmpresa;
    }
  }
};
</script>
