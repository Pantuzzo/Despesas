<template>
  <nav>
      <div class="nav-wrapper blue darken-1">
        <a href="#" class="brand-logo center">Despesas</a>
      </div>
  </nav>
  <div class="container" style="margin-top:22px">

    <form @submit.prevent="save">
      <label>Descrição</label>
      <input type="text" placeholder="Descrição" v-model="expense.description" required>
      <label>Data</label>
      <input type="date" placeholder="Data" v-model="expense.transaction_at" required>
      <label>Usuário</label>
      <input type="text" placeholder="Usuário" v-model="expense.user_name" required>
      <label>Valor</label>
      <input type="text" placeholder="Valor" v-model="expense.value" required>
      <button type="submit" class="waves-effect waves-light btn-small">Salvar<i class="material-icons left">save</i></button>
    </form>

    <table class="table table-striped" style="margin-top:10px">
      <thead>
        <tr>
          <td>Descrição</td>
          <td>Data</td>
          <td>Usuário</td>
          <td>Valor</td>
          <td style="width: 200px;"></td>
        </tr>
      </thead>
      <tbody>
        <tr v-for="expense of expenses" :key="expense.id">
          <td>{{ expense.description }}</td>
          <td>{{ expense.transaction_at }}</td>
          <td>{{ expense.user_name }}</td>
          <td class="valor">{{ expense.value }}</td>
          <td>
            <a href="#" @click="update(expense)" class="badge badge-warning">Editar</a>
            <a href="#" @click="deleteExpense(expense.id)" class="badge badge-danger" style="margin-left:10px">Delete</a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import ListsDataService from "../services/expenses";

export default {
  name: "listsExpends",
  data() {
    return {
      expense: {
          id: '',
          description: '',
          transaction_at: '',
          user_name: '',
          value: ''
      },
      expenses: [],
      today: '',
    };
   },
  methods: {
    dataToday(){
      var data = new Date();
      var dia = String(data.getDate()).padStart(2, '0');
      var mes = String(data.getMonth() + 1).padStart(2, '0');
      var ano = data.getFullYear();
      var dataAtual = ano + '-' + mes + '-' + dia;
      this.today = dataAtual.toString();
    },
    retrieveLists() {
      ListsDataService.getAll()
      .then(response => {
        var expenses = response.data;
        this.expenses = expenses;
      }).catch(e => {
        console.log(e);
      });
    },
    refresh(){
      ListsDataService.getAll()
      .then(response => {
        this.expenses = response.data;
      });
    },
    save() {
      if(this.expense.transaction_at <= this.today){
        if(!this.expense.id){
          ListsDataService.create(this.expense).then(response => {
            console.log(this.expense);
            this.expense = {};
            alert("Despesa Salva com sucesso!");
            this.refresh();
          }).catch(e => {
            console.log(e);
          });
        }else{
            ListsDataService.update(this.expense.id, this.expense).then(response => {
              console.log(this.expense);
            console.log(this.expense);
            this.expense = {};
            alert("Despesa Atualizada! com sucesso!");
            this.refresh();
          }).catch(e => {
            console.log(e);
          });
        } 
      }else{
        alert("A data escolhida, deve ser menor que a data atual!");
      }
    },
    update(expense){
      var data = expense.transaction_at.split(" ")[0];
      expense.transaction_at = data
      console.log(expense);
      this.expense = expense;
    },
    deleteExpense(id){
      ListsDataService.delete(id).then(response => {
            this.expense = {};
            alert("Despesa Excluida!");
            this.refresh();
          }).catch(e => {
            console.log(e);
          });
    },
  },
  mounted() {
    this.dataToday();
    this.retrieveLists();
    this.refresh();
  }
}
</script>

<style scoped>
/* CSS Here! */
</style>