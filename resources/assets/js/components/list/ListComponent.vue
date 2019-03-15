<template>
    <div>
        <slot name="table-content"></slot>
        <div class="page-control">
            <md-button class="md-icon-button md-raised md-primary">
                <md-icon>skip_previous</md-icon>
            </md-button>
            <md-button class="md-icon-button md-raised md-primary">
                <md-icon>keyboard_arrow_left</md-icon>
            </md-button>
            <p>Page 1 of 1</p>
            <md-button class="md-icon-button md-raised md-primary">
                <md-icon>keyboard_arrow_right</md-icon>
            </md-button>
            <md-button class="md-icon-button md-raised md-primary">
                <md-icon>skip_next</md-icon>
            </md-button>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ListComponent"
    }
</script>

<style scoped>
    .page-control {
        text-align: center;
        margin-top: 10px;
    }

    .page-control > p {
        display: inline;
        position: relative;
        top: 11px;
    }
</style>
