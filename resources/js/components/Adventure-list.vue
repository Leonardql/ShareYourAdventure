<template>
    <div>
        <div>
            <aside>
                <h2>Describe your dream adventure</h2>
                <small>If you see an adventure you want to be in. Try the chat and try to find the person who posted the adventure. And get to know each other.</small>
                <small> Please do not edit the post if you are not the owner but you can always add stuff. + Do not put your name in the list otherwise you will lose the purpose of this app.</small>
                    <form>
                        <div class="form-group">
                            <textarea rows="4" class="form-text" placeholder="Your new adventure" v-model="adventure.body" required></textarea>


                        <input type="button" class="btn btn-primary" @click="createAdventure()" value="Add Adventure">

                        </div>
                    </form>


                    <ul>
                        <li :class="{'is-active':isActive('current')}">
                            <h3>
                                <a href="#" v-on:click.prevent="fetchAdventureList()">
                                    Current Adventures
                                </a>
                            </h3>
                        </li>
                    </ul>
                <article  v-for="adventure in list">

                        <h4> Adventure {{ adventure.id }}  </h4>
                        <div>
                            <p v-if="adventure !== editingAdventure" @dblclick="editAdventure(adventure)" v-bind:title="message">
                                {{ adventure.body }}
                            </p>
                            <textarea v-if="adventure === editingAdventure" v-autofocus @keyup.enter="endEditing(adventure)" @blur="endEditing(adventure)" placeholder="New Adventure" v-model="adventure.body"></textarea>
                            <small>Double click on the text if you want to edit.</small>
                        </div>
                    <!--<footer class="card-footer">-->
                        <!--<a class="card-footer-item" v-on:click.prevent="deleteAdventure(adventure.id)">Delete</a>-->
                    <!--</footer>-->
                </article>
            </aside>
        </div>
    </div>
</template>
<script>
    export default {
        directives: {
            'autofocus': {
                inserted(el) {
                    el.focus();
                }
            }
        },
        data() {
            return {
                message: 'Double click for editing.',
                list: [],
                adventure: {
                    id: '',
                    body: '',
                },
                editingAdventure: {},
                activeItem: 'current'
            }
        },
        created() {
            this.fetchAdventureList();
        },
        methods: {
            fetchAdventureList(archive = null) {
                if (archive === null) {
                    var url = 'current_adventures';
                    this.setActive('current');
                }
//                  else {
//                    var url = 'archived_tasks';
//                    this.setActive('archive');
//                }
                axios.get(url).then(result => {
                    this.list = result.data
                });
            },
            isActive(menuItem) {
                return this.activeItem === menuItem;
            },
            setActive(menuItem) {
                this.activeItem = menuItem;
            },
            createAdventure() {
                axios.post('create_adventures', this.adventure).then(result=> {
                    this.adventure.body = '';
                    this.fetchAdventureList();
                }).catch(err => {
                    console.log(err);
                });
            },
            editAdventure(adventure) {
                this.editingAdventure = adventure;
            },
            endEditing(adventure) {
                this.editingAdventure = {};
                if (adventure.body.trim() === '') {
                    this.deleteAdventure(adventure.id);
                } else {
                    axios.post('edit_adventure', adventure).then(result => {
                        console.log('access!')
                    }).catch(err => {
                        console.log(err);
                    });
                }
            },
//            deleteAdventure(id) {
//                axios.post('delete_adventure/' + id).then(result => {
//                    this.fetchAdventureList();
//                }).catch(err => {
//                    console.log(err);
//                });
//            },
//
        }
    }
</script>