$(document).ready(function() {

	//list all cars
	listAllCars();
	
	// List years on form
	var date = new Date();
	var year = date.getFullYear()+1;
	years = new Object();
	for (i = year; i >= year-80; i--) {
		$('.ano').append($('<option>', {value: i, text: i}));
	}

	// list brands on form
	$.ajax({
		url: 'http://127.0.0.1/marcas',
		type: 'GET',
		dataType: 'json',
		success: function(response) {
			$.each(response, function(index, val) {
				$('.marca').append($('<option>', {value: val.id, text: val.marca}));
			});
		}
	});
	
	// delete car
	$('body').on('click', '.delete', function() {
		var id = $(this).attr('data-id');
		var url = 'http://127.0.0.1/carros/' + id;


		swal({
			title: 'Tem certeza?',
			text: 'Confirma a exclusão do codigo ' + id + '?',
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			cancelButtonText: 'Não',
			confirmButtonText: 'Sim'
		}).then((result) => {
			if (result.value) {
				$.ajax({
					url: url,
					type: 'DELETE',
					dataType: 'json',
					success: function (response) {
						showAlert(response);
						listAllCars();
					}
				})
			}
		})
	});


	// add new car
	$('body').on('click', '.save', function() {
		var data = $(this).parents('form').serializeArray();
		if(validateForm(data)) {
			$.ajax({
				url: 'http://127.0.0.1/carros',
				type: 'POST',
				dataType: 'json',
				data: data,
				contentType: 'application/x-www-form-urlencoded'
			})
			.done(function(response) {
				showAlert(response);
				listAllCars();
			})
		}
	});

	// edit existing car
	$('body').on('click', '.edit', function() {
		var id = $(this).attr('data-id');
		var url = 'http://127.0.0.1/carros/' + id;
		$.ajax({
			url: url,
			type: 'GET',
			dataType: 'json',
			success: function(response) {
				$('#editCar').find('#editcodigo').val(response[0].id);
				$('#editCar').find('.marca').val(response[0].marcaId);
				$('#editCar').find('.modelo').val(response[0].modelo);
				$('#editCar').find('.ano').val(response[0].ano);
				$('.save-edit').attr('data-id', id);
				$('#editCar').modal('show');
			}
		});
	});

	// save editing car
	$('body').on('click', '.save-edit', function() {
		var id = $(this).attr('data-id');
		var data = $(this).parents('form').serializeArray();
		if(validateForm(data)) {
			$.ajax({
				url: 'http://127.0.0.1/carros/' + id,
				type: 'PUT',
				dataType: 'json',
				data: data,
				contentType: 'application/x-www-form-urlencoded'
			})
			.done(function(response) {
				showAlert(response);
				listAllCars();
			})
		}
	});


	/// FUNCTIONS ====================


	// validate form inputs
	function validateForm(data) {
		var ret = true;
		$.each(data, function(index, val) {
			if(val.value == '') {
				swal(
					'Atenção',
					'O campo "' + val.name + '" não pode ficar vazio.',
					'error'
					)
				ret = false;
			}
		});
		return ret;
	}

	// clear modal inputs
	function clearModal(){
		$('#editcodigo').val('');
		$('.marca').val('');
		$('.modelo').val('');
		$('.ano').val('');
	}

	// show alert message
	function showAlert(response) {
		var alert = 'Erro!';
		var status = 'error';
		if(response.error == false) {
			alert = 'Successo';
			status = 'success';
			$('#newCar').modal('hide');
			$('#editCar').modal('hide');
			clearModal();
		}
		swal(
			alert,
			response.message,
			status
			);
	}

	//list all cars
	function listAllCars() {
		$('#cars-append').html('');
		$.ajax({
			url: 'http://127.0.0.1/carros',
			type: 'GET',
			dataType: 'json',
			success: function(response) {
				$.each(response, function(index, val) {
					var row = $('<tr>');
					row.append($('<td>', {text: val.id}));
					row.append($('<td>', {text: val.marca}));
					row.append($('<td>', {text: val.modelo}));
					row.append($('<td>', {text: val.ano}));
					row.append($('<td>', {class: 'text-right'})
						.append($('<button>', {type: 'button', class: 'btn btn-xs btn-primary edit', 'data-id': val.id, text: 'Editar'}))
						.append($('<button>', {type: 'button', class: 'btn btn-xs btn-danger delete margin-left-5', 'data-id': val.id, text: 'Excluir'}))
						);
					$('#cars-append').append(row);
				});
			}
		});
	}


});