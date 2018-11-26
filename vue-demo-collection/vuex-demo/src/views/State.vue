<template>
  <div class="root">
    <Counter></Counter>
    <p>
      <button @click="increment">+</button>
      <button @click="decrement">-</button>
    </p>
  </div>
</template>

<script>
import { mapState } from 'vuex';
import Counter from '@/components/Counter.vue';

export default {
  name: 'state',
  components: {
    Counter,
  },
  // computed1: {
  //   count() {
  //     return this.$store.state.count;
  //   },
  // },
  computed: mapState({
    count: state => state.count,
    countAlias: 'count',
    countPlusLocalState(state) {
      return state.count + this.localCount;
    },
  }),
  methods: {
    increment() {
      // this.$store.commit('counter/increment');
      this.$store.dispatch('counter/increment');
    },
    decrement() {
      this.$store.commit('counter/decrement');
    },
  },
};
</script>
