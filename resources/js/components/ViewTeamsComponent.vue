<template>
    <div id="content">

        <div class="container">
            <div class="row justify-content-md-center">
                <h2>Teams</h2>
            </div>
            <div class="row justify-content-md-center mb-4" v-for="(team, index) in teams" v-bind:key="team.id">
                <div class="container">
                    <div class="row justify-content-md-center">
                        <h4>{{team.name}} &#9889;{{calculatePower(team.heroes)}}</h4>
                    </div>

                    <div class="row justify-content-md-center">
                        <div class="col-sm-2" v-for="hero in teams[index].heroes">
                            <h5 class="card-header">{{ hero.name }}</h5>
                            <div class="card card-body mb-2">
                                <p class="text-justify">
                                    <b>Side:</b> {{ hero.side }} <br>
                                    <b>Hitpoints:</b> {{ hero.hitpoints }} <br>
                                    <b>Attack:</b> {{ hero.attack }} <br>
                                    <b>Ability:</b> {{ hero.special_ability }} <br>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
            </div>

        </div>
    </div>

</template>

<script>
    export default {
        data() {
            return {
                teams: []
            };
        },
        created() {
            this.setTeams();
        },

        methods: {
            setTeams() {
                fetch('/api/team')
                    .then(res => res.json())
                    .then(data => {
                        this.teams = data;
                    })
                    .catch((error) => {
                        console.log(error)
                    });
            },
            calculatePower(heroes) {

                let numericPowerValue = 0;

                heroes.forEach(function (hero) {
                    numericPowerValue += hero.hitpoints;
                    numericPowerValue += hero.attack;
                });

                return numericPowerValue;
            }
        }
    }
</script>
