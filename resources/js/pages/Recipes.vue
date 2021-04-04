<template>
    <div class="row">
        <div class="col">
            <rest-table
                    idField="id"
                    :fields="[
                        {field: 'id', title: 'ID'},
                        {field: 'name', title: 'Название'},
                        ]"
                    :rest="$api.recipes">
            </rest-table>
        </div>
    </div>
</template>
<script>
  import RestTable from '../components/RestTable';

  export default {
    data() {
      return {}
    },
    components: {
      RestTable,
    }
  };
</script>
