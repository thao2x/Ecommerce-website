import axios from "axios";

const BASE_URL = "http://192.168.1.5:8000/api";
const CUSTOMER_URL = "/customer";
const CATEGORIES_URL = "/category";
const PROMO_URL = "/promos";
const POPULAR_URL = "/popular";
const SEARCH_URL = "/search";
const SEARCH_PRODUCT_BY_CATEGORY_URL = "/category/";
const SEARCH_POPULAR_BY_ID_URL = "/popular/";
const PRODUCT_BY_ID_URL = "/product/";
const LOGIN_URL = "/login";
const CART_URL = "/cart";
const CART_UPDATE_URL = "/cart/";
const ADDRESS_URL = "/address";
const SHIPPING_URL = "/shippings";
const REGISTER_URL = "/register";
const CREATE_ORDER = "/order";

let instance = axios.create({
    baseURL: BASE_URL,
    headers: {
        "Accept": "application/json"
    },
});

// Trả về thông tin header token nếu user đã login
const authHeader = () => {
    let user = JSON.parse(localStorage.getItem('user'));

    if (user && user.token) {
        return {
            'Authorization': 'Bearer ' + user.token,
            "Accept": "application/json"
        };
    } else {
        return {};
    }
}

// Guest
export const login = (data) => {
    return instance.post(LOGIN_URL, data);
};

export const register = (data) => {
    return instance.post(REGISTER_URL, data);
};

export const getCategories = () => {
    return instance.get(CATEGORIES_URL);
};

export const getPromos = () => {
    return instance.get(PROMO_URL);
};

export const getShippings = () => {
    return instance.get(SHIPPING_URL);
};

export const getPopulars = () => {
    return instance.get(POPULAR_URL);
};

export const getPopularById = (popularId) => {
    return instance.get(SEARCH_POPULAR_BY_ID_URL + popularId);
};

export const getProductById = (productId) => {
    return instance.get(PRODUCT_BY_ID_URL + productId);
};

export const searchProduct = (query) => {
    return instance.get(SEARCH_URL, { params: { query: query } });
};

export const searchProductByCategoryId = (categoryId) => {
    return instance.get(SEARCH_PRODUCT_BY_CATEGORY_URL + categoryId);
};


// Auth
export const getCart = () => {
    return instance.get(CART_URL, {
        headers: authHeader()
    });
};

export const addProductToCart = (data) => {
    return instance.post(CART_URL, data, {
        headers: authHeader()
    });
};

export const updateQuantity = (itemId, data) => {
    return instance.post(CART_UPDATE_URL + itemId, data, {
        headers: authHeader()
    });
};

export const deleteItemCart = (itemId) => {
    return instance.delete(CART_UPDATE_URL + itemId, {
        headers: authHeader()
    });
};

export const getUser = () => {
    return instance.get(CUSTOMER_URL, {
        headers: authHeader()
    });
};

export const updateUser = (data) => {
    return instance.post(CUSTOMER_URL, data, {
        headers: authHeader()
    });
};

export const getAddress = () => {
    return instance.get(ADDRESS_URL, {
        headers: authHeader()
    });
};

export const addAddress = (data) => {
    return instance.post(ADDRESS_URL, data, {
        headers: authHeader()
    });
};

export const addOrder = (data) => {
    return instance.post(CREATE_ORDER, data, {
        headers: authHeader()
    });
};