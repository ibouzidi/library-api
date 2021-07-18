<template>
  <div>
    <h1>Add Book</h1>
    <div v-if="saved" class="alert alert-success" role="alert">
      Book saved
    </div>
    <div class="form-group">
      <label for="title">
        Title
      </label>
      <input type="text" class="form-control" id="title" v-model="title" @input="saved = false"/>
    </div>
    <div class="form-group">
      <label for="author">
        Description
      </label>
      <input type="text" class="form-control" id="author" v-model="author" @input="saved = false"/>
    </div>
    <button class="btn btn-primary" @click="submit">
      Submit
    </button>
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