<template>
  <div class="row">
    <div class="col-md-8 text-center" style="text-align: center">
      <input
          v-model="keyword"
          class="form-control"
          placeholder="Filter by name or family"
          type="search"
          @input="onFilterInput"
      >
    </div>
  </div>
</template>

<script>
export default {
  name: 'fruit-filter',
  data() {
    return {
      keyword: '',
      filterTimeout: null,
    };
  },
  methods: {
    onFilterInput(){
      if(this.filterTimeout) {
        clearTimeout(this.filterTimeout);
      }

      this.filterTimeout = setTimeout(() => {
        this.$emit('filter-fruit', { term: this.keyword });

        this.filterTimeout = null;
      }, 200)
    }
  }
};
</script>