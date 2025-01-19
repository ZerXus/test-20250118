import Tag from './pages/tag/Index.vue';

export const routes = [
    {
        path: 'dictionary',
        name: 'dictionary',
        meta: {
            auth: true,
        },
        children: [
            {
                path: 'tag',
                name: 'tag',
                component: Tag,
                meta: {
                    auth: true,
                    icon: 'pi pi-tag'
                },
            }
        ]
    }
]
