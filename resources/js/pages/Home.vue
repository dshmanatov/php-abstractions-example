<template>
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-header">Ресурсы</div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th>Название</th>
                                <th>Количество</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-header">Запуск</div>
                <div class="card-body">
                    <button
                            @click="run"
                            class="btn btn-danger">Пуск
                    </button>
                    <div
                            v-if="result"
                            class="mt-3">
                        <log :items="result.products" title="Результат"></log>
                        <log :items="result.log" title="Лог"></log>
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
          .then(({data}) => (this.result = data));
      },
    },
    components: {
      Log,
    },
  };
</script>
