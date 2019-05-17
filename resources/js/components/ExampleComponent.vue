<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                    Expence ::
                    </div>

                    <div class="card-body">
                    
                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="text" class="form-control" id="amount" placeholder="Enter amount" v-model="transaction.amount">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" class="form-control" id="description" placeholder="Enter description" v-model="transaction.amount">
                        </div>
                        <div class="form-group">
                            <label for="date">date</label>
                            <input type="text" class="form-control" id="date" placeholder="Enter date" v-model="transaction.date">
                        </div>
                        <button class="btn btn-primary" @click="submit">Submit</button>
                        <button class="btn btn-default"> Clear </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                transaction: {
                    amount: 0,
                    description: "abc expence",
                    date: ''
                }
            }
        },
        methods: {
            submit() {
                alert("Yes here to submitting the data");
            }
        },
        mounted() {
            console.log('Component mounted new.')
        }
    }
</script>
