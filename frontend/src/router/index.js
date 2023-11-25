// src/router/index.js

import { createRouter, createWebHistory } from 'vue-router';
import EmpresaIndex from '@/views/EmpresaIndex.vue';
import EmpresaCreate from '@/views/EmpresaCreate.vue';
import EmpresaEdit from '@/views/EmpresaEdit.vue';
import EmpresaView from '@/views/EmpresaView.vue';

import ClienteIndex from '@/views/ClienteIndex.vue';
import ClienteCreate from '@/views/ClienteCreate.vue';
import ClienteView from '@/views/ClienteView.vue';
import ClienteEdit from '@/views/ClienteEdit.vue';

const routes = [
  { path: '/', redirect: '/empresas' },
  { path: '/empresas', name: 'listaEmpresas', component: EmpresaIndex },
  { path: '/empresas/:codigo/editar', name: 'editarEmpresa', component: EmpresaEdit },
  { path: '/empresas/:codigo/visualizar', name: 'visualizarEmpresa', component: EmpresaView },
  { path: '/empresas/create', name: 'CriarEmpresa', component: EmpresaCreate },

  { path: '/empresas/:codigoEmpresa/clientes', name: 'verClientes', component: ClienteIndex },
  { path: '/empresas/:codigoEmpresa/clientes/create', name: 'cadastrarCliente', component: ClienteCreate },

  { path: '/empresas/:codigoEmpresa/clientes/:codigo/visualizar', name: 'visualizarCliente', component: ClienteView },
  { path: '/empresas/:codigoEmpresa/clientes/:codigo/editar', name: 'editarCliente', component: ClienteEdit },
 
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
