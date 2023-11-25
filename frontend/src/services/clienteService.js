import axios from 'axios';

const BASE_URL = 'http://127.0.0.1:8000/api/empresas';

export default {
  getByEmpresa(codigoEmpresa) {
    return axios.get(`${BASE_URL}/${codigoEmpresa}/clientes`);
  },
  get(codigoEmpresa,codigo) {
    return axios.get(`${BASE_URL}/${codigoEmpresa}/clientes/${codigo}`);
  },
  create(codigoEmpresa,data) {
    console.log("data",data)
    return axios.post(`${BASE_URL}/${codigoEmpresa}/clientes`, data);
  },
  update(codigoEmpresa, codigo, data) {
    console.error(data)
    return axios.put(`${BASE_URL}/${codigoEmpresa}/clientes/${codigo}`, data);
  },
  delete(codigoEmpresa, codigo) {
    return axios.delete(`${BASE_URL}/${codigoEmpresa}/clientes/${codigo}`);
  },
};
