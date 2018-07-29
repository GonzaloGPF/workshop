import axios from '../axios';

export default {
    /**
     * Basic GET request
     *
     * @param {string} url
     * @param {AxiosRequestConfig|null|{}} config
     * @returns {AxiosPromise}
     */
    get(url, config = null) {
        return axios.get(url, config);
    },

    /**
     * Basic PUT request
     *
     * @param {string} url
     * @param data
     * @param {AxiosRequestConfig|null|{}} config
     * @returns {Promise}
     */
    put(url, data, config = null) {
        return axios.put(url, data, config);
    },

    /**
     * Basic POST request
     *
     * @param {string} url
     * @param data
     * @param {AxiosRequestConfig|null|{}} config
     * @returns {Promise}
     */
    post(url, data, config = null) {
        return axios.post(url, data, config);
    },

    /**
     * Basic DELETE request
     *
     * @param {string} url
     * @param {AxiosRequestConfig|null|{}} config
     * @returns {Promise}
     */
    delete(url, config = null) {
        return axios.delete(url, config);
    }
}