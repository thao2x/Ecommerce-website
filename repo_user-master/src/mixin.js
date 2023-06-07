import VueRouter from 'vue-router';
const { isNavigationFailure, NavigationFailureType } = VueRouter;

export const mixin = {
    methods: {
        goToPageById(name, id) {
            this.$router.push({ name: name, params: { id: id } }).catch((error) => {
                if (!isNavigationFailure(error, NavigationFailureType.redirected)) {
                    Promise.reject(error)
                }
            });
        },

        goToPage: function (name) {
            this.$router.push({ name: name }).catch((error) => {
                if (!isNavigationFailure(error, NavigationFailureType.redirected)) {
                    Promise.reject(error)
                }
            });
        },

        getCurrentImage: function (url) {
            return "http://localhost:8080/storage" + url;
        }
    }
}
