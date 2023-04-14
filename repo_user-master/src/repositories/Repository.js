import axios from 'axios'

const baseUrl = `http://jsonplaceholder.typicode.com/`;
const Repository = axios.create({
    baseURL: baseUrl
});

export default Repository;