<template>
  <div class="container-fluid">
    <div class="row">

      <div class="col-xs-12 text-center">
        <div class="row">
          <div class="col-xs-12">
            <h4>Favorites</h4>
          </div>
        </div>

        <div class="row">
          <div class="col-xs-12 ">
            <table class="table table-hover">
              <thead class="thead-dark">
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Fruit ID</th>
                <th>Genus</th>
                <th>Family</th>
                <th>Order</th>
                <th>Nutrition Total</th>
              </tr>
              </thead>
              <tbody>
              <tr v-for="(fruit, key) in fruits" :key="fruit.id">
                <td>{{ key + 1 }}</td>
                <td>{{ fruit.name }}</td>
                <td>{{ fruit.fruit_id }}</td>
                <td>{{ fruit.genus }}</td>
                <td>{{ fruit.family }}</td>
                <td>{{ fruit.fruit_order }}</td>
                <td>{{ fruit.nutrition_total }}</td>
              </tr>
              </tbody>
            </table>
          </div>
        </div>

      </div>
    </div>
  </div>
</template>

<script>
  import axios from "axios";

  export default {
    name: 'favorite',
    data() {
      return {
        fruits: {},
      };
    },
    async created() {
      const response = await axios.get('/favorites/list', {});
      this.fruits = response.data
    },
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