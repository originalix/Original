<template>
  <div>
    {{ count }}
  </div>
</template>

<script>
export default {
  name: 'Counter',
  computed: {
    count() {
      return this.$store.state.counter.count;
    },
  },
};
</script>
