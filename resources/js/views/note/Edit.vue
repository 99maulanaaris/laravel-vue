<template>
  
<div class="container">

    <div class="row">
        <div class="col-md-6">



            <div class="card">
                <div class="card-header">New Note</div>
                <div class="card-body">

                    <form action="#" method="post" @submit.prevent="update">

                        <div class="form-group">

                            <label for="title">Title</label>
                            <input type="text" v-model="form.title" id="title" class="form-control">
                            <div v-if="theErrors.title"  class="mt-2 text-danger">{{ theErrors.title[0] }}</div>
                        </div>

                        <div class="form-group">
                        
                            <label for="subject">Subject</label>
                            <select @change="selectedSubject" id="subject" class="form-control" >
                                <option :value="form.subjectId" v-text="form.subject"></option>
                                <template v-for="subject in subjects">
                                    <option v-if="form.subjectId !== subject.id" :key="subject.id" :value="subject.id">

                                        {{ subject.name }}

                                    </option>
                                </template>
                            </select>
                            <div v-if="theErrors.subject"  class="mt-2 text-danger">{{ theErrors.subject[0] }}</div>

                        </div>

                        <div class="form-group">

                            <label for="description">Description</label>
                            <textarea v-model="form.description" id="description" rows="5" class="form-control"></textarea>
                            <div v-if="theErrors.description"  class="mt-2 text-danger">{{ theErrors.description[0] }}</div>

                        </div>

                        <button type="submit" class="btn btn-primary d-flex align-items-center">Update
                            <template v-if="loading">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; background: none; display: block; shape-rendering: auto;" width="20px" height="20px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid"><g><path d="M50 15A35 35 0 1 0 74.74873734152916 25.251262658470843" fill="none" stroke="#92d8e6" stroke-width="12"></path><path d="M49 3L49 27L61 15L49 3" fill="#92d8e6"></path><animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" values="0 50 50;360 50 50" keyTimes="0;1"></animateTransform></g></svg>
                            </template>
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>

</div>


</template>

<script>

export default {

    data() {
        
        return {

            form : [],

            subjects: [],
            
            theErrors: [],

            selected: '',

            loading: false,
        };
    },

    mounted() {

        this.getSubjects();
        this.getNote();
    },

    methods: {

        async getSubjects() {

            let response = await axios.get('/api/subjects')

            if(response.status === 200){
                
                this.subjects = response.data
            }
        },

        async getNote()
        {   
            let response = await axios.get(`/api/notes/${this.$route.params.noteSlug}`);

            this.form = response.data.data

            
        },

        selectedSubject(e)
        {
            this.selected = e.target.value
        },

        async update()
        {
            this.loading = true

            this.form['subject'] = this.selected || this.form.subjectId

            let response = await axios.patch(`/api/notes/${this.$route.params.noteSlug}/edit`,this.form);

            if(response.status == 200)
            {
               this.$toasted.show(response.data.message,{
                   type: 'success',
                   duration: '3000',
               })

               this.$router.push('/notes/table')
            }


        }

    }

};
</script>
