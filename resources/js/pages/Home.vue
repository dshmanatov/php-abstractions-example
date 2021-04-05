<template>
    <div>
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
            <div class="col">
                <div class="card">
                    <div class="card-header">Результат</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <log :items="result.goods" title="Продукция"></log>
                            </div>
                            <div class="col-6">
                                <log :items="result.log" title="Лог"></log>
                            </div>
                        </div>
                    </div>
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
          .then(({data}) => this.result = data);
      },
    },
    components: {
      Log,
    },
  };
</script>
