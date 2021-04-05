<template>
    <div class="row">
        <div class="col">
            <rest-table
                    idField="id"
                    :fields="[
                        {field: 'id', title: 'ID'},
                        {field: 'name', title: 'Ресурс'},
                        {field: 'stock', title: 'Количество'},
                        ]"
                    :rest="$api.resources"
                    :schema="schema"
            >
            </rest-table>
        </div>
    </div>
</template>
<script>
  import RestTable from '../components/RestTable';

  const schema = {
    fields: [{
      name: 'name',
      label: 'Ресурс',
      type: 'text',
      required: true,
    }, {
      name: 'stock',
      label: 'Количество',
      type: 'number',
      required: true,
    },]
  };

  export default {
    data() {
      return {
        schema,
      }
    },
    components: {
      RestTable,
    },
  }
</script>
