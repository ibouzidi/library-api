<template>
  <div>
    <h1>Liste des livres</h1>
    <div class="row">
      <BookDetails
          v-for="book in books"
          :title="book.title"
          :author="book.author"
          :entire-book="book"
          :key="book.id"
          />
    </div>
  </div>
</template>

<script>
import BookDetails from "../components/BookDetails"
import axios from "axios"
export default {
  name: "BookList",
  components: {BookDetails},
  data() {
    return {
      books: []
    }
  },
  created: function () {
    axios
    .get('/api/books')
    .then(response => (this.books = response.data))
  }
}
</script>