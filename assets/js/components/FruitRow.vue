<template>
  <tr>
    <td>{{ fruit.id }}</td>
    <td>{{ fruit.name }}</td>
    <td>{{ fruit.fruit_id }}</td>
    <td>{{ fruit.genus }}</td>
    <td>{{ fruit.family }}</td>
    <td>{{ fruit.fruit_order }}</td>
    <td>{{ fruit.nutrition_total }}</td>
    <td v-if="fruit.is_favorite">
      <button class="btn btn-sm" @click="removeFromFavorite()">
        <font-awesome-icon :icon="['fass', 'heart']" style="color: red" />
      </button>
    </td>
    <td v-else-if="!fruit.is_favorite">
      <button class="btn btn-sm" @click="addToFavorite()">
        <font-awesome-icon icon="fa-regular fa-heart" style="color: red"/>
      </button>
    </td>
  </tr>
</template>

<script>
import {addFavorite, removeFavorite} from "../services/favorite-service";

  export default {
    name: 'fruit-row',
    props: {
      fruit: {
        type: Object,
        required: true,
      },
    },
    data() {
      return {
        fruitId: '',
      };
    },
    methods: {
      addToFavorite() {
        addFavorite(this.fruit.id);
      },
      removeFromFavorite() {
        removeFavorite(this.fruit.id);
      }
    }
  };
</script>