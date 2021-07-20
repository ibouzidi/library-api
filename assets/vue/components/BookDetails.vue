<template>
  <div class="col-sm-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">{{ title }}</h5>
        <p class="card-text">{{ author }}</p>
        <RemoveBookButton :book-to-remove="this.book"/>
      </div>
    </div>
  </div>
</template>
<script>
import RemoveBookButton from "./RemoveBookButton";

export default {
  name: "BookDetails",
  props: ["title", "author", "entireBook"],

  data() {
    return {
      book: this.entireBook,
    };
  },

  components: {
    RemoveBookButton,
  },

  mounted: function () {},
};
</script>