import Home from '../views/Home'
import About from '../views/About'
import Contact from '../views/Contact'
import NewNote from '../views/note/Create'
import TableOfNote from '../views/note/Table'
import ShowNote from '../views/note/Show'
import EditNote from '../views/note/Edit'



export default {

    mode: 'history',
    linkActiveClass: 'active',



    routes: [

        {
            path: '/',
            name: 'home',
            component: Home
        },

        {
            path: '/about',
            name: 'page.about',
            component: About
        },

        {
            path: '/contact',
            name: 'page.contact',
            component: Contact
        },

        {
            path: '/notes/create',
            name: 'notes.create',
            component: NewNote
        },
        {
            path: '/notes/table',
            name: 'notes.table',
            component: TableOfNote
        },

        {
            path: '/notes/:noteSlug',
            name: 'notes.show',
            component: ShowNote
        },

        {
            path: '/notes/:noteSlug/edit',
            name: 'notes.edit',
            component: EditNote
        },


    ]


}
