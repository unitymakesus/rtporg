// Create Modal Instance
var modal = new tingle.modal({
    closeMethods: ['overlay', 'button', 'escape'],
    onOpen: function() {
      $('.modal').css('display', 'block');
    },
    onClose: function() {
      $('.modal').css('display', 'none');
    }
});

// Modal Action
function launchModal(id){
  modal.setContent(document.querySelector('#'+id).innerHTML)
  modal.open();
}

// Detect Edit Clicks
$('.modal-btn').on('click', function(){
    var id = $(this).closest('.user-can-edit').attr('data-target');
    launchModal(id);
});

// Hover State Section
$('.modal-btn').hover(function(){
  console.log($(this).parent());
  $(this).closest('.user-can-edit').css("box-shadow", "6px 2px 20px rgba(0,0,0,0.2)");
  }, function(){
  $(this).closest('.user-can-edit').css("box-shadow", "none");
});
