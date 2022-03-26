<template>
  <div>
    <button @click="increment">{{ count }}</button>
    <table class="table table-striped">
      <thead>
        <tr>
          <td scope="col">Descrição</td>
          <td scope="col">Data</td>
          <td scope="col">Usuário</td>
          <td scope="col">Valor {{ name }}</td>
        </tr>
      </thead>
      <tbody>
        <tr v-for="expense of expenses" :key="expense.id">
          <td>{{ expense.description }}</td>
          <td>{{ expense.transaction_at }}</td>
          <td>{{ expense.user_name }}</td>
          <td>{{ expense.value }}</td>
          <td>
            <button>Editar</button>
            <button>Excluir</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import ListsDataService from "../services/expenses";
import { nextTick } from 'vue'
export default {
  name: "listsExpends",
  data() {
    return {
      expenses: [],
      name: 'icaro',
      count: 0
    };
   },
  methods: {
    increment() {
      this.count++
    },
    retrieveLists() {
      ListsDataService.getAll()
        .then(response => {
          alert(1);
          var expenses = response.data;
          nextTick(function (){
            console.log(expenses);
            window.myself.expenses.push(expenses[0]);
            window.myself.name = 'gabriel';
            console.log(window.myself.expenses);
          });
        })
        .catch(e => {
          console.log(e);
        });
    }
  },
  mounted() {
    /*
    window.myself = this;
    window.setTimeout(function(){
      alert(2);
      window.myself.retrieveLists();
      alert(3);
    }, 5000);*/
    this.increment();
  }
}
</script>

<style scoped>
/* CSS Here! */
</style>