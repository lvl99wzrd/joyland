/* global appSettings */
import axios from 'axios'

const instance = axios.create({
  baseURL: appSettings.rest.base,
  timeout: 30000,
});

export default instance;
