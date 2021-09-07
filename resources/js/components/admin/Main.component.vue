<template>
    <div class="col-6">
        <addLocation></addLocation>
        <h4>Create Company</h4>
        <h4>Add a location to the company</h4>
        <h4>Add a manager to the location</h4>
        <hr>

            <div class="mb-3">
                <label class="form-label">Company Name</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <button type="submit" class="btn btn-primary">Create Company</button>

    </div>
</template>

<script>
import AddLocation from './AddLocation.component'

export default {
    name: 'Admin',
    components :{
        addLocation: AddLocation
    },
    methods: {},
    mounted(){
        console.log(this.$store.state.admin.count)
    }
};
</script>
