<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">TST</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <router-link
                        v-for="link in links"
                        :to="link.to"
                        :key="link.label"
                        tag="li"
                        class="nav-item">
                    <a class="nav-link">{{link.label}}</a>
                </router-link>
            </ul>
        </div>
    </nav>
</template>
<script>
  export default {
    props: ['links'],
    data: function() {
      return {}
    }
  }
</script>
