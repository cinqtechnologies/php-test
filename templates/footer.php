<footer>
	<div class="container">
	</div>
</footer>

<div id="modal-alerta" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="modal-alerta-titulo" class="modal-title">Alerta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="modal-alerta-corpo" class="modal-body"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

<div id="loading_overlay" style="position: fixed; top: 0; left: 0; background-color: rgba(0,0,0,.5); width: 100%; height: 100%; z-index: 1050; display: none;">
	<div class="fa-2x">
		<i class="fas fa-spinner fa-pulse" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); color: white;"></i>
		<span class="sr-only">Loading...</span>
	</div>
</div>

<div class="d-md-none icon-top" onclick="$('html').animate({ scrollTop: 0 });">
	<i class="fas fa-chevron-up"></i>
</div>