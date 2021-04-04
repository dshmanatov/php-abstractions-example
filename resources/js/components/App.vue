<template>
    <div class="container">
        <nav-bar :links="navLinks"></nav-bar>
        <router-view></router-view>
    </div>
</template>
<script>
  import NavBar from './NavBar';

  export default {
    computed: {},
    data() {
      return {
        title: '',
        navLinks: [{
          to: '/',
          label: 'Обзор',
        }, {
          to: '/resources',
          label: 'Ресурсы/склад',
        }, {
          to: '/workshops',
          label: 'Фабрики',
        }, {
          to: '/recipes',
          label: 'Рецепты',
        }],
      }
    },
    created() {
      this.updateTitle();
    },
    methods: {
      updateTitle() {
        this.title = this.$route.meta.title || '';
      },
    },
    components: {
      NavBar,
    },
    watch: {
      title: function(newTitle) {
        $('title').text('Manufacturing App' + (newTitle ? ` - ${newTitle}` : ''));
      },
      '$route': 'updateTitle',
    },
  };
</script>
