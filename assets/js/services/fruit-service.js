import axios from 'axios'

/**
 *
 * @param {string|null} keyword
 * @returns {Promise}
 */
export function fetchFruits(keyword){
    const params = {};

    if(keyword) {
        params.keyword = keyword;
    }

    return axios.get('/fruits', {
        params,
    });
}