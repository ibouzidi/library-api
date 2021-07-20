<template>
  <button class="btn btn-primary" @click="removeBook">Remove</button>
</template>

<script>
import axios from "axios";

export default {
  name: "RemoveBookButton",

  props: ["bookToRemove"],

  data() {
    return {
      book: this.bookToRemove,
    };
  },

  methods: {
    removeBook() {
      axios
        .delete("/api/books/" + this.book.id)
        .then((response) => console.log(response))
        .catch((error) => console.log(error));
      window.location.replace("/books");
    },
  },
};
</script>