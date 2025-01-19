import axios from 'axios'

const API_ENDPOINT = 'article'

export default {

    all(data = {}) {
        return axios.get(API_ENDPOINT, { params: data })
    },

    newest(data = {}) {
        return axios.get(API_ENDPOINT + '/newest', { params: data })
    },

    find(id) {
        return axios.get(API_ENDPOINT + '/' + id)
    },

    create(model) {
        return axios.post(API_ENDPOINT, model)
    },

    update(model) {
        return axios.put(API_ENDPOINT + '/' + model.id, model)
    },

    delete(id) {
        return axios.delete(API_ENDPOINT + '/' + id)
    },

    like(id) {
        return axios.post(API_ENDPOINT + '/' + id + '/like')
    },

    createComment(data = {}) {
        return axios.post(API_ENDPOINT + '/' + data.article_id + '/comment', data)
    }
}
