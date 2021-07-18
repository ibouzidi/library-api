<template>
  <div>
    <h1>Ajouter un livre</h1>
    <div v-if="saved" class="alert alert-success" role="alert">
      Book saved
    </div>
        <div class="col-md-6">
    <div class="form-group">
      <label for="title">
        Titre du livre
      </label>
      <input type="text" class="form-control" id="title" v-model="title" @input="saved = false"/>
    </div>
    <div class="form-group">
      <label for="author">
        Auteur du livre
      </label>
      <input type="text" class="form-control" id="author" v-model="author" @input="saved = false"/>
    </div>
    <button class="btn btn-primary" @click="submit">
      Submit
    </button>
  </div>
  </div>
</template>
<script>
import axios from "axios"
export default {
  name: "AddBook",
  data() {
    return {
      title: null,
      author: null,
      saved: false
    }
  },
  methods: {
    submit() {
      this.saved = false
      if (this.title && this.author) {
        axios
            .post('api/books', {
              title: this.title,
              author: this.author
            })
            .then(() => {
              this.saved = true
              this.title = null
              this.author = null
            })
      }
    }
  }
}
</script>