<!-- Add all my scripts -->

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
<script src="https://unpkg.com/bootstrap-table@1.18.2/dist/bootstrap-table.min.js"></script>

<script src="<?php echo PATH_JS ?>tui-chart.js"></script>
<script src="<?php echo PATH_JS ?>bootstrap-table-fr-FR.js"></script>
<script src="<?php echo PATH_JS ?>alertes.js"></script>


<?php if ($loc == "statistics") { ?>
    <script src="<?php echo PATH_JS ?>statistics.js"></script>
<?php } ?>

<?php if ($loc == "recipes" && $action == 'edit') { ?>
    <script src="<?php echo PATH_JS ?>recipes-edit.js"></script>
<?php } ?>

<?php if ($loc == "users") {
    if ($action == 'create') { ?>
        <script src="<?php echo PATH_JS ?>users-create.js"></script>
    <?php }
    if ($action == 'edit') { ?>
        <script src="<?php echo PATH_JS ?>users-edit.js"></script>
<?php }
} ?>

<?php if ($loc == "articles") {
    if ($action == 'commands') { ?>
        <script src="<?php echo PATH_JS ?>articles-commands.js"></script>
    <?php }
    if ($action == 'edit') { ?>
        <script src="<?php echo PATH_JS ?>articles-edit.js"></script>
<?php }
} ?>