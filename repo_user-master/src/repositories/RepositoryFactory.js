import ProductsRepository from './product/Index'
import PostsRepository from './post/Index'

const repositories = {
    products: ProductsRepository,
    posts: PostsRepository
}

export const RepositoryFactory = {
    get: name => repositories[name]
}