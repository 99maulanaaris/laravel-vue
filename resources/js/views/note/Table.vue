<template>
  
    <div class="container">

        <table class="table">

            <thead>
                <tr>
                    <th>Title</th>
                    <th>Subject</th>
                    <th>Published</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="note in notes" :key="note.id">
                    <td> <router-link :to="{name:'notes.show', params:{noteSlug: note.slug} }">{{note.title}}</router-link> </td>
                    <td>{{note.subject}}</td>
                    <td>{{note.published}}</td>
                    <td><router-link :to="{name:'notes.edit', params:{noteSlug: note.slug}}">Edit</router-link></td>
                    <td>
                        <delete-note :endpoint='note.slug' />
                    </td>
                </tr>
                
            </tbody>

        </table>

    </div>
  
</template>

<script>

import DeleteNote from "./Delete";

export default {

    components: {
        
        DeleteNote
    },

    data () {

        return {

            notes: [],

            
        }
    },


    mounted() {
        
        this.getNotes();
    },

    methods : {

        async getNotes()
        {
            let {data} = await axios.get('/api/notes');

            this.notes = data.data
        }
    }

}
</script>
