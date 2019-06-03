$(document).ready(function () {
	$.fn.select2.defaults.set( "theme", "bootstrap4" );
	$('[data-toggle="popover"]').popover();
	$("form[data-ajax=true]").on("submit", submit_form);
})

function submit_form (event) {
	event.preventDefault();
	
	if (this.dataset.before) {
		if (window[this.dataset.before])
			if (!window[this.dataset.before].call(this))
				return false;
	}
	
	success_callback = null;
	if (this.dataset.success) {
		if (window[this.dataset.success])
			success_callback = window[this.dataset.success];
	}
	
	error_callback = null;
	if (this.dataset.error) {
		if (window[this.dataset.error])
			error_callback = window[this.dataset.error];
	}
	
	_form_submited.call(this, success_callback, error_callback);
}

function _form_submited (success_callback, error_callback) {
	// Evita que formulário seja submetido múltiplas vezes
	if ($(this).data("busy")) {
		return false;
	}
	
	$(this).data("busy", true);
	$("#loading_overlay").css("display", "");
	
	var data = new FormData(this);
	
	var This = this;
	$.ajax({
		method: "POST",
		url: $(this).attr("action"),
		data: data,
		dataType: "JSON",
		cache: false,
		contentType: false,
		processData: false,
	}).done(function (response) {
		if (response.status === "success") {
			if (typeof(success_callback) === "function")
				success_callback(response);
		}
		else {
			if (typeof(error_callback) === "function")
				error_callback(response);
			else
				pretty_alert(response.message);
		}
	}).fail(function (x) {
		pretty_alert("Error " + x.status + ": " + x.responseText);
	}).always( function () {
		$(This).data("busy", false);
		$("#loading_overlay").css("display", "none");
	});

	return false;
}

function pretty_alert (message, title) {
	if (title)
		$("#modal-alerta-titulo").html(title);
	else
		$("#modal-alerta-titulo").html("Alert");
	
	$("#modal-alerta-corpo").html(message);
	
	$("#modal-alerta").modal("show");
}