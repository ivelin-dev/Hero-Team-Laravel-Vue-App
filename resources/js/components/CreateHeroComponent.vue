<template>

    <div id="content">

        <div class="container">
            <div class="row justify-content-md-center">
                <h2>Create a Hero</h2>
            </div>
            <form @submit.prevent="createHero">
                <div class="row justify-content-md-center">
                    <div class="col-5">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Name" v-model="superhero.name">
                        </div>
                    </div>
                </div>

                <div class="row justify-content-md-center">
                    <div class="col-5">
                        <div class="form-group">
                            <label for="side">Side</label>
                            <select class="form-control" id="side" name="side" v-model="superhero.side">
                                <option>Light</option>
                                <option>Dark</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-md-center">
                    <div class="col-5">
                        <div class="form-group">
                            <label for="hitpoints">Hitpoints</label>
                            <input type="number" class="form-control" id="hitpoints" placeholder="100" v-model="superhero.hitpoints">
                        </div>
                    </div>
                </div>

                <div class="row justify-content-md-center">
                    <div class="col-5">
                        <div class="form-group">
                            <label for="attack">Attack</label>
                            <input type="number" class="form-control" id="attack" placeholder="100" v-model="superhero.attack">
                        </div>
                    </div>
                </div>

                <div class="row justify-content-md-center">
                    <div class="col-5">
                        <div class="form-group">
                            <label for="specialAbility">Special Ability</label>
                            <textarea class="form-control" id="specialAbility" rows="2" placeholder="Telekinesis" v-model="superhero.specialAbility"></textarea>
                        </div>
                    </div>
                </div>


                <div class="row justify-content-md-center">
                    <button type="submit" class="btn btn-primary">CREATE</button>
                </div>
            </form>
        </div>

    </div>


</template>

<script>
    export default {
        data() {
            return {
                superhero: {
                    name: '',
                    side: null,
                    hitpoints: 0,
                    attack: 0,
                    specialAbility: ''
                }
            };
        },
        methods: {
            createHero() {
                fetch('/api/superhero', {
                    method: 'post',
                    body: JSON.stringify(this.superhero),
                    headers: {
                        // Set Accept header so laravel doesn't redirect back in case of a validation error
                        // but spits out the JSON instead.
                        'accept': 'application/json',
                        'content-type': 'application/json'
                    }
                })
                    .then(res => res.json())
                    .then(data => {

                        if (data.errors) {
                            let errorsArr = [];
                            for (let property in data.errors) {
                                let allItemErrors = data.errors[property].join();
                                errorsArr.push(allItemErrors);
                            }
                            alert(errorsArr.join(';'));
                            throw new Error('Validation errors encountered.');
                        }

                        alert('Superhero Created');
                        this.clearForm();
                    })
                    .catch((error) => {
                        console.log(error)
                    });
            },
            clearForm() {
                this.superhero.name = '';
                this.superhero.side = null;
                this.superhero.hitpoints = 0;
                this.superhero.attack = 0;
                this.superhero.specialAbility = '';
            }
        }
    }
</script>
