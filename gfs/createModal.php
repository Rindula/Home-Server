<div class="modal fade" id="<?= $modalID ?>" tabindex="-1" role="dialog" aria-labelledby="<?= $modalID ?>Label" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="<?= $modalID ?>Label"><?= $modalTitle ?></h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
        <?= $modalBody ?>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Schließen</button>
      <a href="query.php?type=unlent&id=<?= $modalID ?>&to=<?= $receiver ?>" class="btn btn-primary">Bestätigen</a>
    </div>
  </div>
</div>
</div>