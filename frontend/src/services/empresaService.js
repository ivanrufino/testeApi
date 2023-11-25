import axios from 'axios';

const BASE_URL = 'http://127.0.0.1:8000/api/empresas';

export default {
  getAll() {
    return axios.get(BASE_URL);
  },
  get(codigo) {
    return axios.get(`${BASE_URL}/${codigo}`);
  },
  create(data) {
    return axios.post(BASE_URL, data);
  },
  update(codigo, data) {
    return axios.put(`${BASE_URL}/${codigo}`, data);
  },
  editar(codigo) {
    return axios.get(`${BASE_URL}/${codigo}`);
  },
  delete(codigo) {
    return axios.delete(`${BASE_URL}/${codigo}`);
  },
};
