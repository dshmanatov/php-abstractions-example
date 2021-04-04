<template>
    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th
                        scope="col"
                        v-for="field in fields"
                        :key="field.title">{{ field.title }}
                </th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(item, index) in items" :key="item[idField]">
                <td v-for="field in fields"
                    v-text="item[field.field]"></td>
                <td>
                    <button
                            @click="deleteItem(item, index)"
                            class="btn btn-danger">Удалить
                    </button>
                </td>
            </tr>
        </tbody>
    </table>
</template>
<script>
  export default {
    created() {
      this.rest.get()
        .then((response) => (this.items = response.data));
    },
    data() {
      return {
        items: [],
      }
    },
    props: {
      rest: Function,
      fields: Array,
      idField: String,
    },
    methods: {
      deleteItem(item, index) {
        this.rest(item[this.idField]).delete().then(() => this.items.splice(index, 1));
      },
    },
  };
</script>
