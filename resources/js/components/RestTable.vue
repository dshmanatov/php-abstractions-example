<template>
    <div>
        <b-modal
                v-model="showModal"
                ref="modalForm"
                id="modal-new-item"
                title="Создать"
                ok-title="Сохранить"
                @ok="create">
            <p class="my-4">
                <rest-form
                        ref="form"
                        :rest="rest"
                        :schema="schema"></rest-form>
            </p>
        </b-modal>

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
        <b-button v-b-modal.modal-new-item variant="outline-primary">Создать</b-button>
    </div>
</template>
<script>
  import Modal from './Modal';
  import RestForm from './RestForm';

  export default {
    created() {
      this.rest.get()
        .then((response) => (this.items = response.data));
    },
    data() {
      return {
        showModal: false,
        items: [],
      }
    },
    props: {
      rest: Function,
      fields: Array,
      idField: String,
      schema: Object,
    },
    methods: {
      create(event) {
        event.preventDefault();

        this.$refs.form.submit()
          .then((result) => {
            if (result) {
              this.items.push(result);
              this.showModal = false;
            }
          });
      },
      openNewItemModal() {
        this.showModal = true;
      },
      deleteItem(item, index) {
        this.rest(item[this.idField]).delete().then(() => this.items.splice(index, 1));
      },
    },
    components: {
      Modal,
      RestForm,
    },
  };
</script>
