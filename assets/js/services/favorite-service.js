import axios from 'axios'
import {useToast} from "vue-toast-notification";
import 'vue-toast-notification/dist/theme-sugar.css';

/**
 *
 * @param {string} fruitId
 * @returns {Promise}
 */
export async function addFavorite(fruitId){
    let result = null;

    try {
        result = await axios.post('/favorites', {
            'fruitId': fruitId,
        }).then(() => {
            location.reload()
        });

    }catch (err){
        const $toast = useToast();
        $toast.error('Error adding favorite!', {duration: 1000});
    }

    return result;
}

/**
 *
 * @param {string} fruitId
 * @returns {Promise}
 */
export async function removeFavorite(fruitId){
    let result = null;
    const params = {'fruitId': fruitId};

    try {
        result = await axios.delete('/favorites', {
            params
        }).then(() => {
            location.reload()
        });

    }catch (err){
        const $toast = useToast();
        $toast.error('Error removing favorite!', {duration: 1000});
    }

    return result
}