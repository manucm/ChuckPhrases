export const openModal = (title, text) => {
  const modal = $("#myModal").modal({
      backdrop: 'static'
  });
  modal.find('.modal-title').html('').html(title);
  modal.find('.modal-body').find('p').html('').html(text);
  modal.find('.modal-footer').find('button').eq(0).hide()
  modal.modal('show')
}

export const openDeleteModal = (handleDelete, url, row) => {
  const modal = $("#myModal").modal({
    backdrop: 'static',
    keyboard:false,
  });
  const btnRemove = modal.find('modal-footer').find('button').eq(1);
  modal.find('.modal-title').html('').html('Operación de borrado');
  btnRemove.show()
  modal.find('.modal-body').find('p').html('').html('¿desea borrar el registro?');
  modal.modal('show')

  $('#delete-on').click(function() {
    handleDelete(url, row).then(()=> modal.modal('hide'));
  });

}

export const openSpinnerModal = () => {
  const modal = $("#myModal").modal({
    backdrop: 'static'
  });

  const btnRemove = modal.find('modal-footer').find('button').eq(1);
  modal.find('.modal-title').html('').html("Cargando...");
  modal.find('.modal-body').find('p').html('').html(spinner());
  btnRemove.hide()
  modal.modal('show')

  

  
  return modal;
}


const spinner = () => {
  return '';
}