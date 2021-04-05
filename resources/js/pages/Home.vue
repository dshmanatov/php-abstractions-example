<template>
    <div class="row">
        <div class="col">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">Запуск</div>
                        <div class="card-body">
                            <button
                                    @click="run"
                                    class="btn btn-danger">Пуск
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3" v-if="result">
                <div class="col-6">
                    <log :items="result.products" title="Результат"></log>
                </div>
                <div class="col-6">
                    <log :items="result.log" title="Лог"></log>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
  import Log from '../components/Log';

  export default {
    data: function() {
      return {
        result: null,
      }
    },
    methods: {
      run() {
        this.result = null;

        this.$api.processes.post()
          .then(({data}) => (this.result = data));
      },
    },
    components: {
      Log,
    },
  };
</script>
