<template>

    <div id="content">
        <div class="container">

            <div class="row">
                <div class="container">
                    <div class="row justify-content-md-center mb-4">
                        <h2>Create a Team</h2>
                    </div>
                    <div class="row justify-content-md-center">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-outline-primary btn-lg" @click="changeTeamSide('light')" v-bind:class="[this.selectedTeamSide === 'light' ? 'active' : '']">Light
                            </button>
                            <button type="button" class="btn btn-outline-primary btn-lg" @click="changeTeamSide('dark')" v-bind:class="[this.selectedTeamSide === 'dark' ? 'active' : '']">Dark</button>
                        </div>
                    </div>
                </div>
            </div>
            <hr>

            <div class="row" v-if="selectedTeamSide === 'dark'">
                <div class="col-sm-2" v-for="superhero in selectedDarkHeroes" v-bind:key="superhero.id" v-bind:id="'hero-card-' + superhero.id">
                    <h5 class="card-header">{{ superhero.name }}</h5>
                    <div class="card card-body mb-2">
                        <p class="text-justify">
                            <b>Side:</b> {{ superhero.side }} <br>
                            <b>Hitpoints:</b> {{ superhero.hitpoints }} <br>
                            <b>Attack:</b> {{ superhero.attack }} <br>
                            <b>Ability:</b> {{ superhero.special_ability }} <br>
                        </p>
                        <hr>
                        <button type="button" class="btn btn-danger" @click="removeHero(superhero)">REMOVE</button>
                    </div>
                </div>
            </div>
            <div class="row" v-if="selectedTeamSide === 'light'">
                <div class="col-sm-2" v-for="superhero in selectedLightHeroes" v-bind:key="superhero.id" v-bind:id="'hero-card-' + superhero.id">
                    <h5 class="card-header">{{ superhero.name }}</h5>
                    <div class="card card-body mb-2">
                        <p class="text-justify">
                            <b>Side:</b> {{ superhero.side }} <br>
                            <b>Hitpoints:</b> {{ superhero.hitpoints }} <br>
                            <b>Attack:</b> {{ superhero.attack }} <br>
                            <b>Ability:</b> {{ superhero.special_ability }} <br>
                        </p>
                        <hr>
                        <button type="button" class="btn btn-danger" @click="removeHero(superhero)">REMOVE</button>
                    </div>

                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-4 text-center">
                    <label for="team-name"><strong>TEAM NAME</strong></label>
                </div>
            </div>
            <div class="row justify-content-center mb-4">
                <div class="col-4 text-center">
                    <input id="team-name" type="text" v-model="teamName">
                </div>
            </div>
            <div class="row justify-content-center" v-if="doShowNoHeroesSelectedDiv()">
                <div class="col-4 text-center">
                    <p>There are no superheroes added to the {{selectedTeamSide}} team yet.</p>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-4 text-center">
                    <p>&#9889;<strong>POWER:</strong> {{selectedTeamPower}}</p>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-4 text-center">
                    <button type="button" class="btn btn-primary" @click="createTeam()" v-bind:disabled="!isTeamSizeValid()">CREATE {{selectedTeamSide.toUpperCase()}} TEAM</button>
                </div>
            </div>

            <hr>
            <div class="row" v-if="selectedTeamSide === 'dark'">
                <div class="col-sm-2" v-for="superhero in availableDarkSuperheroes" v-bind:key="superhero.id" v-bind:id="'hero-card-' + superhero.id">
                    <h5 class="card-header">{{ superhero.name }}</h5>
                    <div class="card card-body mb-2">
                        <p class="text-justify">
                            <b>Side:</b> {{ superhero.side }} <br>
                            <b>Hitpoints:</b> {{ superhero.hitpoints }} <br>
                            <b>Attack:</b> {{ superhero.attack }} <br>
                            <b>Ability:</b> {{ superhero.special_ability }} <br>
                        </p>
                        <hr>
                        <button type="button" class="btn btn-success" @click="addHero(superhero)">ADD</button>
                    </div>

                </div>

            </div>

            <div class="row" v-if="selectedTeamSide === 'light'">
                <div class="col-sm-2" v-for="superhero in availableLightSuperheroes" v-bind:key="superhero.id" v-bind:id="'hero-card-' + superhero.id">
                    <h5 class="card-header">{{ superhero.name }}</h5>
                    <div class="card card-body mb-2">
                        <p class="text-justify">
                            <b>Side:</b> {{ superhero.side }} <br>
                            <b>Hitpoints:</b> {{ superhero.hitpoints }} <br>
                            <b>Attack:</b> {{ superhero.attack }} <br>
                            <b>Ability:</b> {{ superhero.special_ability }} <br>
                        </p>
                        <hr>
                        <button type="button" class="btn btn-success" @click="addHero(superhero)">ADD</button>
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
                availableSuperheroes: [],
                selectedLightHeroes: [],
                selectedDarkHeroes: [],
                selectedTeamSide: 'light',
                teamName: ''
            };
        },
        created() {
            this.setHeroes();
        },
        computed: {
            availableLightSuperheroes: function () {
                return this.availableSuperheroes.filter(function (hero) {
                    return hero.side === 'light';
                });
            },
            availableDarkSuperheroes: function () {
                return this.availableSuperheroes.filter(function (hero) {
                    return hero.side === 'dark';
                });
            },
            selectedTeamPower: function () {

                let heroes = [];
                let numericPowerValue = 0;
                if(this.selectedTeamSide === 'light'){
                    heroes = this.selectedLightHeroes;
                } else if (this.selectedTeamSide === 'dark') {
                    heroes = this.selectedDarkHeroes;
                }

                heroes.forEach(function (hero, index) {

                    numericPowerValue += hero.hitpoints;
                    numericPowerValue += hero.attack;
                });
                return numericPowerValue;
            }
        },
        methods: {
            setHeroes() {

                fetch('/api/superhero')
                    .then(res => res.json())
                    .then(data => {
                        this.availableSuperheroes = data;
                    })
                    .catch((error) => {
                        console.log(error)
                    });
            },
            addHero(superhero) {

                if (superhero.side === 'light') {
                    if (this.selectedLightHeroes.length > 4) {
                        alert('Team size must be 3-5 members');
                        return;
                    }
                    this.selectedLightHeroes.push(superhero);
                } else if (superhero.side === 'dark') {
                    if (this.selectedDarkHeroes.length > 4) {
                        alert('Team size must be 3-5 members');
                        return;
                    }
                    this.selectedDarkHeroes.push(superhero);
                } else {
                    alert('Please select a team side.');
                    return;
                }

                this.availableSuperheroes = this.availableSuperheroes.filter(function (availableHero) {
                    return availableHero.id !== superhero.id;
                });

            },
            removeHero(superhero) {


                if (superhero.side === 'light') {
                    this.selectedLightHeroes = this.selectedLightHeroes.filter(function (selectedHero) {
                        return selectedHero.id !== superhero.id
                    });
                } else if (superhero.side === 'dark') {
                    this.selectedDarkHeroes = this.selectedDarkHeroes.filter(function (selectedHero) {
                        return selectedHero.id !== superhero.id
                    });
                } else {
                    alert('Please select a team side.');
                    return;
                }

                this.availableSuperheroes.push(superhero);
            },
            changeTeamSide(side) {
                this.selectedTeamSide = side;
            },
            isTeamSizeValid() {
                if (this.selectedTeamSide === 'light') {
                    return this.selectedLightHeroes.length >= 3 && this.selectedLightHeroes.length <= 5;
                } else if (this.selectedTeamSide === 'dark') {
                    return this.selectedDarkHeroes.length >= 3 && this.selectedDarkHeroes.length <= 5;
                } else {
                    alert('Please select a team side.');
                }
            },
            doShowNoHeroesSelectedDiv() {
                let countOfSelectedHeroes = 0;

                if (this.selectedTeamSide === 'light') {
                    countOfSelectedHeroes = this.selectedLightHeroes.length;
                } else if (this.selectedTeamSide === 'dark') {
                    countOfSelectedHeroes = this.selectedDarkHeroes.length;
                } else {
                    alert('Please select a team side.')
                }

                return countOfSelectedHeroes <= 0;
            },
            createTeam() {
                if(!this.isTeamSizeValid()) {
                    alert('Team size must be 3-5 members');
                    return;
                }

                let postData = {};
                if(this.selectedTeamSide === 'light'){
                    postData['heroIds'] = this.selectedLightHeroes.map(a => a.id);
                } else if (this.selectedTeamSide === 'dark') {
                    postData['heroIds'] = this.selectedDarkHeroes.map(a => a.id);
                } else {
                    alert('Please select a team side.');
                }

                postData['teamName'] = this.teamName;
                postData['side'] = this.selectedTeamSide;

                fetch('/api/team', {
                    method: 'post',
                    body: JSON.stringify(postData),
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
                            alert(data.errors.join(';'));
                            throw new Error('Validation errors encountered.');
                        }

                        alert('Team Created');
                        this.resetData();
                    })
                    .catch((error) => {
                        console.log(error)
                    });


            },
            resetData() {
                this.setHeroes();
                this.selectedLightHeroes = [];
                this.selectedDarkHeroes = [];
                this.selectedTeamSide ='light';
                this.teamName = '';
            }
        }
    }
</script>
