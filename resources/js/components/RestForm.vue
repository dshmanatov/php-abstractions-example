<template>
    <form>
        <div v-if="showErrors" class="text-danger mb-4">
            Форма содержит ошибки
        </div>
        <div class="form-group row" v-for="field in schema.fields" :key="field.name">
            <label class="col-sm-3 col-form-label">{{ field.label }}</label>
            <div class="col-sm-9">
                <input :type="field.type" v-model="model[field.name]" class="form-control">
            </div>
        </div>
    </form>
</template>
<script>
  const getFieldErrors = function(value, schema) {
    const errors = [];

    if (schema.required && !value) {
      errors.push(`Поле ${schema.label} должно быть заполнено`);
    }

    return errors;
  };

  export default {
    // Simple validator, checking require fields only
    props: {
      rest: Function,
      schema: Object,
    },
    data: function() {
      return {
        touched: false,
        errors: [],
        model: {},
      };
    },
    computed: {
      showErrors() {
        return this.errors.length && this.touched;
      }
    },
    methods: {
      getFieldsWithErrors() {
        return this.schema.fields.filter(field => {
          return !!getFieldErrors(this.model[field.name], field).length;
        });
      },
      submit() {
        let errors = this.getFieldsWithErrors();

        if (errors.length) {
          this.touched = true;
          this.errors = errors;

          return Promise.resolve(false);
        } else {
          this.errors = [];

          return this.rest.post(this.model).then(({data}) => Promise.resolve(data));
        }
      },
    }
  }
</script>
