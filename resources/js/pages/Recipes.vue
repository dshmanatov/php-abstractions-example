<template>
    <div class="row">
        <div class="col">
            <rest-table
                    idField="id"
                    :fields="[
                        {field: 'id', title: 'ID'},
                        {field: 'name', title: 'Название'},
                        ]"
                    :rest="$api.recipes"
                    :schema="schema">
            </rest-table>
        </div>
    </div>
</template>
<script>
  import RestTable from '../components/RestTable';

  const schema = {
    fields: [{
      name: 'name',
      label: 'Имя',
      type: 'text',
      required: true,
    }]
  };

  export default {
    data() {
      return {
        schema,
      }
    },
    components: {
      RestTable,
    }
  };
</script>
