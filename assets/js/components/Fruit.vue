<template>
  <div class="container-fluid">
    <div class="row">

      <div class="col-xs-12 text-center">
        <div class="row">
          <div class="col-xs-12">
            <h4>Fruits</h4>
          </div>
        </div>

        <FilterFruit @filter-fruit="onFilterFruits"/>

        <FruitList :fruits="fruits"/>

      </div>
    </div>
  </div>
</template>

<script>
  import FruitList from "./FruitList";
  import FilterFruit from "./FilterFruit";
  import {fetchFruits} from "../services/fruit-service";

  export default {
    name: 'home',
    components: {
      FruitList,
      FilterFruit,
    },
    data() {
      return {
        fruits: {},
      };
    },
    created () {
      this.loadFruits(null);
    },
    methods: {
      /**
       * Get term from event so replaces event.term
       * @param {string} term
       */
      onFilterFruits({ term }) {
        this.loadFruits(term)
      },

      async loadFruits(keyword) {
        const response = await fetchFruits(keyword)
        this.fruits = response.data
      }
    }
  };

</script>

<style lang="scss">
  @import '../../styles/light-component';

  .sidebar {
    @include light-component;

    ul {
      li a:hover {
        background: $blue-component-link-hover;
      }
    }
  }

</style>