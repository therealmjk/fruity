<template>
  <div class="row">
    <div class="col-xs-12 ">
      <table class="table table-hover">
        <thead class="thead-dark">
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Fruit ID</th>
          <th>Genus</th>
          <th>Family</th>
          <th>Order</th>
          <th>Nutrition Total</th>
          <th>Favorite</th>
        </tr>
        </thead>
        <tbody>
        <FruitRow v-for="fruit in fruits" :key="fruit.id" :fruit="fruit" />
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import FruitRow from "./FruitRow";

  export default {
    name: 'fruit-list',
    components: {FruitRow},
    props: {
      fruits: {
        type: Object,
        required: true,
      },
    },
  };
</script>