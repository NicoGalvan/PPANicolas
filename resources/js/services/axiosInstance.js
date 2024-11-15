import axios from 'axios';

const axiosInstance = axios.create({
  baseURL: 'http://ppanicolas.test/api/',
  timeout: 5000,
  headers: { 'Content-Type': 'application/json' },
});

axiosInstance.interceptors.response.use(
  response => response,
  error => {
    console.error('Error en la petición:', error);
    return Promise.reject(error);
  }
);

export default axiosInstance;
