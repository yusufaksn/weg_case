<template>
    <div class="app">
        <br>
        <div class="container">
           <div class="row">

               <div class="col-9">
                   <h3>Weg Case</h3>
                   <hr>
               </div>
               <div class="col-3">
                   <button class="btn btn-success" @click="getProviders">Verileri Çek</button>
               </div>
           </div>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">İsim</th>
                    <th scope="col">Developer Zorluk Seviyesi</th>
                    <th scope="col">Kaç saatte bitireceği</th>
                    <th scope="col">Kaç haftada bitireceği</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="val in todoReport">
                    <td>{{ val.name }}</td>
                    <td>{{ val.dev_level }}</td>
                    <td>{{ val.hour }}</td>
                    <td>{{ val.week }}</td>

                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>

    export default {
        components:{},
        data(){
            return{
                todoReport:{}
            }
        },
        created() {
          this.todoReportGet();
        },
        methods:{
           todoReportGet(){
               axios.get('todoReport').then(response => {
                   this.todoReport = response.data;
               })
           },
            getProviders(){
                axios.get('todoImport').then(response => {
                    alert("Provider daki veriler çekildi");
                    this.todoReportGet();
                })
            }
        }
    }
</script>
