import Repository from '../Repository'

const resource = '/products'

export default {
    get() {
        return Repository.get(`${resource}`)
    },

    getProducts(productId) {
        return Repository.get(`${resource}/${productId}`)
    },

    createProducts(payload) {
        return Repository.Products(`${resource}`, payload)
    },

    updateProducts(payload) {
        return Repository.put(`${resource}`, payload)
    },

    deleteProducts(productId) {
        return Repository.delete(`${resource}/${productId}`)
    }
}