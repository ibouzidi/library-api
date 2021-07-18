<template>
  <div class="col-sm-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">{{ title }}</h5>
        <p class="card-text">{{ author }}</p>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: "BookDetails",
  props: ["title", "author"]
}
</script>