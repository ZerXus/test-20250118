import ArticleMain from './pages/ArticleMain.vue'
import ArticleCatalog from './pages/ArticleCatalog.vue'
import ArticleDetails from './pages/ArticleDetails.vue'

export const routes = [
    {
        path: '',
        name: 'article',
        meta: {
            auth: true,
        },
        children: [
            {
                component: ArticleMain,
                path: '',
                name: 'newest',
                hidden: true,
            },
            {
                path: 'articles',
                name: 'articles',
                component: ArticleCatalog,
                meta: {
                    icon: 'pi pi-book'
                },
                children: []
            },
            {
                path: 'article/:id',
                name: 'article-details',
                component: ArticleDetails,
                children: [],
                hidden: true,
            },
        ]
    },
]
