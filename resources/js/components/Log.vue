<template>
    <div>
        <h4>{{ title }}</h4>
        <ol>
            <li v-for="item in items" v-text="item"></li>
        </ol>
    </div>
</template>
<script>
  export default {
    props: {
      title: String,
      items: Array,
    },
    data: function() {
      return {};
    },
  };
</script>
<style scoped>
    li {
        white-space: pre;
    }

    li:first-line {
        font-weight: bold;
    }
</style>
