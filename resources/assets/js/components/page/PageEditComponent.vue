<template>
    <div class="mdl-grid">
        <div class="mdl-cell mdl-cell--12-col">
            <span class="mdl-layout__title">
                <h3>New page:</h3>
            </span>

            <p>
                Add elements onto the corresponding column to manage the appearance of your new page. Change the order of the
                elements by dragging them around.
            </p>

            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <label class="mdl-textfield__label" for="page-title">Page title:</label>
                <input class="mdl-textfield__input" type="text" id="page-title" name="page-title" value="" required />
                <span class="mdl-textfield__error">Page title cannot be empty!</span>
            </div>

            <md-dialog :md-active.sync="showDialog" style="background-color: white;">
                <md-dialog-title>Add element</md-dialog-title>
                <md-dialog-content>
                    <div v-for="app in apps" :key="app.name">
                        <md-list>
                            <md-subheader class="md-primary">{{ app.name }}</md-subheader>
                            <md-list-item v-for="element in app.elements" :key="app.name + element.identifier" @click="addElementToPage(0, element.identifier)">{{ element.identifier }}</md-list-item>
                        </md-list>
                    </div>
                </md-dialog-content>
                <md-dialog-actions>
                    <md-button class="md-primary" @click="showDialog = false">Close</md-button>
                </md-dialog-actions>
            </md-dialog>

        </div>

        <div class="mdl-cell mdl-cell--6-col">
            <span class="mdl-layout__title">
                <h4>Left column:</h4>
            </span>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <label class="mdl-textfield__label" for="left-column-title">Column title:</label>
                <input class="mdl-textfield__input" type="text" id="left-column-title" name="left-column-title" value="" required />
                <span class="mdl-textfield__error">Column title cannot be empty!</span>
            </div>

            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <label class="mdl-textfield__label" for="left-column-width">Column width:</label>
                <select class="mdl-textfield__input" id="left-column-width" name="left-column-width">
                    <option value="2">2</option>
                    <option value="4">4</option>
                    <option value="6">6</option>
                    <option value="8">8</option>
                    <option value="10">10</option>
                    <option value="12">12</option>
                </select>
            </div>
            <div id="left-drop-destination" class="drop-column">
                <div @click="showDialog = true">
                    <svg class="plus-sign" xmlns="http://www.w3.org/2000/svg" width="75" height="75" viewBox="0 0 24 24">
                        <path d="M24 10h-10v-10h-4v10h-10v4h10v10h4v-10h10z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="mdl-cell mdl-cell--6-col">
            <span class="mdl-layout__title">
                <h4>Right column:</h4>
            </span>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <label class="mdl-textfield__label" for="right-column-title">Column title:</label>
                <input class="mdl-textfield__input" type="text" id="right-column-title" name="right-column-title" value="" required />
                <span class="mdl-textfield__error">Column title cannot be empty!</span>
            </div>

            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <label class="mdl-textfield__label" for="right-column-width">Column width:</label>
                <select class="mdl-textfield__input" id="right-column-width" name="right-column-width">
                    <option value="2">2</option>
                    <option value="4">4</option>
                    <option value="6">6</option>
                    <option value="8">8</option>
                    <option value="10">10</option>
                    <option value="12">12</option>
                </select>
            </div>
            <div id="right-drop-destination" class="drop-column">
                <svg class="plus-sign" id="add-right-button" xmlns="http://www.w3.org/2000/svg" width="75" height="75" viewBox="0 0 24 24">
                    <path d="M24 10h-10v-10h-4v10h-10v4h10v10h4v-10h10z"></path>
                </svg>
            </div>
        </div>

        <div class="center" style="padding-top: 10px;">
            <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" id="publish-button">Publish page</button>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'PageEditComponent',
        data() {
            return {
                apps: [{
                    name: 'Main',
                    elements: [{
                        identifier: 'Test'
                    }, {
                        identifier: 'Blub'
                    }]
                }, {
                    name: 'Base',
                    elements: [{
                        identifier: 'HTMLContent'
                    }]
                }],
                columns: [[], []],
                showDialog: false
            }
        },
        methods: {
            addElementToPage(column, identifier) {
                this.columns[column].add(identifier);
            }
        }
    }
</script>

<style scoped>
    .md-dialog {
        width: 700px;
    }
</style>
